$(document).ready(function () {
    $('#accountForm').submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $('#accountForm :input').prop('disabled', true);
        $.ajax({
            type: 'POST',
            url: '/Estudo/Cruds/CrudPhp/config/IntermediaryResetPassword.php',
            data: formData,
            beforeSend: function () {
                $('#response').html('Enviando...');
            },
            success: function (response) {
                switch (response) {
                    case '0':
                        $('#response').css('display', 'none');
                        $('#accountForm :input').prop('disabled', false);
                        alert('Erro ao enviar email, por favor tente novamente');
                        break;
                    case '1':
                        $('#response').css('display', 'none');
                        alert('Email enviado, por favor verifique seu email para poder refinir sua senha.');
                        window.location.href = "/Estudo/Cruds/CrudPhp";
                        console.log(response);
                        break;
                    default:
                        $('#accountForm :input').prop('disabled', false);
                        $('#response').css('display', 'none');
                        alert(response);
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