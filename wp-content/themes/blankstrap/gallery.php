<?php
/*
Template Name: Gallery Index
*/
?>


<!-- <?php if ( has_post_thumbnail() ) {
  echo '<div class="hero-slider home-slider">';
  the_post_thumbnail();
  echo '</div>';
  }
?> -->


<div class="wrap container" role="document">
  <div class="content row">

    <?php get_template_part('templates/page', 'header'); ?>
    <div class="row cf">
    <?php
      $temp = $wp_query;
      $wp_query = null;
      $wp_query = new WP_Query();
      $wp_query->query('showposts=4&post_type=photo_gallery'.'&paged='.$paged);

      while ($wp_query->have_posts()) : $wp_query->the_post();
      ?>
        <div class="col-md-4 gallery-thumb">
          <a href="<?php echo get_permalink() ?>">
            <div class="image">
              <?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumbnail'); } ?>
            </div>
          </a>
          <h5><a href="<?php echo get_permalink() ?>"><?php the_title(); ?></a></h5>
        </div>

      <?php endwhile; ?>

      </div>

  </div>
</div>
