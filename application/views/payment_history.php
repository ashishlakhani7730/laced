<?php
include("header_body.php");
?>
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> History
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