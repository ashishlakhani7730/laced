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
										<th>User Pic</th>
										<th>User Name</th>
										<th>Notification Title</th>
										<th>Notification Message</th>  
										<th>Action</th>	
                                    </tr>
                                    </thead>
                                    <tbody>                                   
									<?php
												if($noti_list)
												{
													$cnt = 1;
													foreach ($noti_list as $not) {
														?>
														<tr>
															<td><?php echo $cnt++; ?></td>
															<td><img src="<?php echo base_url(); ?>./Items/<?php echo $not->User_ProfilePic; ?>" height="50" width="50"></td>
															<td><?php echo $not->User_Name; ?></td>	
															<td><?php echo $not->Notification_Title; ?></td>
															<td><?php echo $not->Notification_Message; ?></td>
															<td><a class="btn btn-primary" onclick="return confirm('Are you sure you want to delete this notification?');" href="<?php echo site_url("Usernotification/delete_data/$not->Notification_Id") ?>"> Delete</a></button>
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
										<th>User Pic</th>
										<th>User Name</th>
										<th>Notification Title</th>
										<th>Notification Message</th>  
										<th>Action</th>
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