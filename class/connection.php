<?php
session_start();
Class Connection
{
    public static function con()
	{
        $conexion = new PDO('mysql:host='.SERVER_DB.';dbname='.NAME_DB,USER_DB,PASSWORD_DB);
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
	}
}
?>
