<?php
	include 'includes/session.php';
	
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


    $contents = '';

	$sql = "SELECT *, SUM(num_hr) AS total_hr, attendance.employee_id AS empid, employees.employee_id AS employee FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id LEFT JOIN position ON position.id=employees.position_id WHERE date BETWEEN '$from' AND '$to' GROUP BY attendance.employee_id ORDER BY employees.lastname ASC, employees.firstname ASC";

	$query = $conn->query($sql);
	while($row = $query->fetch_assoc()){
		$empid = $row['empid'];
                      
      	$casql = "SELECT *, SUM(amount) AS cashamount FROM cashadvance WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to'";
      
      	$caquery = $conn->query($casql);
      	$carow = $caquery->fetch_assoc();
      	$cashadvance = $carow['cashamount'];

		$gross = $row['rate'] * $row['total_hr'];
		$total_deduction = $deduction + $cashadvance;
  		$net = $gross - $total_deduction;

		$contents .= '
			<h2 align="center">FERROGROUP</h2>
			<h4 align="center">'.$from_title." - ".$to_title.'</h4>
			<table cellspacing="0" align="center"  cellpadding="3">  
    	       	<tr>  
            		<td width="25%" align="right">Nombre Empleado: </td>
                 	<td width="25%"><b>'.$row['firstname']." ".$row['lastname'].'</b></td>
				 	<td width="25%" align="right">Pago por Hora: </td>
                 	<td width="25%" align="right">'.number_format($row['rate'], 2).'</td>
    	    	</tr>
    	    	<tr>
    	    		<td width="25%" align="right">DNI Empleado: </td>
				 	<td width="25%">'.$row['employee'].'</td>   
				 	<td width="25%" align="right">Total de Horas: </td>
				 	<td width="25%" align="right">'.number_format($row['total_hr'], 2).'</td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Pago Real: </b></td>
				 	<td width="25%" align="right"><b>'.number_format(($row['rate']*$row['total_hr']), 2).'</b></td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right">Descuentos: </td>
				 	<td width="25%" align="right">'.number_format($deduction, 2).'</td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right">Avance de Efectivo: </td>
				 	<td width="25%" align="right">'.number_format($cashadvance, 2).'</td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Total Descuentos:</b></td>
				 	<td width="25%" align="right"><b>'.number_format($total_deduction, 2).'</b></td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Salario Neto:</b></td>
				 	<td width="25%" align="right"><b>'.number_format($net, 2).'</b></td> 
    	    	</tr>
    	    </table>
    	    <br><hr>
		';
	}
	require_once('../dompdf/autoload.inc.php');  
	//Creamos un objeto para poder usar todas las funcionalidades del dompdf
	use Dompdf\Dompdf;
	$dompdf = new Dompdf();

	//Para mostrar imgs
	$options = $dompdf->getOptions();
	$options->set(array('isRemoteEnabled' => true));
	$dompdf->setOptions($options);

	//Imprimir una prueba
	$dompdf->loadhtml($contents);
	

	//Posición de la hoja
	$dompdf->setPaper('letter');
	//$dompdf->setPaper('A4', 'landspace');

	//Para ver el pdf en el navegador o descargarlos desde el mismo
	$dompdf->render();

	//Si estaría TRUE se va a autoimprimir con false solo se abre en el navegador
	$dompdf->stream("Recibo de sueldos.pdf", array("Attachment" => false));
   /* $pdf->writeHTML($contents);  
    $pdf->Output('payslip.pdf', 'I'); */

?>