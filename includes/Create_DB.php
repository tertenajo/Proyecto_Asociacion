<?php
require_once("../includes/initializer.php");

	$conexion=mysqli_connect("localhost","root","");
    
    $crearbd="CREATE DATABASE IF NOT EXISTS ".NAME_DB." DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_unicode_ci";
    if(mysqli_query($conexion,$crearbd))
    {
        mysqli_select_db($conexion,NAME_DB);
        
        $usuarios="CREATE TABLE IF NOT EXISTS ".PREF_TABLE."usuarios(
                    id_usuario INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,                   
                    cod_usuario CHAR(10) NOT NULL UNIQUE,
                    estado VARCHAR(4) NOT NULL,
                    nombre VARCHAR(150) NOT NULL,
                    apellidos VARCHAR(150) NOT NULL,
                 	dni CHAR(9) NOT NULL UNIQUE,
                 	sexo VARCHAR(6) NOT NULL,
                 	fecha_nac date NOT NULL,
                 	direccion VARCHAR(150) NOT NULL,
                 	codigo_postal INT(5) NOT NULL,
                 	tfno_movil VARCHAR(15) NOT NULL,
                 	tfno_fijo VARCHAR(15) NOT NULL,
                 	email VARCHAR(150) NOT NULL,
                 	pais VARCHAR(150) NOT NULL,
                 	estado_civil VARCHAR(150) NOT NULL,
                 	nivel_formativo INT(5) NOT NULL,
                 	profesion VARCHAR(150) NOT NULL,
                 	situacion_laboral INT(5) NOT NULL,
                 	discapacidad VARCHAR(2) NOT NULL,
                 	grado_discapacidad VARCHAR(3) NOT NULL,
                 	prestacion_discapacidad VARCHAR(2) NOT NULL,
                 	valor_dependencia DECIMAL(10,2) NOT NULL,
                 	invalidez VARCHAR(2) NOT NULL,
                 	otras VARCHAR(200) NOT NULL,
                 	observaciones VARCHAR(500) NOT NULL,
                    CONSTRAINT FK_Nivel_Formativo FOREIGN KEY (nivel_formativo) REFERENCES ".PREF_TABLE."nivel_formativo(id_formativo) ON UPDATE CASCADE,
                    CONSTRAINT FK_Situacion_Laboral FOREIGN KEY (situacion_laboral) REFERENCES ".PREF_TABLE."situacion_laboral(id_laboral)ON UPDATE CASCADE);";
        $datos_abjuntos="CREATE TABLE IF NOT EXISTS ".PREF_TABLE."datos_abjuntos(
                        id_adjunto INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        id_usuario INT(5) NOT NULL,
                        descripcion VARCHAR(200) NOT NULL,
                        CONSTRAINT FK_ID_Usuario FOREIGN KEY (id_usuario) REFERENCES ".PREF_TABLE."usuarios(id_usuario) ON UPDATE CASCADE ON DELETE CASCADE);";
        $nivel_formativo="CREATE TABLE IF NOT EXISTS ".PREF_TABLE."nivel_formativo(
                        id_formativo INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        nombre VARCHAR(150) NOT NULL);";
        $situacion_laboral="CREATE TABLE IF NOT EXISTS ".PREF_TABLE."situacion_laboral(
                        id_laboral INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        nombre VARCHAR(150) NOT NULL);";
        $prestacion_social="CREATE TABLE IF NOT EXISTS ".PREF_TABLE."prestacion_social(
                        id_prestacion INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        nombre VARCHAR(150) NOT NULL);";
        $prestacion_recibida="CREATE TABLE IF NOT EXISTS ".PREF_TABLE."prestacion_recibida(
                        id_usuario INT(5) NOT NULL,
                        id_prestacion INT(5) NOT NULL,
                        importe DECIMAL(6,2) NOT NULL,
                        descripcion VARCHAR(200) NOT NULL,
                        PRIMARY KEY (id_usuario,id_prestacion),
                        CONSTRAINT FK_Usuarios FOREIGN KEY (id_usuario) REFERENCES ".PREF_TABLE."usuarios(id_usuario) ON UPDATE CASCADE ON DELETE CASCADE,
                        CONSTRAINT FK_ID_Prestacion FOREIGN KEY (id_prestacion) REFERENCES ".PREF_TABLE."prestacion_social(id_prestacion) ON UPDATE CASCADE);";
        $profesionales="CREATE TABLE IF NOT EXISTS ".PREF_TABLE."profesionales(
                        id_profesional INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        nombre VARCHAR(150) NOT NULL,
                        tfno_movil VARCHAR(15) NOT NULL,
                        email VARCHAR(150) NOT NULL UNIQUE);";
        $administradores="CREATE TABLE IF NOT EXISTS ".PREF_TABLE."administradores(
                        id_admin INT(5) NOT NULL AUTO_INCREMENT,
                        id_profesional INT(5) NOT NULL UNIQUE,
                        CONSTRAINT FK_ProfesionalAdmin FOREIGN KEY (id_profesional) REFERENCES ".PREF_TABLE."profesionales(id_profesional) ON UPDATE CASCADE ON DELETE CASCADE);";
        $login="CREATE TABLE IF NOT EXISTS ".PREF_TABLE."login(
                        id_login INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        id_profesional INT(5) NOT NULL,
                        usuario VARCHAR(150) NOT NULL UNIQUE,
                        password VARCHAR(200) NOT NULL,
                        CONSTRAINT FK_Profesional FOREIGN KEY (id_profesional) REFERENCES ".PREF_TABLE."profesionales(id_profesional) ON UPDATE CASCADE ON DELETE CASCADE);";
        $perfiles_profesionales="CREATE TABLE IF NOT EXISTS ".PREF_TABLE."perfiles_profesionales(
                        id_perfil INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        tipo VARCHAR(150) NOT NULL);";
        $proyectos="CREATE TABLE IF NOT EXISTS ".PREF_TABLE."proyectos(
                        id_proyecto INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        nombre VARCHAR(150) NOT NULL UNIQUE);";
        $funcion_proyecto="CREATE TABLE IF NOT EXISTS ".PREF_TABLE."funcion_proyecto(
                        id_profesional INT(5) NOT NULL,
                        id_proyecto INT(5) NOT NULL,
                        id_perfil INT(5) NOT NULL,
                        PRIMARY KEY (id_profesional,id_proyecto,id_perfil),
                        CONSTRAINT FK_Profesional FOREIGN KEY (id_profesional) REFERENCES ".PREF_TABLE."profesionales(id_profesional) ON UPDATE CASCADE ON DELETE CASCADE,
                        CONSTRAINT FK_Proyectos FOREIGN KEY (id_proyecto) REFERENCES ".PREF_TABLE."proyectos(id_proyecto) ON UPDATE CASCADE ON DELETE CASCADE,
                        CONSTRAINT FK_Perfil_Profesional FOREIGN KEY (id_perfil) REFERENCES ".PREF_TABLE."perfiles_profesionales(id_perfil) ON UPDATE CASCADE ON DELETE CASCADE);";
        $tipo_atencion="CREATE TABLE IF NOT EXISTS ".PREF_TABLE."tipo_atencion(
                        id_atencion INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        nombre VARCHAR(150) NOT NULL);";
        $sesiones="CREATE TABLE IF NOT EXISTS ".PREF_TABLE."sesiones(
                        id_sesion INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        tipo_sesion VARCHAR(10) NOT NULL,
                        fecha_sesion date NOT NULL,
                        tipo_atencion INT(5) NOT NULL,
                        proyecto INT(5) NOT NULL,
                        estado VARCHAR(30) NOT NULL,
                        descripcion VARCHAR(200) NOT NULL,
                        CONSTRAINT FK_Atencion FOREIGN KEY (tipo_atencion) REFERENCES ".PREF_TABLE."tipo_atencion(id_atencion) ON UPDATE CASCADE,
                        CONSTRAINT FK_Proyecto FOREIGN KEY (proyecto) REFERENCES ".PREF_TABLE."proyectos(id_proyecto) ON UPDATE CASCADE);";
        $sesiones_impartidas="CREATE TABLE IF NOT EXISTS ".PREF_TABLE."sesiones_impartidas(
                        id_profesional INT(5) NOT NULL,
                        id_sesion INT(5) NOT NULL,
                        PRIMARY KEY (id_profesional,id_sesion),
                        CONSTRAINT FK_ProfesionalI FOREIGN KEY (id_profesional) REFERENCES ".PREF_TABLE."profesionales(id_profesional) ON UPDATE CASCADE,
                        CONSTRAINT FK_SesionI FOREIGN KEY (id_sesion) REFERENCES ".PREF_TABLE."sesiones(id_sesion) ON UPDATE CASCADE);";
        $sesiones_individuales="CREATE TABLE IF NOT EXISTS ".PREF_TABLE."sesiones_individuales(
                        id_sesion INT(5) NOT NULL PRIMARY KEY,
                        id_usuario INT(5) NOT NULL,                        
                        CONSTRAINT FK_UsuarioI FOREIGN KEY (id_usuario) REFERENCES ".PREF_TABLE."usuarios(id_usuario) ON UPDATE CASCADE ON DELETE CASCADE,
                        CONSTRAINT FK_SesionesI FOREIGN KEY (id_sesion) REFERENCES ".PREF_TABLE."sesiones(id_sesion) ON UPDATE CASCADE ON DELETE CASCADE);";
        $sesiones_grupales="CREATE TABLE IF NOT EXISTS ".PREF_TABLE."sesiones_grupales(
                        id_sesion INT(5) NOT NULL PRIMARY KEY,
                        CONSTRAINT FK_SesionesG FOREIGN KEY (id_sesion) REFERENCES ".PREF_TABLE."sesiones(id_sesion) ON UPDATE CASCADE ON DELETE CASCADE);";
        $participacion_grupal="CREATE TABLE IF NOT EXISTS ".PREF_TABLE."participacion_grupal(
                        id_sesion INT(5) NOT NULL,
                        id_usuario INT(5) NOT NULL,
                        PRIMARY KEY(id_sesion,id_usuario),                        
                        CONSTRAINT FK_UsuarioGR FOREIGN KEY (id_usuario) REFERENCES ".PREF_TABLE."usuarios(id_usuario) ON UPDATE CASCADE ON DELETE CASCADE,
                        CONSTRAINT FK_SesionesGR FOREIGN KEY (id_sesion) REFERENCES ".PREF_TABLE."sesiones_grupales(id_sesion) ON UPDATE CASCADE ON DELETE CASCADE);"; 
        
        if(mysqli_query($conexion,$nivel_formativo))
        {
            echo "Tabla Nivel Formativo creada<br>";
        }
        else
        {
            echo "Tabla Nivel Formativo no creada<br>";
        }        
        if(mysqli_query($conexion,$situacion_laboral))
        {
            echo "Tabla Situacion Laboral creada<br>";
        }
        else
        {
            echo "Tabla Situacion Laboral no creada<br>";
        } 
        if(mysqli_query($conexion,$usuarios))
        {
            echo "Tabla Usuarios creada<br>";
        }
        else
        {
            echo "Tabla Usuarios no creada<br>";
        }
        if(mysqli_query($conexion,$datos_abjuntos))
        {
            echo "Tabla Datos Abjuntos creada<br>";
        }
        else
        {
            echo "Tabla Datos Abjuntos no creada<br>";
        }
        if(mysqli_query($conexion,$prestacion_social))
        {
            echo "Tabla Prestacion Social creada<br>";
        }
        else
        {
            echo "Tabla Prestacion Social no creada<br>";
        }
        if(mysqli_query($conexion,$prestacion_recibida))
        {
            echo "Tabla Prestacion Recibida creada<br>";
        }
        else
        {
            echo "Tabla Prestacion Recibida no creada<br>";
        }
        if(mysqli_query($conexion,$profesionales))
        {
            echo "Tabla Profesionales creada<br>";
        }
        else
        {
            echo "Tabla Profesionales no creada<br>";
        }
        if(mysqli_query($conexion,$administradores))
        {
            echo "Tabla Administradores creada<br>";
        }
        else
        {
            echo "Tabla Administradores no creada<br>";
        }
        if(mysqli_query($conexion,$proyectos))
        {
            echo "Tabla Proyectos creada<br>";
        }
        else
        {
            echo "Tabla Proyectos no creada<br>";
        }
        if(mysqli_query($conexion,$perfiles_profesionales))
        {
            echo "Tabla Perfiles Profesionales creada<br>";
        }
        else
        {
            echo "Tabla Perfiles Profesionales no creada<br>";
        }
        if(mysqli_query($conexion,$funcion_proyecto))
        {
            echo "Tabla Funcion Proyecto creada<br>";
        }
        else
        {
            echo "Tabla Funcion Proyecto no creada<br>";
        }
        if(mysqli_query($conexion,$tipo_atencion))
        {
            echo "Tabla Tipo Atencion creada<br>";
        }
        else
        {
            echo "Tabla Tipo Atencion no creada<br>";
        }
        if(mysqli_query($conexion,$sesiones))
        {
            echo "Tabla Sesiones creada<br>";
        }
        else
        {
            echo "Tabla Sesiones no creada<br>";
        }
        if(mysqli_query($conexion,$sesiones_impartidas))
        {
            echo "Tabla Sesiones Impartidas creada<br>";
        }
        else
        {
            echo "Tabla Sesiones Impartidas no creada<br>";
        }
        if(mysqli_query($conexion,$sesiones_individuales))
        {
            echo "Tabla Sesiones Individuales creada<br>";
        }
        else
        {
            echo "Tabla Sesiones Individuales no creada<br>";
        }
        if(mysqli_query($conexion,$sesiones_grupales))
        {
            echo "Tabla Sesiones Grupales creada<br>";
        }
        else
        {
            echo "Tabla Sesiones Grupales no creada<br>";
        }
        if(mysqli_query($conexion,$participacion_grupal))
        {
            echo "Tabla Participacion Grupal creada<br>";
        }
        else
        {
            echo "Tabla Participacion Grupal no creada<br>";
        }
    }

?>