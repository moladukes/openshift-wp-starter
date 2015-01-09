<div class="wrap fluid-container footer" role="document">
  <div class="container">
    <div class="content row">
      <div class="col-md-4">
        <h3>Join Our Mailing List</h3>
        <form>
          <div class="form-group">
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
          </div>
          <button action="submit" class="btn btn-primary">Join</button>
        </form>
        <br />
        <div class="mailing-list-social">
          <a href="facebook.com"><span class="icon facebook">facebook</span>facebook</a>
          <a href="facebook.com"><span class="icon twitter">twitter</span>twitter</a>
          <a href="facebook.com"><span class="icon instagram">instagram</span>instagram</a>
        </div>
      </div>
      <div class="col-md-4">
        <h3>Featured Wine</h3>
        <?php if ( is_active_sidebar( 'featured_wine' ) ) : ?>
        	<?php dynamic_sidebar( 'featured_wine' ); ?>
        <?php endif; ?>

      </div>
      <div class="col-md-4">
        <h3>Instagram</h3>
        <div id="instafeed"></div>
      </div>

    </div>

  </div><!-- /.content -->

      <div class="powered-by-night-out">
        <div class="container cf"><a href="http://events.nightout.com" class="nightout-events-logo" target="_blank">Night Out Events</a></div>
      </div>

</div><!-- /.wrap -->
