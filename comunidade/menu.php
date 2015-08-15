<div class="top">
	<div class="img">
		<a href="comunidade/<?php echo $_GET[1];?>"><img src="<?php echo img('uploads/comunidades/g_'.$cmdd['img']); ?>" alt="" /></a>
		
		<?php
		if (isset($cmdd['adm']) and $cmdd['adm'] == true){?>
			<form action="<?php echo $shOnserver, $_GET[1], '/imagem/ac=init'?>" method="post">
				<?php echo geraInput('ret', $urlFull, array('type' => 'hidden'))?>
				<span class="link botao">
					<button type="submit" class="shcolor"><?php _t('ac-atl-img'); ?></button>
				</span>
			</form>
			<?php
		}?>
		
	</div>
	
	<a href="comunidade/<?php echo $_GET[1];?>"><span class="nome"><?php echo $cmdd['nome']; ?></span></a>
</div>

<?php if ($cmdd['membro'] == true){?>
	<ul>
		<li><a href="<?php echo 'comunidade/',$_GET[1],'/membros'; ?>"><?php _t('cmd-membros'); ?></a></li>
		<li><a href="<?php echo 'comunidade/',$_GET[1],'/eventos'; ?>"><?php _t('cmd-eventos'); ?></a></li>
		<li><a href="<?php echo 'comunidade/',$_GET[1],'/projetos'; ?>"><?php _t('idx-projetos'); ?></a></li>
		<li><a href="<?php echo 'comunidade/',$_GET[1],'/forum'; ?>"><?php _t('cmd-forum'); ?></a></li>
	</ul>
	<?php
}?>
