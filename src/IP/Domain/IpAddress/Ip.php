<?php

namespace Webites\SimpleCaptcha\Ip\Domain\IpAddress;

class Ip
{
    private string $ip = '';

    public function __construct()
    {
        if(empty($_SESSION['real_ip_address'])) {
            $this->updateIp( true );
        }

        $this->validate();
    }

    public function updateIp( bool $force = false )
    {
        if ($force) {
            $this->ip = $this->getPublicIP();
            $_SESSION['real_ip_address'] = $this->ip;
        }

        return $this;
    }

    public function validate()
    {
        if (!filter_var($this->ip, FILTER_VALIDATE_IP)) {
            throw new \InvalidArgumentException('Invalid IP address');
        }
        return $this;
    }

    public function getIp() : string
    {
        return $this->ip;
    }

    public function getPublicIP() {
        $output = file_get_contents("https://httpbin.org/ip");

        $ip = json_decode($output, true);

        return $ip['origin'];
    }

    public function getInfoAboutIp(
        string $ip
    ): array {
        $about = file_get_contents('https://ipwho.is/'.$ip);

        return json_decode($about, true);
    }
}
