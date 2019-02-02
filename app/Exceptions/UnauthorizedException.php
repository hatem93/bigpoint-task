<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedException extends Exception
{
    protected $message;

    public function __construct($message){
        $this->message = $message;

    }

    public function getUnauthorizedMessage(){
        return $this->message;
    }

}