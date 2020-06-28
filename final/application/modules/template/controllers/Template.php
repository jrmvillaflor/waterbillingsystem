<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MY_Controller {

    function __construct()
    {
        parent::__construct();


    }
	

    public function header($title){
 
        $data['title'] = $title;
        $this->load->view('header', $data);
 
    }

     
    


    public function main_content($data){

        $this->load->view('main_content', $data);

    }


    public function footer(){

        $this->load->view('footer');

    }
    
}
