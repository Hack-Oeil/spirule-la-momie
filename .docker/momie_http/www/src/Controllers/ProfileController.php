<?php

namespace App\Controllers;

use App\Models\MessageModel;
use App\Models\ServerModel;
use App\Models\UserModel;
use App\Utils\FlashBag;
use App\Utils\VulnOpener;
use \Exception;

class ProfileController extends AbstractController
{
    public function showProfile()
    {
        $this->denyIfNotLog();

        $serverModel = new ServerModel();
        $userServer = $serverModel->getServerByUser($this->getLoggedUser()['id']);

        $messageModel = new MessageModel();
        $messages = $messageModel->getUserMessages($this->getLoggedUser()['id']);

        $userModel = new UserModel();
        $users = $userModel->getStdUsers();

        VulnOpener::renderXssView('profile', [
            'userServer' => $userServer,
            'messages' => $messages,
            'users' => $users
        ]);
    }

    public function showNewMessage()
    {
        $this->denyIfNotLog();
        $this->renderView('newMessage');
    }

    public function checkNewMessage()
    {
        $this->denyIfNotLog();
        try
        {
            if(
                !isset($_POST['email']) || empty($_POST['email']) ||
                !isset($_POST['message']) || empty($_POST['message'])
            )
            {
                throw new Exception('Tous les champs sont obligatoires');
            }

            $userModel = new UserModel();
            $receiver = $userModel->getUserByEmail($_POST['email']);

            if( !$receiver )
            {
                throw new Exception('Le propriétaire de cet email n\'utilise pas nos services.');
            }

            $messageModel = new MessageModel();
            $messageModel->addMessage([
                'sendBy' => $this->getLoggedUser()['id'],
                'receivedBy' => $receiver['id'],
                'content' => $_POST['message']
            ]);

            if($receiver && $receiver['email'] === $_ENV['VICTIM_EMAIL'])
            {
                $client = new \WebSocket\Client("ws://botserver:8282");
                $client->text(json_encode([
                    "host" => 'http://webserver',
                    "actions" => [
                        [
                            'url'       => 'http://webserver/login',
                            'script'    => '
                                document.querySelector("#email").value = "'.$_ENV['VICTIM_EMAIL'].'";
                                document.querySelector("#password").value = "'.$_ENV['VICTIM_PASSWORD'].'";
                                document.querySelector("#submit_login").click(); 
                            '
                        ],
                        [
                            "url" => 'http://webserver/account'
                        ]
                    ],
                ]));
            }

            FlashBag::set( 'Le message a bien été envoyé.', 'success');
            $this->redirectTo('/account');
        }
        catch( Exception $e )
        {
            FlashBag::set( $e->getMessage(), 'error');
            $this->redirectTo('/new-message');
        }
    }
}