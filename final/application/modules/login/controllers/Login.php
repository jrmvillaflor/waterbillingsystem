<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel');
        
    }
	
    
	public function index()
	{
        if($this->session->is_logged_in){
            $this->goDash($this->session->type_id);
            switch ($this->session->type_id) {
              case 1:
                redirect('admin/adminDashboard');
                break;
              case 2:
                redirect('billing/billingDashboard');
                break;
              case 3:
                redirect('cashier/cashierDashboard');
                break;
              case 4:
                redirect('accounts/accountsDashboard');
                break;
        
        }
        }else{

            $data['title'] = 'Login';
            $data['modules'] = 'login';
            $data['main_content'] = 'login';
            echo Modules::run('template/main_content', $data);
        }
    }

    // public function register(){

    //     $data['title'] = 'Sample';
    //     $data['modules'] = 'login';
    //     $data['main_content'] = 'regis';
    //     echo Modules::run('template/main_content', $data);
    // }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }


    public function verify()
    {
        $user = $this->input->post('username');
        $pass = $this->input->post('password');

        // echo 'username: '.$user;
        // echo '<br>';
        // echo 'password: '.$pass;
        if($this->LoginModel->checkUser($user,$pass)):
            
            $fetch_user = $this->LoginModel->getUserAccount($user);
            if(!empty($fetch_user)):
                $this->setUser($fetch_user);
                $this->goDash($fetch_user->user_type_Id);
            endif;
        else:
            ?>
                <script type="text/javascript">
                    alert('Sorry Account Doesn\'t Exist! ');
                    document.location = '<?php echo base_url() ?>';
                </script>
            <?php
        endif;

    }

    function goDash($uID){

        if($uID == 1):

            redirect('/admin/adminDashboard');

        elseif($uID == 2):

            redirect('/billing/billingDashboard');

        elseif($uID == 3):

            redirect('/casheir/cashierDashboard');

        elseif($uID == 4):

            redirect('/accounts/accountsDashboard');

        elseif($uID == 5):
            
        endif;
    }



    public function setUser($details)
    {
        

        $data = array (
            'is_logged_in' => TRUE,
            'username' => $details->username,
            'type_id' => $details->user_type_Id,

        );

        $this->session->set_userdata($data);

    }
    
}
