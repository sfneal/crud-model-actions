<?php


namespace Sfneal\CrudModelActions\Tests\Unit;


use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Sfneal\CrudModelActions\Tests\Assets\Actions\CreatePeopleAction;
use Sfneal\CrudModelActions\Tests\CrudModelActionTestCase;
use Sfneal\Testing\Models\People;

class CrudModelActionCreateTest extends CrudModelActionTestCase
{
    /**
     * Execute a CrudModelAction.
     *
     * @return Response
     * @throws Exception
     */
    protected function executeAction(): Response
    {
        return (new CreatePeopleAction($this->request))->execute();
    }

    /**
     * Retrieve an array of data to be added to the mock request.
     *
     * @return array
     */
    protected function requestData(): array
    {
        return [
            'data' => [
                'name_first' => 'Victor',
                'name_last' => 'Hedman',
                'email' => 'vhedman@example.com',
                'age' => 29,
            ]
        ];
    }

    /**
     * @test
     * @throws Exception
     */
    public function model_can_be_created()
    {
        $this->executeAction();

        $query = People::query()
            ->where('name_first', '=', $this->request->input('data.name_first'))
            ->where('name_last', '=', $this->request->input('data.name_last'))
            ->where('email', '=', $this->request->input('data.email'))
            ->where('age', '=', $this->request->input('data.age'));

        $this->assertSame(1, $query->count());

        $model = $query->get()->first();

        $this->assertTrue($query->exists());
        $this->assertInstanceOf(Model::class, $model);
        $this->assertInstanceOf(People::class, $model);

        foreach ($this->request->input('data') as $key => $attribute) {
            $this->assertEquals($attribute, $model->{$key});
        }
    }
}
