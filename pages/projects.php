<?php
require_once("../includes/initializer.php");
require_once(CLASS_DIR."access.php");
require_once(CLASS_DIR."projects.php");
$access->checkSessions();
$projects=$projects->getAllProjects();
$page="projects";
require_once(LIB_DIR."header.php");
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gestión de Proyectos
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#insertarproyecto">
            <i class="fa fa-folder-o" aria-hidden="true"></i> Añadir Proyecto
        </button>
      </h1>
      
      <ol class="breadcrumb">
        <li><a href="<?php echo MAIN_LINK; ?>index.php">Inicio</a></li>
        <li class="active">Gestión de Proyectos</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de Proyectos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="proyectos" class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($projects as $project)
                    {                        
                ?>
                <tr>
                  <td><?php echo $project["nombre"]; ?></td>
                  <td>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editarproyecto" data-whatever="<?php echo $project["id_proyecto"]."/".$project["nombre"]; ?>">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </button>
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarproyecto" data-whatever="<?php echo $project["id_proyecto"]."/".$project["nombre"]; ?>">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                  </button>
                  </td>
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
        <form role="form" action="<?php echo MAIN_LINK; ?>controllers/addProject.php" method="post" id="registroproyecto">
        <div class="modal fade" id="insertarproyecto">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Añadir Proyecto</h4>
              </div>        
              <div class="modal-body">
              <div id="error">
              </div>                
                  <div class="box-body">
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" id="name" name="name" pattern="[A-Za-z0-9 ]+" required="required" />
                    </div>
                  </div>            
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <input type="submit" class="btn btn-success" id="registrarproyecto" value="Añadir" />
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
        <form role="form" action="<?php echo MAIN_LINK; ?>controllers/editProject.php" method="post" id="editarproyectos">
        <div class="modal fade" id="editarproyecto">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Proyecto</h4>
              </div>        
              <div class="modal-body">
              <div id="errors">
              </div>                
                  <div class="box-body">
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" id="name1" name="name" pattern="[A-Za-z0-9 ]+" title="No se admiten números" required="required"  />
                    </div>
                  </div>            
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <input type="hidden" name="idproyecto" />
                <input type="submit" class="btn btn-success" id="editarprojects" value="Editar" />
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
        <form role="form" action="<?php echo MAIN_LINK; ?>controllers/deleteProject.php" method="post" id="eliminarproyectos">
        <div class="modal fade" id="eliminarproyecto">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar Proyecto</h4>
              </div>        
              <div class="modal-body">               
                  <div class="box-body">
                    <label id="pregunta"></label>
                  </div>            
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <input type="hidden" name="idproyecto" />
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
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
<?php
require_once(LIB_DIR."footer.php");
?>
<script src="<?php echo MAIN_LINK; ?>dist/js/projects.js"></script>
<script>
 $(function () {
    $('#proyectos').DataTable({
        responsive: true,
        "columnDefs": [ {
        "targets": [1],
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
                    columns: [ 0 ]
                }
                
            },
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',                
                exportOptions: {
                    columns: [ 0 ]
                }
                
            }, 
            {
                extend: 'print',
                text: '<i class="fa fa-print" aria-hidden="true"></i>',
                exportOptions: {
                    columns: [ 0 ]
                }
                
            } 
        ]
    });    
});
$('#editarproyecto').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
         var recipient = button.data('whatever'); // Extract info from data-* attributes
          var update = recipient.split("/");
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var modal = $(this);
          modal.find('input[name="idproyecto"]').val(update[0]);
          modal.find('input[name="name"]').val(update[1]);
          sessionStorage.setItem('name', update[1]);         
  });
$('#eliminarproyecto').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
         var recipient = button.data('whatever'); // Extract info from data-* attributes
          var update = recipient.split("/");
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var modal = $(this);
          modal.find('input[name="idproyecto"]').val(update[0]);  
          modal.find('label[id="pregunta"]').text("¿Deseas eliminar el proyecto "+update[1]+" definitivamente?");     
  });
</script>