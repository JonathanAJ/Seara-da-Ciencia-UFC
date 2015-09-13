<?php
/*
Template Name: Search Page
*/
?>

<?php get_header(); ?>

<main id="conteudo" role='main'>

    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>

    <br><br>
    <section id="artigo">

        <?php if(have_posts()) : while(have_posts()) : the_post();?>

                <?php
                // retorna a categoria para a respectiva variavel
                    $category = get_the_category();
                ?>
                <article class="post-medio-2">
                   <a href="<?php the_Permalink()?>">
                        <!-- Adiciona uma imagem destacada -->
                        <div class="imagem-post">
                            <div class="conteiner-img-post">
                                 <?php if(has_post_thumbnail( )): ?>
                                    <?php the_post_thumbnail('medio2');?>
                                <?php else:
                                    imagem_categoria($category[0]->cat_name);
                                    imagem_categoria($category[1]->cat_name);
                                endif;
                                ?>
                            </div>
                        </div>
                    </a>
                    <!-- Muda Cor Categoria -->
                        <div class="categoria-post-medio clear-b <?php echo $category[0]->cat_name;?> <?php echo $category[1]->cat_name;?>">
                            <span>
                                <h3 class="cat-post-medio">
                                    <!-- Retorna o link da categoria FILHA se for Notícias, porém
                                     retorna o link da categoria PAI se for as demais categorias -->
                                    <?php
                                        if($category[1]->cat_name=='Notícias'){
                                                    echo '<a href="' . get_category_link( get_cat_ID($category[0]->cat_name))
                                                    . '" title="' . $category[0]->description. '">'
                                                    . $category[0]->cat_name . '</a>';
                                        }else{
                                                $parentscategory ="";
                                                foreach((get_the_category()) as $category) {
                                                    if ($category->category_parent == 0) {
                                                    $parentscategory .= ' <a href="' . get_category_link($category->cat_ID)
                                                    . '" title="' . $category->name. '">'
                                                    . $category->name . '</a>, ';
                                                    }
                                                }
                                                echo substr($parentscategory,0,-2);
                                        }     
                                    ?>
                                </h3>
                            </span>
                        </div>
                    <!-- Fim Categoria -->

                    <div class="conteudo-post">
                        <header class="titulos">
                            <a href="<?php the_Permalink()?>">
                                <!-- Adiciona o título -->
                                <h1 class="font-title-post-medio"><?php the_title(); ?></h1>
                            </a>
                        </header>
                        <div class="opcoes-post">
                            <time class="info data">
                                <?php the_time('d/m/Y'); ?>
                            </time>

                            <!-- Puxa as informações dos comentários do Disqus -->
                            <span class="info coment">
                                <?php comments_popup_link( '0 Comentários', '1 Comentário', '% Comentários'); ?>
                            </span>

                            <?php edit_post_link('Editar', '<span class="info edit">', '</span>'); ?>
                            
                        </div>
                    </div>
                </article>
        <?php endwhile; else:?>

            <p>Nenhum post encontrado!</p>

        <?php endif;?>

        <?php post_pagination();?>

    </section><!– #artigo –>
 
</main><!– #conteudo –>

<?php get_footer(); ?>