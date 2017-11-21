<?php
namespace App\Action;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\BankAccount\Application\BankTransferApplicationService;
use App\BankAccount\Application\dto\BankTransferDto;
use App\BankAccount\Application\dto\BankAccountResponseDto;

final class HomeAction
{
    private $view;
    private $logger;
    private $appTransferService;

    public function __construct(Twig $view, LoggerInterface $logger, 
        BankTransferApplicationService $appTransferService)
    {
        $this->view = $view;
        $this->logger = $logger;
        $this->appTransferService = $appTransferService;
    }
    
    public function dispatch(Request $request, Response $response, $args)
    {
        $this->logger->info("Home page action dispatched");
        
        $this->view->render($response, 'home.twig');
        return $response;
    }
    
    public function propio(Request $request, Response $response, $args) 
    {
        $name = $request->getAttribute('name');
        $response->getBody()->write("Hello, $name");
        $this->view->render($response, 'home.twig');
        return $response;
    }
    
    public function transferencia(Request $request, Response $response, $args)
    {
        $origen = $request->getAttribute('origen');
        $destino = $request->getAttribute('destino');
        $monto = $request->getAttribute('monto');
        
        $dto = new BankTransferDto();
        $dto->setOriginAccount($origen);
        $dto->setDestinyAccount($destino);
        $dto->setAmount($monto);
        
        $resultado = $this->appTransferService->performTransfer($dto);
        $cuentaResponseDto = new BankAccountResponseDto();
        $cuentaResponseDto->setCuentas($resultado);        
        return $response->withJson($cuentaResponseDto, 200, JSON_UNESCAPED_UNICODE);
        
        //$response->getBody()->write("Hello, $origen y $destino  ");
        //$this->view->render($response, 'home.twig');
        //return $response->withJson($dto, 200, JSON_UNESCAPED_UNICODE);
        //return $response->withJson($resultado, 200, JSON_UNESCAPED_UNICODE);
    }
}
