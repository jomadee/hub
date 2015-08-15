<?php
require_once($shdir . 'functions/geraInput.php');

set_t(92);
?>
<div id="cmd-forum" class="pagina comMenu">
	<div class="cabecalho">	
		<?php
		if(isset($_GET[3])){
			?>
			<span class="botao shbackground right"><a  href="<?php echo $reveni; ?>"><?php _t('ac-voltar'); ?></a></span>
			<?php
		}
		?>
		<h1 class="shcolor"><?php _t('frm-forum'); ?></h1>
	<?php
	
	if(isset($_GET['3']) && $_GET['3'] == 'novo'){
		?>
		</div>
		
		<div class="novo">
			<h2>Novo tópico</h2>
			<form id="novoTopico" class="form" action="<?php echo $shOnserver.$cmdd['id'].'/forum/ac=novo';  ?>" method="post">
				<fieldset>
					<div>
						<label><?php _t('frm-titulo'); ?></label>
						<input type="text" name="titulo" />
					</div>
				
					<div>
						<label><?php _t('frm-texto'); ?></label>					
						<textarea class="textarea" name="mensagem"></textarea>
					</div>
				</fieldset>
				
				<span class="botao shbackground"><button type="submit"><?php _t('ac-postar'); ?></button></span>
				<span class="botao shbackground"><a  href="<?php echo $reveni; ?>"><?php _t('ac-voltar')?></a></span>
				
			</form>
		</div>
		
		<script src="http://synapseshub.com/sistema/api/tiny_mce/tiny_mce.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo $UrlReal; ?>js/jquery.validate.min.js"></script>
		
		<script type="text/javascript">

			tinyMCE.init({
			
				mode : "textareas",
				theme : "lliure",	

				theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,removeformat"
				
			});
	
			$(function(){	
				var validator = $("#novoTopico").submit(function() {
					// update underlying textarea before submit validation
					tinyMCE.triggerSave();
				}).validate({
					ignore: "",
					rules: {
						titulo: "required",
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
	} elseif(isset($_GET[3])){

		require_once($shdir . 'functions/rd_paginacao.php');
		$paginacao = new rd_paginacao();
		$paginacao->visivel = 6;
		$paginacao->url = jf_monta_link($_GET, 'pag', JF_URL_AMIGAVEL) . '/pag=';
		$paginacao->estrutura = array(
			array(
				'type'  => 'first',
				'value' => _t('ac-primeira', false)
			),
			array(
				'type'  => 'number',
				'value' =>	3
			),
			array(
				'type'  => 'last',
				'value' => _t('ac-ultima', false)
			)
		);

		$sql = '
			SELECT
				a.id, a.mensagem, a.data, b.id as usuario, b.img, b.nome
			FROM
				' . PREFIXO . 'comunidade_mensagens a
				
				LEFT JOIN
					' . PREFIXO . 'usuario_conta b
				ON
					b.id = a.user
					
			WHERE
				a.topico = "' . $_GET[3] . '"
		
		';
		$total = mysql_num_rows(mysql_query($sql));
		$paginacao->total = ceil($total / $paginacao->visivel);
		$paginacao->atual = isset($_GET['pag'])? ($_GET['pag'] != 'ultima'?$_GET['pag'] : $paginacao->total): 1;

		$sql .= '
			LIMIT
				' . (isset($_GET['pag']) && $_GET['pag'] != 'ultima'? $paginacao->limit(): ($total - $paginacao->visivel > 0? $total - $paginacao->visivel: 0) . ', ' . $paginacao->visivel) . '
		';

		$mensagens = mysql_query($sql);
		?>
		</div>
		
		<div class="cabecalho_m">
			<h2><?php echo @mysql_result(mysql_query('select nome from '.PREFIXO.'comunidade_topicos where id = "' . $_GET[3] . '" limit 1'), 0)?></h2>
			<?php $paginacao->montar('aDir');?>
		</div>
			
		<div class="mensagens scroll-pane jspScrollable">
			<?php
			while($mensagem = mysql_fetch_assoc($mensagens)){?>
				<div class="mensagem">
					<div class="img">
						<a href="perfil/<?php echo $mensagem['usuario']?>"><img src="<?php echo img('uploads/contas/mini_' . $mensagem['img']); ?>" /></a>
					</div>
					<div class="texto">
						<span class="titulo">
							<a class="posdadoPor" href="perfil<?php echo ($_SESSION['sh']['id'] == $mensagem['usuario'])? '': '/' . $mensagem['usuario'];?>"><?php echo stripslashes($mensagem['nome']);?></a> - <?php echo rd_date($mensagem['data']);?>
						</span>
						<div class="blocoTexto">
							<?php echo url2link(stripslashes($mensagem['mensagem']));?>
						</div>
					</div>
				</div>
				<?php
			}?>
		</div>
		
		<span class="botao responder shbackground">
			<a href="javascript: void(0)"><?php _t('ac-responder'); ?></a>
		</span>

		<div class="areaPostar">
			<form id="responder" action="<?php echo $shOnserver, $cmdd['id'], '/forum/', $_GET[3], '/ac=envi'?>" method="post">
				<input type="hidden" name="conversa" value="<?php echo $_GET[3]?>"/>
				<fieldset>				
					<legend class="shcolor"><?php _t('frm-resposta'); ?></legend>				
					<textarea class="textarea" name="mensagem"></textarea>				
				</fieldset>	
				
				<button class="postar shbackground" type="submit"><?php _t('ac-postar');?></button>				
			</form>
			
		</div>
		
		<script src="http://synapseshub.com/sistema/api/tiny_mce/tiny_mce.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo $UrlReal; ?>js/jquery.validate.min.js"></script>
		
		<script type="text/javascript">
			$('.responder').click(function(){
				
				$(this).hide();
				$('.areaPostar').slideDown(500);
				
			});

			tinyMCE.init({
			
				// General options
				mode : "textareas",
				theme : "lliure",
				width: 659,
				height: 200,
				theme_advanced_buttons1 : "bold,italic"
				
			});
	
			$(function(){	
				var validator = $("#responder").submit(function() {
					// update underlying textarea before submit validation
					tinyMCE.triggerSave();
					if ($(this).valid()){
						$('.postar').attr('disabled', 'disabled').html('');
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
				
				/*$("#responder").submit(function() {
					if ($("#responder").valid()){
						$('.postar').attr('disabled', 'disabled');
					}else{
						return false;
					}
				}*/
			});	
		</script>
		
		<?php
	} else {

		$query = '
			select 
				a.*, (
					select
						count(id) 
					from 
						' . PREFIXO . 'comunidade_mensagens

					where 
						topico = a.id
				)-1 as total
			from 
				' . PREFIXO . 'comunidade_topicos a
				
			where
				a.comunidade = "' . $cmdd['id'] . '"
		';
		
		if(isset($_GET['pes'])){
		
			$_GET['pes'] = urldecode($_GET['pes']);
			
			$_GET['pes'] = str_replace('+', ' ', $_GET['pes']);
		
			$pesq = explode(' ', $_GET['pes']);
			
			$query .= ' and (';			

			foreach($pesq as $chave => $valor){
				$query .= ($chave != 0?' and':'').' (';
				
				$query .= 'a.nome like "%'.$valor.'%"';
				
				$query .= ')';
			}
			$query .= ') ';

		}
		
		$query .= '
			ORDER BY
				a.data DESC
		';
		
	
		require_once($shdir . 'functions/rd_paginacao.php');
		$paginacao = new rd_paginacao();
		$paginacao->visivel = 8;
		$paginacao->atual = isset($_GET['pag'])? $_GET['pag']: 1;
		$paginacao->url = jf_monta_link($_GET, 'pag', JF_URL_AMIGAVEL) . '/pag=';
		$paginacao->estrutura = array(
			array(
				'type'  => 'first',
				'value' => _t('ac-primeira', false)
			),
			array(
				'type'  => 'number',
				'value' =>	3
			),
			array(
				'type'  => 'last',
				'value' => _t('ac-ultima', false)
			)
		);
		
		$paginacao->total = ceil(mysql_num_rows(mysql_query($query)) / $paginacao->visivel);

		$query .= '
			LIMIT
				' . $paginacao->limit() . '
		';

		$query = mysql_query($query);
	
		?>

			<div class="ferramentas">
				<form action="<?php echo $shOnserver,$cmdd['id'],'/forum/ac=pes' ?>" method="post" class="pes">
					<div>
						<?php 
						
						$busca = '';
						$class = '';
			
						if(isset($_GET['pes'])){ 
							$_GET['pes'] = urldecode($_GET['pes']);
							$busca = $_GET['pes'];
							$class = ' pesCont';
							echo '<a href="'.jf_monta_link($_GET, 'pes', JF_URL_AMIGAVEL).'"><img src="',$shdir,'imagens/clean.png" alt=""/></a>';
						} 
			
						echo geraInput('pesquisa', $busca, array('class' => 'input'.$class, 'rel' => _t('frm-encontrar-topc', false)));
						?>
					</div>
					
					<span class="botao shbackground"><button type="submit"><?php _t('ac-pesquisar');?></button></span>
				</form>
				
				<span class="botao shbackground right"><a href="<?php echo jf_monta_link($_GET, array('pag','pes'),JF_URL_AMIGAVEL) . '/novo';?>"><?php _t('frm-criar-topc'); ?></a></span>
				
				<?php echo ((isset($_GET['pes']))? '<span class="pesr segoe">'._t('ac-resultados', false).' "<em>' . str_replace('+', ' ', $_GET['pes']) . '</em>"</span>': ''); ?>
			</div>
		</div>
		
		
		<div class="topicos">
			<table>
				<thead>
					<tr>
						<th><?php _t('frm-titulo')?></th>
						<th style="width: 127px;" class="center"><?php _t('frm-respostas'); ?></th>
						<th style="width: 42px;"></th>
					</tr>
				</thead>
				<?php
				while($dados = mysql_fetch_assoc($query)){
					$url = jf_monta_link($_GET, array('pag','pes'), JF_URL_AMIGAVEL) . '/' . $dados['id'];
					?>
					<tr>
						<td><a href="<?php echo $url ?>"><?php echo $dados['nome']; ?></a></td>
						<td class="center"><?php echo $dados['total']; ?></td>
						<td class="center">
							<a href="<?php echo $url , '/pag=ultima';?>" title="<?php _t('ac-ult-pag'); ?>" class="img16 lasta"></a>
							<?php if($cmdd['adm']){ ?>
								<img class="img16 placo" src="<?php echo $shdir , 'imagens/blank.gif'; ?>"/>
								<a onclick="return confirm('<?php _t('ac-excluir-pergunta') ?>');" href="<?php echo $shOnserver, $cmdd['id'], '/forum/ac=dele/id=',$dados['id'] ?>" class="img16 retiri"></a>
							<?php } ?>
						</td>
					</tr>
					<?php
				}?>
			</table>
			
			<?php $paginacao->montar('paginacao');?>
			
		</div>
		
		<script src="<?php echo $UrlReal , $shdir; ?>js/jquery.jf_inputext.js" type="text/javascript"></script>
		<script type="text/javascript">
			$('.input').jf_inputext();
		</script>
		<?php
	}
	?>
	
</div>
