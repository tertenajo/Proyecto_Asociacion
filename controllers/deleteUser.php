<?php
require_once("../includes/initializer.php");
require_once(CLASS_DIR."users.php");

if(isset($_POST["userId"]))
{        
    if($users->deleteUsersById($_POST["userId"]))
    {
        header("Location:".MAIN_LINK."pages/users.php");
        exit;
    }else{
        ?>
        <script>
            
            window.history.back();
            alert("Error al borrar")
        </script>
        
        <?php
    }
}
else
{
    header("Location:".MAIN_LINK."index.php");
    exit; 
}
?>