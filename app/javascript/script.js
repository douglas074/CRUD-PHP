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
            url: '../config/IntermediaryAccount.php',
            data: formData,

            success: function (response) {
                console.log(response);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
});