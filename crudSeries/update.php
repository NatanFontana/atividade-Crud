<?php
require_once "config/Database.php";
require_once "classes/Serie.php";

$database = new Database();
$db = $database->getConnection();

$serie = new Serie($db);

if (isset($_GET['id'])) {
    $serie->id = $_GET['id'];
    $stmt = $db->prepare("SELECT * FROM CrudSeries2 WHERE id = ?");
    $stmt->execute([$serie->id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_POST) {
    $serie->id = $_POST['id'];
    $serie->nome = $_POST['nome'];
    $serie->genero = $_POST['genero'];
    $serie->data_lancamento = $_POST['data_lancamento'];

    if ($serie->update()) {
        echo "Serie atualizada com sucesso!";
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
    <input type="text" name="nome" value="<?= $row['nome'] ?>"><br><br>

    Gênero: <br>
    <select name="genero">
        <option><?= $row['genero'] ?></option>
        <option>Ação</option>
        <option>Drama</option>
        <option>Comédia</option>
        <option>Suspense</option>
    </select><br><br>

    Data de Lançamento:<br>
    <input type="date" name="data_lancamento" value="<?= $row['data_lancamento']?>"><br><br>
    
    <input type="submit" value="Atualizar">
</form>
</body>
</html>