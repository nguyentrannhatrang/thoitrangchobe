<?php
class Traveller_model extends CI_Model {    
    public $id;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $created;
    private $table = 'traveller';

    public function __construct()
    {
        parent::__construct();
    }

    public function insert()
    {
        $this->created = time();
        $this->db->insert($this->table, $this);
        return $this->db->insert_id();
    }

    public function get_by_phone($phone)
    {
        $query = $this->db->get_where($this->table, ['phone' => $phone]);

        $data = $query->result();
        $result = array();
        if($data){
            foreach ($data as $_data){
                $model = $this->convertToModel($_data);
                $result[] = $model;
            }
        }
        return $result;
    }

    public function get_data_by_id($id)
    {
        $query = $this->db->get_where($this->table, ['id' => $id]);

        $data = $query->result();
        return $this->convertToModel(end($data));
    }

    /**
     * @param $data
     * @return $this|Booking_model
     */
    private function convertToModel($data){
        if(empty($data)) return $this;
        $obj = clone $this;
        $obj->id = $data->id;
        $obj->name = $data->name;
        $obj->address = $data->address;
        $obj->phone = $data->phone;
        $obj->email = $data->email;
        $obj->created = $data->created;
        return $obj;
    }

}