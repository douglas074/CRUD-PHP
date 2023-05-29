let passwordInput = document.querySelector('#inputPass');
let passwordInput1 = document.querySelector('#inputPass1');
let passwordInput2 = document.querySelector('#inputPass2');

let showPassword = document.querySelector('.show-hide-password');
var display = window.getComputedStyle(showPassword).getPropertyValue("display");

let hidden_Input = document.querySelector('.hidden-input');

let form_button0 = document.querySelector('.form-button0');
let form_button1 = document.querySelector('.form-button1');
let form_button2 = document.querySelector('.form-button2');
let delete_button = document.querySelector('.delete-button');

let input_disabled0 = document.querySelector('.input-disabled0');
let input_disabled1 = document.querySelector('.input-disabled1');

let hide_pass = document.querySelector('.show-hide-alter-pass');
let password_area = document.querySelector('.password-area');
let pass_settings = document.querySelector('.pass-settings');

let response = document.querySelector('#response');

let user_Name = document.querySelector('#inputName');
let user_Email = document.querySelector('#inputEmail');

let input_Value1 = user_Name.value;
let input_Value2 = user_Email.value;

let modal = document.getElementById('myModal');
let modalContent = document.querySelector('.modal-content');

let delete_Account = document.querySelector('.form-delete-confirm ');

// Abra o modal quando o evento de clique ocorrer
document.querySelector('.delete-button').addEventListener('click', function () {
    modal.style.display = 'block';
});

// Feche o modal quando o usuário clicar fora do conteúdo
window.addEventListener('click', function (event) {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});

showPassword.addEventListener('click', function () {
    if (passwordInput.type == 'password') {
        passwordInput.type = 'text';
        passwordInput1.type = 'text';
        passwordInput2.type = 'text';

        showPassword.textContent = 'Ocultar Senha';

    } else {
        passwordInput.type = 'password';
        passwordInput1.type = 'password';
        passwordInput2.type = 'password';

        showPassword.textContent = 'Mostrar Senha';
    }
})

form_button0.addEventListener('click', function () {
    form_button0.style.display = 'none';
    form_button1.style.display = 'flex';
    form_button2.style.display = 'flex';
    delete_button.style.display = 'flex';
    showPassword.style.display = 'flex';
    input_disabled0.disabled = false;
    input_disabled1.disabled = false;
    passwordInput.disabled = false;
    hide_pass.style.display = 'flex';
    pass_settings.style.display = 'grid';
    showPassword.style.marginTop = '0px';
});

form_button1.addEventListener('click', function () {
    form_button0.style.display = 'flex';
    form_button1.style.display = 'none';
    form_button2.style.display = 'none';
    delete_button.style.display = 'none';
    input_disabled0.disabled = true;
    input_disabled1.disabled = true;
    passwordInput.disabled = true;
    hidden_Input.value = 0;
    hide_pass.style.display = 'none';
    showPassword.style.display = 'none';
    pass_settings.style.display = 'none';
    password_area.style.display = 'none';
    passwordInput.value = null;
    passwordInput1.value = null;
    passwordInput2.value = null;
    user_Name.value = input_Value1;
    user_Email.value = input_Value2;
    showPassword.style.marginTop = '0px';

})

// form_button2.addEventListener('click', function () {
//     form_button0.style.display = 'flex';
//     form_button1.style.display = 'none';
//     form_button2.style.display = 'none';
//     input_disabled0.disabled = true;
//     input_disabled1.disabled = true;
//     hide_pass.style.display = 'none';
//     showPassword.style.display = 'none';
//     pass_settings.style.display = 'none';
//     password_area.style.display = 'none';
// })

hide_pass.addEventListener('click', function () {
    password_area.style.display = 'block';
    hide_pass.style.display = 'none';
    hidden_Input.value = 1;
    showPassword.style.marginTop = '27px';
    showPassword.style.display = 'flex';
})

