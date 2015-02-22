<?php if( have_rows('content_blocks')): ?>
  <?php while (have_rows('content_blocks')) : the_row(); ?>

    <!-- /////////// Block -->
    <?php if (have_rows('content_block')): ?>
      <div class="wrap fluid-container content-block" role="document">
        <div class="container">
          <div class="content row">
            <?php while (have_rows('content_block')) : the_row(); ?>
              <div class="hero-intro" <?php if ( get_sub_field('content_anchor') ) { echo 'id="' . the_sub_field('content_anchor') . '"'; } ?>>
                <h1><?php the_sub_field('content_title') ?></h1>
                <?php the_sub_field('content'); ?>

                <?php if (get_sub_field('ticket_url')) {
                  echo '<iframe src="https://embed.' . get_sub_field('ticket_url') . '" width="100%" height="620" frameborder="0" border="0" name="Crown the Town"></iframe>';
                } ?>
              </div>
            <?php endwhile; ?>
          </div>
        </div><!-- /.content -->
      </div><!-- /.wrap -->
    <?php endif; ?>


    <?php if (have_rows('two_blocks')): ?>
      <!-- Two Blocks -->
      <div class="wrap fluid-container content-block" role="document">
        <div class="container">
          <div class="content row">
            <?php while (have_rows('two_blocks')) : the_row(); ?>
              <div class="col-md-6">
                <?php if (get_sub_field('block_content')) : ?>
                  <?php the_sub_field('block_content') ?>
                <?php endif ?>
              </div>
            <?php endwhile; ?>
          </div>
        </div><!-- /.content -->
      </div><!-- /.wrap -->
    <?php endif; ?>



    <?php if (have_rows('two_columns')): ?>
      <!-- Two Columns -->
      <div class="wrap fluid-container content-block" role="document">
        <div class="container">
          <div class="content row">
            <?php while (have_rows('two_columns')) : the_row(); ?>

              <?php
                if ( get_sub_field('item_link') ) :
                  $two_link_url = get_sub_field('item_link');
                elseif( get_sub_field('external_link') ) :
                  $two_link_url = get_sub_field('external_link');
                endif;
              ?>

              <div class="col col-md-6">
                <?php if (get_sub_field('item_image')) : ?>

                  <?php $image = get_sub_field('item_image'); ?>
                  <div class="col-thumb-wrap">
                    <?php if (isset($two_link_url)) : ?>
                      <a href="<?php echo $two_link_url ?>" class="thumb" style="background-image: url('<?php echo $image['sizes'][ 'large' ]; ?>');"></a>
                    <?php else : ?>
                      <div class="thumb" style="background-image: url('<?php echo $image['sizes'][ 'large' ]; ?>');"></div>
                    <?php endif ?>
                  </div>

                <?php endif; ?>
                <?php if (get_sub_field('item_title')) : ?>
                  <h2 class="col-title"><?php the_sub_field('item_title') ?></h2>
                <?php endif; ?>
                <?php if (get_sub_field('item_teaser')) : ?>
                  <p><?php the_sub_field('item_teaser') ?></p>
                <?php endif ?>

                <?php if (isset($two_link_url) && get_sub_field('item_link_text') ) : ?>
                  <a class="btn btn-primary" href="<?php echo $two_link_url ?>"><?php the_sub_field('item_link_text'); ?></a>
                <?php endif ?>
              </div>
            <?php endwhile; ?>
          </div>
        </div><!-- /.content -->
      </div><!-- /.wrap -->
    <?php endif; ?>


    <?php if (have_rows('three_columns')): ?>
      <!-- Three Columns -->
      <div class="wrap fluid-container content-block" role="document">
        <div class="container">
          <div class="content row">
            <?php while (have_rows('three_columns')) : the_row(); ?>

              <?php
                if ( get_sub_field('item_link') ) :
                  $three_link_url = get_sub_field('item_link');
                elseif( get_sub_field('external_link') ) :
                  $three_link_url = get_sub_field('external_link');
                endif;
              ?>

              <div class="col col-md-4">
                <?php if (get_sub_field('item_title')) : ?>
                  <h2 class="col-title"><?php the_sub_field('item_title') ?></h2>
                <?php endif; ?>
                <?php if (get_sub_field('item_image')) : ?>

                  <?php $image = get_sub_field('item_image'); ?>
                  <div class="col-thumb-wrap">
                    <?php if (isset($three_link_url)) : ?>
                      <a href="<?php echo $three_link_url ?>" class="thumb" style="background-image: url('<?php echo $image['sizes'][ 'thumbnail' ]; ?>');"></a>
                    <?php else : ?>
                      <div class="thumb thumb-medium" style="background-image: url('<?php echo $image['sizes'][ 'medium' ]; ?>');"></div>
                    <?php endif ?>
                  </div>

                <?php endif; ?>
                <?php if (get_sub_field('item_teaser')) : ?>
                  <p><?php the_sub_field('item_teaser') ?></p>
                <?php endif ?>

                <?php if (isset($three_link_url) && get_sub_field('item_link_text') ) : ?>
                  <a class="btn btn-primary" href="<?php echo $three_link_url ?>"><?php the_sub_field('item_link_text'); ?></a>
                <?php endif ?>
              </div>
            <?php endwhile; ?>
          </div>
        </div><!-- /.content -->
      </div><!-- /.wrap -->
    <?php endif; ?>


    <?php if (have_rows('four_columns')): ?>
      <!-- Four Columns -->
      <div class="wrap fluid-container content-block content-block-four" role="document">
        <div class="container">
          <div class="content row">
            <?php while (have_rows('four_columns')) : the_row(); ?>

              <?php
                if ( get_sub_field('item_link') ) :
                  $four_link_url = get_sub_field('item_link');
                elseif( get_sub_field('external_link') ) :
                  $four_link_url = get_sub_field('external_link');
                endif;
              ?>

              <div class="col col-md-3">


                <?php if (get_sub_field('item_image')) : ?>

                  <?php $image = get_sub_field('item_image'); ?>
                  <div class="col-thumb-wrap">
                    <?php if (isset($four_link_url)) : ?>
                      <a href="<?php echo $four_link_url ?>" class="thumb" style="background-image: url('<?php echo $image['sizes'][ 'thumbnail' ]; ?>');"></a>
                    <?php else : ?>
                      <div class="thumb thumb-medium" style="background-image: url('<?php echo $image['sizes'][ 'medium' ]; ?>');"></div>
                    <?php endif ?>
                  </div>

                <?php endif; ?>

                <?php if (get_sub_field('item_title')) : ?>
                  <h2 class="col-title"><?php the_sub_field('item_title') ?></h2>
                <?php endif; ?>
                <?php if (get_sub_field('item_teaser')) : ?>
                  <p><?php the_sub_field('item_teaser') ?></p>
                <?php endif ?>

                <?php if (isset($four_link_url) && get_sub_field('item_link_text') ) : ?>
                  <a class="btn btn-primary" href="<?php echo $four_link_url ?>"><?php the_sub_field('item_link_text'); ?></a>
                <?php endif ?>
              </div>
            <?php endwhile; ?>
          </div>
        </div><!-- /.content -->
      </div><!-- /.wrap -->
    <?php endif; ?>



  <?php endwhile; ?>
<? endif ?>
