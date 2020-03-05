<?php
include("header_body.php");
?>
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Item
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="container  pull-up">
            <div class="row">
			 <div class="col-2">
			 </div>
                <div class="col-3">
                     <div class="card m-b-30">
                        <div class="card-media">
                            <img class="card-img-top" src="<?php echo base_url()."Items/".$item_list[0]->Item_FrontPicture; ?>" alt="Card image cap" height="200px" width="200px">
                        </div>
                        <div class="card-body">                        
                            <p class="card-text">Item front Picture</p>
							<form id="frontfrm" action="<?php echo site_url("list_approve/changeimage"); ?>" method="post" enctype="multipart/form-data">
								<input type="file" name="front">
								<input type="hidden" name="itemid" value="<?php echo $item_list[0]->Item_Id; ?>">
								<button id="frontp" type="submit" class="btn btn-primary">Submit</button>
							</form>
							
                        </div>

                    </div>

                </div>
				<div class="col-3">
                     <div class="card m-b-30">
                        <div class="card-media">
                            <img class="card-img-top" src="<?php echo base_url()."Items/".$item_list[0]->Item_BackPicture; ?>" alt="Card image cap" height="200px" width="200px">
                        </div>
                        <div class="card-body">                        
                            <p class="card-text">Item Back Picture</p>
							<form id="Backfrm" action="<?php echo site_url("list_approve/changeimage2"); ?>" method="post" enctype="multipart/form-data">
								<input type="file" name="back">
								<input type="hidden" name="itemid" value="<?php echo $item_list[0]->Item_Id; ?>">
								<button id="frontp" type="submit" class="btn btn-primary">Submit</button>
							</form>
                        </div>

                    </div>

                </div>
				<div class="col-3">
                     <div class="card m-b-30">
                        <div class="card-media">
                            <img class="card-img-top" src="<?php echo base_url()."Items/".$item_list[0]->Item_SidePicture; ?>" alt="Card image cap" height="200px" width="200px">
                        </div>
                        <div class="card-body">                        
                            <p class="card-text">Item Side Picture</p>
							<form id="Sidefrm" action="<?php echo site_url("list_approve/changeimage3"); ?>" method="post" enctype="multipart/form-data">
								<input type="file" name="side">
								<input type="hidden" name="itemid" value="<?php echo $item_list[0]->Item_Id; ?>">
								<button id="frontp" type="submit" class="btn btn-primary">Submit</button>
							</form>
                        </div>

                    </div>

                </div>
				<div class="col-3">
				</div>
				<div class="col-3">
                     <div class="card m-b-30">
                        <div class="card-media">
                            <img class="card-img-top" src="<?php echo base_url()."Items/".$item_list[0]->Item_InsideTagPicture; ?>" alt="Card image cap" height="200px" width="200px">
                        </div>
                        <div class="card-body">                        
                            <p class="card-text">Item tag Picture</p>
							<form id="tagfrm" action="<?php echo site_url("list_approve/changeimage4"); ?>" method="post" enctype="multipart/form-data">
								<input type="file" name="tag">
								<input type="hidden" name="itemid" value="<?php echo $item_list[0]->Item_Id; ?>">
								<button id="frontp" type="submit" class="btn btn-primary">Submit</button>
							</form>
                        </div>

                    </div>

                </div>
				<div class="col-3">
                     <div class="card m-b-30">
                        <div class="card-media">
                            <img class="card-img-top" src="<?php echo base_url()."Items/".$item_list[0]->Item_BoxPicture; ?>" alt="Card image cap" height="200px" width="200px">
                        </div>
                        <div class="card-body">                        
                            <p class="card-text">Item box Picture</p>
							<form id="boxfrm" action="<?php echo site_url("list_approve/changeimage5"); ?>" method="post" enctype="multipart/form-data">
								<input type="file" name="box">
								<input type="hidden" name="itemid" value="<?php echo $item_list[0]->Item_Id; ?>">
								<button id="frontp" type="submit" class="btn btn-primary">Submit</button>
							</form>
                        </div>

                    </div>

                </div>
				
            </div>
			<div class="row">
			<div class="col-1">
			 </div>
			<div class="col-lg-10 m-b-30">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Item Information</div>                       
                        </div>
                        <div class="card-body">
                            <div class="timeline">                              
                                <div class="timeline-item">
                                    <div class="timeline-wrapper">
                                        <div class="">
                                            <div class="avatar avatar-sm">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    1
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="m-0">Seller Name - <?php echo $item_list[0]->User_FullName; ?></h6>
                                        </div>                                   
                                    </div>

                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-wrapper">
                                        <div class="">
                                            <div class="avatar avatar-sm">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    2
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="m-0">Item Type - <?php if($item_list[0]->Item_Type == 1) { echo "Instabuy";}else if($item_list[0]->Item_Type == 2){ echo "Trade";}else if($item_list[0]->Item_Type == 3){ echo "Auction";} ?></h6>
                                        </div>                                     
                                    </div>

                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-wrapper">
                                        <div class="">
                                            <div class="avatar avatar-sm">
                                                <div class="avatar-title bg-success rounded-circle">
                                                   3
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="m-0">Item Name - <?php echo $item_list[0]->Item_Name; ?></h6>
                                        </div>                                   
                                    </div>

                                </div>
								<div class="timeline-item">
                                    <div class="timeline-wrapper">
                                        <div class="">
                                            <div class="avatar avatar-sm">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    4
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="m-0">Item Condition - <?php echo $item_list[0]->Item_Condition; ?></h6>
                                        </div>                                   
                                    </div>

                                </div>
								<div class="timeline-item">
                                    <div class="timeline-wrapper">
                                        <div class="">
                                            <div class="avatar avatar-sm">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    5
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="m-0">Item Size - <?php echo $item_list[0]->Item_Size; ?></h6>
                                        </div>                                   
                                    </div>

                                </div>								
								<div class="timeline-item">
                                    <div class="timeline-wrapper">
                                        <div class="">
                                            <div class="avatar avatar-sm">
                                                <div class="avatar-title bg-success rounded-circle">
                                                   6
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="m-0">Brand Name - <?php echo $item_list[0]->Brand_Name; ?></h6>
                                        </div>                                   
                                    </div>

                                </div>
								<div class="timeline-item">
                                    <div class="timeline-wrapper">
                                        <div class="">
                                            <div class="avatar avatar-sm">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    7
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <h6 class="m-0">Normal Price - <?php echo $item_list[0]->Item_NormalPrice; ?></h6>
                                        </div>                                   
                                    </div>
                                </div>
								<div class="timeline-item">
                                    <div class="timeline-wrapper">
                                        <div class="">
                                            <div class="avatar avatar-sm">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    8
                                                </div>
                                            </div>
                                        </div>
										<?php if($item_list[0]->Item_MarketPrice != ""){ ?>
                                        <div class="col-auto">
                                            <h6 class="m-0">Market Price - <?php echo $item_list[0]->Item_MarketPrice; ?></h6>
                                        </div>                             
										<?php } else { ?>
										<div class="col-auto">
											<button type="button" class="btn btn-primary " onclick="setmarketp(<?php echo $item_list[0]->Item_Id; ?>)" data-toggle="modal" data-target="#responsive-modal" data-whatever="@mdo">Add Market Price</button>
										</div> 	 	
										<?php } ?>
									</div>
                                </div>
								<?php if($item_list[0]->Item_Type == 3){ ?>
								<div class="timeline-item">
                                    <div class="timeline-wrapper">
                                        <div class="">
                                            <div class="avatar avatar-sm">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    9
                                                </div>
                                            </div>
                                        </div>
										<?php if($item_list[0]->startdateampm == "" && $item_list[0]->endddateampm == ""){ ?>
										<div class="col-auto">
											<a href="<?php echo site_url("item/adddate")."/".$item_list[0]->Item_Id."/".$item_list[0]->User_Id; ?>" class="btn btn-primary ">Add Auction Date</a>
										</div> 
										<?php } else { ?>
										<div class="col-auto">
											<h6 class="m-0">Auction Date - <?php echo $item_list[0]->startdateampm." - ".$item_list[0]->endddateampm; ?></h6>
										</div> 
										<?php } ?>
									</div>
                                </div>
								<?php } ?>
								<?php if($item_list[0]->Item_MarketPrice != ""){ ?>
								<form action="<?php echo site_url("list_approve/accept_product"); ?>" method="post">
								<input type="hidden" name="itemid" value="<?php echo $item_list[0]->Item_Id;?>">
								<button type="submit" class="btn btn-primary">Approve Product</button>
								<?php } ?>
								</form>
							</div>
                        </div>
                    </div>
			</div>
        </div> 
		<div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h5 class="modal-title">Add Market Price</h5>
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
	$("#modsuccessMessage").hide();
    $("#modfailMessage").hide();

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
                        //cleardata();
                        $("#modsMessage").html('<strong>' + json.message + '</strong>');
                        $("#modsuccessMessage").show();
                        setTimeout(function () {
                            $("#modsuccessMessage").hide();
                            $('#responsive-modal').modal('hide');
                            window.location.href = "<?php echo site_url('/list_approve/more/').$this->uri->segment(3); ?>";
                        }, 5000);

                    } else if (json.code == 0)
                    {
                        //cleardata();
                        $("#modfMessage").html('<strong>' + json.message + '</strong>');
                        $("#modfailMessage").show();
                        setTimeout(function () {
                            $("#modfailMessage").hide();
							}, 8000);
                    }
                }
            });
        }
    }
	
</script>