<?php
/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 23/05/2018
 * Time: 2:11 AM
 */

class CellPhoneInput
{
    public $phone;

    /**
     * CellPhoneInput constructor.
     * @param $phone
     * @throws Exception
     */
    public function __construct($phone)
    {
        $this->phone = $phone;
        $this->convert();
        return $this->phone;
    }

    /**
     * @throws Exception
     */
    public function convert()
    {
        if (!is_numeric($this->phone)) {
            throw new \Exception('El telefono indicado no es numérico.');
        }
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

}