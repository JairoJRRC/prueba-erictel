<?php
/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 23/05/2018
 * Time: 2:10 AM
 */

class NameInput
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}