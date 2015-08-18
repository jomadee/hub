<?php
function img($trako = null, $corte = false){	
	if(empty($trako))
		return false;

	if(strpos($trako, 'uploads/') !== false)
		$trako = substr($trako, 8);

	if(file_exists('../uploads/'.$trako)){
		if($corte != false){
			$trako = explode('/', $trako);
			$img = array_pop($trako);
			$trako = implode('/', $trako).'/'.$corte.'/'.$img;

		}
		return '../uploads/'.$trako;
	}

	$trako = explode('_', $trako);

	return 'app/hub/img/'.$trako[0].'_sem_imagem.jpg';
}

function rd_date($needle = null){

	$timeDia = 24 * 60 * 60;

	$data = explode('/', date('n/j/Y/w'));

	$zeroHora = mktime(0, 0, 0, $data[0], $data[1], $data[2]);

	$initAno = mktime(0, 0, 0, 1, 1, $data[2]);

	$dia = $data[3];
	
	$meses = array("0","Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
	
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
		$data =  $data[1] . '/' . $data[0]. ', ' . $data[3].'h';
	} else {
		$data = $data[1] . ' de ' . $meses[$data[0]] . ' de ' . $data[2];
	}

	return $data;
}


function url2link($text) {
	$text = " ".$text;

	/*
		$text = preg_replace('/(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)/i',
				'<a href="\\1" target=_blank>\\1</a>', $text);

	$text = preg_replace('/(((f|ht){1}tps://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)/',
			'<a href="\\1" target=_blank>\\1</a>', $text);
	$text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)/',
			'\\1<a href="http://\\2" target=_blank>\\2</a>', $text);
	$text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/',
			'<a href="mailto:\\1" target=_blank>\\1</a>', $text);*/
	return $text;
}

/******************************		Ajusta intext	*/
function _t($palavra, $echo = true){
	return intext::t($palavra, $echo);
}