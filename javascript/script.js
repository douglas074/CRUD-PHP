let passwordInput = document.querySelector('#inputPass');
let passwordButton = document.querySelector('#passwordButton');

passwordButton.addEventListener('click', function () {
    if (passwordInput.type == 'password') {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
})