$(document).ready(function () {
    $('#accountForm').submit(function (e) {
        e.preventDefault();

        let hiddenInput = $('#hiddenInput').val();
        let inputName = $('#inputName').val();
        let inputEmail = $('#inputEmail').val();
        let inputPass = $('#inputPass').val();
        let inputPass1 = $('#inputPass1').val();
        let inputPass2 = $('#inputPass2').val();


        $('#accountForm :input').prop('disabled', true);
        $.ajax({
            type: 'POST',
            url: '/Estudo/Cruds/CrudPhp/config/IntermediaryAlterDatas.php',
            data: {
                hiddenInput: hiddenInput,
                name: inputName,
                email: inputEmail,
                password: inputPass,
                password1: inputPass1,
                password2: inputPass2
            },
            beforeSend: function () {
                response.style.display = 'flex';
                response.textContent = 'Enviando...';
            },
            success: function (response) {
                switch (response) {
                    case '0':
                        $('#accountForm :input').prop('disabled', false);
                        $('#response').css('display', 'none');
                        alert('Dados Salvos');
                        showPassword.style.display = 'none';
                        password_area.style.display = 'none';
                        form_button0.style.display = 'block';
                        form_button2.style.display = 'none';
                        input_disabled0.disabled = true;
                        input_disabled1.disabled = true;
                        passwordInput.value = null;
                        passwordInput1.value = null;
                        passwordInput2.value = null;
                        hidden_Input.value = 0;
                        break;
                    case '1':
                        $('#accountForm :input').prop('disabled', false);
                        $('#response').css('display', 'none');
                        alert('Houve um erro ao salvar seus dados, por favor, tente novamente');
                        console.log('Ocorreu um erro ao salvar seus dados, por favor tente novamente');
                        break;
                    case '2':
                        $('#accountForm :input').prop('disabled', false);
                        $('#response').css('display', 'none');
                        alert('Ocorreu um erro inesperado por favor, tente novamente.');
                        break;
                    default:
                        $('#accountForm :input').prop('disabled', false);
                        $('#response').css('display', 'none');
                        alert(response);
                        console.log(response);
                        break;
                }
            },
            error: function (xhr) {
                $('#accountForm :input').prop('disabled', false);
                $('#response').css('display', 'none');
                console.log(xhr.responseText);
            }
        });
    });
});

$('#deleteForm').submit(function (e) {
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: '/Estudo/Cruds/CrudPhp/config/IntermediarysDeleteAccount.php',
        data: {
            deleteInput: 1
        },
        beforeSend: function () {
            $('#response').css('display', 'flex');
            response.textContent = 'Deletando...';
        },
        success: function (response) {
            switch (response) {
                case '0':
                    $('#response').css('display', 'none');
                    alert('Conta excluída');
                    window.location.href = "/Estudo/Cruds/CrudPhp";
                    break;
                case '1':
                    $('#response').css('display', 'none');
                    alert('Houve um erro ao excluir sua conta, por favor, tente novamente');
                    console.log('Ocorreu um erro ao excluir sua conta, por favor tente novamente');
                    break;
                default:
                    $('#response').css('display', 'none');
                    alert('Houve um erro inesperado, por favor tente novamente mais tarde');
                    console.log('Houve um erro inesperado, por favor tente novamente mais tarde');
                    break;
            }
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});
$('#logOutForm').submit(function (e) {
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: '/Estudo/Cruds/CrudPhp/config/IntermediaryLogOut.php',
        data: {
            log: 1
        },
        success: function (response) {
            switch (response) {
                case '0':
                    $('#response').css('display', 'none');
                    window.location.href = "/Estudo/Cruds/CrudPhp";
                    break;
                case '1':
                    $('#response').css('display', 'none');
                    alert('Houve um erro ao sair da sua conta, por favor, tente novamente');
                    console.log('Ocorreu um erro ao sair da sua conta, por favor tente novamente');
                    break;
                default:
                    $('#response').css('display', 'none');
                    alert('Houve um erro inesperado, por favor tente novamente mais tarde');
                    console.log('Houve um erro inesperado, por favor tente novamente mais tarde');
                    break;
            }
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    })
});