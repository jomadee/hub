<?php 

?>

<div class="pagina" id="home">
	
	<div class="pepo">
		<div class="vazoBloko">
			<div class="bloko notificacoes">
				<?php
				$tipos = array('1','2','3','4', '6');
				
				$sql = 'select a.id as id_view, a.data_view, b.id, b.link, b.var_id, b.data, c.nome, c.img, ti.sql, ti.texto 
						from '.PREFIXO.'notificacoes_view a
						
						left join '.PREFIXO.'notificacoes b
						on a.notificacao = b.id
						
							
							left join '.PREFIXO.'usuario_conta c
							on b.user = c.id
						
							left join '.PREFIXO.'notificacoes_tipo ti
							on b.tipo = ti.id
						
						where a.user = '.$_ll['user']['id'].' and ti.id in('.implode(',', $tipos).')
						
						order by a.id desc';
		
				$total = mysql_query('select id from ('.$sql.') tot where data_view is null');
				$total = mysql_num_rows($total);
				
				$query = mysql_query($sql.'	limit 10');

				?>
				
				<div class="hBar projeto" style="background-color: #D24726;">
					<a href="projeto" class="lall"></a>
					<span class="titu"><img src="<?php echo $_ll['app']['pasta'].'img/home/ico_projetos.png'; ?>"/><?php _t('idx-projetos') ?></span>
					
					<?php  if(!empty($total)) echo '<span class="tot">'.$total.'</span>';	?>
				</div>
				
				<div class="pepoj">
					<?php
					if(mysql_num_rows($query) == 0)
						echo '<span class="respon">Convide seus amigos para participarem de seus projetos</span>';
					
					while($dados = mysql_fetch_assoc($query)){
						$complemento = null;
						$print = true;
						
						if(!empty($dados['sql'])){
							$complemento = @mysql_fetch_assoc(mysql_query(str_replace(array('PREFIXO', 'VAR_ID'), array(PREFIXO, $dados['var_id']), $dados['sql'])));
							
							$complemento = $complemento['nome'];
						} else {
							$print = false;
						}
						
						if($print){
							echo '<span class="pepo'.(empty($dados['data_view']) ? ' ne_vido' : '').'">'
									.'<a href="'.$dados['link'].'" class="lall"></a>'
									.'<img src="'.img('uploads/contas/micro_'.$dados['img']).'" class="foto" />'
									.'<div class="lateral">'
										.'<strong>'.stripcslashes($dados['nome']).'</strong> '
										._t($dados['texto'], false)
										.(!empty($complemento)? ' <strong>'.$complemento.'</strong>' : '')
										.'<span class="data">'.rd_date($dados['data']).'</span>'
									.'</div>'
								.'</span>';
								
							if(empty($dados['data_view']))
								jf_update(PREFIXO.'notificacoes_view', array('data_view' => time()), array('id' => $dados['id_view']));
						}

					}		
					
					?>
				</div>
			</div>
			
			<div class="bloko notificacoes">				
				<?php
				$tipos = array('8');
				
				$sql = 'select a.id as id_view, a.data_view, b.id, b.link, b.var_id, b.data, c.nome, c.img, ti.sql, ti.texto 
						from '.PREFIXO.'notificacoes_view a
						
						left join '.PREFIXO.'notificacoes b
						on a.notificacao = b.id
						
							
							left join '.PREFIXO.'usuario_conta c
							on b.user = c.id
						
							left join '.PREFIXO.'notificacoes_tipo ti
							on b.tipo = ti.id
						
						where a.user = '.$_ll['user']['id'].' and ti.id in('.implode(',', $tipos).')
						
						order by a.id desc';
		
				$total = mysql_query('select id from ('.$sql.') tot where data_view is null');
				$total = mysql_num_rows($total);
				
				$query = mysql_query($sql.'	limit 10');

				?>
				
				<div class="hBar comunidade"  style="background-color: #405484;">
					<a href="comunidade" class="lall"></a>
					<span class="titu"><img src="<?php echo $_ll['app']['pasta'].'img/home/ico_comunidades.png'; ?>"/><?php _t('idx-comunidades') ?></span>
					<?php  if(!empty($total)) echo '<span class="tot">'.$total.'</span>';	?>
				</div>
				
				<div class="pepoj">
					<?php		
					if(mysql_num_rows($query) == 0)
						echo '<span class="respon">Está com dúvidas, interaja pelo forum de suas comunidades</span>';
						
					while($dados = mysql_fetch_assoc($query)){
						$complemento = null;
						if(!empty($dados['sql'])){
							$complemento = mysql_fetch_assoc(mysql_query(str_replace(array('PREFIXO', 'VAR_ID'), array(PREFIXO, $dados['var_id']), $dados['sql'])));
							$complemento = $complemento['nome'];
						}
						
						echo '<span class="pepo'.(empty($dados['data_view']) ? ' ne_vido' : '').'">'
								.'<a href="'.$dados['link'].'" class="lall"></a>'
								.'<img src="'.img('uploads/contas/micro_'.$dados['img']).'" class="foto" />'
								.'<div class="lateral">'
									.'<strong>'.stripcslashes($dados['nome']).'</strong> '
									._t($dados['texto'], false)
									.(!empty($complemento)? ' <strong>'.$complemento.'</strong>' : '')
									.'<span class="data">'.rd_date($dados['data']).'</span>'
								.'</div>'
							.'</span>';
							
						if(empty($dados['data_view']))
							jf_update(PREFIXO.'notificacoes_view', array('data_view' => time()), array('id' => $dados['id_view']));

					}		
					
					?>
				</div>
			</div>
						
			<div class="bloko mensagens">
				<?php
				$sql = 'SELECT COUNT(a.id) as naoLidas
					FROM ' . PREFIXO . 'usuario_mensagem_view a
					WHERE a.visto = "0" and a.usuario = "' . $_ll['user']['id']. '"
				';

				$naoLidas = mysql_fetch_assoc(mysql_query($sql));
				$naoLidas = $naoLidas['naoLidas'];
				?>
				
				<div class="hBar social"  style="background-color: #5CB2FF;">
					<a href="social/mensagens" class="lall"></a>
					<span class="titu"><img src="<?php echo $_ll['app']['pasta'].'img/home/ico_social.png'; ?>"/><?php _t('idx-social') ?></span>
					<?php  if(!empty($naoLidas)) echo '<span class="tot">'.$naoLidas.'</span>';	?>
				</div>
				
				<?php
			
				$mostrar = null;
				
				$sql = 'SELECT * FROM (
							SELECT c.usuario, d.conversa, c.texto, c.data, vi.visto,
								(SELECT GROUP_CONCAT(DISTINCT b.id,",",b.nome,",",b.img separator ";")
									FROM ' . PREFIXO . 'usuario_conversa_participante a
									
									JOIN ' . PREFIXO . 'usuario_conta b
									ON b.id = a.usuario

									WHERE conversa = d.conversa) as users
							FROM ' . PREFIXO . 'usuario_mensagem c
							
							JOIN
								' . PREFIXO . 'usuario_mensagem_view vi
							ON
								c.id = vi.mensagem and vi.usuario = "' . $_ll['user']['id']. '"

							JOIN ' . PREFIXO . 'usuario_conversa_participante d
							ON d.conversa = c.conversa

							WHERE d.usuario = "' . $_ll['user']['id']. '" and 
								(SELECT COUNT(*)
									FROM ' . PREFIXO . 'usuario_mensagem
								WHERE usuario != "' . $_ll['user']['id']. '" and conversa = d.conversa
								) > 0

								ORDER BY  c.data desc
						) e 					
						group by e.conversa  
						order BY e.data desc 
						limit 6';

				$mensagens = mysql_query($sql);
				?>
				<div class="mensagens">
					<?php
					if(mysql_num_rows($mensagens) == 0)
						echo '<span class="respon">Converse com seus contatos, troque informações, idéias</span>';
					
					$i = 0;
					while($mensagem = mysql_fetch_assoc($mensagens)){
						$i++;
						?>

						<div class="mensagem">
							<a href="social/mensagens/conversa=<?php echo $mensagem['conversa']?>" class="lall"></a>
							<?php
							$resu = null;

							$mostra = explode(';', $mensagem['users']);

							foreach($mostra as $uni)
								$resu[] = explode(',', $uni);							

							$quant = count($resu);
							?>

							<div class="imagens">
								<?php
								switch($quant){
									case 2:
										$quem = ($resu[0][0] == $_SESSION['sh']['id']? 1: 0);
										?>
										<div class="img_P1">
											<img src="<?php echo img('uploads/contas/micro_' . $resu[$quem][2]);?>" />
										</div>
										<?php
									break;

									case 3:
										?>
										<div class="img_P2">
											<img src="<?php echo img('uploads/contas/micro_' . $resu[0][2]);?>" />
										</div>

										<div class="img_P3">
											<img src="<?php echo img('uploads/contas/micro_' . $resu[1][2]);?>" />
										</div>

										<div class="img_P4">
											<img src="<?php echo img('uploads/contas/micro_' . $resu[2][2]);?>" />
										</div>
										<?php
									break;
									
									default:
										if ($quant >= 4){
											?>
											<div class="img_P5">
												<img src="<?php echo img('uploads/contas/micro_' . $resu[0][2]);?>" />
											</div>

											<div class="img_P5">
												<img src="<?php echo img('uploads/contas/micro_' . $resu[1][2]);?>" />
											</div>

											<div class="img_P5">
												<img src="<?php echo img('uploads/contas/micro_' . $resu[2][2]);?>" />
											</div>

											<div class="img_P5">
												<img src="<?php echo img('uploads/contas/micro_' . $resu[3][2]);?>" />
											</div>
											<?php
										}
									break;
								}
								?>
							</div>

							<div class="colunaTexto">	
								<?php
								$html = '';
								$a = 0;

								foreach($resu as $nome){
									$html .= (($nome[1] != $_SESSION['sh']['nome'])?(($a < 2)? ($html == ''? '': ', ') . $nome[1]: ''):'');
									$a++;
								}								
								$html .= ($quant <= 3? ' e': ',') . ' eu';
								?>
								<span class="<?php echo 'nome'.(empty($mensagem['visto']) ? ' naoV' : '') ?>">	<?php echo stripcslashes($html), ($quant > 3? ' e +' . ($quant - 2) : '')?></span>
								<div class="texto">		<?php echo stripslashes(strip_tags($mensagem['texto'])); ?>	</div>
							</div>
						</div>						
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
/*
<script>
	$('#pepoAdd').click(function(event){
		ll_load('<?php echo $shOnserver.'ac=markAdd'?>');
		event.stopPropagation();
		$('#blokoAdd').show();
	});
	
	 $('html').click(function() {
		$('#blokoAdd').hide();
	 });
	
	$('.openBox').jfbox();
</script>
*/
?>
