<?php

namespace Sfneal\CrudModelActions;

use App\Http\Controllers\Traits\StatusUpdateResponse;
use Illuminate\Database\Eloquent\Model;
use Sfneal\Models\AbstractModelWithPublicStatus;

abstract class BaseUpdateModelPublicStatusAction extends CrudModelAction
{
    use StatusUpdateResponse;

    /**
     * The Eloquent Model class.
     *
     * @var AbstractModelWithPublicStatus
     */
    protected $modelClass;

    /**
     * @var AbstractModelWithPublicStatus
     */
    protected $model;

    /**
     * Update a Model's 'public_status' attribute.
     *
     * @return Model
     */
    protected function handle(): Model
    {
        $this->successActionVerb('updated');

        // Update public_status
        $this->model->updatePublicStatus();

        return $this->model;
    }

    /**
     * Return the default success response.
     *
     * @param string|null $response
     * @return string
     */
    protected function successResponse(string $response = null): string
    {
        return self::statusUpdateResponse($this->model);
    }
}
