<?php
require_once("../includes/initializer.php");
require_once(CLASS_DIR."professionals.php");

if(isset($_POST["proyecto"]))
{
    $id=$_POST["idprofesional"];
    $proyectos=$_POST["proyecto"];
    $perfiles=$_POST["perfil"];
    
    $sql="DELETE FROM ".PREF_TABLE."funcion_proyecto WHERE id_profesional=".$id;
    if($sql=Connection::con()->query($sql))
    {
        $total=count($proyectos);
    
        for($i=0;$i<$total;$i++)
        {
            $insertprojectrol="INSERT INTO ".PREF_TABLE."funcion_proyecto (id_profesional,id_proyecto,id_perfil) VALUES (".$id.",".$proyectos[$i].",".$perfiles[$i].");";
            $insertprojectrol=Connection::con()->query($insertprojectrol);
        }
    }                    
    header("Location:".MAIN_LINK."pages/professionals.php");
    exit;                           
}
else
{
    header("Location:".MAIN_LINK."index.php");
    exit; 
}
?>