$(document).ready(inicializarEventos);

function inicializarEventos()
{
    $("#login").bind("click",comprobarlogin);
}

function comprobarlogin()
{	
    var user = $("#user").val();
	var passwd = $("#password").val();
	if(user == "")
	{
		$("#error").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un usuario</p></div>");
	}
	else if(passwd == "")
	{
		$("#error").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca una contraseña</p></div>");
	}
	else
	{
		var parametros = {
        users: user,
        pass: passwd
		};
		var urls = "../controllers/checkLogin.php";
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
	$("#error").html("");
	if(data == "NO")
	{
		$("#error").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Usuario o contraseña erróneas</p></div>");
	}
	else if(data == "OK")
	{
		$("#loginprofessional").submit();
	}
}