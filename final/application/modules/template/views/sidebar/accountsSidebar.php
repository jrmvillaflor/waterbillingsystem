<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">Accounts</li>
            <?php if($this->session->user_type == 1):?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('admin/adminDashboard');?>">
                    <i class="cil-wc"></i>Home</a>
                </li>
            <?php endif;?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('accounts/newCustomer');?>">
                <i class="cil-wc"></i> New Customer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('accounts/customerAccount');?>">
                <i class="cil-lock-unlocked"></i> Customer Accounts</a>
            </li>            
        </ul>
    </nav>
</div>