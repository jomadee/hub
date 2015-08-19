<div id="cmd_forum"  class="hb_internPage">
	<div class="hb_menu cmd-cmd_menu">
		<?php require_once $_ll['app']['pasta'].'comunidade/menu.php';?>
	</div>
	
	<div class="hb_centro parcial">		
		<div>
			<h2><?php _t('cmd-alt-cmd'); ?></h2>
			
			<form class="form" action="<?php echo $_ll['app']['onserver'],'&apm=comunidade','&cmd=',$this->cmdd['id'],'&ac=editar'; ?>" method="post">
				<fieldset>
					<div>
						<label><?php _t('cmd-nome'); ?></label>
						<span><?php _t('cmd-alt-linhafina'); ?></span>
					</div>
					<div>
						<label><?php _t('cmd-alt-descricao'); ?></label>
						<textarea name="descricao"><?php echo $this->cmdd['descricao']; ?></textarea>
						<span class="ex markdowninfo">Quer fazer uma formatação mais agradável? <a href="http://rafaelbriet.com.br/o-que-e-e-como-usar-linguagem-markdown" target="blank">clique aqui</a></span>
					</div>
				</fieldset>
				<div class="botoes">
					<button type="submit" class="confirm"><?php _t('ac-gravar') ;?></button>
					<a href="<?php echo $this->home.'&sapm=comunidade&cmd='.$this->cmdd['id'];?>"><?php _t('ac-cancelar'); ?></a>
				</div>
			</form>
		</div>
	</div>
</div>