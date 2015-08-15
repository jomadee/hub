<?php
switch(isset($_GET['ac']) ? $_GET['ac'] : 'default'){

	case 'lasi':
		jf_delete(PREFIXO.'usuario_comunidade', array('usuario' => $_SESSION['sh']['id'], 'comunidade' => $_GET[1]));
		
		header('location: '.$shHome);
	break;
	
	case 'part':
	
		jf_insert(PREFIXO . 'usuario_comunidade', array('usuario' => $_SESSION['sh']['id'], 'comunidade' => $_GET[1]));
		
		header('location: '. $shHome . $_GET[1]);
	
	break;
		
	default:
		header('location: '.$shHome);
	break;
}
?>