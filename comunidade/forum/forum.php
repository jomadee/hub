<div id="cmd_home"  class="hb_internPage">
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
		
						
			//$sql .= 'LIMIT' . (isset($_GET['pag']) && $_GET['pag'] != 'ultima'? $paginacao->limit(): ($total - $paginacao->visivel > 0? $total - $paginacao->visivel: 0) . ', ' . $paginacao->visivel);
				
			$mensagens = mysql_query($sql);
			?>
						
							
			<div class="cabecalho_m">
				<h2><?php echo $topico['nome']?></h2>
			</div>
				
			<div class="mensagens">
				<?php
				while($mensagem = mysql_fetch_assoc($mensagens)){?>
					<div>
						<div class="img">
							<a href="perfil/<?php echo $mensagem['usuario']?>"><img src="<?php echo img('uploads/contas/mini_' . $mensagem['img']); ?>" /></a>
						</div>
						<div class="texto">
							<span class="titulo">
								<a class="posdadoPor" href="perfil<?php echo ($this->user['id'] == $mensagem['usuario'])? '': '/' . $mensagem['usuario'];?>"><?php echo stripslashes($mensagem['nome']);?></a> - <?php echo rd_date($mensagem['data']);?>
							</span>
							<div class="blocoTexto">
								<?php echo url2link(stripslashes($mensagem['mensagem']));?>
							</div>
						</div>
					</div>
					<?php
				}?>
			</div>
			
			<div class="areaPostar">
				<form id="responder" class="form" action="<?php echo $this->onserver.'&cmd='.$this->cmdd['id'].'&topico=' . $topico['id'], '/ac=envi'?>" method="post">
					<input type="hidden" name="conversa" value="<?php echo $topico['id']?>"/>
					<fieldset>
						<div>		
							<label><?php _t('frm-resposta'); ?></label>				
							<textarea  name="mensagem"></textarea>
						</div>				
					</fieldset>	
					<div class="botoes">
						<button class="postar" type="submit"><?php _t('ac-postar');?></button>
					</div>				
				</form>				
			</div>
			
			
			<script type="text/javascript" src="<?php echo $_ll['app']['pasta'].'js/jquery.validate.min.js'?>"></script>
			
			<script type="text/javascript">
							
				$(function(){	
					var validator = $("#responder").submit(function() {
						// update underlying textarea before submit validation
						tinyMCE.triggerSave();
						if ($(this).valid()){
							$('.postar').attr('disabled', 'disabled').html('Postando!');
						}else{
							return false;
						}
					}).validate({
						ignore: "",
						rules: {
							mensagem: "required"
						},
						errorPlacement: function(label, element) {
							// position error label after generated textarea
							if (element.is("textarea")) {
								label.insertAfter(element.next());
							} else {
								label.insertAfter(element)
							}
						}
					});
					
					validator.focusInvalid = function() {
						// put focus on tinymce on submit validation
						if( this.settings.focusInvalid ) {
							try {
								var toFocus = $(this.findLastActive() || this.errorList.length && this.errorList[0].element || []);
								if (toFocus.is("textarea")) {
									tinyMCE.get(toFocus.attr("id")).focus();
								} else {
									toFocus.filter(":visible").focus();
								}
							} catch(e) {
								// ignore IE throwing errors when focusing hidden elements
							}
						}
					}
					
				});	
			</script>
	
			<?php
		}
		?>
	</div>
</div>