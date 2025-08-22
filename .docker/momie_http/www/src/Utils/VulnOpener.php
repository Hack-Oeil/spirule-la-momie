<?php

namespace App\Utils;

use App\Models\Database;

class VulnOpener extends Database
{
    public static function renderXssView( $view, $data = [] )
    {
        extract( $data );

        include_once dirname(__DIR__) . '/Views/template.php';
    }

    protected function getAllVulnSql( string $table )
    {
        $query = $this->getDb()->execute( "SELECT * FROM $table" );
        return $query->fetchAll();
    }

    protected function getOneVulnSQL( $table, $condition, $value )
    {
        $query = $this->getDb()->execute( "SELECT * FROM $table WHERE $condition = $value" );
        return $query->fetch();
    }
}