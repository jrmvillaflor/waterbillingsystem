<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AccountsModel extends CI_Model {

    public function getPendingCustomer(){

        $this->db->select('*');
        $this->db->from('review_customer');
        $this->db->join('barangay', 'review_customer.brgy_id = barangay.brgy_id');
        $this->db->join('review_status','review_customer.review_status_id = review_status.review_status_id');
        $this->db->where('review_status.review_status_id', 1);
        $query = $this->db->get();
        return $query->result();

    }

    public function getPendingAccounts(){

        $this->db->select('*');
        $this->db->from('review_account');
        $this->db->join('customer', 'review_account.customer_id = customer.customer_id');
        $this->db->join('barangay', 'review_account.brgy_id = barangay.brgy_id');
        $this->db->join('account_type', 'review_account.type_code = account_type.account_type_code');
        $this->db->join('review_status','review_account.review_status_id = review_status.review_status_id');
        $this->db->where('review_status_desc', 'Pending');
        $query = $this->db->get();
        return $query->result();

    }


    public function updateCust($tbl,$pk,$info){

        $this->db->where($pk, $info[$pk]);

        if ($this->db->update($tbl, $info)) {
            $response = array( 'code' => 201 );
            
            return $response;
        }
        else{
            $response = array( 'code' => 500 );
            
            return $response;
        }
    }


    public function getCust($table,$pk,$id){

        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('barangay', $table.'.brgy_id = barangay.brgy_id');
        $this->db->where($pk, $id);
        $query = $this->db->get();
        return $query->result();
    }



    public function insertData($table, $data){

        if($this->db->insert($table , $data)){
            return $response = array('code' => 201);
        }
        else{
            return $response = array( 'code' => 500 );
             
        }
    }




    public function idChecker($tbl, $pk, $id){
        $this->db->select($pk);
        $this->db->from($tbl);
        $this->db->where($pk, $id );
        $query = $this->db->get()->result();
        
        if($query == null && $query != 0){
            return true;
        }
        else{
            return false;
        }
    }

}