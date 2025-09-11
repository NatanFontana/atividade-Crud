<?php
// remover-cadastro.php
// Recebe POST do formulário de remoção e deleta a série pelo id
require_once 'connection.php'; // deve definir $pdo (PDO)

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: atividade.php');
    exit;
}

$id = isset($_POST['id-editar']) ? (int) $_POST['id-editar'] : 0;

if ($id <= 0) {
    // id inválido
    header('Location: atividade.php?msg=invalidid');
    exit;
}

try {
    $stmt = $pdo->prepare('DELETE FROM CrudSerie WHERE id = :id');
    $stmt->execute([':id' => $id]);

    if ($stmt->rowCount() > 0) {
        // Excluído com sucesso
        header('Location: atividade.php?msg=deleted');
        exit;
    } else {
        // Nenhum registro com esse id
        header('Location: atividade.php?msg=notfound');
        exit;
    }

} catch (PDOException $e) {
    // Em produção, não exiba a mensagem de erro diretamente
    header('Location: atividade.php?msg=error');
    exit;
}
?>
