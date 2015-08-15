<?php
require_once($shdir . 'functions/geraInput.php');
?>

<span class="titulo"><span class="mimgBasa"><?php _t('idx-comunidades')?><a class="mimg informo" href="<?php echo 'onserver/informo/comunidade'; ?>"></a></span></span>

<form action="<?php echo $shOnserver,'ac=pes' ?>" method="post">
	<div>
		<?php
		$busca = '';
		$class = '';
		
		if(isset($_GET['pes'])){ 
			$busca = $_GET['pes'];
			$class = ' pesCont';
			echo '<a href="comunidade"><img src="',$shdir,'imagens/clean.png" alt=""/></a>';
		} 
		
		echo geraInput('pesquisa', $busca, array('class' => 'comuInpPes '.$class, 'rel' => _t('cmd-encontrar', false)));
		?>
	</div>
</form>

<ul>		
	<li><a href="comunidade"><?php _t('cmd-minhas')?></a></li>
	<li><a href="comunidade/p=como-criar-comunidade"><?php _t('cmd-criar')?></a></li>		
</ul>


<script type="text/javascript" src="<?php echo $UrlReal . $shdir; ?>js/jquery.jf_inputext.js"></script>
<script type="text/javascript">
	$('.comuInpPes').jf_inputext();
	$('.informo').jfbox({width: 390, height: 410});
</script>