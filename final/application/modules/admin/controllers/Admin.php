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

        // print_r($data['profile']);
    }

    function pendingEmployees(){

        $data['employees'] = $this->AdminModel->getWhereEmployee(0) ;

        $data['title'] = 'Pending Employee list';
        $data['modules'] = 'admin';
        $data['sidebar']='sidebar/adminSidebar';
        $data['main_content'] = 'pendingEmployees';
        echo Modules::run('template/main_content', $data);
    }

    function addCustomer(){

        $data['title'] = 'Add Customer';
        $data['modules'] = 'admin';
        $data['sidebar']='sidebar/adminSidebar';
        $data['main_content'] = 'addCustomer';
        echo Modules::run('template/main_content', $data);
    }

    function cubicRate(){

        $data['types'] = $this->AdminModel->getData('account_type');;

        $data['title'] = 'Cubic range and Rates';
        $data['modules'] = 'admin';
        $data['sidebar']='sidebar/adminSidebar';
        $data['main_content'] = 'cubicRange';
        echo Modules::run('template/main_content', $data);
    }

    function addDue(){

        $data['title'] = 'Add Due Dates';
        $data['modules'] = 'admin';
        $data['sidebar']='sidebar/adminSidebar';
        $data['main_content'] = 'addDue';
        echo Modules::run('template/main_content', $data);
    }

    function saveDue(){

        $due = array(
            "due_desc" => $this->input->post("due_desc"),
            "due_days" => $this->input->post("due_days"),
        );

        $tbl = "due_dates";

        $response = $this->AdminModel->doInsert($tbl,$due);

        if($response){
            print_r(json_encode(array("msg" => "Success")));

        }
    }




    function addHoliday(){

        $data['title'] = 'Add Holiday';
        $data['modules'] = 'admin';
        $data['sidebar']='sidebar/adminSidebar';
        $data['main_content'] = 'addHoliday';
        echo Modules::run('template/main_content', $data);
    }



    function getDue(){

        $due = $this->AdminModel->getData('due_dates');

        print_r(json_encode($due));
    }

    function updateDue(){

        $due = array(
            'due_id' => $this->input->post('due_id'),
            'due_days' => $this->input->post('due_days'),
        );
        $tbl = "due_dates";
        $pk = "due_id";

        $response = $this->AdminModel->doUpdate($tbl,$due,$pk);

        print_r(json_encode($response));
    }

    function deleteDue(){

        $response = $this->AdminModel->doDelete($this->input->post("due_id"));

        print_r(json_encode($response));

    }



    function getHoliday(){

        $holiday = $this->AdminModel->getHoliday();

        print_r(json_encode($holiday));

    }

    function updateHoliday(){

        $holiday = array(
            'holiday_id' => $this->input->post('holiday_id'),
            'holiday_name' => $this->input->post('holiday_name'),
            'holiday_date' => $this->input->post('holiday_date'),
        );
        $tbl = "holiday";
        $pk = "holiday_id";

        $response = $this->AdminModel->doUpdate($tbl,$holiday,$pk);


        print_r(json_encode($response));
    }

    function deleteHoliday(){

        $response = $this->AdminModel->doDelete($this->input->post("holiday_id"));

        print_r(json_encode($response));

    }

    function saveHoliday(){

        $holiday = array(

            "holiday_name" => $this->input->post("holiday_name"),
            "holiday_date" => $this->input->post("holiday_date"),
        );
        $tbl = "holiday";

        $response = $this->AdminModel->doInsert($tbl,$holiday);

        if($response){
            print_r(json_encode(array("msg" => "Success")));

        }

    }

    function test(){
        $response = array( 'msg' => 'success' );

        echo $response['msg'];
    }

    function getCubicRates(){

        $response = $this->AdminModel->getCubicRates($this->input->post("acc_type"));

        print_r(json_encode($response));
    }

    function updateCubicRates(){

        $cubic = array(
            'cubic_range_id' => $this->input->post('cubic_id'),
            'cubic_range_from' => $this->input->post('cubic_from'),
            'cubic_range_to' => $this->input->post('cubic-to'),
        );
        $tbl = "cubic_range";
        $pk = "cubic_range_id";

        $response = $this->AdminModel->doUpdate($tbl,$cubic,$pk);

        if($response['msg']){
            $price = array(
                'account_type_price' => $this->input->post('cubic_id'),
                'account_type_code' => $this->input->post('cubic_code'),
                'cubic_range_id' => $this->input->post('cubic_id')
            );
            $tbl = "account_type_fees";
            $pk = "cubic_range_id";
    
            $response = $this->AdminModel->doUpdate($tbl,$price,$pk);

            if($response['msg']){
                print_r(json_encode($response));
            }else{
                print_r(json_encode(array("msg" => "price failed")));
            }
        }else{
            print_r(json_encode(array("msg" => "Cubic failed")));
        }
       

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
                        print_r(json_encode(array( 'msg' => 'success')));
                    }

                }else{
                    print_r(json_encode($response));
                }

            }else{
                print_r(json_encode($response));
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
