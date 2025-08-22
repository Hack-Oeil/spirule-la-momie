<?php

namespace App\Controllers;

use App\Models\ServerModel;
use App\Models\UserModel;
use App\Utils\FlashBag;
use \Exception;
use Countable;
class FTPController extends AbstractController
{
    private $hasFTP = false;
    public function __construct() {
        $this->denyIfNotLog();
        $serverModel = new ServerModel();
        if($serverModel->getServerByUser($this->getLoggedUser()['id'])) {
            $this->hasFTP = true;
        }
    }

    public function showFtp()
    {
        $items = null;
        if($this->hasFTP !== true) $this->redirectTo('/login');

        if($this->isFtpAccessGranted()) {            
            // /home/klupin/black_market_catalog.zip
            $ftp = new \FtpClient\FtpClient();
            $ftp->connect($_SESSION['ftp_host']);
            $ftp->login($_SESSION['ftp_user'], $_SESSION['ftp_password']);
            $items = $ftp->scanDir('.', true);
        }
        // fonction de tri de l'ensemble des fichiers si FTP très fourni
        $this->renderView('ftp', [
            'items' => $items
        ]);
      
    }

    public function downloadFile()
    {
        if($this->hasFTP !== true) $this->redirectTo('/login');
        if($this->isFtpAccessGranted()) {
            try {
                $file = str_replace('../', '', $_GET['file']);
                $file = str_replace('./', '', $file);
                $XplodedFile = explode('/', $file);
                $filename = end($XplodedFile);
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition', 'attachment; filename='.$filename);
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                echo file_get_contents('ftp://'.$_SESSION['ftp_user'].':'.$_SESSION['ftp_password'].'@'.$_ENV['FTP_HOST'].'/home/'.$_SESSION['ftp_user'].'/'.$file);
            }
            catch( \Error $err )
            {
                FlashBag::set( $err->getMessage(), 'error');
                $this->redirectTo('/ftp');
            }
        }
    }

    public function checkFtpLogin()
    {
        if($this->hasFTP !== true) $this->redirectTo('/login');
        try {
            if(
                !isset( $_POST['ftp_host'] ) || empty( $_POST['ftp_host'] ) &&
                !isset( $_POST['ftp_port'] ) || empty( $_POST['ftp_port'] ) &&
                !isset( $_POST['ftp_user'] ) || empty( $_POST['ftp_user'] ) &&
                !isset( $_POST['ftp_password'] ) || empty( $_POST['ftp_password'] )
            )
            {
                throw new Exception('Tous les champs doivent être completés.');
            }
            if( $_POST['ftp_host'] !== $_ENV['FTP_HOST'] )
            {
                throw new Exception('Hôte inconnu');
            }
            if( $_POST['ftp_port'] !== $_ENV['FTP_PORT'] )
            {
                throw new Exception('Port non pris en charge');
            }
            $authenticatedUser = $this->getLoggedUser();
            if(
                strtolower( mb_substr($authenticatedUser['firstname'], 0, 1).$authenticatedUser['lastname'] ) !== $_POST['ftp_user'] ||
                mb_substr(md5( $authenticatedUser['email'] ), 0, 16) !== $_POST['ftp_password']
            )
            {
                throw new Exception('Identifiants incorrects');
            }
            $serverModel = new ServerModel();
            $userServer = $serverModel->getServerByUser($authenticatedUser['id']);
            if( !$userServer )
            {
                throw new Exception('Souscrivez à une offre pour acceder à un server FTP.');
            }
            $_SESSION['MCH-FTP-GRANTED'] = true;
            $_SESSION['ftp_host'] = $_POST['ftp_host'];
            $_SESSION['ftp_user'] = $_POST['ftp_user'];
            $_SESSION['ftp_password'] = $_POST['ftp_password'];
            $this->redirectTo('/ftp');
        }
        catch( Exception $e )
        {
            FlashBag::set( $e->getMessage(), 'error');
            $this->redirectTo('/ftp');
        }
    }

    protected function isFtpAccessGranted()
    {
        if( !$_SESSION || !array_key_exists('MCH-FTP-GRANTED', $_SESSION)  )
        {
            return false;
        }
        return true;
    }
}