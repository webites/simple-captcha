<?php

namespace Webites\SimpleCaptcha\Ip\Domain\IpAddress;

class Ip
{
    private string $ip;

    public function __construct()
    {
        $this->updateIp();
        $this->validate();
    }

    public function updateIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }

        $this->ip = $ip;

        return $this;
    }

    public function validate()
    {
        if (!filter_var($this->ip, FILTER_VALIDATE_IP)) {
            throw new \InvalidArgumentException('Invalid IP address');
        }
        return $this;
    }
}
