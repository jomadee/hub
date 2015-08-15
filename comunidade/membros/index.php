<?php
set_t(51);

if($onserver){
	require_once($shdir . 'paginas/comunidade/membros/onserver.php');

}else{

	require_once($shdir . 'paginas/comunidade/membros/membros.php');

}
?>