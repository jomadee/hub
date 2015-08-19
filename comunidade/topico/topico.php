<div id="cmd_home"  class="hb_internPage">
	<div class="hb_menu cmd-cmd_menu">
		<?php require_once $_ll['app']['pasta'].'comunidade/menu.php';?>
	</div>
	
	<div class="hb_centro parcial">
		<h2><?php _t('frm-criar-topc')?></h2>
		<form class="form">
			<fieldset>
				<div>
					<label><?php _t('frm-titulo')?></label>
					<input name="titulo" />
				</div>
				
				<div>
					<label><?php _t('frm-texto')?></label>
					<textarea name="mensagem"></textarea>
				</div>
			</fieldset>
			<div class="botoes">
				<button type="submit" class="confirm"><?php _t('ac-gravar')?></button>
				<a href="<?php echo $_ll['app']['home'].'&apm=comunidade&sapm=comunidade&cmd='.$this->cmdd['id']?>"><?php _t('ac-cancelar')?></a>
			</div>
		</form>
	</div>
</div>