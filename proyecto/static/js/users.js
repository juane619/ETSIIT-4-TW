function removeUser(id) {
    var parametros = {
        "id": id
    };

    if (confirm('Desea eliminar el usuario?')) {
        $.ajax({
            data: parametros,
            url: 'http://172.19.0.1/proyecto/management/users/remove',
            type: 'post',

            success: function (response) {
                if (response != 'error') {
                    $("#user_" + id).empty();
                    alert('Usuario eliminado correctamente..');
                }
            }
        });
    }

}