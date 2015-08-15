<?php
switch(isset($_GET['ac']) ? $_GET['ac'] : 'default'){

	case 'eldoni':
		$_POST['descricao'] = nl2p($_POST['descricao']);
		
		jf_update(PREFIXO.'comunidade', $_POST, array('id' => $cmdd['id']));
		
		header('location: '.$shHome.$cmdd['id']);
	break;
		
	default:
		header('location: '.$shHome.$cmdd['id']);
	break;
	
	case 'hubs':
	case 'addhub':
	case 'delhub':
	case 'peshub':

		require_once('onserverHubs.php');

	break;
}
?>