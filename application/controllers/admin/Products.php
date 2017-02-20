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
        if (!empty($_POST) && !empty($_POST['id'])) {
            $this->product_model->update();
            $this->session->set_flashdata('success', $this->lang->line('product_update_success'));
        } elseif (!empty($_POST)) {
            $this->product_model->insert();
            $this->session->set_flashdata('success', $this->lang->line('product_add_success'));
        }

        redirect('admin/products');
    }
}
