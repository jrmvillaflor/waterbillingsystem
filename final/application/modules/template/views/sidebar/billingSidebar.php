<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">BILLING</li>
            <?php if($this->session->user_type == 1):?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('admin/adminDashboard');?>">
                    <i class="cil-wc"></i>Home</a>
                </li>
            <?php endif;?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('billing/billingDashboard');?>">
                <i class="cil-wallet"></i> Billing Dashboard</a>
            </li>            
        </ul>
    </nav>
</div>