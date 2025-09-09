<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="atividade.css">

    <title>inicio</title>
</head>

<body>
    <div style="text-align: center; font-family: Arial; font-size: 60px; background-color: #0f0fa0; color: #fff">
        Consulta de Séries
    </div>

    <!-- Cadastro-->
    <div class="text">
        <div>Para cadastrar séries, utilize botão cadastar:</div>
        <button onclick="mostrarCadastro()">Cadastrar</button>
    </div>

    <!-- Formulário de Cadastro -->
     <div id="form-cadastro" class="form"> 
        <form action="salvar-cadastro.php" method="POST" style="gap: 20px;">
            <label class="title">Cadastrar Série</label>

            <div class="text-input">
                <label>Nome:</label>
                <br>
                <input id="nome-cadastro" name="nome"></input>
            </div>

            <div class="text-input">
                <label>Gênero:</label>
                <br>
                <select id="genero-cadastro" name="genero">
                    <option value="acao">Ação</option>
                    <option value="drama">Drama</option>
                    <option value="comedia">Comédia</option>
                    <option value="aventura">Aventura</option>
                </select>
            </div>

            <div class="text-input">
                <label>Data de Lançamento:</label>
                <br>
                <input id="data-cadastro" type="date" name="data_lancamento"></input>
            </div>

            <div class="btn-confirmar-cancelar">
                <button id="confirmar-cadastro" class="btn-confirmar" type="submit">Confirmar</button>
                <button id="cancelar-cadastro" class="btn-cancelar" type="button" onclick="cancelarCadastro()">Cancelar</button>
            </div>
            
        </form>
     </div>

    <hr>

    <!-- Consulta -->
    <div class="text">
        <div>Para consultar séries, utilize botão consultar:</div>
        <button onclick="mostrarConsulta()">Consultar</button>
    </div>

    <div id="form-consulta" class="form">
        <form style="gap: 5px;">
            <label class="title">Consultar Série</label>

            <div class="text-input">
                <label>Pesquisar nome<label>
                <br>
                <input id="pesquisar-nome" name="pesquisar-nome" onkeyup="pesquisarNome()"></input>
            </div>

            <?php
                // Inclui a conexão com o banco de dados
                require_once 'connection.php';

                // Cria a tabela com base nas séries no banco de dados
                try {
                    // Consulta para obter todos os registros da tabela CrudSerie
                    $sql = "SELECT id, nome, genero, data_lancamento FROM CrudSerie";
                    $stmt = $pdo->query($sql);

                    // Verifica se há resultados
                    if ($stmt->rowCount() > 0) {
                        // Inicia a tabela HTML
                        echo '<div id="tabela-consulta" class="tabela-consulta">';
                        echo '<table>';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th style="width: 40%">Nome</th>';
                        echo '<th style="width: 35%">Gênero</th>';
                        echo '<th style="width: 20%;">Lançamento</th>';
                        echo '<th style="width: 5%;">ID</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        // Itera sobre os resultados e gera as linhas da tabela
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['nome']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['genero']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['data_lancamento']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                            echo '</tr>';
                        }

                        // Fecha o corpo da tabela
                        echo '</tbody>';
                        echo '</table>';
                        echo '</div>';
                    } else {
                        // Caso não haja registros
                        echo '<p>Não há registros cadastrados.</p>';
                    }

                } catch (PDOException $e) {
                    echo "Erro ao consultar dados: " . $e->getMessage();
                }
            ?>       

            <div class="btn-confirmar-cancelar">
                <button id="cancelar-consulta" class="btn-cancelar" type="button" onclick="cancelarConsulta()">Cancelar</button>
            </div>
        </form>
    </div>

    <hr>

    <!-- Edição -->
    <div class="text">
        <div>Para editar suas séries, utilize o botão editar:</div>
        <button onclick="mostrarEditar()">Editar</button>
    </div>

    <!-- Formulário de Edição -->

    <div id="form-editar" class="form"> 
        <form action="editar-cadastro.php" method="POST" style="gap: 6px;">
            <label class="title">Editar Série</label>

            <div class="text-input">
                <label>Nome:</label>
                <br>
                <input id="nome-editar" name="nome-editar"></input>
            </div>

            <div class="text-input">
                <label>Gênero:</label>
                <br>
                <select id="genero-editar" name="genero-editar">
                    <option value="acao">Ação</option>
                    <option value="drama">Drama</option>
                    <option value="comedia">Comédia</option>
                    <option value="aventura">Aventura</option>
                </select>
            </div>

            <div class="text-input">
                <label>Data de Lançamento:</label>
                <br>
                <input id="data-editar" type="date" name="data_lancamento-editar"></input>
            </div>

            <div class="text-input">
                <label>ID da Série (Não é alterado):</label>
                <br>
                <input id="id-editar" type="number" name="id-editar"></input>
            </div>

            <div class="btn-confirmar-cancelar">
                <button id="confirmar-editar" class="btn-confirmar" type="submit">Confirmar</button>
                <button id="cancelar-editar" class="btn-cancelar" type="button" onclick="cancelarEditar()">Cancelar</button>
            </div>
            
        </form>
     </div>

    <hr>

    <!-- Remoção -->
    <div class="text">
        <div>Para remover séries, utilize o botão remover:</div>
        <button onclick="mostrarRemover()">Remover</button>
    </div>

    <!-- Formulário de Remoção -->
     <div id="form-remover" class="form"> 
        <form action="remover-cadastro.php" method="POST" style="gap: 5px; height: 230px;">
            <label class="title">Remover Série</label>

            <div class="text-input">
                <label>ID da Série:</label>
                <br>
                <input id="id-remover" type="number" name="id-editar"></input>
            </div>

            <div class="btn-confirmar-cancelar">
                <button id="confirmar-remover" class="btn-confirmar" type="submit">Confirmar</button>
                <button id="cancelar-remover" class="btn-cancelar" type="button" onclick="cancelarRemover()">Cancelar</button>
            </div>
            
        </form>
     </div>

    <hr>

    <script src="atividade.js"></script>
</body>
</html>