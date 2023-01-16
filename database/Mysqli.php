<?php
namespace Database;
class Mysqli{

    private $connection;


    function connect():self{
        $this->connection = new \mysqli('173.30.0.3','root','toor','kplgoogle');
        if ($this->connection->connect_errno) {
            exit($this->connection->error);
        }
        return $this;
    }

    function query(string $query):self{
        $this->query = $query;
        return $this;
    }
    function escape(string $string):string{
        return $this->connection->real_escape_string($string);
    }
    function execute(){
        $result =  $this->connection->query($this->query);
        if (!$result) {
            exit($this->connection->error);
        }
        $data = [];
        if($result===true){
            return null;
        }
        if($result){
            while ($row =$result->fetch_assoc() ) {
                $data[] = array_values(array_map(function($data){
                    return (string)$data;
                },(array)$row));
            }
        }
        
        
        $result->free();
        return $data;
    }
    function disconnect():void{
        $this->connection->close();
    }
}
