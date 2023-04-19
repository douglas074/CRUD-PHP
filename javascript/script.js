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