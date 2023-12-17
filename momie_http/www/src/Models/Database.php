<?php

namespace App\Models;

use \PDO;

abstract class Database
{
    private static $_dbConnect;

    private static function setDb()
    {
        self::$_dbConnect = new PDO( 'mysql:host='. $_ENV['DB_HOST'] .';dbname='. $_ENV['DB_NAME'] .';charset=utf8', $_ENV['DB_USER'], $_ENV['DB_PASSWORD'] );
        self::$_dbConnect->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
    }

    protected function getDb()
    {
        if( self::$_dbConnect == null )
        {
            self::setDb();
        }

        return self::$_dbConnect;
    }

    protected function getAll( string $table )
    {
        $query = $this->getDb()->prepare( "SELECT * FROM $table" );
        $query->execute();

        return $query->fetchAll();
    }

    protected function getOne( $table, $condition, $value )
    {
        $query = $this->getDb()->prepare( "SELECT * FROM $table WHERE $condition = ?" );
        $query->execute( [$value] );
        return $query->fetch();
    }

    protected function getBy( $table, $condition, $value )
    {
        $query = $this->getDb()->prepare( "SELECT * FROM $table WHERE $condition = ?" );
        $query->execute( [$value] );
        return $query->fetchAll();
    }

    protected function addOne( $table, $data )
    {
        $reqValues = '';
        $reqColumns = '';
        foreach( $data as $key => $value )
        {
            $reqValues .= ":$key,";
            $reqColumns .= "$key,";
        }

        $reqValues = substr( $reqValues, 0, -1 );
        $reqColumns = substr( $reqColumns, 0, -1 );

        $query = $this->getDb()->prepare( "INSERT INTO $table ( $reqColumns ) VALUES ( $reqValues )" );
        $query->execute( $data );
    }

    protected function updateOne( $table, $newData, $condition, $uniq )
    {
        $sets = '';

        foreach( $newData as $key => $value )
        {
            $sets .= "$key = :$key,";
        }

        $sets = substr( $sets, 0, -1 );

        $query = $this->getDb()->prepare( "UPDATE $table SET $sets WHERE $condition = :$condition" );

        foreach( $newData as $key => $value )
        {
            $query->bindvalue( ":$key", $value );
        }

        $query->bindvalue( ":$condition", $uniq );

        $query->execute();
    }

    protected function deleteOne( $table, $condition, $value )
    {
        $query = $this->getDb()->prepare( "DELETE FROM " . $table . " WHERE " . $condition . " = ?" );
        $query->execute( [ $value ] );
        $query->closeCursor();
    }
}