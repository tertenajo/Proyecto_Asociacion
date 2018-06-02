<?php
require_once("../includes/initializer.php");
require_once(CLASS_DIR."professionals.php");
require_once(CLASS_DIR."projects.php");
require_once(CLASS_DIR."connection.php");

if(isset($_POST["valor"]))
{
    if(isset($_POST["email"]))
    {
        $email=filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
        $sql="SELECT * FROM ".PREF_TABLE."profesionales WHERE email LIKE '".$email."';";
        if($sql=Connection::con()->query($sql))
        {
            $cuenta=$sql->rowCount();
            if($cuenta>0)
            {
                $mensaje="email";
                echo $mensaje;
                exit;
            }
        }
    }
    
    if(isset($_POST["user"]))
    {
        $user=filter_var($_POST["user"],FILTER_SANITIZE_STRING);
        $sql="SELECT * FROM ".PREF_TABLE."login WHERE usuario LIKE '".$user."';";
            if($sql=Connection::con()->query($sql))
            {
                $cuenta=$sql->rowCount();
                if($cuenta>0)
                {
                    $mensaje="usuario";
                    echo $mensaje;
                    exit;
                }               
            }
    }    
}
elseif(isset($_GET["estado"]) && $_GET["estado"]=="ok")
{
    $proyectos=$projects->getAllProjects();
    $perfiles=$projects->getAllProfiles();
    $proyectosperfiles=array("proyectos"=>$proyectos,"perfiles"=>$perfiles);
    $proyectosperfiles=json_encode($proyectosperfiles);
    echo $proyectosperfiles;
}
elseif(isset($_GET["idprof"]))
{
    $idprof=$_GET["idprof"];
    $funciones=$professional->getFunctionsByProfessionalId($idprof);
    $proyectos=$projects->getAllProjects();
    $perfiles=$projects->getAllProfiles();
    $funcionesroles=array("funciones"=>$funciones,"proyectos"=>$proyectos,"perfiles"=>$perfiles);
    $funcionesroles=json_encode($funcionesroles);
    echo $funcionesroles;
}
else
{
    header("Location:".MAIN_LINK."index.php");
    exit;
}
?>