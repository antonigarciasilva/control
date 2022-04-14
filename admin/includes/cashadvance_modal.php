<!-- Add -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Agregar Adelanto de Efectivo</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="cashadvance_add.php">
          		  <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">DNI Empleado</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" autocomplete="off" maxlength="8"  onKeypress="ValidarNumeros()" id="employee" name="employee" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="amount" class="col-sm-3 control-label">Monto</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" autocomplete="off"  onKeypress="ValidarNumeros()" id="amount" name="amount" required>
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
            	<h4 class="modal-title"><b><span class="date"></span> - <span class="employee_name"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="cashadvance_edit.php">
            		<input type="hidden" class="caid" name="id">
                <div class="form-group">
                    <label for="edit_amount" class="col-sm-3 control-label">Monto</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" autocomplete="off" onKeypress="ValidarNumeros()" id="edit_amount" name="amount" required>
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
            	<h4 class="modal-title"><b><span class="date"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="cashadvance_delete.php">
            		<input type="hidden" class="caid" name="id">
            		<div class="text-center">
	                	<p>Eliminar Adelanto de Efectivo</p>
	                	<h2 class="employee_name bold"></h2>
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

</script>