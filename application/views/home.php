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
                <div class="row">
                    <!-- [ horizontal-layout ] start -->
                    <div class="col-md-12">
                        <div class="card-deck">
                            <?php foreach ($rooms_type['rooms_type'] as $type) : ?>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <a href="room/<?php echo $type->id; ?>"> <img class="img-fluid card-img-top" src="assets/upload/icon/<?php echo $type->image; ?>" alt="<?php echo $type->name; ?>">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $type->name; ?></h5>
                                                <h6 class="card-title"><?php echo rupiah($type->price); ?></h6>
                                            </div>
                                            <div class="card-footer">
                                                <small class="text-muted">
                                                    <?php foreach ($rooms_available['rooms_available'] as $avail) :
                                                        if ($avail->type == $type->name) { //-- Keep this
                                                            echo "Rooms Available " . $avail->jumlah;
                                                        };
                                                    endforeach; ?>
                                                </small>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <!-- [ horizontal-layout ] end -->
                </div>
                <!-- [ Main Content ] end -->
                <!-- [ Main Content ] start -->
                <!-- [ Main Content ] end -->
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- Warning Section start -->
    <!-- Older IE warning message -->
    <!--[if lt IE 11]>
            <div class="ie-warning">
                <h1>Warning!!</h1>
                <p>You are using an outdated version of Internet Explorer, please upgrade
                   <br/>to any of the following web browsers to access this website.
                </p>
                <div class="iew-container">
                    <ul class="iew-download">
                        <li>
                            <a href="http://www.google.com/chrome/">
                                <img src="assets/images/browser/chrome.png" alt="Chrome">
                                <div>Chrome</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.mozilla.org/en-US/firefox/new/">
                                <img src="assets/images/browser/firefox.png" alt="Firefox">
                                <div>Firefox</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.opera.com">
                                <img src="assets/images/browser/opera.png" alt="Opera">
                                <div>Opera</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.apple.com/safari/">
                                <img src="assets/images/browser/safari.png" alt="Safari">
                                <div>Safari</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                                <img src="assets/images/browser/ie.png" alt="">
                                <div>IE (11 & above)</div>
                            </a>
                        </li>
                    </ul>
                </div>
                <p>Sorry for the inconvenience!</p>
            </div>
        <![endif]-->
    <!-- Warning Section Ends -->

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