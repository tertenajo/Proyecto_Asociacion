<?php
require_once("../includes/initializer.php");
require_once(CLASS_DIR."access.php");
require_once(CLASS_DIR."users.php");
//$access->checkSessions();
$listUsers=$users->getAllUsers();
$page="users";
require_once(LIB_DIR."header.php");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Gestión de Usuarios
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-adduser">
                <i class="fa fa-user-plus" aria-hidden="true"></i> Añadir Usuario
            </button>
        </h1>

        <ol class="breadcrumb">
            <li><a href="<?php echo MAIN_LINK; ?>index.php">Inicio</a></li>
            <li class="active">Gestión de Usuarios</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listado de Usuarios</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="usuarios" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Codigo usuario</th>
                            <th>estado</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>DNI</th>
                            <th>Sexo</th>
                            <th>Fecha nacimiento</th>
                            <th>Dirección</th>
                            <th>Codigo postal</th>
                            <th>tlf movil</th>
                            <th>tlf fijo</th>
                            <th>Email</th>
                            <th>Pais</th>
                            <th>Estado civil</th>
                            <th>Nivel formativo</th>
                            <th>Profesión</th>
                            <th>Situacion laboral</th>
                            <th>grado discapacidad</th>
                            <th>prestacion discapacidad</th>
                            <th>valor dependencia</th>
                            <th>invalidez</th>
                            <th>otras</th>
                            <th>observaciones</th>
                            <th>adjuntos</th>
                            <th>beneficio social</th>
                            <th>acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($listUsers as $id=>$user)
                        {                        
                        ?>
                        <tr>
                            <td><?php echo $user["cod_usuario"]; ?></td>
                            <td><?php echo $user["estado"]; ?></td>
                            <td><?php echo $user["nombre"]; ?></td>
                            <td><?php echo $user["apellidos"]; ?></td>
                            <td><?php echo $user["dni"]; ?></td>
                            <td><?php echo $user["sexo"]; ?></td>
                            <td><?php echo $user["fecha_nac"]; ?></td>
                            <td><?php echo $user["direccion"]; ?></td>
                            <td><?php echo $user["codigo_postal"]; ?></td>
                            <td><?php echo $user["tfno_movil"]; ?></td>
                            <td><?php echo $user["tfno_fijo"]; ?></td>
                            <td><?php echo $user["email"]; ?></td>
                            <td><?php echo $user["pais"]; ?></td>
                            <td><?php echo $user["estado_civil"]; ?></td>
                            <td><?php echo $user["n_formativo"]; ?></td>
                            <td><?php echo $user["profesion"]; ?></td>
                            <td><?php echo $user["n_laboral"]; ?></td>
                            <td><?php echo $user["grado_discapacidad"]; ?></td>
                            <td><?php echo $user["prestacion_discapacidad"]; ?></td>
                            <td><?php echo $user["valor_dependencia"]; ?></td>
                            <td><?php echo $user["invalidez"]; ?></td>
                            <td><?php echo $user["otras"]; ?></td>
                            <td><?php echo $user["observaciones"]; ?></td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default2">
                                    <i class="fa fa-file" aria-hidden="true"></i>
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-socialbenefits">
                                    <i class="fa fa-money" aria-hidden="true"></i>
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-edituser" data-whatever="<?php echo $user["id_usuario"] ."/". $user["cod_usuario"] ."/". $user["estado"] ."/". $user["dni"] ."/". $user["nombre"] ."/". $user["apellidos"] ."/". $user["sexo"] ."/". $user["fecha_nac"] ."/". $user["direccion"] ."/". $user["codigo_postal"] ."/". $user["pais"] ."/". $user["tfno_movil"] ."/". $user["tfno_fijo"] ."/". $user["email"] ."/". $user["estado_civil"] ."/". $user["nivel_formativo"] ."/". $user["profesion"] ."/". $user["situacion_laboral"] ."/". $user["grado_discapacidad"] ."/". $user["prestacion_discapacidad"] ."/". $user["valor_dependencia"] ."/". $user["invalidez"] ."/". $user["otras"] ."/". $user["observaciones"]; ?>">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-deleteuser" data-whatever="<?php echo $user["id_usuario"]."/".$user["cod_usuario"]; ?>">
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
        <form role="form" action="<?php echo MAIN_LINK; ?>controllers/addUser.php" method="post" id="registroUsuario">
            <div class="modal fade" id="modal-adduser">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Añadir Usuario</h4>
                        </div>        
                        <div class="modal-body">

                            <div class="box-body">
                                <div class="form-group col-sm-6">
                                    <label for="addCodUser">Código Usuario</label>
                                    <input type="text" class="form-control" id="addCodUser" name="codUser" pattern="[A-Za-z0-9 ]+" title="El codigo debe ser alfanumerico" required="required" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="addDni">DNI</label>
                                    <input type="text" pattern="[A-Za-z]*[0-9]*[A-Za-z]*" class="form-control" id="addDni" name="dni" required="required" maxlength="15" title="Por favor introduzca un dni correcto" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="addName">Nombre</label>
                                    <input type="text" class="form-control" id="addName" name="name" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="No se admiten números" required="required" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="addSubname">Apellidos</label>
                                    <input type="text" class="form-control" id="addSubname" name="subname" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="No se admiten números" required="required" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="addSex">Sexo</label>
                                    <select type="text" class="form-control" id="addSex" name="sex"  required="required">
                                        <option value="Mujer">Mujer</option>
                                        <option value="Hombre">Hombre</option>
                                        <option value="Otros">Otros</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="addBirthdate">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" id="addBirthdate" name="birthdate" required="required" title="Por favor introduzca solo números" />
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="addAdress">Dirección</label>
                                    <textarea class="form-control" id="addAdress" name="adress" required="required" title="Por favor introduzca solo caracteres alfanumericos" ></textarea>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="addCp">Código postal</label>
                                    <input type="text" pattern="[0-9]*" class="form-control" id="addCp" name="cp" required="required" title="Por favor introduzca solo numeros" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="addCountry">Pais</label>
                                    <input type="text" class="form-control" id="addCountry" name="country" pattern="[\w\sÁÉÍÓÚáéíóúÑñ]+" title="Por favor introduzca solo caracteres alfanumericos" required="required" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="addMobilephone">Teléfono movil</label>
                                    <input type="text" pattern="\d*" class="form-control" id="addMobilephone" name="mobilephone" title="Por favor introduzca solo números" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="addTelephone">Teléfono fijo</label>
                                    <input type="text" pattern="\d*" class="form-control" id="addTelephone" name="telephone" title="Por favor introduzca solo números" />
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="addEmail">E-mail</label>
                                    <input type="email" class="form-control" id="addEmail" name="email" pattern="[^' ']+" title="No se admiten espacios en blanco" required="required" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="civilState">Estado civil</label>
                                    <input type="text" class="form-control" id="addCivilState" name="civilState" pattern="[\d\w\sÁÉÍÓÚáéíóúÑñ]+" title="Por favor introduzca solo caracteres alfanumericos" required="required" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <?PHP 
                                    $formaLevels=$users->getFormaLevels();
                                    ?>
                                    <label for="addFormaLevel">Nivel formativo</label>
                                    <select type="text" class="form-control" id="addFormaLevel" name="formaLevel"  required="required">
                                        <?PHP
                                        foreach($formaLevels as $formaLevel){
                                        ?>
                                        <option value="<?PHP echo $formaLevel["id_formativo"] ?>"><?PHP echo $formaLevel["nombre"] ?></option>
                                        <?PHP
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="addProfession">Profesión</label>
                                    <input type="text" class="form-control" id="addProfession" name="profession" pattern="[\d\w\sÁÉÍÓÚáéíóúÑñ]+" title="Por favor introduzca solo caracteres alfanumericos" required="required" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <?PHP 
                                    $workSituations=$users->getWorkSituations();
                                    ?>
                                    <label for="addWorkSituation">Situación laboral</label>
                                    <select type="text" class="form-control" id="addWorkSituation" name="workSituation"  required="required">
                                        <?PHP
                                        foreach($workSituations as $workSituation){
                                        ?>
                                        <option value="<?PHP echo $workSituation["id_laboral"] ?>"><?PHP echo $workSituation["nombre"] ?></option>
                                        <?PHP
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="addImpairmentDegree">Grado de discapacidad</label>
                                    <input type="number" class="form-control" id="addImpairmentDegree" name="impairmentDegree" min="0" max="100" title="No se admiten menores de 0 y mayores de 100" required="required" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="addImpairmentBenefit">prestacion por discapacidad</label>
                                    <input type="number" class="form-control" id="addImpairmentBenefit" name="impairmentBenefit" title="Introduzca una prestacion por discapaidad" required="required" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="addDependencyValue">valor de dependencia</label>
                                    <input type="number" class="form-control" id="addDependencyValue" name="dependencyValue" min="0" max="100" title="No se admiten menores de 0 y mayores de 100" required="required" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="addDisability">Invalidez</label>
                                    <select type="text" class="form-control" id="addDisability" name="disability"  required="required">
                                        <option value="No">No</option>
                                        <option value="Si">Si</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="addOthers">Otros</label>
                                    <textarea class="form-control" id="addOthers" name="others" title="Por favor introduzca solo caracteres alfanumericos" ></textarea>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="addObservations">Observaciones</label>
                                    <textarea class="form-control" id="addObservations" name="observations" title="Por favor introduzca solo caracteres alfanumericos" ></textarea>
                                </div>
                            </div>  
                            <div id="addErrors">
                            </div>            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-success" id="btnRegistroUsuario" value="Añadir" />
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
        <form role="form" action="<?php echo MAIN_LINK; ?>controllers/editUser.php" method="post" id="editarUsuarios">
            <div class="modal fade" id="modal-edituser">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Editar Profesional</h4>
                        </div>        
                        <div class="modal-body">
                            <div class="box-body">
                                <div class="form-group col-sm-6">
                                    <label for="editCodUser">Código Usuario</label>
                                    <input type="text" class="form-control" id="editCodUser" name="codUser" pattern="[A-Za-z0-9 ]+" title="El codigo debe ser alfanumerico" required="required" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="editEstado">Estado</label>
                                    <select type="text" class="form-control" id="editEstado" name="estado"  required="required">
                                        <option value="Alta">Alta</option>
                                        <option value="Baja">Baja</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="editDni">DNI</label>
                                    <input type="text" pattern="[A-Za-z]*[0-9]*[A-Za-z]*" class="form-control" id="editDni" name="dni" required="required" maxlength="15" title="Por favor introduzca un dni correcto" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="editName">Nombre</label>
                                    <input type="text" class="form-control" id="editName" name="name" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="No se admiten números" required="required" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="editSubname">Apellidos</label>
                                    <input type="text" class="form-control" id="editSubname" name="subname" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="No se admiten números" required="required" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="editSex">Sexo</label>
                                    <select type="text" class="form-control" id="editSex" name="sex"  required="required">
                                        <option value="Mujer">Mujer</option>
                                        <option value="Hombre">Hombre</option>
                                        <option value="Otros">Otros</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="editBirthdate">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" id="editBirthdate" name="birthdate" required="required" title="Por favor introduzca solo números" />
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="editAdress">Dirección</label>
                                    <textarea class="form-control" id="editAdress" name="adress" required="required" title="Por favor introduzca solo caracteres alfanumericos" ></textarea>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="editCp">Código postal</label>
                                    <input type="text" pattern="[0-9]*" class="form-control" id="editCp" name="cp" required="required" title="Por favor introduzca solo numeros" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="editCountry">Pais</label>
                                    <input type="text" class="form-control" id="editCountry" name="country" pattern="[\w\sÁÉÍÓÚáéíóúÑñ]+" title="Por favor introduzca solo caracteres alfanumericos" required="required" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="editMobilephone">Teléfono movil</label>
                                    <input type="text" pattern="\d*" class="form-control" id="editMobilephone" name="mobilephone" title="Por favor introduzca solo números" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="editTelephone">Teléfono fijo</label>
                                    <input type="text" pattern="\d*" class="form-control" id="editTelephone" name="telephone" title="Por favor introduzca solo números" />
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="editEmail">E-mail</label>
                                    <input type="email" class="form-control" id="editEmail" name="email" pattern="[^' ']+" title="No se admiten espacios en blanco" required="required" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="civilState">Estado civil</label>
                                    <input type="text" class="form-control" id="editCivilState" name="civilState" pattern="[\d\w\sÁÉÍÓÚáéíóúÑñ]+" title="Por favor introduzca solo caracteres alfanumericos" required="required" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <?PHP 
                                    $formaLevels=$users->getFormaLevels();
                                    ?>
                                    <label for="editFormaLevel">Nivel formativo</label>
                                    <select type="text" class="form-control" id="editFormaLevel" name="formaLevel"  required="required">
                                        <?PHP
                                        foreach($formaLevels as $formaLevel){
                                        ?>
                                        <option value="<?PHP echo $formaLevel["id_formativo"] ?>"><?PHP echo $formaLevel["nombre"] ?></option>
                                        <?PHP
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="editProfession">Profesión</label>
                                    <input type="text" class="form-control" id="editProfession" name="profession" pattern="[\d\w\sÁÉÍÓÚáéíóúÑñ]+" title="Por favor introduzca solo caracteres alfanumericos" required="required" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <?PHP 
                                    $workSituations=$users->getWorkSituations();
                                    ?>
                                    <label for="editWorkSituation">Situación laboral</label>
                                    <select type="text" class="form-control" id="editWorkSituation" name="workSituation"  required="required">
                                        <?PHP
                                        foreach($workSituations as $workSituation){
                                        ?>
                                        <option value="<?PHP echo $workSituation["id_laboral"] ?>"><?PHP echo $workSituation["nombre"] ?></option>
                                        <?PHP
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="editImpairmentDegree">Grado de discapacidad</label>
                                    <input type="number" class="form-control" id="editImpairmentDegree" name="impairmentDegree" min="0" max="100" title="No se admiten menores de 0 y mayores de 100" required="required" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="editImpairmentBenefit">prestacion por discapacidad</label>
                                    <input type="number" class="form-control" id="editImpairmentBenefit" name="impairmentBenefit" title="Introduzca una prestacion por discapaidad" required="required" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="editDependencyValue">valor de dependencia</label>
                                    <input type="number" class="form-control" id="editDependencyValue" name="dependencyValue" min="0" max="100" title="No se admiten menores de 0 y mayores de 100" required="required" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="editDisability">Invalidez</label>
                                    <select type="text" class="form-control" id="editDisability" name="disability"  required="required">
                                        <option value="No">No</option>
                                        <option value="Si">Si</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="editOthers">Otros</label>
                                    <textarea class="form-control" id="editOthers" name="others" title="Por favor introduzca solo caracteres alfanumericos" ></textarea>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="editObservations">Observaciones</label>
                                    <textarea class="form-control" id="editObservations" name="observations" title="Por favor introduzca solo caracteres alfanumericos" ></textarea>
                                </div>
                            </div>  
                            <div id="editErrors">
                            </div>    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <input type="hidden" name="userId" id="userId" />
                            <input type="submit" class="btn btn-success" id="btnEditarUsuario" value="Editar" />
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
        <form role="form" action="<?php echo MAIN_LINK; ?>controllers/deleteUser.php" method="post" id="eliminaUsuarios">
            <div class="modal fade" id="modal-deleteuser">
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
                            <input type="hidden" name="userId" />
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
        <form role="form" action="<?php echo MAIN_LINK; ?>controllers/insertSocialBenefits.php" method="post" id="beneficiosocial">
        <div class="modal fade" id="modal-socialbenefits">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Beneficio social</h4>
              </div>
              <div class="modal-body">
              <button type="button" class="btn btn-success" id="insertarmas"><i class="fa fa-plus" aria-hidden="true"></i></button>               
                  <div class="box-body">                  
                    <div class="row">
                        <div class="col-md-4">
                            <label>Beneficio social</label>
                              <div class="form-group" id="beneficiossociales">                            
                              </div>
                        </div>
                        <div class="col-md-4">
                        <label>Importe</label>
                            <div class="form-group" id="importes">                                
                            </div>
                        </div> 
                        <div class="col-md-6">
                        <label>Descripción</label>
                            <div class="form-group" id="descripciones">                                
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
        $('#usuarios').DataTable({
            dom: 'Bfrtip',
            buttons: [

                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22]
                    }

                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22]
                    }

                }, 
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22]
                    }
                } 
            ],
            responsive: true,
            stateSave: false,
            "columnDefs": [
                {
                    "targets": [23,24,25],
                    "orderable": false        
                }
            ],
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
                },
                buttons: {
                    pdf: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i>',
                    excel: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
                    print: '<i class="fa fa-print" aria-hidden="true"></i>',
                }
            }
        });

    });
    $('#modal-edituser').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var recipient = button.data('whatever'); // Extract info from data-* attributes
        var update = recipient.split("/");
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('input[name="userId"]').val(update[0]);
        modal.find('input[name="codUser"]').val(update[1]);
        modal.find('input[name="estado"]').val(update[2]);
        modal.find('input[name="dni"]').val(update[3]);
        modal.find('input[name="name"]').val(update[4]);
        modal.find('input[name="subname"]').val(update[5]);
        modal.find('select[name="sex"]').val(update[6]);
        modal.find('input[name="birthdate"]').val(update[7]);
        modal.find('textarea[name="adress"]').html(update[8]);
        modal.find('input[name="cp"]').val(update[9]);
        modal.find('input[name="country"]').val(update[10]);
        modal.find('input[name="mobilephone"]').val(update[11]);
        modal.find('input[name="telephone"]').val(update[12]);
        modal.find('input[name="email"]').val(update[13]);
        modal.find('input[name="civilState"]').val(update[14]);
        modal.find('select[name="formaLevel"]').val(update[15]);
        modal.find('input[name="profession"]').val(update[16]);
        modal.find('select[name="workSituation"]').val(update[17]);
        modal.find('input[name="impairmentDegree"]').val(update[18]);
        modal.find('input[name="impairmentBenefit"]').val(update[19]);
        modal.find('input[name="dependencyValue"]').val(update[20]);
        modal.find('select[name="disability"]').val(update[21]);
        modal.find('textarea[name="others"]').html(update[22]);
        modal.find('textarea[name="observations"]').html(update[23]);

    });
    $('#modal-deleteuser').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var recipient = button.data('whatever'); // Extract info from data-* attributes
        var update = recipient.split("/");
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('input[name="userId"]').val(update[0]);  
        modal.find('label[id="pregunta"]').text("¿Deseas eliminar al usuario "+update[1]+" definitivamente?");     
    });
</script>