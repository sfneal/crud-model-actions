<?php


namespace Sfneal\CrudModelActions\Utils;


use Illuminate\Database\Eloquent\Model;
use Sfneal\Models\AbstractModel;

trait ModelEvents
{
    /**
     * @var string Model Tracking Event to fire
     */
    protected $trackingEvent;

    /**
     * @var AbstractModel|Model
     */
    private $trackingEventModel;

    /**
     * @var bool Determine if the TrackingEvent was fired
     */
    private $trackingEventWasFired;

    /**
     * Fire the trackingEvent
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
     * Retrieve the Model to be used in the fireEvent() method
     *
     *  - optionally set a the $trackingEventModel property
     *  - useful for using a different model in the trackingEvent than the resolved/saved model
     *
     * @param Model|null $model
     * @return AbstractModel|Model
     */
    protected function trackingEventModel(Model $model = null): Model
    {
        if (isset($model)) {
            $this->trackingEventModel = $model;
        }

        return $this->trackingEventModel ?? $this->model;
    }

    /**
     * Determine if the TrackingEvent was fired
     *
     * @return bool
     */
    protected function wasTrackingEventFired(): bool
    {
        return $this->trackingEventWasFired;
    }
}
