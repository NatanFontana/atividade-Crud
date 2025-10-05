<?php
require_once "config/Database.php";
require_once "classes/Serie.php";

use App\Classes\Serie;

$serie = new Serie($db);

$database = new Database();
$db = $database->getConnection();

$serie = new Serie($db);
$msg = "";

if (isset($_GET['id'])) {
    $serie->id = (int) $_GET['id'];
    if ($serie->delete()) {
        header('Location: index.php');
        exit;
    } else {
        $msg = "Erro ao excluir série.";
    }
} else {
    $msg = "ID não fornecido.";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Série</title>
</head>
<body>
<h1>Exclusão de Série</h1>
<hr>
<?= htmlspecialchars($msg) ?>
<hr>
<a href="index.php">Voltar</a>
</body>
</html>