<?php
  if( have_rows('hero_slider') ) {
    echo '<div class="hero-slider home-slider owl-carousel cf">';
      while ( have_rows('hero_slider') ) : the_row();
        echo '<div class="slide"><div class="slide-content">';
        if (get_sub_field('slide_title')) {
          echo '<h1 class="hero-title">';
          echo get_sub_field('slide_title');
          echo '</h1>';
        }
        if( get_sub_field('slide_link')) {
          echo '<a class="btn btn-primary" href="'. get_sub_field('slide_link') . '" >';
          echo get_sub_field('slide_link_text');
          echo '</a>';
        } elseif( get_sub_field('slide_anchor') ) {
          echo '<a class="btn btn-primary" href="'. get_sub_field('slide_anchor') . '" >';
          echo get_sub_field('slide_link_text');
          echo '</a>';
        }
        echo '</div><img src="' . get_sub_field('hero_slide') . '" alt="' . get_sub_field('slide_title') . '" />';
        echo '</div>';
      endwhile;
    echo '</div>';
  } else {
    echo '<div class="wrap fluid-container content-block" role="document"><div class="container">';
    echo '<h1 class="page-title">' . get_the_title() . '</h1>';
    echo '</div></div>';
  }
?>
