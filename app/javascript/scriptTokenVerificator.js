const params = new URLSearchParams(window.location.search);
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
            $('.spinner').css('display', 'none');
            $('#status').text(response);

            setTimeout(function () {
                window.location.href = "/Estudo/Cruds/CrudPhp/app/CreatAccount.php";
            }, 5000);
        },
        error: function (textStatus, errorThrown) {
            $('.spinner').css('display', 'none');
            $('#status').text(response);
            console.log(textStatus, errorThrown);
        }
    });
};