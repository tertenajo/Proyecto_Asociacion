<?php
require_once("../includes/initializer.php");
require_once(CLASS_DIR."connection.php");

if(isset($_POST["valor"]))
{   
    
    if(isset($_POST["acodUser"]))
    {
        $codUser=filter_var($_POST["acodUser"],FILTER_SANITIZE_STRING);
        $sql="SELECT * FROM ".PREF_TABLE."usuarios WHERE cod_usuario LIKE '".$codUser."'";
        if(isset($_POST["aid"])){
            $sql.=" AND id_usuario not like ".$_POST["aid"];
        }
        if($sql=Connection::con()->query($sql))
        {
            $cuenta=$sql->rowCount();
            if($cuenta>0)
            {
                $mensaje="codigo de usuario";
                echo $mensaje;
                exit();
            }
        }
    }
    
    if(isset($_POST["adni"]))
    {
        $dni=filter_var($_POST["adni"],FILTER_SANITIZE_STRING);
        $sql="SELECT * FROM ".PREF_TABLE."usuarios WHERE dni LIKE '".$dni."'";
        if(isset($_POST["aid"])){
            $sql.=" AND id_usuario not like ".$_POST["aid"];
        }
        if($sql=Connection::con()->query($sql))
        {
            $cuenta=$sql->rowCount();
            if($cuenta>0)
            {
                $mensaje="dni";
                echo $mensaje;
            }
            else
            {
                return false;
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