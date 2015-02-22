<?php

add_action('admin_init', 'custom_css');

function custom_css() {
  wp_enqueue_style('custom_css', get_bloginfo('template_directory') . '/assets/css/plugins/admin.css');
}


add_action( 'init', 'register_Property' );

function register_Property() {

    $labels = array(
        'name' => _x( 'Properties', 'Property' ),
        'singular_name' => _x( 'Properties', 'Property' ),
        'add_new' => _x( 'Add New', 'Property' ),
        'add_new_item' => _x( 'Add New Property', 'Property' ),
        'edit_item' => _x( 'Edit Property', 'Property' ),
        'new_item' => _x( 'New Property', 'Property' ),
        'view_item' => _x( 'View Property', 'Property' ),
        'search_items' => _x( 'Search Properties', 'Property' ),
        'not_found' => _x( 'No Properties found', 'Property' ),
        'not_found_in_trash' => _x( 'No Properties found in Trash', 'Property' ),
        'parent_item_colon' => _x( 'Parent Property:', 'Property' ),
        'menu_name' => _x( 'Properties', 'Property' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Custom post type for Properties',
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

    register_post_type( 'Property', $args );
}


function create_Property_taxonomy() {

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

    register_taxonomy('Property_category','Property', array(
        'label' => __('Property Category'),
        'labels' => $labels,
        'hierarchical' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'Property-category' ),
    ));

}

add_action( 'init', 'create_Property_taxonomy', 0 );



// 4. Show Meta-Box

add_action( 'admin_init', 'Properties_create' );

function Properties_create() {
    add_meta_box('Properties_meta', 'Property Info', 'Properties_meta', 'Property');
}

function Properties_meta () {

    // - grab data -

    global $post;
    $custom = get_post_custom($post->ID);
    // -- sort
    $vitals =  $custom["vitals"][0];
    // -- Property details
    $teaser  = $custom["teaser"][0];

    // - security -

    echo '<input type="hidden" name="Property-nonce" id="Property-nonce" value="' .
    wp_create_nonce( 'Property-nonce' ) . '" />';

    // - output -

    ?>
    <div class="tf-meta Property-meta">
        <h4>Property Details</h4>
        <ul>
          <li><label>Vitals:</label><input name="vitals" value="<?php echo $vitals; ?>" /></li>
          <li><label>Teaser:</label><input name="teaser" value="<?php echo $teaser; ?>" /></li>
        </ul>
    </div>
    <?php
}

// 5. Save Data

add_action ('save_post', 'save_Properties');

function save_Properties(){

    global $post;

    // - still require nonce

    // if ( !wp_verify_nonce( $_POST['Property-nonce'], 'Property-nonce' )) {
    //     return $post->ID;
    // }

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

add_filter('post_updated_messages', 'Property_updated_messages');

function Property_updated_messages( $messages ) {

  global $post, $post_ID;

  $messages['Property'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Property updated. <a href="%s">View item</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Property updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Property restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Property published. <a href="%s">View Property</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Property saved.'),
    8 => sprintf( __('Property submitted. <a target="_blank" href="%s">Preview Property</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Property scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Property</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Property draft updated. <a target="_blank" href="%s">Preview Property</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

?>
