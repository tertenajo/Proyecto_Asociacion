<?php
require_once("connection.php");

Class Projects
{
    public $project;
    public $profiles;
    
    public function __construct()
    {
        $this->project=array();
        $this->profiles=array();
    }
    
    public function getAllProjects()
    {
        $sql="SELECT * FROM ".PREF_TABLE."proyectos";
        if($sql=Connection::con()->query($sql))
        {
            $this->project=$sql->fetchAll(PDO::FETCH_ASSOC);
            return $this->project;
        }
    }
    
    public function getAllProfiles()
    {
        $sql="SELECT * FROM ".PREF_TABLE."perfiles_profesionales";
        if($sql=Connection::con()->query($sql))
        {
            $this->profiles=$sql->fetchAll(PDO::FETCH_ASSOC);
            return $this->profiles;
        }
    }
    
    public function addProject($name)
    {
        $sql="INSERT INTO ".PREF_TABLE."proyectos (id_proyecto,nombre) VALUES(0,'".$name."');";
        if($sql=Connection::con()->query($sql))
        {
            return true;
        }
    }
    
    public function deleteProjectById($id)
    {
        $sql="DELETE FROM ".PREF_TABLE."proyectos WHERE id_proyecto=".$id;
        
        if($sql=Connection::con()->query($sql))
        {
            return true;
        }
    }
    
    public function editProjectById($id,$name)
    {
        $sql="UPDATE ".PREF_TABLE."proyectos SET nombre='".$name."' WHERE id_proyecto=".$id;
        
        if($sql=Connection::con()->query($sql))
        {
            return true;
        }
    }    
     
}
$projects= new Projects();

?>