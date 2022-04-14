<!-- Add -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Agregar Asistencia</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="attendance_add.php">
          		  <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">DNI Empleado</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" autocomplete="off" maxlength="8" onKeypress="ValidarNumeros()" id="employee" name="employee" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="datepicker_add" class="col-sm-3 control-label">Fecha</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" autocomplete="off" onKeypress="ValidarNumeros()" id="datepicker_add" name="date" required>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="time_in" class="col-sm-3 control-label">Hora de Entrada</label>

                  	<div class="col-sm-9">
                  		<div class="bootstrap-timepicker">
                    		<input type="text" class="form-control timepicker" autocomplete="off" onKeypress="ValidarNumeros()" id="time_in" name="time_in">
                    	</div>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="time_out" class="col-sm-3 control-label">Hora de Salida</label>

                  	<div class="col-sm-9">
                  		<div class="bootstrap-timepicker">
                    		<input type="text" class="form-control timepicker" autocomplete="off" onKeypress="ValidarNumeros()" id="time_out" name="time_out">
                    	</div>
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
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span id="employee_name"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="attendance_edit.php">
            		<input type="hidden" id="attid" name="id">
                <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Fecha</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" autocomplete="off" onKeypress="ValidarNumeros()"  id="datepicker_edit" name="edit_date">
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="edit_time_in" class="col-sm-3 control-label">Hora Entrada</label>

                  	<div class="col-sm-9">
                  		<div class="bootstrap-timepicker">
                    		<input type="text" class="form-control timepicker" autocomplete="off" onKeypress="ValidarNumeros()"  id="edit_time_in" name="edit_time_in">
                    	</div>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="edit_time_out" class="col-sm-3 control-label">Hora Salida</label>

                  	<div class="col-sm-9">
                  		<div class="bootstrap-timepicker">
                    		<input type="text" class="form-control timepicker" autocomplete="off" onKeypress="ValidarNumeros()"  id="edit_time_out" name="edit_time_out">
                    	</div>
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
            	<h4 class="modal-title"><b><span id="attendance_date"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="attendance_delete.php">
            		<input type="hidden" id="del_attid" name="id">
            		<div class="text-center">
	                	<p>ELIMINAR EMPLEADO</p>
	                	<h2 id="del_employee_name" class="bold"></h2>
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