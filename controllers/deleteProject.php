<?php
require_once("../includes/initializer.php");
require_once(CLASS_DIR."projects.php");

if(isset($_POST["idproyecto"]))
{        
    if($projects->deleteProjectById($_POST["idproyecto"]))
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