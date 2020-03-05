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
                            <h5 class="txt-dark">Shipping Trade detail</h5>
                        </div>
                        <!-- Breadcrumb -->
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="<?php echo base_url() . 'home/index'; ?>">Dashboard</a></li>
                                <li><a href="#"><span>Shipping Trade  List</span></a></li>
                            </ol>
                        </div>
                        <!-- /Breadcrumb -->
                    </div>
                    <?php if (validation_errors()) { ?>
                        <div id="validationerror" class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo validation_errors(); ?>
                        </div>						
                    <?php } ?>
                    <div id="successMessage" class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $this->session->flashdata('message'); ?> 
                    </div>
                    <div id="failMessage" class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $this->session->flashdata('fail_message'); ?>
                    </div>


                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel panel-default card-view">
                                <div class="panel-heading">
                                    <div class="pull-center">
                                        <p align="right" style="color: #fff;"> Trade Product</p>
                                        <h4 class="text-center txt-dark mb-10">
                                            
                                                <?= ($sellers['seller']) ? $sellers['seller'] :'' ?> Trade Product


                                            </h4>
                                        </div>

                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body">
                                            <div id="moreresponsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h5 class="modal-title">More Detail in product</h5>
                                                        </div>
                                                        <div id="yetmodalbody" class="modal-body">
                                                            <div id="moremodfailMessage" class="alert alert-info alert-dismissable">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div id="moremodfMessage"></div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>									
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="moreresponsive-modal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h5 class="modal-title">Order Tracking Detail</h5>
                                                        </div>
                                                        <div id="yetmodalbody1" class="modal-body">
                                                            <div id="moremodfailMessage1" class="alert alert-info alert-dismissable">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div id="moremodfMessage1"></div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>									
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <?php 
                                            $Order_Status=($sellers['Order_Status']) ? $sellers['Order_Status'] :'';
                                            $tracking=($sellers['Tracking_No1']) ? $sellers['Tracking_No1'] :'';
                                            if ($Order_Status == '1' && $tracking != '') { ?>
                                                <p align="right"><button type="button" class="btn btn-info " onclick="test('<?= $sellers['suserid'] ?>', '<?= $sellers['Trade_Id'] ?>')">Verify </button></p>
                                            <?php } else { ?>
                                                <p align="right" style="color: #fff;"> Trade Product</p>
                                                <?php
                                            }
                                        ?>
                                        <div class="table-wrap">
                                            <div class="table-responsive">
                                                <table id="" class="table table-hover display  pb-30" >
                                                    <thead>
                                                        <tr>
                                                            <th>serial no</th>
                                                            <th> FrontPicture</th>
                                                            <th>Item Name</th>
                                                            <th>Track No</th>
                                                            <th>Tracking Detail</th>
                                                            <th>More Detail</th>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    if (!empty($seller_list)) {
                                                        $cnt = 1;
                                                        foreach ($seller_list as $item) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $cnt++ ?></td>
                                                                <td><img src="<?php echo base_url() ?>./Items/<?php echo $item->Item_FrontPicture ?>" height="50" width="50"></td>
                                                                <td><?php echo $item->Item_Name; ?></td>
                                                                <td><?php echo $item->Tracking_No1; ?></td>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary " onclick="trackdetail('<?php echo $item->Tracking_No1; ?>')" data-toggle="modal" data-target="#moreresponsive-modal1" data-whatever="@mdo">Tracking Detail</button>
                                                                </td>
                                                                <td><button type="button" class="btn btn-primary " onclick="moredetail('<?php echo $item->Item_Id; ?>', '<?php echo $item->suserid; ?>')" data-toggle="modal" data-target="#moreresponsive-modal" data-whatever="@mdo">More</button></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='12'><p style='size:50px;>No any Product Found On Shipping</p></td></tr>";
                                                    }
                                                    ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>	
                        </div>
                        <div class="col-sm-6">
                            <div class="panel panel-default card-view">
                                <div class="panel-heading">
                                    <div class="pull-center">
                                        <p align="right"><button type="button" class="btn btn-warning" > <a  href="<?php echo site_url("shipping/shippingTradeItem") ?>"> <span class="fa fa-arrow-left"></span></a></button></p>
                                        <h4 class="text-center txt-dark mb-10">
                                                <?php echo $buyers['buyer']; ?> Trade Product
                                            </h4>
                                        </div>

                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body">
                                            <div id="moreresponsive-modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h5 class="modal-title">More Detail in product</h5>
                                                        </div>
                                                        <div id="yetmodalbody2" class="modal-body">
                                                            <div id="moremodfailMessage2" class="alert alert-info alert-dismissable">
                                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div id="moremodfMessage2"></div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>									
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <?php 
                                            $Order_Status=($buyers['Order_Status']) ? $buyers['Order_Status'] :'';
                                            $track=($buyers['Tracking_No1']) ? $buyers['Tracking_No1'] :'';
                                            if ($Order_Status == '1' && $track != '') { ?>
                                                <p align="right"><button type="button" class="btn btn-info " onclick="test1('<?= $buyers['buserid'] ?>', '<?= $buyers['Trade_Id'] ?>')">Verify </button></p>
                                            <?php } else { ?>
                                                <p align="right" style="color: #fff;"> Trade Product</p>
                                                <?php
                                            }
                                        
                                        ?>
                                        <div class = "table-wrap">
                                            <div class = "table-responsive">
                                                <table id="" class="table table-hover display  pb-30" >
                                                    <thead>
                                                        <tr>
                                                            <th>serial no</th>
                                                            <th> FrontPicture</th>
                                                            <th>Item Name</th>
                                                            <th>Track No</th>
                                                            <th>Tracking Detail</th>
                                                            <th>More Detail</th>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    if (!empty($buyer_list)) {
                                                        $cnt = 1;
                                                        foreach ($buyer_list as $item) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $cnt++ ?></td>

                                                                <td><img src="<?php echo base_url() ?>./Items/<?php echo $item->Item_FrontPicture ?>" height="50" width="50"></td>
                                                                <td><?php echo $item->Item_Name; ?></td>
                                                                <td><?php echo $item->Tracking_No1; ?></td>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary " onclick="trackdetail('<?php echo $item->Tracking_No1; ?>')" data-toggle="modal" data-target="#moreresponsive-modal1" data-whatever="@mdo">Tracking Detail</button>
                                                                </td>
                                                                <td><button type="button" class="btn btn-primary " onclick="moredetail1('<?php echo $item->Item_Id; ?>', '<?php echo $item->buserid; ?>')" data-toggle="modal" data-target="#moreresponsive-modal2" data-whatever="@mdo">More</button></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='12'><p style='size:50px;>No any Product Found On Shipping</p></td></tr>";
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

    var htmls = '';
    function moredetail(itemid, suserid)
    {
        
        $.ajax({
            url: '<?php echo site_url('Shipping/haveitem_moredetails') ?> ',
            type: 'post',
            dataType: 'json',
            data: {Item_Id: itemid, sellerid: suserid},
            success: function (json) {

                if (json.code == 1)
                {
                    htmls = "<div class='row'><div class='col-sm-12'>";
                    htmls += "<table width='100%'><tr><td style='vertical-align: middle'><strong>Item front picture - </strong></td><td><img src='<?php echo base_url() . 'Items/'; ?>" + json.data[0].Item_FrontPicture + "' height='100' width='100'></td></tr>";
                    htmls += "<tr><td style='vertical-align: middle'><strong>Item back picture - </strong></td><td><img src='<?php echo base_url() . 'Items/'; ?>" + json.data[0].Item_BackPicture + "' height='100' width='100'></td></tr>";
                    htmls += "<tr><td style='vertical-align: middle'><strong>Item side picture - </strong></td><td><img src='<?php echo base_url() . 'Items/'; ?>" + json.data[0].Item_SidePicture + "' height='100' width='100'></td></tr>";
                    
                    htmls += "<tr><td style='vertical-align: middle'><strong>seller image - </strong></td><td><img src='<?php echo base_url() . 'Items/'; ?>" + json.data.sellerimg.User_ProfilePic + "' height='100' width='100'></td></tr>";
                    if (json.data[0].Item_Type == '1')
                    {
                        htmls += "<tr><td>Item by</td><td><strong>Instabuy item</strong></td></tr>";
                    } else if (json.data[0].Item_Type == '2')
                    {
                        htmls += "<tr><td>Item by</td><td><strong>Trade item</strong></td></tr>";
                    } else if (json.data[0].Item_Type == '3')
                    {
                        htmls += "<tr><td>Item by</td><td><strong>Auction item</strong></td></tr>";
                    }

                    htmls += "<tr><td><strong>Item condition - </strong></td><td>" + json.data[0].Item_Condition + "</td></tr>";//Item_Condition Item_Size Item_Availability Item_Brand Item_NormalPrice Item_MarketPrice Item_FrontPicture Item_BackPicture Item_SidePicture
                    htmls += "<tr><td><strong>Item size - </strong></td><td>" + json.data[0].Item_Size + "</td></tr>";
                    htmls += "<tr><td><strong>Item color - </strong></td><td>" + json.data[0].Item_Availability + "</td></tr>";
                    htmls += "<tr><td><strong>Item brand - </strong></td><td>" + json.data[0].Brand_Name + "</td></tr>";
                    htmls += "<tr><td><strong>Item normal price - </strong></td><td>" + json.data[0].Item_NormalPrice + "</td></tr>";
                    htmls += "<tr><td><strong>Item market price - </strong></td><td>" + json.data[0].Item_MarketPrice + "</td></tr>";
                    if (json.data[0].startdateampm == null)
                    {
                        htmls += "<tr><td><strong>Auction Starting date - </strong></td><td>Not Set</td></tr>";
                    } else
                    {
                        htmls += "<tr><td><strong>Auction Starting date - </strong></td><td>" + json.data[0].startdateampm + "</td></tr>";
                    }

                    if (json.data[0].endddateampm == null)
                    {
                        htmls += "<tr><td><strong>Auction Ending date - </strong></td><td>Not Set</td></tr>";
                    } else
                    {
                        htmls += "<tr><td><strong>Auction Ending date - </strong></td><td>" + json.data[0].endddateampm + "</td></tr>";
                    }
                    htmls += "<table>";
                    htmls += "</div></div>";
                    $("#yetmodalbody").html(htmls);
                } else if (json.code == 0)
                {
                    $("#moremodfMessage").html('<strong>' + json.message + '</strong>');
                    $("#moremodfailMessage").show();
                    setTimeout(function () {
                        $("#moremodfailMessage").hide();
                    }, 8000);
                }
            }
        });
    }
    
    var htmls = '';
    function moredetail1(itemid, buserid)
    {
        
        $.ajax({
            url: '<?php echo site_url('Shipping/item_moredetails') ?> ',
            type: 'post',
            dataType: 'json',
            data: {Item_Id: itemid, buyerid: buserid},
            success: function (json) {

                if (json.code == 1)
                {
                    htmls = "<div class='row'><div class='col-sm-12'>";
                    htmls += "<table width='100%'><tr><td style='vertical-align: middle'><strong>Item front picture - </strong></td><td><img src='<?php echo base_url() . 'Items/'; ?>" + json.data[0].Item_FrontPicture + "' height='100' width='100'></td></tr>";
                    htmls += "<tr><td style='vertical-align: middle'><strong>Item back picture - </strong></td><td><img src='<?php echo base_url() . 'Items/'; ?>" + json.data[0].Item_BackPicture + "' height='100' width='100'></td></tr>";
                    htmls += "<tr><td style='vertical-align: middle'><strong>Item side picture - </strong></td><td><img src='<?php echo base_url() . 'Items/'; ?>" + json.data[0].Item_SidePicture + "' height='100' width='100'></td></tr>";
                    
                    htmls += "<tr><td style='vertical-align: middle'><strong>buyer image - </strong></td><td><img src='<?php echo base_url() . 'Items/'; ?>" + json.data.buyerimg.User_ProfilePic + "' height='100' width='100'></td></tr>";
                    if (json.data[0].Item_Type == '1')
                    {
                        htmls += "<tr><td>Item by</td><td><strong>Instabuy item</strong></td></tr>";
                    } else if (json.data[0].Item_Type == '2')
                    {
                        htmls += "<tr><td>Item by</td><td><strong>Trade item</strong></td></tr>";
                    } else if (json.data[0].Item_Type == '3')
                    {
                        htmls += "<tr><td>Item by</td><td><strong>Auction item</strong></td></tr>";
                    }

                    htmls += "<tr><td><strong>Item condition - </strong></td><td>" + json.data[0].Item_Condition + "</td></tr>";//Item_Condition Item_Size Item_Availability Item_Brand Item_NormalPrice Item_MarketPrice Item_FrontPicture Item_BackPicture Item_SidePicture
                    htmls += "<tr><td><strong>Item size - </strong></td><td>" + json.data[0].Item_Size + "</td></tr>";
                    htmls += "<tr><td><strong>Item color - </strong></td><td>" + json.data[0].Item_Availability + "</td></tr>";
                    htmls += "<tr><td><strong>Item brand - </strong></td><td>" + json.data[0].Brand_Name + "</td></tr>";
                    htmls += "<tr><td><strong>Item normal price - </strong></td><td>" + json.data[0].Item_NormalPrice + "</td></tr>";
                    htmls += "<tr><td><strong>Item market price - </strong></td><td>" + json.data[0].Item_MarketPrice + "</td></tr>";
                    if (json.data[0].startdateampm == null)
                    {
                        htmls += "<tr><td><strong>Auction Starting date - </strong></td><td>Not Set</td></tr>";
                    } else
                    {
                        htmls += "<tr><td><strong>Auction Starting date - </strong></td><td>" + json.data[0].startdateampm + "</td></tr>";
                    }

                    if (json.data[0].endddateampm == null)
                    {
                        htmls += "<tr><td><strong>Auction Ending date - </strong></td><td>Not Set</td></tr>";
                    } else
                    {
                        htmls += "<tr><td><strong>Auction Ending date - </strong></td><td>" + json.data[0].endddateampm + "</td></tr>";
                    }
                    htmls += "<table>";
                    htmls += "</div></div>";
                    $("#yetmodalbody2").html(htmls);
                } else if (json.code == 0)
                {
                    $("#moremodfMessage2").html('<strong>' + json.message + '</strong>');
                    $("#moremodfailMessage2").show();
                    setTimeout(function () {
                        $("#moremodfailMessage2").hide();
                    }, 8000);
                }
            }
        });
    }

    
    var htmls = '';
    function trackdetail(Tracking_No1)
    {
        TrackingNo1 = Tracking_No1;
        $.ajax({
            url: '<?php echo site_url('Shipping/trackdetail') ?> ',
            type: 'post',
            dataType: 'json',
            data: {Tracking_No1: TrackingNo1},
            success: function (json) {

                if (json.code == 1)
                {
                    htmls = "<div class='row'><div class='col-sm-12'>";
                    htmls += "<table width='100%'><tr><td><strong>[1]  </strong></td><td>&nbsp;" + json.data.TrackDetail[0] + "</td></tr>";
                    htmls += "<tr><td><strong>[2]  </strong></td><td>&nbsp;" + json.data.TrackDetail[1] + "</td></tr>";
                    htmls += "<tr><td><strong>[3]  </strong></td><td>&nbsp;" + json.data.TrackDetail[2] + "</td></tr>";
                    htmls += "<tr><td><strong>[4]  </strong></td><td>&nbsp;" + json.data.TrackDetail[3] + "</td></tr>";
                    htmls += "<tr><td><strong>[5]  </strong></td><td>&nbsp;" + json.data.TrackDetail[4] + "</td></tr>";
                    htmls += "<tr><td><strong>[6]  </strong></td><td>&nbsp;" + json.data.TrackDetail[5] + "</td></tr>";
                    htmls += "<tr><td><strong>[7]  </strong></td><td>&nbsp;" + json.data.TrackDetail[6] + "</td></tr>";
                    htmls += "<tr><td><strong>[8]  </strong></td><td>&nbsp;" + json.data.TrackDetail[7] + "</td></tr>";
                    htmls += "<tr><td><strong>[9]  </strong></td><td>&nbsp;" + json.data.TrackDetail[8] + "</td></tr>";
                    htmls += "<tr><td><strong>[10]   </strong></td><td> &nbsp;" + json.data.TrackDetail[9] + "</td></tr>";
                    htmls += "<tr><td><strong>[11]   </strong></td><td> &nbsp;" + json.data.TrackDetail[10] + "</td></tr>";
                    htmls += "<tr><td><strong>[12]   </strong></td><td> &nbsp;" + json.data.TrackDetail[11] + "</td></tr>";
                    htmls += "<tr><td><strong>[13]   </strong></td><td> &nbsp;" + json.data.TrackDetail[12] + "</td></tr>";
                    htmls += "<tr><td><strong>[14]   </strong></td><td> &nbsp;" + json.data.TrackDetail[13] + "</td></tr>";
                    htmls += "<tr><td><strong>[15]   </strong></td><td> &nbsp;" + json.data.TrackDetail[14] + "</td></tr>";
                    htmls += "<tr><td><strong>[16]   </strong></td><td> &nbsp;" + json.data.TrackDetail[15] + "</td></tr>";
                    htmls += "<tr><td><strong>[17]   </strong></td><td> &nbsp;" + json.data.TrackDetail[16] + "</td></tr>";
                    htmls += "<table>";
                    htmls += "</div></div>";
                    $("#yetmodalbody1").html(htmls);
                } else if (json.code == 0)
                {
                     htmls = "<div class='row'><div class='col-sm-12'>";
                        htmls += "<table width='100%'><tr><td ><strong>Tracking Detail - </strong></td><td>not found</td></tr>";


                        htmls += "<table>";
                        htmls += "</div></div>";
                        $("#yetmodalbody1").html(htmls);
                }
            }
        });
    }

<?php if (validation_errors()) { ?>
        setTimeout(function () {
            $('#validationerror').fadeOut('slow');
        }, 10000);
<?php } ?>
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

    var OrderId = 0;
    function settracking(Order_Id)
    {
        OrderId = Order_Id;
    }

    function addtrackingno()
    {
        var trackno = $("#Tracking_No2").val();

        if (trackno == '')
        {
            alert("Plase Enter Tracking no");
        } else
        {
            $.ajax({
                url: '<?php echo site_url('shipping/addtrackno') ?> ',
                type: 'post',
                dataType: 'json',
                data: {Order_Id: OrderId, Tracking_No2: $("#Tracking_No2").val()},
                success: function (json) {

                    if (json.code == 1)
                    {
                        //                        cleardata();
                        $("#marketMessage").html('<strong>' + json.message + '</strong>');
                        $("#marketsuccessMessage").show();
                        setTimeout(function () {
                            $("#marketsuccessMessage").hide();
                            $('#responsive-modal-market').modal('hide');
                            window.location.href = "<?php echo site_url('shipping/shippedItem') ?>";
                        }, 5000);

                    } else if (json.code == 0)
                    {
                        //                        cleardata();
                        $("#marketfMessage").html('<strong>' + json.message + '</strong>');
                        $("#marketfailMessage").show();
                        setTimeout(function () {
                            $("#marketfailMessage").hide();
                        }, 8000);
                    }
                }
            });
        }
    }



    $(document).ready(function () {
        var i = 0;
        $(".swal2-confirm").click(function () {

            if (i == 1) {
                window.location.reload(true);
            } else {
                i++;
            }
        });
    });
    function test(suserid, Trade_Id)
    {
        suserId = suserid;
        TradeId = Trade_Id;
            
        swal({
            title: 'Are you sure?',
            text: "To verify This Product",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, verify it!',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (Sellertraking) {

                    $.ajax({
                        url: "<?php echo site_url("Shipping/sellerVerify") ?>",
                        type: 'POST',
                        data: {suserid: suserId, Trade_Id: TradeId},
                        //dataType: 'json'
                    })
                            .done(function (response) {
                                swal('Verified!', 'Verify successfully', 'success');
                                windows.location.reload(true);
                            })
                            .fail(function () {
                                swal('Oops...', 'Something went wrong with ajax !', 'error');
                            });
                });
            },
            allowOutsideClick: false
        });
    }

    function test1(buserid, Trade_Id)
    {
        buserId = buserid;
        TradeId = Trade_Id;
//            alert(suserId);
        swal({
            title: 'Are you sure?',
            text: "To verify This Product",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, verify it!',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (Buyertraking) {

                    $.ajax({
                        url: "<?php echo site_url("Shipping/buyerVerify") ?>",
                        type: 'POST',
                        data: {buserid: buserId, Trade_Id: TradeId},
                        //dataType: 'json'
                    })
                            .done(function (response) {
                                swal('Verified!', 'Verify successfully', 'success');
                                windows.location.reload(true);
                            })
                            .fail(function () {
                                swal('Oops...', 'Something went wrong with ajax !', 'error');
                            });
                });
            },
            allowOutsideClick: false
        });
    }

</script>

</body>
</html>