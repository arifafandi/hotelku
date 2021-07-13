<!DOCTYPE html>
<html lang="en">

<head>

    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <?php $this->load->view("layouts/_navbar.php") ?>
    <?php $this->load->view("layouts/_header.php") ?>
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10"><?php echo $title; ?></h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin"><i class="feather icon-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="#!"><?php echo $title; ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- subscribe start -->
                <div class="col-md-12">
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
                    <div class="card">
                        <div class="card-header">
                            <h5><?php echo $title; ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="report-table" class="table table-bordered table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Name</th>
                                            <th>No Identity</th>
                                            <th>Type Room</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        foreach ($unpaid['unpaid'] as $data) :
                                            $no++;
                                        ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $data->name; ?></td>
                                                <td><?php echo $data->identity_number; ?></td>
                                                <td><?php echo $data->type_name; ?></td>
                                                <td><?php echo $data->check_in; ?></td>
                                                <td><?php echo $data->check_out; ?></td>
                                                <td><?php echo rupiah($data->price); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- subscribe end -->
            </div>
        </div>
    </div>

    <script src="../assets/js/vendor-all.min.js"></script>
    <script src="../assets/js/plugins/bootstrap.min.js"></script>
    <script src="../assets/js/ripple.js"></script>
    <script src="../assets/js/pcoded.min.js"></script>

</body>

</html>