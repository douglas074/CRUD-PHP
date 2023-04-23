//token verificator
var currentUrl = window.location.href;
var params = new URLSearchParams(currentUrl);
var token = params.get("token");

// faz uma requisição AJAX para verificar o token

window.onload = function () {

    console.log(token);

    $.ajax({
        url: "/Estudo/Cruds/CrudPhp/config/TokenVerificator.php",
        type: "POST",
        data: {
            token: token
        },
        success: function (response) {
            // lida com a resposta do servidor
            console.log(response);
        },
        error: function (textStatus, errorThrown) {
            // lida com o erro da requisição AJAX
            console.log(textStatus, errorThrown);
        }
    });
};