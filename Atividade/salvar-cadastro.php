<?php
// Faz conexão com o banco de dados
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'] ?? '';
    $genero = $_POST['genero'] ?? '';
    $data_lancamento = $_POST['data_lancamento'] ?? null;

    if (!empty($nome) && !empty($genero) && $data_lancamento !== null) {
            try {
                $sql = "INSERT INTO CrudSerie (nome, genero, data_lancamento)
                VALUES (:nome, :genero, :data_lancamento)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':genero', $genero);
                $stmt->bindParam(':data_lancamento', $data_lancamento);
                $stmt->execute();

                // Redireciona de volta para a pagina inicial
                header("Location: atividade.php");
                exit;
            
        } catch (PDOException $e) {
            echo "<p>Erro ao cadastrar: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>Todas as informações são orbigatórias.</p>";
    }
}
?>