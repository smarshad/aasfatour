<div class="min-height-200px">
	<div class="page-header">
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<div class="title">
					<h4>Card</h4>
				</div>
				<nav aria-label="breadcrumb" role="navigation">
					<ol class="breadcrumb">
						<li class="breadcrumb-item size15"><a href="<?php echo base_url();?>dashboard">Home</a></li>
						<li class="breadcrumb-item size15 active" aria-current="page"><?php echo strtoupper($cardtype ?? '');?></li>
					</ol>
				</nav>
			</div>
			<div class="col-md-6 col-sm-12 text-right">
				<div class="dropdown">
					<style type="text/css">
						.abc::after{content: '';}
					</style>
					<a class="btn btn-secondary dropdown-toggle abc" href="#" role="button" data-toggle="dropdown">
						<?php echo $today;?>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
		<div class="clearfix mb-30">
			<div class="pull-left">
				<h4 class="text-blue">Upload Excel File To Create <?php echo strtoupper($cardtype ?? '');?></h4>
			</div>
		</div>
		<div class="progress mb-30" style="display:none;">
            <div id="progress-bar" class="progress-bar progress-bar-success progress-bar-striped " role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
                20%
            </div>
        </div>
		<form id="vform" method="post" action="<?php echo base_url()?>applications/addocs" enctype="multipart/form-data">
			<?php if($this->uri->segment(2)!='all'){?>
				<div class="form-group row">
					<label class="col-sm-12 col-md-2 col-form-label size20">Upload Excel</label>
					<div class="col-sm-12 col-md-6">
						<input type="file" class="form-control-file form-control height-auto" name="excelFile" id="excelFile">
					</div>
					<div class="form-group col-sm-4">
						<div class="input-group text-center">
							<input type="submit" class="btn btn-success" value="Create <?php echo strtoupper($cardtype ?? '');?>">
						</div>
					</div>
				</div>
				<?php if($this->session->userdata('file')==''){?>
					<div class="row" id="pbtn" style="display: none">
						<div class="form-group col-sm-4">
							<div class="input-group text-center">
								<button class="btn btn-success preveiw" data-file="" data-type="<?php echo $this->uri->segment(2);?>">Preview <?php echo strtoupper($cardtype ?? '');?></button> 
							</div>
						</div>	
						<div class="form-group col-sm-4">
							<div class="input-group text-center">
								<a class="btn btn-danger" href="<?php echo base_url();?>card/print/<?php echo $this->uri->segment(2);?>">Print <?php echo strtoupper($cardtype ?? '');?></a> 
							</div>
						</div>					
					</div>
				<?php }else{?>
					<div class="row" id="pbtn">
						<div class="form-group col-sm-4">
							<div class="input-group text-center">
								<button class="btn btn-success preveiw" data-file="<?php echo $this->session->userdata('file');?>" data-type="<?php echo $this->uri->segment(2);?>">Preview <?php echo strtoupper($cardtype ?? '');?></button> 
							</div>
						</div>
						<div class="form-group col-sm-4">
							<div class="input-group text-center">
								<a class="btn btn-danger" href="<?php echo base_url();?>card/print/<?php echo $this->uri->segment(2);?>">Print <?php echo strtoupper($cardtype ?? '');?></a> 
							</div>
						</div>
					</div>
				<?php }?>
			<?php }else{?>
				<div class="form-group row">
					<label class="col-sm-12 col-md-2 col-form-label size20">Upload Excel</label>
					<div class="col-sm-12 col-md-6">
						<input type="file" class="form-control-file form-control height-auto" name="excelFile" id="excelFile">
					</div>
					<div class="form-group col-sm-4">
						<div class="input-group text-center">
							<input type="submit" class="btn btn-success" value="Upload Excel">
						</div>
					</div>
				</div>
				
				<?php if($this->session->userdata('file')==''){?>
					<div class="row" id="pbtn" style="display: none">
						
						<div class="form-group col-sm-4">
							<div class="input-group">
								<button class="btn btn-success preveiw" data-file="" data-type="icard">Preview Icard</button> 
							</div>
							<div class="input-group">
								<a class="btn btn-danger" href="<?php echo base_url();?>card/print/icard" style="color:#FFF">Print Icard</a> 
							</div>
						</div>
						<div class="form-group col-sm-4">
							<div class="input-group">
								<button class="btn btn-success preveiw" data-file="" data-type="bag">Preview Bag Sticker</button> 
							</div>
							<div class="input-group">
								<a class="btn btn-danger" href="<?php echo base_url();?>card/print/bag" style="color:#FFF">Print Bag Sticker</a> 
							</div>
						</div>
						<div class="form-group col-sm-4">
							<div class="input-group">
								<button class="btn btn-success preveiw" data-file="" data-type="zamzam">Preview Zamzam Bottle</button> 
							</div>
							<div class="input-group">
								<a class="btn btn-danger" href="<?php echo base_url();?>card/print/zamzam" style="color:#FFF">Print Zamzam Bottle</a> 
							</div>
						</div>
					</div>
				<?php }else{?>
					<div class="row" id="pbtn">
						<div class="form-group col-sm-4">
							<div class="input-group">
								<button class="btn btn-success preveiw" data-file="<?php echo $this->session->userdata('file');?>" data-type="icard">Preview Icard</button> 
							</div>
							<div class="input-group">
								<a class="btn btn-danger" href="<?php echo base_url();?>card/print/icard" style="color:#FFF">Print Icard</a> 
							</div>
						</div>
						<div class="form-group col-sm-4">
							<div class="input-group">
								<button class="btn btn-success preveiw" data-file="<?php echo $this->session->userdata('file');?>" data-type="bag">Preview Bag Sticker</button> 
							</div>
							<div class="input-group">
								<a class="btn btn-danger" href="<?php echo base_url();?>card/print/bag" style="color:#FFF">Print Bag Sticker</a> 
							</div>

						</div>
						<div class="form-group col-sm-4">
							<div class="input-group">
								<button class="btn btn-success preveiw" data-file="<?php echo $this->session->userdata('file');?>" data-type="zamzam">Preview Zamzam Bottle</button> 
							</div>
							<div class="input-group">
								<a class="btn btn-danger" href="<?php echo base_url();?>card/print/zamzam" style="color:#FFF">Print Zamzam Bottle</a> 
							</div>
						</div>
					</div>
				<?php }?>
			<?php }?>
		</form>
	</div>
</div>