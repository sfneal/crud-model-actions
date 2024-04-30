<?php

namespace Sfneal\CrudModelActions\Tests\Unit;

use Exception;
use Illuminate\Http\Response;
use Sfneal\CrudModelActions\Tests\Assets\Actions\DeletePeopleAction;
use Sfneal\CrudModelActions\Tests\CrudModelActionTestCase;
use Sfneal\Queries\RandomModelAttributeQuery;
use Sfneal\Testing\Models\People;

class CrudModelActionDeleteTest extends CrudModelActionTestCase
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
     *
     * @throws Exception
     */
    public function action_can_be_executed()
    {
        $model = People::query()->find($this->modelId);
        $this->assertTrue($model->exists());
        $this->executeAction();

        $this->assertNull(People::query()->find($this->modelId));
    }

    /**
     * Execute a CrudModelAction.
     *
     * @return Response
     *
     * @throws Exception
     */
    protected function executeAction(): Response
    {
        return (new DeletePeopleAction($this->request, $this->modelId))->execute();
    }

    /**
     * Retrieve an array of data to be added to the mock request.
     *
     * @return array
     */
    protected function requestData(): array
    {
        return [];
    }
}
