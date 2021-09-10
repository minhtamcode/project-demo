<?php

add_action('widgets_init', 'load_theme_widgets');

function load_theme_widgets() {
  //register_widget('themeworm_flickr');
	register_widget('themeworm_recent_posts');
	register_widget('themeworm_social');
  register_widget('themeworm_social_menu');
	register_widget('themeworm_author');
	register_widget('themeworm_contacts');
	register_widget('themeworm_map');
	register_widget('themeworm_recent_portfolio');
}

class themeworm_recent_posts extends WP_Widget {

  function __construct() {
    $widget_ops = array('classname' => 'tw-recent-posts', 'description' => 'Recent posts');
    $control_ops = array('width' => 300);
    parent::__construct('themeworm_recent_posts', '--- Recent Posts ---', $widget_ops, $control_ops);
  }

	function form($instance) {
    $instance = wp_parse_args((array) $instance, array('title' => ''));
    $title = strip_tags($instance['title']);
    $count = !isset($instance['count']) ?: $instance['count']; ?>

    <p>
      <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Widget Title:
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
      </label>
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('count')); ?>">How many items show, only number 1-9:
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr($count); ?>" />
      </label>
    </p>

<?php }

  function widget($args, $instance) {
    extract($args, EXTR_SKIP);
    echo $args['before_widget'];

    $title = apply_filters( 'widget_title', $instance['title'] );
    $count = $instance['count'];

    if ( $title ) echo $args['before_title'] . esc_html( $title ) . $args['after_title']; ?>

    <ul>
			<?php $recent_posts = new WP_Query(
				array(
					'post_type' => 'post',
					'posts_per_page' => $count,
					'post_status' => 'publish',
					'nopaging' => 0,
					'post__not_in' => get_option('sticky_posts')
					)
				);

			if ($recent_posts->have_posts()) : while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>

			<li class="latest-post-blog">
				<?php if (has_post_thumbnail()) { ?>
					<a href="<?php the_permalink() ?>"> <?php the_post_thumbnail('portfolio-main'); ?></a>
				<?php } ?>
				<h6><a href="<?php the_permalink() ?>" class="latest-title"><?php the_title(); ?></a></h6>
			</li>

			<?php
				endwhile;
				endif;
				wp_reset_query();	?>
		</ul>
    <?php echo $args['after_widget'];
  }

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['count'] = $new_instance['count'];
    return $instance;
  }
}

class themeworm_flickr extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_flickr', 'description' => 'Last flickr photos.' );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'flickr-widget' );
		parent::__construct( 'flickr-widget', '--- Flickr ---', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', isset($instance['title']) ? $instance['title'] : '' );
		$flickr_username = isset($instance['flickr_username']) ? $instance['flickr_username'] : '';
		$flickr_count = isset($instance['flickr_count']) ? $instance['flickr_count'] : '';

		echo $args['before_widget'];

		if ( $title ) echo $args['before_title'] . esc_html( $title ) . $args['after_title'];

		global $FLICKR_CURRENT; ?>

		<div class="flickr_inner">
			<?php
			if ($flickr_count <= 10) {

				$size = $FLICKR_CURRENT == 'top' ? 'm' : 's';
				?>
				<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo esc_html($flickr_count); ?>&amp;display=random&amp;flickr_display=random&amp;size=<?php echo esc_html($size); ?>&amp;layout=x&amp;source=user&amp;user=<?php echo esc_html($flickr_username); ?>"></script>
				<?php
			} else {

				$size = $FLICKR_CURRENT == 'top' ? 'mid' : 'square';
				?>
				<script type="text/javascript" src="http://www.flickr.com/badge_code.gne?count=<?php echo esc_html($flickr_count); ?>&amp;display=random&amp;flickr_display=random&amp;size=square&amp;layout=x&amp;source=user&amp;nsid=<?php echo esc_html($flickr_username); ?>&amp;raw=1"></script>
				<?php
			}
			?>
		</div>

		<?php

		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickr_username'] = strip_tags( $new_instance['flickr_username'] );
		$instance['flickr_count'] = (int) $new_instance['flickr_count'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => '', 'count' => 6, 'description' => 'Last flickr photos' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = isset($instance['title']) ? $instance['title'] : '';
		$flickr_username = isset($instance['flickr_username']) ? $instance['flickr_username'] : '';
		$flickr_count = isset($instance['flickr_count']) ? $instance['flickr_count'] : '';
		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">Title:</label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'flickr_username' )); ?>">Flickr ID (<a href="http://www.idgettr.com" target="_blank">idGettr</a>)</label>
			<input id="<?php echo esc_attr($this->get_field_id( 'flickr_username' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'flickr_username' )); ?>" value="<?php echo esc_attr($flickr_username); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'flickr_count' )); ?>">Number of photos:</label>
			<input id="<?php echo esc_attr($this->get_field_id( 'flickr_count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'flickr_count' )); ?>" value="<?php echo esc_attr($flickr_count); ?>" style="width:100%;" />
		</p>

	<?php
	}
}

