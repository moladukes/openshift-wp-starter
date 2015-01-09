<div class="container">
  <?php get_template_part('templates/page', 'header'); ?>
  <div class="content page cf">

      <?php while (have_posts()) : the_post(); ?>

        <?php $parent_link = get_permalink($post->post_parent); ?>

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
      <?php endwhile;
    ?>
  </div>
</div>
