<?php
require_once("../includes/initializer.php");
require_once(CLASS_DIR."users.php");

if(isset($_POST["name"]))
{        
    if($users->addUsers($_POST["codUser"], $_POST["name"], $_POST["subname"], $_POST["dni"], $_POST["sex"], $_POST["birthdate"], $_POST["adress"], $_POST["cp"], $_POST["mobilephone"], $_POST["telephone"], $_POST["email"], $_POST["country"], $_POST["civilState"], $_POST["formaLevel"], $_POST["profession"], $_POST["workSituation"], $_POST["impairmentDegree"], $_POST["impairmentBenefit"], $_POST["dependencyValue"], $_POST["disability"], $_POST["others"], $_POST["observations"]))
    {
        header("Location:".MAIN_LINK."pages/users.php");
        exit;
    }else{
        ?>
        <script>
            
            window.history.back();
            alert("Error al insertar")
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