class themeworm_latest extends WP_Widget {

  function __construct() {
    $widget_ops = array('classname' => 'widget-latest', 'description' => 'Recent posts');
    $control_ops = array('width' => 300);
    parent::__construct('themeworm_latest', '--- Recent Posts ---', $widget_ops, $control_ops);
  }

  function widget($args, $instance) {
    extract($args, EXTR_SKIP);
    echo $args['before_widget'];
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
    $count = $instance['count'];
		$author = $instance['author'];
		$date = $instance['date'];
		$text = $instance['text'];
		$thumb = $instance['thumb'];

    echo $args['before_title'] . esc_html($title) . $args['after_title'];
    wp_reset_query();
    rewind_posts();

    $recent_posts = new WP_Query(
      array(
        'posts_per_page' => $count,
        'post_status' => 'publish',
        'nopaging' => 0,
        'post__not_in' => get_option('sticky_posts')
      )
    );
    $postnum = 0;
    if ($recent_posts->have_posts()) : while ($recent_posts->have_posts()) : $recent_posts->the_post();
      $postnum++;
      $class = ( $postnum % 2 ) ? ' even' : ' odd'; ?>

      <div class="latest-post-blog <?php if($thumb == 'hide') echo 'no-thumb'; ?>">
        <?php if ($thumb != 'hide') {
        	if (!has_post_thumbnail()) { ?>
				    <a href="<?php the_permalink() ?>"><img src="<?php echo esc_url(get_template_directory() . '/images/no-thumb.png'); ?>" /></a>
				  <?php } else { ?>
            <a href="<?php the_permalink() ?>"> <?php the_post_thumbnail('portfolio-footer'); ?></a>
        <?php } } ?>
        <p><a class="link" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
        <?php if ($date != 'hide') { ?><span class="date"><?php echo get_the_date(); ?></span><?php }?>
				<?php if ($text != 'hide') { ?><span class="text"><?php echo wp_trim_words( get_the_content(), 11 ); ?></span><?php } ?></p>

      </div>
    <?php
    endwhile;
    endif;
    wp_reset_query();
    rewind_posts();
    echo $args['after_widget'];
  }

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
	  $instance['author'] = $new_instance['author'];
    $instance['count'] = $new_instance['count'];
		$instance['date'] = $new_instance['date'];
		$instance['text'] = $new_instance['text'];
		$instance['thumb'] = $new_instance['thumb'];
    return $instance;
  }

  function form($instance) {
    $instance = wp_parse_args((array) $instance, array('title' => ''));
    $title = strip_tags($instance['title']);
	  $author = $instance['author'];
    $count = $instance['count'];
		$date = $instance['date'];
		$text = $instance['text'];
		$thumb = $instance['thumb']; ?>

    <p>
      <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Widget Title:
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
      </label>
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('count')); ?>">How many posts, only number 1-9:
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr($count); ?>" />
      </label>
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('date')); ?>">Show date?
        <select id="<?php echo esc_attr($this->get_field_id('date')); ?>" name="<?php echo esc_attr($this->get_field_name('date')); ?>" id="date">
        	<option <?php if($instance['date'] == 'show') { echo 'selected'; } ?> value="show">Show</option>
        	<option <?php if($instance['date'] == 'hide') { echo 'selected'; } ?> value="hide">Hide</option>
        </select>
      </label>
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('text')); ?>">Show excerpt?
        <select id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>" id="text">
          <option <?php if($instance['text'] == 'hide') { echo 'selected'; } ?> value="hide">Hide</option>
    			<option <?php if($instance['text'] == 'show') { echo 'selected'; } ?> value="show">Show</option>
    		</select>
      </label>
    </p>
		<p>
      <label for="<?php echo esc_attr($this->get_field_id('thumb')); ?>">Show post thumb?
        <select id="<?php echo esc_attr($this->get_field_id('thumb')); ?>" name="<?php echo esc_attr($this->get_field_name('thumb')); ?>" id="thumb">
        	<option <?php if($instance['thumb'] == 'show') { echo 'selected'; } ?> value="show">Show</option>
          <option <?php if($instance['thumb'] == 'hide') { echo 'selected'; } ?> value="hide">Hide</option>
      	</select>
      </label>
    </p>
    <?php
  }
}

