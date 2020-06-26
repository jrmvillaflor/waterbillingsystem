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

        print_r($this->AdminModel->verified('2020100100'));
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


    function saveEmployee(){
        if(!empty($this->input->post())){

            $account = array(
                
                'accId' => 2020100102,
                'email' =>  $this->input->post('email'),
                'password' =>  $this->input->post('password'),
                'user_type_Id' =>  $this->input->post('position'),
                'is_verified' =>  1,
            );

            // var_dump(json_encode($account));
            $response = $this->AdminModel->saveEmployee($account);

            var_dump(json_encode($response));
        }
    }


    public function checkID($table, $pkeyName){

        $checkID = false;
        while($checkID == false){
            $acc_id = $this->idGenerator();
            $checkID = $this->Admin->idChecker($table, $pkeyName, $acc_id);
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
