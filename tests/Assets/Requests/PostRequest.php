<?php

namespace Sfneal\CrudModelActions\Tests\Assets\Requests;

use Illuminate\Http\Request;

trait PostRequest
{
    /**
     * Create a Request to be used in test methods.
     *
     * @param array $headers
     * @param array $parameters
     * @param array $cookies
     * @param array $files
     * @param array $server
     * @param null $content
     * @return Request
     */
    public function createRequest(array $headers = [],
                                  array $parameters = [],
                                  array $cookies = [],
                                  array $files = [],
                                  array $server = [],
                                  $content = null): Request
    {
        $request = Request::create('/', 'POST', $parameters, $cookies, $files, $server, $content);

        foreach ($headers as $header => $value) {
            $request->headers->set($header, $value);
        }

        return $request;
    }
}
