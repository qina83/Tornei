<?php

namespace App\Security\Domain\Exception;

class CredenzialiErrateException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Credenziali errate');
    }
}
