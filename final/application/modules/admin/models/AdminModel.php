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
            return $response = array( 'msg' => 'Server Error' );
            

        }
    }


    public function getData($tbl){

        $query = $this->db->get($tbl);
        return $query->result();

    }

    function getAccount($id){

        $this->db->select("*");
        $this->db->from("account");
        $this->db->join("user_type", "account.user_type_id = user_type.user_type_id");
        $this->db->where('account.accId', $id);

        $query = $this->db->get();
        return $query->result();

    }

    function getProfile($id){

        $this->db->select("*");
        $this->db->from("employee_profile");
        $this->db->join("emp_address", "employee_profile.emp_id = emp_address.emp_id");
        $this->db->where('accId', $id);

        $query = $this->db->get();
        return $query->result();

    }

    function getWhereEmployee($stat){
        
        $this->db->select('*');
        $this->db->from('account');
        $this->db->join('user_type', 'account.user_type_Id = user_type.user_type_Id');
        $this->db->where('is_verified', $stat);

        $query = $this->db->get();
        return $query->result();
    }


    function saveEmployee($emp,$tbl){
        
        if ($this->db->insert($tbl, $emp)) {
            return TRUE;
            
    
        }
        else{
            return $response = array( 'msg' => 'Server Error' );
            

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

    function verified($acc){

        $this->db->where('accId', $acc['accId']);

        if ($this->db->update('account', $acc )) {
            return $response = array( 'msg' => 'success' );
        }
        else{
            return $response = array( 'msg' => 'Server Error' );
        }
    }


    function doInsert($tbl, $holi){

        if ($this->db->insert($tbl, $holi)) {
            return TRUE;
        }
        else{
            return $response = array( 'msg' => 'Server Error' );
        }

    }

    function getHoliday(){
        
        $this->db->order_by("holiday_date","ASC");

        $query = $this->db->get("holiday");
        return $query->result();

    }


    
    function getCubicRates($type){

        $this->db->select("*");
        $this->db->from("cubic_range");
        $this->db->join("account_type_fees", "cubic_range.cubic_range_id = account_type_fees.cubic_range_id");
        $this->db->join("account_type", "account_type_fees.account_type_code = account_type.account_type_code");
        $this->db->order_by("cubic_range_from", "asc");
        $this->db->where("account_type_desc", $type);

        $query = $this->db->get();
        return $query->result();

    }
    


    function doUpdate($tbl,$data,$pk){

        $this->db->where($pk, $data[$pk]);

        if ($this->db->update($tbl, $data )) {
            return $response = array( 'msg' => 'success' );
    
        }
        else{
            return $response = array( 'msg' => 'Server Error' );

        }
    }


    function doDelete($id,$pk, $tbl){

        $this->db->where($pk, $id);
        $res = $this->db->delete($tbl);
        if ($res) {
            return $response = array( 'msg' => 'success' );
    
        }
        else{
            return $response = array( 'msg' => 'Server Error' );

        }
    }












}