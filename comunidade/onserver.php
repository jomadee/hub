<?php
switch (isset($_GET['ac']) ? $_GET['ac'] : ''){
case 'part':
	jf_insert(PREFIXO.'usuario_comunidade', array('usuario' => $this->user['id'], 'comunidade' => $this->cmdd['id']));
	header('location: '.$this->home.'&sapm=comunidade&cmd='.$this->cmdd['id']);
	break;	
	
case 'deixar':
	jf_delete(PREFIXO.'usuario_comunidade', array('usuario' => $this->user['id'], 'comunidade' => $this->cmdd['id']));
	header('location: '.$this->home.'&sapm=comunidade&cmd='.$this->cmdd['id']);
	break;
	
case 'post':	
	jf_insert(PREFIXO.'comunidade_mensagens', array('data' => time(), 'topico' => $_GET['topico'], 'user' => $this->user['id'], 'mensagem' => $_POST['mensagem']));
	header('location: '.$this->home.'&sapm=comunidade&sapm=forum&cmd='.$this->cmdd['id'].'&topico='.$_GET['topico'].'&pag=ultima');
	break;
	
	
case 'editar':
	if($this->cmdd['adm'])
		jf_update(PREFIXO.'comunidade', array('descricao' => $_POST['descricao']), array('id' => $this->cmdd['id']));
		
	header('location: '.$this->home.'&sapm=comunidade&cmd='.$this->cmdd['id']);
	break;
	
case 'topico_novo':
	global $jf_ultimo_id;
	jf_insert(PREFIXO.'comunidade_topicos', array('criador' => $this->user['id'] , 'data' => time(), 'comunidade' => $_GET['cmd'], 'nome' => $_POST['titulo']));
	$topico = $jf_ultimo_id;
	
	jf_insert(PREFIXO.'comunidade_mensagens', array('data' => time(), 'topico' => $topico, 'user' => $this->user['id'], 'mensagem' => $_POST['mensagem']));
	header('location: '.$this->home.'&sapm=comunidade&sapm=forum&cmd='.$this->cmdd['id'].'&topico='.$topico);
	break;
}