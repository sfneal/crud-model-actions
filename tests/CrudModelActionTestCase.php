<?php


namespace Sfneal\CrudModelActions\Tests;


use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use Sfneal\CrudModelActions\Tests\Assets\Events\MockTrackingEvent;
use Sfneal\CrudModelActions\Tests\Assets\Requests\PostRequest;
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
     * @test
     * @throws Exception
     */
    public function action_fires_event()
    {
        $this->eventFaker();
        $this->executeAction();

        Event::assertDispatched(MockTrackingEvent::class);
    }

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
}
