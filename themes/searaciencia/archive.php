<?php get_header(); ?>

<div id="conteudo">
 
    <div id="artigo">

        <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
        <?php /* If this is a category archive */ if (is_category()) { ?>
            Arquivo da Categoria "<?php echo single_cat_title(); ?>"
        <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
            Arquivo de <?php the_time('j \d\e F \d\e Y'); ?>
        <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
            Arquivo de <?php the_time('F \d\e Y'); ?>
        <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
            Arquivo de <?php the_time('Y'); ?>
        <?php /* If this is an author archive */ } elseif (is_author()) { ?>
            Arquivo do Autor
        <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
            Arquivo do Blog
        <?php } ?>

        <?php if(have_posts()) : while(have_posts()) : the_post();?>
    	<h1>
    		<a href="<?php the_Permalink()?>">
    			<?php the_title(); ?>
    		</a>
    	</h1>

    	Postado em <?php the_time('d/m/Y') ?> 
    	- <?php comments_popup_link('Seja o primeiro a comentar', '1 pessoa comentou', '% pessoas comentaram', 'comments-link', ''); ?>
    	<p>
    		<?php edit_post_link('(Atualizar Post)'); ?>
    	</p>

    	<?php the_content(); ?>

        <?php endwhile?>

    	<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>

    	<?php else:?>

    	<p>Nenhum post encontrado!</p>

        <?php endif;?>

    </div><!– #artigo –>
 
</div><!– #conteudo –>

<?php get_footer(); ?>