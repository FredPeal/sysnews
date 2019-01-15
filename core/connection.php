<?php 
namespace App\Core;

class Connection 
{
    public static function make()
    {
        $config = require 'conf.php';
        try {
            $db = new \PDO($config['database']['host'].";".$config['database']['name'],$config['database']['user'],$config['database']['pass'],$config["database"]["options"]);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $db;

        }catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}