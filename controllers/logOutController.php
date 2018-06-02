<?php
require_once("../includes/initializer.php");
require_once(CLASS_DIR."access.php");

if(isset($_SESSION["user"]))
{
    $access->logOutProfessional();
}
else
{
    header("Location:".MAIN_LINK."index.php");
    exit;
}
?>