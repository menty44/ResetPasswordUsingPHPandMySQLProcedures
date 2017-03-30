<?php

/**
 * @author Nicholas N. Chege
 * @copyright 2015
 */

class Database{
    private $connection;
    private static $instance;
    public function __construct(){
        try{
            $this->connection = new PDO("mysql:host=localhost;dbname=phppot_examples", "root", "");
            
        }catch(PDOException $e){
            echo "connection error:".$e->getMessage();
        }
    }
    public function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function getConnection(){
        return $this->connection;
    }

}

?>
