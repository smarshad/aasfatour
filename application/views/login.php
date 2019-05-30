<?php $this->load->view('include/head'); ?>
<div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
	<div class="login-box bg-white box-shadow pd-30 border-radius-5">
		<img src="<?php echo base_url();?>assets/vendors/images/asafalogo.jpg" alt="login" class="login-img">
		<h2 class="text-center mb-30">Login</h2>
		<form id="loginform">
			<div class="input-group custom input-group-lg">
				<input type="text" class="form-control" placeholder="Username" name="username" id="username">
				<div class="input-group-append custom">
					<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
				</div>
			</div>
			<div class="input-group custom input-group-lg">
				<input type="password" class="form-control" placeholder="**********" name="current-password" id="current-password">
				<div class="input-group-append custom">
					<span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="input-group">
						<a class="btn btn-outline-primary btn-lg btn-block login" data-form="loginform">Sign In</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<?php $this->load->view('include/script'); ?>
