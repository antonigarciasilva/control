<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Asistencia
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
          <li class="active">Asistencia</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <?php
        if (isset($_SESSION['error'])) {
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
          unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i>¡Proceso Exitoso!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
          unset($_SESSION['success']);
        }
        ?>
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Nuevo</a>
              </div>
              <div class="box-body">
                <table id="asistencia" class="table table-bordered">
                  <thead>
                    <th class="hidden"></th>
                    <th>Fecha</th>
                    <th>DNI Empleado</th>
                    <th>Nombre</th>
                    <th>Hora Entrada</th>
                    <th>Hora Salida</th>
                    <th>Acción</th>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS fdate, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id ORDER BY attendance.date DESC, attendance.time_in DESC";
                    $query = $conn->query($sql);
                    while ($row = $query->fetch_assoc()) {
                      $status = ($row['status']) ? '<span class="label label-warning pull-right">a tiempo</span>' : '<span class="label label-danger pull-right">tarde</span>';
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>" . $row['fdate'] . "</td>
                          <td>" . $row['empid'] . "</td>
                          <td>" . $row['firstname'] . ' ' . $row['lastname'] . "</td>
                          <td>" . date('h:i A', strtotime($row['time_in'])) . $status . "</td>
                          <td>" . date('h:i A', strtotime($row['time_out'])) . "</td>
                          <td>
                            <button class='btn btn-success btn-sm btn-flat edit' data-id='" . $row['attid'] . "'><i class='fa fa-edit'></i> Editar</button>
                            <button class='btn btn-danger btn-sm btn-flat delete' data-id='" . $row['attid'] . "'><i class='fa fa-trash'></i> Eliminar</button>
                          </td>
                        </tr>
                      ";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/attendance_modal.php'; ?>
  </div>
  <?php include 'includes/scripts.php'; ?>
  <script>
    $(function() {
      $('.edit').click(function(e) {
        e.preventDefault();
        $('#edit').modal('show');
        var id = $(this).data('id');
        getRow(id);
      });

      $('.delete').click(function(e) {
        e.preventDefault();
        $('#delete').modal('show');
        var id = $(this).data('id');
        getRow(id);
      });
    });

    function getRow(id) {
      $.ajax({
        type: 'POST',
        url: 'attendance_row.php',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          $('#datepicker_edit').val(response.date);
          $('#attendance_date').html(response.date);
          $('#edit_time_in').val(response.time_in);
          $('#edit_time_out').val(response.time_out);
          $('#attid').val(response.attid);
          $('#employee_name').html(response.firstname + ' ' + response.lastname);
          $('#del_attid').val(response.attid);
          $('#del_employee_name').html(response.firstname + ' ' + response.lastname);
        }
      });
    }

    $(document).ready(function() {
      $('#asistencia').DataTable({
        responsive: true,
        autowidth: false,
        "language": {
          "lengthMenu": "Mostrar" +
            `<select class="custom-select custom-select-sm form-control form-control-sm" >
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
              <option value="100">100</option>
              <option value="-1">Todos</option>
            </select>` +
            " registros por página",
          "zeroRecords": "Nada encontrado - disculpa",
          "info": "Mostrando la página _PAGE_ de _PAGES_",
          "infoEmpty": "No records available",
          "infoFiltered": "(filtrado de _MAX_ registros totales)",
          "search": "Buscar:",
          "paginate": {
            'next' : 'Siguiente',
            'previous': 'Anterior'
          },
        }
      });
    });
  </script>

</body>

</html>