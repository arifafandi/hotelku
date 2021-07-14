<!DOCTYPE html>
<html lang="en">

<head>

    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" href="../assets/images/fav.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/plugins/dataTables.bootstrap4.min.css">
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
                            <h5><?php echo $title ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center m-l-0">
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button class="btn btn-success btn-sm btn-round has-ripple" data-toggle="modal" data-target="#modal-report"><i class="feather icon-plus"></i> Add User</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="report-table" class="table table-bordered table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Identity Number</th>
                                            <th>Email</th>
                                            <th>Group</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        foreach ($users['users'] as $user) :
                                            $no++;
                                        ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $user->name; ?></td>
                                                <td><?php echo $user->identity_number; ?></td>
                                                <td><?php echo $user->email; ?></td>
                                                <td>
                                                    <?php
                                                    foreach ($groups['groups'] as $group) :
                                                        if ($group->id == $user->id_group) {
                                                    ?>
                                                            <?php echo strtoupper($group->name) ?>
                                                    <?php
                                                        }
                                                    endforeach
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit<?php echo $user->id; ?>"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete<?php echo $user->id; ?>"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
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
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <div class="modal fade" id="modal-report" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('admin/add_user') ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="Name">Name</label>
                                <input name="name" type="text" class="form-control" id="Name" placeholder="" required="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="Identity">Identity Number</label>
                                <input name="identity" type="number" class="form-control" id="Identity" placeholder="" required="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="Email">Email</label>
                                <input name="email" type="email" class="form-control" id="Email" placeholder="" required="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="Password">Password</label>
                                <input name="password" type="password" class="form-control" id="password" placeholder="" required="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="City">City</label>
                                <input name="city" type="text" class="form-control" id="City" placeholder="" required="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label" for="Phone">Phone</label>
                                <input name="phone" type="text" class="form-control" id="Phone" placeholder="" required="">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="floating-label" for="Group">Group</label>
                                <select name="group" id="group" class="form-control" required="">
                                    <?php foreach ($groups['groups'] as $group) : ?>
                                        <option value="<?= $group->id ?>"><?= strtoupper($group->name) ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    foreach ($users['users'] as $user) :
    ?>
        <div class="modal fade" id="modal-delete<?php echo $user->id; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <?php echo form_open('admin/delete_user/' . $user->id); ?>
                    <div class="modal-body">
                        <input type="hidden" readonly value="<?php echo $this->uri->segment(3); ?>" name="url">
                        Delete User <?php echo $user->name; ?>?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary">Hapus</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php
    foreach ($users['users'] as $user) :
    ?>
        <div class="modal fade" id="modal-edit<?php echo $user->id; ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <?php echo form_open('admin/edit_user/' . $user->id); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="floating-label" for="Name">Name</label>
                                    <input name="name" type="text" class="form-control" id="Name" value="<?php echo $user->name; ?>" required="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="floating-label" for="Identity">Identity Number</label>
                                    <input name="identity" type="number" class="form-control" id="Identity" value="<?php echo $user->identity_number; ?>" required="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="floating-label" for="Email">Email</label>
                                    <input name="email" type="email" class="form-control" id="Email" value="<?php echo $user->email; ?>" required="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="floating-label" for="Password">Password</label>
                                    <input name="password" type="password" class="form-control" id="password" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="floating-label" for="City">City</label>
                                    <input name="city" type="text" class="form-control" id="City" value="<?php echo $user->city; ?>" required="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="floating-label" for="Phone">Phone</label>
                                    <input name="phone" type="text" class="form-control" id="Phone" value="<?php echo $user->phone; ?>" required="">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="floating-label" for="Group">Group</label>
                                    <select name="group" id="group" class="form-control" required="">
                                        <?php foreach ($groups['groups'] as $group) : ?>
                                            <option <?= ($user->id_group == $group->id) ? 'selected=""' : '' ?> value="<?= $group->id ?>"><?= strtoupper($group->name) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
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
    <script>
        // DataTable start
        $('#report-table').DataTable();
        // DataTable end
    </script>
</body>

</html>