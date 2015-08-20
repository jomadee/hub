<div class="hb_perfil">
	<div class="hb_pf_cabecalho" style="background-image: url(<?php echo img('contas/bg_'.$this->usuario['capa']); ?>);">
		<div class="fotoP">
			<div class="afoto">
				<img src="<?php echo img('contas/perfil_'.$this->usuario['img'], '100-100-c');?>" alt="" />
			</div>
		</div>
		
		<h1><?php echo '<span>'.stripcslashes($this->usuario['nome'].' '.$this->usuario['sobrenome']).'</span>'; ?></h1>
		<span class="trabalho"><?php echo $this->usuario['trabalhoOnde'].', '.$this->usuario['trabalhoCargo']?></span>
	</div>
	
	<div class="inferior hb_internPage">
		<div class="hb_menu cmd-cmd_menu">
			<div class="contatos hb_box">	
				<span class="titulo"><?php _t('idx-contatos');?></span>
				<div class="cont">
					<?php
					while($contato = mysql_fetch_assoc($this->contatos)){
						?>			
						<a href="<?php echo $_ll['app']['home'].'&apm=perfil&user='.$contato['id'];?>" <?php echo 'title="'.stripcslashes($contato['nome'].' '.$contato['sobrenome']).'"'; ?>><img src="<?php echo img('uploads/contas/micro_' . $contato['img']); ?>" /></a>
						<?php
					}?>
				</div>
				<div class="both"></div>
			</div>
			
			<div class="comunidades hb_box">		
				<span class="titulo"><?php _t('idx-comunidades');?></span>
				<div class="cont">
					<?php
					while($comunidade = mysql_fetch_assoc($this->comunidades)){
						?>			
						<a href="<?php echo $_ll['app']['home'].'&apm=comunidade&sapm=comunidade&cmd='.$comunidade['id'];?>"  <?php echo 'title="'.stripcslashes($comunidade['nome']).'"'; ?>><img src="<?php echo img('uploads/comunidades/mini_' . $comunidade['img']); ?>" style="width: 48px"/></a>
						<?php
					}?>				
				</div>
				<div class="both"></div>
			</div>
		</div>
		
		
		<div class="hb_centro parcial">	
			oi
		</div>
	</div>
</div>