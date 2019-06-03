function removeUser(id) {
    var parametros = {
        "id": id
    };

    if (confirm('Desea eliminar el usuario?')) {
        $.ajax({
            data: parametros,
            url: rootRoute + 'management/users/remove',
            type: 'post',

            success: function (response) {
                console.log(response);
                if (!response.includes('error')) {
                    $("#user_" + id).empty();
                    $("#user_" + id).remove();

                    alert('Usuario eliminado correctamente..');
                } else {
                    $(".management-actions").html(response);
                    alert('Error al eliminar el usuario..');
                }
            }
        });
    }

}