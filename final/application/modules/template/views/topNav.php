<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <img class="float-left pl-5" src="<?php echo base_url('assets/images/awbs-desktop.png');?>" width="120"></img>
    </button>
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