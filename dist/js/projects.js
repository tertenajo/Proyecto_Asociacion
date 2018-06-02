$(document).ready(inicializarEventos);

function inicializarEventos()
{
    $("#registrarproyecto").click(comprobarproyecto);
	$("#editarprojects").click(editarproyecto);
}

function comprobarproyecto()
{
	var name = $("#name").val();
	
	if(name == "")
	{
		$("#error").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un nombre</p></div>");
	}
	else if(!/^([a-zA-ZáéíóúÁÉÍÓÚ0-9\s])*$/.test(name))
	{
		$("#error").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un nombre de proyecto válido</p></div>");
	}
	else
	{
		var parametros = {
		valor : "OK",
        names: name
		};
		var urls = "../controllers/projects.php";
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
		$("#error").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>El proyecto ya existe</p></div>");
	}
	else if(data == "OK")
	{
		$("#registroproyecto").submit();
	}
}

function editarproyecto()
{
	var name = $("#name1").val();
	var oldname = $("#oldname").val();
	
	if(name == "")
	{
		$("#errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un nombre</p></div>");
	}
	else if(!/^([a-zA-ZáéíóúÁÉÍÓÚ0-9\s])*$/.test(name))
	{
		$("#errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un nombre de proyecto válido</p></div>");
	}
	else if(oldname != name)
	{
		var parametros = {
		valor : "OK",
        names: name
		};
		var urls = "../controllers/projects.php";
		$.ajax({async:true,
				type:"POST",
				url:urls,
				data:parametros,
				success:devuelveDatos1});
	}
	else
	{
		$("#editarproyectos").submit();
	}
    return false;
}

function devuelveDatos1(data)
{
	$("#errors").html("");
	
	if(data == "NO")
	{
		$("#errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>El proyecto ya existe</p></div>");
	}
	else if(data == "OK")
	{
		$("#editarproyectos").submit();
	}
}