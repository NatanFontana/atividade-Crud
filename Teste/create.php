<?php
require_once "config/Database.php";
require_once "classes/Serie.php";

use App\Classes\Serie;

$serie = new Serie($db);

$database = new Database();
$db = $database->getConnection();

$serie = new Serie($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serie->nome = $_POST['nome'] ?? '';
    $serie->sinopse = $_POST['sinopse'] ?? null;
    $serie->genero = $_POST['genero'] ?? '';
    $serie->data_lancamento = $_POST['data_lancamento'] ?? null;

    if ($serie->create()) {
        header('Location: index.php');
        exit;
    } else {
        $error = "Erro ao cadastrar série.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Série</title>
</head>
<body>
<h1>Cadastro de Série</h1>
<hr>
<a href="index.php">Home</a>
<hr>
<?php if (!empty($error)) echo "<p>{$error}</p>"; ?>
<form method="post">
    Nome:<br>
    <input type="text" name="nome" required><br><br>

    Sinopse:<br>
    <textarea name="sinopse" rows="4" cols="50"></textarea><br><br>

    Gênero:<br>
    <input type="text" name="genero" required><br><br>

    Data de Lançamento:<br>
    <input type="date" name="data_lancamento" required><br><br>

    <input type="submit" value="Cadastrar">
</form>
</body>
</html>