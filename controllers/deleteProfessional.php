<?php
require_once("../includes/initializer.php");
require_once(CLASS_DIR."professionals.php");

if(isset($_POST["idprofesional"]))
{
    if($professional->deleteProfessionalById($_POST["idprofesional"]))
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