class themeworm_recent_portfolio extends WP_Widget {

  function __construct() {
    $widget_ops = array('classname' => 'widget-recent-portfolio', 'description' => 'Recent projects');
    $control_ops = array('width' => 300);
    parent::__construct('themeworm_recent_portfolio', '--- Recent Portfolio ---', $widget_ops, $control_ops);
  }

  function widget($args, $instance) {
    extract($args, EXTR_SKIP);
    echo $args['before_widget'];
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
    $count = $instance['count'];

    echo $args['before_title'] . esc_html($title) . $args['after_title'];
    wp_reset_query();
    rewind_posts(); ?>

  	<ul class="recent-portfolio-pics">
      <?php $recent_posts = new WP_Query(
        array(
			    'post_type' => 'portfolio',
          'posts_per_page' => $count,
          'post_status' => 'publish',
          'nopaging' => 0,
          'post__not_in' => get_option('sticky_posts')
        )
      );

      $postnum = 0;
      if ($recent_posts->have_posts()) : while ($recent_posts->have_posts()) : $recent_posts->the_post();
        $postnum++;
        $class = ( $postnum % 2 ) ? ' even' : ' odd'; ?>

        <li class="latest-post-blog <?php if(!has_post_thumbnail()) echo "no-thumb" ?>">
          <a href="<?php the_permalink() ?>"> <?php the_post_thumbnail('portfolio-footer'); ?></a>
        </li>
      <?php
      endwhile;
      endif;
      wp_reset_query();
      rewind_posts(); ?>
		</ul>

  <?php echo $args['after_widget'];
  }

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['count'] = $new_instance['count'];
    return $instance;
  }

  function form($instance) {
    $instance = wp_parse_args((array) $instance, array('title' => ''));
    $title = strip_tags($instance['title']);
    $count = isset( $instance['count'] ) ? $instance['count'] : ''; ?>

    <p>
      <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Widget Title:
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
      </label>
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('count')); ?>">How many items show, only number 1-9:
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr($count); ?>" />
      </label>
    </p>
    <?php
  }
}

class themeworm_social_menu extends WP_Widget {

  public function __construct() {
    $widget_ops = array('classname' => 'widget-themeworm_social_menu', 'description' => 'Social icons menu');
    $control_ops = array('width' => 300);
    parent::__construct('themeworm_social_menu', '--- Social Menu ---', $widget_ops, $control_ops);
  }

