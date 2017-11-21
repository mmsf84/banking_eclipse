<?php
namespace BankAccount\Application\dto;

use \JsonSerializable;

class AppInstanceDto implements JsonSerializable
{
    private $index;
    private $ip;

    public function jsonSerialize()
    {
        return [
            'index' => $this->index,
            'ip' => $this->ip
        ];
    }

    public function setIndex($index)
    {
        $this->index = $index;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }
}