<?php
include("header_body.php");
?>
<section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">
                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Update Permission
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
                                <?php if (validation_errors()) { ?>
                                    <div id="validationerror" class="alert alert-info alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo validation_errors(); ?>
                                    </div>						
                                <?php } ?>                         
                                <?php
                                if (isset($update_datas)) {
                                    $Admin_Role = $update_datas['Admin_Role'] ? explode(',', $update_datas['Admin_Role']) : '';
                                    ?>
                                <form name="frm" method="post" action="<?php echo site_url("Admin/update_permision") ?>">
                                    <input type="hidden" name="Admin_Id" class="form-control" id="exampleInputuname_1"  required="" value="<?php echo $update_datas['Admin_Id']; ?>">
                                    <div class="txt-dark">

                                    </div>
                                    <div class="form-body overflow-hide">
                                        
                                        <div class="form-group mb-30">
                                            <label class="control-label mb-10 text-left">Permission</label>
											 <div class="checkbox checkbox-info">
                                                <input value="1" name="Admin_Role[]" type="checkbox" <?= in_array(1, $Admin_Role) ? ' checked' : '' ?>>
                                                <label for="checkbox1">
                                                    Dashboard
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-info">
                                                <input value="2" name="Admin_Role[]" type="checkbox" <?= in_array(2, $Admin_Role) ? ' checked' : '' ?>>
                                                <label for="checkbox1">
                                                    User
                                                </label>
                                            </div>
											<div class="checkbox checkbox-info">
                                                <input value="3" name="Admin_Role[]" type="checkbox" <?= in_array(3, $Admin_Role) ? ' checked' : '' ?>>
                                                <label for="checkbox1">
                                                    Listing To Approve
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-info">
                                                <input value="4" name="Admin_Role[]" type="checkbox" <?= in_array(4, $Admin_Role) ? ' checked' : '' ?>>
                                                <label for="checkbox2">
                                                    Product
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-info">
                                                <input value="5" name="Admin_Role[]" type="checkbox" <?= in_array(5	, $Admin_Role) ? ' checked' : '' ?>>
                                                <label for="checkbox3">
                                                    Raffle
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-info">
                                                <input value="6" name="Admin_Role[]" type="checkbox" <?= in_array(6, $Admin_Role) ? ' checked' : '' ?>>
                                                <label for="checkbox3">
                                                    Contest
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-info">
                                                <input value="7" name="Admin_Role[]" type="checkbox" <?= in_array(7, $Admin_Role) ? ' checked' : '' ?>>
                                                <label for="checkbox3">
                                                    Reward
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-info">
                                                <input value="8" name="Admin_Role[]" type="checkbox" <?= in_array(8, $Admin_Role) ? ' checked' : '' ?>>
                                                <label for="checkbox3">
                                                    Auction
                                                </label>
                                            </div>
											<div class="checkbox checkbox-info">
                                                <input value="9" name="Admin_Role[]" type="checkbox" <?= in_array(9, $Admin_Role) ? ' checked' : '' ?>>
                                                <label for="checkbox3">
                                                    Trade
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-info">
                                                <input value="10" name="Admin_Role[]" type="checkbox" <?= in_array(10, $Admin_Role) ? ' checked' : '' ?>>
                                                <label for="checkbox1">
                                                    Order List
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-info">
                                                <input value="11" name="Admin_Role[]" type="checkbox" <?= in_array(11, $Admin_Role) ? ' checked' : '' ?>>
                                                <label for="checkbox2">
                                                    Shipping
                                                </label>
                                            </div>
											<div class="checkbox checkbox-info">
                                                <input value="12" name="Admin_Role[]" type="checkbox" <?= in_array(12, $Admin_Role) ? ' checked' : '' ?>>
                                                <label for="checkbox2">
                                                    Administrative Setting
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-info">
                                                <input value="13" name="Admin_Role[]" type="checkbox" <?= in_array(13, $Admin_Role) ? ' checked' : '' ?>>
                                                <label for="checkbox3">
                                                    Work History
                                                </label>
                                            </div>
											<div class="checkbox checkbox-info">
                                                <input value="14" name="Admin_Role[]" type="checkbox" <?= in_array(14, $Admin_Role) ? ' checked' : '' ?>>
                                                <label for="checkbox3">
                                                    User Notification
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-info">
                                                <input value="15" name="Admin_Role[]" type="checkbox" <?= in_array(15, $Admin_Role) ? ' checked' : '' ?>>
                                                <label for="checkbox2">
                                                    App Rate
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-info">
                                                <input value="16" name="Admin_Role[]" type="checkbox" <?= in_array(16, $Admin_Role) ? ' checked' : '' ?>>
                                                <label for="checkbox3">
                                                    Setting
                                                </label>
                                            </div>
                                            <!--<div class="checkbox checkbox-info">-->
                                            <!--    <input value="16" name="Admin_Role[]" type="checkbox" <?= in_array(16, $Admin_Role) ? ' checked' : '' ?>>-->
                                            <!--    <label for="checkbox3">-->
                                            <!--        Child Admin-->
                                            <!--    </label>-->
                                            <!--</div>-->
                                            <div class="checkbox checkbox-info">
                                                <input value="17" name="Admin_Role[]" type="checkbox" <?= in_array(17, $Admin_Role) ? ' checked' : '' ?>>
                                                <label for="checkbox3">
                                                    User Query
                                                </label>
                                            </div>
                                            
                                        </div>
                                        <div class="form-actions mb-10">			
                                            <button type="submit" class="btn btn-primary btn-anim">Submit</button>
                                        </div>	
                                    </div>
                                </form>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
			</section>
</main>
        <!-- End Main Content -->
        <?php
        include("footer_include.php");
        ?>
        <script>
            $(document).on('click', '.random', function (e) {

                var str = Math.random().toString(36).slice(5);
                var res = str.toUpperCase();
                $("#code").val(res);

            });

            $(document).on('change', '#conditionSelect', function (e) {

                var conditionSelect = $("#conditionSelect").val();
                if (conditionSelect == 'NoOfUser') {
                    $("#noofuse").show();
                } else
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

<?php if (empty($this->session->flashdata('success'))) { ?>
                $('#successMessage').hide();
<?php } else { ?>
                setTimeout(function () {
                    $('#successMessage').fadeOut('slow');
                }, 5000);
<?php } ?>

<?php if (empty($this->session->flashdata('fail'))) { ?>
                $('#failMessage').hide();
<?php } else { ?>
                setTimeout(function () {
                    $('#failMessage').fadeOut('slow');
                }, 5000);
<?php } ?>


        </script>
    </body>
</html>