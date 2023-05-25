let passwordInput = document.querySelector('#inputPass');
let showPassword = document.querySelector('#showHidePassword');
let passwordButton = document.querySelector('#showHidePassword');

passwordButton.addEventListener('click', function () {
    if (passwordInput.type == 'password') {
        passwordInput.type = 'text';
        showPassword.textContent = 'Ocultar Senha';
    } else {
        passwordInput.type = 'password';
        showPassword.textContent = 'Mostrar Senha';
    }
})

$(document).ready(function () {
    $('#accountForm').submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '/Estudo/Cruds/CrudPhp/config/IntermediaryCreateAccount.php',
            data: formData,
            beforeSend: function () {
                $('#response').html('Enviando...');
            },
            success: function (response) {
                switch (response) {
                    case '0':
                        alert('Erro ao criar conta, por favor tente novamente');
                        break;
                    case '1':
                        alert('Conta criada, por favor verifique seu e-mail para ativar sua conta...');
                        console.log(response);
                        break;
                    case '2':
                        alert('Já há uma conta associada a esse email, mas ela nao está ativada, deseja reenviar o email de confirmação?');
                        console.log(response);
                        break;
                    case '3':
                        alert('Ocorreu um erro inesperado, por favor tente novamente');
                        console.log(response);
                        break;
                    case '4':
                        alert('Ocorreu um erro ao tentar enviar o email, tentaremos de novo');
                        console.log(response);
                        break;
                    default:
                        alert('HOuve um herro inesperado, por favor tente novamente outra hora');
                        console.log(response);
                        break;
                }

            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});