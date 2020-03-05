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
Shipping Trade Product

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
										<th>Seller </th>
										<th> Email</th>
										<th>Address </th>
										<th>Buyer </th>
										<th> Email</th>
										<th>Address </th>
										<th>More Detail</th>	
                                    </tr>
                                    </thead>
                                    <tbody>                                   
									<?php
									if ($shipping_list) {
										$cnt = 1;
										foreach ($shipping_list as $item) {
											?>
											<tr>
												<td><?php echo $cnt++ ?></td>
												<td><?php echo $item->seller; ?></td>
												<td><?php echo $item->sellerEmail; ?></td>
												<td><?php echo $item->sellerAddress; ?></td>
												<td><?php echo $item->buyer; ?></td>
												<td><?php echo $item->buyerEmail; ?></td>
												<td><?php echo $item->buyerAddress; ?></td>
												<td> 
													 <a class="btn btn-primary" href="<?php echo site_url("Shipping/more/$item->Trade_Id") ?>"> More</a>
												</td>

												
											</tr>
											<?php
										}
									} else {
										echo "<tr><td colspan='12'>No any Product Found On Shipping</td></tr>";
									}
									?>             
									</tbody>
									<tfoot>
                                    <tr>
                                        <th>serial no</th>
										<th>Seller </th>
										<th> Email</th>
										<th>Address </th>
										<th>Buyer </th>
										<th> Email</th>
										<th>Address </th>
										<th>More Detail</th>
                                    </tr>
                                    </tfoot>
                                </table>
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

    var htmls = '';
    function moredetail(itemid, buserid, suserid)
    {
        $.ajax({
            url: '<?php echo site_url('shipping/moredetails') ?> ',
            type: 'post',
            dataType: 'json',
            data: {item_id: itemid, buyerid: buserid, sellerid: suserid},
            success: function (json) {

                if (json.code == 1)
                {
                    htmls = "<div class='row'><div class='col-sm-12'>";
                    htmls += "<table width='100%'><tr><td style='vertical-align: middle'><strong>Item front picture - </strong></td><td><img src='<?php echo base_url() . 'Items/'; ?>" + json.data[0].Item_FrontPicture + "' height='100' width='100'></td></tr>";
                    htmls += "<tr><td style='vertical-align: middle'><strong>Item back picture - </strong></td><td><img src='<?php echo base_url() . 'Items/'; ?>" + json.data[0].Item_BackPicture + "' height='100' width='100'></td></tr>";
                    htmls += "<tr><td style='vertical-align: middle'><strong>Item side picture - </strong></td><td><img src='<?php echo base_url() . 'Items/'; ?>" + json.data[0].Item_SidePicture + "' height='100' width='100'></td></tr>";
                    htmls += "<tr><td style='vertical-align: middle'><strong>buyer image - </strong></td><td><img src='<?php echo base_url() . 'Items/'; ?>" + json.data.buyerimg.User_ProfilePic + "' height='50' width='50'></td></tr>";
                    htmls += "<tr><td style='vertical-align: middle'><strong>seller image - </strong></td><td><img src='<?php echo base_url() . 'Items/'; ?>" + json.data.sellerimg.User_ProfilePic + "' height='50' width='50'></td></tr>";
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
    function test(arg)
    {
        var id = arg;
        swal({
            title: 'Are you sure?',
            text: "It will be Added!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Added it!',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (Sellertraking) {

                    $.ajax({
                        url: "<?php echo site_url("Order_list/Sellertrack") ?>",
                        type: 'POST',
                        data: {Order_Id: id},
                        //dataType: 'json'
                    })
                            .done(function (response) {
                                swal('Added!', 'Tracking Number added successfully', 'success');
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

    function test1(arg)
    {
        var id = arg;
        swal({
            title: 'Are you sure?',
            text: "It will be Added!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Added it!',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (Buyertraking) {

                    $.ajax({
                        url: "<?php echo site_url("Order_list/Buyertrack") ?>",
                        type: 'POST',
                        data: {Order_Id: id},
                        //dataType: 'json'
                    })
                            .done(function (response) {
                                swal('Added!', 'Tracking Number added successfully', 'success');
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