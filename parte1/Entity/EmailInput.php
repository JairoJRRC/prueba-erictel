<?php
/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 23/05/2018
 * Time: 2:10 AM
 */

class EmailInput
{
    public $email;

    /**
     * EmailInput constructor.
     * @param $email
     * @throws Exception
     */
    public function __construct($email)
    {
            $this->email = $email;
            $this->validateEmail();
            return $this->email;
    }

    /**
     * @throws Exception
     */
    public function validateEmail()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('El correo no es válido.');
        }
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
}