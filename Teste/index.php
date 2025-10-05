<?php
// index.php
// usa __DIR__ para garantir caminho relativo correto
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/classes/Serie.php';

// debug rápido: se a classe Database não existir, mostra os arquivos incluidos
if (!class_exists('Database')) {
    echo "<strong>Erro:</strong> classe <code>Database</code> não encontrada.<br>";
    echo "Arquivos incluídos:<br><pre>";
    print_r(get_included_files());
    echo "</pre>";
    exit;
}

try {
    $database = new Database();
    $db = $database->getConnection();
} catch (Exception $e) {
    echo "Erro ao conectar ao BD: " . htmlspecialchars($e->getMessage());
    exit;
}

$serie = new Serie($db);
$stmt = $serie->read();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD Séries</title>
</head>
<body>
    <h1>Lista de Séries</h1>
    <hr>
    <a href="create.php">Cadastrar Série</a>
    <hr>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th><th>Nome</th><th>Gênero</th><th>Data de Lançamento</th><th>Ações</th>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['nome']) ?></td>
                <td><?= htmlspecialchars($row['genero']) ?></td>
                <td><?= htmlspecialchars(date('d/m/Y', strtotime($row['data_lancamento']))) ?></td>
                <td>
                    <a href="update.php?id=<?= $row['id'] ?>">Editar</a> |
                    <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Excluir esta série?')">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
