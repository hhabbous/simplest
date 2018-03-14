<?php

namespace Simplest\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package Simplest\Controller
 */
class DefaultController
{
    /**
     * @return Response
     */
    public function index()
    {
        return new Response("Hello World!");
    }
}