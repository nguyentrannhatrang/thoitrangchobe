<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Frontend
{

    public function __construct()
    {
        parent::__construct();
    }

    public function profile()
    {
        $this->load->view('partials/header', $this->data);
        $this->load->view('profile', $this->data);
        $this->load->view('partials/footer', $this->data);
    }

    public function comment()
    {
        if (!empty($_POST)) {
            if ($this->comment_model->insert()) {
                $this->session->set_flashdata('success', 'our comment has been successfully.');
            } else {
                $this->session->set_flashdata('error', 'There was an error. Your comment could not be added. Please try later.');
            }
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function login()
    {
        if (!empty($_POST)) {
            if ($this->user_model->login()) {
                $this->session->set_flashdata('success', 'You have been successfully logged in.');
                redirect('/');
            } else {
                $this->session->set_flashdata('error', 'Please check data');
                redirect('user/login');
            }
        } else {
            $this->load->view('partials/header', $this->data);
            $this->load->view('login', $this->data);
            $this->load->view('partials/footer', $this->data);
        }
    }

    public function register()
    {
        if (!empty($_POST)) {
            if ($this->user_model->register()) {
                $this->session->set_flashdata('success', 'ongratulations, you have successfully been registered.');
                redirect('user/profile');
            } else {
                $this->session->set_flashdata('error', 'This email is already in the database. Please use another email address.');
                redirect('user/login');
            }
        }
    }

    public function send(){
        if(!empty($_POST)){
            //send mail
        }
        echo  json_encode(array('resutl'=> 1));
    }
}
