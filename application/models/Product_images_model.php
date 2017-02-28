<?php
class Product_images_model extends CI_Model {


    public $product;
    public $i_order;
    public $value;
    public $color;

    private $table = 'product_images';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_data()
    {
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_data_by_id($product_id = null, $order = null)
    {
        $where_array = '';
        if (isset($product_id) && isset($order)) {
            $where_array = ['product' => (int) $product_id,'i_order' => (int) $order];
        }

        $query = $this->db->get_where($this->table, $where_array);

        $data = $query->result();

        return $data;
    }

    public function get_data_by_product($product_id,$color = '')
    {
        $where_array = '';
        if (isset($product_id) && $product_id) {
            $where_array = ['product' => (int) $product_id];
        }
        if($color){
            $where_array['color'] = $color;
        }

        $query = $this->db->get_where($this->table, $where_array);

        $data = $query->result();

        return $data;
    }

    public function insert()
    {       
        $insert = $this->db->insert($this->table, $this);
        return (boolean) $insert;
    }

    public function update()
    {
        $this->db->where(array('product'=>$this->product,'i_order'=>$this->i_order));
        $update = $this->db->update($this->table, $this);
        return (boolean) $update;
    }

    public function delete_by_id($product_id,$order)
    {
        $query = $this->db->delete($this->table, ['product' => $product_id,'i_order'=>$order]);

        return (boolean) $query;
    }

    public function delete()
    {
        $query = $this->db->delete($this->table, ['product' => $this->product,'i_order'=>$this->i_order]);

        return (boolean) $query;
    }
}