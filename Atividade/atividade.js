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

function armazenarTabela () {
    let tabela = document.getElementById("tabela-consulta");
    let linhas = tabela.getElementsByTagName("tr");
    console.log(linhas.length);
    let series = [];

    for (i=1; i <linhas.length; i++) {
        let colunas = linhas[i].getElementsByTagName("td");

        // Cria o objeto serie para ser armazenado no array
        let serie = {
            nome: colunas[0].innerText,
            genero: colunas[1].innerText,
            data_lancamento: new Date(colunas[2].innerText),
            id: parseInt(colunas[3].innerText),
        };

        series.push(serie);
        console.log("serie=" + serie);
    }
    
    return series;
}


const tabelaOriginal = armazenarTabela();
console.log(tabelaOriginal);

function pesquisarNome() {
    let filtro = document.getElementById("pesquisar-nome").innerText;
    let linhas = tabelaOriginal.length;
    console.log(linhas);
    let tabelaNova = document.createElement("table");

    for(i=0; i <linhas; i++) {
        console.log(tabelaOriginal);
        // Verifica se o começo do nome é igual ao valor do filtro
        tabelaOriginal.forEach(item =>{
            if(item.nome.toLowerCase().startsWith(filtro.toLowerCase())){
                // Cria o objeto serie para ser armazenado no array tabelaNova
                /*let serie = {
                    nome: item.nome,
                    genero: item.nome,
                    data_lancamento: new Date(item.data_lancamento),
                    id: parseInt(item.id),

                };*/

                let linha = document.createElement("tr");

                let colunaNome = document.createElement("td");
                colunaNome.textContent = item.nome;

                let colunaGenero = document.createElement("td");
                colunaGenero.textContent = item.genero;

                linha.appendChild(colunaNome);
                linha.appendChild(colunaGenero);

                
                tabelaNova.appendChild(linha);
            }
        })
    }

    console.log(tabelaNova);
    tabelaNova.className = "tabela-consulta";

    document.getElementById("tabela-consulta").replaceWith(tabelaNova);
}