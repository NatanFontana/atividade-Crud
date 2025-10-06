<?php
require_once "config/Database.php";
require_once "classes/Serie.php";

$database = new Database();
$db = $database->getConnection();

$serie = new Serie($db);

if ($_POST) {
    $serie->nome = $_POST['nome'];
    $serie->genero = $_POST['genero'];
    $serie->data_lancamento = $_POST['data_lancamento'];

    if ($serie->create()) {
        echo "Serie cadastrada com sucesso!";
    } else {
        echo "Erro ao cadastrar serie.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD Series</title>
</head>
<body>
<h1>Cadastro de Series</h1>
<hr>
<a href="index.php">Home</a>
<hr>
<form method="post">
    Nome:<br>
    <input type="text" name="nome" required><br><br>

    Gênero:<br>
    <select name="genero" required>
        <option></option>
        <option>Ação</option>
        <option>Drama</option>
        <option>Comédia</option>
        <option>Suspense</option>
    </select><br><br>

    Data de Lançamento:<br>
    <input type="date" name="data_lancamento"><br><br>


    <input type="submit" value="Cadastrar">
</form>
</body>
</html>