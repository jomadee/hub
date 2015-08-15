<?php
switch(isset($_GET['p']) ? $_GET['p'] : 'home'){
	case "home":
	?>
	<div id="comunidades" class="pagina comMenu">
		
		<?php
		$query = 'select  a.*, b.id, b.nome, b.img, (select count(id) from '.PREFIXO.'usuario_comunidade where comunidade = a.comunidade) as membros
						from '.PREFIXO.'usuario_comunidade a
						
						left join '.PREFIXO.'comunidade b
						on a.comunidade = b.id
						
						where usuario = "'.$_ll['user']['id'].'"';
						
		if(isset($_GET['pes'])){		
			$_GET['pes'] = rawurldecode($_GET['pes']);		
				
			$_GET['pes'] = str_replace('+', ' ', $_GET['pes']);			
			$pesq = explode(' ', $_GET['pes']);			
			
			$query = 'select b.id, b.nome, b.img, (select count(id) from '.PREFIXO.'usuario_comunidade where comunidade = b.id) as membros					
					from '.PREFIXO.'comunidade b';			
			
			$query .= ' where (';					
			foreach($pesq as $chave => $valor){
				$query .= ($chave != 0?' and':'').' (';
				
				$query .= 'b.nome like "%'.$valor.'%"';
				
				$query .= ')';
			}
			$query .= ') ';
			
			echo '<h2>'._t('ac-resultados', false).' "'.$_GET['pes'].'"</h2>';
			
		} else {
			$query = 'select  a.*, b.id, b.nome, b.img, (select count(id) from '.PREFIXO.'usuario_comunidade where comunidade = a.comunidade) as membros
						from '.PREFIXO.'usuario_comunidade a
						
						left join '.PREFIXO.'comunidade b
						on a.comunidade = b.id
						
						where usuario = "'.$_ll['user']['id'].'"
						order by b.nome asc';
		}
			
		$sql = mysql_query($query);
		
		if(mysql_num_rows($sql) < 1 && isset($_GET['pes']))
			echo '<p>'._t('ac-nao-encontrou', false).'</p>';
		?>
			
		<div class="suas_comu">
			<div class="blokos">				
				<?php
				$ids = null;
				while($dados = mysql_fetch_assoc($sql)){
					$ids .= (!empty($ids) ? ',' : '') . $dados['id'];
					?>
					<div class="bloko">
						<a href="<?php echo $this->home.'&sapm=comunidade&cmd='.$dados['id'] ?>" class="lall"></a>
						<img src="<?php echo img('uploads/comunidades/m_'.$dados['img']); ?>" class="imagem"/>
						<h2 class="font_padrao"><?php echo stripcslashes($dados['nome']) ?></h2>
						<span class="membros"><?php echo _t('cmd-membros', false),': ', $dados['membros']; ?></span>					
					</div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
		
		if(!isset($_GET['pes'])){
			?>
			<div class="outras_comu">
				<h2><?php _t('cmd-outras') ?></h2>
				
				<?php			
				$query = 'select  b.id, b.nome, b.img, (select count(id) from '.PREFIXO.'usuario_comunidade where comunidade = b.id) as membros
						from '.PREFIXO.'comunidade b
						
						'.(!empty($ids) ? 'where b.id not in('.$ids.')' : '')
						.'order by b.nome asc';
		
				$sql = mysql_query($query);
				?>
				
				<div class="blokos">				
					<?php
					while($dados = mysql_fetch_assoc($sql)){
						?>
						<div class="bloko">
							<a href="<?php echo $this->home.'&sapm=comunidade&cmd='.$dados['id'] ?>" class="lall"></a>
							<span class="bg"></span>
							
							<h2 class="font_padrao"><?php echo stripcslashes($dados['nome']) ?></h2>
							<h2 class="font_padrao hh2"><?php echo stripcslashes($dados['nome']) ?></h2>
							
							<img src="<?php echo img('uploads/comunidades/g_'.$dados['img']); ?>" class="imagem"/>
							
							
							<span class="membros shcolor"><?php echo _t('cmd-membros', false),': ', $dados['membros']; ?></span>
							
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<?php
		}
		?>	
	</div>
	<?php
	break;
	
	case "como-criar-comunidade":
		set_t(423);
		?>
		<div id="comunidades" class="pagina comMenu">
			<h1 class="shcolor"><?php _t('cmd-nov-solicitacao'); ?></h1>
			<?php _t('cmd-nov-descreva'); ?>

				
			<form class="formPadrao" method="post" action="<?php echo $shOnserver.'ac=solicitar'; ?>">				
				<fieldset>
					<div class="linha">
						<div>
							<label><?php _t('cmd-nov-nome'); ?></label>
							<input  name="nome" />
						</div>
					</div>
					
					<div class="linha">
						<div>
							<label><?php _t('cmd-nov-descricao'); ?></label>
							<textarea name="descricao"></textarea>
						</div>
					</div>
					
				</fieldset>
				
				<span class="botao shbackground"><button type="submit"><?php _t('ac-enviar'); ?></button></span>
			</form>
			
		</div>
		<?php
		break;
	
	case 'solitaOk':
		set_t(423);
		?>
		<div id="comunidades" class="pagina comMenu">
			<h1 class="shcolor"><?php _t('cmd-nov-solicitacao'); ?></h1>
			<h2><?php _t('cmd-nov-solicitacao_ok'); ?></h2>
			<?php _t('cmd-nov-solicitacao_ok_frase'); ?>
		</div>
		<?php
		break;
}
?>