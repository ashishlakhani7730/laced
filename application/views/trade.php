<?php
include("header_body.php");
?>
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Trading Request
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
										<th>trade request send by</th>
										<th>trade requested by</th>
										<th>have item name</th>
										<th>have item more</th>  
										<th>trading item more</th>	
                                    </tr>
                                    </thead>
                                    <tbody>                                   
									<?php
												if($request_data)
												{
													$cnt = 1;
													foreach ($request_data as $sr) {
														?>
														<tr>
															<td><?php echo $cnt++; ?></td>
															<td><?php echo $sr->Request_send; ?></td>
															<td><?php echo $sr->Requested_user; ?></td>
															<td><?php echo $sr->have_item; ?></td>
															<td><button id="more<?php echo $cnt++; ?>" type="button" class="btn btn-primary " onclick="moredetail(<?php echo $sr->have_Item_Id; ?>)" data-toggle="modal" data-target="#moreresponsive-modal" data-whatever="@mdo">More</button></td>
															<td><button id="que<?php echo $cnt++; ?>" type="button" class="btn btn-primary " onclick="query_in('<?php echo $sr->Item_Id; ?>')" data-toggle="modal" data-target="#moreresponsive-modal2" data-whatever="@mdo">More</button></td>
														</tr>
														<?php
													}
												}
												else
												{
													echo "<tr><td colspan='12'>No any Notification</td></tr>";
												}
                                            ?>             
									</tbody>
									<tfoot>
                                    <tr>
                                        <th>serial no</th>
										<th>trade request send by</th>
										<th>trade requested by</th>
										<th>have item name</th>
										<th>have item more</th>  
										<th>trading item more</th>
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
										<div id="moreresponsive-modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg">
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
    </section>
</main>
<?php
include("footer_include.php");
?>
<script>
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
	
	var htmll = '';
    function query_in(itemids)
    {
        $.ajax({
            url: '<?php echo site_url('Trade/getitems') ?> ',
            type: 'post',
            dataType: 'json',
            data: {item_id: itemids},
            success: function (json) {
			
			        htmll = "<div class='row'><div class='col-sm-12'>";
                    htmll += "<table width='100%'>";
					htmll += "<th>Item front picture</th>";
					htmll += "<th>Item back picture</th>";
					htmll += "<th>Item side picture</th>";
					htmll += "<th>Item condition</th>";
					htmll += "<th>Item size</th>";
					htmll += "<th>Item color</th>";
					htmll += "<th>Item brand</th>";
					htmll += "<th>Item normal price</th>";
					htmll += "<th>Item market price</th>";
					htmll += "<th>Auction Starting date</th>";
					htmll += "<th>Auction Ending date</th>";
					for(i=0;i<json.length;i++){
					htmll += "<tr><td><img src='<?php echo base_url() . 'Items/'; ?>" + json[i].Item_FrontPicture + "' height='75' width='75'></td>";
                    htmll += "<td><img src='<?php echo base_url() . 'Items/'; ?>" + json[i].Item_BackPicture + "' height='75' width='75'></td>";
                    htmll += "<td><img src='<?php echo base_url() . 'Items/'; ?>" + json[i].Item_SidePicture + "' height='75' width='75'></td>";
                    htmll += "<td>" + json[i].Item_Condition + "</td>";//Item_Condition Item_Size Item_Availability Item_Brand Item_NormalPrice Item_MarketPrice Item_FrontPicture Item_BackPicture Item_SidePicture
                    htmll += "<td>" + json[i].Item_Size + "</td>";
                    htmll += "<td>" + json[i].Item_Availability + "</td>";
                    htmll += "<td>" + json[i].Brand_Name + "</td>";
                    htmll += "<td>" + json[i].Item_NormalPrice + "</td>";
                    htmll += "<td>" + json[i].Item_MarketPrice + "</td>";
                    if (json[i].startdateampm == null)
                    {
                        htmll += "<td>Not Set</td>";
                    } else
                    {
                        htmll += "<td>" + json[i].startdateampm + "</td>";
                    }

                    if (json[i].endddateampm == null)
                    {
                        htmll += "<td>Not Set</td>";
                    } else
                    {
                        htmll += "<td>" + json[i].endddateampm + "</td>";
                    }
			}
					htmll +="</tr>";
                    htmll += "<table>";
                    htmll += "</div></div>";
			$("#yetmodalbody2").html(htmll);
			}
		});
	}
</script>