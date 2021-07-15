<nav class="pcoded-navbar theme-horizontal menu-light brand-blue">
    <div class="navbar-wrapper">
        <div class="navbar-content sidenav-horizontal" id="layout-sidenav">
            <ul class="nav pcoded-inner-navbar sidenav-inner">
                <?php foreach ($menus['menus'] as $menu) : ?>
                    <li class="nav-item"><a href="<?php echo $menu->url; ?>" class="nav-link "><span class="pcoded-micon"><i class="<?php echo $menu->icon; ?>"></i></span><span class="pcoded-mtext"><?php echo $menu->name; ?></span></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>