<?php

namespace FormBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use FormBundle\Document\Input\EmailInput;
use FormBundle\Document\Input\MessageInput;
use FormBundle\Document\Input\NameInput;
use FormBundle\Document\Input\PhoneInput;

/**
 * @MongoDB\Document
 */
class DataForm
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $name;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $email;

    /**
     * @MongoDB\Field(type="int")
     */
    protected $phone;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $message;

    /**
     * @param NameInput $name
     * @param EmailInput $email
     * @param PhoneInput $phone
     * @param MessageInput $message
     * @param null $id
     * @return DataForm
     */
    public static function create(NameInput $name, EmailInput $email, PhoneInput $phone, MessageInput $message, $id = null)
    {
        $obj = new DataForm();
        $obj->id = $id;
        $obj->name = $name->get();
        $obj->email = $email->get();
        $obj->phone = $phone->get();
        $obj->message = $message->get();
        return $obj;
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
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }


}
