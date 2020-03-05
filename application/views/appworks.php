<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include("header_include.php");
        ?>
    </head>

    <body>
        <!--Preloader-->
        <div class="preloader-it">
            <div class="la-anim-1"></div>
        </div>
        <!--/Preloader-->
	<div class="wrapper theme-1-active pimary-color-red">
        <?php
        include("header_body.php");
        ?>
        <?php
        include("header_body_side.php");
        ?>		
			<!-- Main Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">How it works</h5>
						</div>
					
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
							<ol class="breadcrumb">
								<li><a href="#">About us</a></li>
								<li class="active"><span>How it works</span></li>
							</ol>
						</div>
						<!-- /Breadcrumb -->
					
					</div>
					<!-- /Title -->
					
					<?php if(validation_errors()) { ?>
					<div id="validationerror" class="alert alert-info alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo validation_errors(); ?>
					</div>						
					<?php } ?>
					<div id="successMessage" class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $this->session->flashdata('message_work'); ?> 
					</div>
					<div id="failMessage" class="alert alert-info alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $this->session->flashdata('message_fail_work'); ?>
					</div>
				
					<!-- Row -->					
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">How it works</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<form name="appworks" method="post" action="<?php echo site_url("appworks/addstep"); ?>">
										  <div class="form-group">
											<textarea class="textarea_editor form-control" name="texteditor" rows="15" placeholder="Enter text ..." required="required"><?php if($steps['steps'] != ''){ echo $steps['steps']; } ?></textarea>
											<input type="hidden" name="exitsornot" value="<?php if($steps['steps'] == ''){ echo 0; }else{ echo 1;} ?>">
										  </div>
										  <div class="form-actions mt-10">			
												<button type="submit" class="btn btn-info btn-anim">Submit</button>
										  </div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>		
					<!-- /Row -->
				</div>
			</div>
    </div>
<?php
include("footer_include.php");
?>
<script>
	
	<?php if(validation_errors()) { ?>
	setTimeout(function() {
				$('#validationerror').fadeOut('slow');
            }, 10000);
	<?php } ?>
	
	<?php if(empty($this->session->flashdata('message_work'))) { ?>
			$('#successMessage').hide();
	<?php } else { ?>
			setTimeout(function() {
				$('#successMessage').fadeOut('slow');
            }, 5000);
	<?php } ?>
	
	<?php if(empty($this->session->flashdata('message_fail_work'))) { ?>
			$('#failMessage').hide();
	<?php } else { ?>
			setTimeout(function() {
				$('#failMessage').fadeOut('slow');
            }, 5000);
	<?php } ?>
	

</script>
</body>
</html>
