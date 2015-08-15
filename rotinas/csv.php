<?php
set_time_limit (300);
require_once('../../../etc/bdconf.php');
require_once('../../../includes/jf.funcoes.php');

$handle = fopen ("csv.csv","r");
while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
	$data[2] = explode(' a ', $data[2]);
	$grava = array(
		'uf' => $data[0],
		'cidade' => $data[1],
		'cep1' => $data[2][0],		
		'expresso' => $data[3],		
		'rodoviario' => $data[4],		
		'tarifa' => $data[5],		
		'frap' => $data[6],		
		'distribuidor' => $data[7],		
		'redespacho' => $data[8]
		);
	if(isset($data[2][1]))
		$grava['cep2'] = $data[2][1];
	
	//jf_insert(PREFIXO.'jadlog_cidade', $grava);
	
	echo print_r($grava, 1). '<br />';
	
}
fclose ($handle);
echo 'ok';
?>
