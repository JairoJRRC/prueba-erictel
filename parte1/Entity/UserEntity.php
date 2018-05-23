<?php

/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 23/05/2018
 * Time: 2:07 AM
 */
class UserEntity
{
    protected $id;
    protected $name;
    protected $lastName;
    protected $city;
    protected $email;
    protected $cellphone;
    protected $birthDate;

    /**
     * @param $id
     * @param NameInput $name
     * @param LastNameInput $lastName
     * @param CityInput $city
     * @param EmailInput $email
     * @param CellPhoneInput $cellphone
     * @param BirthDateInput $birthDate
     * @return UserEntity
     */
    public static function create(
        NameInput $name,
        LastNameInput $lastName,
        CityInput $city,
        EmailInput $email,
        CellPhoneInput $cellphone,
        BirthDateInput $birthDate,
        $id = null
    ) {
        $object = new UserEntity();
        $object->id = $id;
        $object->name = $name->getName();
        $object->lastName = $lastName->getLastName();
        $object->city = $city->getCity();
        $object->email = $email->getEmail();
        $object->cellphone = $cellphone->getPhone();
        $object->birthDate = $birthDate->getBirthDate();
        return $object;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getCellphone()
    {
        return $this->cellphone;
    }

    /**
     * @param mixed $cellphone
     */
    public function setCellphone($cellphone)
    {
        $this->cellphone = $cellphone;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    public function getArrayParams()
    {
        return [
            'name' => $this->getName(),
            'last_name' => $this->getLastName(),
            'city' => $this->getCity(),
            'email' => $this->getEmail(),
            'cellphone' => $this->getCellphone(),
            'birth_date' => $this->getBirthDate()
        ];
    }

    public function getBirthDateFormat()
    {
        $mes = $this->getMonth()[date("n", $this->birthDate)-1];
        return ($mes . date(" j \d\\e Y", $this->birthDate));
    }

    /**
     * @param $date
     * @return false|string
     */
    public function changeFormat($date) {
        return gmdate("d/m/Y", $date);
    }

    public function getMonth()
    {
        return ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
    }
}