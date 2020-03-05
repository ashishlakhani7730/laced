<?php
include("header_body.php");
?>
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Rate Us
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
                                        <th>Serial No</th>
										<th>User ProfilePic</th>
										<th>User Name</th> 
										<th>Rating</th> 
										<th>Action </th>	
                                    </tr>
                                    </thead>
                                    <tbody>                                   
									<?php
									if ($rating) {
										$cnt = 1;
										foreach ($rating as $rate) {
											?>
											<tr>
												<td><?php echo $cnt++; ?></td>
												<td><img class="user-img img-circle"  src="<?php echo base_url() ?>./Items/<?php echo $rate->User_ProfilePic ?>" alt="user" style="width: 50px; height: 50px;" /></td>
												<td><?php echo $rate->User_Name; ?></td>
												<td><?php for ($i = 0; $i < $rate->ratingnumber; $i++) { ?><span class="fa fa-star"></span><?php } ?><?php echo "   " . $rate->ratingnumber . " - Star" ?></td>
												<td><a class="btn btn-primary" onclick="return confirm('Are you sure you want to delete this Rate?');" href="<?php echo site_url("Rateus/delete_data/$rate->Rate_Id") ?>"> Delete</a>

												</td>
											</tr>
											<?php
										}
									} else {
										echo "<tr><td colspan='4'>User Not Added Any Rate!!</td></tr>";
									}
									?>             
									</tbody>
									<tfoot>
                                    <tr>
                                        <th>Serial No</th>
										<th>User ProfilePic</th>
										<th>User Name</th> 
										<th>Rating</th> 
										<th>Action </th>
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