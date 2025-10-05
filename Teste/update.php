<?php
require_once "config/Database.php";
require_once "classes/Serie.php";

use App\Classes\Serie;

$serie = new Serie($db);

$database = new Database();
$db = $database->getConnection();

$serie = new Serie($db);

if (isset($_GET['id'])) {
    $serie->id = (int) $_GET['id'];
    $row = $serie->readOne();
    if (!$row) {
        echo "Série não encontrada.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serie->id = (int) $_POST['id'];
    $serie->nome = $_POST['nome'] ?? '';
    $serie->sinopse = $_POST['sinopse'] ?? null;
    $serie->genero = $_POST['genero'] ?? '';
    $serie->data_lancamento = $_POST['data_lancamento'] ?? null;

    if ($serie->update()) {
        header('Location: index.php');
        exit;
    } else {
        $error = "Erro ao atualizar.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Série</title>
</head>
<body>
<h1>Edição de Série</h1>
<hr>
<a href="index.php">Home</a>
<hr>
<?php if (!empty($error)) echo "<p>{$error}</p>"; ?>
<form method="post">
    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">

    Nome:<br>
    <input type="text" name="nome" value="<?= htmlspecialchars($row['nome']) ?>" required><br><br>

    Sinopse:<br>
    <textarea name="sinopse" rows="4" cols="50"><?= htmlspecialchars($row['sinopse']) ?></textarea><br><br>

    Gênero:<br>
    <input type="text" name="genero" value="<?= htmlspecialchars($row['genero']) ?>" required><br><br>

    Data de Lançamento:<br>
    <input type="date" name="data_lancamento" value="<?= htmlspecialchars($row['data_lancamento']) ?>" required><br><br>

    <input type="submit" value="Atualizar">
</form>
</body>
</html>