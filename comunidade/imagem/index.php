<?php

unset($menuLateral, $subMenuLateral);

?>

<div id="imagem" class="pagina">
	
	<div class="cabecalho">
	
		<h1 class="shcolor">Imagem da comunidade</h1>
	
	</div>
	
	<?php

	//echo '<pre>' . print_r($_SESSION, true) . '</pre>';

	if (!isset($_SESSION['comu']['img'])){?>

		<div class="formulario">

			<form class="" action="<?php echo $shOnserver, $cmdd['id'], '/imagem/ac=subimg'?>" method="post" id="fileForm" enctype="multipart/form-data">

				<?php
				/*$file = new imgup; 					//inicia a classe
				$file->enForm();*/
				?>

				<div>
					<input name="img" type="file" class="required" accept="image/*" />
				</div>

				<span class="botao shbackground"><button type="submit">Alterar</button></span>
				<span class="botao shbackground"><a href="<?php echo $reveni?>">Cancelar</a></span>

			</form>

		</div>

		<script type="text/javascript" src="<?php echo $UrlReal; ?>js/jquery.validate.min.js"></script>
		<script type="text/javascript">
			$(function() {
				$("#fileForm").validate();
			});
		</script>

		<?php

	}else{?>

		<div class="Imagens">

			<img src="<?php echo $UrlReal . 'uploads/tmp/g_' . $_SESSION['comu']['img']?>"/>

			<img src="<?php echo $UrlReal . 'uploads/tmp/m_' . $_SESSION['comu']['img']?>"/>

		</div>

		<span class="botao shbackground"><a href="<?php echo $shOnserver, $cmdd['id'], '/imagem/ac=imgconf'?>">Confirmar</a></span>

		<span class="botao shbackground"><a href="<?php echo $shOnserver, $cmdd['id'], '/imagem/ac=imgcans'?>">Cancelar</a></span>

		<?php

	}?>
	
</div>