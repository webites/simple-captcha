<?php

declare(strict_types=1);

namespace Webites\SimpleCaptcha\Application\Infrastructure\Blocker;

interface BlockerInterface
{
    public function filter( array|string $data ) : bool;

    public function block() : void;
}
