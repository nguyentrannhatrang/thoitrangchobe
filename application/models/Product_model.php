<?php
class Product_model extends CI_Model {

    public $name;
    public $description;
    public $short_description;
    public $category;
    public $price;
    public $image;
    public $active;
    public $views;
    public $date;

    private $table = 'products';

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function get_data()
    {
        $this->db->select('p.*, c.name as category_name');
        $this->db->from($this->table.' p');
        $this->db->join('categories c', 'p.category = c.id');
        $query = $this->db->get();

        $data = $query->result();

        return $data;
    }

    public function get_data_by_category($id)
    {
        $this->db->select('p.*, c.name as category_name');
        $this->db->from($this->table . ' p');
        $this->db->join('categories c', 'p.category = c.id');
        $this->db->where('p.category', $id);
        $query = $this->db->get();

        $data = $query->result();

        return $data;
    }

    public function get_popular_products($limit = 20)
    {
        $this->db->select('p.*, c.name as category_name');
        $this->db->from($this->table.' p');
        $this->db->join('categories c', 'p.category = c.id');
        $this->db->order_by('p.views', 'desc');
        $this->db->limit($limit);
        $query = $this->db->get();

        $data = $query->result();

        return $data;
    }

    public function get_data_by_id($id)
    {
        $query = $this->db->get_where($this->table, ['id' => $id]);

        $data = $query->result();

        return end($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function update_views($id)
    {
        $query = $this->db->get_where($this->table, ['id' => $id]);
        $result = $query->result();
        $data = end($result);

        $views = $data->views + 1;

        $this->db->update($this->table, ['views' => $views], "id = " . $id);

        return end($data);
    }

    public function record_count() {
        return $this->db->count_all($this->table);
    }

    public function fetch_products($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function delete_by_id($id)
    {
        $query = $this->db->delete($this->table, ['id' => $id]);

        return (boolean) $query;
    }

    public function insert()
    {
        $this->name             = $_POST['name'];
        //$this->description      = $_POST['description'];
        $this->short_description      = $_POST['short_description'];
        $this->price            = $_POST['price'];
        $this->category         = $_POST['category'];
        $this->active           = !empty($_POST['active']) ? $_POST['active'] : 0;
        $this->date           = date('Y-m-d',time());

        /** @var Product_image_collection  $list */
        $this->db->insert($this->table, $this);
        $insert_id = $this->db->insert_id();
        $this->id = $insert_id;
        $list = $this->upload();
        $this->image = $list->getFirstImage();
        if($this->image){
            $this->image = $list->getFirstImage();
        }
        if (empty($this->image)) unset($this->image);
        $this->db->update($this->table, $this, "id = ".$insert_id);
        $list->updateProduct($insert_id);
        $list->save();
        return $insert_id;
    }

    public function upload()
    {
        $listImages = new Product_image_collection();
        if (!empty($_FILES['image'])) {
            if(isset($_FILES["image"]['name']) && is_array($_FILES["image"]['name'])){
                foreach ($_FILES["image"]['name'] as $key=>$name){
                    if ($_FILES["image"]["error"][$key] == UPLOAD_ERR_OK) {
                        $tmp_name = $_FILES["image"]["tmp_name"][$key];
                        $name = $_FILES["image"]["name"][$key];
                        $name = $this->id.$key.'-'.strtolower($name);

                        $path = PATH_IMAGE_PRODUCT;
                        @mkdir($path, 0777, true);
                        if(file_exists($path . $name)) unlink($path . $name);
                        if (move_uploaded_file($tmp_name, $path . $name)) {
                            $modelImage = new Product_images_model();
                            $modelImage->value = $name;
                            $modelImage->i_order = $key;
                            if(isset($_POST["color_image"]) && isset($_POST["color_image"][$key]) &&$_POST["color_image"][$key])
                                $modelImage->color = $_POST["color_image"][$key];
                            $listImages->addItem($key,$modelImage);
                        }
                    }
                }
            }else{
                if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES["image"]["tmp_name"];
                    $name = $_FILES["image"]["name"];
                    $name = $this->id.'0-'.strtolower($name);

                    $path = PATH_IMAGE_PRODUCT;

                    @mkdir($path, 0777, true);
                    if(file_exists($path . $name)) unlink($path . $name);
                    if (move_uploaded_file($tmp_name, $path . $name)) {
                        $modelImage = new Product_images_model();
                        $modelImage->value = $name;
                        $modelImage->i_order = 0;
                        if(isset($_POST["color_image"]) && isset($_POST["color_image"][0]) &&$_POST["color_image"][0])
                            $modelImage->color = $_POST["color_image"][0];
                        $listImages->addItem(0,$modelImage);
                    }
                }
            }
        }
        return $listImages;
    }

    /**
     * @return Product_image_collection
     */
    protected function getImagesDelete(){
        $productId = $_POST['id'];
        $listImages = new Product_image_collection();
        if(isset($_POST['delete_image']) && is_array($_POST['delete_image'])){
            foreach ($_POST['delete_image'] as $key=>$value){
                $modelImage = new Product_images_model();
                $modelImage->product = $productId;
                $modelImage->i_order = $key;
                $data = $modelImage->get_data_by_id($productId,$key);
                if(is_array($data) && isset($data[0])){
                    $modelImage->value = $data[0]->value;
                }
                $listImages->addItem($key,$modelImage);
            }
        }
        return $listImages;
    }

    public function update()
    {
        $this->name             = $_POST['name'];
        $this->description      = $_POST['description'];
        $this->short_description      = $_POST['short_description'];
        $this->price            = $_POST['price'];
        $this->category         = $_POST['category'];
        $this->active           = !empty($_POST['active']) ? $_POST['active'] : 0;
        $this->id = $_POST['id'];
        /** @var Product_image_collection $list */
        $list = $this->upload();
        $list->updateProduct($_POST['id']);
        $list->save();
        /** @var Product_image_collection $listDelete */
        $listDelete = $this->getImagesDelete();
        $listDelete->delete();
        $image = new Product_images_model();
        $data = $image->get_data_by_product($_POST['id']);
        $listImages = new Product_image_collection();
        foreach ($data as $item){
            $listImages->addItem($item->i_order,$item);
        }
        if($listImages){
            $this->image = $listImages->getFirstImage();
        }
        if (empty($this->image)) unset($this->image);
        $this->db->update($this->table, $this, "id = ".$_POST['id']);
        if($_POST['id']){
            //update color image
            $this->updateColorImage($_POST['id']);
        }
        return $_POST['id'];

    }
    private function updateColorImage($productId){
        if(!$productId) return;
        $productImage = new Product_images_model();
        if(isset($_POST["color_image"]) && is_array($_POST["color_image"])){
            foreach ($_POST["color_image"] as $index=>$color){
                if(!$color) continue;
                $data = $productImage->get_data_by_id($productId,$index);
                if(empty($data)) continue;
                $data = $data[0];
                $productImage->convertDataToModel($data);
                $productImage->color = $color;
                $productImage->update();
            }
        }
    }
    public function save(){
        $this->db->update($this->table, $this, "id = ".$this->id);
    }

    /**
     * @param $productId
     * @return string
     */
    public function getName($productId){
        $product = $this->get_data_by_id($productId);
        if($product)
            return $product->name;
        return '';
    }

    /**
     * @param $value
     * @param int $heigth
     * @return string
     */
    public static function getPathImage($value,$heigth = 60){
        return site_url('img.php?src='.PATH_IMAGE_PRODUCT.$value.'&h='.$heigth);
    }

}
