<?php
include("header_body.php");
?>
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Approve Item
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
										<th> More Info</th>
                                    </tr>
                                    </thead>
                                    <tbody>                                   
									<?php
									if ($approve_item_list) {
										$cnt = 1;
										foreach ($approve_item_list as $item) {
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
												<td><a href="<?php echo site_url("list_approve/more")."/".$item->Item_Id; ?>" class="btn btn-primary">More</a></td>
											</tr>
											<?php
										}
									} else {
										echo "<tr><td colspan='12'>No any Product Found On Approve List</td></tr>";
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
										<th> More Info</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
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
                        cleardata();
                        $("#modsMessage").html('<strong>' + json.message + '</strong>');
                        $("#modsuccessMessage").show();
                        setTimeout(function () {
                            $("#modsuccessMessage").hide();
                            $('#responsive-modal').modal('hide');
                            window.location.href = "<?php echo site_url('item/instabuyitem') ?>";
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
</html>