<?php 
namespace App\Core;

class Connection 
{
    public static function make()
    {
        $config = require 'conf.php';
        try {
            return new \PDO($config['database']['host'].";".$config['database']['name'],$config['database']['user'],$config['database']['pass'],$config["database"]["options"]);

        }catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}