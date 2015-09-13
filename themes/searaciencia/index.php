<?php get_header(); ?>
<main id="conteudo" name='conteudo' role='main'>
    <div id="artigo">
        <section id="noticias" class="clear-b">
            <header>
                <h1 class='marcador'>
                    Notícias Seara › <span class='sub-marcador'>Veja o que está acontecendo na Seara</span>
                </h1>
            </header>
            <?php
                $args = array(
                    'posts_per_page'   => 6,
                    'category_name'    =>'noticias',
                /*
                    'posts_per_page'   => 5,
                    'offset'           => 0,
                    'category'         => '',
                    'orderby'          => 'post_date',
                    'order'            => 'DESC',
                    'include'          => '',
                    'exclude'          => '',
                    'meta_key'         => '',
                    'meta_value'       => '',
                    'post_type'        => 'post',
                    'post_mime_type'   => '',
                    'post_parent'      => '',
                    'post_status'      => 'publish',
                    'suppress_filters' => true */
                    );
                $my_posts = get_posts($args);
            ?>
            <!-- LOOP com get_post -->
            <?php
                $num_post = 0; 
                if( $my_posts ):
                foreach( $my_posts as $post ) : setup_postdata($post);
                    if($num_post<2):
            ?>
               <?php
                    // retorna a categoria para a respectiva variavel
                    $category = get_the_category();
               ?>
               <article class="post-grande">
                   <a href="<?php the_Permalink()?>">
                            <!-- Adiciona uma imagem destacada -->
                            <div class="imagem-post">
                                <div class="conteiner-img-post">
                                     <?php if(has_post_thumbnail( )): ?>
                                        <?php the_post_thumbnail('grande');?>
                                    <?php else:
                                        imagem_categoria($category[1]->cat_name);
                                    endif;
                                    ?>
                                </div>
                            </div>
                    </a>
                     <div class="conteudo-post">
                        <header class="titulos">
                            <a href="<?php the_Permalink()?>">
                                <!-- Adiciona o título -->
                                <h1 class="font-title-post-grande"><?php the_title(); ?></h1>
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
                        
                        <p class="texto"><?php the_excerpt(); ?></p>
                    </div>
                    <!-- Muda Cor Categoria -->
                            <div class="categoria-post-grande clear-b <?php echo $category[0]->cat_name;?> <?php echo $category[1]->cat_name;?>">
                                <span>
                                    <h3 class="cat-post-medio">
                                        <!-- Retorna o link da categoria FILHA do determinado post
                                        ignorando todas as demais categorias filhas do post e a pai -->
                                        <?php
                                        echo '<a href="' . get_category_link( get_cat_ID($category[0]->cat_name))
                                                . '" title="' . $category[0]->description. '">'
                                                . $category[0]->cat_name . '</a>';
                                        ?>
                                    </h3>
                                </span>
                            </div>
                            <!-- Fim Categoria -->
                   
                </article>

                <?php
                    else:
                ?>
                
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
                                        <!-- Retorna o link da categoria FILHA do determinado post
                                    ignorando todas as demais categorias filhas do post e a pai -->
                                    <?php
                                    echo '<a href="' . get_category_link( get_cat_ID($category[0]->cat_name))
                                            . '" title="' . $category[0]->description. '">'
                                            . $category[0]->cat_name . '</a>';
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
                <?php
                    endif;
                    $num_post++;
                ?>
            <?php endforeach;?>
            <?php else:?>
            <p>Nada encontrado.</p>
            <?php endif; ?>
        </section>
        <!-- Mais notícias -->

        <div class='marcador-final'>
            <a href="<?php echo get_category_link(31); ?>">Ver todas as notícias →</a>
        </div>

        <!-- Seções Especiais -->
        <section id="secoes-especiais" class="clear-b">
            <header >
                <h1 class='marcador'>
                    Seções Especiais › <span class='sub-marcador'>Ciência e Tecnologia</span>
                </h1>
            </header>
            <?php
                $args = array(
                    'posts_per_page'   => 4,
                    'category_name'    =>'secoes-especiais-matematica,
                                          secoes-especiais-fisica,
                                          secoes-especiais-quimica,
                                          secoes-especiais-biologia,
                                          secoes-especiais-geologia,',
                /*  'category_name'    =>'teste 3',
                    'posts_per_page'   => 5,
                    'offset'           => 0,
                    'category'         => '',
                    'orderby'          => 'post_date',
                    'order'            => 'DESC',
                    'include'          => '',
                    'exclude'          => '',
                    'meta_key'         => '',
                    'meta_value'       => '',
                    'post_type'        => 'post',
                    'post_mime_type'   => '',
                    'post_parent'      => '',
                    'post_status'      => 'publish',
                    'suppress_filters' => true */
                    );
                $my_posts = get_posts($args);
            ?>
            <!-- LOOP com get_post -->
            <?php
                if( $my_posts ):
                foreach( $my_posts as $post ) : setup_postdata($post);
            
                ?>
                
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
                                    <!-- Retorna o link da categoria PAI do determinado post
                                    ignorando todas as demais categorias filhas do post -->
                                    <?php $parentscategory ="";
                                        foreach((get_the_category()) as $category) {
                                            if ($category->category_parent == 0) {
                                            $parentscategory .= ' <a href="' . get_category_link($category->cat_ID)
                                            . '" title="' . $category->name. '">'
                                            . $category->name . '</a>, ';
                                                }
                                        }
                                    echo substr($parentscategory,0,-2); ?></h3>
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
            <?php endforeach;?>
            <?php else:?>
            <p>Nada encontrado.</p>
            <?php endif; ?>

        </section><!-- Seções Especiais -->
        
        <!-- Tintim por Tintim -->
        <section id="tintim" class="clear-b">
            <header>
                <h1 class='marcador'>
                    Tintim por Tintim › <span class='sub-marcador'>Ciência sem Ciencês</span>
                </h1>
            </header>
            <?php
                $args = array(
                    'posts_per_page'   => 4,
                    'category_name'    =>'tintim-matematica,
                                          tintim-fisica,
                                          tintim-biologia,
                                          tintim-tecnologia,',
                /*  'category_name'    =>'teste 3',
                    'posts_per_page'   => 5,
                    'offset'           => 0,
                    'category'         => '',
                    'orderby'          => 'post_date',
                    'order'            => 'DESC',
                    'include'          => '',
                    'exclude'          => '',
                    'meta_key'         => '',
                    'meta_value'       => '',
                    'post_type'        => 'post',
                    'post_mime_type'   => '',
                    'post_parent'      => '',
                    'post_status'      => 'publish',
                    'suppress_filters' => true */
                    );
                $my_posts = get_posts($args);
            ?>
            <!-- LOOP com get_post -->
            <?php
                if( $my_posts ):
                foreach( $my_posts as $post ) : setup_postdata($post);
            
                ?>
                
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
                                    <!-- Retorna o link da categoria PAI do determinado post
                                    ignorando todas as demais categorias filhas do post -->
                                    <?php $parentscategory ="";
                                        foreach((get_the_category()) as $category) {
                                            if ($category->category_parent == 0) {
                                            $parentscategory .= ' <a href="' . get_category_link($category->cat_ID)
                                            . '" title="' . $category->name. '">'
                                            . $category->name . '</a>, ';
                                                }
                                        }
                                    echo substr($parentscategory,0,-2); ?></h3>
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
            <?php endforeach;?>
            <?php else:?>
            <p>Nada encontrado.</p>
            <?php endif; ?>

        </section><!-- Tintim por Tintim -->

        <!-- Experimentos -->
        <section id="experimentos" class="clear-b">
            <header >
                <h1 class='marcador'>
                    Experimentos › <span class='sub-marcador'>Para sua feira de ciências</span>
                </h1>
            </header>
            <?php
                $args = array(
                    'posts_per_page'   => 4,
                    'category_name'    =>'experimentos-quimica,
                                          experimentos-fisica,
                                          experimentos-biologia,
                                          experimentos-astronomia',
                /*  'category_name'    =>'teste 3',
                    'posts_per_page'   => 5,
                    'offset'           => 0,
                    'category'         => '',
                    'orderby'          => 'post_date',
                    'order'            => 'DESC',
                    'include'          => '',
                    'exclude'          => '',
                    'meta_key'         => '',
                    'meta_value'       => '',
                    'post_type'        => 'post',
                    'post_mime_type'   => '',
                    'post_parent'      => '',
                    'post_status'      => 'publish',
                    'suppress_filters' => true */
                    );
                $my_posts = get_posts($args);
            ?>
            <!-- LOOP com get_post -->
            <?php
                if( $my_posts ):
                foreach( $my_posts as $post ) : setup_postdata($post);
            
                ?>
                
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
                                    <!-- Retorna o link da categoria PAI do determinado post
                                    ignorando todas as demais categorias filhas do post -->
                                    <?php $parentscategory ="";
                                        foreach((get_the_category()) as $category) {
                                            if ($category->category_parent == 0) {
                                            $parentscategory .= ' <a href="' . get_category_link($category->cat_ID)
                                            . '" title="' . $category->name. '">'
                                            . $category->name . '</a>, ';
                                                }
                                        }
                                    echo substr($parentscategory,0,-2); ?></h3>
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
            <?php endforeach;?>
            <?php else:?>
            <p>Nada encontrado.</p>
            <?php endif; ?>

        </section><!-- Experimentos -->

        <!-- Artigos -->
        <section id="artigos-ciencia" class="clear-b">
            <header >
                <h1 class='marcador'>
                    Artigos › <span class='sub-marcador'>Conhecimentos mais profundos</span>
                </h1>
            </header>
            <?php
                $args = array(
                    'posts_per_page'   => 4,
                    'category_name'    =>'artigos',
                /*  'category_name'    =>'teste 3',
                    'posts_per_page'   => 5,
                    'offset'           => 0,
                    'category'         => '',
                    'orderby'          => 'post_date',
                    'order'            => 'DESC',
                    'include'          => '',
                    'exclude'          => '',
                    'meta_key'         => '',
                    'meta_value'       => '',
                    'post_type'        => 'post',
                    'post_mime_type'   => '',
                    'post_parent'      => '',
                    'post_status'      => 'publish',
                    'suppress_filters' => true */
                    );
                $my_posts = get_posts($args);
            ?>
            <!-- LOOP com get_post -->
            <?php
                if( $my_posts ):
                foreach( $my_posts as $post ) : setup_postdata($post);
            
                ?>
                
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
                                    imagem_categoria($category[1]->cat_name);
                                endif;
                                ?>
                            </div>
                        </div>
                    </a>
                    <!-- Muda Cor Categoria -->
                    <div class="categoria-post-medio clear-b <?php echo $category[1]->cat_name;?>">
                        <span>
                                <h3 class="cat-post-medio">
                                    <!-- Retorna o link da categoria PAI do determinado post
                                    ignorando todas as demais categorias filhas do post -->
                                    <?php $parentscategory ="";
                                        foreach((get_the_category()) as $category) {
                                            if ($category->category_parent == 0) {
                                            $parentscategory .= ' <a href="' . get_category_link($category->cat_ID)
                                            . '" title="' . $category->name. '">'
                                            . $category->name . '</a>, ';
                                                }
                                        }
                                    echo substr($parentscategory,0,-2); ?></h3>
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
            <?php endforeach;?>
            <?php else:?>
            <p>Nada encontrado.</p>
            <?php endif; ?>

        </section><!-- Artigos -->
    </div><!– #artigo –>
 
</main><!– #conteudo –>

<?php get_footer(); ?>