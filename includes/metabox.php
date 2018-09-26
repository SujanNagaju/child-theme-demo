<?php 
function vehicle_meta_box_add(){
	add_meta_box(
		'vehicle_meta_box_id',
		'Status',
		'status_cb',
		'vehicles',
		'normal',
		'default'
	);
}
function status_cb(){
	global $post;
	$status_meta = get_post_meta($post->ID, 'status_meta_key', true);
	$direction_meta = get_post_meta($post->ID, 'direction_meta_key', true);
	$check_boxes = array('above', 'below');
	$test = get_post_meta($post->ID, 'check_meta_key', true);
	$check_meta = ( $test ) ? $test : array();
	
	?>
	<label>Vehicle Status</label>
	<p>
		<input type="text" name="status" value="<?php echo $status_meta ?>">
	</p>
	<p>
		<label for="direction">Direction</label>  
		<select name="direction" id="direction">  
			<option value="up" <?php selected ($direction_meta, 'up'); ?>>Up</option>  
			<option value="down" <?php selected ($direction_meta, 'down'); ?>>Down</option>  
		</select>
	</p>
	<?php
	foreach ( $check_boxes as $checkbox ) {
		?>
		<input type="checkbox" name="checkbox[]" value="<?php echo $checkbox; ?>" <?php checked( ( in_array( $checkbox, $check_meta ) ) ? $checkbox : '', $checkbox ); ?> /><?php echo $checkbox; ?> <br />
		<?php
	}

}
add_action('save_post','save_status');

function save_status($post_id){
	$post_type = get_post_type($post_id);

	if("vehicles" != $post_type){
		return;
	}
	if(isset($_POST['status'])){
		update_post_meta($post_id, 'status_meta_key', sanitize_text_field($_POST['status']));
	}
	if(isset($_POST['direction'])){
		update_post_meta($post_id, 'direction_meta_key', $_POST['direction']);
	}
	if(isset($_POST['checkbox'])){
		update_post_meta($post_id, 'check_meta_key', $_POST['checkbox']);
	}
	else{
		update_post_meta($post_id, 'check_meta_key', '');
	}
	
}
add_action('add_meta_boxes', 'vehicle_meta_box_add');