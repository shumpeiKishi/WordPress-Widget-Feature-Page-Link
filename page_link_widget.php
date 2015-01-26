<?php 

/*
Plugin Name: Page Link Widget
Plugin URI: http://github.com/shumpeiKishi
Description: Display a link to a page with its thumbnail image.
Author: Shumpei Kishi
Version: 1
Author URI: http://shumpeikishi.com/
*/


/* Extend the widget class with your own name*/
class PageLinkWidget extends WP_Widget {
	// all our widget code wil go below;
	
	/* Constructor */
	// The name of function should be same as class name.
	function PageLinkWidget()
	{
		$widget_ops = array('classname' => 'PageLinkWidget', 'description' => 'Display a link to a page with its thumbnail image.' );
		$this->WP_Widget('PageLinkWidget', 'PageLinkWidget', $widget_ops);
	}

	/* Widget Output*/
	// Frontend output of the widget;
	function widget($args, $instance) {
		extract($args); // Convert associated array of before and after widget stuff to variables.
		$page_id = $instance['page_id']; // Title of the widget;

		$page_data = get_post($page_id);

		$page_title = $page_data->post_title;
		$page_url = get_permalink($page_id);
		$page_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($page_id), 'large', false);
		$page_thumbnail_url = $page_thumbnail_src[0];

		echo $before_widget

		?>
		<a href="<?php echo $page_url; ?>">
			<div <?php if ($page_thumbnail_url) echo "style='background-image: url(\"".$page_thumbnail_url."\"); background-size: cover; background-position: center; background-repeat: no-repeat; height: 260px;'"; ?>>
				<h2><?php echo $page_title; ?></h2>
			</div>
		</a>

		<?php
		echo $after_widget;
	}

	/* Saving the Widget Options*/
	// strip_tags function disable html and php tags.
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['page_id'] = strip_tags($new_instance['page_id']);

		return $instance; // return renewed instance values;
	}

	/* Setting up a form to WordPress backend */
	function form($instance) {
		$page_id = esc_attr($instance['page_id']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('page_id'); ?>"><?php _e('Select a page you want to display'); ?></label>
			<select name="<?php echo $this->get_field_name('page_id'); ?>" id="<?php echo $this->get_field_id('page_id'); ?>" class="widefat">
				<?php
				$pages = get_pages();
				foreach ($pages as $page) {
					echo '<option value="'. $page->ID .'" id="page-id-'. $page->ID .'" ', $page_id == $page->ID ? 'selected="selected"' :  "", '>'.$page->post_title.'</option>';
				}
				?>
			</select>
		</p>
		<?php
	}
}
// register example widget
add_action('widgets_init', create_function('', 'return register_widget("PageLinkWidget");'));
