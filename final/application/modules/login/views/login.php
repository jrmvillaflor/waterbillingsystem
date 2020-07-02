<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card-group">
        <div class="card p-4">
          <div class="card-body">
            <h1>AWBS</h1>
            <p class="text-muted">Sign In to your account</p>
            <form method="POST" action="<?php echo base_url('login/verify')?>">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="cil-user"></i>
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="Username" name="username">
              </div>
              <div class="input-group mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="cil-lock-locked"></i>
                  </span>
                </div>
                <input type="password" class="form-control" placeholder="Password" name="password">
              </div>
              <div class="row">
                <div class="col-6">
                  <button type="submit" class="btn btn-primary px-4">Login</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="card text-white navbar py-5 d-md-down-none">
          <div class="card-body text-center">
            <img src="<?php echo base_url('assets/images/awbs-desktop.png');?>" width="100%">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>