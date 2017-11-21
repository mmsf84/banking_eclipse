<?php
namespace App\BankAccount\Application;

use App\BankAccount\Application\dto\BankAccountDto;
use App\BankAccount\Domain\services\TransferDomainService;
use App\BankAccount\Application\AccountAssembler;

class BankTransferApplicationService
{
    private $transferDomainService;

    public function __construct($transferDomainService)
    {
        $this->transferDomainService = $transferDomainService;
    }

    public function performTransfer($bankTransferDto)
    {   
        $cuentasDto = array();
        $resultado = $this->transferDomainService->performTransferFake($bankTransferDto->getAmount());
        foreach ($resultado as $tmp) {
            $accountAssembler = new AccountAssembler();
            $cuentaDto = $accountAssembler->toDto($tmp);
            array_push($cuentasDto, $cuentaDto);
        }
        return $cuentasDto;
    }

    /*public function getAppInstanceInfo()
    {
        $instanceIndex = isset($_ENV['CF_INSTANCE_INDEX']) ? $_ENV['CF_INSTANCE_INDEX'] : "";
        $instanceIP = isset($_ENV['CF_INSTANCE_IP']) ? $_ENV['CF_INSTANCE_IP'] : "";
        $appInstanceDto = new AppInstanceDto();
        $appInstanceDto->setIndex($instanceIndex);
        $appInstanceDto->setIp($instanceIP);
        return $appInstanceDto;
    }*/
}