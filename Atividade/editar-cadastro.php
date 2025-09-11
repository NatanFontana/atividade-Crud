<?php
// editar-cadastro.php
// Recebe POST do formulário de edição e atualiza apenas os campos que mudaram (e não vazios).
require_once 'connection.php'; // deve definir $pdo (PDO)

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Se não for POST, redireciona para a página principal
    header('Location: atividade.php');
    exit;
}

// Recebe valores do formulário
$id = isset($_POST['id-editar']) ? (int) $_POST['id-editar'] : 0;
$nome = isset($_POST['nome-editar']) ? trim($_POST['nome-editar']) : null;
$genero = isset($_POST['genero-editar']) ? trim($_POST['genero-editar']) : null;
// Mantemos comportamento: somente considera data quando NÃO for string vazia
$data_lancamento = array_key_exists('data_lancamento-editar', $_POST) && $_POST['data_lancamento-editar'] !== ''
    ? $_POST['data_lancamento-editar']
    : null;

if ($id <= 0) {
    echo '<p>ID inválido.</p>';
    exit;
}

try {
    // Busca registro atual
    $stmt = $pdo->prepare('SELECT nome, genero, data_lancamento FROM CrudSerie WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $atual = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$atual) {
        echo '<p>Série não encontrada.</p>';
        exit;
    }

    $campos = [];
    $params = [':id' => $id];

    // Só adiciona ao UPDATE se o campo recebido não for vazio e for diferente do atual
    if ($nome !== null && $nome !== '' && $nome !== $atual['nome']) {
        $campos[] = 'nome = :nome';
        $params[':nome'] = $nome;
    }

    if ($genero !== null && $genero !== '' && $genero !== $atual['genero']) {
        $campos[] = 'genero = :genero';
        $params[':genero'] = $genero;
    }

    // Para data, comparar strings (podendo ser NULL no banco)
    $data_atual = $atual['data_lancamento'] === null ? null : substr($atual['data_lancamento'], 0, 10);
    if ($data_lancamento !== null && $data_lancamento !== '' && $data_lancamento !== $data_atual) {
        $campos[] = 'data_lancamento = :data_lancamento';
        $params[':data_lancamento'] = $data_lancamento;
    }

    if (count($campos) === 0) {
        // Nenhuma alteração detectada — não faz update
        // Redireciona de volta (pode ajustar para mostrar mensagem na interface)
        header('Location: atividade.php?msg=nochange');
        exit;
    }

    // Monta UPDATE dinâmico
    $sql = 'UPDATE CrudSerie SET ' . implode(', ', $campos) . ' WHERE id = :id';
    $upd = $pdo->prepare($sql);
    $upd->execute($params);

    // Sucesso: redireciona
    header('Location: atividade.php?msg=updated');
    exit;

} catch (PDOException $e) {
    // Em ambiente de produção, evite exibir $e->getMessage() diretamente.
    echo '<p>Erro ao atualizar: ' . htmlspecialchars($e->getMessage()) . '</p>';
    exit;
}

?>
