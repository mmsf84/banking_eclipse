<?php
namespace App\BankAccount\Infrastructure\repository\fake;

use App\BankAccount\Domain\repository\BankAccountRepository;
use App\BankAccount\Domain\model\BankAccount;
use App\BankAccount\Domain\model\Customer;

class BankAccountFakeRepository implements BankAccountRepository
{
    public function __construct()
    {
    }
    
    public function getFakeAccountOrigen()
    {
        $cuenta = new BankAccount(1001, "C0001", 5800, 0, new Customer(7878, "Mario", "Santos"));
        return $cuenta;
    }
    
    public function getFakeAccountDestino()
    {
        $cuenta = new BankAccount(1002, "C0002", 500, 0, new Customer(7777, "Juan Pablo", "Barrios"));
        return $cuenta;
    }

}