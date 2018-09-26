<?php 
/**
 * Template Name: Search
 * 
 */
get_header();


?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<form id="search">

				<div class="form-group">
					<label for="search_for">Search here</label>
					<input type="text" class="form-control" name="search_for" id="search_for" required>
				</div>

				<div class="form-group">
					<button type="submit" id="send" >Search</button>
				</div>
				
			</form>
			<div class="message"></div>
		</main>
	</div>
</div>
<?php

get_footer();
