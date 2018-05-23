<?php
/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 23/05/2018
 * Time: 2:19 AM
 */

interface UserRepository
{
    public function getAll();
    public function find($id);
    public function insert(UserEntity $user);
    public function update(UserEntity $user);
    public function delete($id);
}