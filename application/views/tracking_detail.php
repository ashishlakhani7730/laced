<?php
include("header_body.php");
?>
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Tracking Detail
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
							<?php if(validation_errors()) { ?>
							<div id="validationerror" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><?php echo validation_errors(); ?></strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
							<?php } ?>
							<div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><?php echo $this->session->flashdata('message_flaker'); ?> </strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div id="failMessage" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><?php echo $this->session->flashdata('fail_message_flaker'); ?></strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
							<form name="frm" method="post" action="<?php echo site_url("Shipping/getTrackingInfo") ?>">
                                            <div class="form-group">
                                                <label class="control-label mb-10" for="exampleInputuname_1">Tracking No</label>
                                                <input type="text" name="Tracking_No1" class="form-control" id="Tracking_No1" >
                                            </div>
                                        </form>
                                        <div class="form-actions mb-10">			
                                            <button type="button" class="btn btn-info btn-anim" onclick="trackdetail()" >Submit</button>
                                        </div>	
                                        <div class="clearfix col-md-8">
                                        </div>

                                        <div id="moreresponsive-modal1" >

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
        function trackdetail()
        {
            TrackingNo1 = $("#Tracking_No1").val();
            if (TrackingNo1 == '')
            {
                return false;
            }
            $.ajax({
                url: '<?php echo site_url('Shipping/getTrackingInfo') ?> ',
                type: 'post',
                dataType: 'json',
                data: {Tracking_No1: $("#Tracking_No1").val()},
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
                        $("#moreresponsive-modal1").html(htmls);
                    }
                    else if (json.code == 0)
                        {
                            htmls = "<div class='row'><div class='col-sm-12'>";
                        htmls += "<table width='100%'><tr><td ><strong>Tracking Detail - </strong></td><td>not found</td></tr>";


                        htmls += "<table>";
                        htmls += "</div></div>";
                        $("#moreresponsive-modal1").html(htmls);
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
            //        alert(OrderId);
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