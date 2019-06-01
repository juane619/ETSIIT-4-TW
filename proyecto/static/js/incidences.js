

function makeValoration(id, type) {
    var parametros = {
        "valoracion": type,
        "id": id
    };
    $.ajax({
        data: parametros,
        url: 'http://172.19.0.1/proyecto/incidences/make-val',
        type: 'get',

        success: function (response) {
            if (response.includes('error')) {
                alert('No puedes valorar mas de una vez..');
                return;
            }
            if (type == 'positive')
                $("#positive_vals" + id).html(response);
            else
                $("#negative_vals" + id).html(response);
        }
    });
}

function showCommentForm(id) {
    $("#insert-comment" + id).toggle(1000);
}

function insertComment(id) {
    var parametros = {
        "id": id,
        "comment": $("#insert-comment" + id + " > textarea").val()
    };

    $.ajax({
        data: parametros,
        url: 'http://172.19.0.1/proyecto/incidences/insert-comment',
        type: 'post',

        success: function (response) {
            var comment = JSON.parse(response);
            //console.log(comment);
            if (response == false) {
                alert('No puedes comentar..');
                $("#negative_vals" + id).html(response);
            } else if (comment == "vacio") {
                alert('El comentario no puede estar vacio..');
            } else if (comment == "largo") {
                alert('La longitud del comentario no puede superar los 300 caracteres..');
            }
            else {
                var comment = JSON.parse(response);
                var $newComment = $('<div class="incidence-comentario" id="comment_' + comment['id'] + '">');
                $newComment.append('<div class="incidence-comment-attribute">Usuario: <span>' + comment['usuario'] + '</span></div>');
                $newComment.append('<div class="incidence-comment-attribute">Hora: <span>' + comment['hora'] + '</span></div>');
                $newComment.append('<div class="incidence-comment-attribute">Comentario: <span>' + comment['comentario'] + '</span></div>');
                $newComment.append('<a class="remove_button btn-incidences icon-remove" href="javascript:;" onclick="removeComment(' + comment['id'] + ');return false;"></a>');
                $("#incidence-comentarios" + comment['incidencia']).append($newComment);
                alert('Comentario insertado correctamente..');
            }
        }
    });
}



function removeIncidence(id) {
    var parametros = {
        "id": id
    };

    if (confirm('Desea eliminar la incidencia?')) {
        $.ajax({
            data: parametros,
            url: 'http://172.19.0.1/proyecto/incidences/remove-incidence',
            type: 'post',

            success: function (response) {
                if (response != 'error') {

                    $("#incidence_" + id).empty();
                    alert('Incidencia eliminada correctamente..');
                }
            }
        });
    }
}

function removeComment(id) {
    var parametros = {
        "id": id
    };

    if (confirm('Desea eliminar el comentario?')) {
        $.ajax({
            data: parametros,
            url: 'http://172.19.0.1/proyecto/incidences/remove-comment',
            type: 'post',

            success: function (response) {
                if (response != 'error') {
                    $("#comment_" + id).empty();
                    alert('Comentario eliminado correctamente..');
                }
            }
        });
    }
}

function showConfirm() {
    return confirm('Desea editar la incidencia?');
}