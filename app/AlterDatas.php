<?php
session_start();

if (empty($_SESSION)) {
    header("Location: /Estudo/Cruds/CrudPhp/index.php");
exit();
}else{
?>
<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/Estudo/Cruds/CrudPhp/app/stylesheet/styleAlterDatas.css">

    <title>Crud de PHP</title>
</head>
<body>
    <header class="header">
    <article class="siteTitle margin-left-header">
            <a href="/Estudo/Cruds/CrudPhp"><p class="title-form custom-text-font-forum custom-text-color1">Crud em php</p></a>
        </article>

        <article class="side-opitions">
            <a href="https://github.com/douglas074" class="margin-rigth-header">
                <p class="title-form custom-text-font-forum custom-text-color1">GitHub</p>
            </a>
            <form class="form-log-out" id="logOutForm" method="POST">
                <button type="submit"
                    class="submit-button custom-text-font-manrope custom-text-color1 password-button-font-size">
                    <p class="title-form custom-text-font-forum custom-text-color1">Sair</p>
                </button>
            </form>
        </article>
    </header>
    <section class="container-fluid">
        <article class="item">
            <form class="forms-general" id="accountForm" method="POST">
                <input type="hidden" name="hiddenInput" class="hidden-input" value="0" id="hiddenInput">
                <span class="title-form custom-text-font-forum custom-text-color1">Alterar dados</span>
                <a href='#' type="button"
                    class="delete-button display-none submit-button custom-text-font-manrope custom-text-color1 password-button-font-size tooltip">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-trash3" viewBox="0 0 16 16">
                        <path
                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                    </svg>
                </a>
                <div class="label-float">
                    <input type="text" class="input-background input-disabled0" id="inputName" name="name"
                        placeholder=" " value="<?php echo $_SESSION['name'];?>" disabled>
                    <label for="#inputName" class="custom-text-font-forum custom-text-color5">Nome:</label>
                </div>

                <div class="label-float">
                    <input type="email" class="input-background input-disabled1" id="inputEmail" name="email"
                        placeholder=" " value="<?php echo $_SESSION['email'];?>" disabled>
                    <label for="#inputEmail" class="custom-text-font-forum custom-text-color5">E-mail:</label>
                </div>

                
                    <div class="label-float">
                        <input type="password" class="input-background" id="inputPass" name="password" placeholder=" " disabled>
                        <label for="#inputPass" class="custom-text-font-forum custom-text-color5">Senha
                            atual:</label>
                    </div>
                <div class="display-none password-area">
                    <div class="label-float">
                        <input type="password" class="input-background new-password0" id="inputPass1" name="password1"
                            placeholder=" ">
                        <label for="#inputPass1" class="custom-text-font-forum custom-text-color5">Nova
                            senha:</label>
                    </div>

                    <div class="label-float">
                        <input type="password" class="input-background new-password1" id="inputPass2" name="password2"
                            placeholder=" ">
                        <label for="#inputPass2" class="custom-text-font-forum custom-text-color5">Repita a nova
                            senha:</label>
                    </div>
                </div>
                <footer>
                    <div class="div-general">
                        <aside class="options">
                            <a href="#" type="button"
                                class="form-button0 submit-button custom-text-font-manrope custom-text-color1 password-button-font-size">Editar
                            </a>
                            <a href="#" type="button"
                                class="form-button1 display-none submit-button custom-text-font-manrope custom-text-color1 password-button-font-size">Cancelar
                                alteração
                            </a>
                            <button type="submit"
                                class="form-button2 display-none submit-button custom-text-font-manrope custom-text-color1 password-button-font-size">Salvar
                            </button>
                        </aside>
                        <aside class="pass-settings">
                            <a href="#" type="button"
                                class="show-hide-alter-pass display-none custom-button custom-text-font-manrope custom-text-color1 password-button-font-size ">Editar
                                senha
                            </a>
                            <a href="#" type="button"
                                class="show-hide-password display-none custom-button custom-text-font-manrope custom-text-color1 password-button-font-size ">Mostrar
                                senha
                            </a>
                        </aside>
                    </div>
                </footer>
                <p id="response"
                    class="display-none custom-text-font-manrope custom-text-color1 password-button-font-size"></p>
            </form>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <form class="forms-delete" id="deleteForm" method="POST">
                        <span class="title-form custom-text-font-forum custom-text-color1 d-block">Deletar conta</span>
                        <input type="hidden" name="hiddenInput" class="hidden-input" id="deleteInput">
                        <span class="custom-text-font-forum custom-text-color1">Tem certeza que deseja deletar sua
                            conta?</span>
                        <footer class="footer-deleter">
                            <button type="button"
                                class="form-delete-confirm submit-button custom-text-font-manrope custom-text-color1 password-button-font-size">Cancelar
                            </button>
                            <button type="submit"
                                class="form-delete-confirm submit-button custom-text-font-manrope custom-text-color1 password-button-font-size">Deletar
                            </button>
                        </footer>
                    </form>

                </div>
            </div>

        </article>

    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/Estudo/Cruds/CrudPhp/app/javascript/scriptAlterDatas.js"></script>
</body>

</html>
<?php }?>
