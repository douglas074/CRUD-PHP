<!DOCTYPE html>
<html lang="PT-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/stylesheet/style.css">

    <title>Crud de PHP</title>
</head>

<body>

    <header>
        <article class="siteTitle margin-left-header">
            <h1 class="custom-text-font-forum custom-text-color1">Crud em php</h1>
        </article>

        <article class="side-opitions">
            <a href="#" class="margin-rigth-header ">
                <h1
                    class="custom-button custom-text-color1 custom-text-font-forum header-animation rigth-button-background">
                    Login</h1>
            </a>

            <span class="custom-text-color1 custom-text-font-forum">|</span>

            <a href="#" class="margin-rigth-header ">
                <h1 class="custom-button custom-text-color1 custom-text-font-forum">Sobre</h1>
            </a>

            <a href="https://github.com/douglas074" class="margin-rigth-header ">
                <h1 class="custom-button custom-text-color1 custom-text-font-forum">Meu repositório</h1>
            </a>
        </article>
    </header>



    <section class="container-fluid">
        <article class="item">

        </article>
        <article class="item article-forms-general">
            <form action="#" class="forms-general">
                <span class="title-form custom-text-font-forum custom-text-color1">Cadastro</span>
                <div class="label-float">
                    <input type="text" id="inputName" name="name" placeholder=" " required>
                    <label for="#inputName" class="custom-text-font-forum custom-text-color5">Nome:</label>
                </div>

                <div class="label-float">
                    <input type="email" id="inputtEmail" name="email" placeholder=" ">
                    <label for="#inputEmail" class="custom-text-font-forum custom-text-color5">E-mail:</label>
                </div>

                <div class="label-float">
                    <input type="password" id="inputPass" name="senha" placeholder=" ">
                    <label for="#inputPassword" class="custom-text-font-forum custom-text-color5">Senha:</label>
                </div>
                <div>
                    <a href="#" type="button"
                        class="custom-button custom-text-font-manrope custom-text-color1 password-button-font-size"
                        id="passwordButton">Mostrar
                        senha
                    </a>
                    <a href="#" type="submit"
                        class="submit-button custom-text-font-manrope custom-text-color1 password-button-font-size"><b></b>Enviar

                    </a>
                </div>
            </form>
            <a href="#" class="alredy-have-acount">Já possui uma conta?</a>
        </article>

        <article class="item">

        </article>

    </section>

    <script src="/Estudo/Cruds/CrudPhp/src/Front/script.js"></script>
</body>

</html>