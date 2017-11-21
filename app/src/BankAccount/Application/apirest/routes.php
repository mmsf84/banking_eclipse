<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Books\Application\BookResponseDto;

try{
    $bancaApplicationService = $app->getContainer()->get('banca_application_service');
    if(empty($bancaApplicationService)){
        throw new Exception("IoC...");
    }
    $appInstanceDto = $bancaApplicationService
    
}catch(){

}