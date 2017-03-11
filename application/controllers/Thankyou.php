<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thankyou extends Frontend
{

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$this->session->unset_userdata('cart');
		$this->load->view('partials/headerHome', $this->data);
		$this->load->view('success', $this->data);
		$this->load->view('partials/footerHome', $this->data);
	}
}
