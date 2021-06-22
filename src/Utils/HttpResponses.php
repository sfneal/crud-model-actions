<?php

namespace Sfneal\CrudModelActions\Utils;

trait HttpResponses
{
    /**
     * @var string Response to be returned on success
     */
    private $successResponse;

    /**
     * Return the default success response.
     *
     * @param string|null $response
     * @return string
     */
    protected function successResponse(string $response = null): string
    {
        // Set the response during runtime
        if (isset($response)) {
            $this->successResponse = $response;
        }

        // Redirect back to previous page
        return $this->successResponse ?? redirect()->back();
    }
}
