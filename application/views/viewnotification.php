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
        <!-- Title -->
        <div class="page-wrapper">
            <div class="container-fluid">
                <!-- Title -->
                <div class="row heading-bg">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h5 class="txt-dark">All Notification</h5>
                    </div>
                    <!-- Breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'home/index'; ?>">Dashboard</a></li>
                            <li><a href="#"><span>Notification List</span></a></li>
                        </ol>
                    </div>
                    <!-- /Breadcrumb -->
                </div>
                <!-- Row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default card-view">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark"></h6>

                                </div>                
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                   <div class="table-wrap">
										<div class="table-responsive">
											<table id="datable_1" class="table table-hover display  pb-30" >
                                                <thead>
                                                    <tr>
                                                        <th>serial no</th>
                                                        <th>User Pic</th>
                                                        <th>User Name</th>
                                                        <th>Notification Title</th>
                                                        <th>Notification Message</th>                        
                                                    </tr>
                                                </thead>
                                                <?php
												if($noti_list)
												{
													$cnt = 1;
													foreach ($noti_list as $not) {
														?>
														<tr>
															<td><?php echo $cnt++; ?></td>
															<td><img src="<?php echo base_url(); ?>./Items/<?php echo $not->User_ProfilePic; ?>" height="50" width="50"></td>
															<td><?php echo $not->User_Name; ?></td>	
															<td><?php echo $not->Notification_Title; ?></td>
															<td><?php echo $not->Notification_Message; ?></td>
														</tr>
														<?php
													}
												}
												else
												{
													echo "<tr><td colspan='12'>No any Notification</td></tr>";
												}
                                            ?>
                                            </table>
										</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>         
                </div>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->

        <!-- Footer -->
        <footer class="footer container-fluid pl-30 pr-30">
            <div class="row">
                <div class="col-sm-12">
                    
                </div>
            </div>
        </footer>
        <!-- /Footer -->

<?php
include("footer_include.php");
?>
<script>
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
</script>
</body>
</html>