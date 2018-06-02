<?php
require_once("../includes/initializer.php");
require_once(CLASS_DIR."projects.php");

if(isset($_POST["idproyecto"]))
{        
    if($projects->editProjectById($_POST["idproyecto"],$_POST["name"]))
    {
        header("Location:".MAIN_LINK."pages/projects.php");
        exit;
    }
}
else
{
    header("Location:".MAIN_LINK."index.php");
    exit; 
}
?>