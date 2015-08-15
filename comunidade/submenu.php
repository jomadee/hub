
<span class="titulo"><?php _t('cmd-acoes'); ?></span>

<ul>		
	<li><a href="<?php echo $shHome , $_GET[1] , '/forum/novo'?>"><?php _t('cmd-criar-topico'); ?></a></li>
	<li><a href="<?php echo $shHome , $_GET[1] , '/eventos/sugerir'?>"><?php _t('cmd-sug-event'); ?></a></li>
	<?php
	if($cmdd['adm'])
		echo '<li><a href="'.$shHome,$cmdd['id'],'/editar">'. _t('cmd-edit-cmd') .'</a></li>';
	else
		echo '<li><a href="'.$shOnserver,$cmdd['id'],'/ac=lasi">'. _t('cmd-deixar-cmd') .'</a></li>';
	?>
</ul>


<style type="text/css">
.menuLateral{
	padding-bottom: 140px;
	}
</style>
