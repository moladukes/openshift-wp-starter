<?php

/**
 * Custom Sidebar Widget.
 *
 */
function sidebar_widgets() {

	register_sidebar( array(
		'name' => 'Featured Wine',
		'id' => 'featured_wine',
		'before_widget' => '<div class="sidebar-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="sidebar-widget-title">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'sidebar_widgets' );


/* IMAGE UPLOADER */

class Sidebar_Widget extends WP_Widget
{

  public function __construct()
  {
    parent::__construct(
      'sidebar-widget',
      'Featured Wine',
      array(
        'description' => 'Add a featured winery to your footer'
      )
    );
  }

  public function widget( $args, $instance )
  {
    $has_title = $instance['text'];
    $has_copy = $instance['copy'];
    $has_image = $instance['image_uri'];
    $has_link = $instance['link'];
    $has_link_text = $instance['link_text'];

    if($has_title || $has_copy || $has_image || $has_link) {
      echo '<div class="row">';
        echo '<div class="col-md-6">';
          if($has_link) {
            echo '<a href="'.esc_url($instance['link']).'" >';
          }
          if($has_image) {
            echo '<img src="'.esc_url($instance['image_uri']).'" />';
          }
          if($has_link) {
            echo '</a>';
          }
        echo '</div>';
        echo '<div class="col-md-6">';
          if($has_title) {
            echo '<p>'.esc_html($instance['text']).'</p>';
          }
          if($has_copy) {
            echo '<p class="small">'.esc_html($instance['copy']).'</p>';
          }
          if($has_link_text && $has_link) {
            echo '<a href="'.esc_url($instance['link']).'" class="btn btn-sm btn-primary" >'.esc_html($instance['link_text']).'</a>';
          }
        echo '</div>';
      echo '</div>';
    }
  }

  public function form( $instance )
  {
    // removed the for loop, you can create new instances of the widget instead
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('text'); ?>">Title</label><br />
      <input type="text" name="<?php echo $this->get_field_name('text'); ?>" id="<?php echo $this->get_field_id('text'); ?>" value="<?php echo $instance['text']; ?>" class="widefat" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('copy'); ?>">Text</label><br />
      <input type="textfield" name="<?php echo $this->get_field_name('copy'); ?>" id="<?php echo $this->get_field_id('copy'); ?>" value="<?php echo $instance['copy']; ?>" class="widefat" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('link'); ?>">Link Url</label><br />
      <input type="text" name="<?php echo $this->get_field_name('link'); ?>" id="<?php echo $this->get_field_id('link'); ?>" value="<?php echo $instance['link']; ?>" class="widefat" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('link_text'); ?>">Link Text</label><br />
      <input type="text" name="<?php echo $this->get_field_name('link_text'); ?>" id="<?php echo $this->get_field_id('link_text'); ?>" value="<?php echo $instance['link_text']; ?>" class="widefat" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('image_uri'); ?>">Image</label><br />
      <input type="text" class="img" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $instance['image_uri']; ?>" />
      <input type="button" class="select-img" value="Select Image" />
    </p>
    <?php
  }


}
// end class

// init the widget
add_action( 'widgets_init', create_function('', 'return register_widget("Sidebar_Widget");') );

// queue up the necessary js
function hrw_enqueue($hook) {

if( $hook != 'widgets.php' )
    return;

  wp_enqueue_style('thickbox');
  wp_enqueue_script('media-upload');
  wp_enqueue_script('thickbox');
  // I also changed the path, since I was using it directly from my theme and not as a plugin
  wp_enqueue_script('hrw', get_template_directory_uri() . '/plugin/widgets/widgets.js', null, null, true);
}
add_action('admin_enqueue_scripts', 'hrw_enqueue');
