<?php
/*
Muda o estilo do formulário de busca
*/
?>

<form action="<?php bloginfo('home'); ?>/" method="get" accept-charset="utf-8" id="searchform" role="search">
  <div>
    <input type="text" name="s" id="s" value="<?php the_search_query(); ?>" placeholder="Busca" required />
  </div>
</form>