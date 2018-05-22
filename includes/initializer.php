<?php
/* Rutas de diferentes archivos */
defined("DS") ? NULL : define("DS",DIRECTORY_SEPARATOR);
defined("ROOT_DIR") ? NULL : define("ROOT_DIR","C:".DS."xampp".DS."htdocs".DS."Proyecto_Asociacion".DS);
defined("MAIN_LINK") ? NULL : define("MAIN_LINK","http://localhost/Proyecto_Asociacion/");
defined("LIB_DIR") ? NULL : define("LIB_DIR",ROOT_DIR."includes".DS);
defined("CLASS_DIR") ? NULL : define("CLASS_DIR",ROOT_DIR."class".DS);
/* Prefijo de las tablas de la BD */
defined("NAME_DB") ? NULL : define("NAME_DB","AOCD_Asociacion");
defined("PREF_TABLA") ? NULL : define("PREF_TABLA","AOCD_");
/* Otras constantes */
defined("NAME_ASOC") ? NULL : define("NAME_ASOC","AOCD - Asociación Olontense Contra la Droga");
?>