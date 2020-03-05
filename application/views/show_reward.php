<?php
include("header_body.php");
?>
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Reward
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
						 <p align="right"><a class="btn btn-primary" href="<?php echo site_url("Reward/add") ?>"> Add Reward</a></p>
                            <div class="table-responsive p-t-10">
                                <table id="example" class="table   " style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>serial no</th>
										<th> Reward Name</th> 
										<th> Reward Code</th>                               
										<th> Price</th>
										<th> Price Type</th>
										<th> Minimum Price </th>
										<th>NoOfUse</th>
										<th>Condition</th>
										<th>action</th>	
                                    </tr>
                                    </thead>
                                    <tbody>                                   
									<?php
									if ($reward_list) {
										$cnt = 1;
										foreach ($reward_list as $item) {
											?>
											<tr>
												<td><?php echo $cnt++ ?></td>
												<td><?php echo $item->Reward_Name ?></td>
												<td><?php echo $item->Reward_Code ?></td>
												<td><?php echo $item->Price ?></td>
												<td><?php echo $item->Price_Type ?></td>
												<td><?php echo $item->Minimum_Price ?></td>
												<td><?php echo $item->No_Of_Use ?></td>
												<td><?php echo $item->Condition ?></td>
										

											<td><div class="input-group-btn">
											<a class="btn btn-primary" onclick="return confirm('Are you sure you want to delete this reward?');" href="<?php echo site_url("reward/delete_data/$item->Reward_Id/") ?>">Delete</a>
												</div>  
											</td>
											</tr>
											<?php
										}
									} else {
										echo "<tr><td colspan='12'>No any Product Found On Raffle</td></tr>";
									}
									?>             
									</tbody>
									<tfoot>
                                    <tr>
                                        <th>serial no</th>
										<th> Reward Name</th> 
										<th> Reward Code</th>                               
										<th> Price</th>
										<th> Price Type</th>
										<th> Minimum Price </th>
										<th>NoOfUse</th>
										<th>Condition</th>
										<th>action</th>
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
</script>
</body>
</html>
