<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
        if($this->session->is_logged_in == false){
            redirect('login');
        } 

        switch ($this->session->type_id) {
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
    }
	
    public function dashboards(){

        $data['title'] = 'Dashboards';
        $data['modules'] = 'admin';
        $data['sidebar']='sidebar/adminSidebar';
        $data['main_content'] = 'dashboard';
        echo Modules::run('template/main_content', $data);

    } 
    
    public function adminDashboard(){

        $data['title'] = 'Admin Dashboard';
        $data['modules'] = 'admin';
        $data['sidebar']='sidebar/adminSidebar';
        $data['main_content'] = 'adminDashboard';
        echo Modules::run('template/main_content', $data);

    } 

    public function permission(){

        $data['customers'] = $this->AdminModel->getAllCustomer('Active');

        // var_dump($data['customers']);

        $data['title'] = 'Customer Permission';
        $data['modules'] = 'admin';
        $data['sidebar']='sidebar/adminSidebar';
        $data['main_content'] = 'customerList';
        echo Modules::run('template/main_content', $data);

    } 

 
    function verify(){

        $app = array(
            "accId" => $this->input->post("id"),
            "is_verified" => $this->input->post("stat"),
        );

        $response = $this->AdminModel->verified($app);

        print_r(json_encode($response));
    }
    
    
    public function customerPermission(){

        $cust = array(
            'customer_account_id' => $this->input->post('id'),
            'admin_permission' => $this->input->post('stat'),
        );
        
        $response = $this->AdminModel->custPersmission($cust);

        print_r(json_encode($response));

    }

    function addEmployee(){

        $data['postions'] = $this->AdminModel->getData('user_type') ;

        $data['title'] = 'Add Employee';
        $data['modules'] = 'admin';
        $data['sidebar']='sidebar/adminSidebar';
        $data['main_content'] = 'addEmployee';
        echo Modules::run('template/main_content', $data);

    }

    function employeeList(){

        $data['employees'] = $this->AdminModel->getWhereEmployee(1) ;


        $data['title'] = 'Employee Master list';
        $data['modules'] = 'admin';
        $data['sidebar']='sidebar/adminSidebar';
        $data['main_content'] = 'employeeList';
        echo Modules::run('template/main_content', $data);
    }

    function employeeDetails($id){

        $data['profile'] = $this->AdminModel->getProfile($id);
        $data['account'] = $this->AdminModel->getAccount($id);

        $data['title'] = 'Employee Master list';
        $data['modules'] = 'admin';
        $data['sidebar']='sidebar/adminSidebar';
        $data['main_content'] = 'employeeDetails';
        echo Modules::run('template/main_content', $data);
    }

    function pendingEmployees(){

        $data['employees'] = $this->AdminModel->getWhereEmployee(0) ;

        $data['title'] = 'Pending Employee list';
        $data['modules'] = 'admin';
        $data['sidebar']='sidebar/adminSidebar';
        $data['main_content'] = 'pendingEmployees';
        echo Modules::run('template/main_content', $data);
    }




    function saveEmployee(){
        if(!empty($this->input->post())){

            $table = 'account';
            $pk = 'accId';
            $accId = $this->checkID($table, $pk);

            $account = array(
                
                'accId' => $accId,
                'email' =>  $this->input->post('email'),
                'password' =>  $this->input->post('password'),
                'user_type_Id' =>  $this->input->post('position'),
                'is_verified' =>  1,
            );
            $table = "account";

            // var_dump(json_encode($account));
            $response = $this->AdminModel->saveEmployee($account,$table);

            if($response){

                $profile = array(

                    'emp_id' => $accId.'-prof',
                    'firstname' => $this->input->post('fname'),
                    'lastname' => $this->input->post('lname'),
                    'gender' => $this->input->post('gender'),
                    'contactNo' => $this->input->post('contact'),
                    'accId' => $accId,
                );

                $table = "employee_profile";
                $response = $this->AdminModel->saveEmployee($profile,$table);

                if($response){

                    $address = array(

                        "emp_street" => $this->input->post('street'),
                        "emp_barangay" => $this->input->post('barangay'),
                        "emp_city" => $this->input->post('city'),
                        'emp_id' => $accId.'-prof',

                    );

                    $table = "emp_address";
                    $response = $this->AdminModel->saveEmployee($address,$table);

                    if($response){
                        var_dump(json_encode(array( 'msg' => 'success')));
                    }

                }else{
                    var_dump(json_encode($response));
                }

            }else{
                var_dump(json_encode($response));
            }
            
        }
    }


    public function checkID($table, $pkeyName){

        $checkID = false;
        while($checkID == false){
            $acc_id = $this->idGenerator();
            $checkID = $this->AdminModel->idChecker($table, $pkeyName, $acc_id);
        }

        return $acc_id;

    }


    public function idGenerator()
    {

    	$date = date('Y');
		$uid = strval($date);

		while (	strlen($uid) != 10 ) {
			$uid .= strval(rand(0,9));
		}

		return $uid;
    }



    public function countUser(){


        $user = $this->AdminModel->getData('customer_account');

        print_r(json_encode(count($user)));
    }

    public function getReconnection(){

        $reconn = $this->AdminModel->getAllCustomer('For Reconnection');

        print_r(json_encode(count($reconn)));
    }

    public function getForDisconn(){

        $forRec = $this->AdminModel->getAllCustomer('For Disconnection');

        print_r(json_encode(count($forRec)));
    }

    public function disconnected(){

        $disconn = $this->AdminModel->getAllCustomer('Disconnected');

        print_r(json_encode(count($disconn)));
    }
    
}
