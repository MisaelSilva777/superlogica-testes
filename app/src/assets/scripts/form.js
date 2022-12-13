var request;

$('form.register-user').on('submit', function(e) {
    e.preventDefault();

    if (request) {
        request.abort();
    }

    var $form = $(this);

    var $inputs = $form.find("input");

    var serializedData = $form.serialize();

    $inputs.prop("disabled", true);

    request = $.ajax({
        url: "/index.php/api/user",
        type: "post",
        data: serializedData
    });

    request.done(function (response, textStatus, jqXHR){
        console.log("Enviando dados...");
    });

    request.fail(function (jqXHR, textStatus, errorThrown){
        console.error(
            "Ocorreu um erro na criação do usuário"+
            textStatus, errorThrown
        );
    });

    request.always(function () {
        $inputs.prop("disabled", false);
        response = request.responseJSON;

        if ( request.responseJSON.error ) {
            $('.register-user .alert-error').remove();
            $('.register-user').prepend(
                "<div class='alert alert-error alert-danger' role='alert'>" +
                    request.responseJSON.error +
                "</div>"
            );
        }

        if ( request.responseJSON.data ) {
            $('.register-user .alert-success').remove();
            $('.register-user').prepend(
                "<div class='alert alert-success alert-success' role='alert'>" +
                    request.responseJSON.data +
                "</div>"
            );
        }

    });
});


$(document).ready(function(){
    request = $.ajax({
        url: "/index.php/api/users",
        type: "get"
    });

    request.done(function (response, textStatus, jqXHR){
        console.log("Obtendo tabela...");
    });

    request.always(function () {
        response = request.responseJSON;

        if ( request.responseJSON.data ) {
           let data = request.responseJSON.data;

           for( let i = 0; i < data.length; i++) {
                $('table.table-users tbody').append(
                    "<tr>"+
                        "<th scope='row'>"+data[i].id+"</th>"+
                        "<td>"+data[i].name+"</td>"+
                        "<td>"+data[i].username+"</td>"+
                        "<td>"+data[i].zipcode+"</td>"+
                        "<td>"+data[i].email+"</td>"+
                    "</tr>"
                );
           }
        }

    });
});
