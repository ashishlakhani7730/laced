<?php
include("header_body.php");
?>
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Contest Date
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
							<div id="modsuccessMessage" class="alert alert-success alert-dismissable">
                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div id="modsMessage"></div>
                            </div>
							<div id="modfailMessage" class="alert alert-info alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div id="modfMessage"></div>
							</div>
							 <form>
                                                            <div class="form-group">
                                                                <label class="control-label mb-10 text-left">Contest Strat Date</label>
                                                                <div class='input-group date' id='datetimepicker1'>
                                                                    <input id="date1" type='text' name="date1" class="js-datepicker form-control" required/>														
                                                                    <span class="input-group-addon">
                                                                        <span class="fa fa-calendar open-datetimepicker"></span>
																		

                                                                    </span>
                                                                </div>
                                                            </div>
															<div class="form-group">
                                                                <label class="control-label mb-10 text-left">Contest Strat Time</label>
                                                                <div class='input-group date' id='time'>                                                      
																	<input id="starttime" class="form-control timepicker" type="text" required>
                                                    
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label mb-10 text-left">Contest End Date</label>
                                                                <div class='input-group date' id='datetimepicker2'>
                                                                    <input id="date2" type='text' name="date2" class="js-datepicker form-control" required/>
																	

                                                                    <span class="input-group-addon">
                                                                        <span class="fa fa-calendar"></span>
                                                                    </span>
                                                                </div>
                                                            </div>
															<div class="form-group">
                                                                <label class="control-label mb-10 text-left">Contest End Time</label>
                                                                <div class='input-group date' id='etime'>                                                      
																	<input id="endtime" class="form-control timepicker" type="text" required>
                                                    
                                                                </div>
                                                            </div>
															 <button id="setauctiondate" type="button" class="btn btn-primary">Save changes</button>
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
	$("#modsuccessMessage").hide();
	$("#modfailMessage").hide();
	
	$('#starttime').timepicker();
	$('#endtime').timepicker();
	var Contest_Id = "<?php echo $this->uri->segment(3); ?>";

	$("#setauctiondate").click(function () {

        var startdate = $('#date1').val() +" "+ $('#starttime').val();
        var enddate = $('#date2').val() +" "+ $('#endtime').val();

        if ($('#date1').val() == '')
        {
            alert('Please Enter auction start Date');
        } else if ($('#date2').val() == '')
        {
            alert('Please Enter auction end Date');
        } else
        {
            // here we used reusability concept.
            $.ajax({
                url: '<?php echo site_url('Contest/setdate') ?> ',
                type: 'post',
                dataType: 'json',
                data: {sdate: startdate, edate: enddate, Contest_Id: Contest_Id},
                success: function (json) {

                    if (json.code == 1)
                    {
                        
                        $("#modsMessage").html('<strong>' + json.message + '</strong>');
                        $("#modsuccessMessage").show();
                        setTimeout(function () {
                            $("#modsuccessMessage").hide();
                            window.location.href = "<?php echo site_url("contest"); ?>";
                        }, 5000);
                    } else if (json.code == 0)
                    {
                        
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

</script>