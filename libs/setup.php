<?php
// Obtiene la instancia del objeto que guarda los datos de configuración
$config = Config::singleton();

// Carpetas para los Controladores, los Modelos y las Vistas
$config->set('controllersFolder', 'controllers/');
$config->set('modelsFolder', 'models/');
$config->set('viewsFolder', 'views/');

// Parámetros de conexión a la BD
$config->set('dbhost', 'containers-us-west-181.railway.app:7910');
$config->set('dbname', 'railway');
$config->set('dbuser', 'root');
$config->set('dbpass', 'EUM30bNuGgIhvJBL8S1J');
?>