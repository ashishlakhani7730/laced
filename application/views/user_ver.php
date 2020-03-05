<?php
include("header_body.php");
?>      
 <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> User Detail
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
                                <strong><?php echo $this->session->flashdata('fail_message'); ?></strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
							<?php } ?>
							<div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><?php echo $this->session->flashdata('message'); ?> </strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div id="failMessage" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><?php echo $this->session->flashdata('fail_message'); ?></strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
							
                            <div class="table-responsive p-t-10">
                                <table id="example" class="table   " style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Verify</th>
                                        <th>More info</th>                                  
                                    </tr>
                                    </thead>
                                    <tbody>
                                     <?php
                                            $cnt = 1;
                                            foreach ($user_list as $user) {
                                                ?>
                                                <tr>                                                  
													<?php if($user->User_ProfilePic == '' || $user->User_ProfilePic == 'null') { ?>
													<td><img src="<?php echo base_url().'Items/nouser.png'; ?>" height="50" width="50"></td>
													<?php } else { ?>
                                                    <td><img src="<?php echo base_url() ?>./Items/<?php echo $user->User_ProfilePic ?>" height="50" width="50"></td>
												    <?php } ?>
													<td><?php echo $user->User_Name ?></td>                                                                                                 
                                                    <td><?php echo $user->User_Phone ?></td>                                                                                           
                                                <?php if($user->User_verified == 1) { ?>
                                                    <td>
													<i class="mdi mdi-check h1 m-0" style="color: green"></i>
                                                    
                                                    </td>
                                                <?php } else { ?>
                                                <td>
                                                    <button type="button" class="btn btn-primary " onclick="verify(<?php echo $user->User_Id; ?>)">verify</button>
                                                </td>
                                            <?php } ?>                                                                          
                                                <td>
                                                    <a href="<?php echo base_url()."user/detail/".$user->User_Id;?>" class="btn btn-primary">Detailed Info</a>
                                                </td>
												<td><div class="input-group-btn">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <li><a onclick="return confirm('Are you sure you want to delete this user?');" href="<?php echo site_url("user/delete_data/$user->User_Id") ?>"><span class="fa fa-trash-o"> &nbsp;    Delete</span></a></li>
                                                            <?php
															 $flag = $user->User_Status;
                                                            if ($flag == '1') {
                                                                ?>
                                                            <li><a onclick="return confirm('Are you sure you want to deactive this user?');" href="<?php echo site_url("user/deactive_data/$user->User_Id") ?>"><span class="glyphicon glyphicon-remove" style="color: red"> </span>&nbsp; Deactive</a></li>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($flag == '0') {
                                                                ?>
                                                                <li><a onclick="return confirm('Are you sure you want to active this user?');" href="<?php echo site_url("user/active_data/$user->User_Id") ?>"><span class="glyphicon glyphicon-ok" style="color: green"> </span>&nbsp; Active</a></li>
                                                                <?php
                                                            }
                                                            ?>
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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Verify</th>
                                        <th>More info</th>        
                                    </tr>
                                    </tfoot>
									</tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div id="responsive-modal-verify" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h5 class="modal-title">Verify User</h5>
                                                    </div>
                                                    <div id="udetail" class="modal-body">
                                                        User Card Detail Not Available.
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

   

    function getviewverifyuserdetail(userid)
    {
        $.ajax({
                url: '<?php echo site_url('user/getverifyuserdetail') ?> ',
                type: 'post',
                dataType: 'json',
                data: {User_id:userid},
                success: function(json) {
                     
                    if (json.code == 1)
                {
                    htmls = "<div class='row'><div class='col-sm-12'>";
                    htmls += "<table width='100%'><tr><td ><strong>User Account Detail - </strong></td><td>" + json.data[0].Stripe_User_Id + "</td></tr>";
                    
                    
                    htmls += "<table>";
                    htmls += "</div></div>";
                    $("#udetail").html(htmls);
                } else if (json.code == 0)
                {
                    htmls = "<div class='row'><div class='col-sm-12'>";
                    htmls += "<table width='100%'><tr><td ><strong>User Account Detail - </strong></td><td>not verify</td></tr>";
                    
                    
                    htmls += "<table>";
                    htmls += "</div></div>";
                    $("#udetail").html(htmls);
                }
                }
            });
    }


    function verifieded(user_id)
    {
        //console.log(user_id);

         $.ajax({
                url: '<?php echo site_url('user/verifyuser') ?> ',
                type: 'post',
                dataType: 'json',
                data: {USERID:user_id},
                success: function(json) {
                    if(json.code == 1)
                    {
                        $("#marketMessage").html('<strong>'+json.message+'</strong>');
                        $("#marketsuccessMessage").show();
                        setTimeout(function(){
                            $("#marketsuccessMessage").hide(); 
                            $('#responsive-modal-verify').modal('hide');
                             window.location.href="<?php echo site_url('user') ?>";
                        }, 5000);

                    }
                    else if(json.code == 0)
                    {
                        $("#marketfMessage").html('<strong>'+json.message+'</strong>');
                        $("#marketfailMessage").show();
                        setTimeout(function(){
                            $("#marketfailMessage").hide();
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
    function verify(User_Id)
    {
        var id = User_Id;
		
			$.ajax({
				url: "<?php echo site_url("User/verifyUser") ?>",
				type: 'POST',
				data: {User_Id: id},
				//dataType: 'json'
			})
			.done(function (response) {
				if(response == '1'){
					location.reload();
				} else if(response == '2'){  
					$("#responsive-modal-verify").modal('show');
				}
			})
			.fail(function () {
				
			});               
    }

	</script>
</body>
</html>