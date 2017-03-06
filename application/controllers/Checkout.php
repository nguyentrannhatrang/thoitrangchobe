<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends Frontend
{

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$this->data['popular_products'] = $this->product_model->get_popular_products();

		$this->load->view('partials/headerHome', $this->data);
		$this->load->view('homepage', $this->data);
		$this->load->view('partials/footerHome', $this->data);
	}
	
	public function delete(){
		if($_POST && isset($_POST['id_delete'])){
			$dataCart = $this->session->userdata('cart');
			$element = $_POST['id_delete'];
			$arrId = explode('-',$element);
			if(!$dataCart || count($arrId)<3) {
				echo json_encode(array('result'=>0));
				return;
			}
			$elementProduct = $arrId[0];
			$elementColor = $arrId[1];
			$elementSize = $arrId[2];
			if(isset($dataCart[$elementProduct])
			&& isset($dataCart[$elementProduct][$elementColor])
			&& isset($dataCart[$elementProduct][$elementColor][$elementSize])
			)
				unset($dataCart[$elementProduct][$elementColor][$elementSize]);

			$dataCart = $this->removeCartEmpty($dataCart);
			$this->session->set_userdata('cart',$dataCart);
			echo json_encode(array('result'=>1));
			return;
		}
		echo json_encode(array('result'=>0));
		return;

	}

	private function removeCartEmpty($dataCart){
		foreach ($dataCart as $productId=>$arrColor) {
			foreach ($arrColor as $colorId => $arrSize) {
				if (empty($dataCart[$productId][$colorId]))
					unset($dataCart[$productId][$colorId]);
			}
		}
		foreach ($dataCart as $productId=>$arrColor){
			if(empty($dataCart[$productId]))
				unset($dataCart[$productId]);
		}
		return $dataCart;
	}
	public function submit()
	{
		global $ARRAY_COLOR,$ARRAY_SIZE;
		if (!empty($_POST)) {
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$telephone = $this->input->post('telephone');
			$address = $this->input->post('address');
			$message = $this->input->post('message');
			$dataCart = $this->session->userdata('cart');
			if (!empty($email) && !empty($telephone) && !empty($name) && !empty($dataCart)) {
				$this->load->library('email');
				$order_array = [];

				// Procesarea contentului
				$content = 'Tên khách hàng ' . $name . "\n";
				$content .= 'Email: ' . $email . "\n";
				$content .= 'Sđt: ' . $telephone . "\n";
				$content .= 'Địa chỉ: ' . $address . "\n\n";
				$content .= 'Tin nhắn: ' . $message . "\n\n";

				$content .= "\nComanda: \n\n";
				$total = 0;
				$arrReduce = array();
				foreach ($dataCart as $productId=>$arrColor){
					foreach ($arrColor as $colorId=>$arrSize){
						foreach ($arrSize as $sizeId=>$item) {
							if(!is_array($item)) continue;
							$product_db = $this->product_model->get_data_by_id($productId);
							$product_total = $product_db->price * intval($item['quantity']);
							$content .= $product_db->name . ' x ' . $item['quantity'] . ' = ' . $product_total . " Lei \n";
							$total += $product_total;
							$order_array['products'][] = ['id' => $productId,
								'color'=>$colorId, 
								'size'=>$sizeId, 
								'name' => $product_db->name, 
								'quantity' => $item['quantity'], 
								'total' => $product_total];
							$productDetail = new Product_detail_model();
							$productDetail->getObjectDetail($productId,$colorId,$sizeId);
							if($productDetail->quantity < (int)$item['quantity']){
								$this->session->set_flashdata('error',
									$product_db->name.', màu '.$ARRAY_COLOR[$colorId].', size '.$ARRAY_SIZE[$sizeId].' không đủ số lượng!');
								redirect('cart');
								return;
							}
							//reduce quantity
							$arrReduce[] = array('product'=>$productId,'color'=>$colorId,'size'=>$sizeId,'quantity'=>$item['quantity']);
							
						}
					}
				}
				$content .= "\nTotal: " . $total . ' Lei';

				
				$order_array['name'] = $name;
				$order_array['email'] = $email;
				$order_array['telephone'] = $telephone;
				$order_array['address'] = $address;
				$order_array['message'] = $message;
				$order_array['content'] = $content;
				$order_array['total'] = $total;
				// Finisare


				/*$this->email->from($email, $name);
                $this->email->to('ser.finciuc@gmail.com');
                /*$this->email->cc('another@another-example.com');
                $this->email->bcc('them@their-example.com');*/

				/*$this->email->subject('Comanda de pe site.');
                $this->email->message($content);
                */
				$this->order_model->insert_order($order_array);
				redirect('success');
				/*if ($this->email->send()) {
                    delete_cookie('products');

                    $this->order_model->insert_order($order_array);

                    redirect('success');
                } else {
                    $this->session->set_flashdata('error', 'Your message was not sent. Please try later.');
                    $this->cart();
                }*/
			} else {
				$this->session->set_flashdata('error', 'Please check again all data is complete.');
				redirect('cart');
			}
		} else {
			redirect('cart');
		}

	}
}
