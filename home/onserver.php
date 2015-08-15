<?php

switch(isset($_GET['ac']) ? $_GET['ac'] : 'default' ){
	case 'default':		
		header('location: '.$UrlReal);
		break;
		
	case 'markAdd':
		$tipos = array();

		$sql = 'select a.id as id_view, a.data_view, b.id, b.link, b.var_id, b.data, c.nome, c.img, ti.sql, ti.texto 
				from '.PREFIXO.'notificacoes_view a
				
				left join '.PREFIXO.'notificacoes b
				on a.notificacao = b.id
				
					
					left join '.PREFIXO.'usuario_conta c
					on b.user = c.id
				
					left join '.PREFIXO.'notificacoes_tipo ti
					on b.tipo = ti.id
				
				where a.user = '.$_SH['user']['id'].' and ti.id = "7" and a.data_view is null';
		
		$query = mysql_query($sql);
		
		while($dados = mysql_fetch_assoc($query))
			jf_update(PREFIXO.'notificacoes_view', array('data_view' => time()), array('id' => $dados['id_view']));
			
		?>
		<script type="text/javascript">
			$('#pepoAdd').html('<img src="<?php echo $shdir; ?>imagens/home/ico_add_0.png" alt="" />');
		</script>
		<?php
		break;
}
	
	/*
else
	require_once('modal.php');*/
?>