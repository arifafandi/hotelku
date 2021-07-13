<nav class="pcoded-navbar menu-light ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div ">
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <li class="nav-item"><a href="<?php echo base_url('admin'); ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span></a>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-bed"></i></span><span class="pcoded-mtext">Manage Rooms</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="<?php echo base_url('admin/rooms-type'); ?>">Rooms Type</a></li>
                        <li><a href="<?php echo base_url('admin/rooms'); ?>">Rooms</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-calendar"></i></span><span class="pcoded-mtext">Manage Booking</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="<?php echo base_url('admin/booking-unpaid'); ?>">Booking Unpaid</a></li>
                        <li><a href="<?php echo base_url('admin/booking-pending'); ?>">Booking Pending</a></li>
                        <li><a href="<?php echo base_url('admin/booking-history'); ?>">Booking History</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="<?php echo base_url('logout'); ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-log-out"></i></span>
                        <span class="pcoded-mtext">Logout</span></a>
                </li>

            </ul>
        </div>
    </div>
</nav>