const params = new URLSearchParams(window.location.search);
const token = params.get('token');

window.onload = function () {

    $.ajax({
        url: "/Estudo/Cruds/CrudPhp/config/IntermediaryTokenVerificator.php",
        type: "GET",
        data: {
            token: token
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