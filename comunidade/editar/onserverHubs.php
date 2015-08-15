<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);
/*	case 'hubs':
	case 'addhub':
	case 'delhub':
	case 'peshub':

		require_once('onserverHubs.php');

	break;*/

function addUni($dados){

	$html = '';

	$html .= '<div class="cmd cmd_' . $dados['id'] . '">

		<img src="' . img('uploads/hub/m_' . $dados['img']) . '" />

		<span class="Del" onclick="romoveEu(\'' . $dados['id'] . '\')"></span>

	</div>';

	return $html;

}

switch(isset($_GET['ac'])? $_GET['ac']: 'php'){

	/*
	 *
	 *	Box para a adicao e remocao de hubs do projeto
	 *
	*/

	case 'hubs':
		set_t(404);
	
		$sql = '
			SELECT
				a.id, a.nome, a.imagem as img
			FROM
				' . PREFIXO . 'hub a
				
				JOIN
					' . PREFIXO . 'comunidade_hubs b
				ON
					b.hub = a.id
				
			WHERE
				b.comunidade = "' . addslashes($_GET[1]) . '"
				
			ORDER BY
				b.data
		';
		$hubs = mysql_query($sql);

		?>

		<div id="edtCmd" class="box">
		
			<div id="ac"></div>

			<div class="cabecalho">

				<h1 class="shcolor"><?php _t('cmd-edit-vincular-a-hubs') ?></h1>
				
				<p><?php _t('cmd-edit-vinc-hub-linha-fina'); ?></p>

				<label>Pesquisar hubs</label>
				
				<form>

					<input id="filtro" name="filtro"/>	

					<div class="lista"></div>

				</form>

				<h2><strong>Hubs vinculados</strong></h2>

			</div>
			
			<div class="listCmd">
			
				<?php
				
				$nomes = '';
				
				while($hub = mysql_fetch_assoc($hubs)){
					
					$nomes .= 'nomes[' . $hub['id'] . '] = true;';
					
					echo addUni($hub);
					
				}?>
			
			</div>

		</div>
		
		<script>

			var nomes = new Object();
			<?php echo $nomes?>
			var positionSelect = 0;
			var inputTamanho = 15;
			var caractriesParaPesquisa = 1;

			$("#filtro").keypress(function(event){
				
				var apLista = $('.lista').css('display') == 'block';
				if((event.keyCode == 40 || event.which == 40) && apLista){

					var $lista = $('.lista .uniLis');

					if ($lista.length > 1){

						if (positionSelect < $lista.length - 1){

							positionSelect++;
							$lista.removeClass("cele");
							$lista.eq(positionSelect).addClass("cele");

						}else{

							positionSelect = $lista.length - 1;
						}

					}

				}

				if((event.keyCode == 38 || event.which == 38) && apLista){

					var $lista = $('.lista .uniLis');


					if ($lista.length > 1){

						if (positionSelect > 0){

							positionSelect--;


							$lista.eq(positionSelect + 1).removeClass("cele");
							$lista.eq(positionSelect).addClass("cele");

						}else{
							positionSelect = 0;

						}

					}

				}

				if(event.keyCode == 13 || event.which == 13){

					if (apLista){
					
						var id = $('.lista .cele').attr('rel');
						var nome = $('.lista .cele').html();

						nomes[id] = true;

						addContato(id, nome);

					}

					return false;

				}

			});

			$("#filtro").keyup(function(event){

				if (!(event.keyCode == 40 || event.which == 40) 
				&&  !(event.keyCode == 38 || event.which == 38)
				&&  !(event.keyCode == 13 || event.which == 13)){

					var texto = $("#filtro").val();

					texto = texto.replace(/ /g, '+');

					if (texto.length >= caractriesParaPesquisa){
					
						//alert(texto);

						//alert('ok');

						$('.lista').load('<?php echo $shOnserver, $_GET[1]?>/editar/ac=peshub/pes=' + texto, nomes);

					}else{

						$('.lista').html('').css('display', 'none');

					}

				}else{

					return false;

				}

			});

			function addEu(id){

				nomes[id] = true;

				addContato(id);

				return false;

			};

			function romoveEu(id){
				if(confirm("Deseja desvincular deste Hub")){
					nomes[id] = false;
					$('.listCmd .cmd_' + id).remove();
					$('#ac').load('<?php echo $shOnserver, $_GET[1]?>/editar/ac=delhub/cmd='+id);
					$('#filtro').focus();
				}
			}

			function addContato(id, nome){

				$('#ac').load('<?php echo $shOnserver, $_GET[1]?>/editar/ac=addhub/cmd=' + id);

				$("#filtro").val("");

				$('.lista').html('').css('display', 'none');

			}
			
		</script>

		<?php

	break;

	case 'addhub':
	
		if ($erro = jf_insert(PREFIXO . 'comunidade_hubs', array('hub' => addslashes($_GET['cmd']), 'comunidade' => addslashes($_GET[1]), 'data' => time())))
			echo $erro;
	
		$sql = '
			SELECT
				a.id, a.nome, a.imagem as img
			FROM
				' . PREFIXO . 'hub a

				JOIN
					' . PREFIXO . 'comunidade_hubs b
				ON
					b.hub = a.id

			WHERE
				b.id = "' . $jf_ultimo_id . '"
		';

		echo addUni(mysql_fetch_assoc(mysql_query($sql)));

		echo '<script>$(".listCmd").append($("#ac .cmd"));</script>';

	break;

	case 'delhub':
	
		if ($erro = jf_delete(PREFIXO . 'comunidade_hubs', array('hub' => addslashes($_GET['cmd']), 'comunidade' => addslashes($_GET[1]))))
			echo $erro;

	break;

	case 'peshub':
	
		$wherePes = '';

		if (isset($_GET['pes'])){
			$_GET['pes'] = urldecode($_GET['pes']);
			$pes = explode('+', $_GET['pes']);
			$_GET['pes'] = str_replace('+', ' ', $_GET['pes']);
			$colunas = array(
				'nome'
			);
			$alias = 'a';
			$wherePes .= '(';
			foreach($pes as $chave => $valor){
				$wherePes .= ($chave == 0? '(': ' and (');
				foreach($colunas as $chave1 => $valor1)
					$wherePes .= ($chave1 == 0? '(': ' or (') . $alias . '.' . $valor1 . ' LIKE "' . $valor . '%" or '. $alias . '.' . $valor1 . ' LIKE "% ' . $valor . '%")';
				$wherePes .= ')';
			}
			$wherePes .= ')';
		}

		$notIn = '';
		if (!empty($_POST))
			foreach($_POST as $chave => $valor)
				if ($valor == 'true')
					$notIn .= ($notIn == ''? '': ', ') . $chave;

		$notIn = ($notIn != ''? 'a.id NOT IN (' . $notIn . ')': '');

		$sql = '
			SELECT
				a.id, a.nome, a.imagem as img
			FROM
				' . PREFIXO . 'hub a
					
			WHERE
				' . $wherePes . ($notIn != '' && $wherePes != ''? ' and ': '') . $notIn . ' 
		';
		
		$hubs = mysql_query($sql);

		$html = '';
		
		$i = -1;
		
		while($hub = mysql_fetch_assoc($hubs))
			$html .= '
				<div class="uniLis lCont_' . $hub['id'] . (($html == '')? ' cele': '') . '" rel="' . $hub['id'] . '" ref="' . ((($i += 1) >= 0)? $i: '') . '" onclick="addEu(\'' . $hub['id'] . '\')">
					<img src="' . img('uploads/hub/mini_' . $hub['img']) . '" />
					<div class="nomeProf">
						<p><strong>' . $hub['nome'] . '</strong></p>
						<p>' . $hub['nome'] . '</p>
					</div>
					<div class="both"></div>
				</div>
			';
		
		//$html .= '<div><pre>' . print_r($_POST, true) . '</pre></div>';
		//$html .= '<div><pre>' . $sql . '</pre></div>';
		
		if ($html != ''){
		
			echo $html;

			?><script>
			
				positionSelect = 0;

				$('.lista').css('display', 'block');

				$('.lista .uniLis').mouseenter(function(){

					positionSelect = $(this).attr("ref");

					$('.lista .uniLis').removeClass("cele");
					$(this).addClass("cele");

				});

			</script><?php

		}else{

			?><script>$('.lista').html('').css('display', 'none');</script><?php
			
		}

	break;

}
?>