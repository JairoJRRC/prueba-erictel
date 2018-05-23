<?php

include ('Entity/UserRepository.php');
include ('Entity/UserEntity.php');

/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 23/05/2018
 * Time: 12:19 AM
 */
class ConnectMongoDB implements UserRepository
{
    const DATABASE = 'erictel';
    const COLLECTION = 'usuarios_datos';
    const CONNECTION = 'mongodb://localhost:27017';


    protected $manager;
    protected $bulkWrite;
    protected $writeConcern;

    public function __construct()
    {
        $this->manager = new MongoDB\Driver\Manager(self::CONNECTION);
        $this->bulkWrite = new MongoDB\Driver\BulkWrite;
        foreach ($this->getData() as $doc) {
            $this->bulkWrite->insert($doc);
        }
        $this->writeConcern = new MongoDB\Driver\WriteConcern(
            MongoDB\Driver\WriteConcern::MAJORITY, 1000
        );
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
                'email' => '',
                'cellphone' => '',
                'birth_date' => ''
            ],
            [
                'name' => 'ADRIANA GIRALDO',
                'last_name' => 'GOMEZ',
                'city' => 'Afghanistan',
                'email' => '',
                'cellphone' => '',
                'birth_date' => ''
            ],
            [
                'name' => 'ADRIANA MARCELA',
                'last_name' => 'SALCEDO SEGURA',
                'city' => 'Angola',
                'email' => '',
                'cellphone' => '',
                'birth_date' => ''
            ],
            [
                'name' => 'ALEXANDER  DUARTE',
                'last_name' => 'SANDOVAL',
                'city' => 'Anguilla',
                'email' => '',
                'cellphone' => '',
                'birth_date' => ''
            ],
            [
                'name' => 'ALCIRA SANTANILLA',
                'last_name' => 'CARVAJAL',
                'city' => 'Albania',
                'email' => '',
                'cellphone' => '',
                'birth_date' => ''
            ],
            [
                'name' => 'AMPARO MONTOYA',
                'last_name' => 'MONTOYA',
                'city' => 'Andorra',
                'email' => '',
                'cellphone' => '',
                'birth_date' => ''
            ],
            [
                'name' => 'ANA MARIA',
                'last_name' => 'LOZANO SANTOS',
                'city' => 'Netherlands',
                'email' => '',
                'cellphone' => '',
                'birth_date' => ''
            ],
        ];
    }

    /**
     * @return array
     * @throws \MongoDB\Driver\Exception\Exception
     */
    public function getAll()
    {
        $result = [];
        $query = new MongoDB\Driver\Query([], [
            'sort' => ['_id' => -1],
        ]);
        $cursor = $this->manager->executeQuery($this->getNameSpaceConnection(), $query);
        foreach ($cursor as $doc) {
            $user = new UserEntity();
            $user->setId($doc->_id);
            $user->setName($doc->name);
            $user->setLastName($doc->last_name);
            $user->setCity($doc->city);
            $user->setEmail($doc->email);

            $result[] = $user;
        }

        return $result;
    }

    /**
     * @param $id
     * @return UserEntity
     * @throws \MongoDB\Driver\Exception\Exception
     */
    public function find($id)
    {
        $query = new MongoDB\Driver\Query(
            ['_id' => new MongoDB\BSON\ObjectID($id)], []);
        $cursor = $this->manager->executeQuery($this->getNameSpaceConnection(), $query);

        $user = new UserEntity();

        foreach ($cursor as $doc) {

            $user->setId($doc->_id);
            $user->setName($doc->name);
            $user->setLastName($doc->last_name);
            $user->setCity($doc->city);
            $user->setEmail($doc->email);
        }

        return $user;
    }

    /**
     * @param UserEntity $user
     * @return int|null
     */
    public function insert(UserEntity $user)
    {
        $this->bulkWrite->insert($user->getArrayParams());

        $writeDoc = new MongoDB\Driver\WriteConcern(
            MongoDB\Driver\WriteConcern::MAJORITY, 1000
        );
        $result = $this->manager->executeBulkWrite($this->getNameSpaceConnection(), $this->bulkWrite, $writeDoc);

        return $result->getInsertedCount();
    }

    /**
     * @param UserEntity $user
     * @return int|null
     */
    public function update(UserEntity $user)
    {
        $this->bulkWrite->update(['_id' => new MongoDB\BSON\ObjectID(
            $user->getId())],
            ['$set' => $user->getArrayParams()],
            ['multi' => false, 'upsert' => false]
        );

        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        $result = $this->manager->executeBulkWrite($this->getNameSpaceConnection(), $this->bulkWrite, $writeConcern);
        return $result->getModifiedCount();
    }

    /**
     * @param $id
     * @return int|null
     */
    public function delete($id)
    {
        $this->bulkWrite->delete(['_id' => new MongoDB\BSON\ObjectID($id)], ['limit' => 1]);
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        $result = $this->manager->executeBulkWrite($this->getNameSpaceConnection(), $this->bulkWrite, $writeConcern);
        return $result->getDeletedCount();
    }
}