  public function form( $instance ) {
    $title = isset( $instance['title'] ) ? $instance['title'] : '';
    $nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
    $menus = wp_get_nav_menus();

    ?>
    <p class="nav-menu-widget-no-menus-message" <?php if ( ! empty( $menus ) ) { echo ' style="display:none" '; } ?>>
      <?php
      if ( isset( $GLOBALS['wp_customize'] ) && $GLOBALS['wp_customize'] instanceof WP_Customize_Manager ) {
        $url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
      } else {
        $url = admin_url( 'nav-menus.php' );
      }
      ?>
      <?php echo sprintf( __( 'No menus have been created yet. <a href="%s">Create some</a>.' ), esc_attr( $url ) ); ?>
    </p>
    <div class="nav-menu-widget-form-controls" <?php if ( empty( $menus ) ) { echo ' style="display:none" '; } ?>>
      <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>"/>
      </p>
      <p>
        <label for="<?php echo $this->get_field_id( 'nav_menu' ); ?>">Select Menu:</label>
        <select id="<?php echo $this->get_field_id( 'nav_menu' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
          <option value="0">Select</option>
          <?php foreach ( $menus as $menu ) : ?>
            <option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
              <?php echo esc_html( $menu->name ); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </p>
    </div>
    <?php
  }

  public function update( $new_instance, $old_instance ) {
    $instance = array();
    if ( ! empty( $new_instance['title'] ) ) {
      $instance['title'] = sanitize_text_field( $new_instance['title'] );
    }
    if ( ! empty( $new_instance['nav_menu'] ) ) {
      $instance['nav_menu'] = (int) $new_instance['nav_menu'];
    }
    return $instance;
  }

  public function widget( $args, $instance ) {

    $nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

    if ( !$nav_menu )
      return;

    $instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

    echo $args['before_widget'];

    if ( !empty($instance['title']) )
      echo $args['before_title'] . $instance['title'] . $args['after_title'];

    $nav_menu_args = array(
      'container_class' => 'social_menu_widget',
      'fallback_cb' => '',
      'link_before' => '<span>',
      'link_after' => '</span>',
      'depth' => 1,
      'items_wrap' => '%3$s',
      'menu' => $nav_menu,
      'walker' => new Social_Walker
    );

    wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) );

    echo $args['after_widget'];
  }

}

class Social_Walker extends Walker_Nav_Menu {
  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $classes = empty($item->classes) ? array () : (array) $item->classes;
    $class_names = join(' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
    !empty( $class_names ) and $class_names = ' class="'. esc_attr( $class_names ) . '"';
    $attributes = $custom  = '';
    !empty( $item->attr_title ) and $attributes .= ' title="' . esc_attr( $item->attr_title ) .'"';
    !empty( $item->target ) and $attributes .= ' target="' . esc_attr( $item->target ) .'"';
    !empty( $item->xfn ) and $attributes .= ' rel="' . esc_attr( $item->xfn ) .'"';
    $title = apply_filters( 'the_title', $item->title, $item->ID );

    if (!empty( $title ) && strtolower( $title ) == 'custom' ) {
      if (!empty( $item->url )) {
        $urls = explode('|', $item->url);
        $attributes .= ' href="' . esc_attr( $link_url = (is_array($urls)) ? $urls[1] : $item->url ) .'"' . 'class="custom-social-link"';
        $custom = '<img src="'. $urls[0] .'" class="custom-social svg" />';
      }
    } else {
      !empty( $item->url ) and $attributes .= ' href="' . esc_attr( $item->url ) .'"';
    }

    $item_output = $args->before
      . "<a $attributes target=_blank>"
        . $custom
        . $args->link_before
        . $title
      . '</a>'
      . $args->link_after
      . $args->after;
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}

class themeworm_social extends WP_Widget {

	function __construct() {
    $widget_ops = array('classname' => 'widget-themeworm_social', 'description' => 'Social icons');
    $control_ops = array('width' => 300);
    parent::__construct('themeworm_social', '--- Social ---', $widget_ops, $control_ops);
    $this->social = array('twitter', 'facebook', 'skype', 'instagram', 'youtube', 'vimeo', 'dribbble', 'behance', 'flickr', 'dropbox', 'googleplus', 'pinterest', 'soundcloud', 'github', 'linkedin', 'xing', 'rss');
  }

