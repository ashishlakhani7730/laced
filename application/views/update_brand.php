<?php
include("header_body.php");
?>
	<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Add Brand
                        </h4>
                    </div>
                </div>
            </div>
        </div>
		
        <div class="container  pull-up">
			<div class="row">
                <div class="col-12">
                    <div class="card">
					 <div class="card-body">

                    <?php if(validation_errors()) { ?>
							<div id="validationerror" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><?php echo validation_errors(); ?></strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
							<?php } ?>
							<div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><?php echo $this->session->flashdata('message_brand'); ?> </strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div id="failMessage" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><?php echo $this->session->flashdata('brand_fail_message'); ?></strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
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
                                <div>
                                    <strong>Note -</strong>Brnad Image Only Allow jpg, jpeg, png Format Only.
                                </div>
                                
                                <form name="frm" method="post" action="<?php echo site_url("brand/finallyupdate") ?>" enctype="multipart/form-data">
                                    <div class="form-body overflow-hide">

                                        <div class="control-label mb-10">Already Brand Image Is</div>

                                        <img id="img" src="<?php echo base_url() . $update_datas['Brand_Logo']; ?>" width="100px" height="100px">
                                        <input type="hidden" name="Brand_Logo" value="<?php echo $update_datas['Brand_Logo']; ?>" >
                                        <input type="hidden" name="Brand_Id" value="<?php echo $update_datas['Brand_Id']; ?>"
                                               <div class="form-group">
                                            <label class="control-label mb-10" for="quetion">Select New Image</label>
                                            <div class="input-group">
                                                <div class="btn btn-primary btn-anim"><i class="fa fa-upload"></i><span class="btn-text">Upload to Update Brand Image</span>
                                                    <input type="file" name="brandi" class="upload">
                                                    <input type="hidden" name="Brand_Logo" value="<?php echo $update_datas['Brand_Logo']; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="quetion">Brand Name</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-tags"></i></div>
                                                <input type="text" name="Brand_Name" class="form-control" id="quetion" value="<?php echo $update_datas['Brand_Name']; ?>" required="">
                                            </div>
                                        </div>
                                        <div class="form-actions mb-10">			
                                            <button type="submit" class="btn btn-primary btn-anim">Submit</button>
                                        </div>	
                                </form>
                            </div>

                        </div>
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

<?php if (validation_errors()) { ?>
        setTimeout(function () {
            $('#validationerror').fadeOut('slow');
        }, 10000);
<?php } ?>
<?php if (empty($this->session->flashdata('message_brand'))) { ?>
        $('#successMessage').hide();
<?php } else { ?>
        setTimeout(function () {
            $('#successMessage').fadeOut('slow');
        }, 5000);
<?php } ?>

<?php if (empty($this->session->flashdata('brand_fail_message'))) { ?>
        $('#failMessage').hide();
<?php } else { ?>
        setTimeout(function () {
            $('#failMessage').fadeOut('slow');
        }, 5000);
<?php } ?>

</script>