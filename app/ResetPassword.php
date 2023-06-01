<!DOCTYPE html>
<html lang="PT-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/Estudo/Cruds/CrudPhp/app/stylesheet/styleGeneral.css">

    <title>Crud de PHP</title>
</head>

<body>
    <header>
        <article class="siteTitle margin-left-header">
            <a href="/Estudo/Cruds/CrudPhp"><p class="title-form custom-text-font-forum custom-text-color1">Crud em php</p></a>
        </article>

        <article class="side-opitions">
            <a href="https://github.com/douglas074" class="margin-rigth-header ">
                <p class="title-form custom-text-font-forum custom-text-color1">GitHub</p>
            </a>
        </article>
    </header>

    <section class="container-fluid">
        <article class="item">

        </article>
        <article class="item article-forms-general">
            <form class="forms-general" id="accountForm" method="POST">
                <span class="title-form custom-text-font-forum custom-text-color1">Pedido de redefinição</span>
                <div class="label-float">
                    <input type="email" id="inputEmail" name="email" placeholder=" ">
                    <label for="#inputEmail" class="custom-text-font-forum custom-text-color5">E-mail:</label>
                </div>
                <div>
                    <button type="submit" id="submitForm"
                        class="submit-button custom-text-font-manrope custom-text-color1 password-button-font-size">Enviar
                    </button>
                    <div id="response" class="custom-text-font-manrope custom-text-color1 password-button-font-size"></div>
                </div>
            </form>
            <a href="/Estudo/Cruds/CrudPhp" class="alredy-have-acount">Voltar</a>
        </article>
        <article class="item">
        </article>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/Estudo/Cruds/CrudPhp/app/javascript/scriptResetPassword.js"></script>
</body>

</html>
