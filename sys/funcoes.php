<?php
function img($trako = null){	
	if(empty($trako))
		return false;

	if(strpos($trako, 'uploads/') !== false)
		$trako = substr($trako, 8);

	if(file_exists('../uploads/'.$trako))
		return '../uploads/'.$trako;

	$trako = explode('_', $trako);

	return 'app/hub/img/'.$trako[0].'_sem_imagem.jpg';
}

function rd_date($needle = null){

	$timeDia = 24 * 60 * 60;

	$data = explode('/', date('n/j/Y/w'));

	$zeroHora = mktime(0, 0, 0, $data[0], $data[1], $data[2]);

	$initAno = mktime(0, 0, 0, 1, 1, $data[2]);

	$dia = $data[3];

	$aSemana = array(
			'Domingo',
			'Segunda',
			'Terça',
			'Quarta',
			'Quinta',
			'Sexta',
			'Sábado'
	);

	$semana[$zeroHora] = 'Hoje';
	$semana[$zeroHora - $timeDia] = 'Ontem';

	for($i = 2; $i < 7; $i++)
		$semana[$zeroHora - $timeDia * $i] = $aSemana[(($dia - $i < 0)? 7 + ($dia - $i) : $dia - $i)];

	$data = explode('/', date('n/d/Y/H\\hi', $needle));

	if($needle > ($zeroHora - ($timeDia * 6))){
		$data = $semana[mktime(0, 0, 0, $data[0], $data[1], $data[2])] . ', ' . $data[3];
	} elseif ($needle > $initAno) {
		$data =  $data[1] . '/' . $data[0]. ', ' . $data[3];
	} else {
		$data = $data[1] . '/' . $data[0] . '/' . $data[2];
	}

	return $data;
}


/******************************		Ajusta intext	*/
function _t($palavra, $echo = true){
	return intext::t($palavra, $echo);
}