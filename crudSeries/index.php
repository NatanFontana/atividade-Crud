<?php
require_once "config/Database.php";
require_once "classes/Serie.php";

$database = new Database();
$db = $database->getConnection();

$serie = new Serie($db);
$stmt = $serie->read();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD Series</title>
</head>
<body>
    <h1>Lista de Series</h1>
    <hr>
    <a href="create.php">Cadastrar Serie</a>
    <hr>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th><th>Nome</th><th>Gênero</th><th>Data de Lançamento</th><th></th>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nome'] ?></td>
                <td><?= $row['genero']?></td>
                <td><?= date($row['data_lancamento']) ?></td>
                <td>
                    <a href="update.php?id=<?= $row['id'] ?>">Editar</a> | 
                    <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Excluir esta serie?')">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>