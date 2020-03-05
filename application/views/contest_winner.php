<?php
include("header_body.php");
?>
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Contest Winner List
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
										<th> UserProfilePic</th> 
										<th> Name</th>    
										<th> Email</th>  
										<th>  Share</th>
										<th>  Install</th>
										<th>  Point</th>	
                                    </tr>
                                    </thead>
                                    <tbody>                                   
									<?php
									if ($contest_list) {
										$cnt = 1;
										foreach ($contest_list as $item) {
											?>
											<tr>
												<td><?php echo $cnt++ ?></td>
												<td><img src="<?php echo base_url() ?>./Items/<?php echo $item->User_ProfilePic ?>" height="50" width="50"></td>
												<td><?php echo $item->User_Name ?></td>
												<td><?php echo $item->User_Email ?></td>
												<td><?php echo $item->Contest_Share ?></td>
												<td><?php echo $item->Contest_Install ?></td>
												<td><?php
													$Share = $item->Contest_Share * 5;
													$Install = $item->Contest_Install * 3;
													$Point = $Share + $Install;
													echo $Point;
													?></td>

											</tr>
											<?php
										}
									} else {
										echo "<tr><td colspan='12'>No any Product Found On Contest</td></tr>";
									}
									?>             
									</tbody>
									<tfoot>
                                    <tr>
                                        <th>serial no</th>
										<th> UserProfilePic</th> 
										<th> Name</th>    
										<th> Email</th>  
										<th>  Share</th>
										<th>  Install</th>
										<th>  Point</th>
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

    $("#marketsuccessMessage").hide();
    $("#marketfailMessage").hide();

    var Itemid = 0;
    function setmarketp(item_id)
    {
        Itemid = item_id;
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

    function setid(iid)
    {
        Contest_Id = iid;

    }

    $("#modsuccessMessage").hide();
    $("#modfailMessage").hide();

    $("#setauctiondate").click(function () {

        var startdate = $("#date1").val();
        var enddate = $("#date2").val();

        if (startdate == '')
        {
            alert('Please Enter Contest start Date');
        } else if (enddate == '')
        {
            alert('Please Enter Contest end Date');
        } else
        {
            // here we used reusability concept.
            $.ajax({
                url: '<?php echo site_url('contest/setdate') ?> ',
                type: 'post',
                dataType: 'json',
                data: {sdate: startdate, edate: enddate, Contest_Id: Contest_Id},
                success: function (json) {

                    if (json.code == 1)
                    {
                        cleardata();
                        $("#modsMessage").html('<strong>' + json.message + '</strong>');
                        $("#modsuccessMessage").show();
                        setTimeout(function () {
                            $("#modsuccessMessage").hide();
                            $('#responsive-modal').modal('hide');
                        }, 8000);
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
            url: '<?php echo site_url('contest/moredetails') ?> ',
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
                        htmls += "<tr><td><strong>Contest Starting date - </strong></td><td>Not Set</td></tr>";
                    } else
                    {
                        htmls += "<tr><td><strong>Contest Starting date - </strong></td><td>" + json.data[0].startdateampm + "</td></tr>";
                    }

                    if (json.data[0].endddateampm == null)
                    {
                        htmls += "<tr><td><strong>Contest Ending date - </strong></td><td>Not Set</td></tr>";
                    } else
                    {
                        htmls += "<tr><td><strong>Contest Ending date - </strong></td><td>" + json.data[0].endddateampm + "</td></tr>";
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
