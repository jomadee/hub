<?php
$_ll['titulo'] .= ' - Comunidades';

if($_ll['mode_operacion'] == 'onserver')
	$modo = 'onserver';
else 
	$modo = 'index';

$subPagina = 'comunidades/' . $modo;
	
if(isset($_GET['cmd'])) {
	$subPagina = 'home/' . $modo;
	
	$cmdd = mysql_fetch_assoc(mysql_query('select * from '.PREFIXO.'comunidade where id = "'.$_GET['cmd'].'" limit 1'));

	$query = mysql_query('select * from '.PREFIXO.'usuario_comunidade where comunidade = "'.$cmdd['id'].'" and usuario = "'.$_ll['user']['id'].'" ');

	$cmdd['adm'] = false;
	$cmdd['membro'] = false;
	
	if(mysql_num_rows($query) != 0){
		$cmdd['membro'] = true;
		
		$dados = mysql_fetch_assoc($query);
		if($dados['status'] == 'A')
			$cmdd['adm'] = true;
	
	}
	
	if(isset($_GET[2])){
		$subPagina = $_GET[2] . '/' . $modo;
	}
	
	$this->cmdd = $cmdd;
}



/*
//coloque neste array as paginas que não serão bloqueadas
$paguinasLivre = array(
	'home'
);

if(isset($_GET[2]) and !in_array($_GET[2], $paguinasLivre) and $cmdd['membro'] == false){
	
	$sh_pagina = $sh_boqueio;
	
}else{
	$sh_onserver = $sh_pagina.'comunidade/'.$subPagina.'.php';
	$sh_pagina = 'comunidade/'.$subPagina.'.php';
}
*/

intext::set(31);
lliure::loadcss($_ll['app']['pasta'].'comunidade/comunidade.css');
?>