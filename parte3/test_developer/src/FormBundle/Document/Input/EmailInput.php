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
class EmailInput
{
    protected $email;

    public function __construct($email)
    {
        $this->email = $email;
        $this->validateEmail();
        return $this->email;

    }

    public function validateEmail()
    {
        if (empty($this->email)) {
            return new JsonResponse(['message' => "El email es requerido."] , 400);
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return new JsonResponse(['message' => "El email no es válido."] , 400);
        }
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->email;
    }
}