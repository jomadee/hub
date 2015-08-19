<div id="cmd_forum"  class="hb_internPage">
	<div class="hb_menu cmd-cmd_menu">
		<?php require_once $_ll['app']['pasta'].'comunidade/menu.php';?>
	</div>
	
	<div class="hb_centro parcial">		
		<?php
		if(!isset($_GET['topico'])){
			//<h2><?php _t('cmd-forum'); ?</h2>
			require_once 'topicos.php';
		} else {
			$topico = mysql_fetch_assoc(mysql_query('select * from '.PREFIXO.'comunidade_topicos where id = "' . $_GET['topico'] . '" limit 1'));
			
			$sql = 'SELECT
						a.id, a.mensagem, a.data, b.id as usuario, b.img, b.nome
					FROM
						' . PREFIXO . 'comunidade_mensagens a
				
						LEFT JOIN
							' . PREFIXO . 'usuario_conta b
						ON
							b.id = a.user
					
					WHERE
						a.topico = "' . $_GET['topico'] . '"			
					';
				
			$mensagens = mysql_query($sql);
			?>
			<h2><?php echo $topico['nome']?></h2>		
				
			<div class="topico">
				<?php
				$texto = new Parsedown();
				while($mensagem = mysql_fetch_assoc($mensagens)){?>
					<div class="post">
						<div class="img">
							<?php 
							echo (!empty($mensagem['usuario'])
								? '<a href="perfil/'.$mensagem['usuario'].'"><img src="'.img('uploads/contas/mini_' . $mensagem['img']).'" /></a>'
								: '<img src="'.$_ll['app']['pasta'].'img/contas/mini_sem_imagem.jpg'.'" />'
							);
							?>
						</div>
						
						<div class="texto">
							<span class="titulo">
								<?php 
								echo (!empty($mensagem['usuario'])
									? '<a class="posdadoPor ll_color" href="'. $_ll['app']['home'].'&apm=perfil&perfil='.$mensagem['usuario'].'">'.stripslashes($mensagem['nome']).'</a> - '
									: '' ).rd_date($mensagem['data']);
								?>
								
							</span>
							<div class="blocoTexto hb_markdown">
								<?php echo $texto->text($mensagem['mensagem']);?>
							</div>
						</div>
					</div>
					<?php
				}?>
			</div>
			
			<div class=hb_areaPostar>
				<form id="responder" class="form" action="<?php echo $_ll['app']['onserver'].'&apm=comunidade&cmd='.$this->cmdd['id'].'&topico=' . $topico['id'], '&ac=post'?>" method="post">
					<input type="hidden" name="conversa" value="<?php echo $topico['id']?>"/>
					<fieldset>
						<div class="img">
							<img src="<?php echo img('uploads/contas/mini_' . $this->user['img']); ?>" />	
						</div>
						
						<div>
							<textarea class="hb_textoarea"  name="mensagem" placeholder="<?php _t('frm-resposta'); ?>"></textarea>
							<span class="ex markdowninfo">Quer fazer uma formatação mais agradável? <a href="http://rafaelbriet.com.br/o-que-e-e-como-usar-linguagem-markdown" target="blank">clique aqui</a></span>
						</div>
					</fieldset>	
					<div class="botoes">
						<button class="postar confirm" type="submit"><?php _t('ac-postar');?></button>
					</div>				
				</form>				
			</div>
						
			<script type="text/javascript">
							
				$(function(){	
					$('.hb_textoarea').focusin(function(){
						$(this).animate({ height: "400px"}, 300);
						$('.markdowninfo').css('display', 'block');
						$('html, body').animate({scrollTop:  $(document).height()}, 'slow');
					}).focusout(function(){
						if($(this).val() == ''){
							$(this).animate({ height: "58px"}, 300);
							$('.markdowninfo').hide();
						}
					});

					
					$("#responder").validate({
						ignore: "",
						rules: {
							mensagem: "required"
						},
						messages:{
							mensagem: ""
						}
					});
					
					
				});	
			</script>
			<?php
		}
		?>
	</div>
</div>