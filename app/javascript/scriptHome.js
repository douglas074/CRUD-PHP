let passwordInput = document.querySelector('#inputPass');
let passwordInput1 = document.querySelector('#inputPass1');
let passwordInput2 = document.querySelector('#inputPass2');

let showPassword = document.querySelector('.show-hide-password');
var display = window.getComputedStyle(showPassword).getPropertyValue("display");

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

let password_area = document.querySelector('.password-area');
form_button0.addEventListener('click', function () {
    if (display == 'none') {
        showPassword.style.display = 'flex';
        password_area.style.display = 'block';
        form_button0.style.display = 'none';
        form_button1.style.display = 'block';
    }
});
form_button1.addEventListener('click', function () {

    $(document).ready(function () {
        $('#accountForm').submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();

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
                            console.log(response)
                            break;
                        default:
                            alert('Dados Salvos');
                            showPassword.style.display = 'none';
                            password_area.style.display = 'none';
                            form_button0.style.display = 'block';
                            form_button1.style.display = 'none';
                            break;
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
});