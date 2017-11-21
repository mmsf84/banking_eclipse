<?php
namespace App\BankAccount\Application\dto;

use \JsonSerializable;

class BankTransferDto implements JsonSerializable
{
    private $originAccount;
    private $destinyAccount;
    private $amount;

    public function jsonSerialize()
    {
        return [
            'originAccount' => $this->originAccount,
            'destinyAccount' => $this->destinyAccount,
            'amount' => $this->amount
        ];
    }

    public function setOriginAccount($originAccount)
    {
        $this->originAccount = $originAccount;
    }

    public function setDestinyAccount($destinyAccount)
    {
        $this->destinyAccount = $destinyAccount;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }
    public function getOriginAccount()
    {
        return $this->originAccount;
    }

    public function getDestinyAccount()
    {
        return $this->destinyAccount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    
}