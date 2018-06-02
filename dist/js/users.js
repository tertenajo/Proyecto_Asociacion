$(document).ready(inicializarEventos);

function inicializarEventos()
{
    $("#btnRegistroUsuario").click(comprobarUsuario);
	$("#btnEditarUsuario").click(editarUsuario);
	//$("#insertarmas").click(insertar);
	//$("#modal-default2").on('hide.bs.modal', comprobarselects);
	//$(".eliminar").click(eliminarprofesional);
}

function preUser(type){
    $("#"+type+"Errors").html("");
    
    var codUser = $("#"+type+"CodUser").val();
	var dni = $("#"+type+"Dni").val();
	var name = $("#"+type+"Name").val();
	var subname = $("#"+type+"Subname").val();
	var birthdate = $("#"+type+"Birthdate").val();
	var adress = $("#"+type+"Adress").val();
	var cp = $("#"+type+"Cp").val();
	var country = $("#"+type+"Country").val();
	var mobilephone = $("#"+type+"Mobilephone").val();
	var telephone = $("#"+type+"Telephone").val();
    var email = $("#"+type+"Email").val();
    var civilState = $("#"+type+"CivilState").val();
    var profession = $("#"+type+"Profession").val();
    var impairmentDegree = $("#"+type+"ImpairmentDegree").val();
    var impairmentBenefit = $("#"+type+"ImpairmentBenefit").val();
    var DependencyValue = $("#"+type+"DependencyValue").val();

    if(codUser == "")
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un codigo de usuario</p></div>");
	}
	else if(!/^[A-Za-z0-9\s]+$/.test(codUser))
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>El codigo debe ser alfanumerico</p></div>");
	}
    else if(dni == "")
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un DNI</p></div>");
	}
	else if(!/^[A-Za-z]*[0-9]*[A-Za-z]*$/.test(dni))
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>El DNI debe ser alfanumerico</p></div>");
	}
	else if(name == "")
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un nombre</p></div>");
	}
	else if(!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(name))
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>No puedes introducir números en el nombre</p></div>");
	}
	else if(subname == "")
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un apellido</p></div>");
	}
	else if(!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(subname))
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>No puedes introducir números en el apellido</p></div>");
	}
    else if(birthdate == "")
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca una fecha de nacimiento</p></div>");
	}
	else if(adress == "")
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca una direción</p></div>");
	}
	else if(!/^[\d\w\sÁÉÍÓÚáéíóúÑñ:()-;,.]+$/.test(adress))
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>La direción debe ser alfanumérico</p></div>");
	}
    else if(cp == "")
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un codigo postal</p></div>");
	}
	else if(!/^[0-9]*$/.test(cp))
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>El codigo postal debe ser numérico</p></div>");
	}
    else if(country == "")
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un pais</p></div>");
	}
	else if(!/^[\w\sÁÉÍÓÚáéíóúÑñ]+$/.test(country))
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>No puedes introducir números en el pais</p></div>");
	}
	else if(!/^\d*$/.test(mobilephone))
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca solo números en el teléfono movil</p></div>");
	}
	else if(!/^\d*$/.test(telephone))
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca solo números en el teléfono fijo</p></div>");
	}
	else if(email == "")
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un email</p></div>");
	}
	else if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un email correcto</p></div>");
	}
    else if(civilState == "")
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un estado civil</p></div>");
	}
	else if(!/^[\w\sÁÉÍÓÚáéíóúÑñ]+$/.test(civilState))
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>No puedes introducir caracteres no alfanumericos en el estado civil</p></div>");
	}
    else if(profession == "")
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca una profesión</p></div>");
	}
	else if(!/^[\w\sÁÉÍÓÚáéíóúÑñ]+$/.test(profession))
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>No puedes introducir caracteres no alfanumericos en la profesión</p></div>");
	}
    else if(impairmentDegree == "")
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un grado de discapacidad</p></div>");
	}
	else if(impairmentDegree < 0 && impairmentDegree > 100)
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>No se admiten menores de 0 y mayores de 100</p></div>");
	}
    else if(impairmentBenefit == "")
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca una prestacion por discapaidad</p></div>");
	}
    else if(DependencyValue == "")
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca una prestacion por discapaidad</p></div>");
	}
	else if(DependencyValue < 0 && DependencyValue > 100)
	{
		$("#"+type+"Errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>No se admiten menores de 0 y mayores de 100</p></div>");
	}else{
        return true;
    }
    return false;
}

function comprobarUsuario()
{
    var codUser = $("#addCodUser").val();
	var dni = $("#addDni").val();
    
    if(preUser("add"))
    {
		var parametros = {
            valor: "OK",
            acodUser: codUser,
            adni: dni
		};
		var urls = "../controllers/users.php";
		$.ajax({async:true,
				type:"POST",
				url:urls,
				data:parametros,
				success:devuelveDatos});
	}	
	
    return false;
}

function devuelveDatos(data)
{
	if(data != false)
	{
		$("#addErrors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>El "+data+" ya existe</p></div>");
	}
	else
	{
		$("#registroUsuario").submit();
	}
}

function editarUsuario()
{
	var id = $("#userId").val();
	var codUser = $("#editCodUser").val();
	var dni = $("#editDni").val();
    
    if(preUser("edit"))
    {
		var parametros = {
            valor: "OK",
            acodUser: codUser,
            adni: dni,
            aid: id
		};
		var urls = "../controllers/users.php";
		$.ajax({async:true,
				type:"POST",
				url:urls,
				data:parametros,
				success:devuelveDatos1});
	}	
    return false;
}

function devuelveDatos1(data)
{
	if(data != false)
	{
		$("#editErrors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>El "+data+" ya existe</p></div>");
	}
	else
	{
		$("#editarUsuarios").submit();
	}
}