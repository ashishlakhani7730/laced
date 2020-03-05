<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<title>LACED Admin</title>
<link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/logo.png"/>
<link rel="icon" href="<?php echo base_url(); ?>assets/img/logo.png" type="image/png" sizes="16x16">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/pace/pace.css">
<script src="<?php echo base_url(); ?>assets/vendor/pace/pace.min.js"></script>
<!--vendors-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/jquery-scrollbar/jquery.scrollbar.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2/css/select2.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/timepicker/bootstrap-timepicker.min.css">
<link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/jost/jost.css">
<!--Material Icons-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/fonts/materialdesignicons/materialdesignicons.min.css">
<!--Bootstrap + atmos Admin CSS-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/atmos.min.css">
<!-- Additional library for page -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/DataTables/datatables.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
<link href="<?php echo base_url(); ?>assets/vendor/swal2/sweetalert2.min.css" rel="stylesheet" type="text/css">

</head>
<body class="sidebar-pinned page-home">
<aside class="admin-sidebar">
    <div class="admin-sidebar-brand">
        <!-- begin sidebar branding-->
        <!--<img class="admin-brand-logo" src="<?php //echo base_url(); ?>assets/img/logo.png" width="40" alt="atmos Logo">-->
        <span class="admin-brand-content font-secondary"><a href="index.html">  LACED</a></span>
        <!-- end sidebar branding-->
        <div class="ml-auto">
            <!-- sidebar pin-->
            <a href="#" class="admin-pin-sidebar btn-ghost btn btn-rounded-circle"></a>
            <!-- sidebar close for mobile device-->
            <a href="#" class="admin-close-sidebar"></a>
        </div>
    </div>
	<?php
        $currentClass = $this->router->fetch_class();
        $currentMethod = $this->router->fetch_method();
		$Admin_Role = $this->session->userdata('Admin_Role') ? explode(',', $this->session->userdata('Admin_Role')) : '';
		$admintype =$this->session->userdata('Admin_Type');
    ?>
    <div class="admin-sidebar-wrapper js-scrollbar">
        <ul class="menu">
		<?php if (in_array(1, $Admin_Role)) { ?>
            <li class="menu-item <?= $currentClass == 'home' && $currentMethod == 'index' ? 'active' : '' ?> ">
                <a href="<?php echo site_url("home") ?>" class="menu-link">
                        <span class="menu-label">
                                                <span class="menu-name">Dashboard                                                 
                                                </span>

                                            </span>
                    <span class="menu-icon">
                                                 <i class="icon-placeholder mdi mdi-desktop-mac-dashboard "></i>
                                            </span>
                </a>
            </li>
		<?php } ?>
		<?php if (in_array(2, $Admin_Role)) { ?>
            <li class="menu-item <?= $currentClass == 'user' && $currentMethod == 'index' ? 'active' : '' ?>">
                <a href="#" class="open-dropdown menu-link">
                        <span class="menu-label">
                                                <span class="menu-name">Users
                                                    <span class="menu-arrow"></span>
                                                </span>

                                            </span>
                    <span class="menu-icon">
                                                 <i class="icon-placeholder mdi mdi-account-group "></i>
                                            </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu " >

                    <li class="menu-item <?= $currentClass == 'user' && $currentMethod == 'index' ? 'active' : '' ?>">
                        <a href="<?php echo site_url("user") ?>" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">All Users
                                                </span>
                                            </span>
                            <span class="menu-icon">
                                                    <!--<span class="icon-badge">10</span>-->
                                                    <i class="icon-placeholder mdi mdi-account-multiple "></i>
                                            </span>
                        </a>
                    </li>
                    <li class="menu-item <?= $currentClass == 'user' && $currentMethod == 'user_ver' ? 'active' : '' ?>">
                        <a href="<?php echo site_url("user/user_ver") ?>" class=" menu-link">
							<span class="menu-label">
                                                <span class="menu-name">Verified Users
                                                </span>
                                            </span>
                            <span class="menu-icon">

                                                    <i class="icon-placeholder mdi mdi mdi-account-multiple-check "></i>
                                            </span>
                        </a>
                    </li>            
                </ul>
            </li>
		<?php } ?>
		<?php if (in_array(3, $Admin_Role)) { ?>
			<li class="menu-item <?= $currentClass == 'list_approve' && $currentMethod == 'index' ? 'active' : '' ?>">
                <a href="<?php echo site_url("list_approve") ?>" class="menu-link">
                        <span class="menu-label">
                                                <span class="menu-name">Listing To Approve                                                 
                                                </span>

                                            </span>
                    <span class="menu-icon">
                                                 <i class="icon-placeholder mdi mdi-format-list-checks "></i>
                                            </span>
                </a>
            </li>
		<?php } ?>
		<?php if (in_array(4, $Admin_Role)) { ?>
			<li class="menu-item <?= $currentClass == 'item' ? 'active' : '' ?>">
                <a href="#" class="open-dropdown menu-link">
                        <span class="menu-label">
                                                <span class="menu-name">product
                                                    <span class="menu-arrow"></span>
                                                </span>

                                            </span>
                    <span class="menu-icon">
                                                 <i class="icon-placeholder mdi mdi-cart "></i>
                                            </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu" >

                    <li class="menu-item <?= $currentClass == 'item' && $currentMethod == 'instabuyitem' ? 'active' : '' ?>">
                        <a  href="<?php echo site_url("item/instabuyitem") ?>" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">Instabuy Item
                                                </span>
                                            </span>
                            <span class="menu-icon">
                                                    <!--<span class="icon-badge">10</span>-->
                                                    <i class="icon-placeholder mdi mdi-cart-outline "></i>
                                            </span>
                        </a>
                    </li>
                    <li class="menu-item <?= $currentClass == 'item' && $currentMethod == 'auctionitem' ? 'active' : '' ?>">
                        <a href="<?php echo site_url("item/auctionitem") ?>" class=" menu-link">
							<span class="menu-label">
                                                <span class="menu-name">Auction Item
                                                </span>
                                            </span>
                            <span class="menu-icon">

                                                    <i class="icon-placeholder mdi mdi-cart-outline "></i>
                                            </span>
                        </a>
                    </li> 
					<li class="menu-item <?= $currentClass == 'item' && $currentMethod == 'tradeitem' ? 'active' : '' ?>">
                        <a href="<?php echo site_url("item/tradeitem") ?>" class=" menu-link">
							<span class="menu-label">
                                                <span class="menu-name">Trade Item
                                                </span>
                                            </span>
                            <span class="menu-icon">

                                                    <i class="icon-placeholder mdi mdi-cart-outline "></i>
                                            </span>
                        </a>
                    </li>
					<li class="menu-item <?= $currentClass == 'item' && $currentMethod == 'index' ? 'active' : '' ?>">
                        <a href="<?php echo site_url('item'); ?>" class=" menu-link">
							<span class="menu-label">
                                                <span class="menu-name">All Item
                                                </span>
                                            </span>
                            <span class="menu-icon">

                                                    <i class="icon-placeholder mdi mdi-cart-outline "></i>
                                            </span>
                        </a>
                    </li>
                </ul>
            </li>
		<?php } ?>
		<?php if (in_array(5, $Admin_Role)) { ?>
			<li class="menu-item <?= $currentClass == 'raffle' ? 'active opened' : '' ?>">
                <a href="javascript:void(0);" class="open-dropdown menu-link">
                        <span class="menu-label">
                                                <span class="menu-name">Raffle
                                                    <span class="menu-arrow"></span>
                                                </span>

                                            </span>
                    <span class="menu-icon">
                                                 <i class="icon-placeholder mdi mdi-ticket"></i>
                                            </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu <?= $currentClass == 'raffle' ? 'active' : '' ?>">

                    <li class="menu-item <?= $currentClass == 'raffle' && $currentMethod == 'index' ? 'active in' : '' ?>">
                        <a href="<?php echo site_url("raffle") ?>" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">Running Raffle
                                                </span>
                                            </span>
                            <span class="menu-icon">
                                                    <!--<span class="icon-badge">10</span>-->
                                                    <i class="icon-placeholder mdi mdi-ticket-account "></i>
                                            </span>
                        </a>
                    </li>
                    <li class="menu-item <?= $currentClass == 'raffle' && $currentMethod == 'raffle_history' ? 'active' : '' ?>">
                        <a href="<?php echo site_url("raffle/raffle_history") ?>" class=" menu-link">
							<span class="menu-label">
                                                <span class="menu-name">History
                                                </span>
                                            </span>
                            <span class="menu-icon">

                                                    <i class="icon-placeholder mdi mdi-ticket-confirmation "></i>
                                            </span>
                        </a>
                    </li>            
                </ul>
            </li>
		<?php } ?>
		<?php if (in_array(6, $Admin_Role)) { ?>
			<li class="menu-item ">
                <a href="javascript:void(0);" class="open-dropdown menu-link">
                        <span class="menu-label">
                                                <span class="menu-name">Contest
                                                    <span class="menu-arrow"></span>
                                                </span>

                                            </span>
                    <span class="menu-icon">
                                                 <i class="icon-placeholder mdi mdi-octagram "></i>
                                            </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu <?= $currentClass == 'contest' && $currentMethod == 'index' ? 'active' : '' ?>" >

                    <li class="menu-item">
                        <a href="<?php echo site_url("contest") ?>" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">Running Contest
                                                </span>
                                            </span>
                            <span class="menu-icon">
                                                    <!--<span class="icon-badge">10</span>-->
                                                    <i class="icon-placeholder mdi mdi-octagram-outline "></i>
                                            </span>
                        </a>
                    </li>
                    <li class="menu-item <?= $currentClass == 'contest' && $currentMethod == 'contest_history' ? 'active' : '' ?>">
                        <a href="<?php echo site_url("contest/contest_history") ?>" class=" menu-link">
							<span class="menu-label">
                                                <span class="menu-name">History
                                                </span>
                                            </span>
                            <span class="menu-icon">

                                                    <i class="icon-placeholder mdi mdi-octagram-outline "></i>
                                            </span>
                        </a>
                    </li>            
                </ul>
            </li>
		<?php } ?>
		<?php if (in_array(7, $Admin_Role)) { ?>
			<li class="menu-item <?= $currentClass == 'reward' && $currentMethod == 'index' ? 'active' : '' ?>">
                <a href="<?php echo site_url("reward"); ?>" class="menu-link">
                        <span class="menu-label">
                                                <span class="menu-name">Reward                                             
                                                </span>

                                            </span>
                    <span class="menu-icon">
                                                 <i class="icon-placeholder mdi mdi-star-box "></i>
                                            </span>
                </a>
            </li>
		<?php } ?>
		<?php if (in_array(8, $Admin_Role)) { ?>
			<li class="menu-item ">
                <a href="javascript:void(0);" class="open-dropdown menu-link">
                        <span class="menu-label">
                                                <span class="menu-name">Auction
                                                    <span class="menu-arrow"></span>
                                                </span>

                                            </span>
                    <span class="menu-icon">
                                                 <i class="icon-placeholder mdi mdi-gavel "></i>
                                            </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu" >
						<li class="menu-item <?= $currentClass == 'bid' && $currentMethod == 'index' ? 'active' : '' ?>">
							<a href="<?php echo site_url("bid") ?>" class="menu-link">
									<span class="menu-label">
															<span class="menu-name">Auction Bid Products                                              
															</span>

														</span>
								<span class="menu-icon">
															 <i class="icon-placeholder mdi mdi-gavel "></i>
														</span>
							</a>
						</li>
						<li class="menu-item <?= $currentClass == 'bid' && $currentMethod == 'auc_winner' ? 'active' : '' ?>">
							<a href="<?php echo site_url("bid/auc_winner") ?>" class="menu-link">
									<span class="menu-label">
															<span class="menu-name">Auction Winner                                              
															</span>

														</span>
								<span class="menu-icon">
															 <i class="icon-placeholder mdi mdi-gavel "></i>
														</span>
							</a>
						</li>
						<li class="menu-item <?= $currentClass == 'bid' && $currentMethod == 'payouts' ? 'active' : '' ?>">
							<a href="<?php echo site_url("bid/payouts") ?>" class="menu-link">
									<span class="menu-label">
															<span class="menu-name">Auction Seller Payout                                              
															</span>

														</span>
								<span class="menu-icon">
															 <i class="icon-placeholder mdi mdi-gavel "></i>
														</span>
							</a>
						</li>
			</ul>
			</li>
		<?php } ?>
		<?php if (in_array(9, $Admin_Role)) { ?>
			<li class="menu-item <?= $currentClass == 'trade' && $currentMethod == 'index' ? 'active' : '' ?>">
                <a href="<?php echo site_url("trade"); ?>" class="menu-link">
                        <span class="menu-label">
                                                <span class="menu-name">Trade                                             
                                                </span>

                                            </span>
                    <span class="menu-icon">
                                                 <i class="icon-placeholder mdi mdi-trending-up "></i>
                                            </span>
                </a>
            </li>
		<?php } ?>
		<?php if (in_array(10, $Admin_Role)) { ?>
			<li class="menu-item <?= $currentClass == 'order_list' && $currentMethod == 'index' ? 'active' : '' ?>">
                <a href="<?php echo site_url("order_list") ?>" class="menu-link">
                        <span class="menu-label">
                                                <span class="menu-name">Order list                                                 
                                                </span>

                                            </span>
                    <span class="menu-icon">
                                                 <i class="icon-placeholder mdi mdi-format-list-bulleted "></i>
                                            </span>
                </a>
            </li>
		<?php } ?>
		<?php if (in_array(11, $Admin_Role)) { ?>
			<li class="menu-item <?= $currentClass == 'shipping' ? 'active' : '' ?>">
                <a href="#" class="open-dropdown menu-link">
                        <span class="menu-label">
                                                <span class="menu-name">Shipping
                                                    <span class="menu-arrow"></span>
                                                </span>

                                            </span>
                    <span class="menu-icon">
                                                 <i class="icon-placeholder mdi mdi-truck-fast "></i>
                                            </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu <?= $currentClass == 'shipping' && $currentMethod == 'unshippedItem' ? 'active' : '' ?>">

                    <li class="menu-item">
                        <a href="<?php echo site_url("shipping/unshippedItem") ?>" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">Unshipped Product
                                                </span>
                                            </span>
                            <span class="menu-icon">
                                                    <!--<span class="icon-badge">10</span>-->
                                                    <i class="icon-placeholder mdi mdi-truck-delivery "></i>
                                            </span>
                        </a>
                    </li>
                    <li class="menu-item <?= $currentClass == 'shipping' && $currentMethod == 'index' ? 'active' : '' ?>">
                        <a href="<?php echo site_url("shipping/index") ?>" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">Shipped To Laced
                                                </span>
                                            </span>
                            <span class="menu-icon">

                                                    <i class="icon-placeholder mdi mdi-truck-delivery "></i>
                                            </span>
                        </a>
                    </li>  
					<li class="menu-item <?= $currentClass == 'shipping' && $currentMethod == 'shippedItem' ? 'active' : '' ?>">
                        <a href="<?php echo site_url('shipping/shippedItem'); ?>" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">Shipped Product
                                                </span>
                                            </span>
                            <span class="menu-icon">

                                                    <i class="icon-placeholder mdi mdi-truck-delivery "></i>
                                            </span>
                        </a>
                    </li>
					
					
					
					<li class="menu-item ">
                <a href="#" class="open-dropdown menu-link">
                        <span class="menu-label">
                                                 <span class="menu-name">Trade Product
                                                    <span class="menu-arrow"></span>
                                                </span>                                            
                                            </span>
                    <span class="menu-icon">
                                                <i class="icon-placeholder mdi mdi-truck-delivery "></i>
                                            </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu">
                    <li class="menu-item <?= $currentClass == 'shipping' && $currentMethod == 'shippingTradeItem' ? 'active' : '' ?>">
                        <a href="<?php echo site_url('shipping/shippingTradeItem'); ?>" class=" menu-link">
                                            <span class="menu-label">
                                                <span class="menu-name">Shipped To Laced</span>                                         
                                            </span>
                            <span class="menu-icon">
                                                <i class="icon-placeholder  mdi mdi-truck-delivery">
                                                    
                                                </i>
                                            </span>
                        </a>

                    </li>
					<li class="menu-item <?= $currentClass == 'shipping' && $currentMethod == 'shippedTradeItem' ? 'active' : '' ?>">
                        <a href="<?php echo site_url('shipping/shippedTradeItem'); ?>" class=" menu-link">
                                            <span class="menu-label">
                                                <span class="menu-name">Shipped Trade Product</span>                                          
                                            </span>
                            <span class="menu-icon">
                                                <i class="icon-placeholder  mdi mdi-truck-delivery">
                                                    
                                                </i>
                                            </span>
                        </a>

                    </li>
                </ul>
            </li>
			
					
					<li class="menu-item <?= $currentClass == 'shipping' && $currentMethod == 'undeliveredItem' ? 'active' : '' ?>">
                        <a href="<?php echo site_url('shipping/undeliveredItem'); ?>" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">Undelivered Product
                                                </span>
                                            </span>
                            <span class="menu-icon">

                                                    <i class="icon-placeholder mdi mdi-truck-delivery "></i>
                                            </span>
                        </a>
                    </li>
					<li class="menu-item <?= $currentClass == 'shipping' && $currentMethod == 'deliveredItem' ? 'active' : '' ?>">
                        <a href="<?php echo site_url('shipping/deliveredItem'); ?>" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">Delivered Product
                                                </span>
                                            </span>
                            <span class="menu-icon">

                                                    <i class="icon-placeholder mdi mdi-truck-delivery "></i>
                                            </span>
                        </a>
                    </li>
					<li class="menu-item <?= $currentClass == 'shipping' && $currentMethod == 'tracking' ? 'active' : '' ?>">
                        <a href="<?php echo site_url('shipping/tracking'); ?>" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">USPS Tracking
                                                </span>
                                            </span>
                            <span class="menu-icon">

                                                    <i class="icon-placeholder mdi mdi-truck-delivery "></i>
                                            </span>
                        </a>
                    </li>
					
                </ul>
            </li>
		<?php } ?>
		<?php if (in_array(12, $Admin_Role)) { ?>
			<li class="menu-item <?= $currentClass == 'brand' || $currentClass == 'flaker' || $currentClass == 'product_commission' && $currentMethod == 'index' ? 'active' : '' ?>">
                <a href="#" class="open-dropdown menu-link">
                        <span class="menu-label">
                                                <span class="menu-name">Administrative Settings
                                                    <span class="menu-arrow"></span>
                                                </span>

                                            </span>
                    <span class="menu-icon">
                                                 <i class="icon-placeholder mdi mdi-settings "></i>
                                            </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu " >

                    <li class="menu-item <?= $currentClass == 'brand' && $currentMethod == 'index' ? 'active' : '' ?>">
                <a href="<?php echo site_url("brand") ?>" class="menu-link">
                        <span class="menu-label">
                                                <span class="menu-name">Add Brand                                             
                                                </span>

                                            </span>
                    <span class="menu-icon">
                                                 <i class="icon-placeholder mdi mdi-shopping "></i>
                                            </span>
                </a>
			</li>
                    <li class="menu-item <?= $currentClass == 'flaker' && $currentMethod == 'index' ? 'active' : '' ?>">
                        <a href="<?php echo site_url("flaker") ?>" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">Add Flaker Fee
                                                </span>
                                            </span>
                            <span class="menu-icon">

                                                    <i class="icon-placeholder mdi mdi-currency-usd "></i>
                                            </span>
                        </a>
                    </li>  
					<li class="menu-item <?= $currentClass == 'product_commission' && $currentMethod == 'index' ? 'active' : '' ?>">
                        <a href="<?php echo site_url("product_commission") ?>" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">Product Commission
                                                </span>
                                            </span>
                            <span class="menu-icon">

                                                    <i class="icon-placeholder mdi mdi-currency-usd "></i>
                                            </span>
                        </a>
                    </li>
					<?php if($admintype == "Admin") {?>
					<li class="menu-item <?= $currentClass == 'Admin' && $currentMethod == 'index' ? 'active' : '' ?>">
                <a href="#" class="open-dropdown menu-link">
                        <span class="menu-label">
                                                 <span class="menu-name">Child Admin
                                                    <span class="menu-arrow"></span>
                                                </span>                                            
                                            </span>
                    <span class="menu-icon">
                                                <i class="icon-placeholder mdi mdi-account "></i>
                                            </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu">
                    <li class="menu-item <?= $currentClass == 'Admin' && $currentMethod == 'index' ? 'active' : '' ?>">
                        <a href="<?php echo site_url("Admin") ?>" class=" menu-link">
                                            <span class="menu-label">
                                                <span class="menu-name">Create Admin</span>                                         
                                            </span>
                            <span class="menu-icon">
                                                <i class="icon-placeholder  mdi mdi-account">
                                                    
                                                </i>
                                            </span>
                        </a>

                    </li>
					<li class="menu-item <?= $currentClass == 'Admin' && $currentMethod == 'admin_list' ? 'active' : '' ?>">
                        <a href="<?php echo site_url("Admin/admin_list") ?>" class=" menu-link">
                                            <span class="menu-label">
                                                <span class="menu-name">Admin List</span>                                          
                                            </span>
                            <span class="menu-icon">
                                                <i class="icon-placeholder  mdi mdi-account">
                                                    
                                                </i>
                                            </span>
                        </a>

                    </li>
                </ul>
            </li>
					<?php }?>
			
					<li class="menu-item <?= $currentClass == 'feedback' && $currentMethod == 'index' ? 'active' : '' ?> ">
                        <a href="<?php echo site_url("feedback") ?>" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">Feedback List
                                                </span>
                                            </span>
                            <span class="menu-icon">

                                                    <i class="icon-placeholder mdi mdi-account-arrow-right "></i>
                                            </span>
                        </a>
                    </li>
                </ul>
            </li>
		<?php } ?>
			<?php if (in_array(13, $Admin_Role)) { ?>
			<li class="menu-item <?= $currentClass == 'payment' ? 'active' : '' ?>">
                <a href="#" class="open-dropdown menu-link">
                        <span class="menu-label">
                                                <span class="menu-name">Work History
                                                    <span class="menu-arrow"></span>
                                                </span>

                                            </span>
                    <span class="menu-icon">
                                                 <i class="icon-placeholder mdi mdi-history "></i>
                                            </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu " >

                    <li class="menu-item <?= $currentClass == 'payment' && $currentMethod == 'index' ? 'active' : '' ?>">
                        <a href="<?php echo site_url("payment") ?>" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">Remaining
                                                </span>
                                            </span>
                            <span class="menu-icon">
                                                    <!--<span class="icon-badge">10</span>-->
                                                    <i class="icon-placeholder mdi mdi-history "></i>
                                            </span>
                        </a>
                    </li>
                    <li class="menu-item <?= $currentClass == 'payment' && $currentMethod == 'payment_history' ? 'active' : '' ?>">
                        <a href="<?php echo site_url("payment/payment_history") ?>" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">History
                                                </span>
                                            </span>
                            <span class="menu-icon">

                                                    <i class="icon-placeholder mdi mdi-history "></i>
                                            </span>
                        </a>
                    </li>            
                </ul>
            </li>
			<?php } ?>
			<?php if (in_array(14, $Admin_Role)) { ?>
			<li class="menu-item <?= $currentClass == 'usernotification' && $currentMethod == 'index' ? 'active' : '' ?>">
                <a href="<?php echo site_url("usernotification") ?>" class="menu-link">
                        <span class="menu-label">
                                                <span class="menu-name">User Notification                                             
                                                </span>

                                            </span>
                    <span class="menu-icon">
                                                 <i class="icon-placeholder mdi mdi-bell "></i>
                                            </span>
                </a>
			</li>
			<?php } ?>
			<?php if (in_array(15, $Admin_Role)) { ?>
			<li class="menu-item <?= $currentClass == 'rateus' && $currentMethod == 'index' ? 'active' : '' ?>">
                <a href="javascript:void(0);" class="open-dropdown menu-link">
                        <span class="menu-label">
                                                <span class="menu-name">App Rate
                                                    <span class="menu-arrow"></span>
                                                </span>

                                            </span>
                    <span class="menu-icon">
                                                 <i class="icon-placeholder mdi mdi-star "></i>
                                            </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu " >

                    <li class="menu-item <?= $currentClass == 'rateus' && $currentMethod == 'index' ? 'active' : '' ?>">
                        <a href="<?php echo site_url('rateus'); ?>" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">Rate Us
                                                </span>
                                            </span>
                            <span class="menu-icon">
                                                    <!--<span class="icon-badge">10</span>-->
                                                    <i class="icon-placeholder mdi mdi-star "></i>
                                            </span>
                        </a>
                    </li>                               
                </ul>
            </li>
			<?php } ?>
			<?php if (in_array(16, $Admin_Role)) { ?>
			<li class="menu-item <?= $currentClass == 'setting' && $currentMethod == 'index' ? 'active' : '' ?>">
                <a href="<?php echo site_url("setting"); ?>" class="menu-link">
                        <span class="menu-label">
                                                 <span class="menu-name">Setting                                              
                                                </span>

                                            </span>
                    <span class="menu-icon">
                                                <i class="icon-placeholder mdi mdi-settings "></i>
                                            </span>
                </a>
			</li>
			<?php } ?>
			<?php if (in_array(17, $Admin_Role)) { ?>
            <li class="menu-item <?= $currentClass == 'contact' ? 'active' : '' ?>">
                <a href="javascript:void(0);" class="open-dropdown menu-link">
                        <span class="menu-label">
                                                 <span class="menu-name">User Query
                                                    <span class="menu-arrow"></span>
                                                </span>

                                            </span>
                    <span class="menu-icon">
                                                <i class="icon-placeholder mdi mdi-account-question "></i>
                                            </span>
                </a>
                <!--submenu-->
                <ul class="sub-menu">
                    <li class="menu-item <?= $currentClass == 'contact' && $currentMethod == 'index' ? 'active' : '' ?>">
                        <a href="<?php echo site_url('contact/index'); ?>" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">Query
                                                </span>
                                            </span>
                            <span class="menu-icon">
                                                    <!--<span class="icon-badge">10</span>-->
                                                    <i class="icon-placeholder mdi mdi-account-question"></i>
                                            </span>
                        </a>
                    </li>
                    <li class="menu-item <?= $currentClass == 'contact' && $currentMethod == 'solved_query' ? 'active' : '' ?>">
                        <a href="<?php echo site_url('contact/solved_query'); ?>" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">Solved Query
                                                </span>
                                            </span>
                            <span class="menu-icon">
                                                    <!--<span class="icon-badge">10</span>-->
                                                    <i class="icon-placeholder mdi mdi-account-switch"></i>
                                            </span>
                        </a>
                    </li>               
                </ul>
            </li>
			<?php } ?>
		</ul>
    </div>
