<?php
include("header_body.php");
//echo "<pre>";print_r($order); exit;
?>      
<section class="admin-content">
        <div class="bg-dark m-b-30">
            <div class="container">
                <div class="row p-b-60 p-t-60">

                    <div class="col-md-6 text-white p-b-30">
                        <div class="media">
                            <div class="avatar avatar-xl mr-3">
							<?php if($user[0]->User_ProfilePic != '') {?>
                                <img src="<?php echo base_url()."/Items/".$user[0]->User_ProfilePic; ?>" class="rounded-circle" alt="">
							<?php } else { ?>
								<img src="<?php echo base_url()."/Items/nouser.png"; ?>" class="rounded-circle" alt="">
							<?php } ?>
                            </div>
                            <div class="media-body">
                                <h1><?php echo $user[0]->User_FullName; ?>
                            </div>
                        </div>

                    </div>
      
                </div>
            </div>
        </div>
        <div class="container pull-up">
            <div class="row">
                <div class="col-lg-6 order-1 order-lg-0 m-b-30">
                    <div class="card m-b-30">

                        <div class="card-header">
                            <div class="card-title">
                                <div class="avatar mr-2 avatar-xs">
                                    <div class="avatar-title bg-dark rounded-circle">
                                        <i class="mdi mdi-run mdi-18px"></i>
                                    </div>
                                </div>
                                USER INFO
                            </div>

                        </div>
                        <div class="list-group list  list-group-flush">	
							<?php if($user[0]->User_Status != "") { ?>
                            <div class="list-group-item p-all-15 h6 ">
                                <i class="mdi mdi-artstation"></i> Status -  <?php if($user[0]->User_Status == 1){ echo "Active"; }else{ echo "Pending For approval";}?> 
                            </div>
							<?php } ?>
							<?php if($user[0]->User_verified != "") { ?>
                            <div class="list-group-item p-all-15 h6 ">
                                <i class="mdi mdi-account-check"></i> User Verify -  <?php if($user[0]->User_verified == 1){ echo "Verify"; }else{ echo "Pending For Add Payment Detail";}?> 
                            </div>
							<?php } ?>
                            <div class="list-group-item p-all-15 h6 ">
                                <i class="mdi mdi-account"></i> User Name - <?php echo $user[0]->User_Name; ?>
                            </div>
                            <div class="list-group-item p-all-15 h6 ">
                                <i class="mdi mdi-email"></i> Email ID - <?php echo $user[0]->User_Email; ?>
                            </div>
                            <div class="list-group-item p-all-15 h6 ">
                                <i class="mdi mdi-cellphone-iphone"></i> Phone No - <?php echo $user[0]->User_Phone; ?>
                            </div>
							<?php if($user[0]->User_Address != "") { ?>
                            <div class="list-group-item p-all-15 h6 ">
                                <i class="mdi mdi-map-marker"></i> Address -  <?php echo $user[0]->User_Address;?> 
                            </div>
							<?php } ?>
							<?php if($user[0]->User_City != "") { ?>
                            <div class="list-group-item p-all-15 h6 ">
                                <i class="mdi mdi-map-marker"></i> City -  <?php echo $user[0]->User_City;?> 
                            </div>
							<?php } ?>
							<?php if($user[0]->User_State != "") { ?>
                            <div class="list-group-item p-all-15 h6 ">
                                <i class="mdi mdi-map-marker"></i> State -  <?php echo $user[0]->User_State;?> 
                            </div>
							<?php } ?>
							<?php if($user[0]->created != "") { ?>
                            <div class="list-group-item p-all-15 h6 ">
                                <i class="mdi mdi-calendar"></i> Register Date -  <?php echo $user[0]->created;?> 
                            </div>
							<?php } ?>
                        </div>
                    </div>
					</div>
					 <div class="col-lg-6 order-1 order-lg-0 m-b-30">
					<div class="card m-b-30">

                        <div class="card-header">
                            <div class="card-title">
                                <div class="avatar mr-2 avatar-xs">
                                    <div class="avatar-title bg-dark rounded-circle">
                                        <i class="mdi mdi-scale-balance mdi-18px"></i>
                                    </div>
                                </div>
                                Balance Info
                            </div>

                        </div>
                        <div class="list-group list  list-group-flush">										
							
                            <div class="list-group-item p-all-15 h6 ">
                                <i class="mdi mdi-ticket-account"></i> Reward -  <?php if($user[0]->User_Reward == ""){echo "0";} else { echo $user[0]->User_Reward;}?> 
                            </div>
							
							<?php if($user[0]->wallet_balance != "") { ?>
                            <div class="list-group-item p-all-15 h6 ">
                                <i class="mdi mdi-wallet"></i> Wallet Balance -  <?php echo $user[0]->wallet_balance;?> 
                            </div>
							<?php } ?>
                        </div>
                    </div>                                         
                </div>
            </div>
			<div class="row">
			 <div class="col-lg-12 m-b-30">
                    <div class="card">
					<div class="card-header">
					<div class="card-title">
                                <div class="avatar mr-2 avatar-xs">
                                    <div class="avatar-title bg-dark rounded-circle">
                                        <i class="mdi mdi-format-list-bulleted mdi-18px"></i>
                                    </div>
                                </div>
                                Order List
                            </div>
							</div>
					<div class="card-body">
                        <div class="table-responsive p-t-10">
                                <table id="example" class="table   " style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Item Name</th>
                                        <th>Order Id</th>
                                        <th>Byuer Name</th>
                                        <th>Seller Name</th>
										<th>Type Of Sale</th>
										<th>Price Paid</th>
										<th>Byuer Tracking No</th>
										<th>Seller Tracking No</th>
										<th>Date</th>
										<th>Packege Slip</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                     <?php
                                            $cnt = 1;
                                            foreach ($orders as $order) {
                                                ?>
												<tr>												
													<td><img src="<?php echo base_url() ?>./Items/<?php echo $order->Item_FrontPicture ?>" height="50" width="50"></td>
													<td>
													<?php echo $order->Item_Name; ?>
													</td>
													<td>
													</td>
													<td>
													<?php echo $user[0]->User_Name; ?>
													</td>
													<td>
													<?php echo $order->User_FullName; ?>
													</td>
													<td>
													<?php echo $order->Order_Type; ?>
													</td>
													<td>
													<?php echo $order->Item_NormalPrice; ?>
													</td>
													<td>
													<?php echo $order->Tracking_No1; ?>
													</td>
													<td>
													<?php echo $order->Tracking_No2; ?>
													</td>
													<td>
													<?php echo $order->created; ?>
													</td>
													<td>											
													</td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
									</tbody>
									<tfoot>
                                    <tr>
                                        <th>Image</th>
                                        <th>Item Name</th>
                                        <th>Order Id</th>
                                        <th>Byuer Name</th>
                                        <th>Seller Name</th>
										<th>Type Of Sale</th>
										<th>Price Paid</th>
										<th>Byuer Tracking No</th>
										<th>Seller Tracking No</th>
										<th>Date</th>
										<th>Packege Slip</th>        
                                    </tr>
                                    </tfoot>
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