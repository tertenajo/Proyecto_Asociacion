<?php
require_once("../includes/initializer.php");
require_once(CLASS_DIR."connection.php");

if(isset($_POST["users"]))
{   
    $user=filter_var(trim($_POST["users"]," "),FILTER_SANITIZE_STRING);
    $password=htmlspecialchars(trim($_POST["pass"]," "));
    $password=hash('sha512',$password);
    
    $sql="SELECT * FROM ".PREF_TABLE."login WHERE usuario LIKE '".$user."' AND password LIKE '".$password."';";
       
    if($res=Connection::con()->query($sql))
    {
        $cuenta=$res->rowCount();
        if($cuenta>0)
        {
            $mensaje="OK";
            echo $mensaje;
        }
        else
        {           
            $mensaje="NO";
            echo $mensaje;
        }             
    }   
}
else
{
    header("Location:".MAIN_LINK."index.php");
    exit;
}
?>