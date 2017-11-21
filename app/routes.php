<?php
// Routes
use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/', 'App\Action\HomeAction:dispatch')
    ->setName('homepage');

$app->get('/hello/{name}','App\Action\HomeAction:propio')
    ->setName('Inicio');
    
$app->get('/hello/{name}/{lastname}','App\Action\HomeAction:propiodos')
    ->setName('Inicio');

$app->get('/transfer/{origen}/{destino}/{monto}','App\Action\HomeAction:transferencia')
    ->setName('Inicio');