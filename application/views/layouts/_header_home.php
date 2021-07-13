<header class="navbar pcoded-header navbar-expand-lg header-blue navbar-light">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="<?php base_url(); ?>" class="b-brand">
            <div class="page-header-title">
                <b class="m-b-10">HotelKu</b>
            </div>
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <?php if ($this->session->userdata('id')) : ?>
                                <span><?php echo $this->session->userdata('name'); ?></span>
                                <a href="<?php echo base_url('logout'); ?>" class="dud-logout" title="Logout">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            <?php else : ?>
                                <span>Guest</span>
                                <a href="<?php echo base_url('login'); ?>" class="dud-logout" title="Login">
                                    <i class="feather icon-log-in"></i>
                                </a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>