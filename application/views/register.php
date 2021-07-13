<!DOCTYPE html>
<html lang="en">

<head>

    <title>Register - HotelKu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">




</head>

<!-- [ auth-signup ] start -->
<div class="auth-wrapper">
    <div class="auth-content">
        <div class="card">
            <div class="row align-items-center text-center">
                <div class="col-md-12">
                    <div class="card-body">
                        <h4 class="mb-3 f-w-400">Sign up</h4>
                        <?php
                        $success = $this->session->flashdata('success');
                        if (isset($success)) {
                            echo '<div class="alert alert-info">' . $success . '</div>';
                            $this->session->unset_userdata('success');
                        }
                        ?>
                        <?php
                        $error = $this->session->flashdata('error');
                        if (isset($error)) {
                            echo '<div class="alert alert-danger">' . $error . '</div>';
                            $this->session->unset_userdata('error');
                        }
                        ?>
                        <form action="<?php echo base_url('home/register_proses'); ?>" method="post">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" name="name" class="form-control form-control-user" id="Name" placeholder="Name">
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" name="email" class="form-control form-control-user" id="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="number" name="identity" class="form-control form-control-user" id="identity" placeholder="Identity Number">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" name="city" class="form-control form-control-user" id="exampleInputCity" placeholder="City">
                                </div>
                                <div class="col-sm-6">
                                    <input type="number" name="phone" class="form-control form-control-user" id="examplePostalCode" placeholder="Phone Number">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mb-4">Sign up</button>
                        </form>
                        <p class="mb-2">Already have an account? <a href="<?php echo base_url('login'); ?>" class="f-w-400">Signin</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ auth-signup ] end -->

<!-- Required Js -->
<script src="<?php echo base_url('assets/js/vendor-all.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/ripple.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/pcoded.min.js'); ?>"></script>



</body>

</html>