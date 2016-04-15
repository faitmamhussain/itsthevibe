<?php


class Featured_Posts_Widget extends WP_Widget
{
	private $post_types = array();
	function __construct() {
		parent::WP_Widget(false, $name = 'Custom Featured Posts');
	}

	function form($instance) {
		$title = esc_attr($instance['title']);
		$type = esc_attr($instance['post_type']);
		$num = (int)esc_attr($instance['num']);
		$this->post_types = get_post_types(array(
			'_builtin' => false,
		) , 'names', 'or');
		$this->post_types['post'] = 'post';
		$this->post_types['page'] = 'page';
		ksort($this->post_types);
		echo "<p>";
		echo "<label for=\"" . $this->get_field_id('title') . "\">";
		echo _e('Title:');
		echo "</label>";
		echo "<input class=\"widefat\" id=\"" . $this->get_field_id('title') . "\" name=\"" . $this->get_field_name('title') . "\" type=\"text\" value=\"" . $title . "\" />";
		echo "</p>";
		echo "<p>";
		echo "<label for=\"" . $this->get_field_id('post_type') . "\">";
		echo _e('Post Type:');
		echo "</label>";
		echo "<select name = \"" . $this->get_field_name('post_type') . "\" id=\"" . $this->get_field_id('title') . "\" >";
		foreach ($this->post_types as $key => $post_type) {
			echo '<option value="' . $key . '"' . ($key == $type ? " selected" : "") . '>' . $key . "</option>";
		}

		echo "</select>";
		echo "</p>";
		echo "<p>";
		echo "<label for=\"" . $this->get_field_id('num') . "\">";
		echo _e('Number To show:');

		echo "</label>";
		echo "<input id = \"" . $this->get_field_id('num') . "\" class = \"widefat\" name = \"" . $this->get_field_name('num') . "\" type=\"text\" value =\"" . $num . "\" / >";
		echo "</p>";
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['num'] = (int)strip_tags($new_instance['num']);
		$instance['post_type'] = strip_tags($new_instance['post_type']);
		if ($instance['num'] < 1) {
			$instance['num'] = 10;
		}
		return $instance;
	}
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		echo $before_widget;
		if ($title) {
			echo $before_title . $title . $after_title;
		}
		echo "<div class=\"featured-posts-widget swiper-container\"><div class=\"swiper-wrapper\">";
		wp_reset_query();
		global $wp_query;
		$old_query = $wp_query;
		$FeaturedPost_query = new WP_Query(array(
			'post_type' => $instance['post_type'],
			'showposts' => $instance['num'],
			'featured' => 'yes',
			'paged' => 1
		));
		while ($FeaturedPost_query->have_posts()) {
			$FeaturedPost_query->the_post();
			?>
			<a href="<?php echo get_permalink(); ?>" class="featured-post swiper-slide">
				<div class="featured-post-image"><?php the_post_thumbnail('full');?></div>
				<div class="featured-post-title">
					<h2><?php echo get_the_title();?></h2>
				</div>
			</a>
			<?php
		}
		wp_reset_query();
		$wp_query = $old_query;
		echo "</div><div class=\"featured-post-button\"><div class=\"swiper-button-next swiper-button-white\"></div></div><div class=\"featured-post-button\"><div class=\"swiper-button-prev swiper-button-white\"></div></div></div>";
		?>
		<script>
			jQuery( document ).ready(function( $ ) {
				var swiper = new Swiper('.swiper-container', {
					slidesPerView: 3,
					grabCursor: true,
					mousewheelControl: true,
					loop: true,
					keyboardControl: true,
					nextButton: '.swiper-button-next',
					prevButton: '.swiper-button-prev',
					breakpoints: {
						600: {
							slidesPerView: 1,
						},
						1023: {
							slidesPerView: 2,
						},
					}
				});
			});
		</script>
		<?php
		echo $after_widget;
		// outputs the content of the widget
	}
}

add_action('widgets_init', function(){
	register_widget("Featured_Posts_Widget");
});

//add featured posts after header

genesis_register_widget_area( array(
	'id' => 'after-header',
	'name' => 'After Header (Home page)'
) );

add_action( 'genesis_after_header', function(){

	global $wp_registered_sidebars;

	if ( is_front_page() && ( isset( $wp_registered_sidebars['after-header'] ) && is_active_sidebar( 'after-header' ) ) ) {

		dynamic_sidebar( 'after-header' );

		add_filter('genesis_attr_site-inner', function($atts){
			if( is_front_page() &&! empty($atts['class']) ){
				$atts['class'] .= ' featured-posts-space';
			}
			return $atts;
		});
	}
}, 14 );
