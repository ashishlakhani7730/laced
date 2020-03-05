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
							<h5 class="txt-dark">Update FAQ</h5>
						</div>
					
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
							<ol class="breadcrumb">
								<li><a href="#">About us</a></li>
								<li class="active"><span>Update faq</span></li>
							</ol>
						</div>
						<!-- /Breadcrumb -->
					
					</div>
					<!-- /Title -->
					
					<div class="row">
						<div class="col-md-12">
							 <form name="updatefaq" method="post" action="<?php echo site_url("faq/finally_update_faq") ?>">
								<div class="form-body overflow-hide">
									<div class="form-group">
										<label class="control-label mb-10" for="quetion">Question</label>
										<div class="input-group">
											<div class="input-group-addon"><i class="fa fa-question-circle-o"></i></div>
											<input type="text" name="quetion" class="form-control" id="quetion" value="<?php echo $datas[0]->question; ?>" required="">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label mb-10" for="answer">Answer</label>
										<div class="input-group">
											<div class="input-group-addon"><i class="fa fa-check"></i></div>
											<input type="text" name="answer" class="form-control" id="answer" value="<?php echo $datas[0]->answer; ?>" required="">
											<input type="hidden" name="uid" value="<?php echo $datas[0]->F_Id; ?>" >
										</div>
									</div>
									<div id="appendeddiv">
									</div>
									<div class="form-actions mt-10">			
                                        <button type="submit" class="btn btn-info btn-anim">Submit</button>
                                    </div>	
								</div>
							 </form>
						</div>
					</div>
				</div>
			</div>
			<!-- End Main Content -->
    </div>

<?php
include("footer_include.php");
?>
</body>
</html>