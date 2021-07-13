<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title; ?> - HotelKu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <!-- prism css -->
    <link rel="stylesheet" href="assets/css/plugins/prism-coy.css">

    <link rel="stylesheet" href="assets/css/plugins/daterangepicker.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">




</head>

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ navigation menu ] start -->
    <?php $this->load->view("layouts/_navbar_home.php"); ?>
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
    <?php $this->load->view("layouts/_header_home.php"); ?>
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-wrapper">
                <div class="page-header">
                    <!-- <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h5 class="m-b-10">Horizontal Layout</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#!">Page Layout</a></li>
                                    <li class="breadcrumb-item"><a href="#!">Horizontal Layout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- [ Main Content ] start -->
                <!-- <div class="pcoded-main-container"> -->
                <!-- <div class="pcoded-content"> -->
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
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
                                <div class="page-header-title">
                                    <h5 class="m-b-10">History</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#!">History</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->
                <!-- [ Main Content ] start -->
                <div class="row">
                    <!-- customar project  start -->
                    <div class="col-12">
                        <?php foreach ($history['history'] as $data) : ?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center justify-contact-between">
                                        <div class="col">
                                            <?php if ($data->status == 'UNPAID') { ?>
                                                <div class="btn btn-warning">
                                                    <?php echo $data->status; ?>
                                                </div>
                                            <?php } elseif ($data->status == 'PENDING') { ?>
                                                <div class="btn btn-primary">
                                                    <?php echo $data->status; ?>
                                                </div>
                                            <?php } else { ?>
                                                <div class="btn btn-success">
                                                    <?php echo $data->status; ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php if ($data->status == 'UNPAID') { ?>
                                            <div class="col text-right">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-payment<?php echo $data->id; ?>">
                                                    <button class="btn btn-outline-primary">
                                                        <i class="feather icon-credit-card"></i> Payment
                                                    </button>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table m-0 mt-3">
                                            <tr>
                                                <td class="align-middle">
                                                    <img src="assets/upload/icon/<?php echo $data->image; ?>" alt="contact-img" title="<?php echo $data->type_name; ?>" class="rounded mr-3" height="80" />
                                                    <div class="m-0 d-inline-block align-middle font-16">
                                                        <h6 class="d-inline-block"><?php echo $data->type_name; ?></h6>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5><?php echo rupiah($data->type_price); ?></h5>
                                                </td>
                                                <td class="text-right">
                                                    <div class="text-left d-inline-block">
                                                        <h6 class="my-0">Check In : <?php echo $data->check_in; ?></h6>
                                                        <h6 class="my-0">Check Out : <?php echo $data->check_out; ?></h6>
                                                        <?php if ($data->status == 'SUCCESS') {
                                                            foreach ($rooms['rooms'] as $r) :
                                                                if ($data->id_room == $r->id) {
                                                        ?>
                                                                    <h6 class="my-0">Room Number : <?php echo $r->number; ?></h6>
                                                        <?php
                                                                }
                                                            endforeach;
                                                        } ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <hr class="mt-0">
                                    <div class="row align-items-center justify-contact-between">
                                        <div class="col">
                                            <span class="text-muted">Booking On</span>
                                            <strong><?php echo $data->created_at; ?></strong>
                                        </div>
                                        <div class="col text-right">

                                            <span class="text-muted">Total Amount</span>
                                            <strong><?php echo rupiah($data->price); ?></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- customar project  end -->
                </div>
                <!-- [ Main Content ] end -->
                <?php
                foreach ($history['history'] as $data) :
                ?>
                    <div class="modal fade" id="modal-payment<?php echo $data->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Upload Payment Slip</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?= form_open_multipart('home/payment/' . $data->id); ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <p><strong>BCA :</strong> 91200183989 A/N NAIM SAD</p>
                                                <p><strong>BRI :</strong> 12445746876 A/N NAIM SAD</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="custom-file">
                                                    <input type="file" name="image" class="custom-file-input" id="validatedCustomFile">
                                                    <label class="custom-file-label" for="validatedCustomFile">Choose Image...</label>
                                                </div>
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
                <!-- </div> -->
                <!-- </div> -->
                <!-- [ Main Content ] end -->
                <!-- [ Main Content ] start -->
                <!-- [ Main Content ] end -->
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/ripple.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <!-- <script src="assets/js/menu-setting.min.js"></script> -->


    <!-- prism Js -->
    <script src="assets/js/plugins/prism.js"></script>


    <script src="assets/js/horizontal-menu.js"></script>
    <script>
        $(document).ready(function() {
            $("#pcoded").pcodedmenu({
                themelayout: 'horizontal',
                MenuTrigger: 'hover',
                SubMenuTrigger: 'hover',
            });
        });
    </script>

    <script src="assets/js/analytics.js"></script>

</body>

</html>