<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model("BillingModel");
        $this->load->helper('date');
        if($this->session->is_logged_in == false){
            redirect('login');
        }

        switch ($this->session->type_id) {
          case 3:
            redirect('cashier/cashierDashboard');
            break;
          case 4:
            redirect('accounts/accountsDashboard');
            break;
     
        }
    }
	
    
    public function billingDashboard(){
        
        $data['customers'] = $this->BillingModel->getAllCustomer();

        // var_dump($data['customers'][0]->account_status_desc);
        $data['title'] = 'Billing Dashboard';
        $data['modules'] = 'billing';
        $data['sidebar']='sidebar/billingSidebar';
        $data['main_content'] = 'billingDashboard';
        echo Modules::run('template/main_content', $data);

    } 
    
    public function ledger(){


        if($this->uri->segment(3)):

            $customer_Id = $this->uri->segment(3);

            $data['infos'] = $this->BillingModel->customerInfo(null,$customer_Id);

            if($data['infos'] != null ):

                $data['accounts'] = $this->BillingModel->getAccounts(null,null,$customer_Id);
                $data['records'] = $this->BillingModel->getRecords($data['infos'][0]->customer_account_id);
                $data['payments'] = $this->BillingModel->payments($data['infos'][0]->customer_account_id); 
                $data['OP'] = $this->BillingModel->getPenalty('penalty');


                $code = $data['accounts'][0]->account_type_code;
                // $data['bill']= array();
                

                foreach($data['records'] as $key => $rec ){
                    if($key == 0 ){
                        $prev = $rec->reading_value;
                        $prev;
                    }
                    else{
                        
                        $consumed = $rec->reading_value - $prev;
                        $prev = $rec->reading_value;

                        $data['bill'][] = $this->calculateBill($code, $consumed);    
                    }
                }

                // var_dump($data['payments']);
                
                $data['title'] = 'Customer Ledger';
                $data['modules'] = 'billing';
                $data['sidebar']='sidebar/billingSidebar';
                $data['main_content'] = 'ledger';
                echo Modules::run('template/main_content', $data);
            
            endif;

        endif;

    }

    function getLedger(){

        $customer_Id = $this->input->post("custId");
        
        $data['infos'] = $this->BillingModel->customerInfo(null,$customer_Id);

        $data['accounts'] = $this->BillingModel->getAccounts(null,$this->input->post("type_code"),$customer_Id);
        $data['records'] = $this->BillingModel->getRecords($data['infos'][0]->customer_account_id);
        $data['payments'] = $this->BillingModel->payments($data['infos'][0]->customer_account_id); 
        $data['OP'] = $this->BillingModel->getPenalty('penalty');


        $code = $this->input->post("type_code");
        $data['bill']= array();
        
        print_r($data['infos']); 
        if($data['records'] != null):
            foreach($data['records'] as $key => $rec ){
                if($key == 0 ){
                    $prev = $rec->reading_value;
                    $prev;
                }
                else{
                    
                    $consumed = $rec->reading_value - $prev;
                    $prev = $rec->reading_value;

                    $data['bill'][] = $this->calculateBill($code, $consumed);    
                }
            }
        endif;

        echo $this->load->view("trLedger", $data);

    }

    public function addReading(){

        if($this->uri->segment(3)):
            $account_id = $this->uri->segment(3);
            
            
            // $this->form_validation->set_rules('readVal','Reading Value', 'required');
            // $this->form_validation->set_rules('DOR', 'Date of Reading', 'required');
            $config = array(
                array(
                        'field' => 'readVal',
                        'label' => 'Reading Value',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'You must provide a %s.',
                        ),
                ),
                array(
                        'field' => 'DOR',
                        'label' => 'Date of Reading',
                        'rules' => 'required',
                        'errors' => array(
                                'required' => 'You must provide a %s.',
                        ),
                )
            );
            
            $this->form_validation->set_rules($config);

            if($this->form_validation->run() === FALSE):
                
                $data['accounts'] = $this->BillingModel->getAccounts(null,null,$account_id);
                // $data['readings'] = json_decode($this->getReading($data['accounts'][0]->customer_account_id));
                // echo "<br>";
                // echo $account_id;
                // var_dump($data['accounts']);
                $data['title'] = 'Customer Ledger';
                $data['modules'] = 'billing';
                $data['sidebar']='sidebar/billingSidebar';
                $data['main_content'] = 'addReading';
                echo Modules::run('template/main_content', $data);
            
            else:

                $status = $this->BillingModel->getCustomerStatus($this->input->post('type'));

                if($status[0]->account_status_desc == "Deactivate"):

                    ?>
                    <script type="text/javascript">
                        alert('Unable to add reading because of account status');
                        document.location = '<?php echo base_url('billing/addReading/').$customer_Id?>';
                    </script>
                    <?php

                else:

                    $tbl = 'meter_reading';
                    $pk = 'meter_reading_id';

                    $mr = $this->checkID($tbl,$pk);
                    $reading = array(

                        'meter_reading_id' => "mr".date('Y')."-".$mr,
                        'date_of_reading' => $this->input->post('DOR'),
                        'reading_value' => $this->input->post('readVal'),
                        'customer_account_id' => $this->input->post('type'),
                        'print' => 0,
                        "is_recieved" => 0,

                    );

                    $response = $this->BillingModel->insertData($tbl, $reading);

                    if($response['code'] == 201 ):

                        ?>
                        <script type="text/javascript">
                            alert('Successfully Added');
                            document.location = '<?php echo base_url('billing/addReading/').$customer_Id?>';
                        </script>
                        <?php

                    else:

                        ?>
                        <script type="text/javascript">
                            alert('Inserting Failed');
                            document.location = '<?php echo base_url('billing/addReading/').$customer_Id?>';
                        </script>
                        <?php
                    endif;

                endif;

            endif;
            
        endif;
    }


    function readingHistory(){
        
        if($this->uri->segment(3)):
            $data["account_id"] = $this->uri->segment(3);
            

            // $data['accounts'] = $this->BillingModel->getAccounts($customer_Id,null,null);
            
            
            $data['title'] = 'Reading History';
            $data['modules'] = 'billing';
            $data['sidebar']='sidebar/billingSidebar';
            $data['main_content'] = 'readingHis';
            echo Modules::run('template/main_content', $data);

        endif;
    } 

    public function getReading(){
        $id = '202000674605-POB';
        $id = $this->input->post('id');
        $reading = $this->BillingModel->getReadings($id);
    
        echo json_encode($reading);
    }

    function updateReading(){

        $reading = array(  
            "meter_reading_id" => $this->input->post("mrID"),
            "date_of_reading" => $this->input->post("editDate"),
            "reading_value" => $this->input->post("readVal")
        );

        $tbl = "meter_reading";
        $pk = "meter_reading_id";

        $response = $this->BillingModel->doUpdate($tbl,$reading,$pk);

        print_r(json_encode($response));

    }




    public function calculateBill($type,$consumed){

        $data['UserPayment'] = $this->BillingModel->calBill($type);
        // var_dump($data['UserPayment']);

        $i = count($data['UserPayment']);        

		$prevTo = 0;
		$total = 0;
		$subcon;
		$remaining = $consumed;

       
		
		foreach ($data['UserPayment'] as $key => $value) {
				
            if ($i == $key+1) {
                if ($consumed >= $value->cubic_range_from) {
                    
                
                    $subcon = $consumed - ($value->cubic_range_from-1);
                    
                    $asd = $subcon * $value->account_type_price;
                    $asd;
                    
                    $total += $subcon * $value->account_type_price;

                    
                }
            }
            else
            {

                
                if ($value->cubic_range_from <= $consumed && $value->cubic_range_to >= $consumed ) {
                    if ($total != 0 ) {
                        $remaining * $value->account_type_price;
                    
                        $total += ($remaining * $value->account_type_price);
                    
                        break;
                    
                    }
                    else{
                        $consumed * $value->account_type_price;
                        
                        $total += $consumed * $value->account_type_price;
                        
                        break;
                    }
                    
                
                }
            
                else
                {
                    
                                            
                    $subcon = $value->cubic_range_to - $prevTo;
                    
                    
                    $asd = $subcon * $value->account_type_price;
                    

                    $total += $subcon * $value->account_type_price;	
                    
                    
                    $remaining -= $subcon;
                    
                    $prevTo = $value->cubic_range_to;
                            
                }
            
            }
		
		}
	
		return $total;

    }

    public function addAccount(){
        
        $data['title'] = 'Customer Account Form';
        $data['modules'] = 'billing';
        $data['sidebar']='sidebar/billingSidebar';
        $data['main_content'] = 'addAccount';
        echo Modules::run('template/main_content', $data);
    
    }
    

    public function application(){
        

        $this->form_validation->set_rules('firstname','', 'required');
		$this->form_validation->set_rules('lastname','', 'required');
        $this->form_validation->set_rules('contact', '', 'required');
        $this->form_validation->set_rules('street','', 'required');
        $this->form_validation->set_rules('barangay','', 'required');
        $this->form_validation->set_rules('municipality', '', 'required');
        $this->form_validation->set_rules('type', '', 'required');


        if ($this->form_validation->run() === FALSE){

            $data['types']=$this->BillingModel->getdata('account_type');
            $data['barangays']=$this->BillingModel->getdata('barangay');

            $data['title'] = 'Application Form';
            $data['modules'] = 'billing';
            $data['sidebar']='sidebar/billingSidebar';
            $data['main_content'] = 'application';
            echo Modules::run('template/main_content', $data);

        }
        else{

            // var_dump($this->input->post());
            $tbl = 'review_customer';
            $cust = array(

                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'contactNo' => $this->input->post('contact'),
                'street' => $this->input->post('street'),
                'municipality' => $this->input->post('municipality'),
                'type_code' => $this->input->post('type'),
                'review_status_id' => 1,
                'brgy_id' => $this->input->post('barangay'),

            );


            $response = $this->BillingModel->insertData($tbl, $cust);

            if($response['code'] == 201):
                ?>
                    <script type="text/javascript">
                        alert('Inserting Successful');
                        document.location = '<?php echo base_url('billing/application') ?>';
                    </script>
                <?php
            else: 
                ?>
                    <script type="text/javascript">
                        alert('Inserting Failed');
                        document.location = '<?php echo base_url('billing/application') ?>';
                    </script>
                <?php
            endif;
        }
            
    
    }


    public function newAccount(){


        if($this->uri->segment(3)):

            $customer_Id = $this->uri->segment(3);



            $this->form_validation->set_rules('street','Street', 'required');
            $this->form_validation->set_rules('municipality','Municipality', 'required');


            if ($this->form_validation->run() === FALSE):

                $data['id'] = $customer_Id;

                $data['types']=$this->BillingModel->getdata('account_type');
                $data['barangays']=$this->BillingModel->getdata('barangay');

                $data['title'] = 'Customer Account Form';
                $data['modules'] = 'billing';
                $data['sidebar']='sidebar/billingSidebar';
                $data['main_content'] = 'addAccount';
                echo Modules::run('template/main_content', $data);
            
            else:

                $table = 'review_account';

                $account = array(

                    'street' => $this->input->post('street'),
                    'municipality' => $this->input->post('municipality'),
                    'zipcode' => 1980,
                    'customer_id' => $customer_Id,
                    'type_code' => $this->input->post('type'),
                    'review_status_id' => 1,
                    'brgy_id' => $this->input->post('barangay'),
                    
                );

                $response = $this->BillingModel->insertData($table, $account);

                if($response['code'] == 201):
                    ?>
                        <script type="text/javascript">
                            alert('Inserting Successful');
                            document.location = '<?php echo base_url('billing/ledger/').$customer_Id ?>';
                        </script>
                    <?php
                else: 
                    ?>
                        <script type="text/javascript">
                            alert('Inserting Failed');
                            document.location = '<?php echo base_url('billing/newAccount').$customer_Id ?>';
                        </script>
                    <?php
                endif;
            endif;
        endif;
        

    }
    

    public function penalty(){

        $data['penalty'] = $this->BillingModel->getPenalty('penalty');

        var_dump($data['penalty']);
    }



    public function customerBill($id){

        if($this->uri->segment(3)):
            $this->load->library('pdf');

            $acc_id = $this->uri->segment(3);
            $data['userInfo'] = $this->BillingModel->customerInfo(null,$acc_id);
            $data['readings'] = $this->BillingModel->monthlyReading($data['userInfo'][0]->customer_account_id);

            $data['fees'] = $this->BillingModel->toPay($data['userInfo'][0]->customer_account_id,"Active");

            if($data['readings'] != null && count($data['readings']) != 1):
                // getting Arrears 
                $data['records'] = $this->BillingModel->getRecords($data['userInfo'][0]->customer_account_id);
                $data['payments'] = $this->BillingModel->payments($data['userInfo'][0]->customer_account_id); 
                $data['OP'] = $this->BillingModel->getPenalty('penalty');

                $cr = count($data['records'])-1;
                $cp = count($data['payments'])-1;


                $balance = 0;
                $total = 0;
                $arrears = 0;
                $data["arrears"] = 0;
                foreach($data['records'] as $kr => $record):
                    
                    if($kr == 0):
                        $prev = $record->reading_value;

                    else:
                        if($balance == 0):
                            $overdue = 0;
                        else:
                            $overdue = round($balance,2);
                        endif;

                        if($overdue == 0):
                            $penalty = 0;
                        else:
                            $penalty = round($overdue * $data['OP'][0]->op_value,2);
                        endif;

                        $con = $record->reading_value-$prev;
                        // echo "<br>";
                        $monthBill = $this->calculateBill($data['records'][0]->account_type_code, $con);
                        $total = $monthBill+$overdue+$penalty;

                        if($data['payments'] != null):
                            foreach($data['payments'] as $kp => $payment):
                                if($record->date_of_reading == $payment->date_of_reading ):
                                    $amount = $payment->amount;
                                    break;
                                else:
                                    if($cp == $kp):
                                        $amount = 0;
                                    endif;
                                endif;
                            endforeach;
                        else:
                            $amount = 0;
                        endif;

                        $balance = $total - $amount;

                        if($cr != $kr):
                            $arrears = $balance; 
                            $data["arrears"] = $arrears;
                        
                        endif;

                        // echo "<br>";
                        
                        $data['date'] = $record->date_of_reading;
                        $prev = $record->reading_value;
                    endif;
                endforeach;

                // foreach($data['readings'] as $key => $value):
                //     if($key == 0):
                //         $pres = $value->reading_value;
                //     else:
                //         $prev = $value->reading_value;
                //     endif;  
                // endforeach;
                
                
                $pres = $data['readings'][0]->reading_value;
                $prev = $data['readings'][1]->reading_value;
                
                $consumed = $pres - $prev;
            
                $data['bill'] = $this->calculateBill($data['fees'][0]->account_type_code, $consumed);
                $data['due_date'] = $this->workingDays($data['date']);


                // echo "ang bill = ".$data["bill"];
                // echo "<br>";
                // echo "ang arrears = ".$data["arrears"];
                // echo "<br>";
                // echo $data["arrears"]*$data["OP"][0]->op_value;
                // echo "<br>";
                // print_r($data["OP"][0]->op_value);
                $this->load->view('billing/customerBill',$data);

                $html = $this->output->get_output();

                $this->pdf->loadHTML($html);
                $this->pdf->render();
                ob_end_clean();
                $this->pdf->stream($acc_id+".pdf",array("Attachment"=>0));
                
            else:

                echo "No record yet";

                ?>
                    <script type="text/javascript">
                        alert('No Available Records ');
                        document.location = '<?php echo base_url('billing/billingDashboard') ?>';
                    </script>
                <?php
            endif;

        endif;
    }


    function test(){

        $due_date = $this->BillingModel->getDueDate('billing due days');

        print_r($due_date);
    }


    public function workingDays($date){

        // $sd = '2020-08-20'; 
        $d1 = date('Y-m-d', strtotime($date. ' + 1 days'));     
        
        $due_date = $this->BillingModel->getDueDate('Billing Due');
        $holiday = $this->BillingModel->getHoliday(date('m', strtotime($date)));
        
        $i=1;

        while ($i <= $due_date[0]->due_days ) {

            if(date('m', strtotime($date)) != date('m', strtotime($d1))){
                $holiday = $this->BillingModel->getHoliday(date('m', strtotime($d1)));
                
            }

            if($this->isWeekend($d1)){
                
                $d1 = date('Y-m-d', strtotime($d1. ' + 1 days'));
                
            }
            else{

                if(!empty($holiday)){
                    $ch = count($holiday)-1;
                    foreach($holiday as $h => $hdate){
                        if($d1 == $hdate->holiday_date){

                            $d1 = date('Y-m-d', strtotime($d1. ' + 1 days'));
                            break;
                        }
                        else{

                            if($ch == $h){

                                $d2 = $d1;
                                $d1 = date('Y-m-d', strtotime($d1. ' + 1 days'));
        
                                $i++;

                            }
                        }     
                    }
                }
                else{
                    $d2 = $d1;
                    $d1 = date('Y-m-d', strtotime($d1. ' + 1 days'));

                    $i++;

                }     
            }

        }
        return $d2;

    }

    public function isWeekend($date){
        if(date('l', strtotime($date)) == "Saturday" || date('l', strtotime($date)) == "Sunday"){
            return true;
        }
        else{
            return false;
        }
    }

    public function sample(){

        $this->load->library('pdf');
        // $this->load->view('billing/sample');
        
        
        // echo $html = $this->output->get_output();
        // $html ='<!doctype html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
        // $html.='</head><body>';
        // $html.="<style> 
        //  @font-face { font-family: 'Roboto Regular'; font-weight: normal; src: url(\'fonts/Roboto-Regular.ttf\') format(\'truetype\'); } 
        // @font-face { font-family: 'Roboto Bold'; font-weight: bold; src: url(\'fonts/Roboto-Bold.ttf\') format(\'truetype\'); } 
        // body{ font-family: 'Roboto Regular', sans-serif; font-weight: normal; line-height:1.6em; font-size:17pt; }
        // h1,h2{ font-family: 'Roboto Bold', sans-serif; font-weight: bold; line-height:1.2em; }
        // </style>";

        // $html.='test <br>
        // <span style="font-family:\'Open Sans\'"> test </span> <br>          ';
        // $html.= '</body></html>';


        $this->pdf->loadHTML($html);
        $this->pdf->render();
        $this->pdf->stream("welcome.pdf",array("Attachment"=>0));
    }



    public function checkID($table, $pkeyName){

        $checkID = false;
        while($checkID == false){
            $id = $this->idGenerator();
            $checkID = $this->BillingModel->idChecker($table, $pkeyName, $id);
        }

        return $id;

    }


    public function idGenerator()
    {

    	$date = date('Y');
		$uid = '';

		while (	strlen($uid) != 6 ) {
			$uid .= strval(rand(0,9));
		}

		return $uid;
    }
}



/* 
 *
 *  get all customer 
 *  specific customer
 *  update status
 *  CRUD Meter reading
 * 
 * 
*/