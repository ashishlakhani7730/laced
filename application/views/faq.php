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
							<h5 class="txt-dark">ADD FAQ</h5>
						</div>
					
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
							<ol class="breadcrumb">
								<li><a href="#">About us</a></li>
								<li class="active"><span>Add faq</span></li>
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
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $this->session->flashdata('message_faq'); ?> 
					</div>
					<div id="failMessage" class="alert alert-info alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $this->session->flashdata('fail_message'); ?>
					</div>
					<div class="panel panel-default card-view">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark"></h6>

                                </div>
                               
                                <div class="clearfix"></div>
                            </div>
					<div class="row">
						<div class="col-md-12">
							 <form name="frm" method="post" action="<?php echo site_url("faq/faqlist") ?>">
								<div class="form-body overflow-hide">
									<div class="form-actions mt-10">			
                                        <button id="addfaq" type="button" class="btn btn-info btn-anim">Add New FAQ</button>
										<button id="removefaq" type="button" class="btn btn-info btn-anim">Remove FAQ</button>
                                    </div>
									<div class="form-group">
										<label class="control-label mb-10" for="quetion">Question</label>
										<div class="input-group">
											<div class="input-group-addon"><i class="fa fa-question-circle-o"></i></div>
											<input type="text" name="quetion[]" class="form-control" id="quetion" value="<?php ?>" required="">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label mb-10" for="answer">Answer</label>
										<div class="input-group">
											<div class="input-group-addon"><i class="fa fa-check"></i></div>
											<input type="text" name="answer[]" class="form-control" id="answer" value="<?php ?>" required="">
										</div>
									</div>
									<div id="appendeddiv">
									</div>
									<div class="form-actions mb-10">			
                                        <button type="submit" class="btn btn-info btn-anim">Submit</button>
                                    </div>	
								</div>
							 </form>
						</div>
					</div>
					</div>
				</div>
			</div>
			<!-- End Main Content -->
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
	<?php if(empty($this->session->flashdata('message_faq'))) { ?>
			$('#successMessage').hide();
	<?php } else { ?>
			setTimeout(function() {
				$('#successMessage').fadeOut('slow');
            }, 5000);
	<?php } ?>
	
	<?php if(empty($this->session->flashdata('fail_message'))) { ?>
			$('#failMessage').hide();
	<?php } else { ?>
			setTimeout(function() {
				$('#failMessage').fadeOut('slow');
            }, 5000);
	<?php } ?>
	
$("#addfaq").click(function(){
	appenddivs();	 
});

$("#removefaq").click(function(){
	removeappenddivs();	 
});

var count = 0;

function appenddivs(){
$("#appendeddiv").append('<div id="app_'+ count +'"><div class="form-group"><label class="control-label mb-10" for="quetion">Question</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-question-circle-o"></i></div><input type="text" name="quetion[]" class="form-control" id="quetion" value="<?php ?>" required=""></div></div><div class="form-group"><label class="control-label mb-10" for="answer">Answer</label><div class="input-group"><div class="input-group-addon"><i class="fa fa-check"></i></div><input type="text" name="answer[]" class="form-control" id="answer" value="<?php ?>" required=""></div></div></div>');
count++;
}

function removeappenddivs()
{
	count--;
	$('#app_'+count).remove();
}

</script>
</body>

 
<!-- Mirrored from hencework.com/theme/dexter/full-width-light/blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Jul 2017 06:42:32 GMT -->
</html>