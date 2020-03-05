<?php
include("header_body.php");
?>
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Query
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
                                        <th> Frist Name</th> 
										<th> Last Name</th>                               
										<th> Email</th>
										<th> Message</th>
										<th>Created</th>
										<th>Reply</th>
                                    </tr>
                                    </thead>
                                    <tbody>                                   
									<?php
										if ($contact_list) {
											$cnt = 1;
											foreach ($contact_list as $item) {
												?>
												<tr>
													<td><?php echo $cnt++ ?></td>
													<td><?php echo $item->Frist_Name ?></td>
													<td><?php echo $item->Last_Name ?></td>
													<td><?php echo $item->Email ?></td>
													<td><?php echo $item->Message ?></td>
													<td><?php echo $item->created ?></td>
													<td><button type="button" class="btn btn-primary" onclick="setreply('<?= @$item->Email ?>')" data-toggle="modal" data-target="#responsive-modal-market" data-whatever="@mdo">Reply</button></td>
												</tr>
												<?php
											}
										} else {
											echo "<tr><td colspan='12'>No any Product Found</td></tr>";
										}
									?>                 
									</tbody>
									<tfoot>
                                    <tr>
                                        <th>Serial no</th>
                                        <th> Frist Name</th> 
										<th> Last Name</th>                               
										<th> Email</th>
										<th> Message</th>
										<th>Created</th>
										<th>Reply</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="modal fade" id="responsive-modal-market" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog  modal-dialog-align-top-left" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Reply</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
												<div id="marketsuccessMessage" class="alert alert-success alert-dismissible fade show" role="alert">
													<div id="marketMessage"></div>
												</div>
												<div id="marketfailMessage" class="alert alert-danger alert-dismissible fade show" role="alert">	
													<div id="marketfMessage"></div>
												</div>
		
                                                 <form>
                                                            <div class="form-group">
                                                                <label class="control-label mb-10 text-left">Subject</label>
                                                                    <input id="Subject" type='text' name="Subject" class="form-control" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label mb-10 text-left">Message</label>
                                                                    <input id="Message" type='text' name="Message" class="form-control" />
                                                            </div>
                                                        </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" onclick="addreply()" class="btn btn-primary">Save changes</button>
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

   var OrderId = 0;
    function setreply(Email)
    {
        email = Email;
		//alert(email);
    }

    function addreply()
    {
        var subject = $("#Subject").val();
        var message = $("#Message").val();
        if (subject == '')
        {
            alert("Plase Enter Subject");
        } 
        if (message == '')
        {
            alert("Plase Enter Message");
        } 
            $.ajax({
                url: '<?php echo site_url('Contact/addreply') ?> ',
                type: 'post',
                dataType: 'json',
                data: {Email: email, Subject: $("#Subject").val(), Message: $("#Message").val()},
                success: function (json) {

                    if (json.code == 1)
                    {
						//cleardata();
                        $("#marketMessage").html('<strong>' + json.message + '</strong>');
                        $("#marketsuccessMessage").show();
                        setTimeout(function () {
                            $("#marketsuccessMessage").hide();
                            $('#responsive-modal-market').modal('hide');
                            window.location.href = "<?php echo site_url('Contact/index') ?>";
                        }, 5000);

                    } else if (json.code == 0)
                    {
						//cleardata();
                        $("#marketfMessage").html('<strong>' + json.message + '</strong>');
                        $("#marketfailMessage").show();
                        setTimeout(function () {
                            $("#marketfailMessage").hide();
                        }, 8000);
                    }
                }
            });
        }
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure you want to delete this item?'))
            e.preventDefault();
    };

</script>
</body>
</html>