<?php get_header(); ?>

<main id="conteudo" role='main'>
    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
    <article id="artigo-page">
        <?php if(have_posts()) : while(have_posts()) : the_post();?>
        <header>
            <h1 class="titulo-post">
                <?php the_title(); ?>
            </h1>            
        </header>
         <div class="itens-post">
            <div class="opcoes-post">
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
        <?php endwhile; else:?>
        
    	<p>Nenhum post encontrado!</p>

        <?php endif;?>

    </article><!– #artigo –>
    
    <!-- Quando a página carregar formate os componentes da seguinte forma -->
    <script language='javascript'>
        $(document).ready(function(){
            $('article textarea').css('width', '420px');
            $('article input[type=email]').css('width', '420px');
            $('article input[type=text]').css('width', '420px');

            //plugin de agendamento scheduler correções
            $('article .birs_footer').css('margin-left','6px');
            $('#birs_appointment_form').css('font-family','PT Sans, Sans-serif');
            $('#birs_appointment_datepicker').css('background-color', '#fff');
            $('#birs_appointment_notes').attr('placeholder',
                                              'Aqui você pode inserir o nome da escola, a quantidade de alunos e os demais aspectos importantes.');
            $('.birs_appointment_section h2').html('Informações da visita');
            $('.birs_appointment_location').hide();
            $('.birs_appointment_service').hide();
            $('.birs_appointment_staff').hide();
            $('#birs_booking_success').css({'background-color':'#fff',
                                            'padding': '10px',
                                        });
            
            //plugin de contato
            $('#wpcf7-f250-p23-o1').css('font-family','PT Sans, Sans-serif');
        });
    </script>

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