  function form( $instance ) {

    $title = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] ); ?>

    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">Title:</label>
      <input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>

    <?php foreach ($this->social as $slug) : ?>
      <p>
        <label for="<?php echo $this->get_field_id( $slug ); ?>"><?php echo ucfirst($slug); ?>:</label>
        <input id="<?php echo $this->get_field_id( $slug ); ?>" name="<?php echo $this->get_field_name( $slug ); ?>" value="<?php echo !empty($instance[$slug]) ? esc_url($instance[$slug]) : ''; ?>" class="widefat" type="text" />
      </p>
    <?php endforeach;

  }

	function update( $new_instance, $old_instance ) {
  	$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
    foreach ($this->social as $slug) {
      $instance[$slug] = strip_tags( $new_instance[$slug] );
    }
		return $instance;
	}

	function widget( $args, $instance ) {

		extract($args, EXTR_SKIP);
		$title = apply_filters( 'widget_title', $instance['title'] );

    foreach ($this->social as $slug) {
      if (array_key_exists($slug, $instance)) {
        $$slug = $instance[$slug];
      }
    }

		echo $args['before_widget'];
		if ( $title ) echo $args['before_title'] . esc_attr( $title ) . $args['after_title'];
    echo '<div class="social-widget-inner">';

    foreach ($this->social as $slug) {
      if (!empty($instance[$slug])) {
        echo '<a href="' . esc_url($instance[$slug]) . '" target="_blank"><i class="fa fa-'. ($slug == 'googleplus' ? 'google-plus' : esc_attr($slug)) .'"></i></a>';
      }
		}

		echo '</div>'.$args['after_widget'];

	}
}

class themeworm_author extends WP_Widget {

	function __construct() {
    $widget_ops = array('classname' => 'author-meta', 'description' => 'Social icons');
    $control_ops = array('width' => 300);
    parent::__construct('themeworm_author', '--- Author ---', $widget_ops, $control_ops);
  }

	function form( $instance ) {
		$title = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
		$author_id = empty( $instance['author_id'] ) ? '' : esc_attr( $instance['author_id'] );	?>

  	<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">Title:</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'author_id' ) ); ?>">Author ID:</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'author_id' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'author_id' ) ); ?>" type="text" value="<?php echo esc_attr( $author_id ); ?>">
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['author_id'] = strip_tags( $new_instance['author_id'] );
		return $instance;
	}

	function widget( $args, $instance ) {
		extract($args, EXTR_SKIP);
		$title = apply_filters( 'widget_title', $instance['title'] );
		$author_id = $instance['author_id'];

		echo $args['before_widget'];
		if ( $title ) echo $args['before_title'] . esc_html( $title ) . $args['after_title'];

		if ( $author_id ) { ?>

			<a href="<?php echo esc_url(get_author_posts_url( $author_id )); ?>"><?php echo get_avatar( $author_id, 96); ?></a>
			<h6><a href="<?php echo esc_url(get_author_posts_url( $author_id )); ?>"><?php the_author(); ?></a></h6>

			<div class="author-social">
				<?php if (get_the_author_meta( 'twitter_profile', $author_id )) { ?><a href="<?php echo esc_url(get_the_author_meta( 'twitter_profile', $author_id )); ?>" class="fa fa-twitter" target="_blank"></a><?php } ?>
				<?php if (get_the_author_meta( 'facebook_profile', $author_id )) { ?><a href="<?php echo esc_url(get_the_author_meta( 'facebook_profile', $author_id )); ?>" class="fa fa-facebook" target="_blank"></a><?php } ?>
				<?php if (get_the_author_meta( 'google_profile', $author_id )) { ?><a href="<?php echo esc_url(get_the_author_meta( 'google_profile', $author_id )); ?>" class="fa fa-google-plus" target="_blank"></a><?php } ?>
				<?php if (get_the_author_meta( 'instagram_profile', $author_id )) { ?><a href="<?php echo esc_url(get_the_author_meta( 'instagram_profile', $author_id )); ?>" class="fa fa-instagram" target="_blank"></a><?php } ?>
			</div>
      <div class="author-description">
				<?php echo esc_attr(get_the_author_meta( 'description', $author_id )); ?>
			</div>
		<?php
		}
		echo $args['after_widget'];
	}
}

