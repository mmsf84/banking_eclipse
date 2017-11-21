<?php
namespace App\BankAccount\Domain\services;

use App\BankAccount\Domain\model\BankAccount;
use App\BankAccount\Domain\exceptions\InvalidTransferBankAccountException;
use App\BankAccount\Domain\exceptions\SameTransferBankAccountException;
use App\BankAccount\Domain\repository\BankAccountRepository;

class TransferDomainService {
    
    private $bankAccountRepository;
	
	public function __construct()
    {
		
    }
	
    public function setBankAccountRepository($bankAccountRepository)
    {
        $this->bankAccountRepository = $bankAccountRepository;
    }

    public function performTransfer(BankAccount $originAccount, BankAccount $destinationAccount, $amount)
	{
		$this->validateData($originAccount, $destinationAccount, $amount);
		$originAccount->withdrawMoney($amount);
		$destinationAccount->depositMoney($amount);
	}

	private function validateData(BankAccount $originAccount, BankAccount $destinationAccount, $amount)
	{
		if (empty($originAccount) || empty($destinationAccount)) {
			throw new InvalidTransferBankAccountException();
		}
		if ($originAccount->getNumber() == $destinationAccount->getNumber()) {
			throw new SameTransferBankAccountException();
		}
	}
	
	public function performTransferFake($amount)
	{
	    $originAccount = $this->bankAccountRepository->getFakeAccountOrigen();
	    $destinationAccount = $this->bankAccountRepository->getFakeAccountDestino();
	    $this->validateData($originAccount, $destinationAccount, $amount);
	    $originAccount->withdrawMoney($amount);
	    $destinationAccount->depositMoney($amount);
	    $saldoOrigen = $originAccount->getBalance();
	    $saldoDestino = $destinationAccount->getBalance();
	    
	    $cuentas = array();
	    array_push($cuentas, $originAccount);
	    array_push($cuentas, $destinationAccount);
	    //echo "Nuevo saldo del origen: $saldoOrigen ";
	    //echo "Nuevo saldo del destino: $saldoDestino ";
	    return $cuentas;
	    
	}
}