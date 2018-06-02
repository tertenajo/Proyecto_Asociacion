<?php 
require_once("../includes/initializer.php");
require_once(CLASS_DIR."/sessions.php");

$class = new Sessions();

$idProfessional=1;
$idUser= 11;
$codUser = 'codUser21';
$estado = 'alta';
$tipoSesion = 'individual';
$proyecto = '1';
$observaciones = 'observaciones';
$descripcion = 'descripcion';
$tipoAtencion = '1';

$usuarios= $users->addSessions($tipoSesion, $fechaSesion, $tipoAtencion, $proyecto, $descripcion);
echo "<pre>";
print_r($usuarios);
echo "</pre>";

?>