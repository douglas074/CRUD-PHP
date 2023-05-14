let passwordInput = document.querySelector('#inputPass');
let passwordInput1 = document.querySelector('#inputPass1');
let passwordInput2 = document.querySelector('#inputPass2');

let showPassword = document.querySelector('#showHidePassword');

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