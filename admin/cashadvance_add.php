<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee = $_POST['employee'];
		$amount = $_POST['amount'];
		
		$sql = "SELECT * FROM employees WHERE employee_id = '$employee'";
		$query = $conn->query($sql);
		if($query->num_rows < 1){
			$_SESSION['error'] = 'Empleado no encontrado';
		}
		else{
			$row = $query->fetch_assoc();
			$employee_id = $row['id'];
			$sql = "INSERT INTO cashadvance (employee_id, date_advance, amount) VALUES ('$employee_id', NOW(), '$amount')";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Adelanto de sueldo agregado satisfactoriamente';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}	
	else{
		$_SESSION['error'] = 'Para agregar primero llene el formulario';
	}

	header('location: cashadvance.php');

?>