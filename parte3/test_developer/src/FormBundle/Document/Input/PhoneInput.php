<?php

namespace FormBundle\Document\Input;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 23/05/2018
 * Time: 6:55 AM
 */
class PhoneInput
{
    protected $phone;

    public function __construct($phone)
    {
        $this->phone = $phone;
        $this->convert();
        return $this->phone;
    }

    public function convert()
    {
        if (!is_numeric($this->phone)) {
            throw new BadRequestHttpException("El numero telefónico no es válido.");
        }
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->phone;
    }
}