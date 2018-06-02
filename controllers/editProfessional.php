<?php
require_once("../includes/initializer.php");
require_once(CLASS_DIR."professionals.php");

if(isset($_POST["name"]))
{
    if($professional->editProfessionalById($_POST["idprofesional"],$_POST["name"],$_POST["phone"],$_POST["email"],$_POST["user"]))
    {
        header("Location:".MAIN_LINK."pages/professionals.php");
        exit;
    }
}
else
{
    header("Location:".MAIN_LINK."index.php");
    exit; 
}
?>