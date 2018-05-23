<?php

namespace FormBundle\Document\Input;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 23/05/2018
 * Time: 6:55 AM
 */
class MessageInput
{
    protected $msg;

    public function __construct($msg)
    {
        $this->msg = $msg;
        $this->validate();
        return $this->msg;
    }


    public function validate()
    {
        $this->msg = filter_var ( $this->msg, FILTER_SANITIZE_STRING);

        if(strlen($this->msg) > 1000) {
            throw new BadRequestHttpException('El mensaje no debe ser mayor de 1000 caracteres.');
        }
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->msg;
    }
}