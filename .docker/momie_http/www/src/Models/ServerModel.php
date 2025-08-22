<?php

namespace App\Models;

class ServerModel extends Database
{
    public function getAllServers()
    {
        return $this->getAll('servers');
    }
    public function getServerByUser($id)
    {
        return $this->getOne('servers', 'user', $id);
    }
}