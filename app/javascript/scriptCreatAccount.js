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
                        console.log('Erro ');
                        break;
                    case '1':
                        $('#response').html('Conta criada, por favor verifique seu e-mail para ativar sua conta...');
                        console.log(response);
                        break;
                    default:
                        $('#response').html('defaut');
                        console.log(response);
                        break;
                }

            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
});