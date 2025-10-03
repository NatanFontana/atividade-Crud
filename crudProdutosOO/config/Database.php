<?php
class Database {
    private $host = "143.106.241.4";
    private $banco = "CrudSeries2";
    private $username = "cl203219";
    private $password = "cl*25052007";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
        $this->conn = new PDO("mysql:host=$this->host;dbname=$this->banco;charset=utf8", 
                                          $this->username, $this->password);

            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
