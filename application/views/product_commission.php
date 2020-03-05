<?php
include("header_body.php");
?>
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Product Commission
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
                                <strong><?php echo $this->session->flashdata('message_com'); ?> </strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div id="failMessage" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><?php echo $this->session->flashdata('fail_message_com'); ?></strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
							<form name="frm" method="post" action="<?php echo site_url("product_commission/addcommission") ?>">
                                    <div class="txt-dark">
                                        Note - here enter Commission percentage value like 10,20,30 any one, and then
                                        calculation suppose product price is $100 and you enter product commission 10 <br>
                                        then calculation on commission is $10 for every product.<br><br>
                                    </div>
                                    <div class="form-body overflow-hide">
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="procommission">ADD Product Commission %</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-percent"></i></div>
                                                <input type="text" name="procommission" class="form-control" id="procommission" value="<?php
                                                if ($charge['comm_charge'] != '') {
                                                    echo $charge['comm_charge'];
                                                }
                                                ?>" required="">
                                                <input type="hidden" name="Pcc_Id" value="<?php
                                                if ($charge['Pcc_Id'] != '') {
                                                    echo $charge['Pcc_Id'];
                                                } else {
                                                    echo 0;
                                                }
                                                ?>">
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
										<th>Item FrontPicture</th>
										<th>User Name</th>
										<th>Item Name</th>
										<th>Item Price</th>
										<th>commission Charge%</th>
										<th>Laced Commission</th>	
                                    </tr>
                                    </thead>
                                    <tbody>                                   
									<?php
										if ($comlist) {
											$cnt = 1;
											foreach ($comlist as $item) {
												?>
												<tr>
													<td><?php echo $cnt++; ?></td>
													<td><img src="<?php echo base_url() ?>./Items/<?php echo $item->Item_FrontPicture; ?>" height="50" width="50"></td>
													<td><?php echo $item->User_Name; ?></td>
													<td><?php echo $item->Item_Name; ?></td>
													<td><?php echo $item->product_price; ?></td>
													<td><?php echo $item->product_commission_rate; ?></td>
													<td><?php echo $item->product_commission; ?></td>
												</tr>
												<?php
											}
										} else {
											echo "<tr><td colspan='12'>No any Product Commission Item Found!</td></tr>";
										}
									?>             
									</tbody>
									<tfoot>
                                    <tr>
                                        <th>serial no</th>
										<th>Item FrontPicture</th>
										<th>User Name</th>
										<th>Item Name</th>
										<th>Item Price</th>
										<th>commission Charge%</th>
										<th>Laced Commission</th>	
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

<?php if (validation_errors()) { ?>
                setTimeout(function () {
                    $('#validationerror').fadeOut('slow');
                }, 10000);
<?php } ?>

<?php if (empty($this->session->flashdata('message_com'))) { ?>
                $('#successMessage').hide();
<?php } else { ?>
                setTimeout(function () {
                    $('#successMessage').fadeOut('slow');
                }, 5000);
<?php } ?>

<?php if (empty($this->session->flashdata('fail_message_com'))) { ?>
                $('#failMessage').hide();
<?php } else { ?>
                setTimeout(function () {
                    $('#failMessage').fadeOut('slow');
                }, 5000);
<?php } ?>
</script>