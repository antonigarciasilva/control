<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM attendance WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Asistencia eleminada satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Para eliminar primero seleccione un elemento';
	}

	header('location: attendance.php');
	
?>