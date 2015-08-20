<?php
lliure::loadcss($_ll['app']['pasta'].'perfil/estilo.css');
$this->usuario = mysql_fetch_assoc(mysql_query('select a.*, b.nome as estado, b.sigla 
					from '.PREFIXO.'usuario_conta a

					left join br_estado b
					on b.sigla = a.estado
					
					where a.id = "'.$_GET['user'].'" limit 1'));

$_ll['titulo'] .= ' - '.$this->usuario['nome'].' '.$this->usuario['sobrenome'];


$sql = 'select b.id, b.nome, b.img
		from ' . PREFIXO . 'usuario_comunidade a

		left join ' . PREFIXO . 'comunidade b
		on b.id = a.comunidade
		
		where a.usuario = "' . $this->usuario['id'] . '" ';

$this->comunidades = mysql_query($sql);

$sql = 'select a.id, a.img, a.nome, a.sobrenome
		from ' . PREFIXO . 'usuario_conta a

		where id in (select a.contato
					from ' . PREFIXO . 'usuario_contato a
					where a.usuario = "' . $this->usuario['id'] . '" and a.contato != "' . $this->user['id'] . '"
					)
		order by rand() limit 16';

$this->contatos = mysql_query($sql);

$meuContato = @mysql_result(mysql_query('select id from ' . PREFIXO . 'usuario_contato where usuario = "' . $this->user['id'] . '" and contato = "' .  $this->usuario['id'] . '" '), 0);

intext::set(193,234);
?>