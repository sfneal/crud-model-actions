<?php


namespace Sfneal\CrudModelActions\Tests\Unit;


use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use Sfneal\CrudModelActions\Tests\Assets\Actions\CreatePeopleAction;
use Sfneal\CrudModelActions\Tests\Assets\Events\MockTrackingEvent;
use Sfneal\CrudModelActions\Tests\Assets\Requests\PostRequest;
use Sfneal\CrudModelActions\Tests\TestCase;
use Sfneal\Testing\Models\People;
use Sfneal\Testing\Utils\Interfaces\RequestCreator;
use Sfneal\Testing\Utils\Traits\EventFaker;

class CrudModelActionCreateTest extends TestCase implements RequestCreator
{
    use EventFaker;
    use PostRequest;

    /**
     * Retrieve a post request with mock data.
     *
     * @return Request
     */
    private function postRequest(): Request
    {
        return $this->createRequest([], [
            'data' => [
                'name_first' => 'Victor',
                'name_last' => 'Hedman',
                'email' => 'vhedman@example.com',
                'age' => 29,
            ]
        ]);
    }

    /**
     * @test
     * @throws Exception
     */
    public function model_can_be_created()
    {
        $request = $this->postRequest();
        $response = (new CreatePeopleAction($request))->execute();

        $query = People::query()
            ->where('name_first', '=', $request->input('data.name_first'))
            ->where('name_last', '=', $request->input('data.name_last'))
            ->where('email', '=', $request->input('data.email'))
            ->where('age', '=', $request->input('data.age'));

        $this->assertSame(1, $query->count());

        $model = $query->get()->first();

        $this->assertTrue($query->exists());
        $this->assertInstanceOf(Model::class, $model);
        $this->assertInstanceOf(People::class, $model);

        foreach ($request->input('data') as $key => $attribute) {
            $this->assertEquals($attribute, $model->{$key});
        }
    }

    /**
     * @test
     * @throws Exception
     */
    public function action_fires_event()
    {
        $this->eventFaker();
        $request = $this->postRequest();
        $response = (new CreatePeopleAction($request))->execute();

        Event::assertDispatched(MockTrackingEvent::class);
    }

    /**
     * @test
     * @throws Exception
     */
    public function action_return_response()
    {
        $request = $this->postRequest();
        $response = (new CreatePeopleAction($request))->execute();

        $this->assertTrue(session()->has('success'));
        $this->assertIsString(session('success'));
        $this->assertInstanceOf(Response::class, $response);
    }
}
