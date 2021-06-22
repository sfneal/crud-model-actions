<?php


namespace Sfneal\CrudModelActions\Tests;


use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use Sfneal\CrudModelActions\Tests\Assets\Events\MockTrackingEvent;
use Sfneal\CrudModelActions\Tests\Assets\Requests\PostRequest;
use Sfneal\Testing\Models\People;
use Sfneal\Testing\Utils\Interfaces\RequestCreator;
use Sfneal\Testing\Utils\Traits\EventFaker;

abstract class CrudModelActionTestCase extends TestCase implements RequestCreator
{
    use EventFaker;
    use PostRequest;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var int|null
     */
    protected $modelId;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->request = $this->createRequest([], $this->requestData());
    }

    /**
     * @test
     * @throws Exception
     */
    public function action_fires_event()
    {
        $this->eventFaker();
        $this->executeAction();

        Event::assertDispatched(MockTrackingEvent::class);
    }

    /** @test */
    abstract public function action_can_be_executed();

    /**
     * @test
     * @throws Exception
     */
    public function action_return_response()
    {
        $response = $this->executeAction();

        $this->assertTrue(session()->has('success'));
        $this->assertIsString(session('success'));
        $this->assertInstanceOf(Response::class, $response);
    }

    /**
     * Execute a CrudModelAction.
     *
     * @return Response
     */
    abstract protected function executeAction(): Response;

    /**
     * Retrieve an array of data to be added to the mock request.
     *
     * @return array
     */
    abstract protected function requestData(): array;

    /**
     * Execute query assertions.
     *
     * @param $model
     */
    protected function queryAssertions($model): void
    {
        $this->assertInstanceOf(Model::class, $model);
        $this->assertInstanceOf(People::class, $model);

        foreach ($this->request->input('data') as $key => $attribute) {
            $this->assertEquals($attribute, $model->{$key});
        }
    }
}