class themeworm_contacts extends WP_Widget {

	function __construct() {
    $widget_ops = array('classname' => 'contacts-widget', 'description' => 'Contacts');
    $control_ops = array('width' => 300);
    parent::__construct('themeworm_contacts', '--- Contacts ---', $widget_ops, $control_ops);
  }

	function form( $instance ) {

		$title = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
		$contacts_text = empty( $instance['contacts_text'] ) ? '' : esc_attr( $instance['contacts_text'] );
		$contacts_address = empty( $instance['contacts_address'] ) ? '' : esc_attr( $instance['contacts_address'] );
		$contacts_email = empty( $instance['contacts_email'] ) ? '' : esc_attr( $instance['contacts_email'] );
		$contacts_phone = empty( $instance['contacts_phone'] ) ? '' : esc_attr( $instance['contacts_phone'] );
    $contacts_mobile = empty( $instance['contacts_mobile'] ) ? '' : esc_attr( $instance['contacts_mobile'] );	?>

    <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">Title:</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contacts_text' ) ); ?>">Text:</label>
			<textarea id="<?php echo esc_attr( $this->get_field_id( 'contacts_text' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'contacts_text' ) ); ?>" type="text"><?php echo esc_attr( $contacts_text ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contacts_address' ) ); ?>">Address:</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'contacts_address' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'contacts_address' ) ); ?>" type="text" value="<?php echo esc_attr( $contacts_address ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contacts_email' ) ); ?>">Email:</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'contacts_email' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'contacts_email' ) ); ?>" type="text" value="<?php echo esc_attr( $contacts_email ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contacts_phone' ) ); ?>">Phone:</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'contacts_phone' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'contacts_phone' ) ); ?>" type="text" value="<?php echo esc_attr( $contacts_phone ); ?>">
		</p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'contacts_mobile' ) ); ?>">Additional phone (with mobile icon):</label>
      <input id="<?php echo esc_attr( $this->get_field_id( 'contacts_mobile' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'contacts_mobile' ) ); ?>" type="text" value="<?php echo esc_attr( $contacts_mobile ); ?>">
    </p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['contacts_text'] = strip_tags( $new_instance['contacts_text'] );
		$instance['contacts_address'] = strip_tags( $new_instance['contacts_address'] );
		$instance['contacts_email'] = strip_tags( $new_instance['contacts_email'] );
		$instance['contacts_phone'] = strip_tags( $new_instance['contacts_phone'] );
    $instance['contacts_mobile'] = strip_tags( $new_instance['contacts_mobile'] );
		return $instance;
	}

	function widget( $args, $instance ) {
		extract($args, EXTR_SKIP);
		$title = apply_filters( 'widget_title', $instance['title'] );
		$contacts_text = (isset($instance['contacts_text'])) ? $instance['contacts_text'] : '';
		$contacts_address = (isset($instance['contacts_address'])) ? $instance['contacts_address'] : '';
		$contacts_email = (isset($instance['contacts_email'])) ? $instance['contacts_email'] : '';
		$contacts_phone = (isset($instance['contacts_phone'])) ? $instance['contacts_phone'] : '';
    $contacts_mobile = (isset($instance['contacts_mobile'])) ? $instance['contacts_mobile'] : '';

		echo $args['before_widget'];
		if ( $title ) echo $args['before_title'] . esc_html( $title ) . $args['after_title'];

		if ( $contacts_text ) { ?>
			<div class="contacts_text">
				<?php echo esc_html($contacts_text); ?>
			</div>
		<?php
		}

		if ( $contacts_address ) { ?>
			<div class="contacts_address">
				<?php echo esc_html($contacts_address); ?>
			</div>
		<?php
		}

		if ( $contacts_email ) { ?>
			<div class="contacts_email">
				<a href="mailto:<?php echo esc_attr($contacts_email); ?>"><?php echo esc_attr($contacts_email); ?></a>
			</div>
		<?php
		}

		if ( $contacts_phone ) { ?>
			<div class="contacts_phone">
				<?php echo esc_html($contacts_phone); ?>
			</div>
		<?php
		}

    if ( $contacts_mobile ) { ?>
			<div class="contacts_phone mobile_phone">
				<?php echo esc_html($contacts_mobile); ?>
			</div>
		<?php
		}

		echo $args['after_widget'];
	}
}

