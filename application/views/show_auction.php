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
                        <h5 class="txt-dark">Auction table</h5>
                    </div>
                    
                    <p align="right"><button class="btn btn-warning btn-anim"><a href="<?php echo site_url('auction/add') ?>"> add</a></button></p>
                    <!-- Breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="index.html">Dashboard</a></li>
                            <li><a href="#"><span>table</span></a></li>
                            <li class="active"><span>auction table</span></li>
                        </ol>
                    </div>
                    <!-- /Breadcrumb -->
                </div>

                <!-- Row -->



                <?php if(validation_errors()) { ?>
				<div id="validationerror" class="alert alert-info alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo validation_errors(); ?>
				</div>						
				<?php } ?>
				<div id="successMessage" class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $this->session->flashdata('message'); ?> 
				</div>
				<div id="failMessage" class="alert alert-info alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $this->session->flashdata('fail_message'); ?>
				</div>


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
                                                        <th>Item Name</th>
                                                        <th>Auction Start Time</th>
                                                        <th>Action End Time  </th>

                                                        <th>action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    $cnt = 1;
                                                    foreach ($auction_list as $auction) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $cnt++ ?></td>
                                                            <td><?php echo $auction->Item_Name ?></td>
                                                            <td><?php echo $auction->Auction_Start_Time ?></td>
                                                            <td><?php echo $auction->Action_End_Time ?></td>



                                                            <td><div class="input-group-btn">
                                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo site_url("auction/delete_data/$auction->Auction_Id") ?>"><span class="fa fa-trash-o"> &nbsp;    Delete</span></a></li>
                                                                        <li><a onclick="return confirm('Are you sure you want to edit this item?');" href="<?php echo site_url("auction/edit_data/$auction->Auction_Id") ?>"><span class="fa fa-edit"> &nbsp;  Edit</span></a></li>

                                                                    </ul>
                                                                </div>  
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
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
