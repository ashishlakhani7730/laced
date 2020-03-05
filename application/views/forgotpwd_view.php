<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>Laced Admin </title>
        <meta name="description" content="laced admin" />
        <meta name="keywords" content="laced admin" />

        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.ico">
        <link rel="icon" class="brand-img" href="<?php echo base_url() ?>assets/dist/img/Favicon.png" type="image/x-icon" height="100">

        <!-- vector map CSS -->
        <link href="<?php echo base_url(); ?>assets/vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <!-- Custom CSS -->
        <link href="<?php echo base_url(); ?>assets/dist/css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <!--Preloader-->
        <div class="preloader-it">
            <div class="la-anim-1"></div>
        </div>
        <!--/Preloader-->

        <div class="wrapper pa-0">
            <header class="sp-header">


                <div class="clearfix"></div>
            </header>

            <!-- Main Content -->
            <div class="page-wrapper pa-0 ma-0 auth-page">
                <div class="container-fluid">
                    <!-- Row -->
                    <div class="table-struct full-width full-height">
                        <div class="table-cell vertical-align-middle auth-form-wrap">
                            <div class="auth-form  ml-auto mr-auto no-float">
                                <div class="row card-view">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="mb-30">
                                            <div class="text-center">
                                            <img class="brand-img" src="http://golaced.com/admin/assets/dist/img/logo.png" height="60" >
                                            </div>
                                            <h3 class="text-center txt-dark mb-10">Forgot password</h3>

                                        </div>	
                                        <div class="form-wrap">
                                            <?php
                                            $msg = $this->session->flashdata('message');
                                            if ($msg != "") {
                                                ?>
                                                <div class="alert alert-success" role="alert">
                                                    <?php
                                                    echo "$msg";
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            $msg = $this->session->flashdata('fail_message');
                                            if ($msg != "") {
                                                ?>
                                                <div class="alert alert-info" role="alert">
                                                    <?php
                                                    echo "$msg";
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        <div class="form-wrap">
                                            <form name="frm" method="post" action="<?php echo site_url("login/forgotpass") ?>">
                                                <div class="form-group">
                                                    <label class="control-label mb-10" for="exampleInputEmail_2">Email address</label>
                                                    <input type="text" name="Admin_Email" class="form-control" required="" id="exampleInputEmail_2" placeholder="Enter email">
                                                </div>
                                                 <div><p align="right"> <a   href="<?php echo site_url("login/index") ?>" style="color:#506cf0; ">sign in</a></p></div>

                                                
                                                <div class="form-group text-center">
                                                    <button type="submit" class="btn btn-info btn-rounded">submit</button>
                                                </div>
                                            </form>
                                         </div>
                                    </div>	
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Row -->	
                </div>

            </div>
            <!-- /Main Content -->

        </div>
        <!-- /#wrapper -->

        <!-- JavaScript -->

        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>assets/vendors/bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url(); ?>assets/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>

        <!-- Slimscroll JavaScript -->
        <script src="<?php echo base_url(); ?>assets/dist/js/jquery.slimscroll.js"></script>

        <!-- Init JavaScript -->
        <script src="<?php echo base_url(); ?>assets/dist/js/init.js"></script>
    <script>
    $(function(){
        window.setTimeout(function()
        {
            $(".alert").fadeTo(500,0).slideUp(500,function()
            {
                $(this).remove();
            });
        },2000);
        //$("#example").DataTable();
    });
	

	<?php if(validation_errors()) { ?>
	setTimeout(function() {
				$('#validationerror').fadeOut('slow');
            }, 10000);
	<?php } ?>
	<?php if(empty($this->session->flashdata('message'))) { ?>
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
</body>
</html>