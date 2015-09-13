<!DOCTYPE html>
<html language="pt-BR">

<head>
	<meta charset="UTF-8">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_directory');?>/img/favicon.png">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title>Seara da Ciência <?php wp_title('-'); ?></title>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); wp_head(); ?>
	<script type="text/javascript" src="<?php bloginfo('template_directory');?>/lib/jquery-2.1.4.min.js"></script>
</head>
<body>
<!-- Cod. Rodapé fixo -->
<!--[if  IE 8]>
	<style type="text/css">
		#tudo {display:table;}
	</style>
<![endif]-->

		<!-- Transição entre as páginas HTML -->
		<script type="text/javascript">
			 $(document).ready(function(){
				//faz o conteúdo da página aparecer
				$('body').fadeIn(300);

				// previne a função default do click

				$('a').click(function(e) {
					if($(this).hasClass('link-normal')){

					}else{
						e.preventDefault();
						newLocation = this.href;
						$('body').fadeOut(700, novaPagina);
					}
				});

				// referencia a nova página
				function novaPagina() {
					window.location = newLocation;
				}
			 });
		</script>

		<?php
    	// Se a página for a single (de posts) carregue o script do facebook
    		if(is_single()){
    	?>
		<!-- JavaScript SDK do Facebook -->
			<div id="fb-root"></div>
			<script>
			(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.3";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
			</script>
		<!-- FIM Facebook -->
		<?php
    		}
    	?>

		<?php
    	// Se a página for a HOME retira o padding-top e adiciona o scroll para essa página
    		if(is_home()){
    	?>
    	<style type="text/css">
			html{
				margin-top: -50px;
			}
    	</style>
    	<!-- Scroll jQuery para a página Home -->
    	<script language="javascript">
			$(document).ready(function(){
				$(window).scroll(function(){
					if($(this).scrollTop()>50){
						$('.menu-acessivel').finish();
						$('#topo').addClass("bg-cinza");
						$('#logo').addClass("logo-transition");
						//esconde o menu acessivel e diminui a altura pagina
						$('.menu-acessivel').slideUp();
						$('#topo').css('height', '50px');
					}else{
						$('.menu-acessivel').finish();
						$('#topo').removeClass("bg-cinza");
						$('#logo').removeClass("logo-transition");
						//mostra o menu acessivel e aumenta a altura pagina
						$('.menu-acessivel').slideDown();
						$('#topo').css('height', '85px');
					}

					if($(this).scrollTop()>550){
						$('#menu-categorias').addClass("menu-categoria-fixa menu-categorias-transition");
						$('.lv1').addClass("top-tooltip");
						$('html').css('margin-top','60px');
		   			moveTooltip();
					}else{
						$('#menu-categorias').removeClass("menu-categoria-fixa menu-categorias-transition");
						$('.lv1').removeClass("top-tooltip");
						$('html').css('margin-top','-50px');
					}
				});
			});
		</script>
    	<?php
    		}else{
    	?>
    	<!-- Scroll jQuery para as páginas -->
    	<script language="javascript">
			$(document).ready(function(){
				$(window).scroll(function(){
					if($(this).scrollTop()>50){
						$('.menu-acessivel').finish();
						$('#logo').addClass("logo-transition");
						$('#menu-categorias').addClass("menu-categoria-fixa menu-categorias-transition");
						$('.lv1').addClass("top-tooltip");
						$('html').css('margin-top','160px');
						//esconde o menu acessivel e diminui a altura pagina
						$('.menu-acessivel').slideUp();
						$('#topo').css('height', '50px');
		    			moveTooltip();
					}else{
						$('.menu-acessivel').finish();
						$('#logo').removeClass("logo-transition");
						$('#menu-categorias').removeClass("menu-categoria-fixa menu-categorias-transition");
						$('.lv1').removeClass("top-tooltip");
						$('html').css('margin-top','85px');
						//mostra o menu acessivel e aumenta a altura pagina
						$('.menu-acessivel').slideDown();
						$('#topo').css('height', '85px');
					}
				});
			});
		</script>
    	<?php
    		}
    	//fim
		?>
<div id="tudo">
    <div id="header">
    	<div id="topo" <?php if(is_home()):?>class="bg-transparent"<?php else: ?>class="bg-cinza"<?php endif;?>>
	    	<div class="topo-largura">
		        <div id="logo" class="logo-main">
		        	<!-- template_directory é usado para acessar o diretório do tamplate sem problemas-->
		        	<a href="<?php bloginfo('url');?>">
						<img class="logo-seara" src="<?php bloginfo('template_directory');?>/img/logo.png" alt="Logo catavento da Seara da Ciência">
			        	<h1  class="font-title">Seara da Ciência</h1>
			        </a>
		        </div><!– #logo –>
		        <nav class="menu-acessivel">
	    			<a href="#menu-categorias" class="link-normal" title="Atalho para categorias">Ir para categorias</a>
	    			<a href="#conteudo" class="link-normal" title="Atalho para o conteúdo">Ir para conteúdo</a>
	    			<a href="#rodape" class="link-normal" title="Atalho para o rodapé">Ir para rodapé</a>
	    		</nav>
		        <div id="menu">
			        <div class="busca">
			        	<?php get_search_form(); ?>
			        </div>
		        	<!-- Menu principal -->
		        	<nav>
			    	    <?php
						wp_nav_menu (
						  array(
							'theme_location'  => 'menu-topo',
							'menu'            => 'menu-dinamico',
							'container'       => '',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => '',
							'menu_id'         => '',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							/*
							items_wrap: a tag que envolverá a lista, com a classe de css que você defirnir.
							%3$s: É o código padrão do wordpress que chama os links do menu.
							*/
							'items_wrap'      => '<ul class="menu-principal">%3$s</ul>',
							'depth'           => 0,
							'walker'          => ''
							)
						  );
						?>		
		        	</nav>
		        </div>
		    </div>
    	</div>
    	<?php
    	// Se a página for a HOME coloca o plugin Master Slider
    		if(is_home()){
    	?>
    	<div id="slide">
			<!-- Chamada do Master Slider -->
			<?php //masterslider ( 1 ); ?>
			<?php echo do_shortcode('[smartslider2 slider="3"]'); ?>
    	</div>
    	<?php
    		}
    	//fim se
    	?>

    	<!-- Tooltip -->
		<p class="tooltip"></p>
    	<script language="javascript">
	    	$(document).ready(function(){
		    		moveTooltip();
		    });
			//Tooltip
			function moveTooltip(){
				var $tooltip = $('.tooltip');
				$('[data-tooltip]').mouseenter(function(e){
					if($('.lv1').hasClass('top-tooltip')){
						var pos = $(this).offset();
						var txt = $(this).attr('data-tooltip');
						$tooltip.finish();
						$tooltip.text(txt);
						var larg = $tooltip.width();
						$tooltip.addClass('top');
						$tooltip.css({top: ((pos.top)-40)+"px", left: pos.left+"px"}).slideDown(500);
					}else{
						$tooltip.hide();
					}
					}).mouseleave(function(){
						$('.tooltip').finish();
						$('.tooltip').slideUp(200);
					});
			}
		</script>

    	<div id="menu-categorias" class="menu-categorias-main" name='menu-categorias'>
    	<div class="conteiner-categorias">
    		<h1 class="info-categorias">
    			<span>Conheça nossas categorias:</span>
    		</h1>
    		<nav id="itens-categorias">
    		<ul>
    			<li class="item-categoria Matemática">
    				<!-- A função esc_url() limpa as URLs e verifica se
    				estão corretamente formatadas e sem perigo.
    				A função get_category_link retorna a categoria com id 7
    				-->
    				<a class="lv1" href="<?php echo esc_url(get_category_link(7)); ?>" data-tooltip='Matemática'>
					<div class="ico-menu-categoria">
					<!-- Icone de matematica -->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
							version="1.1" x="0px" y="0px" class='icon-main' width='48px' viewBox="0 0 100 100" enable-background="new 0 0 100 100"
							xml:space="preserve">
							<path d="M5.004,79.905C5.004,88.241,11.761,95,20.099,95h27.507V52.396H5.004V79.905z M16.533,64.442l3.589-3.589l7.505,7.553  l7.555-7.553l3.586,3.589l-7.599,7.553l7.599,7.553l-3.586,3.588l-7.555-7.602l-7.601,7.602l-3.588-3.588l7.601-7.553L16.533,64.442  z"/>
							<path d="M95.003,20.096C95.003,11.761,88.242,5,79.908,5H52.396v42.603h42.606V20.096z M81.803,30.335h-16.08v-5.965h16.08V30.335z"/>
							<path d="M5,20.095v27.511h42.606V5H20.1C11.761,5,5,11.761,5,20.095z M25.237,15.873h4.732v8.8h8.8v4.73h-8.8v8.8h-4.732v-8.8  h-8.798v-4.73h8.798V15.873z"/>
							<path d="M52.398,52.396V95h27.506c8.339,0,15.1-6.759,15.1-15.095V52.396H52.398z M71.154,59.572  c0.751-0.723,1.627-1.085,2.63-1.085c0.502,0,0.975,0.098,1.415,0.289c0.442,0.193,0.833,0.456,1.171,0.796  c0.339,0.339,0.612,0.737,0.818,1.195c0.207,0.456,0.311,0.949,0.311,1.479c0,0.471-0.104,0.929-0.311,1.372  c-0.207,0.444-0.473,0.84-0.795,1.193c-0.325,0.355-0.707,0.635-1.151,0.84c-0.441,0.207-0.914,0.311-1.414,0.311  c-0.531,0-1.024-0.097-1.48-0.287c-0.459-0.193-0.855-0.458-1.193-0.797c-0.338-0.339-0.612-0.736-0.818-1.192  c-0.207-0.458-0.311-0.936-0.311-1.439C70.025,61.186,70.401,60.294,71.154,59.572z M77.189,81.924  c-0.207,0.442-0.473,0.84-0.795,1.195c-0.325,0.353-0.707,0.639-1.151,0.86c-0.441,0.222-0.914,0.332-1.414,0.332  c-0.531,0-1.024-0.103-1.48-0.309c-0.459-0.205-0.855-0.479-1.193-0.818c-0.338-0.34-0.612-0.736-0.818-1.194  s-0.311-0.921-0.311-1.394c0-0.531,0.104-1.016,0.311-1.458c0.207-0.444,0.48-0.833,0.818-1.171  c0.338-0.338,0.734-0.604,1.193-0.797c0.456-0.19,0.936-0.286,1.437-0.286c0.502,0,0.975,0.096,1.415,0.286  c0.442,0.193,0.833,0.459,1.171,0.797c0.339,0.339,0.612,0.728,0.818,1.171c0.207,0.443,0.311,0.928,0.311,1.458  C77.5,81.04,77.396,81.483,77.189,81.924z M84.928,73.787h-22.33v-4.729h22.33V73.787z"/>
						</svg>
		    		</div>
		    			<h2 class="nome-menu-categoria">
		    				Matemática
		    			</h2>
		    			<div class='cor-menu-categoria Matemática'></div>
    				</a>
    				<nav class="sub-menu-categoria Matemática">
		    			<ul>
		    				<li class="sub menu-sec">
		    					<a href="<?php echo esc_url(get_category_link(15)); ?>">Seções Especiais</a>
		    				</li>
		    				<li class="sub menu-tin">
		    					<a href="<?php echo esc_url(get_category_link(23)); ?>">Tintim por Tintim</a>
		    				</li>
		    			</ul>
	    			</nav>
    			</li>
    			<li class="item-categoria Química">
    				<a href="<?php echo esc_url(get_category_link(4)); ?>" data-tooltip='Química'>
					<div class="ico-menu-categoria">
					<!-- Icone de Química -->
						<svg version="1.1" class='icon-main' id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 width='48px' viewBox="0 0 207.806 207.806" style="enable-background:new 0 0 207.806 207.806;" xml:space="preserve">
						<path d="M186.653,176.188l-57.18-92.36V13.674h5.035c3.579,0,6.481-2.902,6.481-6.481V6.481c0-3.58-2.902-6.481-6.481-6.481h-61.21
							c-3.579,0-6.481,2.902-6.481,6.481v0.712c0,3.579,2.902,6.481,6.481,6.481h5.035v70.154l-57.18,92.36
							c-3.911,6.316-4.095,13.95-0.491,20.418c3.848,6.908,11.355,11.199,19.592,11.199h127.299c8.236,0,15.744-4.291,19.592-11.199
							C190.748,190.138,190.564,182.505,186.653,176.188z M88.333,86.673V18.674h31.141v67.999l20.328,32.835H68.004L88.333,86.673z"/>
						</svg>
		    			</div>
		    			<h2 class="nome-menu-categoria">
		    				Química
		    			</h2>
		    			<div class='cor-menu-categoria Química'></div>
    				</a>
    				<nav class="sub-menu-categoria Química">
		    			<ul>
		    				<li class="sub menu-sec">
		    					<a href="<?php echo esc_url(get_category_link(25)); ?>">Seções Especiais</a>
		    				</li>
		    				<li class="sub menu-exp">
		    					<a href="<?php echo esc_url(get_category_link(24)); ?>">Experimentos</a>
		    				</li>
		    			</ul>
	    			</nav>
    			</li>
    			<li class="item-categoria Física">
    				<a href="<?php echo esc_url(get_category_link(8)); ?>" data-tooltip='Física'>
					<div class="ico-menu-categoria">
					<!-- Icone de Física -->
						<svg version="1.1" class='icon-main' id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 width='48px' viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve">
							<circle cx="306" cy="306.211" r="62.185"/>
							<path d="M534.101,337.23c-7.888-10.304-16.733-20.673-26.417-31.019c9.685-10.345,18.529-20.714,26.417-31.019
								c18.542-24.221,31.031-47.054,37.122-67.866c4.9-16.74,7.995-41.128-5.084-62.243c-17.681-28.546-53.763-34.538-80.918-34.538
								c-22.832,0-48.908,4.001-76.949,11.542c-2.767-9.134-5.748-17.92-8.945-26.293c-10.877-28.487-23.747-51.157-38.253-67.276
								C344.346,9.932,325.123,0,305.483,0h-0.126c-24.837,0-43.908,15.665-55.532,28.67c-14.452,16.167-27.239,38.936-38.007,67.475
								c-3.102,8.221-5.992,16.838-8.677,25.787c-27.819-7.438-53.689-11.383-76.362-11.383c-27.156,0-63.238,5.995-80.918,34.541
								c-13.078,21.115-9.984,45.51-5.084,62.25c6.091,20.812,18.581,43.66,37.122,67.88c7.884,10.298,16.723,20.664,26.402,31.005
								c-9.679,10.339-18.518,20.703-26.402,31.001c-18.541,24.221-31.031,47.054-37.122,67.866c-4.899,16.74-7.995,41.128,5.084,62.243
								c17.681,28.546,53.763,34.538,80.918,34.538c22.841,0,48.926-4.005,76.98-11.55c2.759,9.096,5.729,17.847,8.915,26.191
								c10.876,28.486,23.747,51.05,38.252,67.169C267.652,602.272,286.874,612,306.513,612h0.13c24.838,0,43.908-15.468,55.533-28.472
								c14.452-16.167,27.239-38.739,38.006-67.278c3.087-8.184,5.965-16.76,8.641-25.667c27.831,7.453,53.715,11.409,76.398,11.409
								c0.003,0,0.003,0,0.006,0c27.154,0,63.233-6.052,80.912-34.596c13.078-21.115,9.984-45.56,5.084-62.301
								C565.133,384.283,552.643,361.451,534.101,337.23z M485.221,145.319c14.999,0,41.615,2.348,51.357,18.075
								c11.01,17.776-0.237,51.668-30.087,90.661c-7.007,9.153-14.857,18.377-23.438,27.598c-16.209-15.153-34.084-30.093-53.288-44.532
								c-2.646-28.615-6.9-55.991-12.643-81.374C442.553,148.889,465.693,145.319,485.221,145.319z M384.282,446.482
								c-0.293-0.104-0.585-0.204-0.879-0.308c-12.664-4.488-25.604-9.645-38.679-15.399c9.391-5.288,18.78-10.831,28.133-16.624
								c6.506-4.029,12.915-8.132,19.223-12.297C389.993,417.319,387.384,432.241,384.282,446.482z M354.546,384.59
								c-16.005,9.913-32.282,19.152-48.565,27.593c-16.271-8.447-32.535-17.688-48.528-27.593c-14.5-8.981-28.486-18.32-41.854-27.909
								c-1.148-16.409-1.759-33.215-1.794-50.276c-0.036-17.14,0.509-34.03,1.598-50.523c13.427-9.638,27.479-19.024,42.051-28.05
								c15.995-9.907,32.262-19.141,48.535-27.578c16.281,8.442,32.555,17.68,48.559,27.592c14.503,8.983,28.49,18.323,41.86,27.914
								c1.144,16.389,1.753,33.171,1.789,50.204c0.036,17.162-0.51,34.069-1.602,50.577C383.167,366.18,369.117,375.565,354.546,384.59z
								 M228.186,446.26c-3.112-14.074-5.745-28.815-7.871-44.085c6.181,4.075,12.459,8.09,18.828,12.035
								c9.318,5.772,18.672,11.295,28.028,16.567c-13.04,5.727-25.946,10.865-38.575,15.34
								C228.459,446.164,228.323,446.211,228.186,446.26z M179.397,328.843c-9.042-7.469-17.666-15.028-25.836-22.632
								c8.144-7.582,16.742-15.117,25.754-22.564c-0.202,7.552-0.3,15.157-0.283,22.805C179.048,313.96,179.171,321.427,179.397,328.843z
								 M227.686,165.994c0.304,0.107,0.606,0.211,0.91,0.319c12.646,4.481,25.569,9.626,38.626,15.364
								c-9.373,5.279-18.744,10.812-28.079,16.594c-6.509,4.032-12.922,8.137-19.234,12.304
								C221.99,195.128,224.592,180.221,227.686,165.994z M383.838,166.154c3.114,14.1,5.746,28.868,7.871,44.168
								c-6.188-4.08-12.474-8.1-18.851-12.05c-9.339-5.784-18.713-11.319-28.09-16.6c13.061-5.738,25.987-10.884,38.637-15.367
								C383.548,166.254,383.692,166.205,383.838,166.154z M432.605,283.601c9.036,7.466,17.656,15.021,25.82,22.621
								c-8.141,7.578-16.735,15.11-25.743,22.554c0.204-7.57,0.301-15.193,0.285-22.859C432.952,298.435,432.83,290.993,432.605,283.601z
								 M244.352,108.433c17.335-45.946,40.167-73.402,61.13-73.446c20.905,0,43.843,27.363,61.359,73.239
								c2.93,7.676,5.665,15.739,8.208,24.129c-22.348,7.764-45.552,17.479-69.052,28.944c-23.702-11.564-47.101-21.344-69.626-29.14
								C238.844,123.915,241.502,115.986,244.352,108.433z M75.422,163.394c9.741-15.727,36.358-18.075,51.357-18.075
								c19.402,0,42.367,3.526,67.605,10.3c-5.685,25.476-9.86,52.962-12.408,81.697c-19.106,14.379-36.893,29.252-53.028,44.337
								c-8.581-9.221-16.43-18.445-23.437-27.598C75.659,215.063,64.412,181.171,75.422,163.394z M126.778,467.103
								c-14.999,0-41.615-2.348-51.356-18.075c-11.01-17.776,0.237-51.669,30.087-90.662c7.001-9.146,14.845-18.363,23.418-27.577
								c16.217,15.167,34.103,30.121,53.32,44.574c2.65,28.594,6.906,55.945,12.652,81.306
								C169.459,463.531,146.313,467.103,126.778,467.103z M367.647,503.885c-17.335,45.946-40.167,73.342-61.077,73.342h-0.049
								c-20.908,0-43.847-27.292-61.363-73.167c-2.917-7.639-5.639-15.662-8.172-24.006c22.315-7.754,45.482-17.453,68.945-28.897
								c23.707,11.576,47.113,21.369,69.645,29.179C373.118,488.516,370.477,496.385,367.647,503.885z M536.578,449.086
								c-9.741,15.727-36.353,18.133-51.351,18.133c-0.001,0-0.003,0-0.004,0c-19.409,0-42.382-3.553-67.629-10.346
								c5.693-25.495,9.874-53.004,12.426-81.763c19.102-14.376,36.886-29.246,53.02-44.328c8.586,9.227,16.441,18.456,23.451,27.614
								C536.341,397.388,547.588,431.309,536.578,449.086z"/>
						</svg>
		    			</div>
		    			<h2 class="nome-menu-categoria">
		    				Física
		    			</h2>
		    			<div class='cor-menu-categoria Física'></div>
    				</a>
    				<nav class="sub-menu-categoria Física">
		    			<ul>
		    				<li class="sub menu-sec">
		    					<a href="<?php echo esc_url(get_category_link(16));?>">Seções Especiais</a>
		    				</li>
		    				<li class="sub menu-tin">
		    					<a href="<?php echo esc_url(get_category_link(18));?>">Tintim por Tintim</a>
		    				</li>
		    				<li class="sub menu-exp">
		    					<a href="<?php echo esc_url(get_category_link(17));?>">Experimentos</a>
		    				</li>
		    				<li class="sub menu-cur">
		    					<a href="<?php echo esc_url(get_category_link(35));?>">Curiosidades</a>
		    				</li>
		    			</ul>
	    			</nav>
    			</li>
    			<li class="item-categoria Biologia">
    				<a href="<?php echo esc_url(get_category_link(9)); ?>" data-tooltip='Biologia'>
					<div class="ico-menu-categoria">
					<!-- Icone de Biologia -->
						<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 class='icon-main' width='48px' viewBox="0 0 489.234 489.234" style="enable-background:new 0 0 489.234 489.234;" xml:space="preserve">
						<path d="M465.402,344.43c-15.352-15.379-35.758-23.832-57.418-23.832c-0.047,0-0.098,0-0.129,0H255.027l65.547-65.547v29.668h49.434
							v-84.113c0-44.883-36.496-81.395-81.395-81.395h-84.098v49.434h22.496l-58.363,58.375V81.395c0-44.873-36.516-81.387-81.394-81.387
							c-13.664,0-24.719,11.064-24.719,24.719S73.59,49.443,87.254,49.443c17.621,0,31.957,14.33,31.957,31.951v37.809H81.379
							c-17.605,0-31.941-14.33-31.941-31.951c0-13.654-11.059-24.717-24.719-24.717C11.055,62.535,0,73.598,0,87.252
							c0,44.873,36.516,81.385,81.379,81.385h37.832v120c0,44.883,36.516,81.395,81.394,81.395h119.969v37.777
							c-0.02,21.715,8.43,42.168,23.848,57.609c15.383,15.352,35.805,23.809,57.512,23.809c0.031,0,0.031,0,0.066,0
							c13.645-0.008,24.699-11.082,24.684-24.734c0-13.648-11.07-24.703-24.719-24.703c0,0-0.016,0-0.031,0
							c-8.527,0-16.543-3.32-22.559-9.324c-6.051-6.059-9.367-14.09-9.367-22.633v-37.801h37.879c0.02,0,0.035,0,0.051,0
							c8.496,0,16.492,3.324,22.512,9.348c6.035,6.027,9.352,14.051,9.352,22.594c0,13.656,11.055,24.719,24.715,24.719
							c13.664,0,24.719-11.063,24.719-24.719C489.234,380.227,480.785,359.789,465.402,344.43z M168.648,288.637v-26.664l93.316-93.328
							h26.648c3.281,0,6.371,0.637,9.352,1.563L170.207,297.969C169.273,295,168.648,291.902,168.648,288.637z M200.605,320.598
							c-5.23,0-10.09-1.387-14.465-3.621l130.852-130.742c2.743,4.174,3.582,9.173,3.582,14.371v19.496L220.078,320.598H200.605z"/>
						</svg>
		    			</div>
		    			<h2 class="nome-menu-categoria">
		    				Biologia
		    			</h2>
		    			<div class='cor-menu-categoria Biologia'></div>
    				</a>
    				<nav class="sub-menu-categoria Biologia">
		    			<ul>
		    				<li class="sub menu-sec">
		    					<a href="<?php echo esc_url(get_category_link(22));?>">Seções Especiais</a>
		    				</li>
		    				<li class="sub menu-tin">
		    					<a href="<?php echo esc_url(get_category_link(19));?>">Tintim por Tintim</a>
		    				</li>
		    				<li class="sub menu-exp">
		    					<a href="<?php echo esc_url(get_category_link(21));?>">Experimentos</a>
		    				</li>
		    			</ul>
	    			</nav>
    			</li>
    			<li class="item-categoria Astronomia">
    				<a href="<?php echo esc_url(get_category_link(2)); ?>" data-tooltip='Astronomia'>
					<div class="ico-menu-categoria">
					<!-- Icone de Astronomia -->
		    			<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 class='icon-main' width='48px' viewBox="0 0 29.682 29.682" style="enable-background:new 0 0 29.682 29.682;" xml:space="preserve">
								<polygon points="26.514,0.393 22.714,1.699 22.994,2.511 11.575,6.437 12.055,7.835 1.915,11.32 
									2.434,12.83 0,13.666 0.611,15.442 3.044,14.605 3.563,16.115 13.704,12.626 14.184,14.024 25.603,10.099 25.881,10.911 
									29.682,9.605 		"/>
								<path d="M18.053,17.617v-2.255h-1.795c-0.214-0.296-0.556-0.521-0.957-0.645v-0.034l-0.021,0.028
									c-0.195-0.061-0.4-0.102-0.622-0.102c-0.688,0-1.279,0.305-1.602,0.751h-1.795v2.255h1.805L4.175,29.289h1.821l8.017-10.527
									v10.493H15.3V18.762l8.017,10.527h2.278l-9.296-11.673L18.053,17.617L18.053,17.617z"/>
						</svg>
		    			</div>
		    			<h2 class="nome-menu-categoria">
		    				Astronomia
		    			</h2>
		    			<div class='cor-menu-categoria Astronomia'></div>
    				</a>
    				<nav class="sub-menu-categoria Astronomia">
		    			<ul>
		    				<li class="sub menu-exp">
		    					<a href="<?php echo esc_url(get_category_link(28));?>">Experimentos</a>
		    				</li>
		    			</ul>
	    			</nav>
    			</li>
    			<li class="item-categoria Tecnologia">
    				<a href="<?php echo esc_url(get_category_link(3)); ?>" data-tooltip='Tecnologia'>
					<div class="ico-menu-categoria">
		    			<svg xmlns="http://www.w3.org/2000/svg" class='icon-main' width='48px' viewBox="0 0 48 48">
						    <path d="M0 0h48v48h-48z" fill="none"/>
						    <path d="M42 6h-36c-2.21 0-4 1.79-4 4v24c0 2.21 1.79 4 4 4h10v4h16v-4h10c2.21 0 3.98-1.79 3.98-4l.02-24c0-2.21-1.79-4-4-4zm0 28h-36v-24h36v24zm-4-18h-22v4h22v-4zm0 8h-22v4h22v-4zm-24-8h-4v4h4v-4zm0 8h-4v4h4v-4z"/>
						</svg>
		    			</div>
		    			<h2 class="nome-menu-categoria">
		    				Tecnologia
		    			</h2>
		    			<div class='cor-menu-categoria Tecnologia'></div>
    				</a>
    				<nav class="sub-menu-categoria Tecnologia">
		    			<ul>
		    				<li class="sub menu-tin">
		    					<a href="<?php echo esc_url(get_category_link(27));?>">Tintim por Tintim</a>
		    				</li>
		    			</ul>
	    			</nav>
    			</li>
    			<li class="item-categoria Geologia">
    				<a href="<?php echo esc_url(get_category_link(1)); ?>" data-tooltip='Geologia'>
					<div class="ico-menu-categoria">
		    			<svg xmlns="http://www.w3.org/2000/svg" class='icon-main' width='48px'  viewBox="0 0 48 48">
						    <path d="M0 0h48v48h-48z" fill="none"/>
						    <path d="M28 12l-7.5 10 5.7 7.6-3.2 2.4c-3.38-4.5-9-12-9-12l-12 16h44l-18-24z"/>
						</svg>
		    			</div>
		    			<h2 class="nome-menu-categoria">
		    				Geologia
		    			</h2>
		    			<div class='cor-menu-categoria Geologia'></div>
    				</a>
    				<nav class="sub-menu-categoria Geologia">
		    			<ul>
		    				<li class="sub menu-sec">
		    					<a href="<?php echo esc_url(get_category_link(26));?>">Seções Especiais</a>
		    				</li>
		    			</ul>
	    			</nav>
    			</li>
    			<li class="item-categoria Artigos">
    				<a href="<?php echo esc_url(get_category_link(10)); ?>" data-tooltip='Artigos'>
					<div class="ico-menu-categoria">
		    			<svg xmlns="http://www.w3.org/2000/svg" class='icon-main' width='48px' viewBox="0 0 48 48">
						    <path d="M6 34.5v7.5h7.5l22.13-22.13-7.5-7.5-22.13 22.13zm35.41-20.41c.78-.78.78-2.05 0-2.83l-4.67-4.67c-.78-.78-2.05-.78-2.83 0l-3.66 3.66 7.5 7.5 3.66-3.66z"/>
						    <path d="M0 0h48v48h-48z" fill="none"/>
						</svg>
		    			</div>
		    			<h2 class="nome-menu-categoria">
		    				Artigos
		    			</h2>
		    			<div class='cor-menu-categoria Artigos'></div>
    				</a>
    				<nav class="sub-menu-categoria Artigos">
		    			<ul>
		    				<li class="sub menu-fifi">
		    					<a href="<?php echo esc_url(get_category_link(36));?>">Apostilas da Fifi</a>
		    				</li>
		    			</ul>
	    			</nav>
    			</li>
    		</ul>
    		</nav>
    	</div>
    	</div>
    </div><!– #header –>

    <!-- Acessibilidade Menu Categorias com jQuery -->
	<script type="text/javascript">
	$(document).ready(function(){
		// Acessível com o mouse
		$(".item-categoria").mouseenter(function(){
			$(this).find('.sub-menu-categoria').finish();
			$(this).find('.sub-menu-categoria').slideDown('fast');
			// função para hover do sub-menu com mouse
				$('.sub').mouseenter(function(){
					$(this).addClass('sub-hover');
				}).mouseleave(function(){
					$(this).removeClass('sub-hover');
				});
			}).mouseleave(function(){
				$(this).find('.sub-menu-categoria').finish();
				$(this).find('.sub-menu-categoria').hide();
			});
		// Acessível com o teclado
		$('.item-categoria').focusin(function(){
			$(this).find('.sub-menu-categoria').finish();
			$(this).find('.sub-menu-categoria').slideDown('fast');
			// função para hover do sub-menu com teclado
				$('.sub').focusin(function(){
					$(this).addClass('sub-hover');
				}).focusout(function(){
						$(this).removeClass('sub-hover');
				});
			}).focusout(function(){
				$(this).find('.sub-menu-categoria').slideUp();
		});

	});
	</script> 
    <div id="principal">