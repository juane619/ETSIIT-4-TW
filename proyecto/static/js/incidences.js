

function makeValoration(id, type) {
    var parametros = {
        "valoracion": type,
        "id": id
    };
    $.ajax({
        data: parametros,
        url: rootRoute + "incidences/make-val",
        //url: 'http://172.19.0.1/proyecto/incidences/make-val',
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

function showCommentSection(id) {
    $("#incidence-comentarios" + id).toggle(1000);

}

function insertComment(id) {
    var parametros = {
        "id": id,
        "comment": $("#insert-comment" + id + " > textarea").val()
    };

    $.ajax({
        data: parametros,
        url: rootRoute + "incidences/insert-comment",
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
                $newComment.append('<a class="remove_button btn-incidences icon-remove" href="javascript:;" onclick="removeComment(' + comment['id'] + ');return false;"></a>');
                var $content = $('<div class="content-comment">');
                var $headComment = $('<div class="head-comment">');
                $headComment.append('<div class="incidence-comment-attribute"><label>Usuario: </label><span>' + comment['usuario'] + '</span></div>');
                $headComment.append('<div class="incidence-comment-attribute"><label>Hora: </label><span>' + comment['hora'] + '</span></div>');
                $content.append($headComment);
                var $bodyComment = $('<div class="body-comment">');
                $bodyComment.append('<div class="incidence-comment-attribute"><p>' + comment['comentario'] + '</p></div>');

                $content.append($bodyComment);
                $newComment.append($content);

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
            url: rootRoute + 'incidences/remove-incidence',
            type: 'post',

            success: function (response) {
                if (!response.includes('error')) {
                    $("#incidence_" + id).empty();
                    alert('Incidencia eliminada correctamente..');
                } else {
                    alert('ERror al eliminar la incidencia..');
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
            url: rootRoute + 'incidences/remove-comment',
            type: 'post',

            success: function (response) {
                if (!response.includes('error')) {
                    $("#comment_" + id).remove();
                    alert('Comentario eliminado correctamente..');
                }
            }
        });
    }
}

function showConfirm() {
    return confirm('Desea editar la incidencia?');
}