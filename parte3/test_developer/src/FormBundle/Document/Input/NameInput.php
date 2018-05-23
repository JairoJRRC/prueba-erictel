<?php

namespace FormBundle\Document\Input;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 23/05/2018
 * Time: 6:54 AM
 */
class NameInput
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
        $this->validate();
        return $this->name;
    }

    public function validate()
    {
        if (empty($this->name)) {
            throw new BadRequestHttpException("El nombre es requerido.");
        }
        if (!preg_match("/^\w+$/i", $this->name)) {
            throw new BadRequestHttpException("El nombre no es válido.");
        }
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->name;
    }
}