<?php
include("header_body.php");
?>
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> 
All Product

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
										<th> Condition</th>
										<th> Size</th>
										<th> Color</th>
										<th> Brand</th>
										<th> NormalPrice</th>
										<th> MarketPrice</th>
										<th>created</th>
										<th>status</th>
										<th>action</th>	
                                    </tr>
                                    </thead>
                                    <tbody>                                   
									<?php
									$cnt = 1;
									foreach ($item_list as $item) {
										?>
										<tr>
											<td><?php echo $cnt++ ?></td>
											<td><img src="<?php echo base_url() ?>./Items/<?php echo $item->Item_FrontPicture ?>" height="50" width="50"></td>
											<td><?php echo $item->Item_Name ?></td>
											<td><?php echo $item->Item_Condition ?></td>
											<td><?php echo $item->Item_Size ?></td>
											<td><?php echo $item->Item_Availability ?></td>
											<td><?php echo $item->Brand_Name ?></td>
											<td><?php echo $item->Item_NormalPrice ?></td>
											<td><?php if ($item->Item_MarketPrice == '') { ?>
													<button type="button" class="btn btn-primary " onclick="setmarketp(<?php echo $item->Item_Id; ?>)" data-toggle="modal" data-target="#responsive-modal-market" data-whatever="@mdo">Add Price</button>
													<?php
												} else {
													echo $item->Item_MarketPrice;
												}
												?></td>

											<td><?php
												$Date = date("h:i a m/d/y", strtotime("12 hours", strtotime($item->created)));
												echo $Date
												?></td>
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
														<li><a onclick="return confirm('Are you sure you want to disapprove this item?');" href="<?php echo site_url("item/app_disapp/$item->Item_Id/$item->User_Id/0/allitem") ?>"><span class="glyphicon glyphicon-remove" style="color: red"> </span>&nbsp; disapproved</a></li>
														<?php
													}
													?>
													<?php
													if ($item->Item_Status == '0') {
														?>
														<li><a onclick="return confirm('Are you sure you want to approve this item?');" href="<?php echo site_url("item/app_disapp/$item->Item_Id/$item->User_Id/1/allitem") ?>"><span class="glyphicon glyphicon-ok" style="color: green"> </span>&nbsp; approve</a></li>
														<?php
													}
													?>

													<li><?php if ($item->Item_Status == '1') { ?><a  href="<?php echo site_url("item/raffle_data/$item->Item_Id/allitem") ?>"> <span class="pe pe-7s-ticket" ></span>   &nbsp;   Raffle</a><?php
														} else {
															
														}
														?> </li>
													<li><?php if ($item->Item_Status == '1') { ?><a  href="<?php echo site_url("item/contest_data/$item->Item_Id/allitem") ?>"> <span class="pe pe-7s-ticket" ></span>   &nbsp;  Contest</a><?php
														} else {
															
														}
														?> </li>
													<li><?php if ($item->Item_Status == '1') { ?>
															<a onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo site_url("item/delete_data/$item->Item_Id/allitem") ?>"><span class="fa fa-trash-o"> &nbsp;    Delete</span></a>
															<?php
														} else {
															
														}
														?></li>
													<!--<li> <a  href="<?php echo site_url("item/viewAllAllProductImages/$item->Item_Id") ?>" ><span class="fa fa-image"> &nbsp;Transparent </span></a> </li>-->

												</ul>
											</div>  
										</td>
										</tr>
										<?php
									}
									?>            
									</tbody>
									<tfoot>
                                    <tr>
                                        <th>serial no</th>
										<th> FrontPicture</th>
										<th> Name</th>
										<th> Condition</th>
										<th> Size</th>
										<th> Color</th>
										<th> Brand</th>
										<th> NormalPrice</th>
										<th> MarketPrice</th>
										<th>created</th>
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
						<button onclick="addmarketprice()" type="button" class="btn btn-success">Save</button>
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
                            window.location.href = "<?php echo site_url('item/index') ?>";
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
