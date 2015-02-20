<?php get_template_part( 'templates/slider' ); ?>

<?php if (get_template_part('templates/content', 'page')) { ?>
  <div class="wrap container" role="document">
    <div class="content row">
      <main class="main home-main" role="main">
        <div class="hero-intro">
          <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('templates/content', 'page'); ?>
          <?php endwhile; ?>
        </div>
      </main><!-- /.main -->
    </div><!-- /.content -->
  </div><!-- /.wrap -->
<? } ?>

<?php get_template_part( 'templates/blocks' ); ?>
