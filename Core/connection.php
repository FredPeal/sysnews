<?php 

class Connection 
{
    public static function make()
    {
        $config = require 'Core/conf.php';
       // var_dump($config['database']["host"]);
        try {
            return new PDO($config['database']['host'].";".$config['database']['name'],$config['database']['user'],$config['database']['pass']);

        }catch(Exception $e) {
            echo $e->getMessage();
        }
    }
}