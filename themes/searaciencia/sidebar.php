<aside id="sidebar">
	    <!-- Página Facebook -->
        <section id="facebook-page">
            <header >
                <h1 class='marcador'>
                    Curta nossa página!
                </h1>
            </header>
    		<div class="fb-page" data-href="https://www.facebook.com/SearaDaCienciaUfc"
    		data-width="430px" data-small-header="false" data-adapt-container-width="true"
    		data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
    			<div class="fb-xfbml-parse-ignore">
    				<blockquote cite="https://www.facebook.com/SearaDaCienciaUfc">
    					<a href="https://www.facebook.com/SearaDaCienciaUfc">
    						Seara da Ciência
    					</a>
    				</blockquote>
    			</div>
    		</div>
        </section>
	    
	    <!-- Posts recentes -->
        <section id="recentes">
            <header >
                <h1 class='marcador'>
                    Posts recentes ›
                </h1>
            </header>
            <?php
                $args = array(
                    'posts_per_page'   => 3,
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

                <article class="post-medio-2 post-sem-imagem">
                    <!-- Muda Cor Categoria -->
                    <?php
                        $category = get_the_category();
                    ?>
                        <div class="categoria-post-medio <?php echo $category[0]->cat_name;?> <?php echo $category[1]->cat_name;?>">
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
            <?php endforeach;?>
            <?php else:?>
            <p>Nada encontrado.</p>
            <?php endif; ?>

        </section><!-- FIM Posts recentes -->

	    <!-- Posts populares -->
        <section id="populares" class='clear-b'>
            <header >
                <h1 class='marcador'>
                    Posts populares ›
                </h1>
            </header>
            <?php
                $args = array(
                    'posts_per_page'   => 3,
                    'orderby'          => 'comment_count',
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
                <article class="post-medio-2 post-sem-imagem">
                    <!-- Muda Cor Categoria -->
                    <?php
                        $category = get_the_category();
                    ?>
                        <div class="categoria-post-medio <?php echo $category[0]->cat_name;?> <?php echo $category[1]->cat_name;?>">
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

        </section><!-- FIM Posts populares -->
</aside>