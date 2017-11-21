<?php
namespace App\BankAccount\Application\dto;

use \JsonSerializable;

class BankAccountResponseDto implements JsonSerializable
{
    private $cuentas;
    
    public function __construct()
    {
        
    }    
    
    public function jsonSerialize()
    {
        return [
            'Cuentas' => $this->cuentas
        ];
    }
    
    public function setCuentas($cuentas)
    {
        $this->cuentas = $cuentas;
    }

    
    
}