<?phprequire_once($shdir . 'functions/geraInput.php');require_once($shdir . 'functions/geraSelect.php');set_t(57);if (isset($_SESSION['sugestao'])){	$dados = $_SESSION['sugestao'];	unset($_SESSION['sugestao']);}else{	$dados = array(		'inthora'		=> date('G'),		'intminuto'		=> date('i'),		'intdia'		=> date('j'),		'intmes'		=> date('n'),		'intano'		=> date('Y'),		'fimhora'		=> date('G', time() + (60 * 60)),		'fimminuto'		=> date('i'),		'fimdia'		=> date('j'),		'fimmes'		=> date('n'),		'fimano'		=> date('Y'),	);}?><div id="sugerir" class="pagina comMenu">        <div class="cabecalho">        <h1 class="shcolor"><?php _t('evt-sugestao');?></h1>    </div>    	<form class="form" id="fcadastro" action="onserver/comunidade/<?php echo $_GET[1]?>/eventos/ac=sugerir" method="post">        <fieldset>			<div>    			<label><?php _t('evt-titulo');?></label>				<?php echo geraInput('nome', $dados);?>			</div>			<div>				<label><?php _t('evt-descricao');?></label>				<textarea class="P3" name="descricao"><?php echo ((isset($dados['descricao']))? $dados['descricao']: '')?></textarea>			</div>			<div>				<table>					<tr>						<td style="width: 140px;">							<label><?php _t('evt-inicio');?></label>							<input name="dataIni" class="data"/>						</td>												<td style="width: 140px;">							<label><?php _t('evt-termino');?></label>							<input name="dataFim" class="data"/>						</td>						<td></td>					</tr>				</table>			</div>			<div>				<label><?php _t('evt-local');?></label>				<?php echo geraInput('local', $dados);?>			</div>					</fieldset>        		<span class="botao"><button class="shbackground" type="submit"><?php _t('evt-ok');?></button></span>        	</form></div><script src="http://synapseshub.com/sistema/api/tiny_mce/tiny_mce.js" type="text/javascript"></script><script type="text/javascript" src="js/jquery.validate.min.js"></script><script type="text/javascript">	tinyMCE.init({		// General options		mode : "textareas",		theme : "lliure",		height: 300,				// Theme options		theme_advanced_buttons1 : "bold,italic",			});		$('.data').mask('99/99/9999 99:99');	    $(function(){			ajustaForm();				var validator = $("#fcadastro").submit(function() {			// update underlying textarea before submit validation			tinyMCE.triggerSave();		}).validate({			ignore: "",			rules: {				nome: "required",				dataIni: "required",								descricao:{				  required: true,				  minlength: 50				}			},			errorPlacement: function(label, element) {				// position error label after generated textarea				if (element.is("textarea")) {					label.insertAfter(element.next());				} else {					label.insertAfter(element)				}			}		});				validator.focusInvalid = function() {			// put focus on tinymce on submit validation			if( this.settings.focusInvalid ) {				try {					var toFocus = $(this.findLastActive() || this.errorList.length && this.errorList[0].element || []);					if (toFocus.is("textarea")) {						tinyMCE.get(toFocus.attr("id")).focus();					} else {						toFocus.filter(":visible").focus();					}				} catch(e) {					// ignore IE throwing errors when focusing hidden elements				}			}		}		});	</script>