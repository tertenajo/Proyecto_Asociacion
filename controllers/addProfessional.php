<?php
require_once("../includes/initializer.php");
require_once(CLASS_DIR."professionals.php");

if(isset($_POST["name"]))
{        
    if($professional->addProfessional($_POST["name"],$_POST["phone"],$_POST["email"],$_POST["user"],$_POST["password"]))
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