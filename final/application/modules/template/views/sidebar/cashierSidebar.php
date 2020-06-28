<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">CASHIER</li>
            <?php if($this->session->type_id == 1):?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('admin/adminDashboard');?>">
                    <i class="nav-icon icon-drop"></i>Home</a>
                </li>
            <?php endif;?>  
            
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('cashier/cashierDashboard');?>">
                <i class="cil-money"></i> Cashier Dashboard</a>
            </li>            
        </ul>
    </nav>
</div>