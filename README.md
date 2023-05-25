<html lang="pt-br">
<body>
    <h1>CRUD em PHP</h1>
    <p>Este é um projeto de exemplo para um CRUD (Create, Read, Update, Delete) em PHP. O objetivo é demonstrar como é possível criar um sistema de cadastro simples e seguro utilizando HTML, CSS e PHP.</p>
    <h2>Estrutura de pastas</h2>
    <p>O projeto é dividido em quatro pastas principais:</p>
    <ul>
        <li>
            <p><code>app:</code> contém todos os arquivos do Front-End.</p>
            <code>Dentro de app há: </code> <br>
            <code>- javascript</code> que contém todos os arquivos de JS.<br>
            <code>- stylesheet</code> que contém todos os arquiivos de CSS.<br>
            E também há arquivos de html com extensão php, esses que são às páginas em si. <br><br>
        </li>
        <li>
            <b><p><code>Config:</code> contém todos os arquivos do Back-End.<br></p></b>
            <code>Dentro de config há:</code><br> 
            <code>- Autoload.php</code> arquivo que possui a função de fazer o require de todas as classes que são usadas nos arquivos.<br>
            <code>- Intermediarys</code> Arquivos que relacionam o front com o back.<br>
            <code>- TokenVerifiicator.php</code> Arquivo que tem  a função de verificar se o token de ativação de conta é válido.<br>
            <code>- Users.php</code> Arquivo que tem toda configuração de dados do usuário.<br><br>
        </li>
        <li>
            <b><p><code>db:</code> contém os arquivos de banco de dados, sendo eles:</p></b>
            <code>- ConnectionCreator.php:</code> que cria a conexão com o banco de dados.<br>
            <code>- database.db:</code> que é o prórpio banco de dados feito em sqlite3.<br><br>
        </li>
        <li>
            <b><p><code>vendor:</code> contém todos os arquivos que tratam do composer e as bibliotecas que são utilizadas no projeto, sendo elas: </p></b>
            <code>Laminas</code> que é utilizado para enviar e-mails e 
            <code>ramsey</code> que é utilizada para gerar um valor de crid aleatório, tendo em vista que o sqlite não possui essa funcionalidade.
        </li>
    </ul>
    <h2>Requisitos</h2>
    <h4>Instalar Sqlite3</h4>
    <code>sudo apt-get install php-sqlite3</code>
<h2>Contribuição</h2>
<p>Sinta-se à vontade para contribuir com melhorias, correções de bugs ou novos recursos para este projeto. Basta fazer um fork do repositório, fazer as modificações desejadas e enviar um pull request.</p>    
</body>