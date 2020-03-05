<?php
include("header_body.php");
?>
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Auction Product
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="container  pull-up">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive p-t-10">
                                <table id="example" class="table   " style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>serial no</th>
										<th> FrontPicture</th> 
										<th> Name</th>                               
										<th> NormalPrice</th>
										<th> MarketPrice</th>
										<th>More Detail</th>
										<th>add auction date</th>
										<th>status</th>
										<th>action</th>	
                                    </tr>
                                    </thead>
                                    <tbody>                                   
									<?php
									if ($item_list) {
										$cnt = 1;
										foreach ($item_list as $item) {
											?>
											<tr>
												<td><?php echo $cnt++ ?></td>
												<td><img src="<?php echo base_url() ?>./Items/<?php echo $item->Item_FrontPicture ?>" height="50" width="50"></td>

												<td><?php echo $item->Item_Name ?></td>
												<td><?php echo $item->Item_NormalPrice ?></td>
												<td> <?php if ($item->Item_MarketPrice == '') { ?>
														<button type="button" class="btn btn-primary " onclick="setmarketp(<?php echo $item->Item_Id; ?>)" data-toggle="modal" data-target="#responsive-modal-market" data-whatever="@mdo">Add Price</button>
														<?php
													} else {
														echo $item->Item_MarketPrice;
													}
													?></td>
												<td><button type="button" class="btn btn-primary " onclick="moredetail(<?php echo $item->Item_Id; ?>)" data-toggle="modal" data-target="#moreresponsive-modal" data-whatever="@mdo">More</button></td>
												<?php if (($item->Item_Sale_StartDate == '0000-00-00 00:00:00' && $item->Item_Sale_EndDate == '0000-00-00 00:00:00') || ($item->Item_Sale_StartDate == '' && $item->Item_Sale_EndDate == '') ) { ?>
													<td><a href="<?php echo site_url("item/adddate")."/".$item->Item_Id."/".$item->User_Id; ?>" class="btn btn-primary ">Add</a></td>
												<?php } else { ?>															
													<td><?php
														$Start_Date = date("h:i a m/d/y",  strtotime($item->Item_Sale_StartDate));
														$End_Date = date("h:i a m/d/y",  strtotime($item->Item_Sale_EndDate));
														echo $Start_Date
														?> - <?php echo $End_Date
														?></td>
												<?php } ?>

												<td><?php
													if ($item->Item_Status == '1') {
														?>

												<i class="mdi mdi-check h1 m-0" style="color: green"></i>
												<?php
											}
											?>
											<?php
											if ($item->Item_Status == '0') {
												?>
												<i class="mdi mdi-close h1 m-0" style="color: red"></i>
												<?php
											}
											?>
											</td>


											<td><div class="input-group-btn">
													<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
													<ul class="dropdown-menu">                                 

														<?php
														if ($item->Item_Status == '1') {
															?>
															<li><a onclick="return confirm('Are you sure you want to disapprove this item?');" href="<?php echo site_url("item/app_disapp/$item->Item_Id/$item->User_Id/0/auction") ?>"><span class="glyphicon glyphicon-remove" style="color: red"> </span>&nbsp; disapproved</a></li>
															<?php
														}
														?>
														<?php
														if ($item->Item_Status == '0') {
															?>
															<li><a onclick="return confirm('Are you sure you want to approve this item?');" href="<?php echo site_url("item/app_disapp/$item->Item_Id/$item->User_Id/1/auction") ?>"><span class="glyphicon glyphicon-ok" style="color: green"> </span>&nbsp; approve</a></li>
															<?php
														}
														?>           
														<li><?php if ($item->Item_Status == '1') { ?><a  href="<?php echo site_url("item/raffle_data/$item->Item_Id/auction") ?>"> <span class="pe pe-7s-ticket" ></span>   &nbsp;   Raffle</a><?php
															} else {
																
															}
															?> </li>
														<li><?php if ($item->Item_Status == '1') { ?><a  href="<?php echo site_url("item/contest_data/$item->Item_Id/auction") ?>"> <span class="pe pe-7s-ticket" ></span>   &nbsp;  Contest</a><?php
															} else {
																
															}
															?> </li>

														<li><?php if ($item->Item_Status == '1') { ?><a onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo site_url("item/delete_data/$item->Item_Id/auction") ?>"><span class="fa fa-trash-o"> &nbsp;    Delete</span></a><?php
															} else {
																
															}
															?> </li>  
														<!--<li> <a  href="<?php echo site_url("item/viewAllAuctionProductImages/$item->Item_Id") ?>" ><span class="fa fa-image"> &nbsp;Transparent </span></a> </li>-->

													</ul>
												</div>  
											</td>
											</tr>
											<?php
										}
									} else {
										echo "<tr><td colspan='12'>No any Product Found On Auction</td></tr>";
									}
									?>             
									</tbody>
									<tfoot>
                                    <tr>
                                        <th>serial no</th>
										<th> FrontPicture</th> 
										<th> Name</th>                               
										<th> NormalPrice</th>
										<th> MarketPrice</th>
										<th>More Detail</th>
										<th>add auction date</th>
										<th>status</th>
										<th>action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
		<div id="responsive-modal-market" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h5 class="modal-title">Add Market Price</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div id="marketsuccessMessage" class="alert alert-success alert-dismissable">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div id="marketMessage"></div>
                                                        </div>
                                                        <div id="marketfailMessage" class="alert alert-info alert-dismissable">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div id="marketfMessage"></div>
                                                        </div>
                                                        <form>
                                                            <div class="form-group">
                                                                <label class="control-label mb-10 text-left">Add Market Price</label>
                                                                <div class='input-group date' id='marketprice2'>
                                                                    <input id="marketprice" type='text' name="marketprice" class="form-control" />
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button onclick="addmarketprice()" type="button" class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h5 class="modal-title">Select Auction Staring Date And Ending Date</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div id="modsuccessMessage" class="alert alert-success alert-dismissable">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div id="modsMessage"></div>
                                                        </div>
                                                        <div id="modfailMessage" class="alert alert-info alert-dismissable">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div id="modfMessage"></div>
                                                        </div>
                                                        <form>
                                                            <div class="form-group">
                                                                <label class="control-label mb-10 text-left">date time pick</label>
                                                                <div class='input-group date' id='datetimepicker1'>
                                                                    <input id="date1" type='text' name="date1" class="js-datepicker form-control" />
                                                                    <span class="input-group-addon">
                                                                        <span class="fa fa-calendar open-datetimepicker"></span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label mb-10 text-left">date time pick</label>
                                                                <div class='input-group date' id='datetimepicker2'>
                                                                    <input id="date2" type='text' name="date2" class="js-datepicker form-control" />
                                                                    <span class="input-group-addon">
                                                                        <span class="fa fa-calendar"></span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button id="setauctiondate" type="button" class="btn btn-danger">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    </section>
