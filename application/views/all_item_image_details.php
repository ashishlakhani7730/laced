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
            <!-- Title -->
            <div class="page-wrapper">
                <div class="container-fluid">
                    <!-- Title -->
                    <div class="row heading-bg">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h5 class="txt-dark">Product <?= @$productData->Item_Name ?></h5>
                        </div>
                        <!-- Breadcrumb -->
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="<?php echo base_url() . 'home'; ?>">Dashboard</a></li>
                                <li><a href="#"><span>Product Images</span></a></li>
                            </ol>
                        </div>
                        <!-- /Breadcrumb -->
                    </div>
                    <!-- Row -->
                    <div id="successMessage" class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $this->session->flashdata('message'); ?> 
                    </div>
                    <div id="failMessage" class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $this->session->flashdata('fail_message'); ?>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default card-view">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h6 class="panel-title txt-dark"></h6>

                                    </div>
                                    <!--<p align="right"><button class="btn btn-warning btn-anim"><a href="<?php //echo site_url('item/add')                                                                                                                                        ?>"> add</a></button></p>-->
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-wrapper collapse in">   

                                    <div class="panel-body">                                       
                                        <div class="table-wrap">
                                            <div class="table-responsive">
                                                <table  class="table table-hover display  pb-30" >
                                                    <tr>
                                                        <th>Item Front Image</th>                                                            
                                                        <th><img src="<?= bonanzaImageUploadURL(@$productData->Item_FrontPicture) ?>" style="width:150px;height:150px;"></th>                                                            
                                                        <th><a  onclick="return confirm('Are you sure you want to make transparent this image?');" href="<?php echo site_url("item/getTransparentImageForAllItem/$productData->Item_Id/ITEM-FRONT") ?>" class="btn btn-info dropdown-toggle"><span class="fa fa-image"> &nbsp; Make Transparent Image</span></a></th>                                                            
                                                    </tr>
                                                    <tr>
                                                        <th>Item Back Image</th>                                                            
                                                        <th><img src="<?= bonanzaImageUploadURL(@$productData->Item_BackPicture) ?>" style="width:150px;height:150px;"></th>                                                            
                                                        <th><a  onclick="return confirm('Are you sure you want to make transparent this image?');" href="<?php echo site_url("item/getTransparentImageForAllItem/$productData->Item_Id/ITEM-BACK") ?>" class="btn btn-info dropdown-toggle"><span class="fa fa-image"> &nbsp; Make Transparent Image</span></a></th>                                                            
                                                    </tr>
                                                    <tr>
                                                        <th>Item Side Image</th>                                                            
                                                        <th><img src="<?= bonanzaImageUploadURL(@$productData->Item_SidePicture) ?>" style="width:150px;height:150px;"></th>                                                            
                                                        <th><a  onclick="return confirm('Are you sure you want to make transparent this image?');" href="<?php echo site_url("item/getTransparentImageForAllItem/$productData->Item_Id/ITEM-SIDE") ?>" class="btn btn-info dropdown-toggle"><span class="fa fa-image"> &nbsp; Make Transparent Image</span></a></th>                                                            
                                                    </tr>
                                                    <tr>
                                                        <th>Item Inside Image</th>                                                            
                                                        <th><img src="<?= bonanzaImageUploadURL(@$productData->Item_InsideTagPicture) ?>" style="width:150px;height:150px;"></th>                                                            
                                                        <th><a  onclick="return confirm('Are you sure you want to make transparent this image?');" href="<?php echo site_url("item/getTransparentImageForAllItem/$productData->Item_Id/ITEM-INSIDE") ?>" class="btn btn-info dropdown-toggle"><span class="fa fa-image"> &nbsp; Make Transparent Image</span></a></th>                                                            
                                                    </tr>
                                                    <tr>
                                                        <th>Item Box Image</th>                                                            
                                                        <th><img src="<?= bonanzaImageUploadURL(@$productData->Item_BoxPicture) ?>" style="width:150px;height:150px;"></th>                                                            
                                                        <th><a  onclick="return confirm('Are you sure you want to make transparent this image?');" href="<?php echo site_url("item/getTransparentImageForAllItem/$productData->Item_Id/ITEM-BOX") ?>" class="btn btn-info dropdown-toggle"><span class="fa fa-image"> &nbsp; Make Transparent Image</span></a></th>                                                            
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>         
                </div>
            </div>
            <!-- /Breadcrumb -->
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
</div>

<?php
include("footer_include.php");
?>
<script>

    $("#modsuccessMessage").hide();
    $("#modfailMessage").hide();

    var Itemid = 0;
    function setmarketp(item_id)
    {
        Itemid = item_id;
    }

    function cleardata()
    {
        $("#marketprice").val('');
    }

    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure you want to delete this item?'))
            e.preventDefault();
    };
<?php if (empty($this->session->flashdata('message'))) { ?>
        $('#successMessage').hide();
<?php } else { ?>
        setTimeout(function () {
            $('#successMessage').fadeOut('slow');
        }, 5000);
<?php } ?>

<?php if (empty($this->session->flashdata('fail_message'))) { ?>
        $('#failMessage').hide();
<?php } else { ?>
        setTimeout(function () {
            $('#failMessage').fadeOut('slow');
        }, 5000);
<?php } ?>
</script>
</body>
</html>