<?php

namespace App\Models;

class UserModel extends Database
{
    public function addUser($data)
    {
        parent::addOne('users', $data);
    }

    public function getUserByEmail($email)
    {
        return parent::getOne('users', 'email', $email);
    }

    public function getStdUsers()
    {
        $query = $this->getDb()->prepare('SELECT firstname, lastname, email FROM users WHERE role = "user"');
        $query->execute();
        return $query->fetchAll();
    }
}