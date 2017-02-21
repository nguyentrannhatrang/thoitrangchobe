<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Admin {

    public $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data['products'] = $this->product_model->get_data();

        $this->load->view('admin/header', $this->data);
        $this->load->view('admin/products', $this->data);
        $this->load->view('admin/footer', $this->data);
    }

    public function create()
    {
        $this->load->view('admin/header', $this->data);
        $this->load->view('admin/product', $this->data);
        $this->load->view('admin/footer', $this->data);
    }

    public function edit($id)
    {
        global $ARRAY_COLOR,$ARRAY_SIZE;
        $this->data['product'] = $this->product_model->get_data_by_id($id);
        $listImages  = $this->product_images_model->get_data_by_product($id);
        $this->data['images'] = array();
        if($listImages)
            foreach ($listImages as $item){
                $this->data['images'][$item->i_order] = URL_SITE.'/img.php?src='.PATH_IMAGE_PRODUCT.$item->value;
            }
        $detail = new Product_detail_model();
        $listDetail = $detail->get_data_by_product_color_size($id);
        if($listDetail){
            $this->data['details'] = array();
            foreach ($listDetail as $item){
                if(!isset($this->data['details'][$item->color]))
                    $this->data['details'][$item->color] = [];
                $this->data['details'][$item->color][$item->size] = $item->quantity;
            }
        }
        $this->data['array_color'] = $ARRAY_COLOR;
        $this->data['array_size'] = $ARRAY_SIZE;
        $this->load->view('admin/header', $this->data);
        $this->load->view('admin/product', $this->data);
        $this->load->view('admin/footer', $this->data);
    }

    public function delete($id)
    {
        $this->product_model->delete_by_id($id);
        $this->session->set_flashdata('success', $this->lang->line('product_delete_success'));
        redirect('admin/products');
    }

    public function save()
    {
        $productId = null;
        if (!empty($_POST) && !empty($_POST['id'])) {
            $productId = $this->product_model->update();
            $this->session->set_flashdata('success', $this->lang->line('product_update_success'));
        } elseif (!empty($_POST)) {
            $productId = $this->product_model->insert();
            $this->session->set_flashdata('success', $this->lang->line('product_add_success'));
        }
        if(is_null($productId)) return;
        //save product detail
        if(isset($_POST['product_detail']) && is_array($_POST['product_detail'])){
            $this->load->library('Product_detail_collection');
            $listDetail = new Product_detail_collection();
            foreach ($_POST['product_detail'] as $color=>$arrSize){
                if(is_array($arrSize)){
                    foreach ($arrSize as $size=>$quantity){
                        $productDetail = new Product_detail_model();
                        $productDetail->product = $productId;
                        $productDetail->color = $color;
                        $productDetail->size = $size;
                        $productDetail->quantity = (int)$quantity;
                        $listDetail->addItem($productDetail->product.''.$productDetail->color.$productDetail->size,
                            $productDetail);
                    }
                }
            }
            $listDetail->save();
        }

        redirect('admin/products');
    }
}
