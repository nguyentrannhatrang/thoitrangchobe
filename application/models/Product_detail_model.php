<?php
class Product_detail_model extends CI_Model {
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
}