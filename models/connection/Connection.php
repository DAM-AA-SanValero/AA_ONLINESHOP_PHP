<?php
require_once 'Database.php';
class Connection{

private $connection;

    public function connect()
    {
        if (!$this->connection) {
            try {
                $this->connection = new PDO("mysql:host=".HOST.";dbname=".DBNAME, USER, PASS);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $exception) {
                die("Error de conexión: " . $exception->getMessage());
            }
        }
        return $this->connection;
    }

    public function prepare($query) {
        return $this->connection->prepare($query);
    }

    public function disconnect() {
        $this->connection = null;
    }

}

//Probar conexión
/*
$conn = new Connection();
if($result = $conn->connect()){
  echo 'Conexión exitosa';
}*/


