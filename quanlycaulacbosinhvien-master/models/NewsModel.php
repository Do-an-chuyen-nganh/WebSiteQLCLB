<?php
include_once '../lib/database.php';
include_once '../helper/format.php';

class NewsModel
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    /**
     * show all news
     */
    public function show_news()
    {
        $query = "SELECT `news_id`, `nameNews`, `short_content`, `newsContens`, `tieude`, `newCreate_at`,`img` FROM `tbl_news` ";
        $result = $this->db->select($query);
        return $result;
    }
    /**
     * show all news
     */
    public function show_news_byId($id)
    {
        $query = "SELECT `news_id`, `nameNews`, `short_content`, `newCreate_at`, `img`, `newsContens`, `tieude` FROM `tbl_news` WHERE `news_id` = $id";
        $result = $this->db->select($query);
        return $result;
    }
    /**
     *  news insert
     */
    public function insert_news($array,$type_id)
    {
        //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "../uploads/" . $unique_image;
        $conn = $this->db->connectionDB();
        $query = "INSERT INTO `tbl_news`( `nameNews`,`short_content`,`img`,`newsContens`,`tieude`)
    VALUES (:nameNews,:short_content,:img,:newsContens,:tieude)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nameNews', $array["nameNews"]);
        $stmt->bindParam(':short_content', $array["short_content"]);
        $stmt->bindParam(':img', $unique_image); 
         $stmt->bindParam(':newsContens', $array["newsContents"]);
        $stmt->bindParam(':tieude', $array["title"]);
        $stmt->execute();
        if ($stmt) {
            move_uploaded_file($file_temp, $uploaded_image);
            $alert = '<div class="alert alert-success">
            <span><b> Thêm thành công </b></span></div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger">
            <span><b> Thêm thất bại </b></span></div>';
            return $alert;
        }
    }
    /**
     *  news insert
     */
    public function edit_news($array)
    {
        //Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "../uploads/" . $unique_image;
        $conn = $this->db->connectionDB();
        if($file_ext!=""){
            $query = " UPDATE `tbl_news` SET `nameNews` = :nameNews,`tieude`=:tieude,`short_content`=:short_content,`newsContens`=:newsContens,`img`=:img
            WHERE `news_id`= :news_id ";
           $stmt = $conn->prepare($query);
           $stmt->bindParam(':nameNews', $array["nameNews"]);
           $stmt->bindParam(':tieude', $array["tieude"]);
           $stmt->bindParam(':short_content', $array["short_content"]);
           $stmt->bindParam(':newsContens', $array["newsContens"]);
           $stmt->bindParam(':news_id', $array["news_id"]);
           $stmt->bindParam(':img', $unique_image); 
           $stmt->execute();
        }else{
            $query = " UPDATE `tbl_news` SET `nameNews` = :nameNews,`tieude`=:tieude,`short_content`=:short_content,`newsContens`=:newsContens
            WHERE `news_id`= :news_id ";
           $stmt = $conn->prepare($query);
           $stmt->bindParam(':nameNews', $array["nameNews"]);
           $stmt->bindParam(':tieude', $array["tieude"]);
           $stmt->bindParam(':short_content', $array["short_content"]);
           $stmt->bindParam(':newsContens', $array["newsContens"]);
           $stmt->bindParam(':news_id', $array["news_id"]);
           $stmt->execute();
        }

        if ($stmt) {
            if($file_ext!=""){
                move_uploaded_file($file_temp, $uploaded_image);
            }
            $alert = '<div class="alert alert-success">
            <span><b> Chỉnh sửa thành công </b></span></div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger">
            <span><b> Chỉnh sửa thất bại </b></span></div>';
            return $alert;
        }
    }
    
      //delete news
     
    public function del_news($id)
    {
        $query = "DELETE FROM `tbl_news` WHERE `news_id` = '$id'";
        $result = $this->db->delete($query);

        if ($result) {
            $alert = '<div class="alert alert-success">
            <span><b> Xoá thành công </b></span></div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger">
            <span><b> Xoá thất bại </b></span></div>';
            return $alert;
        }
    }
    
    // check exist news
     
    public function check_exist_news($news_id)
    {
        $query = "SELECT COUNT(*) FROM tbl_news_detail WHERE `news_id` = $news_id";
        $result = $this->db->select($query);
        return $result;
    }
}