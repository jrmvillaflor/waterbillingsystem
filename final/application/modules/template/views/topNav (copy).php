<header class="app-header navbar">

    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">

        <span class="navbar-toggler-icon"></span>
    </button>
    
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
         <img class="float-left pl-5" src="<?php echo base_url('assets/images/awbs-desktop.png');?>" width="120"></img>
    </button>


    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item d-md-down-none">
           
            <a class="nav-link" href="#">
            <!-- <i class="cil-chat-bubble"></i> -->
            </a>
        </li>
        <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#">
            <i class="cil-bell"></i>
            </a>

        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img class="img-avatar" src="<?php echo base_url('assets/images/man.png') ;?>" alt="admin">
            
            </a>
            <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
                <strong>Account</strong>
            </div>
            <a class="dropdown-item" href="#">
                <i class="fa fa-bell-o"></i> Updates
                <span class="badge badge-info">42</span>
            </a>
            <a class="dropdown-item" href="#">
                <i class="fa fa-envelope-o"></i> Messages
                <span class="badge badge-success">42</span>
            </a>
            <a class="dropdown-item" href="#">
                <i class="fa fa-tasks"></i> Tasks
                <span class="badge badge-danger">42</span>
            </a>
            <a class="dropdown-item" href="#">
                <i class="fa fa-comments"></i> Comments
                <span class="badge badge-warning">42</span>
            </a>
            <div class="dropdown-header text-center">
                <strong>Settings</strong>
            </div>
            <a class="dropdown-item" href="#">
                <i class="fa fa-user"></i> Profile</a>
            <a class="dropdown-item" href="#">
                <i class="fa fa-wrench"></i> Settings</a>
            <a class="dropdown-item" href="#">
                <i class="fa fa-usd"></i> Payments
                <span class="badge badge-secondary">42</span>
            </a>
            <a class="dropdown-item" href="#">
                <i class="fa fa-file"></i> Projects
                <span class="badge badge-primary">42</span>
            </a>
            <div class="divider"></div>
            <a class="dropdown-item" href="#">
                <i class="fa fa-shield"></i> Lock Account</a>
            <a class="dropdown-item" href="#">
                <i class="fa fa-lock"></i> Logout</a>
            </div>
        </li>
    </ul>
    
    <button class="navbar-toggler aside-menu-toggler d-lg-none" type="button" data-toggle="aside-menu-show">
    <span class="navbar-toggler-icon"></span>
    </button>
</header>