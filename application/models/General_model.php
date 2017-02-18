<?php
class General_model extends CI_Model {

    public $key;
    public $value;

    private $table = 'general';

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function get_data()
    {
        $query = $this->db->get($this->table);
        $data = $query->result();

        $results = array();
        foreach ($data as $row) {
            $results[$row->key] = $row->value;
            //$results = $row;
            //$results = (array($row));
        }

        return (object) $results;
    }

    public function save()
    {
        $this->db->truncate($this->table);

        foreach ($_POST['General'] as $key => $value) {
            $this->key      = $key;
            $this->value    = $value;

            $this->db->insert($this->table, $this);
        }
    }
}