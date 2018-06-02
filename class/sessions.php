<?php
require_once("connection.php");

Class Sessions
{
    public $sessions;

    public function __construct(){
        $sessions = array();
    }

    public function addSessionsIndividual($fechaSesion, $tipoAtencion, $proyecto, $descripcion, $estado, $idUser )
    {
        $fechaSesion=filter_var($fechaSesion,FILTER_SANITIZE_STRING);
        $tipoAtencion=filter_var($tipoAtencion,FILTER_SANITIZE_STRING);
        $proyecto=filter_var($proyecto,FILTER_SANITIZE_STRING);
        $descripcion=filter_var($descripcion,FILTER_SANITIZE_STRING);
        $estado=filter_var($estado,FILTER_SANITIZE_STRING);
        $idUser=filter_var($idUser,FILTER_SANITIZE_STRING);

        $sql = "INSERT INTO ".PREF_TABLE."sesiones (tipo_sesion, fecha_sesion, tipo_atencion, proyecto, descripcion, estado)
            VALUES ('individual', '$fechaSesion', '$tipoAtencion', '$proyecto', '$descripcion', '$estado')";

        if($res=Connection::con()->query($sql)){
            $sql = "SELECT MAX(id_sesion) as id FROM ".PREF_TABLE."sesiones ";

            $res=Connection::con()->query($sql);
            $aux = $res->fetchAll();
            $idSession = $aux[0]["id"];
            $sql = "INSERT INTO ".PREF_TABLE."sesiones_individuales (id_sesion, id_usuario)
                VALUES ('$idSession', '$idUser')";
            if($res=Connection::con()->query($sql)){
                return true;
            }else{
                $sql = "DELETE FROM ".PREF_TABLE."sesiones WHERE id_sesion = $idSession";
                $res=Connection::con()->query($sql);
                return false;
            }
        }else{
            return false;
        }
    }
    
    public function addSessionsGrupal($fechaSesion, $tipoAtencion, $proyecto, $descripcion, $estado )
    {
        $fechaSesion=filter_var($fechaSesion,FILTER_SANITIZE_STRING);
        $tipoAtencion=filter_var($tipoAtencion,FILTER_SANITIZE_STRING);
        $proyecto=filter_var($proyecto,FILTER_SANITIZE_STRING);
        $descripcion=filter_var($descripcion,FILTER_SANITIZE_STRING);
        $estado=filter_var($estado,FILTER_SANITIZE_STRING);

        $sql = "INSERT INTO ".PREF_TABLE."sesiones (tipo_sesion, fecha_sesion, tipo_atencion, proyecto, descripcion, estado)
            VALUES ('grupal', '$fechaSesion', '$tipoAtencion', '$proyecto', '$descripcion', '$estado')";

        if($res=Connection::con()->query($sql)){
            $sql = "SELECT MAX(id_sesion) as id FROM ".PREF_TABLE."sesiones ";

            $res=Connection::con()->query($sql);
            $aux = $res->fetchAll();
            $idSession = $aux[0]["id"];
            $sql = "INSERT INTO ".PREF_TABLE."sesiones_grupales (id_sesion)
                VALUES ('$idSession')";
            if($res=Connection::con()->query($sql)){
                return true;
            }else{
                $sql = "DELETE FROM ".PREF_TABLE."sesiones WHERE id_sesion = $idSession";
                $res=Connection::con()->query($sql);
                return false;
            }
        }else{
            return false;
        }
    }
    
    public function addUsersToSessionGrupal($idSession, $idUser)
    {
        $idSession=filter_var($idSession,FILTER_SANITIZE_STRING);
        $idUser=filter_var($idUser,FILTER_SANITIZE_STRING);
        
        $sql = "INSERT INTO ".PREF_TABLE."participacion_grupal (id_sesion, id_usuario)
            VALUES ('$idSession', '$idUser')";

        if($res=Connection::con()->query($sql)){
            return true;
        }else{
            return false;
        }
    }
    
    public function addProfessionalsToSession($idSession, $idProfessional)
    {
        $idSession=filter_var($idSession,FILTER_SANITIZE_STRING);
        $idProfessional=filter_var($idProfessional,FILTER_SANITIZE_STRING);
        
        $sql = "INSERT INTO ".PREF_TABLE."sesiones_impartidas (id_sesion, id_profesional)
            VALUES ('$idSession', '$idProfessional')";

        if($res=Connection::con()->query($sql)){
            return true;
        }else{
            return false;
        }
    }

    public function getAllSessions()
    {
        $sql = "SELECT * FROM ".PREF_TABLE."sesiones";

        if($res=Connection::con()->query($sql)){
            $this->sessions = $res->fetchAll();
            return $this->sessions;


        }else{
            return false;
        }  
    }

    public function getSessionsById($idSesion)
    {
        $idSesion=filter_var($idSesion,FILTER_SANITIZE_STRING);
        
        $sql = "SELECT * FROM ".PREF_TABLE."sesiones WHERE id_sesion = $idSesion";

        if($res=Connection::con()->query($sql)){
            if($res->rowcount() > 0){
                $this->sessions = $res->fetchAll();
                $this->sessions = $this->sessions[0];
                return $this->sessions;
            }else{
                return false;
            }
        }else{
            return false;
        }  
    }
    
    public function editSessionById($idSesion, $fechaSesion, $tipoAtencion, $proyecto, $descripcion, $estado)
    {
        $idSesion=filter_var($idSesion,FILTER_SANITIZE_STRING);
        $fechaSesion=filter_var($fechaSesion,FILTER_SANITIZE_STRING);
        $tipoAtencion=filter_var($tipoAtencion,FILTER_SANITIZE_STRING);
        $proyecto=filter_var($proyecto,FILTER_SANITIZE_STRING);
        $estado=filter_var($estado,FILTER_SANITIZE_STRING);

        $sql = "UPDATE ".PREF_TABLE."sesiones 
        SET fecha_sesion = '$fechaSesion', tipo_atencion = '$tipoAtencion', proyecto = '$proyecto', descripcion = '$descripcion', estado = '$estado'
        WHERE id_sesion = $idSesion";

        if($res=Connection::con()->query($sql)){
            if($res->rowcount() > 0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }


    }
    
    public function deleteSessionById($idSesion)
    {
        $idSesion=filter_var($idSesion,FILTER_SANITIZE_STRING);
        
        $sql = "DELETE FROM ".PREF_TABLE."sesiones WHERE id_sesion = $idSesion";

        if($res=Connection::con()->query($sql)){
            if($res->rowcount() > 0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }  
    }
    
    public function getSessionsByProfessionalId($idProfessional)
    {
        $idProfessional=filter_var($idProfessional,FILTER_SANITIZE_STRING);
        
        $sql = "SELECT sessions.* 
            FROM (".PREF_TABLE."sesiones as sessions 
            JOIN ".PREF_TABLE."sesiones_impartidas as sessim on sessions.id_sesion = sessim.id_sesion)  
            WHERE sessim.id_profesional = $idProfessional";

        if($res=Connection::con()->query($sql)){
            if($res->rowcount() > 0){
                $this->sessions = $res->fetchAll();
                return $this->sessions;
            }else{
                return false;
            }
        }else{
            return false;
        }  
    }
    
    public function getSessionsByProyectId($idProyect)
    {
        $idProyect=filter_var($idProyect,FILTER_SANITIZE_STRING);
        
        $sql = "SELECT sessions.* 
            FROM (".PREF_TABLE."sesiones as sessions) 
            WHERE sessions.proyecto = $idProyect";
            

        if($res=Connection::con()->query($sql)){
            if($res->rowcount() > 0){
                $this->sessions = $res->fetchAll();
                return $this->sessions;
            }else{
                return false;
            }
        }else{
            return false;
        }  
    }
    
    public function getSessionsByUserId($idUser)
    {
        $idUser=filter_var($idUser,FILTER_SANITIZE_STRING);
        
        $sql = "SELECT sessions.* 
            FROM ((".PREF_TABLE."usuarios as Users 
            JOIN ".PREF_TABLE."sesiones_individuales as sessin on users.id_usuario = sessin.id_usuario) 
            JOIN ".PREF_TABLE."sesiones as sessions on sessin.id_sesion = sessions.id_sesion) 
            WHERE users.id_usuario = $idUser
            UNION
            SELECT sessions.* 
            FROM (((".PREF_TABLE."usuarios as Users 
            JOIN ".PREF_TABLE."participacion_grupal as part on users.id_usuario = part.id_usuario) 
            JOIN ".PREF_TABLE."sesiones_grupales as sessgr on part.id_sesion = sessgr.id_sesion) 
            JOIN ".PREF_TABLE."sesiones as sessions on sessgr.id_sesion = sessions.id_sesion) 
            WHERE users.id_usuario = $idUser";

        if($res=Connection::con()->query($sql)){
            if($res->rowcount() > 0){
                $this->sessions = $res->fetchAll();
                return $this->sessions;
            }else{
                return false;
            }
        }else{
            return false;
        }  
    }
}


?>