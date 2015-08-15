<?php
switch(isset($_GET['ac']) ? $_GET['ac'] : 'default'){

	case 'novo':		
		$data = time();
		
		sh_historico('return');
		
		$topico = array(
			'comunidade' => $_GET[1],
			'criador' => $_SESSION['sh']['id'],
			'nome' => $_POST['titulo'],
			'data' => $data
		);
		
		jf_insert(PREFIXO.'comunidade_topicos', $topico);
		
		$id_topico = $jf_ultimo_id;
		
		$mensagem = array(
			'topico' => $id_topico,
			'user' => $_SESSION['sh']['id'],
			'mensagem' => $_POST['mensagem'],
			'data' => $data
			);
		jf_insert(PREFIXO.'comunidade_mensagens', $mensagem);
		
		
		header('location: '.$shHome.$_GET[1].'/forum/'.$id_topico);
	break;
	
	case 'pes':
		$pes = '';
		if(!empty($_POST['pesquisa']))
			$pes = '/pes=' . str_replace(' ', '+', urlencode(mb_strtolower($_POST['pesquisa'])));
			
		header('location: ' . $shHome . $_GET[1] . '/forum' . $pes);
	break;
	
	case 'envi':
		$apigem = new api; 
		$apigem->iniciaApi('sciigo');
	
		$inser['topico'] = $_GET[3];
		$inser['user'] = $_SESSION['sh']['id'];
		$inser['mensagem'] = $_POST['mensagem'];
		$inser['data'] = time();
		
		if ($erro = jf_insert(PREFIXO.'comunidade_mensagens', $inser))
			echo $erro;
		
		$query = mysql_query('select * from '.PREFIXO.'comunidade_mensagens where topico =  "'. $_GET[3].'" and user != "'.$_SH['user']['id'].'" order by id desc limit 12');
		while($dados = mysql_fetch_assoc($query))
			$view[] = $dados['user'];

		
		$not =  new sciigo;
		$not->tipo = 8;
		$not->link = 'comunidade/'.$_GET[1].'/forum/' . $_GET[3] . '/pag=ultima';
		$not->view = $view;
		$not->var_id = $_GET[1];
		$not->ekig();
		
		header('location: ' . $shHome . $_GET[1] . '/forum/' . $_GET[3]);
		
	break;
	
	case 'dele':
		//print_r($_GET);
		jf_delete(PREFIXO.'comunidade_topicos', array('id' => $_GET['id']));
		header('location: ' . $shHome . $_GET[1] . '/forum');
	break;
	
	default:
		
	break;
}
?>