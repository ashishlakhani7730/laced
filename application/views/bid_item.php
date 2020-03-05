<?php
include("header_body.php");
?>
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Bid Product
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
										<th>Item Name</th>
										<th>Item FrontPicture</th>                                                   
										<th>Item NormalPrice</th>
										<th>Item MarketPrice</th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>More Detail</th>
										<th>View Bid List</th>
										<th>Declare Winner</th>
                                    </tr>
                                    </thead>
                                    <tbody>                                   
									<?php
									if($bidlist)
									{
										$cnt = 1;
										foreach ($bidlist as $item) {
											?>
											<tr>
												<td><?php echo $cnt++ ?></td>
												<td><?php echo $item->Item_Name ?></td>
												<td><img src="<?php echo base_url() ?>./Items/<?php echo $item->Item_FrontPicture ?>" height="50" width="50"></td>
												
												<td><?php echo $item->Item_NormalPrice ?></td>
												<td><?php echo $item->Item_MarketPrice ?></td>
												<td><?php echo $item->startdateampm ?></td>
												<td><?php echo $item->endddateampm ?></td>
												<td><button id="<?php echo $cnt++ ?>" type="button" class="btn btn-primary" onclick="moredetail(<?php echo $item->Item_Id; ?>)" data-toggle="modal" data-target="#moreresponsive-modal" data-whatever="@mdo">More</button></td>
												<td><button id="<?php echo $cnt++ ?>" type="button" class="btn  btn-success" onclick="getbiding(<?php echo $item->Item_Id; ?>)" data-toggle="modal" data-target="#bidresponsive-modal" data-whatever="@mdo"><i class="fa fa-gavel mr-20"></i>Biding</button></td>
												<td><button id="<?php echo $cnt++ ?>" type="button" class="btn  btn-success" onclick="bidwinner(<?php echo $item->Item_Id; ?>)">Winner</button></td>
											</tr>
											<?php
										}
									}
									else
									{
										echo "<tr><td colspan='12'>No any Product Found On Bid</td></tr>";
									}
									?>             
									</tbody>
									<tfoot>
                                    <tr>
                                        <th>serial no</th>
										<th>Item Name</th>
										<th>Item FrontPicture</th>                                                   
										<th>Item NormalPrice</th>
										<th>Item MarketPrice</th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>More Detail</th>
										<th>View Bid List</th>
										<th>Declare Winner</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
							</div>
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
						<div class="modal-body">
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
		<div id="bidresponsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h5 class="modal-title">Auction Bidding list</h5>
						</div>
						<div id="bid-body" class="modal-body">
							<div id="bidmodfailMessage" class="alert alert-info alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div id="bidmodfMessage"></div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>									
						</div>
					</div>
				</div>
		</div>
		<div class="modal fade" id="pleasewait" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog  modal-dialog-align-top-left" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Please Wait</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="progress">
													<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:100%">
													 Please Wait
													</div>
												  </div>
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
	$("#pleasewait").modal("hide");
	var htmls = '';
	function moredetail(itemid)
	{
		$.ajax({
				url: '<?php echo site_url('item/moredetails') ?> ',
				type: 'post',
				dataType: 'json',
				data: {item_id:itemid},
				success: function(json) {
					
					if(json.code == 1)
					{
							$(".modal-body").empty();
							htmls = "<div class='row'><div class='col-sm-12'>";
							htmls += "<table width='100%'><tr><td style='vertical-align: middle'><strong>Item front picture - </strong></td><td><img src='<?php echo base_url().'Items/'; ?>"+json.data[0].Item_FrontPicture+"' height='100' width='100'></td></tr>";
							htmls += "<tr><td style='vertical-align: middle'><strong>Item back picture - </strong></td><td><img src='<?php echo base_url().'Items/'; ?>"+json.data[0].Item_BackPicture+"' height='100' width='100'></td></tr>";		
							htmls += "<tr><td style='vertical-align: middle'><strong>Item side picture - </strong></td><td><img src='<?php echo base_url().'Items/'; ?>"+json.data[0].Item_SidePicture+"' height='100' width='100'></td></tr>";		
							htmls += "<tr><td style='vertical-align: middle'><strong>Item side picture - </strong></td><td><img src='<?php echo base_url().'Items/'; ?>"+json.data[0].Item_InsideTagPicture+"' height='100' width='100'></td></tr>";	
							htmls += "<tr><td style='vertical-align: middle'><strong>Item side picture - </strong></td><td><img src='<?php echo base_url().'Items/'; ?>"+json.data[0].Item_BoxPicture+"' height='100' width='100'></td></tr>";	
							htmls +="<tr><td><strong>Item condition - </strong></td><td>"+json.data[0].Item_Condition +"</td></tr>";//Item_Condition Item_Size Item_Availability Item_Brand Item_NormalPrice Item_MarketPrice Item_FrontPicture Item_BackPicture Item_SidePicture
							htmls +="<tr><td><strong>Item size - </strong></td><td>"+json.data[0].Item_Size +"</td></tr>";
							htmls +="<tr><td><strong>Item color - </strong></td><td>"+json.data[0].Item_Availability +"</td></tr>";
							htmls +="<tr><td><strong>Item brand - </strong></td><td>"+json.data[0].Brand_Name +"</td></tr>";
							htmls +="<tr><td><strong>Item normal price - </strong></td><td>"+json.data[0].Item_NormalPrice +"</td></tr>";
							htmls +="<tr><td><strong>Item market price - </strong></td><td>"+json.data[0].Item_MarketPrice +"</td></tr>";
							if(json.data[0].startdateampm == null)
							{
								htmls +="<tr><td><strong>Auction Starting date - </strong></td><td>Not Set</td></tr>";	
							}
							else
							{
								htmls +="<tr><td><strong>Auction Starting date - </strong></td><td>"+json.data[0].startdateampm +"</td></tr>";
							}

							if(json.data[0].endddateampm == null)
							{
								htmls +="<tr><td><strong>Auction Ending date - </strong></td><td>Not Set</td></tr>";
							}
							else
							{
								htmls +="<tr><td><strong>Auction Ending date - </strong></td><td>"+json.data[0].endddateampm +"</td></tr>";
							}
							htmls += "<table>";
							htmls += "</div></div>";
							$(".modal-body").html(htmls);
					}
					else if(json.code == 0)
					{
						$("#moremodfMessage").html('<strong>'+json.message+'</strong>');
						$("#moremodfailMessage").show();
						setTimeout(function(){
							$("#moremodfailMessage").hide();
						}, 8000);
					}
				}
			});
	}
	
	function getbiding(itemid)
	{
		$.ajax({
				url: '<?php echo site_url('bid/bidlist') ?> ',
				type: 'post',
				dataType: 'json',
				data: {item_id:itemid},
				success: function(json) {
					
					if(json.code == 1)
					{
							$("#bid-body").empty();
							htmls = "<div class='row'><div class='col-sm-12'>";
							htmls += "<table width='100%'>";
							htmls += "<th>User Profile</th><th>User</th><th>Bid Price</th><th>Winner</th>";	
							
							for(var dt=0;dt<json.datas.length;dt++)
							{
								if(json.datas[dt].User_ProfilePic == '' || json.datas[dt].User_ProfilePic == null) 
								{
									htmls += "<tr><tr><td><img src='<?php echo base_url().'Items/2078405789cc7e5c03cc4997106747cb688fefcdef5b0febbabdef2.png'; ?>' height='50' width='50'></td><td><span style='vertical-align: middle; '>"+json.datas[dt].User_Name+"</span></td><td>"+json.datas[dt].Bid_Price+"</td>";
									if(json.datas[dt].Winner == 0)
									{
										htmls += "<td>NO</td>";
									}
									else
									{
										htmls += "<td>Yes</td>";
									}
									htmls += "</tr>";		
								}
								else
								{
								    
									htmls += "<tr><tr><td><img src='<?php echo base_url().'Items/'; ?>"+json.datas[dt].User_ProfilePic+"' height='50' width='50'></td><td><span style='vertical-align: middle'>"+json.datas[dt].User_Name+"</span></td><td>"+json.datas[dt].Bid_Price+"</td>";	
									if(json.datas[dt].Winner == 0)
									{
										htmls += "<td>NO</td>";
									}
									else
									{
										htmls += "<td>Yes</td>";
									}
									htmls += "</tr>";
								}
							}
							
							htmls += "<table>";
							htmls += "</div></div>";
							
							$("#bid-body").html(htmls);
					}
					else if(json.code == 0)
					{
						$("#bidmodfMessage").html('<strong>'+json.message+'</strong>');
						$("#bidmodfailMessage").show();
						setTimeout(function(){
							$("#bidmodfailMessage").hide();
						}, 8000);
					}
				}
			});
	}
	
	function bidwinner(itemid)
	{
		$("#pleasewait").modal("show");
		$.ajax({
				url: '<?php echo site_url('bid/winner') ?> ',
				type: 'post',
				dataType: 'json',
				data: {item_id:itemid},
				success: function(json) {
					
					if(json.code == 1)
					{
						$("#pleasewait").modal("hide");
						location.reload();	
					}
					else if(json.code == 0)
					{
						$("#pleasewait").modal("hide");
						$("#bidmodfMessage").html('<strong>'+json.message+'</strong>');
						$("#bidmodfailMessage").show();
						setTimeout(function(){
							$("#bidmodfailMessage").hide();
						}, 8000);
					}
				}
			});
	}
	
	<?php if(validation_errors()) { ?>
	setTimeout(function() {
				$('#validationerror').fadeOut('slow');
            }, 10000);
	<?php } ?>
	<?php if(empty($this->session->flashdata('message'))) { ?>
			$('#successMessage').hide();
	<?php } else { ?>
			setTimeout(function() {
				$('#successMessage').fadeOut('slow');
            }, 5000);
	<?php } ?>
	
	<?php if(empty($this->session->flashdata('fail_message'))) { ?>
			$('#failMessage').hide();
	<?php } else { ?>
			setTimeout(function() {
				$('#failMessage').fadeOut('slow');
            }, 5000);
	<?php } ?>
	
</script>
</body>
</html>
