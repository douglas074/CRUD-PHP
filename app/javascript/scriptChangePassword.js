const params = window.location.href;
const array = params.split('/');
const lastField = array[array.length - 2];

let passwordInput1 = document.querySelector('#inputPass');
let passwordInput2 = document.querySelector('#inputPass1');

let showPassword = document.querySelector('.showHidePassword');

showPassword.addEventListener('click', function () {
    if (passwordInput1.type == 'password') {
        passwordInput1.type = 'text';
        passwordInput2.type = 'text';

        showPassword.textContent = 'Ocultar Senha';

    } else {
        passwordInput1.type = 'password';
        passwordInput2.type = 'password';

        showPassword.textContent = 'Mostrar Senha';
    }
})

$(document).ready(function () {
    $('#passwordForm').submit(function (e) {
        e.preventDefault();

        $('#passwordForm :input').prop('disabled', true);

        let pass = $('#inputPass').val();
        let pass1 = $('#inputPass1').val();
        let email = $('#inputEmail').val();

        $.ajax({
            url: "/Estudo/Cruds/CrudPhp/config/IntermediaryChangePassword.php",
            type: "POST",
            data: {
                id: lastField,
                email: email,
                password: pass,
                password1: pass1
            },
            success: function (response) {
                switch (response) {
                    case '0':
                        alert('Senha alterada, você será redirecionado para que faça o login');
                        $('#passwordForm :input').prop('disabled', false);
                        $('#passwordForm')[0].reset;
                        setTimeout(function () {
                            window.location.href = "/Estudo/Cruds/CrudPhp";
                        }, 5000);
                        break;
                    case '1':
                        $('#passwordForm :input').prop('disabled', false);
                        alert('Ocorreu algum erro ao salvar a senha, por favor tente novamente.');
                        break;
                    case '2':
                        $('#passwordForm :input').prop('disabled', false);
                        alert('Os valores passados por URL não coincidem com o do nosso banco, por favor refaça a solicitação de redefinição.');
                        break;
                    case '3':
                        $('#passwordForm :input').prop('disabled', false);
                        alert('A nova senha não pode ser igual a anterior.');
                        break;
                    case '4':
                        $('#passwordForm :input').prop('disabled', false);
                        alert('Ocorreu algum erro inesperado, por favor refaça a solicitação de redefinição ou tente mais tarde.');
                        break;
                    default:
                        $('#passwordForm :input').prop('disabled', false);
                        $('.spinner').css('display', 'none');
                        alert(response);
                        break;
                }
            },
            error: function (textStatus, errorThrown) {
                $('.spinner').css('display', 'none');
                $('#status').text(response);
                console.log(textStatus, errorThrown);
            }
        });
    })
});