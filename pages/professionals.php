<?php
require_once("../includes/initializer.php");
require_once(CLASS_DIR."access.php");
require_once(CLASS_DIR."professionals.php");
$access->checkSessions();
$professional=$professional->getAllProfessionals();
$page="professionals";
require_once(LIB_DIR."header.php");
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gestión de Profesionales
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#insertarprofesional">
            <i class="fa fa-user-plus" aria-hidden="true"></i> Añadir Profesional
        </button>
      </h1>
      
      <ol class="breadcrumb">
        <li><a href="<?php echo MAIN_LINK; ?>index.php">Inicio</a></li>
        <li class="active">Gestión de Profesionales</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de Profesionales</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="profesionales" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Teléfono</th>
                      <th>Email</th>
                      <th>Proyectos/Roles</th>
                    <?php
                        if($_SESSION["permission"] == "admin")
                        {
                    ?>
                      <th>Acciones</th>
                    <?php
                        }
                    ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($professional as $profesional)
                    {                        
                ?>
                <tr>
                  <td><?php echo $profesional["nombre"]; ?></td>
                  <td><?php echo $profesional["telefono"]; ?></td>
                  <td><?php echo $profesional["email"]; ?></td>
                  <td>
                  <button type="button" class="btn btn-success projects" data-toggle="modal" data-target="#proyectosroles" id="<?php echo $profesional["id_profesional"]; ?>">
                    <i class="fa fa-users" aria-hidden="true"></i>
                  </button>
                  </td>
                  <?php
                    if($_SESSION["permission"] == "admin")
                    {
                  ?>
                  <td>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editarprofessional" data-whatever="<?php echo $profesional["id_profesional"]."/".$profesional["nombre"]."/".$profesional["telefono"]."/".$profesional["email"]."/".$profesional["admin"]."/".$profesional["usuario"]; ?>">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </button>
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarprofessional" data-whatever="<?php echo $profesional["id_profesional"]."/".$profesional["nombre"]; ?>">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                  </button>
                  </td>
                  <?php
                    }
                  ?>
                </tr>
              <?php
                    }
              ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        <!-- /.modal -->
        <form role="form" action="<?php echo MAIN_LINK; ?>controllers/addProfessional.php" method="post" id="registroprofesional">
        <div class="modal fade" id="insertarprofesional">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Añadir Profesional</h4>
              </div>        
              <div class="modal-body">              
                  <div class="box-body">
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" id="name" name="name" pattern="[A-Za-z ]+" title="No se admiten números" required="required" />
                    </div>
                    <div class="form-group">
                      <label for="phone">Teléfono</label>
                      <input type="text" pattern="\d+" class="form-control" id="phone" name="phone" required="required" title="Por favor introduzca solo números" />
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email" pattern="[^' ']+" title="No se admiten espacios en blanco" required="required" />
                    </div>
                    <div class="form-group">
                      <label for="user">Usuario</label>
                      <input type="text" class="form-control" id="user" name="user" pattern="[^' ']+" title="No se admiten espacios en blanco" required="required" />
                    </div>
                    <div class="form-group">
                      <label for="password">Contraseña</label>
                      <input type="password" class="form-control" id="password" name="password" pattern="[^' ']+" title="No se admiten espacios en blanco" required="required" />
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="administrador" value="si" /> Administrador
                      </label>
                    </div>
                  </div>
              <div id="error">
              </div>              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <input type="submit" class="btn btn-success" id="registrarprofesionales" value="Añadir" />
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        </form>
        <!-- /.modal -->
        
        <!-- /.modal -->
        <form role="form" action="<?php echo MAIN_LINK; ?>controllers/editProfessional.php" method="post" id="editarprofesionales">
        <div class="modal fade" id="editarprofessional">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Profesional</h4>
              </div>        
              <div class="modal-body">             
                  <div class="box-body">
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" id="name1" name="name" pattern="[A-Za-z ]+" title="No se admiten números" required="required"  />
                    </div>
                    <div class="form-group">
                      <label for="phone">Teléfono</label>
                      <input type="text" pattern="\d+" class="form-control" id="phone1" name="phone" required="required" title="Por favor introduzca solo números" />
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email1" name="email" pattern="[^' ']+" title="No se admiten espacios en blanco" required="required" />
                    </div>
                    <div class="form-group">
                      <label for="user">Usuario</label>
                      <input type="text" class="form-control" id="user1" name="user" pattern="[^' ']+" title="No se admiten espacios en blanco" required="required" />
                    </div>
                    <div class="form-group">
                      <label for="password">Modificar Contraseña</label>
                      <input type="password" class="form-control" id="password1" name="password" pattern="[^' ']+" title="No se admiten espacios en blanco" required="required" />
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" id="admin1" name="administrador" value="si" /> Administrador
                      </label>
                    </div>
                  </div>
              <div id="errors">
              </div>               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <input type="hidden" name="idprofesional" />
                <input type="hidden" name="oldemail" id="oldemail" />
                <input type="hidden" name="olduser" id="olduser" />
                <input type="submit" class="btn btn-success" id="editarprofesional" value="Editar" />
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        </form>
        <!-- /.modal -->
        
        <!-- /.modal -->
        <form role="form" action="<?php echo MAIN_LINK; ?>controllers/deleteProfessional.php" method="post" id="eliminarprofesionales">
        <div class="modal fade" id="eliminarprofessional">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar Profesional</h4>
              </div>        
              <div class="modal-body">               
                  <div class="box-body">
                    <label id="pregunta"></label>
                  </div>            
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <input type="hidden" name="idprofesional" />
                <input type="submit" class="btn btn-danger" value="Eliminar" />
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        </form>
        <!-- /.modal -->
        
        <!-- /.modal -->
        <form role="form" action="<?php echo MAIN_LINK; ?>controllers/insertFunctions.php" method="post" id="insertarfunciones">
        <div class="modal fade" id="proyectosroles">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Proyectos y Roles</h4>
              </div>
              <div class="modal-body">
              <button type="button" class="btn btn-success" id="insertarmas"><i class="fa fa-plus" aria-hidden="true"></i></button>               
                  <div class="box-body">                  
                    <div class="row">
                        <div class="col-md-6">
                            <label>Proyecto</label>
                              <div class="form-group" id="projects">                            
                              </div>
                        </div>
                        <div class="col-md-6">
                        <label>Rol</label>
                            <div class="form-group" id="roles">                                
                            </div>
                        </div>                       
                  </div>
                  <div id="errorproyecto">
                  </div>             
                </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
              <input type="hidden" name="idprofesional" id="idprofesional"/>
                <button type="button" class="btn btn-success" data-dismiss="modal" id="guardar">Guardar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
            </div>
        </div>
        </form>
        <!-- /.modal -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
