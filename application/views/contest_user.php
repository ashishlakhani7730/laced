<?php
include("header_body.php");
?>
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> 
Contest Users

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
										<th> UserProfilePic</th> 
										<th> Name</th> 
										<th> Email</th> 
										<th>  Share</th>
										<th>  Invite</th>
										<th>  Point</th>
										<th>action</th>	
                                    </tr>
                                    </thead>
                                    <tbody>                                   
									<?php
									if ($contest_list) {
										$cnt = 1;
										foreach ($contest_list as $item) {
											?>
											<tr>
												<td><?php echo $cnt++ ?></td>
												<td><img src="<?php echo base_url() ?>./Items/<?php echo $item->User_ProfilePic ?>" height="50" width="50"></td>
												<td><?php echo $item->User_Name ?></td>
												<td><?php echo $item->User_Email ?></td>
												<td><?php echo $item->Contest_Share ?></td>
												<td><?php echo $item->Contest_Install ?></td>
												<td><?php
													$Share = $item->Contest_Share * 3;
													$Install = $item->Contest_Install * 5;
													$Point = $Share + $Install;
													echo $Point;
													?></td>

												
												<td>
													<button type="button" class="btn btn-primary"  onclick="test('<?= @$item->Contest_Id ?>,<?= @$item->User_Id ?>')">Winner</button>
												</td>
											</tr>
											<?php
										}
									} else {
										echo "<tr><td colspan='12'>No any Product Found On Contest</td></tr>";
									}
									?>            
									</tbody>
									<tfoot>
                                    <tr>
                                        <th>serial no</th>
										<th> UserProfilePic</th> 
										<th> Name</th> 
										<th> Email</th> 
										<th>  Share</th>
										<th>  Invite</th>
										<th>  Point</th>
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
<script>

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
    function test(Contest_Id,User_Id)
    {
        var ContestId = Contest_Id;
        var UserId = User_Id;
        swal({
            title: 'Are you sure?',
            text: "To Add User As Winner!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Add Winner!',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (ContestWinner) {

                    $.ajax({
                        url: "<?php echo site_url("Contest/contestWinner") ?>",
                        type: 'POST',
                        data: {Contest_Id: ContestId,User_Id: UserId},
                        //dataType: 'json'
                    })
                            .done(function (response) {
                                swal('Added!', 'Contest Winner added successfully', 'success');
                                windows.location.reload(true);
                            })
                            .fail(function () {
                                swal('Oops...', 'Something went wrong with ajax !', 'error');
                            });
                });
            },
            allowOutsideClick: false
        });
    }

    

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
