<?php
class Database {
    
    private $hostname = 'localhost';
    private $user = 'postgres';
    private $password = 'tralala';
    private $database = 'divus';
    private $db;
    
    public function __construct() {
        $this->connect();
    }
    
    public function __destruct(){
        $this->db = null;
    }
    
    private function connect(){
    
        try {
            $this->db = new PDO("pgsql:host=$this->hostname;dbname=$this->database", $this->user, $this->password);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        
    }
    
    public function queryAll($sql){
        
        $sth = $this->db->prepare($sql);
        $sth->execute();        
        return $sth->fetchAll();        
        
    }
    
    public function queryOne($sql){
        
        $sth = $this->db->prepare($sql);
        $sth->execute();
        return $sth->fetch();       
        
    }    
    
    public function execute($sql){
        return $this->db->exec($sql);
    }
}
