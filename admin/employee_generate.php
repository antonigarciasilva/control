<?php
	include 'includes/session.php';

	function generateRow($conn){
		$contents = '';
	 	
		$sql = "SELECT * FROM employees  ORDER BY employees.lastname ASC, employees.firstname ASC";

		$query = $conn->query($sql);
		
		while($row = $query->fetch_assoc()){
			$contents .= '
			<tr>
				<td>'.$row['lastname'].', '.$row['firstname'].'</td>
				<td>'.$row['employee_id'].'</td>
				
			</tr>
			';
		}	
		return $contents;
	}
//explode() -> Divide o convierte a un string en array. implode() hace lo contrario. Algo similar es str_split()


    $query = $conn->query($sql);
   	$drow = $query->fetch_assoc();

	


    $content = '';  
    $content .= '
      	<h2 align="center">FERROPLAST GROUP</h2>
      	<table border="1" cellspacing="0" style="width: 100%" align="center" cellpadding="3">  
           <tr>  
           		<th width="40%" align="center"><b>Nombre Empleado</b></th>
                <th width="30%" align="center"><b>DNI Empleado</b></th>
           </tr>  
      ';  
    $content .= generateRow($conn);  
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
	$dompdf->stream("lista_empleados.pdf", array("Attachment" => false));
	/*
    $pdf->writeHTML($content);  
    $pdf->Output('payroll.pdf', 'I'); */

?>