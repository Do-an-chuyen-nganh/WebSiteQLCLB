<?php
    include_once '../lib/database.php';
    include_once '../helper/format.php';

    class category
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_category($catName)
        {
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            
            if(empty($catName)){
                $alert = '<div class="alert alert-warning">
                <span><b> Danh mục không được trống </b></span></div>';
                return $alert;
            }else{
                $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
                $result = $this->db->insertdata($query);
                if($result){
                    $alert = '<div class="alert alert-success">
                    <span><b> Thêm thành công </b></span></div>';
                    return $alert;
                }else{
                    $alert = '<div class="alert alert-danger">
                    <span><b> Thêm thất bại </b></span></div>';
                    return $alert;
                }
            }
        }

        public function show_category(){
            $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
            $result = $this->db->selectdata($query);
            return $result;
        }

        public function getCatById($id){
            $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
            $result = $this->db->selectdata($query);
            return $result;
        }
        
        public function update_category($catName, $id){
            $catName = $this->fm->validation($catName);
            
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            $id = mysqli_real_escape_string($this->db->link, $id);

            if(empty($catName)){
                $alert = '<div class="alert alert-warning">
                <span><b> Danh mục không được trống </b></span></div>';
                return $alert;
            }else{
                $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id' ";
                $result = $this->db->update($query);
                if($result){
                    $alert = '<div class="alert alert-success">
                    <span><b> Cập nhật thành công </b></span></div>';
                    return $alert;
                }else{
                    $alert = '<div class="alert alert-danger">
                    <span><b> Cập nhật thất bại </b></span></div>';
                    return $alert;
                }
            }
        }

        public function del_category($id){
            $query = "DELETE FROM tbl_category WHERE catId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = '<div class="alert alert-success">
                <span><b> Đã xoá </b></span></div>';
                return $alert;
            }else{
                $alert = '<span class="error">Xoá thất bại</span>';
                return $alert;
            }
        }
    }
?>
