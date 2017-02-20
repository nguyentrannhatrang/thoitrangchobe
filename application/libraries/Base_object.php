<?php

/**
 * Created by PhpStorm.
 * User: ntnt
 * Date: 2/20/2017
 * Time: 10:26 PM
 */
class BaseObject
{
    public $data;

    /**
     * @return mixed
     */
    public function getData(){
        return $this->data;
    }

    /**
     * @param string $key
     * @return null
     */
    public function getItem($key = ''){
        if($this->isItem($key))
            return $this->data[$key];
        return null;
    }

    /**
     * @param $key
     * @return bool
     */
    public function isItem($key){
        if(isset($this->data[$key]))
            return true;
        return false;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function addItem($key,$value){
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * @param $key
     * @return $this
     */
    public function removeItem($key){
        if($this->isItem($key))
            unset($this->data[$key]);
        return $this;
    }

}