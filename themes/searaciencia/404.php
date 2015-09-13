<?php get_header(); ?>
    <div id="conteudo">
        <div id="artigos">
            <div class="artigo">
	            <div id="img-404">
			        <img alt="Imagem de erro 404 - Página não encontrada" src="<?php echo get_template_directory_uri() ?>/img/404.png" />	  
			        <div class="busca-404">
			        	<?php get_search_form(); ?>
			        </div>
	            </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>