<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends Admin {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //get currency
        $this->data['currencies'] = array(array('id'=>'USD','name'=>'Dolla.Us'),array('id'=>'VND','name'=>'VN Dong'));
        $this->load->view('admin/header', $this->data);
        $this->load->view('admin/general', $this->data);
        $this->load->view('admin/footer', $this->data);
    }

    public function save()
    {
        if (!empty($_POST)) {
            $this->general_model->save();

            $this->session->set_flashdata('success', $this->lang->line('general_save_success'));
        }
        redirect('admin/general');
    }
}
