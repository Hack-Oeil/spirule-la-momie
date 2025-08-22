<?php

namespace App\Utils;

class FlashBag
{
    /**
     * Enregistrement d'un message
     *
     * @param string message à afficher
     * @param string type success | warning | error
     */
    public static function set(string $message, string $type = 'success'):void
    {
        $_SESSION['flashbag'] = [
            'message' => $message,
            'type'  => $type
        ];
    }

    /**
     * Retourne le message et le type de message se trouvant dans
     * la session flash (tableau vide si pas de message)
     *
     * @return array
     */
    public static function get():array
    {
        if (!empty($_SESSION['flashbag']) && is_array($_SESSION['flashbag'])) {
            $return = $_SESSION['flashbag'];
            unset($_SESSION['flashbag']);
            return $return;
        }
        return [];
    }
}