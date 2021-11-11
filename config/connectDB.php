<?php


//Conexión hacia la BD
class connectDB
{

    private $connect;

    public function __construct()
    {
        $connectionString = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";.DB_CHARSET."; //*
        try {
            $this->connect = new PDO($connectionString, DB_USER, DB_PASSWORD);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->connect = 'Connection error';
            echo "ERROR: " . $e->getMessage();
        }
    }

    public function connect()
    {
        return $this->connect;
    }
}
