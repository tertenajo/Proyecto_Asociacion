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
    
    public function checkPermissions($id)
    {
        $sql="SELECT * FROM ".PREF_TABLE."administradores WHERE id_profesional=".$id;
        
        if($sql=Connection::con()->query($sql))
        {
            $cuenta=$sql->rowCount();
            if($cuenta>0)
            {
                $_SESSION["permission"]="admin";
                return true;
            }
            else
            {
                $sql="SELECT funcion.id_perfil,tipo FROM (".PREF_TABLE."funcion_proyecto as funcion JOIN ".PREF_TABLE."perfiles_profesionales as perfil ON funcion.id_perfil=perfil.id_perfil) WHERE id_profesional=".$id." GROUP BY funcion.id_perfil";
                
                if($sql=Connection::con()->query($sql))
                {
                    $cuenta=$sql->rowCount();
                    if($cuenta == 2)
                    {
                        $_SESSION["permission"]="jefeproyecto";
                        return true;
                    }
                    else
                    {
                        $sql=$sql->fetch(PDO::FETCH_ASSOC);
                        $tipo=$sql["tipo"];
                        if($tipo == "Jefe de proyecto")
                        {
                            $_SESSION["permission"]="jefeproyecto";
                            return true;
                        }
                        elseif($tipo=="Profesional")
                        {
                            $_SESSION["permission"]="profesional";
                            return true;
                        }
                        else
                        {
                            $_SESSION["permission"]="NO";
                            return true;
                        }
                    }
                }
            }
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