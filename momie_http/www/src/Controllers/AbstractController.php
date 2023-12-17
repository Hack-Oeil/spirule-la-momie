<?php

namespace App\Controllers;

use App\Models\UserModel;

abstract class AbstractController
{
    protected function renderView( $view, $data = [] )
    {
        foreach ($data as $key => $value)
        {
            if( gettype($value) === 'string' ) {
                $data[$key] = htmlspecialchars( strip_tags($value) );
            }
        }
        extract( $data );

        include_once dirname(__DIR__) . '/Views/template.php';
    }

    protected function redirectTo( $path )
    {
        header("Location: $path");
        exit();
    }

    protected function getLoggedUser()
    {
        $loggedUser = null;
        if( array_key_exists('userEmail', $_SESSION) )
        {
            $userModel = new UserModel();
            $loggedUser = $userModel->getUserByEmail($_SESSION['userEmail']);
        }
        return $loggedUser;
    }

    protected function denyIfNotLog()
    {
        if( !$this->getLoggedUser() )
        {
            $this->redirectTo('/login');
        }
    }

    protected function denyIfNotAdmin()
    {
        $loggedUser = $this->getLoggedUser();
        if( !$loggedUser || $loggedUser['role'] !== 'admin' )
        {
            $this->redirectTo('/login');
        }
    }
}