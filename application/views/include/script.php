<!-- js -->
<script src="<?php echo base_url();?>assets/vendors/scripts/script.js"></script>
<script src="<?php echo base_url();?>assets/common.js"></script>
<script src="<?php echo base_url();?>assets/jquery.toaster.js"></script>
<script src="<?php echo base_url(); ?>assets/notify.js"></script>
<script src="<?php echo base_url(); ?>assets/fileinput.js"></script>
<?php
if($pagename=='dashboard'){?>
<script src="<?php echo base_url();?>assets/src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>
<?php }
    $uniqu = uniqid();
    if ($_SERVER['HTTP_HOST'] == 'localhost') {
        $path = '/aasfatour/';
    } else {
        $path = '/aamna/icard/';
    }
    $filename  = $_SERVER['DOCUMENT_ROOT'].$path."/assets/".$pagename.".js";
    $filename1 = base_url()."assets/".$pagename.".js?random=".$uniqu;
    if (file_exists($filename)) {
        echo '<script src="'.$filename1.'"></script>';
    }
?>
</body>
</html>