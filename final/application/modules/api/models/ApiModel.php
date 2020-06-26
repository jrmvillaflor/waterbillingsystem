<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ApiModel extends CI_Model {

    
    public function getData(){

        $this->db->select('*');
        $this->db->from('customer');
        $this->db->join('customer_account', 'customer.customer_id = customer_account.customer_id');

        $query = $this->db->get();

        return $query->result();
    }
    
    public function getWhere($pkey,$data){
        
        if($pkey == 'meter_reading_id'){
            $this->db->select('*');
            $this->db->from('meter_reading');
            $this->db->where($pkey, $data);
        }
        else{

            $this->db->select('*');
            $this->db->from('customer');
            $this->db->join('customer_account', 'customer.customer_id = customer_account.customer_id');
            $this->db->where('customer_account.'.$pkey, $data);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function postData($table,$data){

        if ($this->db->insert($table, $data)) {
            $response = array('code' => 201);
            $response['msg'] = 'Successfully added.';

            return $response;
        }else{

            $response['msg'] = 'Server Error';

            return $response;
        }
    }



}