</main>
<?php
include("footer_include.php");
?>
<script>

    $("#marketsuccessMessage").hide();
    $("#marketfailMessage").hide();

    var Itemid = 0;
    function setmarketp(item_id)
    {
        Itemid = item_id;
    }

    function addmarketprice()
    {
        var mprice = $("#marketprice").val();

        if (mprice == '')
        {
            alert("Plase Enter Market Price");
        } else
        {
            $.ajax({
                url: '<?php echo site_url('item/addmarketprice') ?> ',
                type: 'post',
                dataType: 'json',
                data: {item_id: Itemid, marketprice: $("#marketprice").val()},
                success: function (json) {

                    if (json.code == 1)
                    {
                        cleardata();
                        $("#marketMessage").html('<strong>' + json.message + '</strong>');
                        $("#marketsuccessMessage").show();
                        setTimeout(function () {
                            $("#marketsuccessMessage").hide();
                            $('#responsive-modal-market').modal('hide');
                            window.location.href = "<?php echo site_url('item/auctionitem') ?>";
                        }, 5000);

                    } else if (json.code == 0)
                    {
                        cleardata();
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

    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure you want to delete this item?'))
            e.preventDefault();
    };

    $('#datetimepicker1').datetimepicker();
    $('#datetimepicker2').datetimepicker();

    var itemid = 0;
    var userid = 0;

    function setid(iid, uid)
    {
        itemid = iid;
        userid = uid;
    }

    $("#modsuccessMessage").hide();
    $("#modfailMessage").hide();

    $("#setauctiondate").click(function () {

        var startdate = $("#date1").val();
        var enddate = $("#date2").val();

        if (startdate == '')
        {
            alert('Please Enter auction start Date');
        } else if (enddate == '')
        {
            alert('Please Enter auction end Date');
        } else
        {
            // here we used reusability concept.
            $.ajax({
                url: '<?php echo site_url('item/setdate') ?> ',
                type: 'post',
                dataType: 'json',
                data: {sdate: startdate, edate: enddate, item_id: itemid, user_id: userid},
                success: function (json) {

                    if (json.code == 1)
                    {
                        cleardata();
                        $("#modsMessage").html('<strong>' + json.message + '</strong>');
                        $("#modsuccessMessage").show();
                        setTimeout(function () {
                            $("#modsuccessMessage").hide();
                            $('#responsive-modal').modal('hide');
                            location.reload();
                        }, 5000);
                    } else if (json.code == 0)
                    {
                        cleardata();
                        $("#modfMessage").html('<strong>' + json.message + '</strong>');
                        $("#modfailMessage").show();
                        setTimeout(function () {
                            $("#modfailMessage").hide();
                        }, 8000);
                    }
                }
            });
        }
    });

    function cleardata()
    {
        $("#date1").val('');
        $("#date2").val('');
        $("#marketprice").val('');
    }

    var htmls = '';
    function moredetail(itemid)
    {
        $.ajax({
            url: '<?php echo site_url('item/moredetails') ?> ',
            type: 'post',
            dataType: 'json',
            data: {item_id: itemid},
            success: function (json) {

                if (json.code == 1)
                {
                    htmls = "<div class='row'><div class='col-sm-12'>";
                    htmls += "<table width='100%'><tr><td style='vertical-align: middle'><strong>Item front picture - </strong></td><td><img src='<?php echo base_url() . 'Items/'; ?>" + json.data[0].Item_FrontPicture + "' height='100' width='100'></td></tr>";
                    htmls += "<tr><td style='vertical-align: middle'><strong>Item back picture - </strong></td><td><img src='<?php echo base_url() . 'Items/'; ?>" + json.data[0].Item_BackPicture + "' height='100' width='100'></td></tr>";
                    htmls += "<tr><td style='vertical-align: middle'><strong>Item side picture - </strong></td><td><img src='<?php echo base_url() . 'Items/'; ?>" + json.data[0].Item_SidePicture + "' height='100' width='100'></td></tr>";
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

</script>
</body>
</html>
