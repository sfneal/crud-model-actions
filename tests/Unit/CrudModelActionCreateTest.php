<?php


namespace Sfneal\CrudModelActions\Tests\Unit;


use Exception;
use Illuminate\Database\Eloquent\Model;
use Sfneal\CrudModelActions\Tests\Assets\Actions\CreatePeopleAction;
use Sfneal\CrudModelActions\Tests\Assets\Requests\PostRequest;
use Sfneal\CrudModelActions\Tests\TestCase;
use Sfneal\Testing\Models\People;
use Sfneal\Testing\Utils\Interfaces\RequestCreator;

class CrudModelActionCreateTest extends TestCase implements RequestCreator
{
    use PostRequest;

    /**
     * @test
     * @throws Exception
     */
    public function model_can_be_created()
    {
        $data = [
            'data' => [
                'name_first' => 'Victor',
                'name_last' => 'Hedman',
                'email' => 'vhedman@example.com',
                'age' => 29,
            ]
        ];
        $request = $this->createRequest([], $data);

        $response = (new CreatePeopleAction($request))->execute();

        $query = People::query()
            ->where('name_first', '=', $data['data']['name_first'])
            ->where('name_last', '=', $data['data']['name_last'])
            ->where('email', '=', $data['data']['email'])
            ->where('age', '=', $data['data']['age']);

        $this->assertSame(1, $query->count());

        $model = $query->get()->first();

        $this->assertTrue($query->exists());
        $this->assertInstanceOf(Model::class, $model);
        $this->assertInstanceOf(People::class, $model);

        foreach ($data['data'] as $key => $attribute) {
            $this->assertEquals($attribute, $model->{$key});
        }
    }
}
