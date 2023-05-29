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
        $('#accountForm :input').prop('disabled', true);
        $.ajax({
            type: 'POST',
            url: '/Estudo/Cruds/CrudPhp/config/IntermediaryAccessAccount.php',
            data: formData,
            beforeSend: function () {
                $('#response').html('Enviando...');
            },
            success: function (response) {
                switch (response) {
                    case '0':
                        $('#response').css('display', 'none');
                        $('#accountForm :input').prop('disabled', false);
                        alert('Conta não enontrada, verifique se está correto.');
                        break;
                    case '1':
                        $('#response').css('display', 'none');
                        window.location.href = "/Estudo/Cruds/CrudPhp/app/AlterDatas.php";
                        break;
                    case '2':
                        $('#response').css('display', 'none');
                        $('#accountForm :input').prop('disabled', false);
                        alert('Sua senha não coincide com a qual guardamos.');
                        break;
                    case '3':
                        $('#response').css('display', 'none');
                        $('#accountForm :input').prop('disabled', false);
                        alert('Conta encontrada mas não está ativa, sendo assim enviamos um email de ativação, por favor verifique seu email.');
                        break;
                    case '4':
                        $('#accountForm :input').prop('disabled', false);
                        $('#response').css('display', 'none');
                        alert('Tentamos enviar um email para ativar sua conta, mas houve um erro inesperado, por favor tente novamente mais tarde, ou utilize o email que enviamos ao criar sua conta.');
                        break;
                    case '5':
                        $('#accountForm :input').prop('disabled', false);
                        $('#response').css('display', 'none');
                        alert('Houve um erro inesperado, por favor tente novamente');
                        break;
                    default:
                        $('#accountForm :input').prop('disabled', false);
                        $('#response').css('display', 'none');
                        alert(response);
                        break;
                }
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});