<?php

namespace App\Controllers;

use App\Models\MessageModel;
use App\Models\UserModel;
use App\Utils\FlashBag;
use \Exception;

class AuthController extends AbstractController
{
    public function showRegister()
    {
        $this->renderView('register');
    }

    public function handleRegister()
    {
        try {

            if(
                !isset($_POST['firstname']) || empty($_POST['firstname']) ||
                !isset($_POST['lastname']) || empty($_POST['lastname']) ||
                !isset($_POST['email']) || empty($_POST['email']) ||
                !isset($_POST['password']) || empty($_POST['password'])
            )
            {
                throw new Exception('Tous les champs sont obligatoires.');
            }

            $userModel = new UserModel();
            $userModel->addUser([
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
                'role' => 'user'
            ]);

            $newUser = $userModel->getUserByEmail($_POST['email']);

            $messageModel = new MessageModel();
            $messageModel->addMessage([
                'sendBy' => 1,
                'receivedBy' => $newUser['id'],
                'message' => 'Bienvenue chez MCH ! Amusez vous bien sur nos serveurs FTP !'
            ]);
        }
        catch( Exception $e )
        {
            FlashBag::set( $e->getMessage(), 'error');
            $this->redirectTo('/register');
        }
        FlashBag::set( 'Inscription réussie. Vous pouvez vous connecter.', 'success');
        $this->redirectTo('/login');
    }

    public function showLogin()
    {
        $this->renderView('login');
    }

    public function checkLogin()
    {
        try
        {
            if(
                !isset($_POST['email']) || empty($_POST['email']) ||
                !isset($_POST['password']) || empty($_POST['password'])
            )
            {
                throw new Exception('Tous les champs sont obligatoires.');
            }

            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($_POST['email']);

            if( !$user )
            {
                throw new Exception('L\'email ou le mot de passe sont incorrects.');
            }

            if( !password_verify( $_POST['password'], $user['password'] ) )
            {
                throw new Exception('L\'email ou le mot de passe sont incorrects.');
            }

            $_SESSION['userId'] = $user['id'];
            $_SESSION['userFirstname'] = $user['firstname'];
            $_SESSION['userLastname'] = $user['lastname'];
            $_SESSION['userEmail'] = $user['email'];
            FlashBag::set( 'Connexion réussie.', 'success');
            $this->redirectTo('/account');
        }
        catch( Exception $e )
        {
            FlashBag::set( $e->getMessage(), 'error');
            $this->redirectTo('/login');
        }
    }

    public function logout()
    {
        session_destroy();
        FlashBag::set( 'Déconnexion réussie.', 'success');
        $this->redirectTo('/login');
    }
}