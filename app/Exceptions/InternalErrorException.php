<?php

namespace App\Exceptions;

use Exception;

class InternalErrorException extends Exception
{
    protected $message;

    public function __construct($message){
        $this->message = $message;
    }

    public function getInternalErrorMessage(){
        return $this->message;
    }

}