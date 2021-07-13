<!DOCTYPE html>
<html lang="en">

<head>

    <title>Login - HotelKu</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">




</head>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
    <div class="auth-content">
        <div class="card">
            <div class="row align-items-center text-center">
                <div class="col-md-12">
                    <div class="card-body">
                        <h4 class="mb-3 f-w-400">Signin</h4>
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
                        <form action="<?php echo base_url('home/login'); ?>" method="post">
                            <div class="form-group mb-3">
                                <label class="floating-label" for="Email">Email address</label>
                                <input name="email" type="text" class="form-control" id="Email" placeholder="">
                            </div>
                            <div class="form-group mb-4">
                                <label class="floating-label" for="Password">Password</label>
                                <input name="password" type="password" class="form-control" id="Password" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-block btn-primary mb-4">Signin</button>
                        </form>
                        <p class="mb-0 text-muted">Don’t have an account? <a href="<?php echo base_url('register'); ?>" class="f-w-400">Signup</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="<?php echo base_url('assets/js/vendor-all.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/ripple.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/pcoded.min.js'); ?>"></script>



</body>

</html>