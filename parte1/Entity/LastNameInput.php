<?php
/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 23/05/2018
 * Time: 2:10 AM
 */

class LastNameInput
{
    public $lastName;

    public function __construct($lastName)
    {
        $this->lastName = $lastName;
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }
}