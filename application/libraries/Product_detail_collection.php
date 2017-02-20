<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: ntnt
 * Date: 2/20/2017
 * Time: 10:25 PM
 */
class Product_detail_collection extends Base_object
{


    /**
     * @param $product
     */
    public function updateProduct($product){
        if(empty($this->data)) return null;
        /** @var Product_image_model $item */
        foreach ($this->data as &$item){
            $item->product = $product;
        }
    }

    /**
     * @return string
     */
    public function getFirstImage(){
        $order = null;
        $name = '';
        if(empty($this->data)) return null;
        /** @var Product_image_model $item */
        foreach ($this->data as $item){
            if( is_null($order) || $item->i_order < $order){
                $order = $item->i_order;
                $name = $item->value;
            }
        }
        return $name;
    }
    public function save(){
        /** @var Product_image_model $item */
        foreach ($this->data as $item){
            if($item->get_data_by_id($item->product,$item->i_order))
                $item->update();
            else
                $item->insert();
        }
    }
    public function delete(){
        /** @var Product_image_model $item */
        foreach ($this->data as $item){
            unlink(PATH_IMAGE_PRODUCT.$item->value);
            $item->delete();
        }
    }
}