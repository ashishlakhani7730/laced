<?php
include("header_body.php");
?>
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Setting
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
										<th>Trade Charge</th>
                                        <th>Shipping Charge</th> 
                                        <th>Processing Free Fixed</th> 
                                        <th>Processing Free Percentage</th>		
                                    </tr>
                                    </thead>
                                    <tbody>                                   
									<?php
                                        if (!empty($settings)) {
                                            $cnt = 1;
                                            foreach ($settings as $setting) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $cnt++ ?></td>
                                                    <td><?php echo @$setting->Trade_Charge; ?></td>
                                                    <td><?php echo @$setting->Shipping_Charge; ?></td>
                                                    <td><?php echo @$setting->Processing_Free_Fixed; ?></td>
                                                    <td><?php echo @$setting->Processing_Free_Percentage; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='4'>Admin Not Added Any Charges!!</td></tr>";
                                        }
                                    ?>             
									</tbody>
									<tfoot>
                                    <tr>
                                        <th>serial no</th>
										<th>Trade Charge</th>
                                        <th>Shipping Charge</th> 
                                        <th>Processing Free Fixed</th> 
                                        <th>Processing Free Percentage</th>
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