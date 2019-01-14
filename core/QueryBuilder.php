<?php 

namespace App\Core;

class QueryBuilder 
{
    protected $config;
    protected $table;
    protected $pdo;
    protected $primary = "id";
 
    public function __construct()
    {
        
        $this->config = require 'conf.php';
        $this->pdo = Connection::make($this->config["database"]);

    }

    public function selectAll(){
        ///try {

        // }
        $query="SELECT * FROM {$this->table}";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_OBJ);
        return $result;
    }

    public function find($id)
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE {$this->primary}={$id}";
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }catch(Exception $e){
            $e->getMessage();
        }

    }

    public function create($array)
    {
        $query = sprintf("INSERT INTO {$this->table}(%s) VALUES(%s)", implode(', ',array_keys($array)), "'" . implode("', '",$array)."'"); 
        try 
        {
            $statement=$this->pdo->prepare($query);
            $statement->execute($array);
            //print $query;

        }catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        
    }

    public function update($array,$id)
    {
        try 
        {
            $query = sprintf("UPDATE {$this->table} set %s where id = {$id}", implode(' = ? , ',array_keys($array)) . ' = ?' );
            var_dump($query);
            $statement = $this->pdo->prepare($query)->execute(array_values($array));

        }catch(PDOException $e)
        {
            echo $e->getMessage();

        }

     }

     public function delete($id)
     {
         try
         {
            $query = "DELETE FROM users where id=?";
            $statement = $this->pdo->prepare($query);
            $statement->execute([$id]);

         }catch(PDOException $e)
         {
            echo $e->getMessage();
         }

     }
    //public function join($table)
}