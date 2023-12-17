<?php

namespace App\Models;

class MessageModel extends Database
{
    public function addMessage($data)
    {
        parent::addOne('messages', $data);
    }

    public function getUserMessages($userId)
    {
        $query = $this->getDb()->prepare('SELECT content, firstname as senderFirstname, lastname as senderLastname FROM messages 
            INNER JOIN users ON users.id = sendBy WHERE receivedBy = ? ORDER BY messages.id DESC');
        $query->execute([$userId]);
        return $query->fetchAll();
    }

}