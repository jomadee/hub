<?php
lliure::inicia('aplimo');
lliure::inicia('navigi');

lliure::loadcss($_ll['app']['pasta'].'padroes.css');
//lliure::loadcss($_ll['app']['pasta'].'estilo.css');

$_ll['titulo'] = 'Hub';

require_once $_ll['app']['pasta'].'sys/funcoes.php';
require_once 'app/intext/sys/integracao.php';

intext::idioma_set('pt_br');
intext::set(37,10);


class lliurehub extends aplimo{
	function monta(){
			global $_ll;
		
		if(!isset($this->class_li)){
			echo 'Método header() não foi instanciado!';
			die();
		}
		
		$total_reg = 30;
		$tr = 10;
		?>
		<div class="container cabecalho ll_background">
			<div class="menu">
				<h1><a href="<?php echo $_ll['url']['endereco'];?>"><img src="<?php echo $_ll['app']['pasta'].'img/logo-top.png'?>" alt="lliureHub"></a></h1>
			</div>
			
			<div class="centro">
				<div class="align">
					
				</div>
			</div>
			<div class="both"></div>
		</div>
		
		
		<div class="container corpo">	
			<div class="menu">
				<div class="supre" style="background-image: url(<?php echo img('contas/bg_'.$this->user['capa']); ?>);">
					<div class="fotoP">
						<div class="afoto">
							<a href="<?php echo $_ll['app']['home'].'&apm=perfil&user='.$this->user['id'];?>"><img src="<?php echo img('contas/mini_'.$this->user['img']);?>" alt="" /></a>
						</div>
					</div>
					
					<h1><?php echo '<span>'.stripcslashes($this->user['nome'].' '.$this->user['sobrenome']).'</span>'; ?></h1>
					<span class="trabalho"><?php echo $this->user['trabalhoOnde'].', '.$this->user['trabalhoCargo']?></span>
				</div>
			
				<ul>
					<?php					
					foreach($this->menu as $key => $valor){
						
						echo '<li class="'.$this->class_li[$key].'">';
	
						if(is_array($valor['link'])){
							?>
							<li> 
								<span <?php echo 'class="'.$this->class_sub[$key].'"' ?>><?php echo $valor['titu']; ?></span> 
								<ul <?php echo 'class="'.$this->class_sub[$key].'"' ?>>								
									<?php
									foreach($valor['link'] as $lok => $defin){
										$link = $_ll['app']['home'].'&apm='.$defin['link'];
									
										if(!empty($key))
											$link = $_ll['app']['home'].'&apm='.$key.'&sapm='.$defin['link'];
															
										echo '<li class="'.$this->class_li[$key.'-'.$lok].'">'
												.'<a href="'.$link.'">'.$defin['titu'].'</a>'
											.'</li>';	
									}
									?>									
								</ul>
							</li>
							<?php
						} else {
							echo '<a href="'.$_ll['app']['home'].'&apm='.$valor['link'].'" class="link1">'.$valor['titu'].'</a>';
						}			
						echo '</li>';
					}
	
					?>
				</ul>
			</div>
	
				
			<div class="centro">		
				<?php
				$this->require_page();
				?>
				<div class="both"></div>
			</div>
			
			<div class="both"></div>
		</div>
		
		
		<script src="js/jquery.jf_inputext.js" type="text/javascript" /></script>
		<script>		
			$('.menu ul li span').click(function(){	
				var box = $(this).closest('li').find('ul');

				
				if($(box).css('display') == 'none')
					$(this).addClass('open_sub');
				else 
					$(this).removeClass('open_sub');
				
				$(box).slideToggle();
			});			
			<?php echo $this->js; ?>
		</script>
		<?php
	}
}


$aplikajo = new lliurehub();
$aplikajo->user = mysql_fetch_assoc(mysql_query('select * from '.PREFIXO.'usuario_conta where id = "'.$_ll['user']['id'].'" limit 1'));
$aplikajo->nome = 'lliure<strong>Hub</strong>';

$aplikajo->prefixo = PREFIXO.'hub_';

$aplikajo->menu('Home', 'home');
$aplikajo->menu('Social', 'social');
$aplikajo->menu('Projetos', 'projeto');
$aplikajo->menu('Fórum', 'comunidade');


$aplikajo->header();

?>