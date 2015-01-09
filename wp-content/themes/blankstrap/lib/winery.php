<?php

// add_action('admin_init', 'custom_css');
//
// function custom_css() {
//   wp_enqueue_style('custom_css', get_bloginfo('template_directory') . '/assets/css/plugins/admin.css');
// }


add_action( 'init', 'register_winery' );

function register_winery() {

    $labels = array(
        'name' => _x( 'Winery', 'winery' ),
        'singular_name' => _x( 'Winery', 'winery' ),
        'add_new' => _x( 'Add New', 'winery' ),
        'add_new_item' => _x( 'Add New Winery', 'winery' ),
        'edit_item' => _x( 'Edit Winery', 'winery' ),
        'new_item' => _x( 'New Winery', 'winery' ),
        'view_item' => _x( 'View Winery', 'winery' ),
        'search_items' => _x( 'Search Wineries', 'winery' ),
        'not_found' => _x( 'No Wineries found', 'winery' ),
        'not_found_in_trash' => _x( 'No Wineries found in Trash', 'winery' ),
        'parent_item_colon' => _x( 'Parent Winery:', 'winery' ),
        'menu_name' => _x( 'Wineries', 'winery' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Custom post type for wineries',
        'supports' => array( 'title', 'editor', 'thumbnail' ),

        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,


        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'winery', $args );
}


function create_winery_taxonomy() {

    $labels = array(
        'name' => _x( 'Categories', 'taxonomy general name' ),
        'singular_name' => _x( 'Category', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Categories' ),
        'popular_items' => __( 'Popular Categories' ),
        'all_items' => __( 'All Categories' ),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __( 'Edit Category' ),
        'update_item' => __( 'Update Category' ),
        'add_new_item' => __( 'Add New Category' ),
        'new_item_name' => __( 'New Category Name' ),
        'separate_items_with_commas' => __( 'Separate categories with commas' ),
        'add_or_remove_items' => __( 'Add or remove categories' ),
        'choose_from_most_used' => __( 'Choose from the most used categories' ),
    );

    register_taxonomy('winery_category','winery', array(
        'label' => __('Winery Category'),
        'labels' => $labels,
        'hierarchical' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'winery-category' ),
    ));

}

add_action( 'init', 'create_winery_taxonomy', 0 );



// 4. Show Meta-Box

add_action( 'admin_init', 'winery_create' );

function winery_create() {
    add_meta_box('winery_meta', 'winery info', 'winery_meta', 'winery');
}

function winery_meta () {

    // - grab data -

    global $post;
    $custom = get_post_custom($post->ID);
    // -- sort
    $order =  $custom["order"][0];
    // -- winery details
    $url  = $custom["url"][0];

    // - security -

    echo '<input type="hidden" name="winery-nonce" id="winery-nonce" value="' .
    wp_create_nonce( 'winery-nonce' ) . '" />';

    // - output -

    ?>
    <div class="tf-meta winery-meta">
        <h4>Winery Sort Order</h4>
        <ul>
          <li><label>Order:</label><input name="order" value="<?php echo $order; ?>" /></li>
        </ul>
        <h4>Winery Information</h4>
        <ul>
            <li><label>Website:</label><input name="url" value="<?php echo $url; ?>" /></li>
        </ul>
    </div>

    <?php
}

// 5. Save Data

add_action ('save_post', 'save_winery');

function save_winery(){

    global $post;

    // - still require nonce

    // if ( !wp_verify_nonce( $_POST['winery-nonce'], 'winery-nonce' )) {
    //     return $post->ID;
    // }
    //
    // if ( !current_user_can( 'edit_post', $post->ID ))
    //     return $post->ID;

    if(!isset($_POST["order"])):
      return $post;
      endif;
      update_post_meta($post->ID, "order", $_POST["order"] );

    if(!isset($_POST["url"])):
        return $post;
        endif;
        update_post_meta($post->ID, "url", $_POST["url"] );

}

add_filter('post_updated_messages', 'winery_updated_messages');

function winery_updated_messages( $messages ) {

  global $post, $post_ID;

  $messages['winery'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('winery updated. <a href="%s">View item</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('winery updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('winery restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('winery published. <a href="%s">View winery</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('winery saved.'),
    8 => sprintf( __('winery submitted. <a target="_blank" href="%s">Preview winery</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('winery scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview winery</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('winery draft updated. <a target="_blank" href="%s">Preview winery</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

?>
