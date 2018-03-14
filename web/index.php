<?php

require_once "../vendor/autoload.php";

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Simplest\Core\Application;

$request = Request::createFromGlobals();
$routes = include_once "../src/Config/routing.php";

$requestContext = new RequestContext();
$requestContext->fromRequest($request);

$matcher = new UrlMatcher($routes, $requestContext);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$app = new Application($matcher, $controllerResolver, $argumentResolver);

$response = $app->handle($request);

$response->send();




