<?php

require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(ROOT);

//Controller
$router->namespace("Source\App");

//Home
$router->group(null);

$router->get("/", "Web:home");
$router->get("/BubbleSort", "Web:bubbleSort");
$router->get("/Fatorial", "Web:fatorial");
$router->get("/Multiplos", "Web:multiplos");

$router->group("Veiculos");
$router->get("/", "Web:veiculos");

//erros
$router->group("ooops");
$router->get("/{errcode}", "Web:error");

$router->dispatch();

if($router->error()){
    $router->redirect("/ooops/{$router->error()}");
}