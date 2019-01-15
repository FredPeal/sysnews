<?php 

namespace App\Models;

use App\Core\QueryBuilder;

class User extends QueryBuilder 
{
    protected $table = "users";

    public function auth($name,$pass)
    {
        $query = "SELECT password from users where name=?";
        $statement = $this->pdo->prepare($query);
        $statement->execute([$name]);
        $result = $statement->fetch();
        if($result != null)
        {
            if(password_verify($pass,$result['password']))
            {
                return true;
            }else 
            {
                echo 'false';
            }
        }else
        {
            echo 'Usuario incorrecto';
        }
    }

    public function getID($name)
    {
        try
        {
            $query = "select id from users where name=?";
            $statement = $this->pdo->prepare($query);
            $statement->execute([$name]);
            $result = $statement->fetch();
            //var_dump($result);
            return $result["id"];

        }catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }

}