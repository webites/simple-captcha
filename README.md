# PHP Simple Captcha tools

Lightweight library for filter and block spam bots with simple captcha.
You can add captcha to your form, middleware or any other place in your project.

## Installation

```
composer require webites/simple-captcha
```

## Usage

You have any options to use this library.

### Block by IP

Use class `BlockByIp` to filter IP addresses.
This method automatically block user with 403 status code.

```
use Webites\SimpleCaptcha\IP\Infrastructure\Blocker\BlockByIp;

( new BlockByIp() )
    ->filter(['10.10.10.10', '10.10.10.11']);
```
