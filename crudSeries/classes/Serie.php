<?php
class Serie {
    private $conn;
    private $table_name = "CrudSeries2";

    public $id;
    public $nome;
    public $sinopse;
    public $genero;
    public $data_lancamento;

    public function __construct($db) {
        $this->conn = $db;
    }

    // CREATE
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (nome, genero, data_lancamento) VALUES (:nome, :genero, :data_lancamento)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":genero", $this->genero);
        $stmt->bindParam(":data_lancamento", $this->data_lancamento);

        return $stmt->execute();
    }

    // READ
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // UPDATE
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nome = :nome, genero = :genero, data_lancamento = :data_lancamento WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":genero", $this->genero);
        $stmt->bindParam(":data_lancamento", $this->data_lancamento);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // DELETE
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }
}
