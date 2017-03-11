<?php
class Booking_model extends CI_Model {
    
    const STATUS_REQUEST = 0;
    const STATUS_CONFIRM = 1;
    const STATUS_CANCEL = 2;
    const STATUS_COMPLETED = 3;
    const STATUS_NOSHOW = 4;
    public $id;
    public $user_id;
    public $payment;
    public $quantity;
    public $status;
    public $total;
    public $message;
    public $created;
    public $updated;
    private $table = 'booking';

    public function __construct()
    {
        parent::__construct();
    }

    public function insert()
    {
        $this->created = time();
        $this->updated = time();
        $this->db->insert($this->table, $this);
        return $this->db->insert_id();
    }

    public function get_latest($limit = 20, $start = 0)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table);

        $orders = $query->result();
        $result = array();
        if($orders){
            foreach ($orders as $_data){
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
     * @return $this|Booking_model
     */
    private function convertToModel($data){
        if(empty($data)) return $this;
        $obj = clone $this;
        $obj->id = $data->id;
        $obj->user_id = $data->user_id;
        $obj->payment = $data->payment;
        $obj->quantity = $data->quantity;
        $obj->total = $data->total;
        $obj->status = $data->status;
        $obj->message = $data->message;
        $obj->created = $data->created;
        $obj->updated = $data->updated;
        return $obj;
    }

    /**
     * @param $dataItem
     * @return float|int
     */
    public function calTotal($dataItem){
        if(empty($dataItem)) return 0;
        $total = 0;
        foreach ($dataItem as $item){
            $total +=(float) $item->total;
        }
        return $total;
    }

    /**
     * @param $dataItem
     * @return float|int
     */
    public function updateDataFromDetail($dataItem){
        if(empty($dataItem)) return 0;
        $total = 0;
        $quantity = 0;
        foreach ($dataItem as $item){
            $total +=(float) $item->total;
            $quantity +=(int) $item->quantity;
        }
        $this->total = $total;
        $this->quantity = $quantity;
        return $this;
    }

}