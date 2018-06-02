<?php
/* Rutas de diferentes archivos */
defined("DS") ? NULL : define("DS",DIRECTORY_SEPARATOR);
defined("ROOT_DIR") ? NULL : define("ROOT_DIR","C:".DS."xampp".DS."htdocs".DS."Proyecto_Asociacion".DS);
defined("MAIN_LINK") ? NULL : define("MAIN_LINK","http://localhost/Proyecto_Asociacion/");
defined("LIB_DIR") ? NULL : define("LIB_DIR",ROOT_DIR."includes".DS);
defined("CLASS_DIR") ? NULL : define("CLASS_DIR",ROOT_DIR."class".DS);
/* Constantes de BD */
defined("PREF_TABLE") ? NULL : define("PREF_TABLE","AOCD_");
defined("SERVER_DB") ? NULL : define("SERVER_DB","localhost");
defined("NAME_DB") ? NULL : define("NAME_DB","AOCD_Asociacion");
defined("USER_DB") ? NULL : define("USER_DB","root");
defined("PASSWORD_DB") ? NULL : define("PASSWORD_DB","");
/* Otras constantes */
defined("NAME_ASOC") ? NULL : define("NAME_ASOC","AOCD - Asociación Olontense Contra la Droga");
?>