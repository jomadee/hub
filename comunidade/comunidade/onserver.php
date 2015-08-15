<?php
switch(isset($_GET['ac'])? $_GET['ac']: 'default'){

	case 'pes':
		
		$pes = '';
		if(!empty($_POST['pesquisa']))
			$pes = 'pes=' . str_replace(' ', '+', $_POST['pesquisa']);
		
		header('location: '. $shHome . $pes);
	
	break;
	
	case 'solicitar':
		require_once('../sistema/api/phpmailer/inicio.php');
		
		$cabecalho = array(
			'replyTo' => 'synapseshub  <mail@lliure.com>',
			'from' => 'synapseshub  <mail@lliure.com>'
			);
			
		$mensagem = '<strong>Usuário</strong>: '.$_SESSION['sh']['nome'].', <strong>id</strong>: '.$_SESSION['sh']['id'].' <br/><br/>
			<strong>Nome para comunidade</strong>: '.$_POST['nome'].'<br/>
			<strong>Descrição</strong>: '.$_POST['descricao'];
	
		pm_mail('jnomade2@gmail.com', 'Solicitação de comunidade lliureHub', $mensagem, $cabecalho);	
		
		header('location: '.$shHome.'p=solitaOk');
	break;
	
	default:
	
	break;
	
}
?>