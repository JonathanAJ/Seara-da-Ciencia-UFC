
<?php
	
	//Remove a barra de administração
	add_filter('show_admin_bar','__return_false');

	// Remover link RSD
	remove_action ('wp_head', 'rsd_link');

	// Remove a versão do WordPress do cabeçalho (segurança)
	remove_action('wp_head', 'wp_generator');

	//Mudar tamanho do resumo
	function novo_tamanho_do_resumo($length) {
		return 20;
	}
	add_filter('excerpt_length', 'novo_tamanho_do_resumo');

	//adicionar link no final ou só texto
	function add_resumo_com_link($more) {
		// return '...'; para só texto sem link

		//com link >
	    global $post;
		return '...<a href="'.get_permalink($post->ID).'"><br>Continue lendo →</a>';
	}
	add_filter('excerpt_more', 'add_resumo_com_link');

	// Adiciona suporte a imagens no post
	add_theme_support('post-thumbnails', array('post'));

	//seta o tamanho do thumbnail
    // set_post_thumbnail_size(300, 200, array( 'center', 'center'));

    add_image_size('medio2', 306, 176, array('center', 'center'));

    add_image_size('grande', 306, 300, array( 'center', 'center'));

	/**
	 * Criando uma area de widgets
	 *
	 */
	// function novos_widgets() {

	// 	register_sidebar( array(
	// 		'name' => 'Compartilhar',
	// 		'id' => 'compartilhar_widget',
	// 		'before_widget' => '<div>',
	// 		'after_widget' => '</div>',
	// 		'before_title' => '<h2>',
	// 		'after_title' => '</h2>',
	// 	) );
	// }
	// add_action( 'widgets_init', 'novos_widgets');

	/**
	 * Menu dinâmico wordpress
	 *
	 */
	register_nav_menus( array(
	  'menu-topo' => __( 'Menu topo 1', '' )
	));
	
	/**
	 * Filtro de pesquisa que exclui as páginas
	 *
	 */
	function filtroPesquisa($query) {
		if ($query->is_search) {
			$query->set('post_type', 'post');
		}
			return $query;
		}
	add_filter('pre_get_posts','filtroPesquisa');

	/*
	 * MENU HIERARQUICO NAS CATEGORIAS
	 *
	 * WordPress Breadcrumbs
	 * author: Dimox
	 * version: 2015.05.21
	*/
	function dimox_breadcrumbs() {

		/* === OPTIONS === */
		$text['home']     = 'Home'; // text for the 'Home' link
		$text['category'] = '%s'; // text for a category page
		$text['search']   = 'Resultados da pesquisa por "%s"'; // text for a search results page
		$text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
		$text['author']   = 'Articles Posted by %s'; // text for an author page
		$text['404']      = 'Error 404'; // text for the 404 page
		$text['page']     = 'Page %s'; // text 'Page N'
		$text['cpage']    = 'Comment Page %s'; // text 'Comment Page N'

		$delimiter      = '›'; // delimiter between crumbs
		$delim_before   = '<span class="divider">'; // tag before delimiter
		$delim_after    = '</span>'; // tag after delimiter
		$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
		$show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$show_current   = 1; // 1 - show current page title, 0 - don't show
		$show_title     = 1; // 1 - show the title for the links, 0 - don't show
		$before         = '<span class="atual-bread">'; // tag before the current crumb
		$after          = '</span>'; // tag after the current crumb
		/* === END OF OPTIONS === */

		global $post;
		$home_link      = home_url('/');
		$link_before    = '<span class="marcador-bread" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
		$link_after     = '</span>';
		$link_attr      = ' itemprop="url"';
		$link_in_before = '<span itemprop="title">';
		$link_in_after  = '</span>';
		$link           = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
		$frontpage_id   = get_option('page_on_front');
		$parent_id      = $post->post_parent;
		$delimiter      = ' ' . $delim_before . $delimiter . $delim_after . ' ';

		if (is_home() || is_front_page()) {

			if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';

		} else {

			echo '<div class="breadcrumbs">';
			if ($show_home_link == 1) echo sprintf($link, $home_link, $text['home']);

			if ( is_category() ) {
				$cat = get_category(get_query_var('cat'), false);
				if ($cat->parent != 0) {
					$cats = get_category_parents($cat->parent, TRUE, $delimiter);
					$cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
					if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
					if ($show_home_link == 1) echo $delimiter;
					echo $cats;
				}
				if ( get_query_var('paged') ) {
					$cat = $cat->cat_ID;
					echo $delimiter . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $delimiter . $before . sprintf($text['page'], get_query_var('paged')) . $after;
				} else {
					if ($show_current == 1) echo $delimiter . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
				}

			} elseif ( is_search() ) {
				if ($show_home_link == 1) echo $delimiter;
				echo $before . sprintf($text['search'], get_search_query()) . $after;

			} elseif ( is_day() ) {
				if ($show_home_link == 1) echo $delimiter;
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F')) . $delimiter;
				echo $before . get_the_time('d') . $after;

			} elseif ( is_month() ) {
				if ($show_home_link == 1) echo $delimiter;
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo $before . get_the_time('F') . $after;

			} elseif ( is_year() ) {
				if ($show_home_link == 1) echo $delimiter;
				echo $before . get_the_time('Y') . $after;

			} elseif ( is_single() && !is_attachment() ) {
				if ($show_home_link == 1) echo $delimiter;
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
					if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, $delimiter);
					if ($show_current == 0 || get_query_var('cpage')) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
					if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
					echo $cats;
					if ( get_query_var('cpage') ) {
						echo $delimiter . sprintf($link, get_permalink(), get_the_title()) . $delimiter . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
					} else {
						if ($show_current == 1) echo $before . get_the_title() . $after;
					}
				}

			// custom post type
			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type());
				if ( get_query_var('paged') ) {
					echo $delimiter . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $delimiter . $before . sprintf($text['page'], get_query_var('paged')) . $after;
				} else {
					if ($show_current == 1) echo $delimiter . $before . $post_type->label . $after;
				}

			} elseif ( is_attachment() ) {
				if ($show_home_link == 1) echo $delimiter;
				$parent = get_post($parent_id);
				$cat = get_the_category($parent->ID); $cat = $cat[0];
				if ($cat) {
					$cats = get_category_parents($cat, TRUE, $delimiter);
					$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
					if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
					echo $cats;
				}
				printf($link, get_permalink($parent), $parent->post_title);
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

			} elseif ( is_page() && !$parent_id ) {
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

			} elseif ( is_page() && $parent_id ) {
				if ($show_home_link == 1) echo $delimiter;
				if ($parent_id != $frontpage_id) {
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_page($parent_id);
						if ($parent_id != $frontpage_id) {
							$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
						}
						$parent_id = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					for ($i = 0; $i < count($breadcrumbs); $i++) {
						echo $breadcrumbs[$i];
						if ($i != count($breadcrumbs)-1) echo $delimiter;
					}
				}
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

			} elseif ( is_tag() ) {
				if ($show_current == 1) echo $delimiter . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

			} elseif ( is_author() ) {
				if ($show_home_link == 1) echo $delimiter;
				global $author;
				$author = get_userdata($author);
				echo $before . sprintf($text['author'], $author->display_name) . $after;

			} elseif ( is_404() ) {
				if ($show_home_link == 1) echo $delimiter;
				echo $before . $text['404'] . $after;

			} elseif ( has_post_format() && !is_singular() ) {
				if ($show_home_link == 1) echo $delimiter;
				echo get_post_format_string( get_post_format() );
			}

			echo '</div><!-- .breadcrumbs -->';

		}
	} // end dimox_breadcrumbs()


	/*
	 * Paginação das páginas
	 *
	 * 
	*/
	function post_pagination($pages = '', $range = 4){
	     $showitems = ($range * 2)+1;
	     global $paged;
	     if(empty($paged)) $paged = 1;
	     if($pages == '')
	     {
	         global $wp_query;
	         $pages = $wp_query->max_num_pages;
	         if(!$pages)
	         {
	             $pages = 1;
	         }
	     }
	     if(1 != $pages)
	     {
	         echo "<div class='paginacao'><span>Páginas</span>";
	         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."' class='current'>&laquo;</a>";
	         if($paged > 6 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>1</a> <span class='current'>...</span>";
	         for ($i=1; $i <= $pages; $i++)
	         {
	             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
	             {
	                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
	             }
	         }
	         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<span class='current'>...</span> <a href='".get_pagenum_link($pages)."'>$pages</a>";
	         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."' class='current'>&raquo;</a>";
	         echo "</div>";
	     }
	}

	/*
	 * Thumbnails diferenciados
	 * Autor: Jonathan Alves
	 * 
	*/
	function imagem_categoria($categoria){
		if($categoria=='Artigos'){
			echo "<svg xmlns='http://www.w3.org/2000/svg' class='icon-thumbnail' width='48px' viewBox='0 0 48 48'>
                    <path d='M6 34.5v7.5h7.5l22.13-22.13-7.5-7.5-22.13 22.13zm35.41-20.41c.78-.78.78-2.05 0-2.83l-4.67-4.67c-.78-.78-2.05-.78-2.83 0l-3.66 3.66 7.5 7.5 3.66-3.66z'/>
                    <path d='M0 0h48v48h-48z' fill='none'/>
                  </svg>";
		}else if($categoria=='Biologia'){
			echo "<svg version='1.1' id='Capa_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px'
					 class='icon-thumbnail' width='48px' viewBox='0 0 489.234 489.234' style='enable-background:new 0 0 489.234 489.234;' xml:space='preserve'>
						<path d='M465.402,344.43c-15.352-15.379-35.758-23.832-57.418-23.832c-0.047,0-0.098,0-0.129,0H255.027l65.547-65.547v29.668h49.434
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
													c-5.23,0-10.09-1.387-14.465-3.621l130.852-130.742c2.743,4.174,3.582,9.173,3.582,14.371v19.496L220.078,320.598H200.605z'/>
						</svg>";
		}else if($categoria=='Química'){
			echo '<svg version="1.1" class="icon-thumbnail" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 width="48px" viewBox="0 0 207.806 207.806" style="enable-background:new 0 0 207.806 207.806;" xml:space="preserve">
						<path d="M186.653,176.188l-57.18-92.36V13.674h5.035c3.579,0,6.481-2.902,6.481-6.481V6.481c0-3.58-2.902-6.481-6.481-6.481h-61.21
							c-3.579,0-6.481,2.902-6.481,6.481v0.712c0,3.579,2.902,6.481,6.481,6.481h5.035v70.154l-57.18,92.36
							c-3.911,6.316-4.095,13.95-0.491,20.418c3.848,6.908,11.355,11.199,19.592,11.199h127.299c8.236,0,15.744-4.291,19.592-11.199
							C190.748,190.138,190.564,182.505,186.653,176.188z M88.333,86.673V18.674h31.141v67.999l20.328,32.835H68.004L88.333,86.673z"/>
						</svg>';
		}else if($categoria=='Matemática'){
			echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
							version="1.1" x="0px" y="0px" class="icon-thumbnail" width="48px" viewBox="0 0 100 100" enable-background="new 0 0 100 100"
							xml:space="preserve">
							<path d="M5.004,79.905C5.004,88.241,11.761,95,20.099,95h27.507V52.396H5.004V79.905z M16.533,64.442l3.589-3.589l7.505,7.553  l7.555-7.553l3.586,3.589l-7.599,7.553l7.599,7.553l-3.586,3.588l-7.555-7.602l-7.601,7.602l-3.588-3.588l7.601-7.553L16.533,64.442  z"/>
							<path d="M95.003,20.096C95.003,11.761,88.242,5,79.908,5H52.396v42.603h42.606V20.096z M81.803,30.335h-16.08v-5.965h16.08V30.335z"/>
							<path d="M5,20.095v27.511h42.606V5H20.1C11.761,5,5,11.761,5,20.095z M25.237,15.873h4.732v8.8h8.8v4.73h-8.8v8.8h-4.732v-8.8  h-8.798v-4.73h8.798V15.873z"/>
							<path d="M52.398,52.396V95h27.506c8.339,0,15.1-6.759,15.1-15.095V52.396H52.398z M71.154,59.572  c0.751-0.723,1.627-1.085,2.63-1.085c0.502,0,0.975,0.098,1.415,0.289c0.442,0.193,0.833,0.456,1.171,0.796  c0.339,0.339,0.612,0.737,0.818,1.195c0.207,0.456,0.311,0.949,0.311,1.479c0,0.471-0.104,0.929-0.311,1.372  c-0.207,0.444-0.473,0.84-0.795,1.193c-0.325,0.355-0.707,0.635-1.151,0.84c-0.441,0.207-0.914,0.311-1.414,0.311  c-0.531,0-1.024-0.097-1.48-0.287c-0.459-0.193-0.855-0.458-1.193-0.797c-0.338-0.339-0.612-0.736-0.818-1.192  c-0.207-0.458-0.311-0.936-0.311-1.439C70.025,61.186,70.401,60.294,71.154,59.572z M77.189,81.924  c-0.207,0.442-0.473,0.84-0.795,1.195c-0.325,0.353-0.707,0.639-1.151,0.86c-0.441,0.222-0.914,0.332-1.414,0.332  c-0.531,0-1.024-0.103-1.48-0.309c-0.459-0.205-0.855-0.479-1.193-0.818c-0.338-0.34-0.612-0.736-0.818-1.194  s-0.311-0.921-0.311-1.394c0-0.531,0.104-1.016,0.311-1.458c0.207-0.444,0.48-0.833,0.818-1.171  c0.338-0.338,0.734-0.604,1.193-0.797c0.456-0.19,0.936-0.286,1.437-0.286c0.502,0,0.975,0.096,1.415,0.286  c0.442,0.193,0.833,0.459,1.171,0.797c0.339,0.339,0.612,0.728,0.818,1.171c0.207,0.443,0.311,0.928,0.311,1.458  C77.5,81.04,77.396,81.483,77.189,81.924z M84.928,73.787h-22.33v-4.729h22.33V73.787z"/>
						</svg>';

		}else if($categoria=='Física'){
			echo '<svg version="1.1" class="icon-thumbnail" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 width="48px" viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve">
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
						</svg>';

		}else if($categoria=='Astronomia'){
			echo '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 class="icon-thumbnail" width="48px" viewBox="0 0 29.682 29.682" style="enable-background:new 0 0 29.682 29.682;" xml:space="preserve">
								<polygon points="26.514,0.393 22.714,1.699 22.994,2.511 11.575,6.437 12.055,7.835 1.915,11.32 
									2.434,12.83 0,13.666 0.611,15.442 3.044,14.605 3.563,16.115 13.704,12.626 14.184,14.024 25.603,10.099 25.881,10.911 
									29.682,9.605 		"/>
								<path d="M18.053,17.617v-2.255h-1.795c-0.214-0.296-0.556-0.521-0.957-0.645v-0.034l-0.021,0.028
									c-0.195-0.061-0.4-0.102-0.622-0.102c-0.688,0-1.279,0.305-1.602,0.751h-1.795v2.255h1.805L4.175,29.289h1.821l8.017-10.527
									v10.493H15.3V18.762l8.017,10.527h2.278l-9.296-11.673L18.053,17.617L18.053,17.617z"/>
						</svg>';

		}else if($categoria=='Tecnologia'){
			echo '<svg xmlns="http://www.w3.org/2000/svg" class="icon-thumbnail" width="48px" viewBox="0 0 48 48">
						    <path d="M0 0h48v48h-48z" fill="none"/>
						    <path d="M42 6h-36c-2.21 0-4 1.79-4 4v24c0 2.21 1.79 4 4 4h10v4h16v-4h10c2.21 0 3.98-1.79 3.98-4l.02-24c0-2.21-1.79-4-4-4zm0 28h-36v-24h36v24zm-4-18h-22v4h22v-4zm0 8h-22v4h22v-4zm-24-8h-4v4h4v-4zm0 8h-4v4h4v-4z"/>
						</svg>';

		}else if($categoria=='Geologia'){
			echo '<svg xmlns="http://www.w3.org/2000/svg" class="icon-thumbnail" width="48px"  viewBox="0 0 48 48">
						    <path d="M0 0h48v48h-48z" fill="none"/>
						    <path d="M28 12l-7.5 10 5.7 7.6-3.2 2.4c-3.38-4.5-9-12-9-12l-12 16h44l-18-24z"/>
						</svg>';

		}else if($categoria=='Notícias'){
			echo '<svg version="1.1" id="Capa_1" class="icon-thumbnail" width="48px"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
							<path d="M28,7V3H0v22c0,0,0,4,4,4h25c0,0,3-0.062,3-4V7H28z M4,27c-2,0-2-2-2-2V5h24v20
								c0,0.921,0.284,1.559,0.676,2H4z"/>
							<rect x="4" y="9" width="20" height="2"/>
							<rect x="15" y="21" width="7" height="2"/>
							<rect x="15" y="17" width="9" height="2"/>
							<rect x="15" y="13" width="9" height="2"/>
							<rect x="4" y="13" width="9" height="10"/>
				  </svg>';
		}
	}

?>

