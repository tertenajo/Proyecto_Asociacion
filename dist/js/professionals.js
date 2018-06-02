$(document).ready(inicializarEventos);

function inicializarEventos()
{
    $("#registrarprofesionales").click(comprobarprofesional);
	$("#editarprofesional").click(editarprofesional);
	$("#insertarmas").click(insertar);
	$(".projects").click(listar);
	$("#guardar").click(comprobarselects);
	$("#proyectosroles").on('hide.bs.modal', function(){
		$("#projects").html("");
		$("#roles").html("");
	});
}

function comprobarprofesional()
{
	var name = $("#name").val();
	var phone = $("#phone").val();
    var emails = $("#email").val();
	var users = $("#user").val();
	var passwd = $("#password").val();
	
	if(name == "")
	{
		$("#error").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un nombre</p></div>");
	}
	else if(!/^([a-zA-ZáéíóúÁÉÍÓÚ\s])*$/.test(name))
	{
		$("#error").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>No puedes introducir números en el nombre</p></div>");
	}
	else if(phone == "")
	{
		$("#error").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un teléfono</p></div>");
	}
	else if(phone.length > 15)
	{
		$("#error").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Solo se pueden insertar 15 digitos</p></div>");
	}
	else if(!/^([0-9])*$/.test(phone))
	{
		$("#error").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca solo números en el teléfono</p></div>");
	}
	else if(emails == "")
	{
		$("#error").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un email</p></div>");
	}
	else if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(emails))
	{
		$("#error").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un email correcto</p></div>");
	}
	else if(users == "")
	{
		$("#error").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un usuario</p></div>");
	}
	else if(/\s/.test(users))
	{
		$("#error").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>No se permite espacios en el usuario</p></div>");
	}
	else if(passwd == "")
	{
		$("#error").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca una contraseña</p></div>");
	}
	else if(/\s/.test(passwd))
	{
		$("#error").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>No se permite espacios en la contraseña</p></div>");
	}
	else
	{
		var parametros = {
		valor : "OK",
        email: emails,
        user: users
		};
		var urls = "../controllers/professional.php";
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
	if(data != false)
	{
		$("#error").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>El "+data+" ya existe</p></div>");
	}
	else
	{
		$("#registroprofesional").submit();
	}
}

function listar()
{
	var idprofesional=$(this).attr("id");
	$("#idprofesional").val(idprofesional);
	var urls = "../controllers/professional.php?idprof="+idprofesional;
	$.get(urls,procesarEventos2);
}

function procesarEventos2(dato)
{
	
    var jsonActivo = jQuery.parseJSON(dato);
	var funciones = jsonActivo.funciones;
	var proyectos = jsonActivo.proyectos;
	var perfiles = jsonActivo.perfiles;
	var numproyectosmax= funciones.length;
	for (var f = 0; f<numproyectosmax; f++)
	{
		var project = funciones[f].id_proyecto;
		var rol=funciones[f].id_perfil;
		
		if($("#projects select").last().attr("id") != undefined)
		{
			var idproject=parseInt($("#projects select").last().attr("id").split("-")[1]);
		}
		else
		{
			var idproject=0;
		}
			
		if($("#roles select").last().attr("id") != undefined)
		{
			var idroles=parseInt($("#roles select").last().attr("id").split("-")[1]);
		}
		else
		{
			var idroles=0;
		}
			
		var idproyecto = eval(idproject + 1);
		var idrol = eval(idroles + 1);
		$("#projects").append("<select class='form-control select2' style='width: 100%;margin-bottom:10px;' name='proyecto[]' id='proyecto-"+idproyecto+"'></select>");
		
		for(var i =0;i < proyectos.length; i++)
		{
			var id=proyectos[i].id_proyecto;
			var nombre=proyectos[i].nombre;
			if(project == id)
			{
				$("#proyecto-"+idproyecto).append("<option value='"+id+"' class='select2-results__option' aria-disabled='true' selected>"+nombre+"</option>");
			}
			else
			{
				$("#proyecto-"+idproyecto).append("<option value='"+id+"' class='select2-results__option' aria-disabled='true'>"+nombre+"</option>");
			}			
		}
			
		$("#roles").append("<div class='input-group' style='margin-bottom:10px;' id='fila-"+idrol+"'><select class='form-control select2' style='width: 100%;' name='perfil[]' id='perfil-"+idrol+"'></select><div class='input-group-btn'><button class='btn btn-success botoneliminar' type='button' id='boton-"+idrol+"'><i class='glyphicon glyphicon-remove'></i></button></div></div>");
			
		for(var i =0;i < perfiles.length; i++)
		{
			var id=perfiles[i].id_perfil;
			var tipo=perfiles[i].tipo;
			if(rol == id)
			{
				$("#perfil-"+idrol).append("<option value='"+id+"' selected>"+tipo+"</option>");
			}
			else
			{
				$("#perfil-"+idrol).append("<option value='"+id+"'>"+tipo+"</option>");
			}
		}
	}
	vincularEvento();
}

function insertar()
{
	var urls = "../controllers/professional.php?estado=ok";
	$.get(urls,procesarEventos1);
}

