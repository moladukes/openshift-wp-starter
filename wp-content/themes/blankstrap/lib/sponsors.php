<?php

add_action('admin_init', 'custom_css');

function custom_css() {
  wp_enqueue_style('custom_css', get_bloginfo('template_directory') . '/assets/css/plugins/admin.css');
}


add_action( 'init', 'register_sponsor' );

function register_sponsor() {

    $labels = array(
        'name' => _x( 'Sponsors', 'sponsor' ),
        'singular_name' => _x( 'Sponsors', 'sponsor' ),
        'add_new' => _x( 'Add New', 'sponsor' ),
        'add_new_item' => _x( 'Add New Sponsor', 'sponsor' ),
        'edit_item' => _x( 'Edit Sponsor', 'sponsor' ),
        'new_item' => _x( 'New Sponsor', 'sponsor' ),
        'view_item' => _x( 'View Sponsor', 'sponsor' ),
        'search_items' => _x( 'Search Sponsors', 'sponsor' ),
        'not_found' => _x( 'No Sponsors found', 'sponsor' ),
        'not_found_in_trash' => _x( 'No Sponsors found in Trash', 'sponsor' ),
        'parent_item_colon' => _x( 'Parent Sponsor:', 'sponsor' ),
        'menu_name' => _x( 'Sponsors', 'sponsor' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Custom post type for sponsors',
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

    register_post_type( 'sponsor', $args );
}


function create_sponsor_taxonomy() {

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

    register_taxonomy('sponsor_category','sponsor', array(
        'label' => __('Sponsor Category'),
        'labels' => $labels,
        'hierarchical' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'sponsor-category' ),
    ));

}

add_action( 'init', 'create_sponsor_taxonomy', 0 );



// 4. Show Meta-Box

add_action( 'admin_init', 'sponsors_create' );

function Sponsors_create() {
    add_meta_box('sponsors_meta', 'sponsor Info', 'sponsors_meta', 'sponsor');
}

function Sponsors_meta () {

    // - grab data -

    global $post;
    $custom = get_post_custom($post->ID);
    // -- sort
    $order =  $custom["order"][0];
    // -- sponsor details
    $url  = $custom["url"][0];

    // - security -

    echo '<input type="hidden" name="sponsor-nonce" id="sponsor-nonce" value="' .
    wp_create_nonce( 'sponsor-nonce' ) . '" />';

    // - output -

    ?>
    <div class="tf-meta sponsor-meta">
        <h4>Sponsor Sort Order</h4>
        <ul>
          <li><label>Order:</label><input name="order" value="<?php echo $order; ?>" /></li>
        </ul>
        <h4>Sponsor Information</h4>
        <ul>
            <li><label>Website:</label><input name="url" value="<?php echo $url; ?>" /></li>
        </ul>
    </div>

    <?php
}

// 5. Save Data

add_action ('save_post', 'save_sponsors');

function save_Sponsors(){

    global $post;

    // - still require nonce

    // if ( !wp_verify_nonce( $_POST['sponsor-nonce'], 'sponsor-nonce' )) {
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

add_filter('post_updated_messages', 'sponsor_updated_messages');

function sponsor_updated_messages( $messages ) {

  global $post, $post_ID;

  $messages['sponsor'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('sponsor updated. <a href="%s">View item</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('sponsor updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('sponsor restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('sponsor published. <a href="%s">View sponsor</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('sponsor saved.'),
    8 => sprintf( __('sponsor submitted. <a target="_blank" href="%s">Preview sponsor</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('sponsor scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview sponsor</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('sponsor draft updated. <a target="_blank" href="%s">Preview sponsor</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

?>
