<header class="banner navbar navbar-default navbar-static-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    </div>

    <nav class="collapse navbar-collapse" role="navigation">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
        endif;
      ?>
    </nav>
  </div>
  <div class="header-icons">
    <a href="#" class="icon facebook">facebook</a>
    <a href="#" class="icon twitter">twitter</a>
    <a href="#" class="icon instagram">instagram</a>
    <span class="icon-divider">&#124;</span>
    <a href="#" class="icon ticket">ticket</a>
    <a href="/tickets" class="btn btn-primary"> Buy Tickets</a>
  </div>
</header>
