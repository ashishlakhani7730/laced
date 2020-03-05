<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include("header_include.php");
        ?>
    </head>

    <body>
        <!--Preloader-->
        <div class="preloader-it">
            <div class="la-anim-1"></div>
        </div>
        <!--/Preloader-->
        <div class="wrapper theme-1-active pimary-color-red">
            <?php
            include("header_body.php");
            ?>
            <?php
            include("header_body_side.php");
            ?>

            <!-- Main Content -->
            <div class="page-wrapper">
                <div class="container-fluid">

                    <!-- Title -->
                    <div class="row heading-bg">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h5 class="txt-dark">FAQ LIST</h5>
                        </div>

                        <!-- Breadcrumb -->
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="#">About us</a></li>
                                <li class="active"><span>faq list</span></li>
                            </ol>
                        </div>
                        <!-- /Breadcrumb -->

                    </div>
                    <!-- /Title -->

                    <?php if (validation_errors()) { ?>
                        <div id="validationerror" class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo validation_errors(); ?>
                        </div>						
                    <?php } ?>
                    <div id="successMessage1" class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $this->session->flashdata('message_faq_list'); ?> 
                    </div>
                    <div id="successMessage2" class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $this->session->flashdata('message_faq_list_1'); ?> 
                    </div>
                    <div id="failMessage" class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $this->session->flashdata('message_fail__faq_list'); ?>
                    </div>

                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"></h6>

                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap">
                                    <table id="example" class="table" data-sorting="true">
                                        <thead>
                                            <tr>
                                                <th>serial no</th>
                                                <th>Question</th>
                                                <th>Answer</th>    
                                                <th><center>Action</center></th>													
                                            </tr>
                                        </thead>
                                        <?php
                                        if (!empty($list)) {
                                            $cnt = 1;
                                            foreach ($list as $list_faq) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $cnt++ ?></td>
                                                    <td><?php echo $list_faq->question ?></td>
                                                    <td><?php echo $list_faq->answer ?></td>
                                                    
                                                    <td><div class="input-group-btn">
                                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                                                            <ul class="dropdown-menu">                                 

                                                                <li><a href="<?php echo site_url("faq/update_faq/$list_faq->F_Id"); ?>"><span class="fa fa-edit"> &nbsp;    Update</span></a></li>

                                                                <li><a href="<?php echo site_url("faq/delete_faq/$list_faq->F_Id"); ?>"><span class="fa fa-trash-o"> &nbsp;    Delete</span></a></li>

                                                            </ul>
                                                        </div>  
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='4'>No Any FAQ Found !</td></tr>";
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /Row -->
                </div>
            </div>
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
<?php if (empty($this->session->flashdata('message_faq_list'))) { ?>
                $('#successMessage1').hide();
<?php } else { ?>
                setTimeout(function () {
                    $('#successMessage1').fadeOut('slow');
                }, 5000);
<?php } ?>

<?php if (empty($this->session->flashdata('message_faq_list_1'))) { ?>
                $('#successMessage2').hide();
<?php } else { ?>
                setTimeout(function () {
                    $('#successMessage2').fadeOut('slow');
                }, 5000);
<?php } ?>

<?php if (empty($this->session->flashdata('message_fail__faq_list'))) { ?>
                $('#failMessage').hide();
<?php } else { ?>
                setTimeout(function () {
                    $('#failMessage').fadeOut('slow');
                }, 5000);
<?php } ?>
        </script>
    </body>
</html>
