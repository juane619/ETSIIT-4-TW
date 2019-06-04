Es necesario tener un usuario con ID 6 (elegida al azar) en la BD que sera el representante de todos los visitantes para llevar la cuenta de las valoraciones, etc..

Necesario tambien tener un usuario administrador. 

Es necesario tambien que en Database.php este comentado la linea de $db->setAtribute..

Necesario que en el archivo de configuracion de la db, el host sea localhost para produccion (en desarrollo, el nombre de la maquina con la DB).

Necesario en produccion, cambiar el .htaccess, para que rediriga a la ruta correcta segun las carpetas en el servidor.
