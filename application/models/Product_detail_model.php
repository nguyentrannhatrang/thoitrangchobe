<?php
class Product_detail_model extends CI_Model {

    public $product;
    public $color;
    public $size;
    public $quantity;
    private $table = 'product_detail';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_data()
    {
        $query = $this->db->get($this->table);

        return $query->result();
    }

    /**
     * @param null $product_id
     * @param null $color
     * @param null $size
     * @return mixed
     */
    public function get_data_by_product_color_size($product_id = null,$color = null,$size = null)
    {
        $where_array = [];
        if (isset($product_id)) {
            $where_array['product'] = (int) $product_id;
        }
        if (isset($color)) {
            $where_array['color'] =  $color;
        }
        if (isset($size)) {
            $where_array['size'] =  $size;
        }

        $query = $this->db->get_where($this->table, $where_array);

        $data = $query->result();

        return $data;
    }

    /**
     * @return bool
     */
    public function insert()
    {       
        $insert = $this->db->insert($this->table, $this);
        return (boolean) $insert;
    }

    public function update()
    {
        $this->db->where(array('product'=>$this->product,'color'=>$this->color,'size'=>$this->size));
        $update = $this->db->update($this->table, $this);
        return (boolean) $update;
    }

    public function delete_by_id($product_id,$color,$size)
    {
        $query = $this->db->delete($this->table, ['product'=>$product_id,'color'=>$color,'size'=>$size]);

        return (boolean) $query;
    }

    public function delete()
    {
        $query = $this->db->delete($this->table, ['product'=>$this->product,'color'=>$this->color,'size'=>$this->size]);

        return (boolean) $query;
    }

    public function reduceQuantity($product_id = null,$color = null,$size = null){
        $data = $this->get_data_by_product_color_size($product_id,$color,$size);
        //if()
    }

    /**
     * @param null $product_id
     * @param null $color
     * @param null $size
     * @return $this
     */
    public function getObjectDetail($product_id = null,$color = null,$size = null){
        $data = $this->get_data_by_product_color_size($product_id,$color,$size);
        if($data && isset($data[0]))
            $this->convertToModel($data[0]);
        return $this;
    }

    /**
     * @param $data
     */
    public function convertToModel($data){
        $this->product = $data->product;
        $this->color = $data->color;
        $this->size = $data->size;
        $this->quantity = $data->quantity;
    }

}