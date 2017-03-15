<?php
class Booking_detail_model extends CI_Model {
    
    const STATUS_REQUEST = 0;
    const STATUS_CONFIRM = 1;
    const STATUS_CANCEL = 2;
    const STATUS_COMPLETED = 3;
    public $id;
    public $bkId;
    public $product;
    public $product_name;
    public $color;
    public $size;
    public $quantity;
    public $price;
    public $discount;
    public $total_discount;
    public $total;
    public $status;
    public $created;
    public $updated;
    private $table = 'booking_detail';

    public function __construct()
    {
        parent::__construct();
    }

    public function insert()
    {
        $this->created = time();
        $this->updated = time();
        $this->db->insert($this->table, $this);
    }

    public function get_by_booking($bkId)
    {
        $query = $this->db->get_where($this->table, ['bkId' => $bkId]);

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
        $model = $this->convertToModel(end($data));
        return $model;
    }

    /**
     * @return bool
     */
    public function update()
    {
        $this->updated = time();
        $this->db->where(array('id'=>$this->id));
        $update = $this->db->update($this->table, $this);
        return (boolean) $update;
    }

    /**
     * @return bool
     */
    public function delete()
    {
        $query = $this->db->delete($this->table, ['id'=>$this->id]);

        return (boolean) $query;
    }
    /**
     * @param $data
     * @return Booking_detail_mode
     */
    private function convertToModel($data){
        if(empty($data)) return $this;
        $obj = clone $this;
        $obj->id = $data->id;
        $obj->bkId = $data->bkId;
        $obj->product = $data->product;
        $obj->product_name = $data->product_name;
        $obj->price = $data->price;
        $obj->discount = $data->discount;
        $obj->total = $data->total;
        $obj->total_discount = $data->total_discount;
        $obj->quantity = $data->quantity;
        $obj->color = $data->color;
        $obj->size = $data->size;
        $obj->status = $data->status;
        $obj->created = $data->created;
        $obj->updated = $data->updated;
        return $obj;
    }
    /**
     * @param Booking_detail_model $data
     * @return array
     */
    public function convertToArray($obj){
        $data = array();
        $data['id'] = $obj->id;
        $data['bkId'] = $obj->bkId;
         $data['product'] = $obj->product;
         $data['product_name'] = $obj->product_name;
         $data['price'] = $obj->price;
         $data['discount'] = $obj->discount;
         $data['total'] = $obj->total;
         $data['total_discount'] = $obj->total_discount;
         $data['quantity'] = $obj->quantity;
         $data['color'] = $obj->color;
         $data['size'] = $obj->size;
         $data['status'] = $obj->status;
         $data['created'] = $obj->created;
         $data['updated'] = $obj->updated;
        return $data;
    }

    public function generateIdNew(){
        return uniqid('new_');
    }

}