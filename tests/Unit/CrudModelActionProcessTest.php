<?php

namespace Sfneal\CrudModelActions\Tests\Unit;

use Exception;
use Illuminate\Http\Response;
use Sfneal\Address\Models\Address;
use Sfneal\CrudModelActions\Tests\Assets\Actions\ProcessPeopleAction;
use Sfneal\CrudModelActions\Tests\CrudModelActionTestCase;
use Sfneal\Queries\RandomModelAttributeQuery;
use Sfneal\Testing\Models\People;

class CrudModelActionProcessTest extends CrudModelActionTestCase
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

        $this->queryAssertions($model->address, Address::class, 'data.address');
    }

    /**
     * Execute a CrudModelAction.
     *
     * @return Response
     * @throws Exception
     */
    protected function executeAction(): Response
    {
        return (new ProcessPeopleAction($this->request, $this->modelId))->execute();
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
                'address' => [
                    'type' => 'home',
                    'address_1' => '123 Main Street',
                    'city' => 'Boston',
                    'state' => 'MA',
                    'zip' => '12345',
                ],
            ],
        ];
    }
}
