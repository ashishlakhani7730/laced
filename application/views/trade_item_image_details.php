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
                                    <!--<p align="right"><button class="btn btn-warning btn-anim"><a href="<?php //echo site_url('item/add')                                                                                                                                          ?>"> add</a></button></p>-->
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-wrapper collapse in">   

                                    <div class="panel-body">                                       
                                        <div class="table-wrap">
                                            <div class="table-responsive">
                                                <input type="hidden" value="<?= $productData->Item_Id ?>" id= "productItemId" >
                                                <table  class="table table-hover display  pb-30" >
                                                    <tr>
                                                        <th>Item Front Image</th>                                                            
                                                        <th><img src="<?= bonanzaImageUploadURL(@$productData->Item_FrontPicture) ?>" style="width:150px;height:150px;">  
                                                        <th><a href="" data-toggle="modal" data-target="#myModal" onclick= "typeSet('ITEM-FRONT')" class="btn btn-info dropdown-toggle"><span class="fa fa-image"> &nbsp; Make Transparent Image</span></a></th>                                                            
                                                    </tr>
                                                    <tr>
                                                        <th>Item Back Image</th>                                                            
                                                        <th><img src="<?= bonanzaImageUploadURL(@$productData->Item_BackPicture) ?>" style="width:150px;height:150px;"></th>                                                            
                                                        <th><a href="" data-toggle="modal" data-target="#myModal" onclick="typeSet('ITEM-BACK')" class="btn btn-info dropdown-toggle"><span class="fa fa-image"> &nbsp; Make Transparent Image</span></a></th>                                                            
                                                    </tr>
                                                    <tr>
                                                        <th>Item Side Image</th>                                                            
                                                        <th><img src="<?= bonanzaImageUploadURL(@$productData->Item_SidePicture) ?>" style="width:150px;height:150px;"></th>                                                            
                                                        <th><a href="" data-toggle="modal" data-target="#myModal" onclick= "typeSet('ITEM-SIDE')" class="btn btn-info dropdown-toggle"><span class="fa fa-image"> &nbsp; Make Transparent Image</span></a></th>                                                            
                                                    </tr>
                                                    <tr>
                                                        <th>Item Inside Image</th>                                                            
                                                        <th><img src="<?= bonanzaImageUploadURL(@$productData->Item_InsideTagPicture) ?>" style="width:150px;height:150px;"></th>                                                            
                                                        <th><a href="" data-toggle="modal" data-target="#myModal" onclick="typeSet('ITEM-INSIDE')" class="btn btn-info dropdown-toggle"><span class="fa fa-image"> &nbsp; Make Transparent Image</span></a></th>                                                            
                                                    </tr>
                                                    <tr>
                                                        <th>Item Box Image</th>                                                            
                                                        <th><img src="<?= bonanzaImageUploadURL(@$productData->Item_BoxPicture) ?>" style="width:150px;height:150px;"></th>                                                            
                                                        <th><a href="" data-toggle="modal" data-target="#myModal" onclick="typeSet('ITEM-BOX')" class="btn btn-info dropdown-toggle"><span class="fa fa-image"> &nbsp; Make Transparent Image</span></a></th>                                                            
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
<!-- sample modal content -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h5 class="modal-title" id="myModalLabel">Remove backgrounds from image</h5>
			</div>
			<div class="modal-body">
			    
				<h5 class="mb-15">Are you sure you want to make transparent this <label id="imagetype" class="text-lowercase"></label>?</h5>
				<div id="successMessageView" class="alert alert-success alert-dismissable" style="display:none;">
                    <div id="successMessageData"></div>
                </div>
				<div id="progrssBar" style="display:none">
				    <p>Please wait Image is under process...</p>
    				<div class="progress progress-lg">
    					<div class="progress-bar progress-bar-danger active progress-bar-striped" id="progress-loadbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" role="progressbar"></div>
    				</div>
				</div>
			</div>
			<div class="modal-footer" id="footerButton">
				<button type="button" class="btn btn-success transparent">Yes, Sure</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php
include("footer_include.php");
?>
<script>
$(document).on('click', '.transparent', function() {
    var imagetype = $("#imagetype").html();
    var itemId = $("#productItemId").val();
    var percentComplete = 0;
    $("#progrssBar").show();
    $('#footerButton').hide();
    var interval = setInterval(function(){
        $("#progress-loadbar").width(percentComplete+'%'); 
        $("#progress-loadbar").html(percentComplete+'%'); 
        if(percentComplete < 90){
           var random = Math.floor((Math.random() * 5) + 1);
           percentComplete = percentComplete + random; 
        }
    } , 1000);
    $.ajax({
        url: "<?php echo site_url("/item/getTransparentImage") ?>",
        method: "POST",
        data: 'type=' +imagetype+ '&itemId='+itemId, 
        timeout: 3000, 
        success: function(data) {
            var interval1 = setInterval(function(){
                percentComplete = ((percentComplete + 6) >= 100) ? 100 : percentComplete + 6;
                $("#progress-loadbar").width(percentComplete+'%');
                $("#progress-loadbar").html(percentComplete+'%'); 
                if(percentComplete == 100){ 
                    percentComplete = 0;
                    clearInterval(interval);
                    clearInterval(interval1);
                    if(data == '1')
                    {
                        $("#successMessageData").html('Your image transparent successfully.');
                        $("#successMessageView").show();
                        setTimeout(function(){ location.reload(); }, 3000);
                    }
                    else
                    {
                        $("#successMessageData").html(data);
                        $("#successMessageView").show();
                        $("#progrssBar").hide();
                        $('#footerButton').show();
                        setTimeout(function(){ $("#successMessageView").hide(); }, 4000);
                    }
                 }
             } , 1000);
        }
    })
});
function typeSet($type)
{
    $("#imagetype").html($type);
}
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