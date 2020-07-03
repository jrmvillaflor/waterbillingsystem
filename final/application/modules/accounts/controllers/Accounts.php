<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('AccountsModel');
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
        
        }
    }
	
    
    public function newCustomer(){

        $data['customers'] = $this->AccountsModel->getPendingCustomer(); 

        $data['title'] = 'Accounts Dashboard';
        $data['modules'] = 'accounts';
        $data['sidebar']='sidebar/accountsSidebar';
        $data['main_content'] = 'newCustomer';
        echo Modules::run('template/main_content', $data);

        // var_dump($data['customers'] );

    } 

    public function customerAccount(){

        $data['accounts'] = $this->AccountsModel->getPendingAccounts('review_customer'); 


        $data['title'] = 'Accounts Dashboard';
        $data['modules'] = 'accounts';
        $data['sidebar']='sidebar/accountsSidebar';
        $data['main_content'] = 'customerAccount';
        echo Modules::run('template/main_content', $data);

    }


    public function review(){

        $cust =$this->AccountsModel->getCust('review_customer','review_customer_id',$this->input->post('id'));

        if($cust!=null):
            $revStat = array(

                'review_customer_id' => $this->input->post('id'),
                'review_status_id' => $this->input->post('status')
            );  

            $response = $this->AccountsModel->updateCust('review_customer','review_customer_id',$revStat);

            if($response['code'] == 201):
                
                $tbl = 'customer';
                $pk = 'customer_id';
                $customer_id = $this->checkID($tbl, $pk);

                $customer = array(
                    'customer_id' => $customer_id,
                    'first_name' => $cust[0]->firstname,
                    'last_name' => $cust[0]->lastname,
                    'contactNo' => $cust[0]->contactNo,
                );

                $response = $this->AccountsModel->insertData($tbl, $customer);
                
                if($response['code'] == 201):
                    
                    
                    $tbl = 'customer_account';
                    $customer_account_id = $customer_id.date('m').'-'.$cust[0]->brgy_code;

                    $customer_account = array(

                        'customer_account_id' => $customer_account_id,
                        'customer_id' => $customer_id,
                        'account_type_code' => $cust[0]->type_code,
                        'admin_permission' => 0
                    );

                    $response = $this->AccountsModel->insertData($tbl, $customer_account);
                    
                    if($response['code'] == 201):

                        $tbl = 'customer_account_address';
                        $customer_address = array(

                            'customer_address_id' => $customer_account_id,
                            'street_building' => $cust[0]->street,
                            'municipality' => $cust[0]->municipality,
                            'zip_postcode' => 1980,
                            'customer_account_id' => $customer_account_id,
                            'brgy_id' => $cust[0]->brgy_id
                        );

                        $response = $this->AccountsModel->insertData($tbl, $customer_address);

                        if($response['code'] == 201):
                            
                            $tbl = 'account_status';
                            
                            $date = new DateTime();
                            
                            $account_status = array(

                                'account_status_date' => $date->format('Y-m-d H:i:s'),
                                'customer_account_id' => $customer_account_id,
                                'account_status_type_id' => 1,

                            );

                            $response = $this->AccountsModel->insertData($tbl, $account_status);
                            
                            if($response['code'] == 201):
                                
                                ?>
                                <script type="text/javascript">
                                    alert('Successfully Added');
                                    document.location = '<?php echo base_url('accounts/newCustomer') ?>';
                                </script>
                                <?php

                            endif;
                        endif;
                    endif;
                endif;
            else: 
                ?>
                    <script type="text/javascript">
                        alert('Inserting Failed');
                        document.location = '<?php echo base_url('accounts/newCustomer') ?>';
                    </script>
                <?php
            endif;
        endif;
    }




    public function accReview(){

        $details =$this->AccountsModel->getCust('review_account','review_account_id',$this->input->post('id'));

        $status = array(

            'review_account_id' => $this->input->post('id'),
            'review_status_id' => $this->input->post('status')

        );

        $response = $this->AccountsModel->updateCust('review_account','review_account_id',$status);

        if($response['code'] == 201):
                                
            $tbl = 'customer_account';
            $customer_account_id = $details[0]->customer_id.date('m').'-'.$details[0]->brgy_code;

            $customer_account = array(

                'customer_account_id' => $customer_account_id,
                'customer_id' => $details[0]->customer_id,
                'account_type_code' => $details[0]->type_code
            );

            $response = $this->AccountsModel->insertData($tbl, $customer_account);

            if($response['code'] == 201):
                
                $tbl = 'customer_account_address';
                
                $customer_address = array(

                    'customer_address_id' => $customer_account_id,
                    'street_building' => $details[0]->street,
                    'municipality' => $details[0]->municipality,
                    'zip_postcode' => $details[0]->zipcode,
                    'customer_account_id' => $customer_account_id,
                    'brgy_id' => $details[0]->brgy_id
                );

                $response = $this->AccountsModel->insertData($tbl, $customer_address);

                if($response['code'] == 201):

                    $tbl = 'account_status';

                    $account_status = array(

                        'account_status_date' => $this->getTimeStamp(),
                        'customer_account_id' => $customer_account_id,
                        'account_status_type_id' => 1,

                    );

                    $response = $this->AccountsModel->insertData($tbl, $account_status);
                    
                    if($response['code'] == 201):
                                
                        ?>
                        <script type="text/javascript">
                            alert('Successfully Added');
                            document.location = '<?php echo base_url('accounts/customerAccount') ?>';
                        </script>
                        <?php

                    endif;

                endif;


            endif;


        endif;
        
    }





    public function checkID($table, $pkeyName){

        $checkID = false;
        while($checkID == false){
            $acc_id = $this->idGenerator();
            $checkID = $this->AccountsModel->idChecker($table, $pkeyName, $acc_id);
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

    public function getTimeStamp()
    {
        date_default_timezone_set('Asia/Manila');
        $date = new DateTime();
        return $date->format('Y-m-d');
    }


    public function sample(){

        $id = 1;

        $tbl = 'review_account';
        $pk ='review_account_id';

        $details =$this->AccountsModel->getCust($tbl,$pk,$id);

        $customer_account_id = $details[0]->customer_id.date('m').'-'.$details[0]->brgy_code;

        var_dump($details);
    }
  
    
}
