<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.html">Home</a></li>
			<li class="active">Registration</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">			
				
				<div class="col-md-10 col-md-offset-2 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Register a new account</h3>
							<p class="text-center text-muted">Lorem ipsum dolor sit amet, <a href="<?php echo base_url(); ?>login">Login</a> adipisicing elit. Quo nulla quibusdam cum doloremque incidunt nemo sunt a tenetur omnis odio. </p>
							<hr>

							<form method="post" action="register">
								<div class="top-margin">
									<label>First Name</label>
									<input type="text"  name="first_name"class="form-control" value="<?php echo set_value('first_name');?>">			
									<span class="alert alert-danger"><?php echo form_error('first_name')?></span>
								</div>
								<div class="top-margin">
									<label>Last Name</label>
									<input type="text" name="last_name" class="form-control" value="<?php echo set_value('last_name');?>">
									<span class="alert alert-danger"><?php echo form_error('last_name')?></span>

								</div>
								<div class="top-margin">
									<label>Email Address <span class="text-danger">*</span></label>
									<input type="text" name="email_address" class="form-control" value="<?php echo set_value('email_address');?>">
									<span class="alert alert-danger"><?php echo form_error('email_address')?></span>

								</div>

								<div class="row top-margin">
									<div class="col-sm-6">
										<label>Password <span class="text-danger">*</span></label>
										<input type="password" name="password" class="form-control" value="<?php echo set_value('password');?>">
										<span class="alert alert-danger"><?php echo form_error('password')?></span>

									</div>
									<div class="col-sm-6">
										<label>Confirm Password <span class="text-danger">*</span></label>
										<input type="password" name="confirm_password" class="form-control" value="<?php echo set_value('confirm_password');?>">
										<span class="alert alert-danger"><?php echo form_error('confirm_password')?></span>

									</div>
								</div>
								<div class="top-margin">
									<label>Contact Number</label>
									<input type="text" name="contact_number" class="form-control" value="<?php echo set_value('contact_number');?>">
									<span class="alert alert-danger"><?php echo form_error('contact_number')?></span>

								</div>

								<hr>

								<div class="row">
									<div class="col-lg-8">
										<label class="checkbox">
											<input type="checkbox"> 
											I've read the <a href="page_terms.html">Terms and Conditions</a>
										</label>                        
									</div>
									<div class="col-lg-4 text-right">
										<button class="btn btn-action sub" type="submit">Register</button>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>
				
			</article>
			<!-- /Article -->

		</div>
	</div>	<!-- /container -->
	