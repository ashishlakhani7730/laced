<div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
            <span>Main</span> 

            <i class="zmdi zmdi-more"></i>
        </li>
        <?php
        $currentClass = $this->router->fetch_class();
        $currentMethod = $this->router->fetch_method();
        ?>
        <li>

            <a class="<?= $currentClass == 'home' && $currentMethod == 'index' ? 'active' : '' ?>" href="<?php echo site_url("home") ?>"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="pull-right"></div><div class="clearfix"></div> </a>

        </li>
        <li>
            <a  class="<?= $currentClass == 'user' && $currentMethod == 'index' ? 'active' : '' ?>" href="<?php echo site_url("user") ?>"><div class="pull-left"><i class="zmdi zmdi-accounts-outline   mr-20"></i><span class="right-nav-text">User</span></div><div class="pull-right"><span class="label label-warning"></span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a  class="<?= $currentClass == 'item' ? 'active' : '' ?>"  href="javascript:void(0);" data-toggle="collapse" data-target="#items"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Product</span></div><div class="pull-right"><span class="label label-warning"></span></div><div class="clearfix"></div></a>           
            <ul id="items" class="collapse collapse-level-1 <?= $currentClass == 'item' ? 'in' : '' ?>">
                <li>
                    <a class="<?= $currentClass == 'item' && $currentMethod == 'instabuyitem' ? 'active-page in' : '' ?>" href="<?php echo site_url('item/instabuyitem'); ?>">Instabuy Item</a>
                </li>
                <li>
                    <a class="<?= $currentClass == 'item' && $currentMethod == 'auctionitem' ? 'active-page' : '' ?>" href="<?php echo site_url('item/auctionitem'); ?>">Auction Item</a>
                </li>
                <li>
                    <a class="<?= $currentClass == 'item' && $currentMethod == 'tradeitem' ? 'active-page' : '' ?>" href="<?php echo site_url('item/tradeitem'); ?>">Trade Item</a>
                </li>
                <li>
                    <a  class="<?= $currentClass == 'item' && $currentMethod == 'index' ? 'active-page' : '' ?>" href="<?php echo site_url('item'); ?>">All Item</a>
                </li>
            </ul>
        </li>
        <li>
            <a  class="<?= $currentClass == 'raffle' ? 'active' : '' ?>"  href="javascript:void(0);" data-toggle="collapse" data-target="#raffles"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Raffle</span></div><div class="pull-right"><span class="label label-warning"></span></div><div class="clearfix"></div></a>        
            <ul id="raffles" class="collapse collapse-level-1 <?= $currentClass == 'raffle' ? 'in' : '' ?>">
                <li>
                    <a class="<?= $currentClass == 'raffle' && $currentMethod == 'index' ? 'active-page in' : '' ?>" href="<?php echo site_url("raffle") ?>">Running Raffle</a>
                </li>
                <li>
                    <a class="<?= $currentClass == 'raffle' && $currentMethod == 'raffle_history' ? 'active-page' : '' ?>" href="<?php echo site_url("raffle/raffle_history") ?>">History </a>
                </li>
            </ul>
        </li>

        <li>
            <a  class="<?= $currentClass == 'contest' ? 'active' : '' ?>"  href="javascript:void(0);" data-toggle="collapse" data-target="#contests"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Contest</span></div><div class="pull-right"><span class="label label-warning"></span></div><div class="clearfix"></div></a>           
            <ul id="contests" class="collapse collapse-level-1 <?= $currentClass == 'contest' ? 'in' : '' ?>">
                <li>
                    <a class="<?= $currentClass == 'contest' && $currentMethod == 'index' ? 'active-page in' : '' ?>" href="<?php echo site_url("contest") ?>">Running Contest</a>
                </li>
                <li>
                    <a class="<?= $currentClass == 'contest' && $currentMethod == 'contest_history' ? 'active-page' : '' ?>" href="<?php echo site_url("contest/contest_history") ?>">History </a>
                </li>
            </ul>
        </li>

        <li>
            <a  class="<?= $currentClass == 'reward' && $currentMethod == 'index' ? 'active' : '' ?>" href="<?php echo site_url("reward") ?>"><div class="pull-left"><i class="zmdi zmdi-accounts-outline   mr-20"></i><span class="right-nav-text">Reward</span></div><div class="pull-right"><span class="label label-warning"></span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a class="<?= $currentClass == 'bid' && $currentMethod == 'index' ? 'active' : '' ?>"  href="<?php echo site_url("bid") ?>"><div class="pull-left"><i class="fa fa-gavel mr-20"></i><span class="right-nav-text">Auction Bid Products</span></div><div class="pull-right"><span class="label label-warning"></span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a class="<?= $currentClass == 'order_list' && $currentMethod == 'index' ? 'active' : '' ?>" href="<?php echo site_url("order_list") ?>"><div class="pull-left"><i class="fa fa-list-alt mr-20"></i><span class="right-nav-text">Order list</span></div><div class="pull-right"><span class="label label-warning"></span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a  class="<?= $currentClass == 'shipping' ? 'active' : '' ?>"  href="javascript:void(0);" data-toggle="collapse" data-target="#shippings"><div class="pull-left"><i class="fa fa-truck mr-20"></i><span class="right-nav-text">Shipping</span></div><div class="pull-right"><span class="label label-warning"></span></div><div class="clearfix"></div></a>           
            <ul id="shippings" class="collapse collapse-level-1 <?= $currentClass == 'shipping' ? 'in' : '' ?>">

                <li>
                    <a class="<?= $currentClass == 'shipping' && $currentMethod == 'unshippedItem' ? 'active-page in' : '' ?>" href="<?php echo site_url('shipping/unshippedItem'); ?>">Unshipped Product</a>
                </li>
                <li>
                    <a class="<?= $currentClass == 'shipping' && $currentMethod == 'index' ? 'active-page' : '' ?>" href="<?php echo site_url('shipping/index'); ?>">Shipping To Laced</a>
                </li>
                <li>
                    <a class="<?= $currentClass == 'shipping' && $currentMethod == 'shippedItem' ? 'active-page' : '' ?>" href="<?php echo site_url('shipping/shippedItem'); ?>" >Shipped Product</a>
                </li>
                <li>
                    <a class="<?= $currentClass == 'shipping' ? 'active-page' : '' ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#trades" >Trade Product</a> 
                    <ul id="trades" class="collapse collapse-level-1 <?= $currentClass == 'shipping' ? 'in' : '' ?>">


                        <li>
                            <a class="<?= $currentClass == 'shipping' && $currentMethod == 'shippingTradeItem' ? 'active-page' : '' ?>" href="<?php echo site_url('shipping/shippingTradeItem'); ?>">Shipping To Laced</a>
                        </li> 
                        <li>
                            <a class="<?= $currentClass == 'shipping' && $currentMethod == 'shippedTradeItem' ? 'active-page in' : '' ?>" href="<?php echo site_url('shipping/shippedTradeItem'); ?>">Shipped Trade Product</a>
                        </li>
                    </ul>

                </li>
                <li>
                    <a  class="<?= $currentClass == 'shipping' && $currentMethod == 'undeliveredItem' ? 'active-page' : '' ?>" href="<?php echo site_url('shipping/undeliveredItem'); ?>"> Undelivered Product</a>
                </li>
                <li>
                    <a  class="<?= $currentClass == 'shipping' && $currentMethod == 'deliveredItem' ? 'active-page' : '' ?>" href="<?php echo site_url('shipping/deliveredItem'); ?>"> Delivered Product</a>
                </li>
                <li>
                    <a  class="<?= $currentClass == 'shipping' && $currentMethod == 'tracking' ? 'active-page' : '' ?>" href="<?php echo site_url('shipping/tracking'); ?>">USPS Tracking</a>
                </li>
            </ul>
        </li>
        <li>
            <a  class="<?= $currentClass == 'payment' ? 'active' : '' ?>"  href="javascript:void(0);" data-toggle="collapse" data-target="#payments"><div class="pull-left"><i class="fa fa-money mr-20"></i><span class="right-nav-text">Work History</span></div><div class="pull-right"><span class="label label-warning"></span></div><div class="clearfix"></div></a>           
            <ul id="payments" class="collapse collapse-level-1 <?= $currentClass == 'payment' ? 'in' : '' ?>">
                <li>
                    <a class="<?= $currentClass == 'payment' && $currentMethod == 'index' ? 'active-page in' : '' ?>" href="<?php echo site_url("payment") ?>">Remaining</a>
                </li>
                <li>
                    <a class="<?= $currentClass == 'payment' && $currentMethod == 'payment_history' ? 'active-page' : '' ?>" href="<?php echo site_url("payment/payment_history") ?>">History </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="<?= $currentClass == 'flaker' && $currentMethod == 'index' ? 'active' : '' ?>" href="<?php echo site_url("flaker") ?>"><div class="pull-left"><i class="fa fa-money mr-20"></i><span class="right-nav-text">Add Flaker Fee</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a class="<?= $currentClass == 'product_commission' && $currentMethod == 'index' ? 'active' : '' ?>" href="<?php echo site_url("product_commission") ?>"><div class="pull-left"><i class="fa fa-dollar mr-20"></i><span class="right-nav-text">Add Product Commision</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a class="<?= $currentClass == 'brand' && $currentMethod == 'index' ? 'active' : '' ?>" href="<?php echo site_url("brand") ?>"><div class="pull-left"><i class="fa fa-tags mr-20"></i><span class="right-nav-text">Add Brand</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a class="<?= $currentClass == 'usernotification' && $currentMethod == 'index' ? 'active' : '' ?>" href="<?php echo site_url("usernotification") ?>"><div class="pull-left"><i class="fa fa-bell-o mr-20"></i><span class="right-nav-text">User Notification</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
        </li>
        <?php
        /* here the Admin_id check in this condition is considered in mater admin
          who is the fully authorized person. */

        if ($this->session->userdata('Admin_Id') == 1) {
            ?>
            <li>
                <a class="<?= $currentClass == 'appworks' ? 'active' : '' ?> || <?= $currentClass == 'faq' ? 'active' : '' ?> || <?= $currentClass == 'rateus' ? 'active' : '' ?> || <?= $currentClass == 'feedback' ? 'active' : '' ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_dr"><div class="pull-left"><i class="fa fa-users mr-20"></i><span class="right-nav-text">App Rate</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
                <ul id="ecom_dr" class="collapse collapse-level-1 <?= $currentClass == 'appworks' ? 'in' : '' ?> || <?= $currentClass == 'faq' ? 'in' : '' ?> || <?= $currentClass == 'feedback' ? 'in' : '' ?> || <?= $currentClass == 'rateus' ? 'in' : '' ?>">
                    <!--<li>-->
                    <!--    <a class="<?= $currentClass == 'appworks' && $currentMethod == 'index' ? 'active-page' : '' ?>" href="<?php echo site_url('appworks'); ?>">How it Works</a>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--    <a class="<?= $currentClass == 'faq' && $currentMethod == 'index' ? 'active-page in' : '' ?>" href="<?php echo site_url('faq'); ?>">ADD FAQ</a>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--    <a class="<?= $currentClass == 'faq' && $currentMethod == 'dis_list' ? 'active-page in' : '' ?>" href="<?php echo site_url('faq/dis_list'); ?>">FAQ List</a>-->
                    <!--</li>-->
                    <li>
                        <a  class="<?= $currentClass == 'rateus' && $currentMethod == 'index' ? 'active-page' : '' ?>" href="<?php echo site_url('rateus'); ?>">Rate us</a>
                    </li>
                    <li>
                        <a class="<?= $currentClass == 'feedback' && $currentMethod == 'index' ? 'active-page in' : '' ?>" href="<?php echo site_url('feedback'); ?>">Feedback List</a>
                    </li>
                </ul>
            </li>
            <!--<li>-->
            <!--    <a class="<?= $currentClass == 'tandc' ? 'active' : '' ?> || <?= $currentClass == 'ppolicy' ? 'active' : '' ?> || <?= $currentClass == 'fpolicy' ? 'active' : '' ?>"  href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_dr_legal"><div class="pull-left"><i class="fa fa-shield mr-20"></i><span class="right-nav-text">Legal Information</span></div><div class="pull-right"></div><div class="clearfix"></div></a>-->
            <!--    <ul id="ecom_dr_legal" class="collapse collapse-level-1 <?= $currentClass == 'tandc' ? 'in' : '' ?> || <?= $currentClass == 'ppolicy' ? 'in' : '' ?> || <?= $currentClass == 'fpolicy' ? 'in' : '' ?>">-->
            <!--        <li>-->
            <!--            <a  class="<?= $currentClass == 'tandc' && $currentMethod == 'index' ? 'active-page' : '' ?>" href="<?php echo site_url('tandc'); ?>">Terms and Condition</a>-->
            <!--        </li>-->
            <!--        <li>-->
            <!--            <a class="<?= $currentClass == 'ppolicy' && $currentMethod == 'index' ? 'active-page' : '' ?>" href="<?php echo site_url('ppolicy'); ?>">Privacy Policy</a>-->
            <!--        </li>-->
            <!--        <li>-->
            <!--            <a class="<?= $currentClass == 'fpolicy' && $currentMethod == 'index' ? 'active-page' : '' ?>" href="<?php echo site_url('fpolicy'); ?>">Fees Policy</a>-->
            <!--        </li>-->
            <!--    </ul>-->
            <!--</li>-->
            <li>
                <a  class="<?= $currentClass == 'setting' && $currentMethod == 'index' ? 'active' : '' ?>" href="<?php echo site_url("setting") ?>"><div class="pull-left"><i class="fa fa-gear mr-20"></i><span class="right-nav-text">Setting</span></div><div class="pull-right"><span class="label label-warning"></span></div><div class="clearfix"></div></a>
            </li>
            <li>
                <a class="<?= $currentClass == 'contact' ? 'active' : '' ?>"  href="javascript:void(0);" data-toggle="collapse" data-target="#contacts"><div class="pull-left"><i class="fa fa-question mr-20"></i><span class="right-nav-text">User Query</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
                <ul id="contacts" class="collapse collapse-level-1 <?= $currentClass == 'contact' ? 'in' : '' ?> ">
                    <li>
                        <a  class="<?= $currentClass == 'contact' && $currentMethod == 'index' ? 'active-page' : '' ?>" href="<?php echo site_url('contact/index'); ?>">Query</a>
                    </li>
                    <li>
                        <a class="<?= $currentClass == 'contact' && $currentMethod == 'solved_query' ? 'active-page in' : '' ?>" href="<?php echo site_url('contact/solved_query'); ?>">Solved Query</a>
                    </li>
                </ul>
            </li>

        <?php } ?>
</div>