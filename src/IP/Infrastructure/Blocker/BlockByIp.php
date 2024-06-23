<?php

namespace Webites\SimpleCaptcha\IP\Infrastructure\Blocker;

use JetBrains\PhpStorm\NoReturn;
use Webites\SimpleCaptcha\Application\Infrastructure\Blocker\BlockerInterface;
use Webites\SimpleCaptcha\Ip\Domain\IpAddress\Ip;

class BlockByIp implements BlockerInterface
{
    private string $ip;

    public function __construct()
    {
        if(empty($_SESSION['real_ip_address'])) {
            $_SESSION['real_ip_address'] = ( new Ip() )
                ->updateIp( true )
                ->getIp();
        }

        $this->ip = $_SESSION['real_ip_address'];
    }

    public function filter(array|string $data): bool
    {
        if(is_string($data)) {
            $data = [$data];
        }
        foreach ($data as $ip) {
            if ($ip === $this->ip) {
                $this->block();
            }
        }

        return false;
    }

    #[NoReturn]
    public function block(): void
    {
        header('HTTP/1.1 403 Forbidden');
        exit();
    }
}
