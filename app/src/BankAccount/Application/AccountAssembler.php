<?php
namespace App\BankAccount\Application;

use App\BankAccount\Application\dto\BankAccountDto;

class AccountAssembler
{
    public function toDto($cuenta)
    {
        if (empty($cuenta)) {
            return null;
        }
        $cuentaDto = new BankAccountDto();
        $cuentaDto->setNumber($cuenta->getNumber());
        $cuentaDto->setBalance($cuenta->getBalance());
        
        if (empty($cuenta->getCustomer())) {
            return $cuentaDto;
        }
        $cuentaDto->setCustomer($cuenta->getCustomer()->getFirstname());
        return $cuentaDto;
    }
}