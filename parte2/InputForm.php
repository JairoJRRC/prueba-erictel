<?php

class InputForm
{

    public $name;
    public $lastName;
    public $city;
    public $email;
    public $cellphone;
    public $birthDate;

    function __construct(
        $name,
        $lastName,
        $city,
        $email,
        $cellphone,
        $birthDate
    ) {
        $this->name = utf8_encode($name);
        $this->lastName = utf8_encode($lastName);
        $this->city = $city;
        $this->email = $this->validateEmail($email);
        $this->cellphone = $this->validateCellPhone($cellphone);
        $this->birthDate = $this->validateBirthDate($birthDate);
    }

    public function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            var_dump("correo mal");
            exit;
        }

        return $email;
    }

    public function validateCellPhone($cellphone)
    {
        if (!is_numeric($cellphone)) {
            var_dump("celular mal");
            exit;
        }

        return $cellphone;
    }

    public function validateBirthDate($birthDate)
    {
        $date = $this->validateFormatDate($birthDate);
        $dt = new DateTime($date);
        return $dt->format('U');
    }

    public function validateFormatDate($birthDate)
    {
        $values = explode('/', $birthDate);
        if (count($values) == 3 && checkdate($values[1], $values[0], $values[2])) {
            return sprintf('%s-%s-%s', $values[2], $values[1], $values[0]);
        }
        var_dump("validateFormatDate mal");
        exit;
    }
}

?> 