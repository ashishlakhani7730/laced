<?php
include("header_body.php");
?>
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> User Notification
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
										<th>Pay Method</th>
										<th>Pay Amount</th>
										<th>Transfer No.</th>
										<th>Info Type</th>
										<th>Paymnet Date</th>
										<th>Paymnet</th>
										<th>Action</th>	
                                    </tr>
                                    </thead>
                                    <tbody>                                   
									<?php
                                                    if ($payment_list) {    
                                                        $cnt = 1;
                                                        foreach ($payment_list as $item) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $cnt++ ?></td>
                                                                <td><img src="<?php echo base_url() ?>./Items/<?php echo $item->Item_FrontPicture ?>" height="50" width="50"></td>
                                                                <td><?php echo $item->Item_Name; ?></td>
                                                                <td><?php echo $item->Pyment_Method; ?></td>
                                                                <td><?php echo $item->Item_NormalPrice; ?></td>
                                                                <td><?php echo $item->Payment_TransferNo; ?></td>
                                                                <td><?php echo $item->Info_Type; ?></td>
                                                                <td><?php
                                                $Date = date("h:i a m/d/y", strtotime("12 hours", strtotime($item->created)));
                                                echo $Date ?></td>
                                                                <td><div class="input-group-btn">
                                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Payment <span class="caret"></span></button>
                                                                        <ul class="dropdown-menu">                                 

                                                                            <li><button type="button" class="form-control"  onclick="test('<?= @$item->suserid ?>','<?= @$item->Payment_Id ?>')">Trasfer To Account</button></li>

                                                                            <li><button type="button" class="form-control"  onclick="test1('<?= @$item->suserid ?>','<?= @$item->Payment_Id ?>')">Trasfer To Wallet</button></li>

                                                                        </ul>
                                                                    </div>  
                                                                </td>
                                                                <td> 
                                                                    <button type="button" class="btn btn-info" > <a onclick="return confirm('Are you sure you want to delete ?');" href="<?php echo site_url("Payment/delete_data/$item->Payment_Id") ?>"> Delete</a></button>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='12'>No any Product Found On Working History</td></tr>";
                                                    }
                                                    ?>           
									</tbody>
									<tfoot>
                                    <tr>
                                        <th>serial no</th>
										<th> FrontPicture</th>
										<th> Name</th>
										<th>Pay Method</th>
										<th>Pay Amount</th>
										<th>Transfer No.</th>
										<th>Info Type</th>
										<th>Paymnet Date</th>
										<th>Paymnet</th>
										<th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
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
            url: '<?php echo site_url('payment/moredetails') ?> ',
            type: 'post',
            dataType: 'json',
            data: {item_id: itemid, buyerid: buserid, sellerid: suserid},
            success: function (json) {

                if (json.code == 1)
                {

                    htmls = "<div class='row'><div class='col-sm-12'>";
                    htmls += "<table width='100%'><tr><td style='vertical-align: middle'></tr>";
                    htmls += "<tr><td><strong>Reference Number - </strong></td><td>" + json.data.refeno.Payment_RefrenceNumber + "</td></tr>";
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


                    htmls += "<tr><td><strong>Item brand - </strong></td><td>" + json.data[0].Brand_Name + "</td></tr>";
                    htmls += "<tr><td><strong>Item normal price - </strong></td><td>" + json.data[0].Item_NormalPrice + "</td></tr>";
                    htmls += "<tr><td><strong>Item market price - </strong></td><td>" + json.data[0].Item_MarketPrice + "</td></tr>";



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
    function test(suserid,Payment_Id)
    {
        paymentId = Payment_Id;
        suserId = suserid;
		
                    $.ajax({
                        url: "<?php echo site_url("Payment/complete_Payment") ?>",
                        type: 'POST',
                        data: { suserid: suserId,Payment_Id: paymentId},
                        //dataType: 'json'
                    })
                            .done(function (response) {
                               // swal('Payment!', 'Payment successfully', 'success');
                                windows.location.reload(true);
                            })
                            .fail(function () {
                               // swal('Oops...', 'Something went wrong with ajax !', 'error');
                            });
    }

    function test1(suserid,Payment_Id)
    {
        paymentId = Payment_Id;
        suserId = suserid;
        

                    $.ajax({
                        url: "<?php echo site_url("Payment/add_walletBalance") ?>",
                        type: 'POST',
                        data: { suserid: suserId,Payment_Id: paymentId},
                        //dataType: 'json'
                    })
                            .done(function (response) {
                               // swal('Payment!', 'Payment successfully', 'success');
                                windows.location.reload(true);
                            })
                            .fail(function () {
                                //swal('Oops...', 'Something went wrong with ajax !', 'error');
                            });
    }
</script>

</body>
</html>