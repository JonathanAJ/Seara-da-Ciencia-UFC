<?php get_header(); ?>

<main id="conteudo" role='main'>
    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
    <article id="artigo-post">
        <?php if(have_posts()) : while(have_posts()) : the_post();?>
        <header>
            <h1 class="titulo-post">
                <?php the_title(); ?>
            </h1>            
        </header>
        <div class="itens-post">
                <div class="opcoes-post">
                    <time class="info info-2 data">
                        <?php the_time('d/m/Y'); ?>
                    </time>

                    <!-- Puxa as informações dos comentários do Disqus -->
                    <span class="info info-2 coment">
                        <?php comments_popup_link( '0 Comentários', '1 Comentário', '% Comentários'); ?>
                    </span>

                    <?php edit_post_link('Editar', '<span class="info info-2 edit">', '</span>'); ?>

                    <span class="info info-2 font">
                        <a id='font_mais' href="#" class="link-normal">A+</a>
                        <a id='font_menos' href="#" class="link-normal">A-</a>
                        <a id='font_normal' href="#" class="link-normal">A</a>
                    </span>    
                </div>
        </div>
       <div id="the_content">
            <?php the_content(); ?>
       </div>
        
        <?php comments_template(); ?>

        <?php endwhile; else:?>
        
    	<p>Nenhum post encontrado!</p>

        <?php endif;?>

    </article><!– #artigo –>

    <?php get_sidebar();?>

    <!-- Aumentar e diminuir fonte -->
    <script type="text/javascript">
       $(document).ready(function(){

       var font_normal = $('#the_content p').css('font-size');
       console.log(font_normal);

        $('#font_mais').click(function(e){
            e.preventDefault();
            var valor_font = $('#the_content p').css('font-size');
            if(valor_font<'25px'){
                $('#the_content p').css('font-size', '+=3');
                var font_normal = $('#the_content p').css('font-size');
                console.log(font_normal);
            }
        });

        $('#font_menos').click(function(e){
            e.preventDefault();
            var valor_font = $('#the_content p').css('font-size');
            if(valor_font>'10px'){
                $('#the_content p').css('font-size', '-=3');
                var font_normal = $('#the_content p').css('font-size');
                console.log(font_normal);
            }
        });

        $('#font_normal').click(function(e){
            e.preventDefault();
            $('#the_content p').css('font-size', '16px');
            var font_normal = $('#the_content p').css('font-size');
            console.log(font_normal);
        });
       });
    </script>

 
</main><!– #conteudo –>

<?php get_footer(); ?>