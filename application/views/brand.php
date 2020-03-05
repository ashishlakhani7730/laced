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
							<div>
								<strong>Note -</strong>Brnad Image Only Allow jpg, jpeg, png Format Only.
							</div>
							 <form name="frm" method="post" action="<?php echo site_url("brand/addbrand") ?>" enctype="multipart/form-data">
								<div class="form-body overflow-hide">
									<div class="form-group">
									<label class="control-label mb-10" for="quetion">Select Image</label>
									<div class="input-group">
									<div class="btn btn-primary btn-anim"><i class="fa fa-upload"></i><span class="btn-text">Upload Brand Image</span>
										<input type="file" name="brandi" class="upload">
									</div>
									</div>
									</div>
									<div class="form-group">
										<label class="control-label mb-10" for="quetion">Brand Name</label>
										<div class="input-group">
											
											<input type="text" name="brand" class="form-control" id="quetion" value="<?php ?>" required="">
										</div>
									</div>
									<div class="form-actions mb-10">			
                                        <button type="submit" class="btn btn-primary btn-anim">Submit</button>
                                    </div>	
								</div>
							 </form>
					</div>
					</div>
				</div>
			</div>
			<div style="margin:20px">
			</div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive p-t-10">
                                <table id="example" class="table   " style="width:100%">
                                    <thead>
                                    <tr>
                                       <th>serial no</th>
									   <th>Brand Image</th>
									   <th>Brand Name</th>
									   <th>action</th>	
                                    </tr>
                                    </thead>
                                    <tbody>                                   
									<?php
									if($brand_list)
									{
										$cnt = 1;
										foreach ($brand_list as $brand) {
											?>
											<tr>
												<td><?php echo $cnt++ ?></td>	
												<td><img src="<?php echo base_url().$brand->Brand_Logo; ?>" height="50" width="50"></td>
												<td><?php echo $brand->Brand_Name ?></td>
												
												<td><div class="input-group-btn">
														<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>

														<ul class="dropdown-menu dropdown-menu-right">   
															<li><a  class="dropdown-item" href="<?php echo site_url("brand/update_data/$brand->Brand_Id") ?>"><span class="fa fa-edit"> &nbsp;    Update</span></a></li>
															<li> <a class="dropdown-item" onclick="return confirm('Are you sure you want to delete this brand?');" href="<?php echo site_url("Brand/delete_data/$brand->Brand_Id") ?>" ><span class="fa fa-trash-o"> &nbsp;    Delete</span></a></li>
														</ul>
													</div>  
												</td>
											</tr>
											<?php
										}
									}
									else
									{
										echo "<tr><td colspan='12'>No any Brand Found</td></tr>";
									}
									?>             
									</tbody>
									<tfoot>
                                    <tr>
                                       <th>serial no</th>
									   <th>Brand Image</th>
									   <th>Brand Name</th>
									   <th>action</th>	
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
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
	<?php if(empty($this->session->flashdata('message_brand'))) { ?>
			$('#successMessage').hide();
	<?php } else { ?>
			setTimeout(function() {
				$('#successMessage').fadeOut('slow');
            }, 5000);
	<?php } ?>
	
	<?php if(empty($this->session->flashdata('brand_fail_message'))) { ?>
			$('#failMessage').hide();
	<?php } else { ?>
			setTimeout(function() {
				$('#failMessage').fadeOut('slow');
            }, 5000);
	<?php } ?>

</script>