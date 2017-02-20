<?php

/**
 * Created by PhpStorm.
 * User: ntnt
 * Date: 2/20/2017
 * Time: 10:25 PM
 */
class Product_image_collection extends BaseObject
{


    /**
     * @param $product
     */
    public function updateProduct($product){
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
        /** @var Product_image_model $item */
        foreach ($this->data as $item){
            if( $order == null || $item->i_oder < $order){
                $order = $item->i_oder;
                $name = $item->value;
            }                
        }
        return $name;
    }
    public function save(){
        /** @var Product_image_model $item */
        foreach ($this->data as $item){
            if($item->get_data_by_id($item->product,$item->i_oder))
                $item->update();
            else
                $item->insert();
        }
    }
    public function delete(){
        /** @var Product_image_model $item */
        foreach ($this->data as $item){
            $item->delete();
        }
    }
}