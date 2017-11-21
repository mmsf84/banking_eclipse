<?php
namespace App\BankAccount\Application\dto;

use \JsonSerializable;

class BankAccountDto implements JsonSerializable
{
    private $id;
    private $number;
    private $balance;
    private $isLocked;
    private $customer;
    
    public function __construct()
    {
        
    }
    
    public function jsonSerialize()
    {
        return [
            'Cuenta' => $this->number,
            'Saldo' => $this->balance,
            'Cliente' => $this->customer
        ];
    }
    
    
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $number
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return the $balance
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @return the $isLocked
     */
    public function getIsLocked()
    {
        return $this->isLocked;
    }

    /**
     * @return the $customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param field_type $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param field_type $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @param field_type $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * @param field_type $isLocked
     */
    public function setIsLocked($isLocked)
    {
        $this->isLocked = $isLocked;
    }

    /**
     * @param field_type $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    
    
}