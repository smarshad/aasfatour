<?php $this->load->view('include/head');?>
<?php $this->load->view('include/header');?>
<?php $this->load->view('include/sidebar');?>
	<div class="main-container">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<?php $this->load->view($pagename);?>
			<?php $this->load->view('include/footer');?>
		</div>
	</div>
<?php $this->load->view('include/script');?>