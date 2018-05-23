<?php

/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 23/05/2018
 * Time: 12:19 AM
 */
class ConnectMongoDB
{
    const DATABASE = 'erictel';
    const COLLECTION = 'usuarios_datos';
    const CONNECTION = 'mongodb://localhost:27017';

    public $manager;
    public $bulkWrite;
    public $writeConcern;

    public function __construct()
    {
        $this->manager = new MongoDB\Driver\Manager(self::CONNECTION);
        $this->bulkWrite = new MongoDB\Driver\BulkWrite;
        $this->writeConcern = new MongoDB\Driver\WriteConcern(
            MongoDB\Driver\WriteConcern::MAJORITY, 1000
        );
        $this->addDataDefault();
    }

    public function addDataDefault()
    {
        foreach ($this->getData() as $doc) {
            $this->bulkWrite->insert($doc);
        }
        $this->manager->executeBulkWrite($this->getNameSpaceConnection(), $this->bulkWrite, $this->writeConcern);
    }

    public function getNameSpaceConnection()
    {
        return sprintf('%s.%s', self::DATABASE,self::COLLECTION);
    }

    public function getData()
    {
        return [
            [
                'name' => 'ADRIANA PAOLA',
                'last_name' => 'CUJAR ALARCON',
                'city' => 'Aruba',
                'email' => 'adrian@hotmail.com',
                'cellphone' => 963852147,
                'birth_date' => 1513123463
            ],
            [
                'name' => 'ADRIANA GIRALDO',
                'last_name' => 'GOMEZ',
                'city' => 'Afghanistan',
                'email' => 'giraldo@hotmail.com',
                'cellphone' => 654321987,
                'birth_date' => 881971463
            ],
            [
                'name' => 'ADRIANA MARCELA',
                'last_name' => 'SALCEDO SEGURA',
                'city' => 'Angola',
                'email' => 'marcella@hotmail.com',
                'cellphone' => 987654321,
                'birth_date' => 533865863
            ],
            [
                'name' => 'ALEXANDER  DUARTE',
                'last_name' => 'SANDOVAL',
                'city' => 'Anguilla',
                'email' => 'duarte@hotmail.com',
                'cellphone' => 456852654,
                'birth_date' => 912557063
            ],
            [
                'name' => 'ALCIRA SANTANILLA',
                'last_name' => 'CARVAJAL',
                'city' => 'Albania',
                'email' => 'santanilla@hotmail.com',
                'cellphone' => 126546258,
                'birth_date' => 533865863
            ],
            [
                'name' => 'AMPARO MONTOYA',
                'last_name' => 'MONTOYA',
                'city' => 'Andorra',
                'email' => 'montoya@hotmail.com',
                'cellphone' => 951845213,
                'birth_date' => 533865863
            ],
            [
                'name' => 'ANA MARIA',
                'last_name' => 'LOZANO SANTOS',
                'city' => 'Netherlands',
                'email' => 'lozano123@hotmail.com',
                'cellphone' => 987654321,
                'birth_date' => 912557063
            ],
        ];
    }


}