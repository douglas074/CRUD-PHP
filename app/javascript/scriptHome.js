let passwordInput = document.querySelector('#inputPass');
let passwordInput1 = document.querySelector('#inputPass1');
let passwordInput2 = document.querySelector('#inputPass2');

let showPassword = document.querySelector('.show-hide-password');
var display = window.getComputedStyle(showPassword).getPropertyValue("display");

let hidden_Input = document.querySelector('.hidden-Input');

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

let form_button0 = document.querySelector('.form-button0');
let form_button1 = document.querySelector('.form-button1');
let input_disabled0 = document.querySelector('.input-disabled0');
let input_disabled1 = document.querySelector('.input-disabled1');

let password_area = document.querySelector('.password-area');
form_button0.addEventListener('click', function () {
    if (display == 'none') {
        form_button0.style.display = 'none';
        form_button1.style.display = 'block';
        input_disabled0.disabled = false;
        input_disabled1.disabled = false;
        hidden_Input.value = 1;
    } else {
        form_button0.style.display = 'block';
        form_button1.style.display = 'none';
        input_disabled0.disabled = true;
        input_disabled1.disabled = true;
        hidden_Input.value = 0;
    }
});


$(document).ready(function () {
    $('#accountForm').submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '/Estudo/Cruds/CrudPhp/config/IntermediaryAlterDatas.php',
            data: formData,
            beforeSend: function () {
                $('#response').html('Enviando...');
            },
            success: function (response) {
                switch (response) {
                    case '0':
                        alert('Houve um erro ao salvar seus dados, por favor, tente novamente');
                        console.log('Ocorreu um erro ao salvar seus dados, por favor tente novamente');
                        break;
                    case '1':
                        alert('Dados Salvos');
                        showPassword.style.display = 'none';
                        password_area.style.display = 'none';
                        form_button0.style.display = 'block';
                        form_button1.style.display = 'none';
                        break;
                    default:
                        alert('Ocorreu um erro ao salvar seus dados, por favor tente novamente');
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