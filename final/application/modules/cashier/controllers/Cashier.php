<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashier extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('CashierModel');
        $this->load->helper('date');
        if($this->session->is_logged_in == false){
            redirect('login');
        }

        switch ($this->session->type_id) {
          case 2:
            redirect('billing/billingDashboard');
            break;
          case 4:
            redirect('accounts/accountsDashboard');
            break;
        
        }

    }
	
    
    public function cashierDashboard(){

        $data['customers'] = $this->CashierModel->getAllCustomer();


        $data['title'] = 'Cashier Dashboard';
        $data['modules'] = 'cashier';
        $data['sidebar']='sidebar/cashierSidebar';
        $data['main_content'] = 'cashierDashboard';
        echo Modules::run('template/main_content', $data);

    } 

    function bulkWater(){

        $data['title'] = 'Bulk Water';
        $data['modules'] = 'cashier';
        $data['sidebar']='sidebar/cashierSidebar';
        $data['main_content'] = 'bulkWater';
        echo Modules::run('template/main_content', $data);
    }

    // $date = new DateTime();
    // echo $date->format('Y-m-d H:i:s');
    function getBulk(){

        $data['bulk'] = $this->CashierModel->getData('bulk');    
        
        echo($this->load->view("bulkTr", $data));
    }

    function saveBulk(){

        $tbl = 'bulk';
        $pk = 'bulk_id';

        $b = $this->checkID($tbl,$pk);

        $bulk = array(
            "bulk_id" => "bulk".date('Y')."-".$b,
            "bulk_name" => $this->input->post("bulk_name"),
            "bulk_cubic" => $this->input->post("bulk_cubic"),
            "bulk_amount" => $this->input->post("bulk_amount")
        );

        $response = $this->CashierModel->saveBulk($bulk);

        print_r(json_encode($response));
    }

    function editBulk(){

        $bulk = array(
            "bulk_id" => $this->input->post("bulk_id"),
            "bulk_name" => $this->input->post("bulk_name"),
            "bulk_cubic" => $this->input->post("bulk_cubic"),
            "bulk_amount" => $this->input->post("bulk_amount")
        );

        $tbl = 'bulk';
        $pk = 'bulk_id';

        $response = $this->CashierModel->doUpdate($tbl,$bulk,$pk);

        print_r(json_encode($response));
    }

    public function history(){


        if($this->uri->segment(3)):

            $custAccId = $this->uri->segment(3);
            $data['infos'] = $this->CashierModel->customerInfo($custAccId);
            
            if($data['infos'] != null):

                $data['payments'] = $this->CashierModel->getPaymentHistory($custAccId);

                $data['title'] = 'Cashier Dashboard';
                $data['modules'] = 'cashier';
                $data['sidebar']='sidebar/cashierSidebar';
                $data['main_content'] = 'history';
                echo Modules::run('template/main_content', $data);
            else:


            endif;
        endif;
    }

    public function ajax(){

        $data['title'] = 'AJAX Practice';
        $data['modules'] = 'cashier';
        $data['sidebar']='sidebar/cashierSidebar';
        $data['main_content'] = 'ajax';
        echo Modules::run('template/main_content', $data);

    }


    public function payment(){

        if($this->uri->segment(3)):

            $custAccId = $this->uri->segment(3);
            $data['infos'] = $this->CashierModel->customerInfo($custAccId);
            
            if($data['infos'] != null):


                if($this->input->post('type') == 22){
                    $config = array(
                        array(
                            'field' => 'ORnumber',
                            'label' => 'O.R. Number',
                            'rules' => 'required',
                            'errors' => array(
                                'required' => 'You must provide a %s.',
                            ),
                        ),
                        array(
                            'field' => 'amount',
                            'label' => 'amount',
                            'rules' => 'required',
                            'errors' => array(
                                    'required' => 'You must provide a %s.',
                            ),
                        ),
                        array(
                            'field' => 'DOP',
                            'label' => 'Date of payment',
                            'rules' => 'required',
                            'errors' => array(
                                    'required' => 'You must provide a %s.',
                            ),
                        ),
                        array(
                            'field' => 'month',
                            'label' => 'Month of Reading',
                            'rules' => 'required',
                            'errors' => array(
                                    'required' => 'You must provide a %s.',
                            ),
                        )
                    );
        
                    $this->form_validation->set_rules($config);
                    
                }
                else{
        
                    $config = array(
                        array(
                            'field' => 'ORnumber',
                            'label' => 'O.R. Number',
                            'rules' => 'required',
                            'errors' => array(
                                'required' => 'You must provide a %s.',
                            ),
                        ),
                        array(
                            'field' => 'amount',
                            'label' => 'amount',
                            'rules' => 'required',
                            'errors' => array(
                                    'required' => 'You must provide a %s.',
                            ),
                        ),
                        array(
                            'field' => 'DOP',
                            'label' => 'Date of Payment',
                            'rules' => 'required',
                            'errors' => array(
                                    'required' => 'You must provide a %s.',
                            ),
                        ),
        
                    );
        
                    $this->form_validation->set_rules($config);
        
                }
                
                $result = $this->CashierModel->getCustomerStatus($custAccId);
                
                $data['status'] = $result[0]->account_status_desc;
                $data['fees'] = $this->CashierModel->toPay($custAccId,$result[0]->account_status_desc);
                $data['readings'] = $this->CashierModel->monthlyReading($custAccId);
                
                
                if($result[0]->account_status_desc == 'Deactivate'){

                    $data["bill"] = $data['fees'][0]->application_fee + $data['fees'][0]->advance_payments + $data['fees'][0]->connection_fee;

                    
                    
                }
                
                if($result[0]->account_status_desc == 'Disconnected'){

                    // $data['records'] = $this->CashierModel->getRecords($custAccId);
                    // $data['payments'] = $this->CashierModel->payments($custAccId); 
                    // $data['OP'] = $this->CashierModel->getPenalty('penalty');


                    // // var_dump($data['payments']);
                    // // var_dump($data['records']);
                    // $arrears=0;
                    // foreach($data['records'] as $r => $record){
                    //     if($r != 0){
                    //         $con =  $record->reading_value - $prev;
                    //         echo $con;
                    //         echo "<br>";
                    //         $b = $this->calculateBill($data['records'][0]->account_type_code, $con);
                    //         $b += $b*.02;
                    //         $arrears += $b;
                    //         echo $arrears;
                    //         echo "<br>";
                    //     }
                        
                    //     $prev = $record->reading_value;

                        


                    // }

                }
            

                // var_dump($data['arrears']);
              
                

 



                


                
                if($this->form_validation->run() === FALSE):
                    
                    $data['types'] = $this->CashierModel->getSelection('payment_type');
                    $data['methods'] = $this->CashierModel->getSelection('payment_method');

                    

                    $data['title'] = 'Payment Form';
                    $data['modules'] = 'cashier';
                    $data['sidebar']='sidebar/cashierSidebar';
                    $data['main_content'] = 'payment';
                    echo Modules::run('template/main_content', $data);
                
                else:

                    // 
                    if($data['bill'] <= $this->input->post('amount')):
                        $validate = true;
                    else:
                        if($data['readings'][0]->admin_permission == 1):
                            $validate = true;
                        else:
                            $validate = false;
                        endif;
                    endif;




                    if($validate):

                        if($result[0]->account_status_desc != 'Active'):

                            switch ($result[0]->account_status_desc):
                                case 'Deactivate':
                                    $stat = '2';;
                                    break;
                                case 'Disconnected':
                                    $stat = '2';
                                    break;    
                                default:
                                    $stat = '2';
                                    break;
                            endswitch;

                            $tbl = 'account_status';
                            
                            $status = array(

                                'account_status_date' => $this->input->post('DOP'),
                                'customer_account_id' => $custAccId,
                                'account_status_type_id' => $stat,
                            );
                            
                            $response = $this->CashierModel->insertData($tbl, $status);

                            if($response['code'] != 201):

                                ?>
                                <script type="text/javascript">
                                    alert('Updating Status Failed');
                                    document.location = '<?php echo base_url('index.php/cashier/cashierDashboard') ?>';
                                </script>
                                <?php

                            endif;
                        else:
                            $stat = $result[0]->account_status_id;
                        endif;

                    
                        

                        // if monthly bill
                        if($this->input->post('type') == '22'):
                            
                            $date = $this->input->post('month');

                            $reading = $this->CashierModel->meterReading(nice_date($date,'m'), nice_date($date,'Y'),$custAccId);

                            $tbl = 'customer_bill_record';
                            $bill_record = array(
                                'cbrID' => 1,
                                'meter_reading_id' => $reading[0]->meter_reading_id,
                                'OR_number' => $this->input->post('ORnumber')

                            );

                            $this->CashierModel->insertData($tbl, $bill_record);

                        endif;
                        
                        $tbl = "customer_payment";
                        $payment = array(

                            'OR_number' => $this->input->post('ORnumber'),
                            'amount' => $this->input->post('amount'),
                            'payment_type_id' => $this->input->post('type'),
                            'payment_method_id' => $this->input->post('method'),
                            'payment_date' => $this->input->post('DOP'),
                            'customer_account_id' => $custAccId

                        );

                        $response = $this->CashierModel->insertData($tbl, $payment);

                        if($response['code'] == 201):
                            
                            ?>
                            <script type="text/javascript">
                                alert('Successfully Added');
                                document.location = '<?php echo base_url('cashier/history/').$custAccId?>';
                            </script>
                            <?php

                        else:

                            ?>
                            <script type="text/javascript">
                                alert('Inserting Payment Failed');
                                document.location = '<?php echo base_url('index.php/cashier/cashierDashboard') ?>';
                            </script>
                            <?php

                        endif;

                    
                    else:
                        
                        ?>
                        <script type="text/javascript">
                            alert('Contact the admin to allow permission');
                            document.location = '<?php echo base_url('cashier/payment/').$custAccId?>';
                        </script>
                        <?php

                    endif;

                endif;

            else:

            

            endif;

        endif;
    }

    function ts(){
        $date = date("Y-m-d H:i:s");
        // echo $date;
        $r =$this->CashierModel->monthlyReading("20205212212020-POB");
        print_r($r);
    }


    function doPay(){

        $acc_status = $this->input->post("acc_status");

        if($this->input->post("payment_type_id") == 11):
            if($acc_status == "Deactivate"):

                $payment = array(

                    "OR_number" => $this->input->post("or_number"),
                    "amount" => $this->input->post("amount"),
                    "payment_type_id" => $this->input->post("payment_type_id"),
                    "payment_method_id" => $this->input->post("payment_method_id"),
                    "payment_date" => $this->input->post("payment_date"),
                    "customer_account_id" => $this->input->post("account_id")
                );

                $tbl = "customer_payment";
                $response = $this->CashierModel->doInsert($tbl, $payment);

                if($response):
                    
                    $acc_stat = array(
                        "account_status_date" => date("Y-m-d H:i:s"),
                        "account_status_type_id" => 2,
                        "customer_account_id" => $this->input->post("account_id")
                    );


                    $tbl = "account_status";
                    $response = $this->CashierModel->doInsert($tbl, $acc_stat);

                    if($response):
                        print_r(json_encode(array("msg" => "Successful")));
                    else: 
                        print_r(json_encode(array("msg" => "Server Error")));
                    endif;
                else: 
                    print_r(json_encode(array("msg" => "Server Error")));
                endif;
            else:
                print_r(json_encode(array("msg" => "This Account is already registered")));
            endif;
        else:

            $data['readings'] = $this->CashierModel->monthlyReading($this->input->post("account_id"));
            
            if($data['readings'] != null && count($data['readings']) != 1):

                $cons = $data['readings'][0]->reading_value - $data['readings'][1]->reading_value;

                $totalBill = $this->calculateBill($data['readings'][0]->account_type_code,$cons);

                $data['fees'] = $this->CashierModel->toPay($this->input->post("account_id"),"Active");

               
                // getting Arrears 
                $data['records'] = $this->CashierModel->getRecords($this->input->post("account_id"));
                $data['payments'] = $this->CashierModel->payments($this->input->post("account_id")); 
                $data['OP'] = $this->CashierModel->getPenalty('penalty');

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

                
                $totalBill += round($data["arrears"] + $data["arrears"] * $data['OP'][0]->op_value,2);

                

                if($acc_status == "Active"):

                    if($totalBill <= $this->input->post('amount')):
                        $validate = true;
                    else:
                        if($data['readings'][0]->admin_permission == 1):
                            $validate = true;
                        else:
                            $validate = false;
                        endif;
                    endif;
                    
                    if($validate):
                        $payment = array(

                            "OR_number" => $this->input->post("or_number"),
                            "amount" => $this->input->post("amount"),
                            "payment_type_id" => $this->input->post("payment_type_id"),
                            "payment_method_id" => $this->input->post("payment_method_id"),
                            "payment_date" => $this->input->post("payment_date"),
                            "customer_account_id" => $this->input->post("account_id")
                        );

                        $tbl = "customer_payment";
                        $response = $this->CashierModel->doInsert($tbl, $payment);

                        if($response):
                            
                            $acc_stat = array(
                                "account_status_date" => date("Y-m-d H:i:s"),
                                "account_status_type_id" => 2,
                                "customer_account_id" => $this->input->post("account_id")
                            );


                            $tbl = "account_status";
                            $response = $this->CashierModel->doInsert($tbl, $acc_stat);

                            if($response):
                                
                                $rDate = $this->input->post("reading_month");
                                $reading = $this->CashierModel->meterReading(nice_date($rDate,'m'), nice_date($rDate,'Y'),$this->input->post("account_id"));

                                if($reading != null):

                                    
                                    
                                    $bill_record = array(
                                        'cbrID' => 1,
                                        'meter_reading_id' => $reading[0]->meter_reading_id,
                                        'OR_number' => $this->input->post("or_number")

                                    );

                                    $tbl = 'customer_bill_record';

                                    $response = $this->CashierModel->doInsert($tbl, $bill_record);
                                    
                                    if($response):
                                        print_r(json_encode(array("msg" => "Successful")));
                                    else: 
                                        print_r(json_encode(array("msg" => "Server Error")));
                                    endif;
                                endif;
                            endif;
                        endif;
                    else:
                        
                        print_r(json_encode(array("msg" => "Contact the admin to allow permission")));
        
                    endif;

                elseif($acc_status == "Disconnected"):
                    $data['reconn'] = $this->CashierModel->getPenalty('Reconnection fee');
                    $totalBill += $data['reconn'][0]->op_value;

                    // print_r(json_encode(array("msg" => $totalBill)));

                    if($totalBill <= $this->input->post('amount')):
                        $payment = array(

                            "OR_number" => $this->input->post("or_number"),
                            "amount" => $this->input->post("amount"),
                            "payment_type_id" => $this->input->post("payment_type_id"),
                            "payment_method_id" => $this->input->post("payment_method_id"),
                            "payment_date" => $this->input->post("payment_date"),
                            "customer_account_id" => $this->input->post("account_id")
                        );

                        $tbl = "customer_payment";
                        $response = $this->CashierModel->doInsert($tbl, $payment);

                        if($response):
                            
                            $acc_stat = array(
                                "account_status_date" => date("Y-m-d H:i:s"),
                                "account_status_type_id" => 5,
                                "customer_account_id" => $this->input->post("account_id")
                            );


                            $tbl = "account_status";
                            $response = $this->CashierModel->doInsert($tbl, $acc_stat);

                            if($response):
                                
                                $rDate = $this->input->post("reading_month");
                                $reading = $this->CashierModel->meterReading(nice_date($rDate,'m'), nice_date($rDate,'Y'),$this->input->post("account_id"));

                                if($reading != null):

                                    $bill_record = array(
                                        'cbrID' => 1,
                                        'meter_reading_id' => $reading[0]->meter_reading_id,
                                        'OR_number' => $this->input->post("or_number")

                                    );

                                    $tbl = 'customer_bill_record';

                                    $response = $this->CashierModel->doInsert($tbl, $bill_record);
                                    
                                    if($response):
                                        print_r(json_encode(array("msg" => "Successful")));
                                    else: 
                                        print_r(json_encode(array("msg" => "Server Error")));
                                    endif;
                                endif;
                            endif;
                        endif;
                    else:
                        print_r(json_encode(array("msg" => "Not enough payment!!! \r\n Total Fee is ". $totalBill)));
                    endif;

                endif; 
            else:
                        
                print_r(json_encode(array("msg" => "No Records Avaible")));
  
            endif;
        endif;
        
        // if($type == 11):
        //     if($status == "Active"):
        //         //check payment amount
        //         //insert customer_payment
        //         //insert customer_bill
        //         //update status to Active
        //     else:
        //         //Your account is already Active
        //     endif;
        // else: 
        //     if($status == "Active"):
        //         //check payment amount
        //         if($permission):
        //             //check permssion
        //         endif;

        //         if(true):
        //             //insert customer_payment
        //             //insert customer_bill
        //         endif;
        //     elseif($status == "For Disconnecton"):
        //         //check payment amount
        //         //insert customer_payment
        //         //insert customer_bill
        //         //update status to Active
        //     elseif($status == "Disconnected"):
        //         //full payment with reconn fee
        //         //insert customer_payment
        //         //insert customer_bill
        //         //update status to For Reconnection
        //     endif;
        // endif;



    }

    public function calculateBill($type,$consumed){

        $data['UserPayment'] = $this->CashierModel->calBill($type);
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
                    
                    $total += $subcon * $value->account_type_price;	
                    
                    $remaining -= $subcon;
                    
                    $prevTo = $value->cubic_range_to;
                            
                }
            
            }
		
		}
	
		return $total;

    }

    public function sampleAjax(){
        $response = $this->CashierModel->getAllCustomer();

        echo json_encode($response);



    }


    public function sample(){

        // $data['readings'] = $this->CashierModel->monthlyReading('20200067462020-LGO');

        $data['records'] = $this->CashierModel->getRecords('20200067462020-LGO');
        $data['payments'] = $this->CashierModel->payments('20200067462020-LGO'); 
        $data['OP'] = $this->CashierModel->getPenalty('penalty');

        $month = 0;

        $cp = count($data['payments'])-1;
        
        foreach($data['records'] as $rec){

            foreach($data['payments'] as $p => $payment){

                if($rec->date_of_reading == $payment->date_of_reading){
                    echo "nag bayad tas na reset ang month ".$rec->date_of_reading;
                    echo "<br>";
                    $month = 0;
                    break;
                }
                else{
                    if($cp == $p){
                        $month++;
                    }
                }
            } 
            $date = $rec->date_of_reading;

        }   
        echo $month;

                                                         //Date now
        if(date('Y-m-d', strtotime($date. ' + 3 days')) <= "2020-09-23" ){
            echo "<br>";
            echo "For Disconnection na";
            echo "<br>";
            echo "RUN the script";
        }


        $p1 = 'guilaran';
        $p2 = 'sample';

        // $p1h =password_hash($p1, PASSWORD_DEFAULT, ['cost' => 8]);
    
                
        // $due = '2020-9-8';
        // $days = $this->CashierModel->getDueDate('');
        // echo $days;
        // echo '<br>';
        // echo date('Y-m-d', strtotime($due. ' + '.$days.' days'));

    }


    public function workingDays($date, $dd){

        // $sd = '2020-08-20'; 
        $d1 = date('Y-m-d', strtotime($date. ' + 1 days'));     
        $due_date = $dd;
        $holiday = $this->CashierModel->getHoliday(date('m', strtotime($date)));
        
        $i=1;

        while ($i <= $due_date) {

            if(date('m', strtotime($date)) != date('m', strtotime($d1))){
                $holiday = $this->CashierModel->getHoliday(date('m', strtotime($d1)));
                
            }

            if($this->isWeekend($d1)){
                
                // echo 'weekends'.$d1;
                // echo '<br>';
                $d1 = date('Y-m-d', strtotime($d1. ' + 1 days'));
                
            }

            else{

                if(!empty($holiday)){
                    $ch = count($holiday)-1;
                    foreach($holiday as $h => $hdate){
                        if($d1 == $hdate->holiday_date){
                            // echo 'holiday'.$d1;
                            // echo '<br>';
                            $d1 = date('Y-m-d', strtotime($d1. ' + 1 days'));
                            break;
                        }
                        else{

                            if($ch == $h){
                                // echo 'woring day - '.$d1;
                                // echo '<br>';
                                $d2 = $d1;
                                $d1 = date('Y-m-d', strtotime($d1. ' + 1 days'));
        
                                $i++;

                            }
                        }
                    }
                }
                else{

                    // echo 'working day - '.$d1;
                    // echo '<br>';
                    $d2 = $d1;
                    $d1 = date('Y-m-d', strtotime($d1. ' + 1 days'));

                    $i++;

                }     
            }

        }
        // echo '<br>';
        // echo 'due date - '.$d2;

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

    function updateOr(){

        $payment = array(
            'OR_number' => $this->input->post('or_num'),
            'amount' => $this->input->post('p_amount'),
            'payment_date' => $this->input->post('p_date'),
        );
        $tbl = "customer_payment";
        $pk = "OR_number";

        $response = $this->CashierModel->doUpdate($tbl,$payment,$pk);


        print_r(json_encode($response));
    }



    public function checkID($table, $pkeyName){

        $checkID = false;
        while($checkID == false){
            $id = $this->idGenerator();
            $checkID = $this->CashierModel->idChecker($table, $pkeyName, $id);
        }

        return $id;

    }


    public function idGenerator()
    {

    	// $date = date('Y');
		$uid = '';

		while (	strlen($uid) != 6 ) {
			$uid .= strval(rand(0,9));
		}

		return $uid;
    }
}
