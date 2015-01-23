<?php 

/*
My first widget
src: http://www.wproots.com/advanced-wordpress-widgets/
*/

/* Extend the widget class with your own name*/
class ExampleWidget extends WP_Widget {
	// all our widget code wil go here;
	
	/* Constructor */
	// The name of function should be same as class name.
	function ExampleWidget () {
		parent::WP_Widget(false, $name = 'A Example Widget'); // change $name to the name that should apper in admin panel
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
		$instance['title'] = strip_tags($new_instance['title'];)
		$instance['text'] = strip_tags($new_instance['text'];)
		$instance['checkbox'] = strip_tags($new_instance['checkbox'];)
		$instance['textarea'] = strip_tags($new_instance['textarea'];)
		$instance['select'] = strip_tags($new_instance['select'];)
	}


}
?>