<?php 
echo '<a href="'.$_ll['app']['home'].'&apm=comunidade&sapm=comunidade&cmd='.$this->cmdd['id'].'"><img src="'.img('uploads/comunidades/g_'.$this->cmdd['img'], '190-220-o').'" class="imagem"/></a>'
	.'<h1><a href="'.$_ll['app']['home'].'&apm=comunidade&sapm=comunidade&cmd='.$this->cmdd['id'].'">'.$this->cmdd['nome'].'</a></h1>'; 
?>

<ul>			
	<?php 
	echo '<li ><a  '.(!$this->cmdd['membro']? 'class="inativo"' : 'href="'.$_ll['app']['home'] .'&apm=comunidade&sapm=topico&cmd='. $this->cmdd['id'].'"' ).'>'._t('cmd-criar-topico', 0).'</a></li>'
		.(!$this->cmdd['membro']
			? '<li><a href="' . $_ll['app']['onserver'] .'&apm=comunidade&cmd='. $this->cmdd['id'] . '&ac=part">Participar</a></li>'
			: (!$this->cmdd['adm'] 
					? '<li><a href="' . $_ll['app']['onserver'] .'&apm=comunidade&cmd='. $this->cmdd['id'] . '&ac=deixar">'._t('cmd-deixar-cmd', 0).'</a></li>' 
					: '<li><a href="' . $_ll['app']['home'] .'&apm=comunidade&sapm=configuracao&cmd='. $this->cmdd['id'] . '">'._t('cmd-alt-cmd', 0).'</a></li>')
		 )
	?>
</ul>

<ul>			
	<li><a href="<?php echo $_ll['app']['home'].'&apm=comunidade&sapm=comunidade&cmd='.$this->cmdd['id'];?>">Comunidade</a></li>
	<li><a href="<?php echo $_ll['app']['home'].'&apm=comunidade&sapm=forum&cmd='.$this->cmdd['id'];?>">Fórum</a></li>
</ul>