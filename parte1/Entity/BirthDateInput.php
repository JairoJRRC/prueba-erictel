<?php
/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 23/05/2018
 * Time: 2:11 AM
 */

class BirthDateInput
{
    public $birthDate;

    /**
     * BirthDateInput constructor.
     * @param $birthDate
     * @throws Exception
     */
    public function __construct($birthDate)
    {
        $this->birthDate = $birthDate;
        $this->convert();
        return $this->birthDate;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function convert()
    {
        $date = $this->validateFormatDate($this->birthDate);
        $dt = new DateTime($date);
        $this->birthDate = $dt->format('U');
    }

    /**
     * @param $birthDate
     * @return string
     * @throws Exception
     */
    public function validateFormatDate($birthDate)
    {
        try {
            $values = explode('/', $birthDate);
            if (count($values) == 3 && checkdate($values[1], $values[0], $values[2])) {
                return sprintf('%s-%s-%s', $values[2], $values[1], $values[0]);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }


}
