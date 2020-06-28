<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('ApiModel');

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
          default:
            redirect('login');
        }

    }

    public function index(){

        $method = $this->input->server('REQUEST_METHOD');

        if ($method == 'GET') {
            $this->doGet();
        } 
        elseif ($method == 'POST') {
            $this->doPost();
        } 
        elseif ($method == 'DELETE') {
            $this->doDelete();
        } 
        elseif ($method == 'OPTIONS') {
            $this->output->set_header('Allow: GET,POST,DELETE,OPTIONS');
        } 
        else {
            $this->output->set_status_header(405);
        }
        
    }


    public function doGet(){

        // echo "GET Request Success";

        //
        $data = $this->input->get();

        if(isset($data['customer_id'])){
            echo 'naa sulod ang data';
            $pkey = 'customer_id';
            $response = $this->ApiModel->getWhere($pkey,$data[$pkey]);
        }
        elseif(isset($data['customer_account_id'])){

            $pkey = 'customer_account_id';
            $response = $this->ApiModel->getWhere($pkey,$data[$pkey]);
        }
        else{
            $keyword = false;
            if (isset($data['keyword'])) {
                $keyword = $data['keyword'];
            }
            var_dump('sulod sa '.$keyword );
            $response = $this->ApiModel->getData();
        }

        $response['code'] = 200;
        return $this->json_format($response);
    
    }

    
    public function doPost(){
        
        $data = $this->input->post();

        if(isset($data['meter_reading_id']) && !empty($data['meter_reading_id'])){

            $pkey = 'meter_reading_id';
            
            if($this->ApiModel->getWhere($pkey,$data[$pkey])){

                echo json_encode(array('msg' => 'update data'));

            }else{

                // echo (json_encode($data));
                $response = $this->ApiModel->postData('meter_reading', $data);

                return $this->json_format($response);

            }
        }else{

            echo json_encode(array('msg' => 'post data'));
            
        }

    }
    


    private function json_format($response)
    {
        return $this->output
          ->set_status_header($response['code'])
          ->set_content_type('application/json')
          ->set_output(json_encode($response));
    }
    


}