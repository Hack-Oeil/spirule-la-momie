<?php

namespace App\Controllers;

use App\Utils\FlashBag;
use App\Utils\VulnOpener;

class PublicController extends AbstractController
{
    public function showHome()
    {
        $this->renderView('home');
    }

    public function showReport()
    {
        $this->renderView('bugReport');
    }

    public function checkReport()
    {
        try
        {
            if( !isset($_POST['url']) || empty($_POST['url']) )
            {
                throw new \Exception('Le champs ne peut etre vide');
            }
            if( !str_starts_with($_POST['url'], 'http://localhost')  )
            {
                throw new \Exception('Désolé, Bobby ne s\'occupe que de notre site.');
            }
            $client = new \WebSocket\Client("ws://botserver:8282");
            $client->text(json_encode([
                "host" => 'http://webserver',
                "actions" => [
                    [
                        'url'       => 'http://webserver/login',
                        'script'    => '
                            document.querySelector("#email").value = "'.$_ENV['ADMIN_EMAIL'].'";
                            document.querySelector("#password").value = "'.$_ENV['ADMIN_PASSWORD'].'";
                            document.querySelector("#submit_login").click(); 
                        '
                    ],
                    [
                        "url" => $_POST['url']
                    ]
                ],
            ]));
        }
        catch(\Exception $e)
        {
            FlashBag::set( $e->getMessage(), 'error');
        }

        FlashBag::set( 'Merci. Bobby va vérifier le bug signalé !', 'success');
        $this->redirectTo('/report-bug');
    }

    public function showSearch()
    {
    //        $this->renderView('search');
        VulnOpener::renderXssView('search', [
            'searchTerm' => isset($_GET['search']) && !empty($_GET['search']) ? $_GET['search'] : null
        ]);
    }

//    public function showSearchResults()
//    {
//        VulnOpener::renderXssView('searchResults', [
//            'searchTerm' => $_POST['search']
//        ]);
//    }
}