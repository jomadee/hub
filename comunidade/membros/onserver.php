<?php
switch(isset($_GET['ac'])? $_GET['ac']: 'default'){

	case 'pes':		
		$pes = '';
		if(!empty($_POST['pes']))
			$pes = '/pes=' . str_replace(' ', '+', urlencode(mb_strtolower($_POST['pes'])));
			
		header('location: '. $shHome . $_GET[1] . '/membros' . $pes);	
	break;
	
	case 'estingi':
		if($cmdd['adm']){
			$dados = mysql_fetch_assoc(mysql_query('select * from '.PREFIXO.'usuario_comunidade where id = "'.$_GET['m'].'" limit 1'));
			
			if($dados['comunidade'] == $cmdd['id'])
				jf_update(PREFIXO.'usuario_comunidade', array('status' => 'E'), array('id' => $_GET['m']) );
		}

		header('location: '. $shHome . $_GET[1] . '/membros');	
	break;
	
	default:
	
	break;
}
?>