<?php
require_once(LIB_DIR."footer.php");
?>
<script>
 $(function () {
    $('#profesionales').DataTable({
        responsive: true,
        "columnDefs": [ {
        "targets": [3,4],
        "orderable": false        
        }],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdf',
                text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i>',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
                
            },
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',                
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
                
            }, 
            {
                extend: 'print',
                text: '<i class="fa fa-print" aria-hidden="true"></i>',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
                
            } 
        ]
    });
    
  });
$('#editarprofessional').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
         var recipient = button.data('whatever'); // Extract info from data-* attributes
          var update = recipient.split("/");
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var modal = $(this);
          modal.find('input[name="idprofesional"]').val(update[0]);
          modal.find('input[name="name"]').val(update[1]);
          modal.find('input[name="phone"]').val(update[2]);
          modal.find('input[name="email"]').val(update[3]);
          modal.find('input[name="user"]').val(update[5]);
          if(update[4] == update[0])
          {
            modal.find('input[name="administrador"]').prop('checked',true); 
          }
          modal.find('input[name="oldemail"]').val(update[3]);
          modal.find('input[name="olduser"]').val(update[5]);          
  });
$('#eliminarprofessional').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
         var recipient = button.data('whatever'); // Extract info from data-* attributes
          var update = recipient.split("/");
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var modal = $(this);
          modal.find('input[name="idprofesional"]').val(update[0]);  
          modal.find('label[id="pregunta"]').text("¿Deseas eliminar al profesional "+update[1]+" definitivamente?");     
  });
</script>