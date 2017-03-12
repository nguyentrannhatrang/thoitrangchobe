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
		global $ARRAY_COLOR,$ARRAY_SIZE;
		$this->session->unset_userdata('cart');
		$this->data['list_item'] = [];
		$this->data['total'] = 0;
		$this->data['traveller'] = $this->traveller_model;
		if($this->input->get('refno')){			
			$bkId = $this->input->get('refno');
			/** @var Booking_model $booking */
			$booking = $this->booking_model->get_data_by_id($bkId);
			$listItem = $this->booking_detail_model->get_by_booking($bkId);
			/** @var Traveller_model $traveller */
			$traveller = $this->traveller_model->get_data_by_id($booking->user_id);
			$data = array();
			/** @var Booking_detail_model $detail */
			foreach ($listItem as $detail){
				$color = $detail->color;
				$size = $detail->size;
				$image = $this->product_images_model->getImageColor($detail->product,$color);
				$url = Product_model::getPathImage($image,80);
				$data[] = array(
					'color'=>isset($ARRAY_COLOR[$color])?$ARRAY_COLOR[$color]:'',
                    'size'=>isset($ARRAY_SIZE[$size])?$ARRAY_SIZE[$size]:'',
                    'quantity'=>$detail->quantity,
                    'name'=>$detail->product_name,
                    'price'=>$detail->price,
                    'url'=>$url
				);
			}
			$this->data['list_item'] = $data;
			$this->data['total'] = $booking->total;
			$this->data['traveller'] = $traveller;
		}
		$this->load->view('partials/headerHome', $this->data);
		$this->load->view('success', $this->data);
		$this->load->view('partials/footerHome', $this->data);
	}
}
