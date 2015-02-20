/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you
// rename this variable, you will also need to rename the namespace below.
var Roots = {
  // All pages
  common: {
    init: function() {
        // Hero Slider
        $(".hero-slider").owlCarousel({
          navigation : true, // Show next and prev buttons
          slideSpeed : 300,
          paginationSpeed : 300,
          singleItem: true
        });

        // Magnific Popup
        if ($.fn.magnificPopup) {

          $('.has-popup').magnificPopup({
        	  delegate: 'a',
        	  type:'image',
        	  gallery: {
        		  // options for gallery
        		  enabled: true,
        		  navigateByImgClick: true
        	  },
        	  callbacks: {

        		  elementParse: function(item) {

        			  var extension = item.src.split('.').pop();
        			  switch(extension) {
        			  case 'jpg':
        			  case 'png':
        			  case 'gif':
        			    item.type = 'image';
        			    break;
        			  case 'html':
        			    item.type = 'ajax';
        			    break;
        			  default:
        			    item.type = 'iframe';
        			  }
        		  },

          		buildControls: function() {
          		  // re-appends controls inside the main container
          		  this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
          		}
        	   },

            zoom: {
        		  enabled: true, // By default it's false, so don't forget to enable it
        		  duration: 300, // duration of the effect, in milliseconds
        		  easing: 'ease-in-out', // CSS transition easing function

        		// The "opener" function should return the element from which popup will be zoomed in
        		// and to which popup will be scaled down
        		// By defailt it looks for an image tag:
        		opener: function(openerElement) {
        		  // openerElement is the element on which popup was initialized, in this case its <a> tag
        		  // you don't need to add "opener" option if this code matches your needs, it's defailt one.
        		  return openerElement.is('img') ? openerElement : openerElement.find('img');
        		}}
        	});
        }
    }
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page
    }
  },
  // About us page, note the change from about-us to about_us.
  about_us: {
    init: function() {
      // JavaScript to be fired on the about us page
    }
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Roots;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
