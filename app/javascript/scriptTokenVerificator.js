const params = window.location.href;
const array = params.split('/');
const lastField = array[array.length - 1];

window.onload = function () {

    $.ajax({
        url: "/Estudo/Cruds/CrudPhp/config/IntermediaryTokenVerificator.php",
        type: "GET",
        data: {
            token: lastField
        },
        success: function (response) {
            switch (response) {
                case '0':
                    $('.spinner').css('display', 'none');
                    $('#status').text('Conta ativada, você será redirecionado para que faça o login');
                    setTimeout(function () {
                        window.location.href = "/Estudo/Cruds/CrudPhp/Index.php";
                    }, 5000);
                    break;
                case '1':
                    $('.spinner').css('display', 'none');
                    $('#status').text('Ocorreu algum erro, por favor recarregue a página');
                    break;
                case '2':
                    $('.spinner').css('display', 'none');
                    $('#status').text('Ocorreu algum erro, por favor recarregue a página');
                    break;
                default:
                    $('.spinner').css('display', 'none');
                    $('#status').text('Ocorreu algum erro, por favor recarregue a página');
                    break;
            }
        },
        error: function (textStatus, errorThrown) {
            $('.spinner').css('display', 'none');
            $('#status').text(response);
            console.log(textStatus, errorThrown);
        }
    });
};