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
        //if(!$refno) die;
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
        $bkId = isset($_GET['bkId'])?$_GET['bkId']:'';
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
                    $item->product_name = $this->getProductName($product);
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
            if(!$itemId){
                /** @var Booking_detail_model $detail */
                $detail = clone $this->booking_detail_model;
                $detail->id = $detail->generateIdNew();
                $detail->product = $product;
                $detail->product_name = $this->getProductName($product);
                //set product name
                $detail->color = $color;
                $detail->size = $size;
                $detail->quantity = $quantity;
                $detail->status = $status;
                $detail->price = $price;
                $detail->total = (float)$price * (int) $quantity;
                $items[] = $detail;
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

    /**
     * @param $productId
     * @return string
     */
    private function getProductName($productId){
        /** @var Product_model $product */
        $product = clone $this->product_model;
        return $product->getName($productId);
    }

    public function save()
    {
        if (!empty($_POST) && !empty($_POST['refno'])) {
            $items = $this->session->userdata('booking_item');
            $items = unserialize($items);            
            $booking = $this->session->userdata('booking');
            /** @var Booking_model $booking */
            $booking = unserialize($booking);
            $traveller = new Traveller_model();
            $traveller = $traveller->get_data_by_id($booking->user_id);
            $traveller->name = isset($_POST['customer_name'])?$_POST['customer_name']:'';
            $traveller->email = isset($_POST['customer_email'])?$_POST['customer_email']:'';
            $traveller->phone = isset($_POST['customer_phone'])?$_POST['customer_phone']:'';
            $traveller->address = isset($_POST['customer_address'])?$_POST['customer_address']:'';            
            $booking->status = isset($_POST['booking_status'])?(int)$_POST['booking_status']:0;
            $booking->updateAll($traveller,$items);
        } elseif (!empty($_POST)) {//add new
            $traveller = new Traveller_model();
            $traveller->name = isset($_POST['customer_name'])?$_POST['customer_name']:'';
            $traveller->email = isset($_POST['customer_email'])?$_POST['customer_email']:'';
            $traveller->phone = isset($_POST['customer_phone'])?$_POST['customer_phone']:'';
            $traveller->address = isset($_POST['customer_address'])?$_POST['customer_address']:'';
            $items = $this->session->userdata('booking_item');
            $items = unserialize($items);
            $booking = $this->session->userdata('booking');
            $booking = unserialize($booking);
            $booking->status = isset($_POST['booking_status'])?(int)$_POST['booking_status']:0;
            $booking->insertAll($traveller,$items);
            
            
        }

        echo json_encode(array('result'=>1,
            'data'=>array()));
    }
}
