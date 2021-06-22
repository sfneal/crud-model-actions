<?php

namespace Sfneal\CrudModelActions\Tests\Feature;

use Illuminate\Support\Facades\Config;
use Sfneal\CrudModelActions\Tests\Assets\Events\MockTrackingEvent;
use Sfneal\CrudModelActions\Tests\TestCase;

class ConfigTest extends TestCase
{
    /** @test */
    public function event_default()
    {
        $output = config('crud-model-action.event');

        $this->assertNull($output);
    }

    /** @test */
    public function event_with_setting()
    {
        $key = 'crud-model-action.event';
        $expected = MockTrackingEvent::class;
        Config::set($key, $expected);
        $output = config($key);

        $this->assertIsString($output);
        $this->assertTrue(class_exists($output));
        $this->assertEquals($expected, $output);
    }
}
