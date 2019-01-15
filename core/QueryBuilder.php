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
        
        $this->config = require_once 'conf.php';
        $this->pdo = Connection::make($this->config["database"]);

    }

    public function selectAll($conditions = ['created_at '=>' IS NOT NULL'], $limits=''){

        $query= sprintf("SELECT * FROM {$this->table} WHERE %s", implode(' and ', array_keys($conditions)));
        $query = $query . $limits;
        //print $query;
        $statement = $this->pdo->prepare($query);
        $statement->execute(array_values($conditions));
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
            $e->getMessage() ;
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
            $query = "DELETE FROM {$this->table} where id=?";
            $statement = $this->pdo->prepare($query);
            $statement->execute([$id]);
            print $query;
         }catch(PDOException $e)
         {
            echo $e->getMessage();
         }

     }

     public function count()
     {
         try
         {
            $query = "SELECT COUNT(*) FROM {$this->table}";
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            $result = $statement->fetch();
            return $result[0];

         }catch(PDOException $e)
         {
             echo $e->getMessage();
         }
     }

     //public function join($table)
}