<?php
require_once "config/Database.php";
require_once "classes/Serie.php";

$database = new Database();
$db = $database->getConnection();

$serie = new Serie($db);

if (isset($_GET['id'])) {
    $produto->id = $_GET['id'];
    $stmt = $db->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->execute([$produto->id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_POST) {
    $produto->id = $_POST['id'];
    $produto->nome = $_POST['nome'];
    $produto->preco = $_POST['preco'];

    if ($produto->update()) {
        echo "Produto atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD Produtos</title>
</head>
<body>
<h1>Edição de Produtos</h1>
<hr>
<a href="index.php">Home</a>
<hr>
<form method="post">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    Nome:<br>
    <input type="text" name="nome" value="<?= $row['nome'] ?>" required><br><br>

    Preço:<br><input type="number" step="0.01" name="preco" value="<?= $row['preco'] ?>" required><br><br>
    
    <input type="submit" value="Atualizar">
</form>
</body>
</html>