function procesarEventos1(datos)
{
    var jsonActivo = jQuery.parseJSON(datos);
	var proyectos = jsonActivo.proyectos;
	var perfiles = jsonActivo.perfiles;
	var numproyectosmax= proyectos.length;
	var numproyectosadd = $("#projects select").length;
	if(numproyectosmax != numproyectosadd)
	{
		if($("#projects select").last().attr("id") != undefined)
		{
			var idproject=parseInt($("#projects select").last().attr("id").split("-")[1]);
		}
		else
		{
			var idproject=0;
		}
		
		if($("#roles select").last().attr("id") != undefined)
		{
			var idroles=parseInt($("#roles select").last().attr("id").split("-")[1]);
		}
		else
		{
			var idroles=0;
		}
		
		var idproyecto = eval(idproject + 1);
		var idrol = eval(idroles + 1);
		$("#projects").append("<select class='form-control select2' style='width: 100%;margin-bottom:10px;' name='proyecto[]' id='proyecto-"+idproyecto+"'></select>");
		
		for(var i =0;i < proyectos.length; i++)
		{
			var id=proyectos[i].id_proyecto;
			var nombre=proyectos[i].nombre;
			$("#proyecto-"+idproyecto).append("<option value='"+id+"' class='select2-results__option' aria-disabled='true'>"+nombre+"</option>");
		}
		
		$("#roles").append("<div class='input-group' style='margin-bottom:10px;' id='fila-"+idrol+"'><select class='form-control select2' style='width: 100%;' name='perfil[]' id='perfil-"+idrol+"'></select><div class='input-group-btn'><button class='btn btn-success botoneliminar' type='button' id='boton-"+idrol+"'><i class='glyphicon glyphicon-remove'></i></button></div></div>");
		
		for(var i =0;i < perfiles.length; i++)
		{
			var id=perfiles[i].id_perfil;
			var tipo=perfiles[i].tipo;
			$("#perfil-"+idrol).append("<option value='"+id+"'>"+tipo+"</option>");
		}
		vincularEvento();
	}
	else
	{
		$("#errorproyecto").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>No se puede añadir más proyectos.</p></div>");
	}
}

function vincularEvento()
{
	var botones = $(".botoneliminar");
	botones.click(eliminar);
}

function eliminar()
{
	var ideliminar = $(this).attr("id").split("-")[1];
	$("#proyecto-"+ideliminar).remove();
	$("#fila-"+ideliminar).remove();
}

function comprobarselects()
{
	$("#errorproyecto").html("");
	var numproyectosadd = $("#projects select").length;	
	if(numproyectosadd > 0)
	{
		var projectsfinales = $("#projects select");
		var resultado1= projectsfinales[0].value;
		var resultados= [resultado1];
		for (var i = 1; i< numproyectosadd; i++)
		{
			var resultadoslong = resultados.length;
			for (var j = 0; j < resultadoslong; j++)
			{
				if(projectsfinales[i].value == resultados[j])
				{
					$("#errorproyecto").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>No se puede repetir proyectos.</p></div>");
					return false;
				}
				else
				{
					resultados[resultados.length] = projectsfinales[i].value;
				}
			}
		}
		var numproyectos = $("#projects select").length;
		var numrevisados = resultados.length;
		if(numproyectos == numrevisados)
		{
			$("#insertarfunctiones").submit();
		}
	}
	else
	{
		$("#errorproyecto").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca algún proyecto</p></div>");
		return false;
	}
	
}

function editarprofesional()
{
	var name = $("#name1").val();
	var phone = $("#phone1").val();
    var emails = $("#email1").val();
	var users = $("#user1").val();
	var passwd = $("#password1").val();
	var olduser = sessionStorage.getItem('user');
	var oldemail = sessionStorage.getItem('email');
	if(name == "")
	{
		$("#errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un nombre</p></div>");
	}
	else if(!/^([a-zA-ZáéíóúÁÉÍÓÚ\s])*$/.test(name))
	{
		$("#errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>No puedes introducir números en el nombre</p></div>");
	}
	else if(phone == "")
	{
		$("#errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un teléfono</p></div>");
	}
	else if(phone.length > 15)
	{
		$("#errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Solo se pueden insertar 15 digitos</p></div>");
	}
	else if(!/^([0-9])*$/.test(phone))
	{
		$("#errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca solo números en el teléfono</p></div>");
	}
	else if(emails == "")
	{
		$("#errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un email</p></div>");
	}
	else if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(emails))
	{
		$("#errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un email correcto</p></div>");
	}
	else if(users == "")
	{
		$("#errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>Introduzca un usuario</p></div>");
	}
	else if(/\s/.test(users))
	{
		$("#errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>No se permite espacios en el usuario</p></div>");
	}
	else if(/\s/.test(passwd))
	{
		$("#errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>No se permite espacios en la contraseña</p></div>");
	}
	else if(oldemail != emails)
	{
		var parametros = {
		valor : "OK",
        email: emails
		};
		var urls = "../controllers/professional.php";
		$.ajax({async:true,
				type:"POST",
				url:urls,
				data:parametros,
				success:devuelveDatos1});
	}
	else if(olduser != users)
	{
		var parametros = {
		valor : "OK",
        user: users
		};
		var urls = "../controllers/professional.php";
		$.ajax({async:true,
				type:"POST",
				url:urls,
				data:parametros,
				success:devuelveDatos1});
	}
	else if(oldemail != emails && olduser != users)
	{
		var parametros = {
		valor : "OK",
        email: emails,
        user: users
		};
		var urls = "../controllers/professional.php";
		$.ajax({async:true,
				type:"POST",
				url:urls,
				data:parametros,
				success:devuelveDatos1});
	}
	else
	{
		$("#editarprofesionales").submit();
	}
    return false;
}

function devuelveDatos1(data)
{
	$("#errors").html("");
	if(data != false)
	{
		$("#errors").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>El "+data+" ya existe</p></div>");
	}
	else
	{
		$("#editarprofesionales").submit();
	}
}
