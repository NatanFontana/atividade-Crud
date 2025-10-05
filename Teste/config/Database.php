<?php
// config/Database.php
class Database {
    private $host = "143.106.241.4";
    private $banco = "CrudSeries2";
    private $username = "cl203219";
    private $password = "cl*25052007";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
            ];
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->banco};charset=utf8mb4",
                $this->username,
                $this->password,
                $options
            );
        } catch(PDOException $exception) {
            // lança exceção para o caller tratar (mais seguro em dev)
            throw new Exception("Erro de conexão: " . $exception->getMessage());
        }
        return $this->conn;
    }
}
