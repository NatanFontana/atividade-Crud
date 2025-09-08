<!DOCTYPE html>
<html lang="en">
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
     <div id="form-cadastro" class="form" action="salvar-cadastro.php" method="POST"> 
        <form>
            <label class="title">Cadastrar Série</label>

            <div class="text-input">
                <label>Nome:</label>
                <br>
                <input id="nome-cadastro" name="nome"></input>
            </div>

            <div class="text-input">
                <label>Gênero:</label>
                <br>
                <input id="genero-cadastro" name="genero"></input>
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
        <button id="cancelar-consulta" class="form-consulta" type="button" onclick="mostrarConsulta()">Consultar</button>
    </div>

    <div id="form-consulta" class="form">
        <form>
            <label class="title">Consultar Série</label>

            <div class="text-input">
                <label>Pesquisar nome<label>
                <br>
                <input id="pesquisar-nome"></input>
            </div>

            <div class="tabela-consulta">
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Gênero</th>
                            <th>Lançamento</th>
                            <th>ID</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="btn-confirmar-cancelar">
                <button id="cancelar-consulta" class="btn-cancelar" type="button" onclick="cancelarConsulta()">Cancelar</button>
            </div>
        </form>
    </div>

    <hr>

    <!-- Edição -->
    <div class="text">
        <div>Para editar suas séries, utilize o botão editar:</div>
        <button>Editar</button>
    </div>

    <hr>

    <!-- Remoção -->
    <div class="text">
        <div>Para remover séries, utilize o botão remover:</div>
        <button>Remover</button>
    </div>

    <hr>

    <script src="atividade.js"></script>
</body>
</html>