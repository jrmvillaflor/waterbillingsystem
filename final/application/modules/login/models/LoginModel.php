<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LoginModel extends CI_Model {


    public function checkUser($username, $password){
        
        $this->db->where('email', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('account');
        
        if($query->num_rows()>0):            
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    public function getUserAccount($username){

        $this->db->where('email', $username);
        $query = $this->db->get('account');
        return $query->row();
    }

    





}