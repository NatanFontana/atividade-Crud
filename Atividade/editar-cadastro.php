<?php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome-editar'] ?? '';
    $genero = $_POST['genero-editar'] ?? '';
    $data_lancamento = $_POST['data_lancamento-editar'] ?? null;
    $id = $_POST['id-editar'] ?? null;

    if($id !== null) {
        try {
            
        }
    }
}
?>