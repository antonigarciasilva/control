<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$description = $_POST['description'];
		$amount = $_POST['amount'];

		$sql = "UPDATE deductions SET description = '$description', amount = '$amount' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Descuento realizada satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Para editar primero llene el formulario';
	}

	header('location:deduction.php');

?>