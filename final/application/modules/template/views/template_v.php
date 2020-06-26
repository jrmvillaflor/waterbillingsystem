<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Welcome to CodeIgniter</title>
        <link rel="stylesheet" href="<?php echo base_url('application/assets/css/style.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('application/assets/css/custom.css');?>">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     </head>
    <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
        <header class="app-header navbar">
            <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
                <span class="navbar-toggler-icon"></span>
            </button>
            <span class='h3 text-primary text-md-center'>Student Portal</span>
           
        </header>
        
        <div class="app-body">
        
    
    
            <?php $this->load->view($page_content); ?>

        </div>
    
    </body>
    <script src="<?php echo base_url('application/assets/js/main.js');?>"></script>

</html>