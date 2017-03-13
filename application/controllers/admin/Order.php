<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends Admin {

    public $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->unset_userdata('booking_item');
        $refno = $_GET['refno'];
        if(!$refno) die;
        /** @var Booking_model $booking */
        $booking = $this->booking_model->get_data_by_id($refno);
        $this->data['traveller'] = $this->traveller_model;
        $this->data['items'] = [];
        $this->data['traveller'] = $this->traveller_model;
        $this->data['products'] = $this->product_model->get_data_all();
        if($booking){
            /** @var Traveller_model $traveller */
            $traveller = $this->traveller_model->get_data_by_id($booking->user_id);
            $bkItems = $this->booking_detail_model->get_by_booking($booking->id);
            $this->data['traveller'] = $traveller;
            $this->data['items'] = $bkItems;
            $this->session->set_userdata('booking_item',serialize($bkItems));
            $this->session->set_userdata('booking',serialize($booking));
        }
        $this->data['booking'] = $booking;
        

        $this->load->view('admin/header', $this->data);
        $this->load->view('admin/order', $this->data);
        $this->load->view('admin/footer', $this->data);
    }

    public function create()
    {
        $this->load->view('admin/header', $this->data);
        $this->load->view('admin/order', $this->data);
        $this->load->view('admin/footer', $this->data);
    }

    public function editItem()
    {
        $result = $this->booking_detail_model;
        $bkId = isset($_REQUEST['bkId'])?$_REQUEST['bkId']:'';
        $items = $this->session->userdata('booking_item');
        if($items){
            $items = unserialize($items);
            /** @var Booking_detail_model $item */
            foreach ($items as $item) {
                if($item->id == $bkId){
                    $result = $item;
                    break;
                }
            }
        }
        echo json_encode(array('result'=>1,'data'=>$this->booking_detail_model->convertToArray($result)));
    }

    public function saveItem()
    {
        $result = $this->booking_detail_model;
        $items = $this->session->userdata('booking_item');
        $items = unserialize($items);
        $booking = $this->session->userdata('booking');
        $booking = unserialize($booking);
        if (!empty($_POST)) {
            $itemId = $this->input->post('item_id');
            $product = $this->input->post('product');
            $color = $this->input->post('color');
            $size = $this->input->post('size');
            $quantity = $this->input->post('quantity');
            $status = $this->input->post('status');
            $price = $this->input->post('price');
            /** @var Booking_detail_model $item */
            foreach ($items as &$item) {
                if($item->id == $itemId){
                    $item->product = $product;
                    //set product name
                    $item->color = $color;
                    $item->size = $size;
                    $item->quantity = $quantity;
                    $item->status = $status;
                    $item->price = $price;
                    $item->total = (float)$price * (int) $quantity;
                    break;
                }
            }
        }
        $booking->updateDataFromDetail($items);
        $this->session->set_userdata('booking_item',serialize($items));
        $this->session->set_userdata('booking',serialize($booking));
        $itemsArr = array();
        foreach ($items as $item){
            $itemsArr[] =  $this->booking_detail_model->convertToArray($item);
        }

        echo json_encode(array('result'=>1,
            'data'=>array(
                'booking'=>$this->booking_model->convertToArray($booking),
                'items'=>$itemsArr)
        ));
    }

    public function save()
    {
        if (!empty($_POST) && !empty($_POST['id'])) {
            $this->page_model->update();
            $this->session->set_flashdata('success', 'Pagina a fost editat cu succes.');
        } elseif (!empty($_POST)) {
            $this->page_model->insert();
            $this->session->set_flashdata('success', 'Pagina a fost adaugat cu succes.');
        }

        redirect('admin/pages');
    }
}
