<?php
/*
Template Name: Two Column
*/
?>

<?php get_template_part( 'templates/slider' ); ?>

<div class="wrap container" role="document">
  <div class="content row">
    <div class="col-md-4">


        <?php if (get_field('sidebar_title')) { ?>
          <h3><?php the_field('sidebar_title') ?></h3>
        <?php } ?>

        <?php if (get_field('sidebar_link')) { ?>
          <?php the_field('sidebar_content'); ?>
        <?php } ?>

        <?php if (get_field('sidebar_link')) { ?>
          <a href="<?php the_field('sidebar_link') ?>" class="btn btn-primary"><?php the_field('sidebar_link_text') ?></a>
        <?php } ?>


        <h3>All <?php the_title(''); ?></h3>
        <ul class="two-col-list">
          <?php
            global $post;
            $current_page_parent = ( $post->post_parent ? $post->post_parent : $post->ID );

            wp_list_pages( array(
                 'title_li' => '',
                 'child_of' => $current_page_parent,
                 'depth' => '1' )
            );
          ?>
        </ul>

    </div>

    <div class="col-md-8">

      <?php if ( has_post_thumbnail() ) { ?>
        <div class="two-column-feature"><?php the_post_thumbnail(); ?></div>
      <?php } ?>

      <?php echo strip_shortcodes(get_post_field('post_content', $post->ID)); ?>
      <div class="gallery-row row cf">
        <?php
          $gallery = get_post_gallery_images( $post );
          foreach( $gallery as $image )  {
            ?>
            <?php $lrg_image = preg_replace('/-\d+x\d+/','', $image) ?>
              <div class="col-md-3 gallery-thumb has-popup">
                <a href="<?php echo $lrg_image; ?>">
                  <img src="<?php echo $image; ?>" alt="<?php echo wptexturize($image->post_excerpt); ?>" />
                </a>
              </div>
            <?php
          }
        ?>
      </div>

    </div>

  </div>
</div>


<?php get_template_part( 'templates/blocks' ); ?>
