<?php
// Configurações do banco de dados
$host = '143.106.241.4';
$dbname = 'CrudSerie';
$user = 'cl203219';
$pass = 'cl*25052007';

try {
    // Conexão com o banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Captura os dados do formulário
    $nome = $_POST['nome'] ?? '';
    $genero = $_POST['genero'] ?? '';
    $data_lancamento = $_POST['data_lancamento'] ?? '';

    // Validação simples
    if (empty($nome) || empty($genero) || empty($data_lancamento)) {
        die("Por favor, preencha todos os campos.");
    }

    // Prepara a query de inserção
    $stmt = $pdo->prepare("INSERT INTO series (nome, genero, data_lancamento) VALUES (:nome, :genero, :data_lancamento)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':genero', $genero);
    $stmt->bindParam(':data_lancamento', $data_lancamento);

    // Executa a query
    if ($stmt->execute()) {
        echo "Série cadastrada com sucesso!";
    } else {
        echo "Erro ao cadastrar a série.";
    }

} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>