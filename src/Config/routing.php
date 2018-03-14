<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routeCollection = new RouteCollection();

$routeCollection->add("index",
    new Route("/", ["_controller" => "Simplest\Controller\DefaultController::index"]));

return $routeCollection;