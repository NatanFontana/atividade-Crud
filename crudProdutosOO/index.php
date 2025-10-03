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
            <th>ID</th><th>Nome</th><th>Preço</th><th>Ações</th>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nome'] ?></td>
                <td>R$ <?= number_format($row['preco'], 2, ',', '.') ?></td>
                <td>
                    <a href="update.php?id=<?= $row['id'] ?>">Editar</a> | 
                    <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Excluir este produto?')">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>