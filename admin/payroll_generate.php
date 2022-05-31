<?php
	include 'includes/session.php';

	function generateRow($from, $to, $conn, $deduction){
		$contents = '';
	 	
		$sql = "SELECT *, sum(num_hr) AS total_hr, attendance.employee_id AS empid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id LEFT JOIN position ON position.id=employees.position_id WHERE date BETWEEN '$from' AND '$to' GROUP BY attendance.employee_id ORDER BY employees.lastname ASC, employees.firstname ASC";

		$query = $conn->query($sql);
		$total = 0;
		while($row = $query->fetch_assoc()){
			$empid = $row['empid'];
                      
	      	$casql = "SELECT *, SUM(amount) AS cashamount FROM cashadvance WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to'";
	      
	      	$caquery = $conn->query($casql);
	      	$carow = $caquery->fetch_assoc();
	      	$cashadvance = $carow['cashamount'];

			$gross = $row['rate'] * $row['total_hr'];
			$total_deduction = $deduction + $cashadvance;
      		$net = $gross - $total_deduction;

			$total += $net;
			$contents .= '
			<tr>
				<td>'.$row['lastname'].', '.$row['firstname'].'</td>
				<td>'.$row['employee_id'].'</td>
				<td align="right">'.number_format($net, 2).'</td>
			</tr>
			';
		}

		$contents .= '
			<tr>
				<td colspan="2" align="right"><b>Total</b></td>
				<td align="right"><b>'.number_format($total, 2).'</b></td>
			</tr>
		';
		return $contents;
	}
		
	$range = $_POST['date_range'];
	$ex = explode(' - ', $range);
	$from = date('Y-m-d', strtotime($ex[0]));
	$to = date('Y-m-d', strtotime($ex[1]));

	$sql = "SELECT *, SUM(amount) as total_amount FROM deductions";
    $query = $conn->query($sql);
   	$drow = $query->fetch_assoc();
    $deduction = $drow['total_amount'];

	$from_title = date('M d, Y', strtotime($ex[0]));
	$to_title = date('M d, Y', strtotime($ex[1]));





    $content = '';  
    $content .= '
      	<h2 align="center">FERROPLAST GROUP</h2>
      	<h4 align="center">'.$from_title." - ".$to_title.'</h4>
      	<table border="1" cellspacing="0" style="width: 100%" align="center" cellpadding="3">  
           <tr>  
           		<th width="40%" align="center"><b>Nombre Empleado</b></th>
                <th width="30%" align="center"><b>DNI Empleado</b></th>
				<th width="30%" align="center"><b>Salario Neto</b></th> 
           </tr>  
      ';  
    $content .= generateRow($from, $to, $conn, $deduction);  
    $content .= '</table>';  

	
	require_once('../dompdf/autoload.inc.php');  
	//Creamos un objeto para poder usar todas las funcionalidades del dompdf
	use Dompdf\Dompdf;
	$dompdf = new Dompdf();

	//Para mostrar imgs
	$options = $dompdf->getOptions();
	$options->set(array('isRemoteEnabled' => true));
	$dompdf->setOptions($options);

	//Imprimir una prueba
	$dompdf->loadhtml($content);
	

	//Posición de la hoja
	$dompdf->setPaper('letter');
	//$dompdf->setPaper('A4', 'landspace');

	//Para ver el pdf en el navegador o descargarlos desde el mismo
	$dompdf->render();

	//Si estaría TRUE se va a autoimprimir con false solo se abre en el navegador
	$dompdf->stream("pagos_.pdf", array("Attachment" => false));
	/*
    $pdf->writeHTML($content);  
    $pdf->Output('payroll.pdf', 'I'); */

?>