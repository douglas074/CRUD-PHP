let passwordInput = document.querySelector('#inputPass');
let passwordInput1 = document.querySelector('#inputPass1');
let passwordInput2 = document.querySelector('#inputPass2');

let showPassword = document.querySelector('.show-hide-password');
var display = window.getComputedStyle(showPassword).getPropertyValue("display");

let hidden_Input = document.querySelector('.hidden-input');

let form_button0 = document.querySelector('.form-button0');
let form_button1 = document.querySelector('.form-button1');
let form_button2 = document.querySelector('.form-button2');

let input_disabled0 = document.querySelector('.input-disabled0');
let input_disabled1 = document.querySelector('.input-disabled1');

let hide_pass = document.querySelector('.show-hide-alter-pass');
let password_area = document.querySelector('.password-area');
let pass_settings = document.querySelector('.pass-settings');

let user_Name = document.querySelector('#inputName');
let user_Email = document.querySelector('#inputEmail');

let input_Value1 = user_Name.value;
let input_Value2 = user_Email.value;

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
    input_disabled0.disabled = false;
    input_disabled1.disabled = false;
    hidden_Input.value = 1;
    showPassword.style.display = 'none';
    hide_pass.style.display = 'flex';
    pass_settings.style.display = 'grid';
    showPassword.style.marginTop = '0px';
});

form_button1.addEventListener('click', function () {
    form_button0.style.display = 'flex';
    form_button1.style.display = 'none';
    form_button2.style.display = 'none';
    input_disabled0.disabled = true;
    input_disabled1.disabled = true;
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

form_button2.addEventListener('click', function () {
    form_button0.style.display = 'flex';
    form_button1.style.display = 'none';
    form_button2.style.display = 'none';
    input_disabled0.disabled = true;
    input_disabled1.disabled = true;
    hidden_Input.value = 1;
    hide_pass.style.display = 'none';
    showPassword.style.display = 'none';
    pass_settings.style.display = 'none';
    password_area.style.display = 'none';
})

hide_pass.addEventListener('click', function () {
    password_area.style.display = 'block';
    hide_pass.style.display = 'none';
    showPassword.style.marginTop = '27px';
    showPassword.style.display = 'flex';
})

$(document).ready(function () {
    $('#accountForm').submit(function (e) {
        e.preventDefault();

        const emailValue = $('#inputEmail').val();
        const nameValue = $('#inputName').val();
        const passValue = $('#inputPass').val();
        const pass1Value = $('#inputPass1').val();
        const pass2Value = $('#inputPass2').val();

        $.ajax({
            type: 'POST',
            url: '/Estudo/Cruds/CrudPhp/config/IntermediaryAlterDatas.php',
            data: {
                email: emailValue,
                name: nameValue,
                password: passValue,
                password1: pass1Value,
                password2: pass2Value
            },
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
                        form_button2.style.display = 'none';
                        input_disabled0.disabled = true;
                        input_disabled1.disabled = true;
                        passwordInput.type = null;
                        passwordInput1.value = null;
                        passwordInput2.value = null;
                        hidden_Input.value = 0;
                        $('#response').html('');

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