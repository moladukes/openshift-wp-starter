<?php
/**
 * Roots includes
 *
 * The $roots_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/roots/pull/1042
 */
$roots_includes = array(
  'lib/utils.php',           // Utility functions
  'lib/init.php',            // Initial theme setup and constants
  'lib/wrapper.php',         // Theme wrapper class
  'lib/sidebar.php',         // Sidebar class
  'lib/config.php',          // Configuration
  'lib/activation.php',      // Theme activation
  'lib/titles.php',          // Page titles
  'lib/nav.php',             // Custom nav modifications
  'lib/gallery.php',         // Custom [gallery] modifications
  'lib/photo_gallery.php',   // Photo Gallery Lightbox
  'lib/property.php',        // Sponsors post type
  'lib/comments.php',        // Custom comments modifications
  'lib/scripts.php',         // Scripts and stylesheets
  'lib/extras.php',          // Custom functions
  'lib/widgets.php',         // Custom Widgets
);

foreach ($roots_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'roots'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


// Advanced Custom Forms
include_once(TEMPLATEPATH.'/plugin/advanced-custom-fields/acf.php');
include_once(TEMPLATEPATH.'/plugin/acf-repeater/acf-repeater.php');

// Custom Excerpt length

function blog_excerpt($string, $limit) {
  $words = explode(' ', $string);
  return implode(' ', array_slice($words, 0, $limit));
}

// CUSTOM LOGIN CSS INJECTION

function my_login_logo() { ?>
    <style type="text/css">
        body {
          background: #fff;
          font-family: "Proxima Nova","Open Sans","Gill Sans MT","Gill Sans",Corbel,Arial,sans-serif;
        }
        body.login div#login h1 a {
          background-image: none;
          text-indent: 0;
          width: auto;
          height: auto;
          color: #000;
        }
        body.login form {
          background: #f9f9f9;
        }
        body.login form label {
          color: #000;
          font-weight: normal;
        }
        body.login #login .wp-core-ui .button-primary {
          background: #ec0257;
          border-color: #ec0257;
        }
        #login:after {
          content: "Powered by NIGHT OUT";
          display: block;
          position: relative;
          width: 100%;
          text-align: center;
          margin-top: 20px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// Change Howdy
add_filter('gettext', 'change_howdy', 10, 3);

function change_howdy($translated, $text, $domain) {

    if (!is_admin() || 'default' != $domain)
        return $translated;

    if (false !== strpos($translated, 'Howdy'))
        return str_replace('Howdy', 'Welcome', $translated);

    return $translated;
}


// Change footer text
function change_footer_admin () {

  echo 'Night Out WP Admin';

}

add_filter('admin_footer_text', 'change_footer_admin');


// Replace admin logo
function admin_css() { ?>
    <style type="text/css">
      #wp-admin-bar-wp-logo {
        display: none;
      }
    </style>
<?php }

add_action('admin_head','admin_css');
