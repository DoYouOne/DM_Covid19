<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Covid extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('m_covid');
    }
    
	public function index(){
        $data['dc'] = $this->m_covid->all()->result();
        $data['co'] = $this->m_covid->hitung();
		$this->load->view('home', $data);
	}

    public function perbarui(){
        $country    = $this->input->post('country');
        $infected   = $this->input->post('infected');
        $tested     = $this->input->post('tested');
        $recovered  = $this->input->post('recovered');
        $deceased   = $this->input->post('deceased');
        $result = array();
            foreach ($_POST['country'] as $key => $val) {
                $result[] = array(             
                    'country'    => $_POST['country'][$key],
                    'infected'   => $_POST['infected'][$key],
                    'tested'     => $_POST['tested'][$key],
                    'recovered'  => $_POST['recovered'][$key],       
                    'deceased'   => $_POST['deceased'][$key]
                );      
            }

        $jmlh = $this->m_covid->hitung();
        if($jmlh > 0){
            //query update
            $this->m_covid->del_all($result);
        } else{
            //query insert batch     
            $this->m_covid->insert($result);
            // var_dump($data);
            // die();
        }
        redirect(base_url());
    }
}
