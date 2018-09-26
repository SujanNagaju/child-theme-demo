<?php 
/**
 * Template Name: Show post
 */
get_header();
global $wpdb;
/*
 echo $wpdb->query("SELECT * FROM {$wpdb->prefix}posts WHERE post_type = 'drinks'").'<br>';
 echo $wpdb->query(" DELETE FROM {$wpdb->prefix}posts WHERE post_type = 'drinks' ");
//var_dump($a);
*/
 /*	echo $wpdb->insert(
 		"{$wpdb->prefix}posts",
 		array(
 			//'ID' => 417,
 			'post_title' => 'white drink',
 			'post_type' => 'drinks',
 			'post_content' => 'this is the content of the post ',
 		),
 		array(
 			'%s',
 		) ).'<br>';*/
 	/*$sql = $wpdb->update(
 		"{$wpdb->prefix}postmeta",
 		array(
 			'meta_value' => 'hot',
 			//'post_type' => 'drinks',
 			'meta_key' => 'drinks_information'
 		),
 		array(
 			'meta_value' => 'tasty',
 		)

 		  );
 	echo $sql;*/
 	//echo 'Hello World !!!'.'<br>';
 	//$drinks = $wpdb->get_results($sql, ARRAY_A);

 		/*echo $wpdb->query("SELECT * FROM {$wpdb->prefix}posts WHERE post_type = 'drinks' && post_status = 'publish'  ");
 		echo $wpdb->delete(
 			$wpdb->prefix.'posts',
 			array(
 				'post_type' => 'post',
 				'post_title' => 'energy drink',
 			),
 			array( '%s', '%s' )
 		);*/

 		/*$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts WHERE post_type = 'drinks' AND post_status = 'publish' ORDER BY ID ASC ", OBJECT );
 		echo '<pre>';
 		print_r($results);*/

 		/*$type = 'drinks';
 		$title = 'energy drink';
 		$sql = $wpdb->prepare(" SELECT * FROM {$wpdb->prefix}posts  WHERE post_type = %s AND  post_title = %s ", $type, $title);
 		$results =$wpdb->get_results($sql, OBJECT);
 		echo '<pre>';
 		print_r($results);*/

 /*		$post = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}posts WHERE post_type = 'drinks' ORDER BY ID DESC", OBJECT, 3);
 		echo '<pre>';
 		var_dump($post);*/

 		/*$meta_key = 'drinks_information';
 		$sql = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key = %s ", $meta_key) ;
 		$drinks = $wpdb->get_results($sql, ARRAY_A);
 		echo '<pre>';
 		print_r($drinks);*/
 		ob_start();
 		$args = array( 
 			'search' => 'nagajus@gmail.com',
 		);

 		$users = get_users($args);
 		$email = ob_get_clean();
 	
 		if(empty($users)){
 			echo 'no users';
 		}
 		else{
 			echo 'user exists';
 		}

 	
	$mail = false;
	$mail = wp_mail( 'nagajus@gmail.com',  'sujan',  'sujan');
	if($mail){
		echo 'done';
	}
	else{
		echo '<br> not done';
	}


 		
get_footer();