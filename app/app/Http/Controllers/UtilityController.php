<?php

namespace App\Http\Controllers;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class UtilityController
{

    /**
    * Function for get user ip address
    *
    * @return string ip address
    */
    public static function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    /**
    * Logging function
    *
    * @param string $type type of logg to create
    * @param array $message ( text, action ) text and action of message
    * @return void
    */
    public static function info_logging($type, $message) {
      $orderLog = new Logger($type);
      $orderLog->pushHandler(new StreamHandler(storage_path('logs/'.$type.'.log')), Logger::INFO);
      $orderLog->info($message['action'] . " ## ". $message['text']);
    }
}
