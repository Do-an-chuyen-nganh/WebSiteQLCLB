<?php
    include_once '../lib/database.php';
    include_once '../helper/format.php';

    class club
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_club($data, $files)
        {
            $clbName   = mysqli_real_escape_string($this->db->link, $data['clbName']);
            $quantity  = mysqli_real_escape_string($this->db->link, $data['quantity']);
            $content  = mysqli_real_escape_string($this->db->link, $data['content']);
            $category  = mysqli_real_escape_string($this->db->link, $data['category']);
            //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
            $permited = array('jpg', 'jpeg', 'png' , 'gif');
            $file_name = $_FILES['image'] ['name'];
            $file_size = $_FILES['image'] ['size'];
            $file_temp = $_FILES['image'] ['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($clbName == "" || $quantity == "" || $content == "" || $file_name == "" || $category == "") {
                $alert = '<div class="alert alert-warning">
                <span><b> Các trường không được trống </b></span></div>';
                return $alert;
            }else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_caulacbo(clbName, quantity, content, catId, img) VALUES('$clbName', '$quantity', '$content', '$category', '$unique_image')";
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

        public function show_club(){
            $query  = "SELECT tbl_caulacbo.*, tbl_category.catName ,tbl_category.create_at 
                       FROM tbl_caulacbo
                       INNER JOIN tbl_category ON tbl_caulacbo.catId = tbl_category.catId";
            $result = $this->db->selectdata($query);
            return $result;
        }

        /**
         * [get_all_club description]
         * @return [type] [description]
         */
        public function get_all_club(){
            $query = "SELECT `clb_id`, `clbName`, `quantity`, `img`, `content`, `catId`, `create_at`, `update_at` FROM `tbl_caulacbo`";
            $result = $this->db->select($query);

            return $result;
        }

        public function getCLBById($id){
            $query  = "SELECT * FROM tbl_caulacbo WHERE clb_id = $id";
            $result = $this->db->selectdata($query);
            return $result;
        }

        public function get_club_by_id($id){
            $query  = "SELECT * FROM tbl_caulacbo WHERE clb_id = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function update_club($data, $files, $id){
            $clbName   = mysqli_real_escape_string($this->db->link, $data['clbName']);
            $quantity  = mysqli_real_escape_string($this->db->link, $data['quantity']);
            $content  = mysqli_real_escape_string($this->db->link, $data['content']);
            $category  = mysqli_real_escape_string($this->db->link, $data['category']);
            //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploadcatId
            $permited = array('jpg', 'jpeg', 'png' , 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($clbName == "" || $quantity == "" || $content == "" || $category == "") {
                $alert = '<div class="alert alert-warning">
                <span><b> Các trường không được trống </b></span></div>';
                return $alert;
            }else{
                if(!empty($file_name)){
                    //Nếu chọn ảnh
                    if($file_size > 20480){
                        $alert = '<div class="alert alert-warning">
                        <span><b> Ảnh không quá 2MB </b></span></div>';
                        return $alert;
                    }elseif(in_array($file_ext, $permited) === false){
                        echo "<span class='error'> Có thể chọn ảnh ".implode(', ', $permited)." </span>";
                    }
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_caulacbo SET 
                    clbName = '$clbName', 
                    quantity = '$quantity',
                    content = '$content', 
                    category = '$category',
                    img = '$unique_image'

                    WHERE clb_id = '$id' ";
                }else{
                    //Nếu không chọn ảnh
                    $query = "UPDATE tbl_caulacbo SET 
                    clbName = '$clbName', 
                    quantity = '$quantity',
                    content = '$content', 
                    category = '$category'

                    WHERE clb_id = '$id' ";
                }
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

        public function del_club($id){
            $query = "DELETE FROM tbl_caulacbo
            WHERE `clb_id` = $id
              AND NOT EXISTS(SELECT * FROM `student` WHERE `clb_id` = $id)";
            $result = $this->db->deleteCount($query);
            
            if($result==1){
                $alert = '<div class="alert alert-success">
                <span><b> Xóa thành công </b></span></div>';
                return $alert;
            }else if($result == 0){
                $alert = '<div class="alert alert-danger">
                <span><b> Không thể xóa CLB đã có thành viên </b></span></div>';
                return $alert;
            } else{
                $alert = '<div class="alert alert-danger">
                <span><b> Xoá thất bại </b></span></div>';
                return $alert;
            }
        }
    }
?>
