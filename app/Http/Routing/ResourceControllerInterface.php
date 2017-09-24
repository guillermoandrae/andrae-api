<?php

namespace App\Http\Routing;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

interface ResourceControllerInterface
{
    const ERROR_UNAUTHORIZED = 'Not allowed.';

    const ERROR_NOT_FOUND = 'Resource not found.';

    const ERROR_NO_CONTENT = 'Missing content.';

    /**
     * @param Request $request The HTTP request.
     * @return Response
     */
    public function search(Request $request);

    /**
     * @param Request $request The HTTP request.
     * @return Response
     */
    public function create(Request $request);

    /**
     * @param mixed $id The resource ID.
     * @param Request $request The HTTP request.
     * @return Response
     */
    public function read($id, Request $request);
}
