<?php
require_once("connection.php");

Class Professionals
{
    public $professional;
    public $functions;
    
    public function __construct()
    {
        $this->professional=array();
        $this->functions=array();
    }
    public function getAllProfessionals()
    {
        $sql="SELECT prof.*,admin.id_profesional as admin,login.usuario FROM (".PREF_TABLE."profesionales as prof LEFT JOIN ".PREF_TABLE."administradores as admin ON prof.id_profesional=admin.id_profesional)LEFT JOIN ".PREF_TABLE."login as login ON login.id_profesional=prof.id_profesional;";
        
        if($sql=Connection::con()->query($sql))
        {
            $this->professional=$sql->fetchAll(PDO::FETCH_ASSOC);
            return $this->professional;
        }
    }
    public function getFunctionsByProfessionalId($id)
    {
        $sql="SELECT * FROM ".PREF_TABLE."funcion_proyecto WHERE id_profesional=".$id;
        
        if($sql=Connection::con()->query($sql))
        {
            $this->functions=$sql->fetchAll(PDO::FETCH_ASSOC);
            return $this->functions;
        }
    }
    public function addProfessional($name,$phone,$email,$user,$password)
    {
        $name=filter_var($name,FILTER_SANITIZE_STRING);
        $email=filter_var($email,FILTER_SANITIZE_EMAIL);
        $user=filter_var($user,FILTER_SANITIZE_STRING);
        $password=htmlspecialchars($password);
        
        $password=hash('sha512',$password);
        
        $sql="INSERT INTO ".PREF_TABLE."profesionales (id_profesional,nombre,telefono,email) VALUES (0,'".$name."','".$phone."','".$email."');";
        
        if($res=Connection::con()->query($sql))
        {
            $id="SELECT MAX(id_profesional) AS id FROM ".PREF_TABLE."profesionales";
            
            if($id=Connection::con()->query($id))
            {
                $id=$id->fetch(PDO::FETCH_NUM);
                $id=$id[0];
                $insertlogin="INSERT INTO ".PREF_TABLE."login (id_login,id_profesional,usuario,password) VALUES (0,".$id.",'".$user."','".$password."');";
                
                if($insertlogin=Connection::con()->query($insertlogin))
                {
                    if(isset($_POST["administrador"]))
                    {
                        $sql="INSERT INTO ".PREF_TABLE."administradores (id_admin,id_profesional) VALUES (0,".$id.");";
                        if($sql=Connection::con()->query($sql))
                        {
                            return true;
                        }
                    }
                    return true;
                }
            }
        }
    }
    public function editProfessionalById($id,$name,$phone,$email,$user)
    {
        $name=filter_var($name,FILTER_SANITIZE_STRING);
        $email=filter_var($email,FILTER_SANITIZE_EMAIL);
        $user=filter_var($user,FILTER_SANITIZE_STRING);   
        
        $sql="UPDATE ".PREF_TABLE."profesionales SET nombre='".$name."',telefono='".$phone."',email='".$email."' WHERE id_profesional=".$id.";";
        if($res=Connection::con()->query($sql))
        {                
            if(isset($_POST["password"]))
            {
                $password=htmlspecialchars($_POST["password"]);        
                $password=hash('sha512',$password);
                $editlogin="UPDATE ".PREF_TABLE."login SET usuario='".$user."',password='".$password."' WHERE id_profesional=".$id.";";
            }
            else
            {
                $editlogin="INSERT INTO ".PREF_TABLE."login (id_login,id_profesional,usuario,password) VALUES (0,".$id.",'".$user."');";
            }                
                
            if($editlogin=Connection::con()->query($editlogin))
            {
                if(isset($_POST["administrador"]))
                {
                    $sql="INSERT INTO ".PREF_TABLE."administradores (id_admin,id_profesional) VALUES (0,".$id.");";
                    if($sql=Connection::con()->query($sql))
                    {
                            return true;
                    }
                }
                else
                {
                    $sql="DELETE FROM ".PREF_TABLE."administradores WHERE id_profesional=".$id.";";
                    if($sql=Connection::con()->query($sql))
                    {
                            return true;
                    }
                }
                return true;
            }
        }
    }
    
    public function deleteProfessionalById($id)
    {
        $sql="DELETE FROM ".PREF_TABLE."profesionales WHERE id_profesional=".$id;
        
        if($sql=Connection::con()->query($sql))
        {
            return true;
        }
    }
    
}
$professional = new Professionals();
?>