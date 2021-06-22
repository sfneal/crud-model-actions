<?php

namespace Sfneal\CrudModelActions\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Sfneal\Address\Models\Address;
use Sfneal\Address\Providers\AddressServiceProvider;
use Sfneal\CrudModelActions\Providers\CrudModelActionServiceProvider;
use Sfneal\Testing\Models\People;
use Sfneal\Testing\Providers\MockModelsServiceProvider;

class TestCase extends OrchestraTestCase
{
    use RefreshDatabase;

    /**
     * Register package service providers®.
     *
     * @param Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            CrudModelActionServiceProvider::class,
            MockModelsServiceProvider::class,
            AddressServiceProvider::class
        ];
    }

    /**
     * Define environment setup.
     *
     * @param Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Migrate 'people' table
        include_once __DIR__.'/../vendor/sfneal/mock-models/database/migrations/create_people_table.php.stub';
        (new \CreatePeopleTable())->up();

        // Migrate address table
        include_once __DIR__.'/../vendor/sfneal/address/database/migrations/create_address_table.php.stub';
        (new \CreateAddressTable())->up();
    }

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // Create model factories
        People::factory()
            ->count(20)
            ->has(Address::factory())
            ->create();
    }
}
