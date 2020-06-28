<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="<?php echo base_url('assets/brand/coreui.svg');?>" alt="CoreUI Logo" width="89" height="25">
        <img class="navbar-brand-minimized" src="img/brand/sygnet.svg" alt="CoreUI Logo" width="30" height="30">
    </a>
    <!-- <button class="navbar-toggler sidebar-toggler" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button> -->

    <ul class="nav navbar-nav ml-auto">

      <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img class="img-avatar" src="<?php echo base_url('assets/images/man.png') ;?>" alt="admin">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Account</strong>
                </div>
                <div class="divider"></div>
                <a class="dropdown-item" href="<?php echo base_url('login/logout')?>">
                    <i class="fa fa-lock"></i> Logout</a>
          </div>
      </li>

    </ul>
      
         
</header>