<?php 
   // configuracion acceso a la BD
   define('DB_HOST','localhost');
   define('DB_USER','root');
   define('DB_PASSWORD','');
   define('DB_NAME','rrhh_base'); //BASE CON LOS NUEVOS CAMBIOS
   //define('DB_NAME','base_rrhh'); BASE ORIGINAL SIN CAMBIOS

   // Ruta de la aplicación
   define('RUTA_APP', dirname(dirname(__FILE__)));
   // Ruta url

   define('RUTA_URL','http://localhost/UNLZ-APPWEB-1C-2024/Grupo-2/Gestion_RRHH');

   // Rutas que se usan para guardar imágenes
   define('RUTA_AVATAR','/UNLZ-APPWEB-1C-2024/Grupo-2/Gestion_RRHH/public/img/avatar/');
   define('NOMBRESITIO','Gestion de Recursos Humanos');
?>