<?php

namespace Sfneal\CrudModelActions;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Sfneal\Actions\AbstractAction;
use Sfneal\CrudModelActions\Utils\HandleModel;
use Sfneal\CrudModelActions\Utils\HttpResponses;
use Sfneal\CrudModelActions\Utils\ModelEvents;
use Sfneal\CrudModelActions\Utils\ModelQueries;
use Sfneal\CrudModelActions\Utils\ResponseMessages;

abstract class CrudModelAction extends AbstractAction
{
    // todo: artisan command to create new CrudModelAction?

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
     * @param Request $request
     * @param int|Model|null $model
     * @param int|null $related_model_key
     */
    public function __construct(Request $request, $model = null, $related_model_key = null)
    {
        $this->request = $request;
        $this->model = $this->resolveModel($model);
        $this->related_model_key = $related_model_key;
    }

    /**
     * Create or update the Model.
     *
     * @return Response
     * @throws Exception
     */
    public function execute()
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
                // todo: make this optional
                $this->fireEvent();

                // Return success response
                return response($this->successResponse(), 200);
            }

            // Validation failed - throw exception
            else {
                // todo: add exception logging?
                throw new Exception();
            }
        }

        // Validation checks failed or model
        // CRUD action failed to execute
        catch (Exception $exception) {

            // Throw errors in dev
            if (isDevelopmentEnvironment()) {
                throw $exception;
            }

            // Flash a success message
            session()->flash('fail', $this->failMessage());

            // Return failure response
            return response($this->failResponse(), 200);
        }
    }
}
