<?php

namespace Sfneal\CrudModelActions\Utils;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Sfneal\Events\Event;
use Sfneal\Models\Model;

trait ModelEvents
{
    /**
     * @var Event Model Tracking Event to fire
     */
    protected $trackingEvent;

    /**
     * @var Model|EloquentModel
     */
    private $trackingEventModel;

    /**
     * @var bool Determine if the TrackingEvent was fired
     */
    private $trackingEventWasFired;

    /**
     * Fire the trackingEvent.
     *
     * @return void
     */
    protected function fireEvent()
    {
        if (isset($this->trackingEvent)) {
            event(new $this->trackingEvent($this->trackingEventModel()));
            $this->trackingEventWasFired = true;
        }
    }

    /**
     * Retrieve the Model to be used in the fireEvent() method.
     *
     *  - optionally set a the $trackingEventModel property
     *  - useful for using a different model in the trackingEvent than the resolved/saved model
     *
     * @param  EloquentModel|null  $model
     * @return Model|EloquentModel
     */
    protected function trackingEventModel(EloquentModel $model = null): EloquentModel
    {
        if (isset($model)) {
            $this->trackingEventModel = $model;
        }

        return $this->trackingEventModel ?? $this->model;
    }

    /**
     * Determine if the TrackingEvent was fired.
     *
     * @return bool
     */
    protected function wasTrackingEventFired(): bool
    {
        return $this->trackingEventWasFired;
    }

    /**
     * Set the $trackingEvent the default provided by the config file if null.
     *
     * @return bool
     */
    private function setTrackingEventFromConfig(): bool
    {
        // Set the $trackingEvent using the config
        if (! isset($this->trackingEvent)) {
            $this->trackingEvent = config('crud-model-actions.event');

            return true;
        }

        // Don't change
        else {
            return false;
        }
    }
}
