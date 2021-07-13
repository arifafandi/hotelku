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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        foreach ($pending['pending'] as $data) :
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
                                                <td>
                                                    <a href="javascript:void(0);" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-view<?php echo $data->id; ?>"><i class="feather icon-eye"></i>&nbsp;View Proof </a>
                                                    <a href="javascript:void(0);" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-approve<?php echo $data->id; ?>"><i class="feather icon-check-circle"></i>&nbsp;Approve </a>
                                                </td>
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
        <?php
        foreach ($pending['pending'] as $data) :
        ?>
            <div class="modal fade" id="modal-approve<?php echo $data->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Approve Booking</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?= form_open_multipart('admin/approve_booking/' . $data->id); ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="Type">Give Room Number</label>
                                        <select name="number" id="type" class="form-control" required="">
                                            <?php foreach ($rooms_unbooked['rooms_unbooked'] as $unbook) :
                                                if ($data->id_type == $unbook->id_type) {
                                            ?>
                                                    <option value="<?= $unbook->id ?>"> Room <?= $unbook->number ?></option>
                                            <?php }
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php
        foreach ($pending['pending'] as $data) :
        ?>
            <div class="modal fade" id="modal-view<?php echo $data->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Payment Proof</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="<?php echo base_url('assets/upload/payment/') . $data->payment_proof; ?>" style="width:100%">
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <script src="../assets/js/vendor-all.min.js"></script>
    <script src="../assets/js/plugins/bootstrap.min.js"></script>
    <script src="../assets/js/ripple.js"></script>
    <script src="../assets/js/pcoded.min.js"></script>

</body>

</html>