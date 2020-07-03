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

        $pk="due_id";
        $tbl="due_dates";

        $response = $this->AdminModel->doDelete($this->input->post("due_id"),$pk, $tbl);

        print_r(json_encode($response));

    }



    function getHoliday(){

        $holiday = $this->AdminModel->getHoliday();

        print_r(json_encode($holiday));

    }

    function updateProfile(){

        $profile = array(
            'emp_id' => $this->input->post('empID'),
            'firstname' => $this->input->post('fname'),
            'lastname' => $this->input->post('lname'),
            'gender' => $this->input->post('gender'),
            'contactNo' => $this->input->post('contact'),
            'accId' => $this->input->post('accID'),
        );
        $tbl = "employee_profile";
        $pk = "emp_id";

        $response = $this->AdminModel->doUpdate($tbl,$profile,$pk);
        if($response["msg"] == "Successful"){


            $profile_add = array(
                'emp_id' => $this->input->post('empID'),
                'emp_street' => $this->input->post('street'),
                'emp_barangay' => $this->input->post('barangay'),
                'emp_city' => $this->input->post('city'),
                
            );

            $tbl = "emp_address";
            $pk = "emp_id";

            $response = $this->AdminModel->doUpdate($tbl,$profile_add,$pk);

            if($response["msg"] == "Successful"){
                print_r(json_encode($response));
            }
        }

        
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

        $pk="holiday_id";
        $tbl="holiday";

        $response = $this->AdminModel->doDelete($this->input->post("holiday_id"),$pk, $tbl);

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

                    'emp_id' => $accId.'-emp',
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


    //Zed ~~~

    public function countUser(){


        $user = $this->AdminModel->getAllCustomer("Active"); 

        print_r(json_encode(count($user)));
    }


    function viewUser(){

        $data['user'] = $this->AdminModel->getData('customer_account'); 
        print_r($this->load->view("list", $data));
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

    public function getAllUserActive(){
        $data['user'] = $this->AdminModel->getAllCustomer("Active"); 
        print_r($this->load->view("widget_table", $data));
    
    }
    public function getAllUserForReconnection(){
        $data['user'] = $this->AdminModel->getAllCustomer("For Reconnection"); 
        print_r($this->load->view("widget_table", $data)); 
    }
    public function getAllUserForDisconnection(){
        $data['user'] = $this->AdminModel->getAllCustomer("For Disconnection");  
        print_r($this->load->view("widget_table_special", $data)); 
    }
    public function getAllUserDisconnection(){
        $data['user'] = $this->AdminModel->getAllCustomer("Disconnected"); 
        print_r($this->load->view("widget_table", $data)); 
    }


    public function checkUserActive(){

        $allCustomers = $this->AdminModel->getAllCustomer('Active');

        // var_dump($allCustomers);
        $user =0;
        foreach ($allCustomers as $v) {
            $data['records'] = $this->AdminModel->getRecords($v->customer_account_id);
            $data['payments'] = $this->AdminModel->payments($v->customer_account_id); 
   
            $month = 0;
            $cp = count($data['payments'])-1;
            
            foreach($data['records'] as $rec){

                if(count($data['payments']) != null){
                    foreach($data['payments'] as $p => $payment){
                        if($rec->date_of_reading == $payment->date_of_reading){
    
                            $month = 0;
                            break;
                        }else{
                            if($cp == $p){
                                $month++;
                            }
                        }
                    }
                }
                else{

                    if(count($data['records']) >= 2){
                        $month = 2;
                    }
                }
                 
                $date = $rec->date_of_reading;
            } 
        
            if($month == 2){
                $dd1 = $this->AdminModel->getDueDate('Billing Due');// 14
                $dd2 = $this->AdminModel->getDueDate('For Disconnection Due'); //3
                
                $due_date = Modules::run('cashier/workingDays', $date,$dd1[0]->due_days);

                if(date("Y-m-d") > $due_date){
                    $diss_conn = Modules::run('cashier/workingDays', $due_date ,$dd2[0]->due_days);
                                    //date now
                    if($diss_conn > date("Y-m-d")){
                        // echo $diss_conn;
                        $this->AdminModel->addStatus($v->customer_account_id,4);
                        $user++;
                    }
                }

            }                                                        //Date now


        }

        echo(json_encode($user));
    }


    public function disconnectCustomer($id){
        $this->AdminModel->addStatus($id,3);

                        ?>
                        <script type="text/javascript">
                            alert('success');
                            document.location = '<?php echo base_url('admin/adminDashboard');?>';

                        </script>
                        <?php
    } 

    public function earnings() {

        $earnings = array();

        $month = 0;
        while($month!=12) {
            $month++;
            $earning=$this->AdminModel->getPaymentSum($month);
            foreach ($earning as $key) {
               if ($key->amount==null) {
                array_push($earnings,0);
               
                } else {
                    array_push($earnings,$key->amount); 
                }
            }
            
            
        }

        print_r(json_encode($earnings));
     
      
    }


}
