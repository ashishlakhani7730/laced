<?php
include("header_body.php");
?>
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Profile
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="container  pull-up">
            <div class="row">
                <div class="col-4">
                    <div class="card">

                        <div class="card-body">
                            <?php
                                            if (isset($update_profile)) {
                                                ?>
                                                <form name="frm" method="post" action="<?php echo site_url("profile/change_profile") ?>" enctype="multipart/form-data">

                                                    <input type="hidden" name="Admin_Id" value="<?php echo $update_profile['Admin_Id'] ?>">

                                                    <div class="profile-img-wrap">
                                                        <img class="inline-block mb-10" src="<?php if($update_profile['Admin_ProfilePic']){ echo base_url() ?>./Items/<?php echo $update_profile['Admin_ProfilePic']; } else { echo base_url()."/Items/2050919978818f175884327f0c5195706003ac66095b0fec6d18b23.png"; }?>" >
                                                        
                                                        <div class="fileupload btn btn-default">
                                                            <span class="btn-text">edit</span>
                                                           
                                                            <input type="file" name="upload" class="upload" value="<?php echo $update_profile['Admin_ProfilePic'] ?>">
                                                            <input type="hidden" name="Admin_ProfilePic" value="<?php echo $update_profile['Admin_ProfilePic']; ?>" >
                                                            
                                                            
                                                        </div>
                                                        
                                                    </div>

                                                    <h5 class="block mt-10 mb-5 weight-500 capitalize-font txt-danger"><?php echo $update_profile['Admin_Name']; ?></h5>
                                                    <h6 class="block capitalize-font pb-20"><?php echo $update_profile['Admin_Role']; ?></h6>

                                                    <div class="form-actions mt-10">  
                                                        <!--<button type="submit" class="btn btn-drk " ></i><span class="btn-text">Update ProfilePic</span></button>-->
                                                        <button type="submit" class="btn btn-primary btn-anim">Update ProfilePic</button>
                                                    </div>

                                                    </form>
                                                                            <?php
                                                                        }
                                                                        ?>
                        </div>
                    </div>
                </div>
				<div class="col-8">
                    <div class="card">

                        <div class="card-body">
                             <?php
                                            if (isset($update_data)) {
                                                ?>
                                                <form name="frm" method="post" action="<?php echo site_url("profile/editp") ?>" enctype="multipart/form-data">

                                                                            <input type="hidden" name="Admin_Id" class="form-control" value="<?php echo $update_data['Admin_Id'] ?>">

                                                                            <div class="form-body overflow-hide">
                                                                                <div class="form-group">
                                                                                    <label class="control-label mb-10" for="exampleInputuname_1">User Name</label>
                                                                                    <div class="input-group">
                                                                                        <div class="input-group-addon"><i class="icon-user"></i></div>
                                                                                        <input type="text" name="Admin_UserName" class="form-control" id="exampleInputuname_1" value="<?php echo $update_data['Admin_UserName'] ?>" required="">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="control-label mb-10" for="exampleInputEmail_1">Email address</label>
                                                                                    <div class="input-group">
                                                                                        <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                                                                                        <input type="text" name="Admin_Email" class="form-control" id="exampleInputEmail_1" value="<?php echo $update_data['Admin_Email'] ?>" required="">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="control-label mb-10" for="exampleInputContact_1">Contact number</label>
                                                                                    <div class="input-group">
                                                                                        <div class="input-group-addon"><i class="icon-phone"></i></div>
                                                                                        <input type="text" name="Admin_Phone" class="form-control" id="exampleInputContact_1" value="<?php echo $update_data['Admin_Phone'] ?>" required="">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="control-label mb-10" for="exampleInputContact_1">Address</label>
                                                                                    <div class="input-group">
                                                                                        <div class="input-group-addon"><i class="icon-map"></i></div>
                                                                                        <input type="text" name="Admin_Address" class="form-control" id="exampleInputContact_1" value="<?php echo $update_data['Admin_Address'] ?>" required="">
                                                                                    </div>
                                                                                </div>



                                                                            </div>
                                                                            <div class="form-actions mb-10">			
                                                                                <button type="submit" class="btn btn-primary btn-anim">Update profile</button>
                                                                            </div>				
                                                                            </form>
                                                                            <?php
                                                                        }
                                                                        ?>
                        </div>
                    </div>
                </div>
				<div class="col-12" style="margin-top:20px">
                    <div class="card">

                        <div class="card-body">
                            <form name="frm" method="post" action="<?php echo site_url("changepwd/change_pass") ?>">
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
                                            <h3 class="text-left txt-dark mb-10">Change Password</h3>
                                            <div class="form-group">
                                                <label class="control-label mb-10 text-left" for="example-email">old password </label>
                                                <input type="password"  name="oldpassword" class="form-control" placeholder="enater old password" required="">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-10 text-left" for="example-email">new password</label>
                                                <input type="password"  name="newpassword" class="form-control" placeholder="enater new password" required="">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-10 text-left" for="example-email">Confirm Password</label>
                                                <input type="password" name="cpassword" class="form-control" placeholder="enter Confirm Password" required="">
                                            </div>
                                            <div class="form-group"> 
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-primary btn-anim"><i class="icon-rocket"></i><span class="btn-text">submit</span></button>
                                                </div>
                                            </div>
                                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>     
    </section>
</main>
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
	
	<?php if(empty($this->session->flashdata('message1'))) { ?>
			$('#successMessage1').hide();
	<?php } else { ?>
			setTimeout(function() {
				$('#successMessage1').fadeOut('slow');
            }, 5000);
	<?php } ?>
	
	<?php if(empty($this->session->flashdata('fail_message'))) { ?>
			$('#failMessage').hide();
	<?php } else { ?>
			setTimeout(function() {
				$('#failMessage').fadeOut('slow');
            }, 5000);
	<?php } ?>
	
		<?php if(empty($this->session->flashdata('fail_message1'))) { ?>
			$('#failMessage1').hide();
	<?php } else { ?>
			setTimeout(function() {
				$('#failMessage1').fadeOut('slow');
            }, 5000);
	<?php } ?>
	</script>