<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>CRUD em PHP</h1>
    <p>Este é um projeto de exemplo para um CRUD (Create, Read, Update, Delete) em PHP. O objetivo é demonstrar como é possível criar um formulário de cadastro simples utilizando HTML, CSS e PHP.</p>
    <h2>Estrutura de pastas</h2>
    <p>O projeto é dividido em três pastas principais:</p>
    <ul>
        <li><code>stylesheet</code>: contém o arquivo <code>style.css</code>, que é responsável por estilizar as páginas HTML.</li>
        <li><code>javascript</code>: contém o arquivo <code>script.js</code>, que é responsável por adicionar comportamentos interativos às páginas HTML.</li>
        <li><code>php</code>: contém os arquivos PHP que implementam as funcionalidades do CRUD.</li>
    </ul>
    <h2>Instalar Sqlite3</h2>
    <code>sudo apt-get install php-sqlite3</code>
    <h2>Páginas HTML</h2>
    <h3>index.html</h3>
    <p>Este é o arquivo principal do projeto, que contém a página inicial do CRUD. Ele é responsável por carregar os recursos CSS e JavaScript, bem como por exibir o formulário de cadastro.</p>
    <h3>forms.html</h3>
    <p>Este arquivo contém o formulário de cadastro do CRUD. Ele é estilizado pelo arquivo <code>style.css</code> e possui comportamentos interativos implementados pelo arquivo <code>script.js</code>.</p>
    <h2>Arquivos PHP</h2>
    <h3>create.php</h3>
    <p>Este arquivo é responsável por criar um novo registro no banco de dados a partir dos dados enviados pelo formulário de cadastro.</p>
    <h3>read.php</h3>
    <p>Este arquivo é responsável por exibir todos os registros existentes no banco de dados.</p>
    <h3>update.php</h3>
    <p>Este arquivo é responsável por atualizar um registro existente no banco de dados a partir dos dados enviados pelo formulário de cadastro.</p>
    <h3>delete.php</h3>
    <p>Este arquivo é responsável por excluir um registro existente no banco de dados.</p>
</body>
