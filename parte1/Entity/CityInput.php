<?php
/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 23/05/2018
 * Time: 2:10 AM
 */

class CityInput
{
    public $city;

    public function __construct($city)
    {
        $this->city = $city;
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }
}