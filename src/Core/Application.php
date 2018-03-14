<?php

namespace Simplest\Core;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Matcher\UrlMatcher;

/**
 * Class Application
 * @package Simplest\Core
 */
class Application
{

    /**
     * @var UrlMatcher
     */
    private $urlMatcher;
    /**
     * @var ControllerResolver
     */
    private $controllerResolver;
    /**
     * @var ArgumentResolver
     */
    private $argumentResolver;


    /**
     * Application constructor.
     * @param UrlMatcher $urlMatcher
     * @param ControllerResolver $controllerResolver
     * @param ArgumentResolver $argumentResolver
     */
    public function __construct(
        UrlMatcher $urlMatcher,
        ControllerResolver $controllerResolver,
        ArgumentResolver $argumentResolver
    ) {
        $this->urlMatcher = $urlMatcher;
        $this->controllerResolver = $controllerResolver;
        $this->argumentResolver = $argumentResolver;
    }

    /**
     * @param Request $request
     * @return mixed|Response
     */
    public function handle(Request $request)
    {
        try {
            $request->attributes->add($this->urlMatcher->match($request->getPathInfo()));
            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);
            $response = call_user_func_array($controller, $arguments);
        } catch (\Exception $e) {
            $response = new Response($e->getMessage(), 404);
        }
        return $response;
    }
}