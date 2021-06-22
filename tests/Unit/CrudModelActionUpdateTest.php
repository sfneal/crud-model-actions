<?php


namespace Sfneal\CrudModelActions\Tests\Unit;


use Exception;
use Illuminate\Http\Response;
use Sfneal\CrudModelActions\Tests\Assets\Actions\UpdatePeopleAction;
use Sfneal\CrudModelActions\Tests\CrudModelActionTestCase;
use Sfneal\Queries\RandomModelAttributeQuery;
use Sfneal\Testing\Models\People;

class CrudModelActionUpdateTest extends CrudModelActionTestCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->modelId = (new RandomModelAttributeQuery(People::class, People::getPrimaryKeyName()))->execute();
    }


    /**
     * @test
     * @throws Exception
     */
    public function action_can_be_executed()
    {
        $this->executeAction();

        $model = People::query()->find($this->modelId);

        $this->queryAssertions($model);
    }

    /**
     * Execute a CrudModelAction.
     *
     * @return Response
     * @throws Exception
     */
    protected function executeAction(): Response
    {
        return (new UpdatePeopleAction($this->request, $this->modelId))->execute();
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
                'name_first' => 'Steven',
                'name_last' => 'Stamkos',
                'email' => 'sstamkos@example.com',
                'age' => 31,
            ]
        ];
    }
}
