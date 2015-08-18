<img src="<?php echo img('uploads/comunidades/g_'.$this->cmdd['img'], '190-220-o'); ?>" class="imagem"/>
<h1><?php echo $this->cmdd['nome']; ?></h1>

<ul>			
	<?php 
	echo '<li ><a  '.(!$this->cmdd['membro']? 'class="inativo"' : 'href=""' ).'>Criar tópico</a></li>'
		.(!$this->cmdd['membro']
			? '<li><a href="' . $this->onserver . $this->cmdd['id'] . '/home/ac=part">Participar</a></li>'
			: '<li><a href="' . $this->onserver . $this->cmdd['id'] . '/home/ac=part">Deixar comunidade</a></li>')
	?>
</ul>

<ul>			
	<li><a href="<?php echo $_ll['app']['home'].'&apm=comunidade&sapm=comunidade&cmd='.$this->cmdd['id'];?>">Comunidade</a></li>
	<li><a href="<?php echo $_ll['app']['home'].'&apm=comunidade&sapm=forum&cmd='.$this->cmdd['id'];?>">Fórum</a></li>
	<li><a href="">Membros</a></li>
</ul>