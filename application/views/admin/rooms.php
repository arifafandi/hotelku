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
                            <div class="row align-items-center m-l-0">
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button class="btn btn-success btn-sm btn-round has-ripple" data-toggle="modal" data-target="#modal-add"><i class="feather icon-plus"></i> Add Room Type</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="report-table" class="table table-bordered table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Type</th>
                                            <th>Room Number</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        foreach ($rooms['rooms'] as $room) :
                                            $no++;
                                        ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $room->type; ?></td>
                                                <td><?php echo $room->number; ?></td>
                                                <td><?php echo $room->status; ?></td>
                                                <td>
                                                    <a href="javascript:void(0);" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit<?php echo $room->id; ?>"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete<?php echo $room->id; ?>"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
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
        <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Room</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= form_open('admin/add_rooms'); ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="floating-label" for="Number">Room Number</label>
                                    <input name="number" type="text" class="form-control" id="Number" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="floating-label" for="Type">Room Type</label>
                                    <select name="type" id="type" class="form-control" required="">
                                        <?php foreach ($rooms_type['rooms_type'] as $type) : ?>
                                            <option value="<?= $type->id ?>"><?= $type->name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="floating-label" for="status">Room Status</label>
                                    <select name="status" id="status" class="form-control" required="">
                                        <option value="unbooked">unbooked</option>
                                        <option value="booked">booked</option>
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
        <?php
        foreach ($rooms['rooms'] as $room) :
        ?>
            <div class="modal fade" id="modal-delete<?php echo $room->id; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Room</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <?php echo form_open('admin/delete_rooms/' . $room->id); ?>
                        <div class="modal-body">
                            <input type="hidden" readonly value="<?php echo $this->uri->segment(3); ?>" name="url">
                            Delete Room <?php echo $room->number; ?>?
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary">Delete</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php
        foreach ($rooms['rooms'] as $room) :
        ?>
            <div class="modal fade" id="modal-edit<?php echo $room->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Room</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?= form_open('admin/update_rooms/' . $room->id); ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="Number">Room Number</label>
                                        <input name="number" type="text" class="form-control" value="<?php echo $room->number; ?>" id="Number" placeholder="">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="Type">Room Type</label>
                                        <select name="type" id="type" class="form-control" required="">
                                            <option value="">Select Type</option>
                                            <?php foreach ($rooms_type['rooms_type'] as $type) : ?>
                                                <option <?= ($type->id == $room->id_type) ? 'selected=""' : '' ?> value="<?= $type->id ?>"><?= $type->name ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="status">Room Status</label>
                                        <select name="status" id="status" class="form-control" required="">
                                            <option <?= ($room->status == 'booked') ? 'selected=""' : '' ?> value="booked">booked</option>
                                            <option <?= ($room->status == 'unbooked') ? 'selected=""' : '' ?> value="unbooked">unbooked</option>
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
    </div>

    <script src="../assets/js/vendor-all.min.js"></script>
    <script src="../assets/js/plugins/bootstrap.min.js"></script>
    <script src="../assets/js/ripple.js"></script>
    <script src="../assets/js/pcoded.min.js"></script>

    <!-- datatable Js -->
    <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="../assets/js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/js/pages/data-basic-custom.js"></script>

</body>

</html>