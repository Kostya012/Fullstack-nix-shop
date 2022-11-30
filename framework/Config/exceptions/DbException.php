<?php

namespace framework\Config\exceptions;

use framework\Components\BaseMethods;

class DbException extends \Exception
{
    use BaseMethods;

    protected mixed $messages;

    public function __construct(string $message = "", int $code = 0)
    {
        parent::__construct($message, $code);
        $this->messages = include 'messages.php';
        $error = $this->getMessage() ? $this->getMessage() : $this->messages[$this->getCode()];
        $error .= "\n" . 'file ' . $this->getFile() . "\n" . 'in line ' . $this->getLine() . "\n";

        // rewrite the message for the user
//        if ($this->messages[$this->getCode()]) {
//            $this->message = $this->messages[$this->getCode()];
//        }
        $this->writeLog($error, 'db_log.txt');
    }
}
