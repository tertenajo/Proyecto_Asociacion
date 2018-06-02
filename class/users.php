<?php
require_once("connection.php");

Class Users
{
    public $users;
    public $Attachments;
    public $socialBenefits;

    public function __construct(){
        $this->users = array();
    }

    public function addUsers($codUser, $nombre, $apellidos, $dni, $sexo, $fechaNac, $direccion, $cp, $tlfMovil, $tlfFijo, $email, $pais, $estadoCivil, $nivelForma, $profesion, $situacionLaboral, $gradoDiscapacidad, $prestacionDiscapacidad, $valorDependencia, $invalidez, $otras, $observaciones)
    {
        $codUser=filter_var($codUser,FILTER_SANITIZE_STRING);
        $nombre=filter_var($nombre,FILTER_SANITIZE_STRING);
        $apellidos=filter_var($apellidos,FILTER_SANITIZE_STRING);
        $dni=filter_var($dni,FILTER_SANITIZE_STRING);
        $sexo=filter_var($sexo,FILTER_SANITIZE_STRING);
        $fechaNac=filter_var($fechaNac,FILTER_SANITIZE_STRING);
        $direccion=filter_var($direccion,FILTER_SANITIZE_STRING);
        $cp=filter_var($cp,FILTER_SANITIZE_STRING);
        $tlfMovil=filter_var($tlfMovil,FILTER_SANITIZE_STRING);
        $email=filter_var($email,FILTER_SANITIZE_STRING);
        $pais=filter_var($pais,FILTER_SANITIZE_STRING);
        $estadoCivil=filter_var($estadoCivil,FILTER_SANITIZE_STRING);
        $nivelForma=filter_var($nivelForma,FILTER_SANITIZE_STRING);
        $profesion=filter_var($profesion,FILTER_SANITIZE_STRING);
        $gradoDiscapacidad=filter_var($gradoDiscapacidad,FILTER_SANITIZE_STRING);
        $valorDependencia=filter_var($valorDependencia,FILTER_SANITIZE_STRING);
        $invalidez=filter_var($invalidez,FILTER_SANITIZE_STRING);
        $otras=filter_var($otras,FILTER_SANITIZE_STRING);
        $observaciones=filter_var($observaciones,FILTER_SANITIZE_STRING);

        $sql = "INSERT INTO ".PREF_TABLE."usuarios (cod_usuario, nombre, apellidos, DNI, sexo, fecha_nac, direccion, codigo_postal, tfno_movil, tfno_fijo, email, pais, estado_civil, nivel_formativo, profesion, situacion_laboral, grado_discapacidad, prestacion_discapacidad, valor_dependencia, invalidez, otras, observaciones, estado)
            VALUES ('$codUser', '$nombre', '$apellidos', '$dni', '$sexo', '$fechaNac', '$direccion', '$cp', '$tlfMovil', '$tlfFijo', '$email', '$pais', '$estadoCivil', '$nivelForma', '$profesion', '$situacionLaboral', '$gradoDiscapacidad', '$prestacionDiscapacidad', '$valorDependencia', '$invalidez', '$otras', '$observaciones', 'Alta')";

        if($res=Connection::con()->query($sql)){
            return true;
        }else{
            return false;
        }


    }

    public function getAllUsers()
    {
        $sql = "SELECT users.*, forma.nombre as n_formativo, laboral.nombre as n_laboral
        FROM ((".PREF_TABLE."usuarios as users 
        LEFT JOIN ".PREF_TABLE."nivel_formativo as forma on users.nivel_formativo = forma.id_formativo)
        LEFT JOIN ".PREF_TABLE."situacion_laboral as laboral on users.situacion_laboral = laboral.id_laboral)";

        if($res=Connection::con()->query($sql)){
            $this->users = $res->fetchAll(PDO::FETCH_ASSOC);
            return $this->users;
        }else{
            return false;
        }  
    }

    public function getUsersById($idUser)
    {
        $idUser=filter_var($idUser,FILTER_SANITIZE_STRING);
        
        $sql = "SELECT * FROM ".PREF_TABLE."usuarios WHERE id_usuario = $idUser";

        if($res=Connection::con()->query($sql)){
            if($res->rowcount() > 0){
                $this->users = $res->fetchAll(PDO::FETCH_ASSOC);
                $this->users = $this->users[0];
                return $this->users;
            }else{
                return false;
            }
        }else{
            return false;
        }  
    }

    public function editUsersById($idUser, $codUser, $estado, $nombre, $apellidos, $dni, $sexo, $fechaNac, $direccion, $cp, $tlfMovil, $tlfFijo, $email, $pais, $estadoCivil, $nivelForma, $profesion, $situacionLaboral, $gradoDiscapacidad, $prestacionDiscapacidad, $valorDependencia, $invalidez, $otras, $observaciones)
    {
        $idUser=filter_var($idUser,FILTER_SANITIZE_STRING);
        $codUser=filter_var($codUser,FILTER_SANITIZE_STRING);
        $estado=filter_var($estado,FILTER_SANITIZE_STRING);
        $nombre=filter_var($nombre,FILTER_SANITIZE_STRING);
        $apellidos=filter_var($apellidos,FILTER_SANITIZE_STRING);
        $dni=filter_var($dni,FILTER_SANITIZE_STRING);
        $sexo=filter_var($sexo,FILTER_SANITIZE_STRING);
        $fechaNac=filter_var($fechaNac,FILTER_SANITIZE_STRING);
        $direccion=filter_var($direccion,FILTER_SANITIZE_STRING);
        $cp=filter_var($cp,FILTER_SANITIZE_STRING);
        $tlfMovil=filter_var($tlfMovil,FILTER_SANITIZE_STRING);
        $email=filter_var($email,FILTER_SANITIZE_STRING);
        $pais=filter_var($pais,FILTER_SANITIZE_STRING);
        $estadoCivil=filter_var($estadoCivil,FILTER_SANITIZE_STRING);
        $nivelForma=filter_var($nivelForma,FILTER_SANITIZE_STRING);
        $profesion=filter_var($profesion,FILTER_SANITIZE_STRING);
        $gradoDiscapacidad=filter_var($gradoDiscapacidad,FILTER_SANITIZE_STRING);
        $valorDependencia=filter_var($valorDependencia,FILTER_SANITIZE_STRING);
        $invalidez=filter_var($invalidez,FILTER_SANITIZE_STRING);
        $otras=filter_var($otras,FILTER_SANITIZE_STRING);
        $observaciones=filter_var($observaciones,FILTER_SANITIZE_STRING);

        $sql = "UPDATE ".PREF_TABLE."usuarios 
        SET cod_usuario = '$codUser', estado = '$estado', nombre = '$nombre', apellidos = '$apellidos', dni = '$dni', sexo = '$sexo', fecha_nac = '$fechaNac', direccion = '$direccion', codigo_postal = '$cp', tfno_movil = '$tlfMovil', tfno_fijo = '$tlfFijo', email = '$email', pais = '$pais', estado_civil = '$estadoCivil', nivel_formativo = '$nivelForma', profesion = '$profesion', situacion_laboral = '$situacionLaboral', grado_discapacidad = '$gradoDiscapacidad', prestacion_discapacidad = '$prestacionDiscapacidad', valor_dependencia = '$valorDependencia', invalidez = '$invalidez', otras = '$otras', observaciones = '$observaciones'
        WHERE id_usuario = $idUser";

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
    
    public function deleteUsersById($idUser)
    {
        $idUser=filter_var($idUser,FILTER_SANITIZE_STRING);
        
        $sql = "DELETE FROM ".PREF_TABLE."usuarios WHERE id_usuario = $idUser";
        
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
    
    public function getUsersByProfessionalId($idProfessional)
    {
        $idProfessional=filter_var($idProfessional,FILTER_SANITIZE_STRING);
        
        $sql = "SELECT users.*
            FROM (((".PREF_TABLE."usuarios as Users 
            JOIN ".PREF_TABLE."sesiones_individuales as sessin on users.id_usuario = sessin.id_usuario) 
            JOIN ".PREF_TABLE."sesiones as sessions on sessin.id_sesion = sessions.id_sesion) 
            JOIN ".PREF_TABLE."sesiones_impartidas as sessim on sessions.id_sesion = sessim.id_sesion)  
            WHERE sessim.id_profesional = $idProfessional
            UNION
            SELECT users.* 
            FROM ((((".PREF_TABLE."usuarios as Users 
            JOIN ".PREF_TABLE."participacion_grupal as part on users.id_usuario = part.id_usuario) 
            JOIN ".PREF_TABLE."sesiones_grupales as sessgr on part.id_sesion = sessgr.id_sesion) 
            JOIN ".PREF_TABLE."sesiones as sessions on sessgr.id_sesion = sessions.id_sesion) 
            JOIN ".PREF_TABLE."sesiones_impartidas as sessim on sessions.id_sesion = sessim.id_sesion)  
            WHERE sessim.id_profesional = $idProfessional";

        if($res=Connection::con()->query($sql)){
            if($res->rowcount() > 0){
                $this->users = $res->fetchAll(PDO::FETCH_ASSOC);
                return $this->users;
            }else{
                return false;
            }
        }else{
            return false;
        }  
    }
    
    public function addAttachmentsByUserId($userId, $descripcion)
    {
        $userId=filter_var($userId,FILTER_SANITIZE_STRING);
        $descripcion=filter_var($descripcion,FILTER_SANITIZE_STRING);

        $sql = "INSERT INTO ".PREF_TABLE."datos_adjuntos (id_usuario, descripcion)
            VALUES ('$userId', '$descripcion')";

        if($res=Connection::con()->query($sql)){
            return true;
        }else{
            return false;
        }


    }
    
    public function getAttachmentsByUserId($idUser)
    {
        $idUser=filter_var($idUser,FILTER_SANITIZE_STRING);
        
        $sql = "SELECT * FROM ".PREF_TABLE."datos_adjuntos WHERE id_usuario = $idUser";

        if($res=Connection::con()->query($sql)){
            if($res->rowcount() > 0){
                $this->Attachments = $res->fetchAll(PDO::FETCH_ASSOC);
                return $this->Attachments;
            }else{
                return false;
            }
        }else{
            return false;
        }  
    }
    
    public function deleteAttachmentsById($idAttachment)
    {
        $idAttachment=filter_var($idAttachment,FILTER_SANITIZE_STRING);
        
        $sql = "DELETE FROM ".PREF_TABLE."datos_adjuntos WHERE id_adjunto = $idAttachment";
        
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
    
    public function addSocialBenefits($descripcion)
    {
        $descripcion=filter_var($descripcion,FILTER_SANITIZE_STRING);

        $sql = "INSERT INTO ".PREF_TABLE."prestacion_social (nombre)
            VALUES ('$descripcion')";

        if($res=Connection::con()->query($sql)){
            return true;
        }else{
            return false;
        }


    }
    
    public function getSocialBenefits()
    {
        $sql = "SELECT * FROM ".PREF_TABLE."prestacion_social";

        if($res=Connection::con()->query($sql)){
            if($res->rowcount() > 0){
                $this->SocialBenefits = $res->fetchAll(PDO::FETCH_ASSOC);
                return $this->SocialBenefits;
            }else{
                return false;
            }
        }else{
            return false;
        }  
    }
    
    public function editSocialBenefitsById($idSocialBenefits, $descripcion)
    {
        $idSocialBenefits=filter_var($idSocialBenefits,FILTER_SANITIZE_STRING);
        $descripcion=filter_var($descripcion,FILTER_SANITIZE_STRING);
        

        $sql = "UPDATE ".PREF_TABLE."prestacion_social 
        SET nombre = '$descripcion'
        WHERE id_prestacion = $idSocialBenefits";

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
    
    public function deleteSocialBenefitsById($idSocialBenefits)
    {
        $idSocialBenefits=filter_var($idSocialBenefits,FILTER_SANITIZE_STRING);
        
        $sql = "DELETE FROM ".PREF_TABLE."prestacion_social WHERE id_prestacion = $idSocialBenefits";
        
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
    
    public function addSocialBenefitsToUser($idUser, $benefitsId, $importe, $descripcion)
    {
        $idUser=filter_var($idUser,FILTER_SANITIZE_STRING);
        $benefitsId=filter_var($benefitsId,FILTER_SANITIZE_STRING);
        $importe=filter_var($importe,FILTER_SANITIZE_STRING);
        $descripcion=filter_var($descripcion,FILTER_SANITIZE_STRING);

        $sql = "INSERT INTO ".PREF_TABLE."prestacion_recibida (id_usuario, id_prestacion, importe, descripcion)
            VALUES ('$idUser', '$benefitsId', '$importe', '$descripcion')";

        if($res=Connection::con()->query($sql)){
            return true;
        }else{
            return false;
        }
    }
    
    public function getSocialBenefitsByUserId($idUser)
    {
        $idUser=filter_var($idUser,FILTER_SANITIZE_STRING);
        
        $sql = "SELECT * FROM ".PREF_TABLE."prestacion_recibida WHERE id_usuario = $idUser";

        if($res=Connection::con()->query($sql)){
            if($res->rowcount() > 0){
                $this->SocialBenefits = $res->fetchAll(PDO::FETCH_ASSOC);
                return $this->SocialBenefits;
            }else{
                return false;
            }
        }else{
            return false;
        }  
    }
    
    public function editSocialBenefitsToUser($idUser, $benefitsId, $importe, $descripcion)
    {
        $idUser=filter_var($idUser,FILTER_SANITIZE_STRING);
        $benefitsId=filter_var($benefitsId,FILTER_SANITIZE_STRING);
        $importe=filter_var($importe,FILTER_SANITIZE_STRING);
        $descripcion=filter_var($descripcion,FILTER_SANITIZE_STRING);

        $sql = "UPDATE ".PREF_TABLE."prestacion_recibida 
        SET importe = '$importe', descripcion = '$descripcion'
        WHERE id_usuario = $idUser AND id_prestacion = '$benefitsId'";

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
    
    public function deleteSocialBenefitsToUser($idUser,$benefitsId)
    {
        $idUser=filter_var($idUser,FILTER_SANITIZE_STRING);
        $benefitsId=filter_var($benefitsId,FILTER_SANITIZE_STRING);
        
        $sql = "DELETE FROM ".PREF_TABLE."prestacion_recibida WHERE id_usuario = $idUser AND id_prestacion = '$benefitsId'";
        
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
    
    public function addFormaLevels($nombre, $descripcion)
    {
        $nombre=filter_var($nombre,FILTER_SANITIZE_STRING);
        $descripcion=filter_var($descripcion,FILTER_SANITIZE_STRING);

        $sql = "INSERT INTO ".PREF_TABLE."nivel_formativo (nombre, descripcion)
            VALUES ('$nombre', '$descripcion')";

        if($res=Connection::con()->query($sql)){
            return true;
        }else{
            return false;
        }


    }
    
    public function getFormaLevels()
    {
        $sql = "SELECT * FROM ".PREF_TABLE."nivel_formativo";

        if($res=Connection::con()->query($sql)){
            if($res->rowcount() > 0){
                $this->SocialBenefits = $res->fetchAll(PDO::FETCH_ASSOC);
                return $this->SocialBenefits;
            }else{
                return false;
            }
        }else{
            return false;
        }  
    }
    
    public function editFormaLevelsById($idFormaLevel, $nombre, $descripcion)
    {
        $idFormaLevel=filter_var($idFormaLevel,FILTER_SANITIZE_STRING);
        $nombre=filter_var($nombre,FILTER_SANITIZE_STRING);
        $descripcion=filter_var($descripcion,FILTER_SANITIZE_STRING);
        

        $sql = "UPDATE ".PREF_TABLE."nivel_formativo 
        SET nombre = '$nombre', descripcion = '$descripcion'
        WHERE id_formativo = $idFormaLevel";

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
    
    public function deleteFormaLevelsById($idFormaLevel)
    {
        $idFormaLevel=filter_var($idFormaLevel,FILTER_SANITIZE_STRING);
        
        $sql = "DELETE FROM ".PREF_TABLE."nivel_formativo WHERE id_formativo = $idFormaLevel";
        
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
    
    public function addWorkSituations($nombre, $descripcion)
    {
        $nombre=filter_var($nombre,FILTER_SANITIZE_STRING);
        $descripcion=filter_var($descripcion,FILTER_SANITIZE_STRING);

        $sql = "INSERT INTO ".PREF_TABLE."situacion_laboral (nombre, descripcion)
            VALUES ('$nombre', '$descripcion')";

        if($res=Connection::con()->query($sql)){
            return true;
        }else{
            return false;
        }


    }
    
    public function getWorkSituations()
    {
        $sql = "SELECT * FROM ".PREF_TABLE."situacion_laboral";

        if($res=Connection::con()->query($sql)){
            if($res->rowcount() > 0){
                $this->SocialBenefits = $res->fetchAll(PDO::FETCH_ASSOC);
                return $this->SocialBenefits;
            }else{
                return false;
            }
        }else{
            return false;
        }  
    }
    
    public function editWorkSituationsById($idWorkSituation, $nombre, $descripcion)
    {
        $idWorkSituation=filter_var($idWorkSituation,FILTER_SANITIZE_STRING);
        $nombre=filter_var($nombre,FILTER_SANITIZE_STRING);
        $descripcion=filter_var($descripcion,FILTER_SANITIZE_STRING);
        

        $sql = "UPDATE ".PREF_TABLE."situacion_laboral 
        SET nombre = '$nombre', descripcion = '$descripcion'
        WHERE id_formativo = $idWorkSituation";

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
    
    public function deleteWorkSituationsById($idWorkSituation)
    {
        $idWorkSituation=filter_var($idWorkSituation,FILTER_SANITIZE_STRING);
        
        $sql = "DELETE FROM ".PREF_TABLE."situacion_laboral WHERE id_laboral = $idWorkSituation";
        
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
}
$users = new Users();

?>