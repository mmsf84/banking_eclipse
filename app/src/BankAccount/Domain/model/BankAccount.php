<?php
namespace App\BankAccount\Domain\model;

use App\BankAccount\Domain\model\Customer;


class BankAccount
{
    protected $id;
    protected $number;
    protected $balance;
    protected $isLocked;
    protected $customer;

    public function __construct($id, $number, $balance, $isLocked, Customer $customer)
    {
        $this->id = $id;
        $this->number = $number;
        $this->balance = $balance;
        $this->isLocked = $isLocked;
        $this->customer = $customer;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function getIsLocked()
    {
        return $this->isLocked;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    public function setIsLocked($isLocked)
    {
        $this->isLocked = $isLocked;
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function whiteList()
    {
        return [
            'number'
        ];
    }
    
    public function withdrawMoney($amount){
        
        if ($this->canBeWithdrawed($amount)) {
            echo "CannotWithdrawException()";
        }
        $this->setBalance($this->getBalance() - $amount);
    }
    
    public function depositMoney($amount){
        
        if ($this->getIsLocked() == 1) {
            echo "CannotDepositException()";
        }
        $this->setBalance($this->getBalance() + $amount);
    }
    
    public function canBeWithdrawed($amount) {
        $bloqueado = false;
        $fondos = false;
        
        if ($this->getIsLocked() == 1) {
            $bloqueado = true;
        }   
        
        if($this->getBalance() >= $amount){
            $fondos = true;
        }
        
        return $bloqueado && $fondos;
    }
    
}