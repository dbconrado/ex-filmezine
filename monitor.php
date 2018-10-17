<?php

require_once 'banco.class.php';

$banco = new Banco();
$evidencias = $banco->select('evidencia');

for ($i = 0; $i < count($evidencias); $i++) {
	$data = new DateTime($evidencias[$i]['datahora']);
	$evidencias[$i]['datahora'] = $data->format('H:i:s d-m-Y');
}

header('Content-type: application/json');
echo json_encode($evidencias);

?>