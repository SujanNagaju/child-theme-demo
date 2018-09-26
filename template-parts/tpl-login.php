<?php 
/**
 * Template Name: Login 
 */
get_header();
?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container-fluid">
				<div class="row">
					
					<div class="col-8 mx-auto">
						<div class="row">
							<div class="col-4 mx-auto"><h3>Add Account !!</h3></div>
						</div>
						<div class="row">
							<div class="col-8 mx-auto">
								<form id="sample_form" method="post" action="">
									<div class="form-group">
										<label for="fname">First Name:</label>
										<input type="text" name="fname" id="fname" class="form-control" >
										<h5 id="fname_check"></h5>
									</div>
									<div class="form-group">
										<label for="lname">Last Name:</label>
										<input type="text" name="lname" id="lname" class="form-control" >
										<h5 id="lname_check"></h5>
									</div>
									<div class="form-group">
										<label for="username">User Name:</label>
										<input type="text" name="username" id="username" class="form-control" >
										<h5 id="username_check"></h5>
									</div>
									<div class="form-group">
										<label for="age">Age:</label>
										<input type="text" name="age" id="age" class="form-control" >
										<h5 id="age_check"></h5>
									</div>
									<div class="form-group">
										<label for="email">Email:</label>
										<input type="email" name="email" id="email" class="form-control">
										<h5 id="email_check"></h5>
									</div>
									<div class="form-group">
										<label for="c_email">Confirm Email:</label>
										<input type="email" name="c_email" id="c_email" class="form-control">
										<h5 id="c_email_check"></h5>
									</div>
									<div class="form-group">
										<label for="pass">Password:</label>
										<input type="password" name="pass" id="pass" class="form-control">
										<h5 id="pass_check"></h5>
									</div>
									<div class="form-group">
										<label for="c_pass">Confirm Password:</label>
										<input type="password" name="c_pass" id="c_pass" class="form-control">
										<h5 id="c_pass_check"></h5>
									</div>

									<div class="form-group">
										<div class="g-recaptcha" data-sitekey="6Ld9CGMUAAAAAJ1kgUX3iVwPDDImkREN-Y-t8i8k"></div>
									</div>
									<h5 id="recap_err"></h5>

									<div class="form-group">
										<button type="submit" class="btn btn-outline-success"> Submit</button>
									</div>
									<div class="message" style="display: none; border:1px solid black;"></div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-4">

						<a href="<?php echo wp_login_url(home_url());  ?>" title="Login"><h1>Login</h1></a>
					</div>
				</div>
			</div>
		</main>
	</div>
</div>

<?php
get_footer();