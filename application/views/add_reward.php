<?php
include("header_body.php");
?>
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Add Reward
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
							<form name="frm" method="post" action="<?php echo site_url("Reward/add_reward") ?>">
                                    <div class="txt-dark">

                                    </div>
                                    <div class="form-body overflow-hide">
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="exampleInputuname_1">Reward Name</label>
                                            <div class="input-group">                                             
                                                <input type="text" name="Reward_Name" class="form-control" id="exampleInputuname_1"  required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="exampleInputuname_1">Reward Code</label>
                                                <input type="text" name="Reward_Code" class="form-control" id="code"  required="">
                                                <p align="right"> <a class="random"  href="#code" style="color:#506cf0; "> rendom generate code</a></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="exampleInputEmail_1">Price</label>
                                            <div class="input-group">                                        
                                                <input type="text" name="Price" class="form-control" id="exampleInputEmail_1"  required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="exampleInputContact_1">Price Type</label>
                                            
                                                <select name="Price_Type" required="" class="form-control"> 
                                                    <option>Select Price Type</option>
                                                    <option>Fixed</option>
                                                    <option>Percentage</option>
                                                </select>
                                                  
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="exampleInputEmail_1">Minimum Price</label>
                                            <div class="input-group">                                            
                                                <input type="text" name="Minimum_Price" class="form-control" id="exampleInputEmail_1"  required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10 text-left">Start Date</label>
                                            <div class='input-group date' id='datetimepicker1'>
                                                <input id="date1" type='text' name="Start_Date" class="js-datepicker form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10 text-left">End Date</label>
                                            <div class='input-group date' id='datetimepicker2'>
                                                <input id="date2" type='text' name="End_Date" class="js-datepicker form-control" />                                     
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="exampleInputContact_1">Condition</label>
                                            
                                                <select name="Condition" required="" class="form-control" id="conditionSelect"> 
                                                    <option valu="">-Select-</option>
                                                    <option value="NoOfUser">No Of User</option>
                                                    <option value="NewUser">New User</option>
                                                    <option value="UnlimitedUser">Unlimited User</option>
                                                    <option value="FristPurchase">Frist Purchase</option>
                                                </select>
                                                  
                                        </div>
                                        <div class="form-group" id="noofuse" style="display: none;">
                                            <label class="control-label mb-10" for="exampleInputuname_1">No Of Use</label>
                                            
                                                <input type="text" name="No_Of_Use" class="form-control" id="exampleInputuname_1" value="0" >                                        
                                        </div>                                    
                                        <div class="form-actions mb-10">			
                                            <button type="submit" class="btn btn-primary btn-anim">Submit</button>
                                        </div>	
                                    </div>
                               </form>
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
		$(document).on('click', '.random', function(e) {
			
			var str = Math.random().toString(36).slice(5);
			var res = str.toUpperCase();
		   $("#code").val(res);
		  
		});
		
		$(document).on('change', '#conditionSelect', function(e) {

		  var conditionSelect= $("#conditionSelect").val();
		  if(conditionSelect== 'NoOfUser'){
			  $("#noofuse").show();
		  }
		  else
		  {
			  $("#noofuse").hide();
		  }
		  
		});
            
$('#datetimepicker1').datetimepicker();
$('#datetimepicker2').datetimepicker();
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