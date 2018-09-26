<?php 
add_action('wp_enqueue_scripts', 'child_theme_enqueue_style');
function child_theme_enqueue_style(){
	$parent_style = 'parent-style'; //This is 'twentyseventeen-style' for the Twenty Seventeen theme.
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css'); //enqueue parent style

	wp_enqueue_style('bootstrap-style', get_stylesheet_directory_uri() .'/assets/css/bootstrap.min.css', array($parent_style), wp_get_theme()->get('Version'));

	wp_enqueue_style('slick-style', get_stylesheet_directory_uri() .'/assets/css/slick.css', array($parent_style), wp_get_theme()->get('Version'));

	wp_enqueue_style('slick-theme-style', get_stylesheet_directory_uri() .'/assets/css/slick-theme.css', array($parent_style), wp_get_theme()->get('Version'));

	wp_enqueue_style('material-design-style', get_stylesheet_directory_uri() .'/assets/css/material-design-iconic-font.css', array($parent_style), wp_get_theme()->get('Version'));

	wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style), wp_get_theme()->get('Version')); //enqueue child stylesheet


	wp_enqueue_script('jquery');
	wp_enqueue_script('slick-javascript', get_stylesheet_directory_uri().'/assets/js/slick.min.js', array('jquery'),'', true);

	
	wp_enqueue_script('isotope',get_stylesheet_directory_uri().'/assets/js/isotop.min.js', array('jquery'), '', true);

	wp_enqueue_script('custom-isotop', get_stylesheet_directory_uri().'/assets/js/isotope.js', array('jquery', 'isotope'), '',true );
	wp_localize_script('custom-isotop', 'isotope_Ajax', array('ajax_url' => admin_url('admin-ajax.php') ) );

	wp_enqueue_script('custom-javascript', get_stylesheet_directory_uri().'/assets/js/custom.js', array('jquery','slick-javascript'),'', true);

	wp_localize_script('custom-javascript', 'myAjax' ,array('ajax_url'=> admin_url( 'admin-ajax.php') ) );

	wp_enqueue_script('formvalidation-javascript', get_stylesheet_directory_uri().'/assets/js/formvalidation.js', array('jquery','slick-javascript'),'', true);

	wp_localize_script('formvalidation-javascript', 'myAjax' ,array('ajax_url'=> admin_url( 'admin-ajax.php') ) );
}

add_theme_support('post-thumbnails');

//create custom post type vehicle in the child theme 
require_once( get_stylesheet_directory() . '/includes/register-post-types.php');

//add metabox to post type vehicle in child theme
require_once( get_stylesheet_directory() . '/includes/metabox.php');

//custom image size in child theme  
add_action( 'after_setup_theme', 'my_child_theme_image_size', 11 );
function my_child_theme_image_size() {
	//remove_image_size( 'twentyseventeen-featured-image' ); 
	add_image_size( 'twentyseventeen-featured-images', 400, 400, true);
}
require_once( get_stylesheet_directory(). '/includes/shortcode.php' );

/*
//funcion to add shortcode to our posts and pages 
function form_shortcode(){
	ob_start();
?>
 <form name="form1">
	<p>
	<label>Name</label>
	<input type="text" name="name">
	</p>
	<p>
	<label>Age</label>
	<input type="text" name="age">
	</p>
	<p>
	<input type="submit" name="send">
	</p>
</form> 
<?php
$content = ob_get_clean();
return $content;
}
add_shortcode('form','form_shortcode' );

*/
require_once (get_stylesheet_directory().'/includes/customizer.php');

//customizer 

/*
add_action( 'customize_register', 'cd_customizer_settings' );
function cd_customizer_settings( $wp_customize ) {
	$wp_customize->add_section( 'facebook' , array(
		'title'      => 'Facebook',
		'priority'   => 20,
	) );

	$wp_customize->add_setting( 'custom_field' , array(
		'default' => 'Default value',
		'type' => 'theme_mod',
		'sanitize_callback' => 'our_sanitize_function',
	) );

	$wp_customize->add_control( 'custom_field', array(
		'label' => __( 'Custom text for custom field', 'placeholderfortextdomain' ),
		'section' => 'facebook',
		'settings' => 'custom_field',
		'type' => 'text'
	) );

	
}
function our_sanitize_function( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
*/

require_once (get_stylesheet_directory().'/includes/widgets.php');

require_once (get_stylesheet_directory().'/includes/sidebar.php');

