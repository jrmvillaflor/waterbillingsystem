<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdminModel extends CI_Model {


    public function getAllCustomer($status){

        $query = $this->db->query('
			
        SELECT *
        FROM customer_account custAcc
        JOIN account_type as type on type.account_type_code = custAcc.account_type_code
        JOIN customer as cust on cust.customer_id = custAcc.customer_id
        JOIN (
            SELECT accStat.* 
            FROM account_status accStat
            JOIN (
                SELECT customer_account_id, MAX(account_status_date) as account_status_date
                FROM account_status as stat
                GROUP BY stat.customer_account_id
            ) AS MaxStat on MaxStat.account_status_date = accStat.account_status_date
            AND accStat.customer_account_id = MaxStat.`customer_account_id`
        ) as accStat on accStat.customer_account_id = custAcc.customer_account_id
        JOIN account_status_type as accType on accType.account_status_type_id = accStat.account_status_type_id
        WHERE accType.account_status_desc = "'.$status.'"

        ');

        return $query->result();

    }

    public function custPersmission($info){

        $this->db->where('customer_account_id', $info["customer_account_id"]);

        if ($this->db->update('customer_account', $info)) {
            return $response = array( 'msg' => 'success' );
            
    
        }
        else{
            return $response = array( 'msg' => 'Operation failed' );
            

        }
    }


    public function getData($tbl){

        $query = $this->db->get($tbl);

        return $query->result();

    }


    function saveEmployee($emp){
        
        if ($this->db->insert('account', $emp)) {
            return $response = array( 'msg' => 'success' );
            
    
        }
        else{
            return $response = array( 'msg' => 'Operation failed' );
            

        }


    }
    // function verified($id){

    //     $this->db->where('accId', $id);

    //     if ($this->db->update('account', array('is_verified' => 1) )) {
    //         return $response = array( 'msg' => 'success' );
            
    
    //     }
    //     else{
    //         return $response = array( 'code' => 'Operation failed' );
            

    //     }
    // }










}