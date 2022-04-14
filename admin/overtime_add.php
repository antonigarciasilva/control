<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee = $_POST['employee'];
		$date = $_POST['date'];
		$hours = $_POST['hours'] + ($_POST['mins']/60);
		$rate = $_POST['rate'];
		$sql = "SELECT * FROM employees WHERE employee_id = '$employee'";
		$query = $conn->query($sql);
		if($query->num_rows < 1){
			$_SESSION['error'] = 'Empleado no encontrado';
		}
		else{
			$row = $query->fetch_assoc();
			$employee_id = $row['id'];
			$sql = "INSERT INTO overtime (employee_id, date_overtime, hours, rate) VALUES ('$employee_id', '$date', '$hours', '$rate')";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Horas extra agregado satisfactoriamente';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}	
	else{
		$_SESSION['error'] = 'Para agregar primero llene el formulario';
	}

	header('location: overtime.php');

?>