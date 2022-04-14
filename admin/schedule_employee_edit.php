<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$empid = $_POST['id'];
		$sched_id = $_POST['schedule'];
		
		$sql = "UPDATE employees SET schedule_id = '$sched_id' WHERE id = '$empid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Horario Actualizado Satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Para editar primero seleccione un horario';
	}

	header('location: schedule_employee.php');
?>