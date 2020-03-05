<?php
include("header_body.php");
?>

<section class="admin-content">
        <div class="bg-dark m-b-30">
            <div class="container">
                <div class="row p-b-60 p-t-60">

                    <div class="col-md-10 mx-auto text-center text-white p-b-30">
                        <div class="m-b-20">       
                        </div>
                        <h1>DASHBOARD</h1>
                    </div>

                </div>
            </div>
        </div>
        <div class="container pull-up">
            <div class="row">
                <div class="col-lg-3 col-md-6 m-b-30">
                    <div class="card card-hover">
                        <div class="card-body">
                            <div class="text-center p-t-20">
                                <div class="avatar-lg avatar">
                                    <div class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-account-group h1 m-0"></i></div>

                                </div>
                                <div class="text-center">
                                    <h1 class="fw-600 p-t-20"><?php echo $totaluser; ?></h1>
                                    <p class="text-muted fw-600">Users</p>                     
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				 <div class="col-lg-3 col-md-6 m-b-30">
                    <div class="card card-hover">
                        <div class="card-body">
                            <div class="text-center p-t-20">
                                <div class="avatar-lg avatar">
                                    <div class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-account-plus h1 m-0"></i></div>

                                </div>
                                <div class="text-center">
                                    <h1 class="fw-600 p-t-20"><?php echo $activeuser; ?></h1>
                                    <p class="text-muted fw-600">Active Users</p>                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				 <div class="col-lg-3 col-md-6 m-b-30">
                    <div class="card card-hover">
                        <div class="card-body">
                            <div class="text-center p-t-20">
                                <div class="avatar-lg avatar">
                                    <div class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-bell h1 m-0"></i></div>

                                </div>
                                <div class="text-center">
                                    <h1 class="fw-600 p-t-20"><?php echo $usernoti; ?></h1>
                                    <p class="text-muted fw-600">User Notification</p>                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				 <div class="col-lg-3 col-md-6 m-b-30">
                    <div class="card card-hover">
                        <div class="card-body">
                            <div class="text-center p-t-20">
                                <div class="avatar-lg avatar">
                                    <div class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-bell-outline h1 m-0"></i></div>

                                </div>
                                <div class="text-center">
                                    <h1 class="fw-600 p-t-20"><?php echo $adminnoti; ?></h1>
                                    <p class="text-muted fw-600">Admin Notification</p>                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				 <div class="col-lg-3 col-md-6 m-b-30">
                    <div class="card card-hover">
                        <div class="card-body">
                            <div class="text-center p-t-20">
                                <div class="avatar-lg avatar">
                                    <div class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-cart h1 m-0"></i></div>

                                </div>
                                <div class="text-center">
                                    <h1 class="fw-600 p-t-20"><?php echo $instabuyproduct; ?></h1>
                                    <p class="text-muted fw-600"> Instabuy Product</p>                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				 <div class="col-lg-3 col-md-6 m-b-30">
                    <div class="card card-hover">
                        <div class="card-body">
                            <div class="text-center p-t-20">
                                <div class="avatar-lg avatar">
                                    <div class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-trending-up h1 m-0"></i></div>

                                </div>
                                <div class="text-center">
                                    <h1 class="fw-600 p-t-20"><?php echo $tradeproduct; ?></h1>
                                    <p class="text-muted fw-600">Trade Product</p>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 m-b-30">
                    <div class="card card-hover">
                        <div class="card-body">
                            <div class="text-center p-t-20">
                                <div class="avatar-lg avatar">
                                    <div class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-gavel h1 m-0"></i></div>

                                </div>
                                <div class="text-center">
                                    <h1 class="fw-600 p-t-20"><?php echo $auctionproduct; ?></h1>
                                    <p class="text-muted fw-600">Auction Product</p>                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-lg-3 col-md-6 m-b-30">
                    <div class="card card-hover">
                        <div class="card-body">
                            <div class="text-center p-t-20">
                                <div class="avatar-lg avatar">
                                    <div class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-shopping h1 m-0"></i></div>

                                </div>
                                <div class="text-center">
                                    <h1 class="fw-600 p-t-20"><?php echo $totalproduct; ?></h1>
                                    <p class="text-muted fw-600">Total Product</p>                           
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-lg-3 col-md-6 m-b-30">
                    <div class="card card-hover">
                        <div class="card-body">
                            <div class="text-center p-t-20">
                                <div class="avatar-lg avatar">
                                    <div class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-check h1 m-0"></i></div>

                                </div>
                                <div class="text-center">
                                    <h1 class="fw-600 p-t-20"><?php echo $approveproduct; ?></h1>
                                    <p class="text-muted fw-600">Approve Product</p>                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-lg-3 col-md-6 m-b-30">
                    <div class="card card-hover">
                        <div class="card-body">
                            <div class="text-center p-t-20">
                                <div class="avatar-lg avatar">
                                    <div class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-timer m-0"></i></div>

                                </div>
                                <div class="text-center">
                                    <h1 class="fw-600 p-t-20"><?php echo $pendingapproveproduct; ?></h1>
                                    <p class="text-muted fw-600">Pending for Approval Product</p>                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 m-b-30">
                    <div class="card card-hover">
                        <div class="card-body">
                            <div class="text-center p-t-20">
                                <div class="avatar-lg avatar">
                                    <div class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-animation h1 m-0"></i></div>

                                </div>
                                <div class="text-center">
                                    <h1 class="fw-600 p-t-20"><?php echo $totalorder; ?></h1>
                                    <p class="text-muted fw-600">Total Order</p>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 m-b-30">
                    <div class="card card-hover">
                        <div class="card-body">
                            <div class="text-center p-t-20">
                                <div class="avatar-lg avatar">
                                    <div class="avatar-title rounded-circle badge-soft-success"><i
                                                class="mdi mdi-monitor-cellphone-star h1 m-0"></i></div>

                                </div>
                                <div class="text-center">
                                    <h1 class="fw-600 p-t-20"><?php echo number_format($rating,2);?></h1>
                                    <p class="text-muted fw-600">Users rating Average</p>                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
include("footer_include.php");
?>