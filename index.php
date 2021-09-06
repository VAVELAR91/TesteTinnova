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

$router->group("Veiculos");
$router->get("/", "Web:veiculos");
$router->get("/{id}", "Web:findVeiculosById", "web.findVeiculosById");
$router->get("/find", "Web:findVeiculos", "web.findVeiculos");
$router->Post("/", "Web:postVeiculo", "web.postVeiculo");
$router->Delete("/", "Web:deleteVeiculo", "web.deleteVeiculo");

$router->group("Fatorial");
$router->get("/", "Web:fatorial");
$router->Post("/Resultado", "Web:getFatorial", "web.getFatorial");

$router->group("Multiplos");
$router->get("/", "Web:multiplos");
$router->Post("/Resultado", "Web:getMultiplos", "web.getMultiplos");

//erros
$router->group("ooops");
$router->get("/{errcode}", "Web:error");

$router->dispatch();

if($router->error()){
    $router->redirect("/ooops/{$router->error()}");
}