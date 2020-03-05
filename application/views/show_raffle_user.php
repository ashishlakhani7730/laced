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

            <!-- Right Sidebar Menu -->

            <!-- /Right Sidebar Menu -->

            <!-- Main Content -->
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
                                        <h4 class="text-left txt-dark mb-10"> Ruffle User List</h4>
                                        <div class="form-wrap">

                                         <table id="datable_1" class="table" data-sorting="true">
                                                <thead>
                                                    <tr>
                                                        <th>serial no</th>
                                                        <th>Item Name</th>
                                                        <th>User Name</th>
                                                        <th>Raffle Price</th>
                                                        <th>created</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <?php
                                                $cnt = 1;
                                                foreach ($raffle_user_list as $raffle_user) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $cnt++ ?></td>
                                                        <td><?php echo $raffle_user->Item_Name ?></td>
                                                        
                                                        <td><?php echo $raffle_user->User_Name ?></td>
                                                        <td><?php echo $raffle_user->Raffle_Price ?></td>
                                                        
                                                        <td><?php echo $raffle_user->created ?></td>
                                                        
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