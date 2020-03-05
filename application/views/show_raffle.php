<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include("header_include.php");
        ?>
    </head>

    <body>
        <!-- Preloader -->
        <div class="preloader-it">
            <div class="la-anim-1"></div>
        </div>
        <!-- /Preloader -->
        <div class="wrapper theme-1-active pimary-color-red">
            <?php
            include("header_body.php");
            ?>

            <?php
            include("header_body_side.php");
            ?>

            <div class="page-wrapper">

                <div class="container-fluid">
                    <!-- Title -->
                    <div class="row heading-bg">
                            
                        <!-- /Breadcrumb -->
                    </div>
                    <!-- /Title -->

                    <!-- Row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default card-view">

                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body">
                                        <h4 class="text-left txt-dark mb-10">Running Ruffle</h4>
                                        <div class="form-wrap">

                                          <table id="datable_1" class="table" data-sorting="true">
                                                <thead>
                                                    <tr>
                                                        <th>serial no</th>
                                                        <th>Item Name</th>
                                                        
                                                        <th>Raffle Price</th>
                                                        <th>created</th>
                                                        <th>View</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $cnt = 1;
                                                foreach ($raffle_list as $raffle) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $cnt++ ?></td>
                                                        <td><?php echo $raffle->Item_Name ?></td>
                                                        
                                                        
                                                        <td><?php echo $raffle->Raffle_Price ?></td>
                                                        
                                                        <td><?php echo $raffle->created ?></td>
                                                        <td><button type="submit" class="btn btn-info btn-anim"><a href="<?php echo site_url("item/show_raffleuser/$raffle->Item_Id") ?>">View</a></button></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </table> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                         
                    </div>
                    <!-- /Row -->
                    <div class="row">
                        
                         <div class="col-sm-12">
                        <div class="panel panel-default card-view">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h4 class="text-left txt-dark mb-10">Complete Ruffle</h4>
                                        <div class="form-wrap">

                                </div>
                               
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="table-wrap">
                                        <table id="datable_1" class="table" data-sorting="true">
                                                <thead>
                                                    <tr>
                                                        <th>serial no</th>
                                                        <th>Item Name</th>
                                                        
                                                        <th>Raffle Price</th>
                                                        <th>created</th>
                                                        <th>View</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $cnt = 1;
                                                foreach ($raffle_list as $raffle) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $cnt++ ?></td>
                                                        <td><?php echo $raffle->Item_Name ?></td>
                                                        
                                                        
                                                        <td><?php echo $raffle->Raffle_Price ?></td>
                                                        
                                                        <td><?php echo $raffle->created ?></td>
                                                        <td><button type="submit" class="btn btn-info btn-anim"><a href="<?php echo site_url("item/delete_data/$raffle->Raffle_Id") ?>"><span class="fa fa-trash-o">&nbsp; Delete</span></a></button></td>
                                                    </tr>
                                                    <?php
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
            <!-- /Footer -->

        </div>
        <!-- /Main Content -->

    </div>
    <?php
    include("footer_include.php");
    ?>
</body>
</html>