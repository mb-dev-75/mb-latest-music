<?php
  function mb_latest_music_add_scripts() {
    // CSS
    wp_enqueue_style('mb-latest-music', plugins_url(). '/mb-latest-music/includes/assets/css/mb-latest-music.css', NULL, false);
    // JS
    wp_enqueue_script('wavesurfer', 'https://unpkg.com/wavesurfer.js@5.0.1/dist/wavesurfer.js', array('jquery'), '5.0.1', false);

    if(is_page()) {
      global $wp_query;
      $template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
	    if($template_name == 'template-frontpage.php'){
        wp_enqueue_script('main-latest-music', plugins_url(). '/mb-latest-music/includes/assets/js/main.js', array('jquery'), NULL, false);
		  }
    }
  }

  add_action('wp_enqueue_scripts', 'mb_latest_music_add_scripts');

  // Loading scripts for dashboard
  add_action('admin_enqueue_scripts', function() {
    // Check if current page is widgets.php
    global $pagenow;
    if ( $pagenow == 'widgets.php' ) {
      wp_enqueue_media();
      wp_enqueue_script('up-img', plugins_url(). '/mb-latest-music/includes/assets/js/media_upload.js', array('jquery'), NULL, true);
    }
  });
