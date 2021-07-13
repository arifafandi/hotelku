<!DOCTYPE html>
<html lang="en">
<?php
$details = $detail->row_array();
?>

<head>
    <title><?php echo $title; ?> - HotelKu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">

    <!-- prism css -->
    <link rel="stylesheet" href="../assets/css/plugins/prism-coy.css">

    <link rel="stylesheet" href="../assets/css/plugins/daterangepicker.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="../assets/css/style.css">




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
                                    <h5 class="m-b-10">Room Detail</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#!">Room</a></li>
                                    <li class="breadcrumb-item"><a href="#!"><?php echo $details['name']; ?></a></li>
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
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="../assets/upload/icon/<?php echo $details['image']; ?>" class="d-block w-100" alt="Product images">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <form class="pl-lg-4" action="<?php echo base_url('home/booking'); ?>" method="post">
                                            <h3 class="mt-0">Room <?php echo $details['name']; ?><a href="javascript: void(0);" class="text-muted"><i class="mdi mdi-square-edit-outline ml-2"></i></a> </h3>
                                            <div class="mt-4">
                                                <h4><?php echo rupiah($details['price']); ?> <small>/ Night</small></h4>
                                                <?php foreach ($rooms_available['rooms_available'] as $avail) :
                                                    if ($avail->type == $details['name']) { ?>
                                                        <h5><span class="badge badge-success"><?php echo $avail->jumlah; ?> Rooms Available</span></h5>
                                                <?php };
                                                endforeach; ?>

                                            </div>
                                            <div class="mt-4">
                                                <h6>Description:</h6>
                                                <p><?php echo $details['description']; ?></p>
                                            </div>
                                            <div class="row">
                                                <input type="hidden" name="price" class="form-control" value="<?php echo $details['price']; ?>" />
                                                <input type="hidden" name="idtype" class="form-control" value="<?php echo $details['id']; ?>" />
                                                <div class="col-sm-6 mt-md-0 mt-2">
                                                    <h6>Check In</h6>
                                                    <div class="form-group">
                                                        <input type="date" name="checkin" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 text-sm-right mt-md-0 mt-2">
                                                    <h6>Check Out</h6>
                                                    <div class="form-group">
                                                        <input type="date" name="checkout" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mt-md-0 mt-2">
                                                </div>
                                                <div class="col-sm-6">
                                                    <button type="submit" class="btn btn-block btn-lg btn-success mt-md-0 mt-2"><i class="feather icon-credit-card"></i> Booking now</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- customar project  end -->
                </div>
                <!-- [ Main Content ] end -->
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
    <script src="../assets/js/vendor-all.min.js"></script>
    <script src="../assets/js/plugins/bootstrap.min.js"></script>
    <script src="../assets/js/ripple.js"></script>
    <script src="../assets/js/pcoded.min.js"></script>
    <!-- <script src="assets/js/menu-setting.min.js"></script> -->
    <!-- datepicker js -->
    <script src="../assets/js/plugins/moment.min.js"></script>
    <script src="../assets/js/plugins/daterangepicker.js"></script>
    <script src="../assets/js/pages/ac-datepicker.js"></script>


    <!-- prism Js -->
    <script src="../assets/js/plugins/prism.js"></script>


    <script src="../assets/js/horizontal-menu.js"></script>
    <script>
        $(document).ready(function() {
            $("#pcoded").pcodedmenu({
                themelayout: 'horizontal',
                MenuTrigger: 'hover',
                SubMenuTrigger: 'hover',
            });
        });
    </script>

    <script src="../assets/js/analytics.js"></script>

</body>

</html>