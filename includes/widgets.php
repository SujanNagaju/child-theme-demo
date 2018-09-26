<?php 
//create custom widgets 


//creating the widget
class Class_Simple_Widget extends WP_Widget{
	function __construct(){
		parent ::__construct('childtheme-sample-widget', __('Test Widget', 'twenty-seventeen-child'), array( 'description' => __('widget for testing custom widget', 'twenty-seventeen-child'), )
			);

	}

	//creating widget front-end
	public function widget ( $arg, $instance ){
		$title =  $instance['title'];
		$select = isset( $instance['select'] ) ? $instance['select'] : '';
		

		echo $arg['before_widget'];
		if ( ! empty ($title) ){
			echo $arg['before_title']. $title. $arg['after_title'];
		}
		 echo __( 'Hello, World!', 'twenty-seventeen-child' );
		if( $select ) {
			echo '<div class="select-class" id="">' . $select . '</div>';
		}

		echo $arg['after_widget'];
	}

	//widget backend
	public function form ( $instance ){
		if(isset($instance['title'])){
			$title = $instance['title'];
			
		}
		else{
			$title = __('New Title', 'twenty-seventeen-child');
			
		}

		$select = isset( $instance['select'] ) ? $instance['select'] : '';

		//widget admin form 
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php echo 'Subject' ?>
			</label>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('custom-select-id'); ?>">Select</label>
			<select class="widefat" id="<?php echo $this->get_field_id('custom-select-id'); ?>" name="<?php echo $this->get_field_name('custom-select'); ?>">
				<option value="">Select Options</option>
				<option value="1" <?php selected( $select, '1' ); ?>>Select Options 1</option>
				<option value="2" <?php selected( $select, '2' ); ?>>Select Options 2</option>
			</select>
		</p>
		<?php
	}

	//updating the title replacing old instance with new instance 
	public function update($new_instance, $old_instance){
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'] ) ) ? $new_instance['title'] : '';
		$instance['select'] = (!empty($new_instance['custom-select'] ) ) ? $new_instance['custom-select'] : '';

		return $instance;
	}
}

//register and load the widget
function sample_custom_widget(){
	register_widget('Class_Simple_Widget');
}
add_action('widgets_init', 'sample_custom_widget');

///////////////////////

//creating a widget that shows the title and text

class class_text_and_title extends WP_Widget{
	function __construct(){
		parent ::__construct('text_and_content', __('Title and Content', 'twenty-seventeen-child'), array( 'description' => __('widget for showing title and content', 'twenty-seventeen-child'), )
			);

	}

//creating widget backend 
public function form($instance){
	//$title = $instance['title'];
	if(isset($instance['title'])){
		$title = $instance['title'];
	}
	else{
		$title = __('New Title', 'twenty-seventeen-child');
	}
	$text = $instance['text'];
	$select = $instance['select'];
	?>
	<p>
	<label for="<?php echo $this->get_field_id('title') ?>">Title</label>
	<input class="widefat" id="<?php echo $this->get_field_id('title') ?>" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title ?>">
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('text') ?>">Text</label>
		<textarea class="widefat"  name="<?php echo $this->get_field_name('text') ?>" id="<?php echo $this->get_field_id('text') ?>"><?php echo $text ?></textarea>
	</p>
	<label for="<?php echo $this->get_field_id('select') ?>">Select Posts</label>
	<select name="<?php echo $this->get_field_name('select') ?>" id="<?php echo $this->get_field_id('select') ?>">
	
	<?php 
	// $value = echo
		$query = new WP_Query(array(
			'post_type' => 'post',
		));	
		while($query->have_posts()){
			$query->the_post();
			?>
			<option value="<?php echo get_the_ID() ?>" <?php selected($select, get_the_ID()) ?>><?php the_title() ?></option>
			<?php
		}
	 ?>
	
	</select>
	<?php
}

public function update($new_instance, $old_instance){
	$instance = array();
	$instance['title'] = (!empty($new_instance['title'])) ? $new_instance['title'] : '';
	$instance['text'] = (!empty($new_instance['text'])) ? $new_instance['text'] : '';
	$instance['select'] = (!empty($new_instance['select'])) ? $new_instance['select'] : '';
	return $instance;
}

//creating widget frontend 
public function widget($args, $instance){
	$title = $instance['title'];
	echo $args['before_widget'];
	if(!empty($title)){
		echo $args['before_title']. $title . $args['after_title'];
	}
	$text = $instance['text'];
	echo $args['before_widget'];
	?>
		<div class="title_and_text_widget">
			<p><?php echo $text ?></p>
		</div>
	<?php 
	$select = $instance['select'];
	echo $select;
	echo $args['after_widget'];
}

}
//register and load the widget 
function title_and_text_widget(){
	register_widget('class_text_and_title');
}
add_action('widgets_init', 'title_and_text_widget');





//creating sujan nagaju widget that has text editor
class class_sujan_nagaju extends WP_Widget{
	function __construct(){
		parent ::__construct('childtheme-sujan-widget', __('Sujan Nagaju', 'twenty-seventeen-child'), array( 'description' => __('widget for sujans text', 'twenty-seventeen-child'), )
			);

	}


// creating widget backend 
	public function form($instance){
		if(isset($instance['title'])){
			$value = $instance['title'];
		}else{
			$value = __('new title', 'twenty-seventeen-child');
		}
		$text = $instance['text'];

		?>
		<label for="<?php echo $this->get_field_id('title'); ?>">title</label><br/>
		
		<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $value ?>" class="widefat">
		<label for="<?php echo $this->get_field_id('text'); ?>">review</label>
		<textarea class="widefat" name ="<?php echo $this->get_field_name('text') ?>" id="<?php echo $this->get_field_id('text') ?>" cols="30" rows="10"><?php echo $text ?></textarea>
		<label for="<?php echo $this->get_field_id('select'); ?>">select one option</label>
		<select name="<?php echo $this->get_field_name('select'); ?>" class="widefat" id="<?php echo $this->get_field_id('select'); ?>" >
			<option>Select option 1</option>
			<option>Select option 2</option>
			<option>Select option 3</option>

		</select>
		<?php
	//echo $value;
	}

public function update($new_instance, $old_instance){
	$instance = array();
	$instance['title'] = (!empty($new_instance['title'])) ? $new_instance['title'] : '';
	$instance['text'] = (!empty($new_instance['text']))? $new_instance['text'] : '';
	$instance['select'] =  (!empty($new_instance['select'])) ? $new_instance['select']: '';
	return $instance;
}


public function widget($args, $instance){
	$title = $instance['title'];
	if(isset($title)){
		echo $args['before_title'].$title .$args['after_title'];
	}
	$text = $instance['text'];
	if(isset($text)){
	echo $args['before_widget'];
	echo $text;
	echo $args['after_widget'];
	}
}
}

//register widget and hook it into widgets init 
function create_widget_sujan_nagaju(){
	register_widget('class_sujan_nagaju');
}
add_action('widgets_init', 'create_widget_sujan_nagaju');