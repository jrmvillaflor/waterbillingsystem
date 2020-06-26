<?php
    echo Modules::run('template/header', $title);
?>

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">

    
    <?php 
        // kung mag open sa login kani e butang ni $this->session->userdata('is_logged_in')
        // kung kung dili e true lang sa ninyo 
        if ($this->session->userdata('is_logged_in')):
            $this->load->view('topNav');
        endif; 
    ?>

    <div class="app-body">
        
        <?php 
            // kung mag open sa login kani e butang ni $this->session->userdata('is_logged_in')
            // kung kung dili e true lang sa ninyo 
            if ($this->session->userdata('is_logged_in')):
                $this->load->view($sidebar);
            endif;
        ?>
        

        <?php if($modules == 'login'):?>
            <?php $this->load->view($modules.'/'.$main_content);?>     
        <?php else:?>
            <div class="main">
                <?php 
                    if ($modules =='billing' && $main_content == 'billingDashboard'):
                        $this->load->view("breadcrum/billingBC");
                    endif;
                ?>
                <div class="container-fluid mt-2">
                    <?php $this->load->view($modules.'/'.$main_content);?>        
                </div>
            </div>
        <?php endif;?>
    </div>
    


</body>

<?php
    // kung mag open sa login kani e butang ni $this->session->userdata('is_logged_in')
    // kung kung dili e true lang sa ninyo 
    if ($this->session->userdata('is_logged_in')):
        echo Modules::run('template/footer');
    endif;
