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

/******************************		Ajusta intext	*/
function _t($palavra, $echo = true){
	return intext::t($palavra, $echo);
}