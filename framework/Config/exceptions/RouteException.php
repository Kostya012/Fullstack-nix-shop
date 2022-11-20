<?php

namespace framework\Config\exceptions;

use framework\Components\BaseMethods;

class RouteException extends \Exception
{
    use BaseMethods;

    protected $message;

    public function __construct(string $message = "", int $code = 0)
    {
        parent::__construct($message, $code);
        $this->message = include 'messages.php';
    }
}
