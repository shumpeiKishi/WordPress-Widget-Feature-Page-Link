<?php 

/*
Plugin Name: Example widget
Plugin URI: http://jamesbruce.me/
Description: Just an example
Author: Shumpei Kishi
Version: 1
Author URI: http://shumpeikishi.com/
*/


/* Extend the widget class with your own name*/
class an_example_widget extends WP_Widget {
	// all our widget code wil go below;
	
	/* Constructor */
	// The name of function should be same as class name.
	function an_example_widget()
	{
		$widget_ops = array('classname' => 'an_example_widget', 'description' => 'Display form plugin' );
		$this->WP_Widget('an_example_widget', 'Displaying form for plugin', $widget_ops);
	}

	/* Widget Output*/
	// Frontend output of the widget;
	function widget($args, $instance) {
		extract($args);
		// these are our widget options;
		$title = apply_filters('widget_title', $instance['title']); // Title of the widget;
		$text = $instance['text'];
		$checkbox = $instance['checkbox'];
		$textarea = $instance['textarea'];
		$select = $instance['select'];

		echo $before_widget;

		// If the title is set
		if ($title) echo $before_title . $title . $after_title; 
		
		// If text field is set
		if ($text) echo '<div class="widget-text">' . $text . '</div>';

		// If checkbox is checked
		if ($checkbox == true) echo 'The Message is displayed if our checkbox is checked';

		// If text is entered in the textarea
		if ($textarea) echo '<div class="widget-textarea">' . $textarea . '</div>' ;

		switch ($select) {
			case 'one' : 
			echo "option 1 is selected";
			break;
			case 'two':
			echo "option 2 is selected";
			break;
			default: 
			echo "case 3 is selected";
		}
		echo $after_widget;
	}

	/* Saving the Widget Options*/
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = strip_tags($new_instance['text']);
		$instance['checkbox'] = strip_tags($new_instance['checkbox']);
		$instance['textarea'] = strip_tags($new_instance['textarea']);
		$instance['select'] = strip_tags($new_instance['select']);

		return $instance; // return renewed instance values;
	}

	/* Setting up a form to WordPress backend */
	function form($instance) {

		
		$title = esc_attr($instance['title']);
		$text = esc_attr($instance['text']);
		$checkbox = esc_attr($instance['checkbox']);
		$textarea = esc_attr($instance['textarea']);
		$select = esc_attr($instance['select']);

		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('text_'); ?>"><?php _e('This is a single line text field:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $text; ?>" />
		</p>

		<p>
			<input id="<?php echo $this->get_field_id('checkbox'); ?>" name="<?php echo $this->get_field_name('checkbox'); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox ); ?>/>
			<label for="<?php echo $this->get_field_id('checkbox'); ?>"><?php _e('This is a checkbox'); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('This is a textarea:'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
		</p>

		<p>

			<?php 
			$pages = get_pages();
			foreach($pages as $page) {
				echo $page->post_title;
			} ?>
			<label for="<?php echo $this->get_field_id('select'); ?>"><?php _e('This is a select menu'); ?></label>
			<select name="<?php echo $this->get_field_name('select'); ?>" id="<?php echo $this->get_field_id('select'); ?>" class="widefat">
				<?php
				$options = array('one', 'two', 'three');
				foreach ($options as $option) {
					echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				?>
			</select>
		</p>

		<?php
	}
}
// register example widget
// add_action('widgets_init', create_function('', 'return register_widget("pippin_example_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("an_example_widget");'));
?>