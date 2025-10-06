<?php
require_once "config/Database.php";
require_once "classes/Serie.php";

$msg = "";
$database = new Database();
$db = $database->getConnection();

$serie = new Serie($db);

if (isset($_GET['id'])) {
    $serie->id = $_GET['id'];
    if ($serie->delete()) {
        $msg = "Serie excluída com sucesso!";
    } else {
        $msg = "Erro ao excluir serie.";
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
<h1>Exclusão de Series</h1>
<hr>
<?= $msg ?>
<hr>

<a href="index.php">Voltar</a>
</body>
</html>