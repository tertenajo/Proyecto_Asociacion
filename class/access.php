<?php
require_once("connection.php");

Class Access
{
    public $user;
    
    public function __construct()
    {
        $this->user=array();
    }
    
    /* Funcion que comprueba si estas logueado el usuario */
    public function checkSessions()
    {
        if(!isset($_SESSION["user"]))
        {
            header("Location:".MAIN_LINK."pages/login.php");
            exit;
        }
    }
    
    /* Funcion que realiza el login del usuario */        
    public function loginProfessional($user,$password)
    {
        $user=filter_var(trim($_POST["user"]," "),FILTER_SANITIZE_STRING);
        $password=htmlspecialchars(trim($_POST["password"]," "));
        $password=hash('sha512',$password);
        
        $sql="SELECT id_profesional FROM ".PREF_TABLE."login WHERE usuario LIKE '".$user."' AND password LIKE '".$password."';";
        
        if($res=Connection::con()->query($sql))
        {
            $id=$res->fetch(PDO::FETCH_NUM);
            $id=$id[0];
            $info="SELECT * FROM ".PREF_TABLE."profesionales WHERE id_profesional=".$id;
            
            if($res=Connection::con()->query($info))
            {
                $this->user=$res->fetch(PDO::FETCH_ASSOC);
                return $this->user;
            }            
        }
    }
    
    /* Funcion que realizar el logout de la aplicacion */
    public function logOutProfessional()
    {
        session_start();
        $_SESSION=array();
        session_destroy();
        $this->checkSessions();
    }
    
     
}
$access= new Access();

?>