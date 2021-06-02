<?php
/**
 * Adds mb_latest_Music_Widget widget.
 */
class mb_Latest_Music_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'mb-latest-music_widget', esc_html__( 'MB Latest Music', 'mb_domain' ),
			array( 'description' => esc_html__( 'Share a track from your latest musical project', 'mb_domain' ), )
    );
  }

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
    $cover = $instance['image_uri'];
    $title = $instance['track_title'];
    $artist = $instance['track_artist'];
    $album = $instance['album_title'];
    $uri = $instance['audio_uri'];
    $apple = $instance['uri_apple'];
    $spotify = $instance['uri_spotify'];
    $bandcamp = $instance['uri_bandcamp'];
    $deezer = $instance['uri_deezer'];

    echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    }
  ?>
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-lm-cover">
          <img src="<?php echo $cover; ?>" alt="cover"/>
          <div class="mb-lm-overlay">
            <svg class="svg-button" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24">
              <g class="svg-play">
                <path d="M12,2C6.48,2,2,6.48,2,12s4.48,10,10,10s10-4.48,10-10S17.52,2,12,2z M9.5,16.5v-9l7,4.5L9.5,16.5z"/>
              </g>
              <g class="svg-pause">
                <path d="M12,2C6.48,2,2,6.48,2,12s4.48,10,10,10s10-4.48,10-10S17.52,2,12,2z M11,16H9V8h2V16z M15,16h-2V8h2V16z"/>
              </g>
            </svg>
          </div>
        </div>
        <div class="col-md-8 mb-lm-player">
          <!-- Track details -->
          <div class="mb-lm-play-title">
            <p class="mb-lm-track-title"><?php echo $title; ?></p>
            <p class="mb-lm-album-title">from "<?php echo $album; ?>"</p>
            <p class="mb-lm-track-artist"><?php echo $artist; ?></p>
          </div>
          <!-- Wave -->
          <div class="mb-lm-wave">
            <span class="waveform__counter"></span>
            <div id="waveform"></div>
            <span class="waveform__duration"></span>
          </div>
          <div class="mb-lm-buy-stream">
            <div class="row">
              <!-- Apple icon link -->
              <?php if ( ! empty( $apple ) ): ?>
                <div class="col-md-3 col-xs-3">
                  <a href="<?php echo $apple; ?>" class="mb-lm-buy-sticker apple" target="_blank" rel="noopener noreferrer">
                  </a>
                </div>
              <?php endif; ?>
              <!-- Spotify icon link -->
              <?php if ( ! empty( $spotify ) ): ?>
                <div class="col-md-3 col-xs-3">
                  <a href="<?php echo $spotify; ?>" class="mb-lm-buy-sticker spotify" target="_blank" rel="noopener noreferrer">
                  </a>
                </div>
              <?php endif; ?>
              <!-- Bandcamp icon link -->
              <?php if ( ! empty( $bandcamp ) ): ?>
                <div class="col-md-3 col-xs-3">
                  <a href="<?php echo $bandcamp; ?>" class="mb-lm-buy-sticker bandcamp" target="_blank" rel="noopener noreferrer">
                  </a>
                </div>
              <?php endif; ?>
              <!-- Deezer icon link -->
              <?php if ( ! empty( $deezer ) ): ?>
                <div class="col-md-3 col-xs-3">
                  <a href="<?php echo $deezer; ?>" class="mb-lm-buy-sticker deezer" target="_blank" rel="noopener noreferrer">
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      var url = "<?php echo $instance['audio_uri'] ?>";
    </script>

    <?php
    echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New album !', 'mb_domain' );
		$track_artist = ! empty( $instance['track_artist'] ) ? $instance['track_artist'] : '';
		$track_title = ! empty( $instance['track_title'] ) ? $instance['track_title'] : '';
		$album_title = ! empty( $instance['album_title'] ) ? $instance['album_title'] : '';
    $image_uri = !empty( $instance['image_uri'] ) ? $instance['image_uri'] : '';
    $img_field_id = $this->get_field_id( 'image_uri' );
    $audio_uri = !empty( $instance['audio_uri'] ) ? $instance['audio_uri'] : '';
    $audio_f_id = $this->get_field_id( 'audio_uri' );
		$uri_apple = ! empty( $instance['uri_apple'] ) ? $instance['uri_apple'] : '';
		$uri_spotify = ! empty( $instance['uri_spotify'] ) ? $instance['uri_spotify'] : '';
		$uri_bandcamp = ! empty( $instance['uri_bandcamp'] ) ? $instance['uri_bandcamp'] : '';
		$uri_deezer = ! empty( $instance['uri_deezer'] ) ? $instance['uri_deezer'] : '';

		?>
    <!-- Title -->
		<p>
		  <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
        <?php esc_attr_e( 'Title:', 'mb_domain' ); ?>
      </label>
		  <input
        class="widefat"
        type="text"
        id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
        value="<?php echo esc_attr( $title ); ?>">
		</p>
    <!-- Track Artist -->
		<p>
		  <label for="<?php echo esc_attr( $this->get_field_id( 'track_artist' ) ); ?>">
        <?php esc_attr_e( 'Artist:', 'mb_domain' ); ?>
      </label>
		  <input
        class="widefat"
        type="text"
        id="<?php echo esc_attr( $this->get_field_id( 'track_artist' ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'track_artist' ) ); ?>"
        value="<?php echo esc_attr( $track_artist ); ?>">
		</p>
    <!-- Track Title -->
		<p>
		  <label for="<?php echo esc_attr( $this->get_field_id( 'track_title' ) ); ?>">
        <?php esc_attr_e( 'Track Title:', 'mb_domain' ); ?>
      </label>
		  <input
        class="widefat"
        type="text"
        id="<?php echo esc_attr( $this->get_field_id( 'track_title' ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'track_title' ) ); ?>"
        value="<?php echo esc_attr( $track_title ); ?>">
		</p>
    <!-- Album Title -->
		<p>
		  <label for="<?php echo esc_attr( $this->get_field_id( 'album_title' ) ); ?>">
        <?php esc_attr_e( 'Album Title:', 'mb_domain' ); ?>
      </label>
		  <input
        class="widefat"
        type="text"
        id="<?php echo esc_attr( $this->get_field_id( 'album_title' ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'album_title' ) ); ?>"
        value="<?php echo esc_attr( $album_title ); ?>">
		</p>
    <!-- Image Uploader -->
    <p>
      <label for="<?php echo $img_field_id ?>">Image:</label><br/>
      <input
        class="upload_image"
        type="hidden"
        id="<?php echo $img_field_id ?>"
        name="<?php echo $this->get_field_name( 'image_uri' ) ?>"
        value="<?php echo $image_uri; ?>"
      />
      <input
        class="upload_image_button"
        type="button"
        id="<?php echo $img_field_id ?>_button"
        value="Upload Image"
        data-field-id="<?php echo $img_field_id ?>"
      />
    </p>
    <div id="<?php echo $img_field_id ?>_img" class="upload_wrapper">
      <?php if ( !empty( $image_uri ) ) { ?>
        <img style="width: 100%;" src="<?php echo $image_uri ?>" alt=""/>
      <?php } ?>
    </div>
    <!-- Audio Uploader -->
   <p>
      <label for="<?php echo $audio_f_id ?>">Track:</label><br/>
      <input
        class="upload_audio"
        type="hidden"
        id="<?php echo $audio_f_id ?>"
        name="<?php echo $this->get_field_name( 'audio_uri' ) ?>"
        value="<?php echo $audio_uri; ?>"
      />
      <input
        class="upload_audio_button"
        type="button"
        id="<?php echo $audio_f_id ?>_button"
        value="Upload Track"
        data-f-id="<?php echo $audio_f_id ?>"
      />
    </p>
    <div id="<?php echo $audio_f_id ?>_audio" class="upload_wrapper">
      <?php if ( !empty( $audio_uri ) ) { ?>
        <input class="widefat" type="text" value="<?php echo $audio_uri ?>" />
      <?php } ?>
    </div>
    <!-- Apple Music Link -->
		<p>
		  <label for="<?php echo esc_attr( $this->get_field_id( 'uri_apple' ) ); ?>">
        <?php esc_attr_e( 'Apple Music Link :', 'mb_domain' ); ?>
      </label>
		  <input
        class="widefat"
        type="text"
        id="<?php echo esc_attr( $this->get_field_id( 'uri_apple' ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'uri_apple' ) ); ?>"
        placeholder="https://music.apple.com/fr/xxx"
        value="<?php echo esc_attr( $uri_apple ); ?>">
    </p>
    <!-- Spotify Link -->
		<p>
		  <label for="<?php echo esc_attr( $this->get_field_id( 'uri_spotify' ) ); ?>">
        <?php esc_attr_e( 'Spotify Link:', 'mb_domain' ); ?>
      </label>
		  <input
        class="widefat"
        type="text"
        id="<?php echo esc_attr( $this->get_field_id( 'uri_spotify' ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'uri_spotify' ) ); ?>"
        placeholder="https://open.spotify.com/xxx"
        value="<?php echo esc_attr( $uri_spotify ); ?>">
    </p>
    <!-- Bandcamp -->
		<p>
		  <label for="<?php echo esc_attr( $this->get_field_id( 'uri_bandcamp' ) ); ?>">
        <?php esc_attr_e( 'Bandcamp Link:', 'mb_domain' ); ?>
      </label>
		  <input
        class="widefat"
        type="text"
        id="<?php echo esc_attr( $this->get_field_id( 'uri_bandcamp' ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'uri_bandcamp' ) ); ?>"
        placeholder="https://xxx.bandcamp.com/"
        value="<?php echo esc_attr( $uri_bandcamp ); ?>">
    </p>
    <!-- Deezer -->
		<p>
		  <label for="<?php echo esc_attr( $this->get_field_id( 'uri_deezer' ) ); ?>">
        <?php esc_attr_e( 'Deezer Link:', 'mb_domain' ); ?>
      </label>
		  <input
        class="widefat"
        type="text"
        id="<?php echo esc_attr( $this->get_field_id( 'uri_deezer' ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'uri_deezer' ) ); ?>"
        placeholder="https://www.deezer.com/fr/album/xxx"
        value="<?php echo esc_attr( $uri_deezer ); ?>">
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
    $instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['track_artist'] = ( ! empty( $new_instance['track_artist'] ) ) ? sanitize_text_field( $new_instance['track_artist'] ) : '';
		$instance['track_title'] = ( ! empty( $new_instance['track_title'] ) ) ? sanitize_text_field( $new_instance['track_title'] ) : '';
		$instance['album_title'] = ( ! empty( $new_instance['album_title'] ) ) ? sanitize_text_field( $new_instance['album_title'] ) : '';
    $instance['image_uri'] = ( ! empty( $new_instance['image_uri'] ) ) ? sanitize_text_field( $new_instance['image_uri'] ) : '';
    $instance['audio_uri'] = ( ! empty( $new_instance['audio_uri'] ) ) ? sanitize_text_field( $new_instance['audio_uri'] ) : '';
		$instance['uri_apple'] = ( ! empty( $new_instance['uri_apple'] ) ) ? sanitize_text_field( $new_instance['uri_apple'] ) : '';
		$instance['uri_spotify'] = ( ! empty( $new_instance['uri_spotify'] ) ) ? sanitize_text_field( $new_instance['uri_spotify'] ) : '';
		$instance['uri_bandcamp'] = ( ! empty( $new_instance['uri_bandcamp'] ) ) ? sanitize_text_field( $new_instance['uri_bandcamp'] ) : '';
		$instance['uri_deezer'] = ( ! empty( $new_instance['uri_deezer'] ) ) ? sanitize_text_field( $new_instance['uri_deezer'] ) : '';
		return $instance;
  }
}
