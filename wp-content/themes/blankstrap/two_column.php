<?php
/*
Template Name: Two Column
*/
?>


<?php
  if( have_rows('hero_slider') ) {
    echo '<div class="hero-slider home-slider">';
    echo '<ul class="hero-slides">';
      while ( have_rows('hero_slider') ) : the_row();
        echo '<li><div class="slide-content"><h1 class="hero-title">';
        echo get_sub_field('slide_title');
        echo '</h1>';
        if( get_sub_field('slide_link')) {
          echo '<a class="btn btn-primary" href="'. get_sub_field('slide_link') . '" >';
        } elseif( get_sub_field('slide_anchor') ) {
          echo '<a class="btn btn-primary" href="'. get_sub_field('slide_anchor') . '" >';
        }
        echo get_sub_field('slide_link_text');
        echo '</a></div><img src="' . get_sub_field('hero_slide') . '" />';
        echo '</li>';
      endwhile;
    echo '</ul>';
    echo '</div>';
  } else  {
    if ( has_post_thumbnail() ) {
      echo '<div class="hero-slider home-slider">';
      the_post_thumbnail();
      echo '</div>';
    }
  }
?>

<div class="wrap container" role="document">
  <div class="content row">
    <?php if (roots_display_sidebar()) : ?>
      <aside class="sidebar" role="complementary">
        <?php include roots_sidebar_path(); ?>
      </aside><!-- /.sidebar -->
    <?php endif; ?>
    <main class="main home-main" role="main">
      <div class="hero-intro">
        <?php while (have_posts()) : the_post(); ?>
          <!-- <?php get_template_part('templates/page', 'header'); ?> -->
          <?php get_template_part('templates/content', 'page'); ?>
        <?php endwhile; ?>

      </div>
    </main><!-- /.main -->
  </div><!-- /.content -->
</div><!-- /.wrap -->

<!-- BLOCKS -->
<?php
  if( have_rows('content_block') ) {
    echo '
    <div class="wrap fluid-container content-block" role="document">
      <div class="container">
        <div class="content row">';
    while ( have_rows('content_block') ) : the_row();
      echo '<div class="hero-intro" id="'. get_sub_field('content_anchor') .'"><p>';
      echo get_sub_field('content');
      echo '</p></div>';
    endwhile;
    echo '
       </div>
      </div><!-- /.content -->
    </div><!-- /.wrap -->';
  }
?>


<!-- COLUMNS -->
<?php
  if( have_rows('three_column_items') ) {
    echo '<div class="wrap fluid-container bg-gray" role="document">
          <div class="container">
          <div class="content row">';

    while ( have_rows('three_column_items') ) : the_row();
      echo '<div class="col col-md-4"><h2 class="col-title">';
      echo get_sub_field('item_title');
      echo '</h2><p>' . get_sub_field('item_teaser') . '</p>';
      echo '<img src="' . get_sub_field('item_image') . '" />';
      echo '<a class="btn btn-primary" href="'. get_sub_field('item_link') . '" >';
      echo get_sub_field('item_link_text');
      echo '</a></div>';
    endwhile;

    echo '
          </div>
          </div><!-- /.content -->
          </div><!-- /.wrap -->
        ';
  }
?>

<!-- COLUMNS -->
<?php
  if( have_rows('four_column_items') ) {
    echo '
        <div class="wrap fluid-container" role="document">
        <div class="container">
        <div class="content row">
        ';

    while ( have_rows('four_column_items') ) : the_row();
      echo '<div class="col col-md-3"><h2 class="col-title">';
      echo '<a class ="col-item-img" href="'. get_sub_field('item_link') . '" ><img src="' . get_sub_field('item_image') . '" /></a>';
      echo get_sub_field('item_title');
      echo '</h2><p>' . get_sub_field('item_teaser') . '</p>';
      echo '</div>';
    endwhile;

    echo '
      </div>
      </div><!-- /.content -->
      </div><!-- /.wrap -->';
  }
?>
