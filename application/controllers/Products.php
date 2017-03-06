<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Frontend
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('pagination');

        $this->data['config'] = array();

        $this->data['config']['full_tag_open'] = '<ul class="pagination">';
        $this->data['config']['full_tag_close'] = '</ul>';
        $this->data['config']['cur_tag_open'] = '<li class="active"><a>';
        $this->data['config']['cur_tag_close'] = '</a></li>';
        $this->data['config']['next_tag_open'] = '<li>';
        $this->data['config']['next_tag_close'] = '</li>';
        $this->data['config']['prev_tag_open'] = '<li>';
        $this->data['config']['prev_tag_close'] = '</li>';
        $this->data['config']['num_tag_open'] = '<li>';
        $this->data['config']['num_tag_close'] = '</li>';

        $this->data['config']["per_page"] = 20;
        $this->data['config']["uri_segment"] = 2;
        $this->data['config']["use_page_numbers"] = TRUE;
    }

    public function index($page = 0)
    {

        $this->data['config']["base_url"] = site_url('products');
        $this->data['config']["total_rows"] = $this->product_model->record_count();

        $choice = $this->data['config']["total_rows"] / $this->data['config']["per_page"];
        $this->data['config']["num_links"] = round($choice);

        $this->pagination->initialize($this->data['config']);

        $this->data['products'] = $this->product_model->fetch_products($this->data['config']["per_page"], $page);
        $this->data['links'] = $this->pagination->create_links();

        $this->load->view('partials/header', $this->data);
        $this->load->view('products', $this->data);
        $this->load->view('partials/footer', $this->data);
    }

    public function category($id, $page = 0)
    {

        $this->data['config']["base_url"] = site_url('products');
        $this->data['config']["total_rows"] = $this->product_model->record_count();

        $choice = $this->data['config']["total_rows"] / $this->data['config']["per_page"];
        $this->data['config']["num_links"] = round($choice);

        $this->pagination->initialize($this->data['config']);

        $this->data['products'] = $this->product_model->get_data_by_category($id);
        $this->data['links'] = $this->pagination->create_links();

        $this->data['main_category'] = $this->category_model->get_data_by_id($id);

        $this->load->view('partials/header', $this->data);
        $this->load->view('products', $this->data);
        $this->load->view('partials/footer', $this->data);
    }

    /**
     * Productdetail
     * 
     * @param $id
     */
    public function product($id)
    {
        global $ARRAY_COLOR,$ARRAY_SIZE;
        $this->data['product'] = $this->product_model->get_data_by_id($id);
        $this->data['comments'] = $this->comment_model->get_data_for(false, $this->data['product']->id);
        $this->data['product_images'] = $this->product_images_model->get_data_by_product($id);
        $this->data['product_detail'] = $this->product_detail_model->get_data_by_product_color_size($id);
        //$this->product_model->update_views($id);
        $aSizeByColor = array();
        /** @var Product_detail_model $detail */
        foreach ($this->data['product_detail'] as $detail){
            if(!$detail->quantity) continue;
            if(!isset($aSizeByColor[$detail->color]))
                $aSizeByColor[$detail->color] = array();
            $aSizeByColor[$detail->color][$detail->size] = $detail->quantity;
        }
        $colorImage = array();
        /** @var Product_images_model $item */
        foreach ($this->data['product_images'] as $item){
            if(!$item->color || !$item->value) continue;
            $colorImage[$item->color] = array(
                'url'=>site_url('img.php?src='.PATH_IMAGE_PRODUCT.$item->value.'&h=60'),
                'alt'=>$ARRAY_COLOR[$item->color]
            );
        }
        $this->data['size_by_color'] = $aSizeByColor;
        $this->data['color_image'] = $colorImage;
        $this->data['size_name'] = $ARRAY_SIZE;
        //get list relation
        $relation = $this->product_model->get_relation_products($this->data['product']->category);
        $this->data['product_relation'] = $relation;
        $this->load->view('partials/headerHome', $this->data);
        $this->load->view('product', $this->data);
        $this->load->view('partials/footerHome', $this->data);
    }

    public function success()
    {
        $this->load->view('partials/header', $this->data);
        $this->load->view('success', $this->data);
        $this->load->view('partials/footer', $this->data);
    }

    public function checkout()
    {
        if (!empty($_POST)) {
            $products = $this->input->post('products');

            $prefer = $this->input->post('prefer');

            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $telephone = $this->input->post('telephone');
            $address = $this->input->post('address');
            $message = $this->input->post('message');

            if (!empty($products) && !empty($email) && !empty($telephone) && !empty($name)) {
                $this->load->library('email');

                $order_array = [];

                // Procesarea contentului
                $content = 'Comanda de pe site de le ' . $name . "\n";
                $content .= 'Email: ' . $email . "\n";
                $content .= 'Telefon: ' . $telephone . "\n";
                $content .= 'Adresa: ' . $address . "\n\n";
                $content .= 'Mesaj: ' . $message . "\n\n";
                if (!empty($prefer)) $content .= 'Prefera sa fie contactat prin: ' . implode(', ', $prefer) . "\n\n";

                $content .= "\nComanda: \n\n";
                $total = 0;
                foreach ($products as $id => $product) {
                    $product_db = $this->product_model->get_data_by_id($id);
                    $product_total = $product_db->price * intval($product['quantity']);
                    $content .= $product_db->name . ' x ' . $product['quantity'] . ' = ' . $product_total . " Lei \n";
                    $total += $product_total;
                    $order_array['products'][] = ['id' => $id, 'name' => $product_db->name, 'quantity' => $product['quantity'], 'total' => $product_total];
                }
                $content .= "\nTotal: " . $total . ' Lei';

                $order_array['prefer'] = $prefer;
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
                $this->cart();
            }
        } else {
            redirect('cart');
        }

    }

    public function cart()
    {
        /*$this->data['products'] = array();
        if (!empty($this->data['cart'])) {
            foreach ($this->data['cart'] as $p) {
                if (!empty($p['id']) && !empty($p['quantity'])) {
                    $product = $this->product_model->get_data_by_id($p['id']);
                    if (!empty($product)) {
                        $product->quantity = $p['quantity'];
                        $this->data['products'][$product->id] = $product;
                    }
                }
            }
        }*/
        $dataCart = $this->session->userdata('cart');
        if(empty($dataCart)){
            redirect('/');
        }
        $this->data['items'] = $dataCart;

        $this->load->view('partials/headerHome', $this->data);
        $this->load->view('cart', $this->data);
        $this->load->view('partials/footerHome', $this->data);
    }

    /**
     * 
     */
    public function addCart()
    {
        global $ARRAY_COLOR,$ARRAY_SIZE;
        $productId = isset($_POST['product-id'])?$_POST['product-id']:'';
        $color = isset($_POST['product-color'])?$_POST['product-color']:'';
        $size = isset($_POST['product-size'])?$_POST['product-size']:'';
        $quantity = isset($_POST['quantity'])?$_POST['quantity']:'';
        if(!$productId || !$color || !$size || !$quantity) {
            echo  json_encode(array('result'=> 0,'error'=>'Dữ liệu không đúng'));
            return;
        }
        $dataCart = $this->session->userdata('cart');
        if(is_null($dataCart)) $dataCart = array();
        if(isset($dataCart[$productId]) &&
            isset($dataCart[$productId][$color]) &&
            isset($dataCart[$productId][$color][$size]))
            $dataCart[$productId][$color][$size]['quantity'] += (int)$quantity;
        else{
            $product = $this->product_model->get_data_by_id($productId);
            if($product){
                if(!isset($dataCart[$productId])) $dataCart[$productId] = array();
                if(!isset($dataCart[$productId][$color])) $dataCart[$productId][$color] = array();
                if(!isset($dataCart[$productId][$color])) $dataCart[$productId][$color][$size] = array();
                $productName = $product->name;
                $price = $product->price;
                $image = $this->product_images_model->getImageColor($productId,$color);
                $url = Product_model::getPathImage($image,80);
                $linkProduct = site_url(url_title($product->name).'-'.$product->id);
                $itemCart = [
                    'color'=>$ARRAY_COLOR[$color],
                    'size'=>$ARRAY_SIZE[$size],
                    'quantity'=>$quantity,
                    'name'=>$productName,
                    'price'=>$price,
                    'url'=>$url,
                    'link'=>$linkProduct
                ];
                $dataCart[$productId][$color][$size] = $itemCart;
            }
        }
        $this->session->set_userdata('cart',$dataCart);
        echo json_encode(array('result'=>1,'data'=>$dataCart));
        return;
    }
    public function getCart(){
        $dataCart = $this->session->userdata('cart');
        echo json_encode(array('result'=>empty($dataCart)?0:1,'data'=>$dataCart));
        return;
        
    }
}
