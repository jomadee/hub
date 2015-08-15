<?php
require_once($shdir . 'functions/geraInput.php');

?>
<link rel="stylesheet" type="text/css" href="<?php echo $UrlReal .'on/css/comunidade/forum.css';?>" />

<div id="cmd_home" class="pagina comMenu">
	<h1 class="shcolor"><?php _t('cmd-alt-cmd'); ?></h1>	
	<form class="form" action="<?php echo $shOnserver, $cmdd['id'], '/editar/ac=eldoni'; ?>" method="post">
		<fieldset>
			<div>
				<span class="botao shbackground btper">
					<a class="jfbox" href="<?php echo $shOnserver, $cmdd['id'], '/editar/ac=hubs' ;?>"><?php _t('cmd-inco-hub'); ?></a>
				</span>
			</div>
		</fieldset>
		<fieldset>
			<div>
				<label><?php _t('cmd-nome'); ?></label>
				<span><?php _t('cmd-alt-linhafina'); ?></span>
			</div>
			<div>
				<label><?php _t('cmd-alt-descricao'); ?></label>
				<textarea name="descricao"><?php echo p2nl($cmdd['descricao']); ?></textarea>
			</div>
		</fieldset>
		
		<span class="botao shbackground"><button type="submit"><?php _t('ac-gravar') ;?></button></span>
		<span class="botao shbackground"><a href="<?php echo $reveni;?>"><?php _t('ac-cancelar'); ?></a></span>
	</form>
</div>

<script type="text/javascript">

	$('.jfbox').jfbox();
	
</script>