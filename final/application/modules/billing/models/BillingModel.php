<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BillingModel extends CI_Model {

    public function getdata($table){

        $query = $this->db->get($table);
        return $query->result();

    }

    public function insertData($tbl, $data){

        if($this->db->insert($tbl, $data)){
            return $response = array('code' => 201);
        }
        else{
            return $response = array('code' => 500);
        }
    }

    public function getAllCustomer(){

        $query = $this->db->query('
			
        SELECT *
        FROM customer_account custAcc
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
        WHERE accType.account_status_desc = "Active"

        ');

        return $query->result();

    }

    public function getCustomerStatus($id){

		$query = $this->db->query('
			
			SELECT * 
			FROM account_status accStat
			JOIN account_status_type AS ast on ast.account_status_type_id = accStat.account_status_type_id
			JOIN (
				SELECT customer_account_id, MAX(account_status_date) as account_status_date
				FROM account_status
				GROUP BY customer_account_id
			) AS MaxStat on MaxStat.account_status_date = accStat.account_status_date
			AND accStat.customer_account_id = MaxStat.customer_account_id
			WHERE accStat.customer_account_id = "'.$id.'"
        
        ');

        return $query->result();

    }


    public function customerInfo($id){

        $this->db->select('*');
        $this->db->from('customer');
        $this->db->join('customer_account', 'customer.customer_id = customer_account.customer_id');
        $this->db->join('customer_account_address', 'customer_account.customer_account_id = customer_account_address.customer_account_id');
        $this->db->join('barangay', 'customer_account_address.brgy_id = barangay.brgy_id');
        $this->db->join('account_type', 'customer_account.account_type_code = account_type.account_type_code');
        $this->db->where('customer_account.customer_id', $id);
        
        $query = $this->db->get();
        return $query->result();
    }


    public function getCustomer($id){

        $this->db->select('*');
        $this->db->from('customer');
        $this->db->join('customer_account', 'customer.customer_id = customer_account.customer_id');
        $this->db->where('customer.customer_id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAccounts($id){
        
        $this->db->select('*');
        $this->db->from('customer_account');
        $this->db->join('account_type', 'customer_account.account_type_code = account_type.account_type_code');
        $this->db->where('customer_account.customer_id', $id);
        $query = $this->db->get();
        return $query->result();
    }


    public function getRecords($id){

        $this->db->select('*');
        $this->db->from('customer_account');
        $this->db->join('meter_reading', 'customer_account.customer_account_id = meter_reading.customer_account_id');
        $this->db->join('account_type', 'customer_account.account_type_code = account_type.account_type_code');
        $this->db->where('customer_account.customer_account_id', $id);
        

        $query = $this->db->get();
        return $query->result();

    }

    public function calBill($code){

		$this->db->select('*');
    	$this->db->from('account_type');
    	$this->db->join('account_type_fees', 'account_type.account_type_code = account_type_fees.account_type_code');
    	$this->db->join('cubic_range', 'account_type_fees.cubic_range_id = cubic_range.cubic_range_id');
        $this->db->order_by('cubic_range.cubic_range_id', 'asc');
        

        $this->db->where('account_type.account_type_code', $code);
        
        $query = $this->db->get();
        return $query->result();
    }
    

    public function payments($id){

        $this->db->select('*');
        $this->db->from('customer_payment');
        $this->db->join('customer_bill_record', 'customer_payment.OR_number = customer_bill_record.OR_number');
        $this->db->join('meter_reading', 'meter_reading.meter_reading_id = customer_bill_record.meter_reading_id');
        $this->db->where('customer_payment.customer_account_id',$id);
    
        $query = $this->db->get();
        return $query->result();
        // foreach ($query->result() as $row) {
        //     return $row;
        // }

    }


    public function getReadings($id){

        $this->db->where('customer_account_id', $id);

        $query = $this->db->get('meter_reading');
        return $query->result();
    }


    public function getPenalty($name){

        $this->db->where('op_desc',$name);

        $query = $this->db->get('other_payment');
        return $query->result();
        
    }

    public function monthlyReading($id){

        $this->db->select('*');
        $this->db->from('customer_account');
        $this->db->join('meter_reading', 'customer_account.customer_account_id = meter_reading.customer_account_id');
        $this->db->order_by('date_of_reading', 'desc');
        $this->db->limit(2);

        $this->db->where('customer_account.customer_account_id', $id);

        $query = $this->db->get();
        return $query->result();
    }


    public function getholiday($month){

        $query = $this->db->query('
			
            SELECT holiday_date
            FROM holiday
            WHERE MONTH(holiday_date) = "'.$month.'" 
    
        ');
    
        return $query->result();
        
    }

    public function getDueDate($name){
        
        $this->db->where('due_desc', $name);

        $query = $this->db->get('due_dates');
        return $query->result();
    }


    public function toPay($id,$status){

        if($status == 'Deactivate'){
            $this->db->select('*');
            $this->db->from('registration_fees');
            $this->db->join('account_type', 'registration_fees.account_type_code = account_type.account_type_code');
            $this->db->join('customer_account', 'account_type.account_type_code = customer_account.account_type_code');

        }else{
            $this->db->select('*');
            $this->db->from('account_type_fees');
            $this->db->join('account_type', 'account_type_fees.account_type_code = account_type.account_type_code');
            $this->db->join('cubic_range', 'account_type_fees.cubic_range_id = cubic_range.cubic_range_id');
            $this->db->join('customer_account', 'account_type.account_type_code = customer_account.account_type_code');  
            $this->db->join('meter_reading', 'meter_reading.customer_account_id = customer_account.customer_account_id');

        }

        $this->db->where('customer_account.customer_account_id', $id);

        $query = $this->db->get();
        return $query->result();

    }






}