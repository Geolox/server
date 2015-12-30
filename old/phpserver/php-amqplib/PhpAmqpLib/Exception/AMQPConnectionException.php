<?php

require_once('php-amqplib/PhpAmqpLib/Exception/AMQPException.php');

class AMQPConnectionException extends AMQPException
{
    public function __construct($reply_code, $reply_text, $method_sig)
    {
        parent::__construct($reply_code, $reply_text, $method_sig);
    }
}