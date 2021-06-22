<?php

namespace Sfneal\CrudModelActions;

use Exception;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Sfneal\Actions\Action;
use Sfneal\CrudModelActions\Utils\HandleModel;
use Sfneal\CrudModelActions\Utils\HttpResponses;
use Sfneal\CrudModelActions\Utils\ModelEvents;
use Sfneal\CrudModelActions\Utils\ModelQueries;
use Sfneal\CrudModelActions\Utils\ResponseMessages;
use Sfneal\Helpers\Laravel\AppInfo;

abstract class CrudModelAction extends Action
{
    // todo: artisan command to create new CrudModelAction?
    // todo: change model type hinting to Model

    use HandleModel,
        HttpResponses,
        ModelEvents,
        ModelQueries,
        ResponseMessages;

    /**
     * @var Request
     */
    protected $request;

    /**
     * BaseSaveModelAction constructor.
     *
     * @param Request|null $request
     * @param int|EloquentModel|null $model
     * @param int|null $related_model_key
     */
    public function __construct(Request $request = null, $model = null, int $related_model_key = null)
    {
        $this->request = $request ?? request();
        $this->model = $this->resolveModel($model);
        $this->related_model_key = $related_model_key;
        $this->setTrackingEventFromConfig();
    }

    /**
     * Create or update the Model.
     *
     * @return Response
     * @throws Exception
     */
    public function execute(): Response
    {
        // Attempt to pass validation check
        // & execute CRUD action on $model
        try {

            // Model passes validation checks
            if (
                (method_exists($this, 'validate') && $this->validate())
                || ! method_exists($this, 'validate')
            ) {
                // Save the model
                $this->model = $this->handle();

                // Flash a success message
                session()->flash('success', $this->successMessage());

                // Fire TrackActivity Event
                if (method_exists($this, 'fireEvent')) {
                    $this->fireEvent();
                }

                // Return success response
                return response($this->successResponse(), 200);
            }

            // Validation failed - throw exception
            else {
                // todo: add exception logging?
                throw new Exception($this->failMessage());
            }
        }

        // Validation checks failed or model
        // CRUD action failed to execute
        catch (Exception $exception) {

            // Flash a success message
            session()->flash('fail', $this->failMessage());

            // Return failure response if the interface is implemented
            if (method_exists($this, 'failResponse')) {
                return response($this->failResponse(), 500);
            }

            // Throw exception
            throw $exception;
        }
    }
}
