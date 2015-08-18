<div id="cmd_home"  class="hb_internPage">
	<div class="hb_menu cmd-cmd_menu">
		<?php require_once $_ll['app']['pasta'].'comunidade/menu.php';?>
	</div>
	
	<div class="hb_centro">
		<div class="hb_box cmd-cmd_top">
			<?php 
			echo '<span class="titulo">'.$this->cmdd['nome'].'</span>'
				.'<div class="descricao">'.$this->cmdd['descricao'].'</div>'; 
			?>
		</div>
				
		<div class="hb_box cmd-cmd_forum">
			<h2><?php _t('cmd-forum'); ?></h2>
			
			<div class="cmd-forum_table">
				<?php		

				$query = 'select a.*, count(b.topico) - 1 as total,
							b.mensagem, b.data
							from '.PREFIXO.'comunidade_topicos a
				
							left join (select mg.* from '.PREFIXO.'comunidade_mensagens mg order by mg.id desc) b
							on a.id = b.topico
					
							where a.comunidade = "'.$this->cmdd['id'].'"
							group by b.topico
							order by a.id desc limit 7
							';
				
				$query = mysql_query($query);
				
				while($dados = mysql_fetch_assoc($query)){
					$url = $this->home.'&sapm=forum&cmd='.$this->cmdd['id'].'&topico=' . $dados['id'];
					$mensagem = substr(strip_tags($dados['mensagem']), 0, 100);
					
					echo '<div class="post">'
							.'<span class="titulo ll_color">'.($this->cmdd['membro'] == true
								 ? '<a href="'.$url.'" class="ll_color">'.$dados['nome'].'</a>'
								 : $dados['nome']
							 ).'</span>'
							
							.'<span class="sub">'
								.'<span class="resposta">' .$dados['total'].' respostas'. '</span> <span class="resposta">-</span>' 
								.'<span class="texto">' . ($this->cmdd['membro'] ? '<a href="'.$url . '/pag=ultima" title="'. _t('ac-ult-pag', 0).'">'.$mensagem.'</a>' : $mensagem ) .'</span>'
								.'<span class="resposta">' .rd_date($dados['data']). '</span>'
							.'</span>'		
									
						.'</div>';
				}
				?>
				<div class="both"></div>
			</div>
	
		</div>
	</div>
	
	<div class="hb_lateral cmd-cmd_lateral">
		<div class="hb_box">
			<span class="titulo">Membros</span>
			<div class="fotos">
				<?php 
				$query = mysql_query('select uct.id, uct.img
							from '.PREFIXO.'usuario_comunidade ucd
	 
							left join '.PREFIXO.'usuario_conta uct
							on ucd.usuario = uct.id
	
							where ucd.comunidade = "'.$this->cmdd['id'].'" 
						order by RAND() 
						limit 9');
	
				while($user = mysql_fetch_assoc($query))
					echo '<img src="'. img('uploads/contas/mini_'.$user['img'], '50-50-o'). '" class="imagem"/>'
				?>
			</div>
		</div>
	</div>
</div>
