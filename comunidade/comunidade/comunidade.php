<?php
$sql = '
	SELECT
		a.status
	FROM
		' . PREFIXO . 'usuario_comunidade a
	
	WHERE
		a.usuario = "' . $_ll['user']['id'] . '" and a.comunidade = "' . $this->cmdd['id'] . '"
';

$sql = mysql_fetch_assoc(mysql_query($sql));


?>
<div id="cmd_home"  class="hb_internPage">
	<div class="hb_menu">
		<img src="<?php echo img('uploads/comunidades/g_'.$this->cmdd['img']); ?>" class="imagem"/>
		<h1 class="shcolor<?php echo ((!($sql['status'] == 'U' or $sql['status'] == 'A'))? ' nmemb' :'')?>"><?php echo $this->cmdd['nome']; ?></h1>
		<ul>
			<?php 
			echo ((!($sql['status'] == 'U' or $sql['status'] == 'A'))
					? '<li><a href="' . $this->onserver . $this->cmdd['id'] . '/home/ac=part">Participar</a></li>'
					: '')
			?>
			
			<li><a href="">Criar tópico</a></li>
			<li><a href="">Ver tópicos</a></li>
		</ul>
	</div>
	
	<div class="hb_centro">
		<div class="hb_box cmd-cmd_top">
			<?php 
			echo '<span class="titulo">'.$this->cmdd['nome'].'</span>'
				.'<div class="descricao">'.$this->cmdd['descricao'].'</div>'; 
			?>
		</div>
		
		
		
		<div class="hb_box cmd-cmd_forum">
			<h2><?php _t('cmd-forum'); ?></h2>
			<table>
				<thead>
					<tr>
						<th style="width: 591px;"></th>
						<th style="width: 127px;"></th>
						<th style="width: 50px;"></th>
					</tr>
				</thead>
				
				<?php			
				$query = 'select a.*, (select count(id) from '.PREFIXO.'comunidade_mensagens where topico = a.id)-1 as total
							from '.PREFIXO.'comunidade_topicos a
							where a.comunidade = "'.$this->cmdd['id'].'" 
							';
							
				if(isset($_GET['pes'])){
			
					$_GET['pes'] = urldecode($_GET['pes']);
				
					$pesq = explode(' ', $_GET['pes']);
					
					$query .= ' and (';			
							
					foreach($pesq as $chave => $valor){
						$query .= ($chave != 0?' and':'').' (';
						
						$query .= 'a.nome like "%'.$valor.'%"';
						
						$query .= ')';
					}
					$query .= ') ';	
				}
				
				$total_reg = 5; // número de registros por página
	
				if (isset($_GET['pagina']) && !empty($_GET['pagina'])) {
					$pc = $_GET['pagina'];
				} else {
					$pc = 1;
				}
				
				$inicio = $pc - 1;
				$inicio = $inicio * $total_reg;
				
				$todos = mysql_query($query);
				$tr = mysql_num_rows($todos); // verifica o número total de registros
				
				$tp = ceil($tr / $total_reg); // verifica o número total de páginas
				
				$query = mysql_query($query.'order by a.id desc limit '.$inicio.",".$total_reg);
				
				while($dados = mysql_fetch_assoc($query)){
					$url = jf_monta_link($_GET, 'pagina', JF_URL_AMIGAVEL) . '/forum/' . $dados['id'];
					?>
					<tr>
						<td>
							<?php
							if ($this->cmdd['membro'] == true){?>
								<a href="<?php echo $url ?>"><?php echo $dados['nome']; ?></a>
								<?php
							}else{
								echo $dados['nome'];
							}?>
						</td>
						<td class="center"><?php echo $dados['total']; ?></td>
						<?php
						if ($this->cmdd['membro'] == true){
							?>
							<td class="center"><a href="<?php echo $url , '/pag=ultima';?>" title="<?php _t('ac-ult-pag'); ?>" class="img16 lasta"></a></td>
							<?php
						}?>
						
					</tr>
					<?php
				}
				?>
			</table>
	
		</div>
	</div>
	
	<div class="hb_lateral">
		teste
	</div>
</div>
