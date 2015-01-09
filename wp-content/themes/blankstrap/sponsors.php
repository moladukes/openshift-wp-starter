<?php
/*
Template Name: Sponsors Index
*/
?>


<div class="wrap container" role="document">
  <div class="content row">

    <?php get_template_part('templates/page', 'header'); ?>

    <div class="row sponsors-row cf">
      <?php
        $temp = $wp_query;
          $wp_query = null;
          //$wp_query = new WP_Query();
          //$wp_query->query('showposts=999&post_type=artist&orderby=order'.'&paged='.$paged);
          $args = array(
            'post_type' => 'sponsor',
            'posts_per_page' => 9999,
            'meta_key' => 'order',
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'meta_query' => array(
              array(
                'key' => 'order',
                'compare' => 'LIKE',
              )
            )
          );
          $wp_query = new WP_Query($args);

        while ($wp_query->have_posts()) : $wp_query->the_post();
        ?>
          <div class="col-md-3 sponsors-thumb">
            <?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumbnail'); } ?>
            <h5><?php the_title(); ?></h5>
            <?php
              $url = get_post_meta(get_the_ID(),'url',true);
              if ( $url ) {
                echo '<p class="small"><a href="';
                echo $url;
                echo '">' . $url .'</a></p>';
              }
            ?>
          </div>

        <?php endwhile; ?>
    </div>
  </div>
</div>