class themeworm_map extends WP_Widget {

	function __construct() {
    $widget_ops = array('classname' => 'map-widget', 'description' => 'Map');
    $control_ops = array('width' => 300);
    parent::__construct('themeworm_map', '--- Map ---', $widget_ops, $control_ops);
  }

	function form( $instance ) {
		$title = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
		$latitude = empty( $instance['latitude'] ) ? '' : esc_attr( $instance['latitude'] );
		$longitude = empty( $instance['longitude'] ) ? '' : esc_attr( $instance['longitude'] );
		$address = empty( $instance['address'] ) ? '' : esc_attr( $instance['address'] );	?>

  	<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">Title:</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>">Address:</label>
			<textarea id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>" type="text"><?php echo esc_attr( $address ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'latitude' ) ); ?>">Latitude (optional):</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'latitude' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'latitude' ) ); ?>" type="text" value="<?php echo esc_attr( $latitude ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'longitude' ) ); ?>">Longitude (optional):</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'longitude' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'longitude' ) ); ?>" type="text" value="<?php echo esc_attr( $longitude ); ?>">
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['latitude'] = strip_tags( $new_instance['latitude'] );
		$instance['longitude'] = strip_tags( $new_instance['longitude'] );
		$instance['address'] = strip_tags( $new_instance['address'] );
		return $instance;
	}

	function widget( $args, $instance ) {
		extract($args, EXTR_SKIP);
		$title = apply_filters( 'widget_title', $instance['title'] );
		$address = $instance['address'];
		$latitude = (isset($instance['latitude'])) ? $instance['latitude'] : '';
		$longitude = (isset($instance['longitude'])) ? $instance['longitude'] : '';

		echo $args['before_widget'];
		if ( $title ) echo $args['before_title'] . esc_html( $title ) . $args['after_title'];

		if ( $address || $latitude ) {
			$mapID = rand (1, 99);
			$prepAddr = esc_attr(str_replace(' ','+',$address));
			$geocode = wp_remote_fopen('https://maps.googleapis.com/maps/api/geocode/json?address='. $prepAddr .'&key=AIzaSyD_we8roTtUU83gU5HDS8fndwaOTUHgJYk');
			$output = json_decode($geocode);
			//$latitude = esc_attr($output->results[0]->geometry->location->lat);
			//$longitude = esc_attr($output->results[0]->geometry->location->lng);
			$google_latitude = ( $address && isset($output->results[0]) ) ? esc_attr($output->results[0]->geometry->location->lat) : '40.706078';
		  $google_longitude = ( $address && isset($output->results[0]) ) ? esc_attr($output->results[0]->geometry->location->lng) : '-74.016578';

      $output = <<<END
				<div id="googlemaps-$mapID" class="google-map" data-map="$prepAddr"></div>
				<script type="text/javascript">
					jQuery(function($){
						var map = new Maplace({
							controls_on_map: false,
							map_div: '#googlemaps-$mapID',
							locations: [{
								lat: $google_latitude,
								lon: $google_longitude,
								zoom: 16
							}],
							styles: {
								'Greyscale': [{
									featureType: 'all',
									stylers: [
										{ saturation: -100 },
										{ gamma: 0.50 }
									]
								}]
							},
							map_options: {scrollwheel: false},
							//listeners: { click: function(map, event) { map.setOptions({scrollwheel: true}); } }

						}).Load();

					});
				</script>
END;
		echo $output;
		}

		echo $args['after_widget'];
	}
}

?>
