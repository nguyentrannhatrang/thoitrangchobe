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


    public function save(){
        /** @var Product_detail_model $item */
        foreach ($this->data as $item){
            if($item->get_data_by_product_color_size($item->product,$item->color,$item->size))
                $item->update();
            else
                $item->insert();
        }
    }
    public function delete(){
        /** @var Product_detail_model $item */
        foreach ($this->data as $item){
            $item->delete();
        }
    }
}