</aside>
<main class="admin-main">
    <!--site header begins-->
<header class="admin-header">

    <a href="#" class="sidebar-toggle" data-toggleclass="sidebar-open" data-target="body"> </a>

    <nav class=" mr-auto my-auto">
        <ul class="nav align-items-center">

            <li class="nav-item">
                <a class="nav-link  " data-target="#siteSearchModal" data-toggle="modal" href="#">
                    <i class=" mdi mdi-magnify mdi-24px align-middle"></i>
                </a>
            </li>
        </ul>
    </nav>
    <nav class=" ml-auto">
        <ul class="nav align-items-center">
		<?php 
									$sql ="SELECT * FROM notification WHERE Admin_Id = 1 AND Notification_Status = 0 order by Notification_Id desc"; 
									$que = $this->db->query($sql); 
									$res = $que->result();
								   // echo "<pre>";print_r($que->result());
			?>
            <li class="nav-item">
                <div class="dropdown">
                    <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-24px mdi-bell-outline"></i>
                        <span class="notification-counter"></span>
                    </a>

                    <div class="dropdown-menu notification-container dropdown-menu-right">
                        <div class="d-flex p-all-15 bg-white justify-content-between border-bottom ">
                            <a href="#!" class="mdi mdi-18px mdi-settings text-muted"></a>
                            <span class="h5 m-0">Notifications</span>
                            <a href="#!" class="mdi mdi-18px mdi-notification-clear-all text-muted"></a>
                        </div>
                        <div class="notification-events bg-gray-300">
                            
							
							 <?php if(!empty($res)){ ?>
                                <?php foreach($res as $r) {?>
                            <a href="#" class="d-block m-b-10">
                                <div class="card">
                                    <div class="card-body"> <?php echo $r->Notification_Message; ?> </div>
                                </div>
                            </a>
                            <?php } } else { ?>
							<a href="#" class="d-block m-b-10">
                                <div class="card">
                                    <div class="card-body">No Any Notification Found.</div>
                                </div>
                            </a>
							<?php } ?>
                        </div>

                    </div>
                </div>
            </li>
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="#"   role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-sm avatar-online">
                        <span class="avatar-title rounded-circle bg-dark">LACED</span>

                    </div>
                </a>
				 <?php
                    $Admin_Id=$this->session->userdata('Admin_Id');
                    ?>
                <div class="dropdown-menu  dropdown-menu-right">
                    <a class="dropdown-item" href="<?php echo site_url("profile/edit_data/$Admin_Id"); ?>">  Profile </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo site_url("login/logout"); ?>"> Logout</a>
                </div>
            </li>

        </ul>

    </nav>
</header>
<!--site header ends --> 