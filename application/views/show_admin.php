<?phpinclude("header_body.php");?><section class="admin-content">        <div class="bg-dark">            <div class="container  m-b-30">                <div class="row">                    <div class="col-12 text-white p-t-40 p-b-90">                        <h4 class=""> <span class="btn btn-white-translucent">                                <i class="mdi mdi-table "></i></span> Admin List                        </h4>                    </div>                </div>            </div>        </div>        <div class="container  pull-up">            <div class="row">                <div class="col-12">                    <div class="card">                        <div class="card-body">                            <div class="table-responsive p-t-10">                                <table id="example" class="table   " style="width:100%">                                    <thead>                                    <tr>                                        <th>serial no</th>										<th>Admin Name </th>										<th>Admin UserName </th>										<th>Admin Email</th>										<th>Admin Address</th>										<th>Admin Phone</th>										<th>created</th> 										<th>action</th>	                                    </tr>                                    </thead>                                    <tbody>                                   									<?php                                                    $cnt = 1;                                                    foreach ($admin_list as $admin) {                                                        ?>                                                        <tr>                                                            <td><?php echo $cnt++ ?></td>                                                                                                                        <td><?php echo $admin->Admin_Name ?></td>                                                            <td><?php echo $admin->Admin_UserName ?></td>                                                            <td><?php echo $admin->Admin_Email ?></td>                                                            <td><?php echo $admin->Admin_Address ?></td>                                                            <td><?php echo $admin->Admin_Phone ?></td>                                                            <td><?php                                                                $Date = date("h:i a m/d/y", strtotime("12 hours", strtotime($admin->created)));                                                                echo $Date                                                                ?>                                                            </td>                                                             <td><div class="input-group-btn">                                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>                                                                        <ul class="dropdown-menu">                                                                               <li><a  href="<?php echo site_url("Admin/update_data/$admin->Admin_Id") ?>"><span class="fa fa-edit"> &nbsp;    Update Permission</span></a></li>                                                                            <li> <a onclick="return confirm('Are you sure you want to delete this Admin?');" href="<?php echo site_url("Admin/delete_data/$admin->Admin_Id") ?>" ><span class="fa fa-trash-o"> &nbsp;    Delete</span></a></li>                                                                        </ul>                                                                    </div>                                                              </td>                                                                                                                    </tr>                                                        <?php                                                    }                                                    ?>            									</tbody>									<tfoot>                                    <tr>                                        <th>serial no</th>										<th>Admin Name </th>										<th>Admin UserName </th>										<th>Admin Email</th>										<th>Admin Address</th>										<th>Admin Phone</th>										<th>created</th> 										<th>action</th>                                    </tr>                                    </tfoot>                                </table>                            </div>                        </div>                    </div>                </div>            </div>        </div>              </section></main><?phpinclude("footer_include.php");?>
<script>
        function getviewverifyuserdetail(userid)
        {
            $.ajax({
                url: '<?php echo site_url('user/getverifyuserdetail') ?> ',
                type: 'post',
                dataType: 'json',
                data: {User_id: userid},
                success: function (json) {

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
                data: {USERID: user_id},
                success: function (json) {
                    if (json.code == 1)
                    {
                        $("#marketMessage").html('<strong>' + json.message + '</strong>');
                        $("#marketsuccessMessage").show();
                        setTimeout(function () {
                            $("#marketsuccessMessage").hide();
                            $('#responsive-modal-verify').modal('hide');
                            window.location.href = "<?php echo site_url('user') ?>";
                        }, 5000);

                    } else if (json.code == 0)
                    {
                        $("#marketfMessage").html('<strong>' + json.message + '</strong>');
                        $("#marketfailMessage").show();
                        setTimeout(function () {
                            $("#marketfailMessage").hide();
                        }, 8000);
                    }
                }
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

            swal({
                title: 'Are you sure?',
                text: "To verify This User",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, verify it!',
                showLoaderOnConfirm: true,

                preConfirm: function () {
                    return new Promise(function (userVerify) {

                        $.ajax({
                            url: "<?php echo site_url("User/verifyUser") ?>",
                            type: 'POST',
                            data: {User_Id: id},
                            //dataType: 'json'
                        })
                                .done(function (response) {
                                    if (response == '1') {
                                        swal('Verified!', 'Verify successfully', 'success');
                                        windows.location.reload(true);
                                    } else if (response == '2') {
                                        swal('Sorry!', 'Frist enter Your Card Detail.', 'error');
                                        windows.location.reload(true);
                                    }

                                })
                                .fail(function () {
                                    swal('Oops...', 'Something went wrong with ajax !', 'error');
                                });
                    });
                },
                allowOutsideClick: false
            });
        }

    </script>
</body>
</html>