add_action("wp_ajax_my_ajax_handler", "my_ajax_handler");
add_action("wp_ajax_nopriv_my_ajax_handler", "my_ajax_handler");
function my_ajax_handler()
{
	// wp_send_json( $_POST['search_for'] );
	 $search = $_POST['search_for'];
	
	 global $wpdb;
	 $sql = $wpdb->prepare(" SELECT * FROM {$wpdb->prefix}posts  WHERE post_type = 'vehicles' AND  post_title = %s ", $search);
	 $results =$wpdb->get_results($sql, OBJECT);
	 $rows = $wpdb->num_rows;
	
	 $output = '';
	 if($rows != 0 ){
	foreach($results as $result){
	 ob_start();

		?>
	<p>
		<?php echo $result->post_title; ?>
	</p>
	<p>
		<?php if(has_post_thumbnail($result->ID)){
			echo get_the_post_thumbnail($result->ID);
		} ?>
	</p>
	<p>
		<?php echo $result->post_content ;?>
	</p>
		<?php

		$output = ob_get_clean();
	}

	wp_send_json( array( 'output' => $output ) );
	die;


	} //endif
	else{
		$error = '';
		ob_start();
		echo 'result not found.';
		$error .= ob_get_clean();
		wp_send_json( array ( 'output' => $error ) );
		die();
	}
	
}

//ajax infinite scroll
add_action("wp_ajax_show_more_posts", "show_more_posts");
add_action("wp_ajax_nopriv_show_more_posts", "show_more_posts");
function show_more_posts(){
	$current_page = $_POST['current_page'];
	$next_page = $current_page +1 ;
	$vehicles = new WP_Query( array(
		'post_type' => 'vehicles',
		'paged' => $next_page,
		'post_status' => 'publish',
		'orderby' => 'ID',
		'order' => 'asc',
		//'posts_per_page' => 3,
	) );	
	
	if($vehicles->have_posts()){
		ob_start();
		while($vehicles->have_posts()):
				$vehicles->the_post();
				echo '<h1>'.get_the_title().get_the_ID(). '</h1>';
				the_post_thumbnail();
				the_content();
		endwhile;
			
		  $vehicles = ob_get_clean();
		 
	wp_reset_postdata();

	wp_send_json( array ('result' =>$vehicles,'current_page' => $next_page ) );
	}
	else{
		wp_send_json(array('result' => 'NO MORE POSTS'));	
	}
	die();
}

add_action("wp_ajax_email_validation", "submit_email");
add_action("wp_ajax_nopriv_email_validation", "submit_email");
function submit_email(){
	$email = $_POST['email'];
	//ob_start();
		$args = array( 
 			'search' => $email,
 			'fields' => array('user_email'),
 		);

 		$users = get_users($args);

 		if(empty($users)){
 			wp_send_json(array('email_exists' => 'email not exists'));
 		}
 		else{
 			wp_send_json(array('email_exists' => 'email exists'));
 		}
 		die();
}

add_action("wp_ajax_username_validation", "submit_username");
add_action("wp_ajax_nopriv_username_validation", "submit_username");
function submit_username(){
	$name = $_POST['username'];
	//ob_start();
		$args = array( 
 			'search' => $name,
 			'fields' => array('user_login'),
 		);

 		$users = get_users($args);

 		if(empty($users)){
 			wp_send_json(array('username_exists' => 'username not exists'));
 		}
 		else{
 			wp_send_json(array('username_exists' => 'username exists'));
 		}
 		die();
}

add_action("wp_ajax_form_validation", "submit_form");
add_action("wp_ajax_nopriv_form_validation", "submit_form");
function submit_form(){
	$fname = $_POST['fname'];
	$username = $_POST['username'];
	$lname = $_POST['lname'];
	$age = $_POST['age'];
	$email = $_POST['email'];
	$password = $_POST['pass'];
	$username = $_POST['username'];

	
	$userdata = array(
    'user_login' =>  $username, //must always be unique 
    'user_pass'  => $password, // When creating an user, `user_pass` is expected.
    'user_nicename' => $fname,
    'user_email' => $email,
    'display_name' => $fname,
    'first_name' => $fname,
    'last_name' => $lname,
    'role' => 'editor',
	);

	$user = wp_insert_user( $userdata ) ;
 
	if( !is_wp_error ( $user ) ) {
		$subject = 'Account created';
		$message = 'congratulations !! your account have been created successfully';
		$mail = wp_mail(  $email,  $subject,  $message,  $headers = '');
			wp_send_json(array('content'=> 'user_added'));
	}else{
		wp_send_json(array('content'=>'user not added'));
		}
}

/*add_action("wp_ajax_form_validation", 'send_email');
add_action("wp_ajax_nopriv_form_validation", "send_email");
function send_email(){
	$to = array($_POST['email'] );
	$subject = 'Account created';
	$message = 'congratulations !! your account have been created successfully';
	$mail = wp_mail(  $to,  $subject,  $message,  $headers = '');
	if($mail === true){
		echo 'your mail has been sent successfully';
	}
	else{
		echo 'your mail has not been sent ';
	}
}
*/
require_once( get_stylesheet_directory() . '/includes/isotope-ajax.php');
