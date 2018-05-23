<?php
/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 23/05/2018
 * Time: 3:15 AM
 */
include_once(realpath(dirname(__FILE__)  . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . "ConnectMongoDB.php");
include_once(realpath(dirname(__FILE__)  . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . "Entity/UserRepository.php");
include_once(realpath(dirname(__FILE__)  . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . "Entity/UserEntity.php");
include_once(realpath(dirname(__FILE__)  . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . "Entity/NameInput.php");
include_once(realpath(dirname(__FILE__)  . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . "Entity/LastNameInput.php");
include_once(realpath(dirname(__FILE__)  . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . "Entity/CityInput.php");
include_once(realpath(dirname(__FILE__)  . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . "Entity/EmailInput.php");
include_once(realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . "Entity/CellPhoneInput.php");
include_once(realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . "Entity/BirthDateInput.php");

class UserController implements UserRepository
{
    protected $mongoDB;

    public function __construct()
    {
        $this->mongoDB = new ConnectMongoDB();
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
        $cursor = $this->mongoDB->manager->executeQuery($this->mongoDB->getNameSpaceConnection(), $query);
        foreach ($cursor as $doc) {
            $user = new UserEntity();
            $user->setId($doc->_id);
            $user->setName($doc->name);
            $user->setLastName($doc->last_name);
            $user->setCity($doc->city);
            $user->setEmail($doc->email);
            $user->setCellphone($doc->cellphone);
            $user->setBirthDate($doc->birth_date);

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
        $cursor = $this->mongoDB->manager->executeQuery($this->mongoDB->getNameSpaceConnection(), $query);

        $user = new UserEntity();

        foreach ($cursor as $doc) {

            $user->setId($doc->_id);
            $user->setName($doc->name);
            $user->setLastName($doc->last_name);
            $user->setCity($doc->city);
            $user->setEmail($doc->email);
            $user->setCellphone($doc->cellphone);
            $user->setBirthDate($doc->birth_date);
        }

        return $user;
    }

    /**
     * @param UserEntity $user
     * @return int|null
     */
    public function insert(UserEntity $user)
    {
        $this->mongoDB->bulkWrite->insert($user->getArrayParams());
        $result = $this->mongoDB->manager->executeBulkWrite($this->mongoDB->getNameSpaceConnection(),
            $this->mongoDB->bulkWrite, $this->mongoDB->writeConcern);

        return $result->getInsertedCount();
    }

    /**
     * @param UserEntity $user
     * @return int|null
     */
    public function update(UserEntity $user)
    {
        $this->mongoDB->bulkWrite->update([
            '_id' => new MongoDB\BSON\ObjectID(
                $user->getId())
        ],
            ['$set' => $user->getArrayParams()],
            ['multi' => false, 'upsert' => false]
        );

        $result = $this->mongoDB->manager->executeBulkWrite($this->mongoDB->getNameSpaceConnection(),
            $this->mongoDB->bulkWrite, $this->mongoDB->writeConcern);
        return $result->getModifiedCount();
    }

    /**
     * @param $id
     * @return int|null
     */
    public function delete($id)
    {
        $this->mongoDB->bulkWrite->delete(['_id' => new MongoDB\BSON\ObjectID($id)], ['limit' => 1]);
        $result = $this->mongoDB->manager->executeBulkWrite($this->mongoDB->getNameSpaceConnection(),
            $this->mongoDB->bulkWrite, $this->mongoDB->writeConcern);
        return $result->getDeletedCount();
    }
}