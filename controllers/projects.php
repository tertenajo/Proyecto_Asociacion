<?php
require_once("../includes/initializer.php");
require_once(CLASS_DIR."projects.php");
require_once(CLASS_DIR."connection.php");

if(isset($_POST["valor"]))
{
    if(isset($_POST["names"]))
    {
        $nombre=filter_var($_POST["names"],FILTER_SANITIZE_STRING);
        $sql="SELECT * FROM ".PREF_TABLE."proyectos WHERE nombre LIKE '".$nombre."';";
        if($sql=Connection::con()->query($sql))
        {
            $cuenta=$sql->rowCount();
            if($cuenta>0)
            {
                $mensaje="NO";
                echo $mensaje;
            }
            else
            {
                $mensaje="OK";
                echo $mensaje;
            }
            
        }
    }   
}
else
{
    header("Location:".MAIN_LINK."index.php");
    exit;
}
?>