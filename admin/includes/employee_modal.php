<!-- Add -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="addnew">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>Agregar Empleado</b></h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="employee_add.php" enctype="multipart/form-data">

          <div class="row">
            <div class="form-group col-md-6">
              <label for="employee_id">DNI</label>
              <input type="text" class="form-control" autocomplete="off" onKeypress="ValidarNumeros()" maxlength="8" id="employee_id" name="employee_id" required>
            </div>

            <div class="form-group col-md-6">
              <label for="address">Dirección</label>
              <input class="form-control" autocomplete="off" name="address" id="address" required>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-6">
              <label for="firstname">Nombre</label>
              <input type="text" class="form-control" autocomplete="off" onkeypress="return soloLetras(event)" id="firstname" name="firstname" required>
            </div>
            <div class="form-group col-md-6">
              <label for="lastname">Apellidos</label>
              <input type="text" class="form-control" autocomplete="off" onkeypress="return soloLetras(event)" id="lastname" name="lastname" required>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-6">
              <label for="position">Cargo</label>
              <select class="form-control" name="position" id="position" required>
                <option value="" selected>- Seleccionar -</option>
                <?php
                $sql = "SELECT * FROM position";
                $query = $conn->query($sql);
                while ($prow = $query->fetch_assoc()) {
                  echo "
                        <option value='" . $prow['id'] . "'>" . $prow['description'] . "</option>
                      ";
                }
                ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="schedule">Horario</label>
              <select class="form-control" id="schedule" name="schedule" required>
                <option value="" selected>- Seleccionar -</option>
                <?php
                $sql = "SELECT * FROM schedules";
                $query = $conn->query($sql);
                while ($srow = $query->fetch_assoc()) {
                  echo "
                        <option value='" . $srow['id'] . "'>" . $srow['time_in'] . ' - ' . $srow['time_out'] . "</option>
                      ";
                }
                ?>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-6">
              <label for="contact">Teléfono</label>
              <input type="text" class="form-control" autocomplete="off" maxlength="9" onKeypress="ValidarNumeros()" id="contact" name="contact">
            </div>

            <div class="form-group col-md-6">
              <label for="datepicker_add">Fecha de Nacimiento</label>
              <div class="date">
                <input type="text" class="form-control" autocomplete="off" onKeypress="ValidarNumeros()" id="datepicker_add" name="birthdate">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-6">
              <label for="gender">Género</label>
              <select class="form-control" name="gender" id="gender" required>
                <option value="" selected>- Seleccionar -</option>
                <option value="Male">Hombre</option>
                <option value="Female">Mujer</option>
              </select>
            </div>

            <div class="form-group col-md-6">
              <label for="photo">Foto</label>
              <input type="file" name="photo" id="photo">
            </div>
          </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
        <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="edit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><b>Editar empleado</b></h3>
      </div>
      <div class="modal-body">
        <form method="POST" action="employee_edit.php">
          <input type="hidden" class="empid" name="id">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="edit_employee_id">DNI</label>
              <input type="text" class="form-control" autocomplete="off" onKeypress="ValidarNumeros()" maxlength="8" id="edit_employee_id" name="employee_id" required>
            </div>

            <div class="form-group col-md-6">
              <label for="edit_address">Dirección</label>
              <input class="form-control" name="address" autocomplete="off" id="edit_address">
            </div>
          </div>


          <div class="row">
            <div class="form-group col-md-6">
              <label for="edit_firstname">Nombre</label>
              <input type="text" class="form-control col-md-6" autocomplete="off" onkeypress="return soloLetras(event)" id="edit_firstname" name="firstname">
            </div>
            <div class="form-group col-md-6">
              <label for="edit_lastname">Apellidos</label>
              <input type="text" class="form-control col-md-6" autocomplete="off" id="edit_lastname" onkeypress="return soloLetras(event)" name="lastname">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="edit_position">Cargo</label>
              <select class="form-control" name="position" id="edit_position">
                <option selected id="position_val"></option>
                <?php
                $sql = "SELECT * FROM position";
                $query = $conn->query($sql);
                while ($prow = $query->fetch_assoc()) {
                  echo "
                              <option value='" . $prow['id'] . "'>" . $prow['description'] . "</option>
                            ";
                }
                ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="edit_schedule">Horario</label>
              <select class="form-control" id="edit_schedule" name="schedule">
                <option selected id="schedule_val"></option>
                <?php
                $sql = "SELECT * FROM schedules";
                $query = $conn->query($sql);
                while ($srow = $query->fetch_assoc()) {
                  echo "
                              <option value='" . $srow['id'] . "'>" . $srow['time_in'] . ' - ' . $srow['time_out'] . "</option>
                            ";
                }
                ?>
              </select>
            </div>
          </div>


          <div class="row">
            <div class="form-group col-md-6">
              <label for="edit_contact">Teléfono</label>
              <input type="text" class="form-control" autocomplete="off" onKeypress="ValidarNumeros()" maxlength="0" id="edit_contact" name="contact">
            </div>
            <div class="form-group col-md-6">
              <label for="datepicker_edit">Fecha de Nacimiento</label>
              <div class="date">
                <input type="text" class="form-control" autocomplete="off" onKeypress="ValidarNumeros()" id="datepicker_edit" name="birthdate">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-6">
              <label for="edit_gender">Género</label>
              <select class="form-control" name="gender" id="edit_gender">
                <option selected id="gender_val"></option>
                <option value="Male">Hombre</option>
                <option value="Female">Mujer</option>
              </select>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
        <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Actualizar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b><span class="employee_id"></span></b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="employee_delete.php">
          <input type="hidden" class="empid" name="id">
          <div class="text-center">
            <p>ELIMINAR EMPLEADO</p>
            <h2 class="bold del_employee_name"></h2>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
        <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Update Photo -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="edit_photo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b><span class="del_employee_name"></span></b></h4>
      </div>
      <div class="modal-body">
        <form  method="POST" action="employee_edit_photo.php" enctype="multipart/form-data">
          <input type="hidden" class="empid" name="id">
          <div class="row">
            <div class="form-group col-md-10">
              <label for="photo">Foto</label>
              <input type="file" id="photo" name="photo" required>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
        <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Actualizar</button>
        </form>
      </div>
    </div>
  </div>
</div>



<script>
  function ValidarNumeros() {
    if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;
  }


  function soloLetras(e) {
    var key = e.keyCode || e.which,
      tecla = String.fromCharCode(key).toLowerCase(),
      letras = " áéíóúabcdefghijklmnñopqrstuvwxyz",
      especiales = [8, 37, 39, 46],
      tecla_especial = false;

    for (var i in especiales) {
      if (key == especiales[i]) {
        tecla_especial = true;
        break;
      }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
      return false;
    }
  }
</script>