function mostrarCadastro() {
    document.getElementById("form-cadastro").style.display = "block";
}

function cancelarCadastro() {
    document.getElementById("form-cadastro").style.display = "none";
}

function mostrarConsulta() {
    document.getElementById("form-consulta").style.display = "block";
}

function cancelarConsulta() {
    document.getElementById("form-consulta").style.display = "none";
}

function mostrarEditar() {
    document.getElementById("form-editar").style.display = "block";
}

function cancelarEditar() {
    document.getElementById("form-editar").style.display = "none";
}

function mostrarRemover() {
    document.getElementById("form-remover").style.display = "block";
}

function cancelarRemover() {
    document.getElementById("form-remover").style.display = "none";
}

function armazenarTabela() {
    let tabela = document.getElementById("tabela-consulta");
    let linhas = tabela.getElementsByTagName("tr");
    let series = document.createElement("table");
    series.className = "tabela-consulta";

    // copiar cabeçalho
    let cabecalho = linhas[0].cloneNode(true); // copia a linha inteira
    series.appendChild(cabecalho);

    for (let i = 1; i < linhas.length; i++) {
        let novaLinha = linhas[i].cloneNode(true); // clona toda a linha com as células
        series.appendChild(novaLinha);
    }

    return series;
}

const tabelaOriginal = armazenarTabela();
console.log(tabelaOriginal);

function pesquisarNome() {
    let filtro = document.getElementById("pesquisar-nome").value;
    let linhas = tabelaOriginal.getElementsByTagName("tr");
    let tabelaNova = document.createElement("table");

    // copiar cabeçalho
    let cabecalho = linhas[0].cloneNode(true);
    tabelaNova.appendChild(cabecalho);

    for (let i = 1; i < linhas.length; i++) {
        let celulas = linhas[i].getElementsByTagName("td");
        let nome = celulas[0].innerText.toLowerCase();

        if (nome.startsWith(filtro.toLowerCase())) {
            let novaLinha = linhas[i].cloneNode(true);// copia a linha inteira
            tabelaNova.appendChild(novaLinha);
        }
    }

    let tabelaAntiga = document.getElementById("tabela-consulta"); // Recebe a tabela no HTML
    tabelaAntiga.innerHTML = ""; // Limpa o conteúdo do HTML
    tabelaAntiga.className = "tabela-consulta"; // Salva a classe da tabela
    tabelaAntiga.appendChild(tabelaNova); // Salva a nova tabela filtrada
}
