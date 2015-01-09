<?php

add_action( 'init', 'create_photo_gallery_postype' );

function create_photo_gallery_postype() {

  $labels = array(
    'name' => _x( 'Photo Gallery', 'photo_gallery' ),
    'singular_name' => _x( 'Photo Gallery', 'photo_gallery' ),
    'add_new' => _x( 'New Photo Gallery', 'photo_gallery' ),
    'add_new_item' => _x( 'Add New Photo Gallery', 'photo_gallery' ),
    'edit_item' => _x( 'Edit Photo Gallery', 'photo_gallery' ),
    'new_item' => _x( 'New Photo Gallery', 'photo_gallery' ),
    'view_item' => _x( 'View Photo Gallery', 'photo_gallery' ),
    'search_items' => _x( 'Search Photo Gallery', 'photo_gallery' ),
    'not_found' => _x( 'No photo_gallery found', 'photo_gallery' ),
    'not_found_in_trash' => _x( 'No photo_gallery found in Trash', 'photo_gallery' ),
    'parent_item_colon' => _x( 'Parent Photo Gallery:', 'photo_gallery' ),
    'menu_name' => _x( 'Photo Gallery', 'photo_gallery' ),
  );

  $args = array(
    'label' => __('Photo Gallery'),
    'labels' => $labels,
    'public' => true,
    'can_export' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,

    '_builtin' => false,
    '_edit_link' => 'post.php?post=%d', // ?
    'capability_type' => 'post',
    'menu_icon' => get_bloginfo('template_url').'/assets/img/icons/icon-photo-admin.png',
    'hierarchical' => false,
    'rewrite' => true,
    'supports'=> array('title', 'thumbnail', 'editor') ,
    'show_in_nav_menus' => true,
    'taxonomies' => array( 'photo_gallery_category', 'post_tag')
  );

  register_post_type( 'photo_gallery', $args);

}


// 2. Custom Taxonomy Registration (Photo Gallery Types)

function create_photo_gallerycategory_taxonomy() {

    $labels = array(
        'name' => _x( 'Categories', 'photo_galleries' ),
        'singular_name' => _x( 'Category', 'photo_gallery' ),
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

    register_taxonomy('photo_gallerycategory','photo_gallery', array(
        'label' => __('Photo Gallery Category'),
        'labels' => $labels,
        'hierarchical' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'photo_gallery-category' ),
    ));

}

add_action( 'init', 'create_photo_gallerycategory_taxonomy', 0 );


// 5. Save Data

add_action ('save_post', 'save_photo_gallery');

function save_photo_gallery(){

    global $post;

    // - still require nonce

    // if ( !wp_verify_nonce( $_POST['photo_gallery-nonce'], 'photo_gallery-nonce' )) {
    //     return $post->ID;
    // }

    // if ( !current_user_can( 'edit_post', $post->ID ))
    //     return $post->ID;

}

?>
