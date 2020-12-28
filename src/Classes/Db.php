<?php


namespace App\Classes;

use PDO;
class Db
{

    private $dbHost = 'localhost';
    private $dbName = 'chatterbox';
    private $dbUser = 'root';
    private $dbPass = '';

    public function connect() {
        $dsn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
        try{
            $conn = new PDO($dsn,$this->dbUser,$this->dbPass);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $conn;
        }catch(\PDOException $e) {
            die('Connection failed ' . $e);
        }
    }
}