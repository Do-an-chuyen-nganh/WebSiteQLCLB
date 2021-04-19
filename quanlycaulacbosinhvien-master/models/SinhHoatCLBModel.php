<?php
include_once '../lib/database.php';
include_once '../helper/format.php';

class SinhHoatCLBModel
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    /**
     * [get_sinh_hoat_by_status]
     * @param  [type] $status [description]
     * @return [type]         [description]
     */
    public function get_sinh_hoat_by_status($status, $clb_id)
    {
        $query = "SELECT `sinhhoat_id`, `ten_buoi_sh`, `noi_dung_sh`, `thoi_gian`, `sl_tham_gia`, `tong_sl_thanh_vien_hien_tai`, `status`, `clb_id` 
        FROM `tbl_sinh_hoat_clb` WHERE `status` != -1 AND `clb_id` = $clb_id";
        if($status != -1) {
            $query = "SELECT `sinhhoat_id`, `ten_buoi_sh`, `noi_dung_sh`, `thoi_gian`, `sl_tham_gia`, `tong_sl_thanh_vien_hien_tai`, `status`, `clb_id` 
            FROM `tbl_sinh_hoat_clb` WHERE `status` = $status  AND `clb_id` = $clb_id";
        }
        
        $result = $this->db->select($query);
        return $result;
    }

    public function get_sinh_hoat_by_id($id)
    {
       
        $query = "SELECT `sinhhoat_id`, `ten_buoi_sh`, `noi_dung_sh`, `thoi_gian`, `sl_tham_gia`, `tong_sl_thanh_vien_hien_tai`, `status`, `clb_id` FROM `tbl_sinh_hoat_clb` WHERE `sinhhoat_id` = $id";
    
        
        $result = $this->db->select($query);
        return $result;
    }    


    /**
     * [insert_buoi_sinh_hoat description] tạo buổi sinh hoạt mới
     * @param  [type] $array [description]
     * @return [type]        [description]
     */
    public function insert_buoi_sinh_hoat($array)
    {
        $conn = $this->db->connectionDB();
        $query = "INSERT INTO `tbl_sinh_hoat_clb`(`ten_buoi_sh`, `noi_dung_sh`, `thoi_gian`, `sl_tham_gia`, `tong_sl_thanh_vien_hien_tai`, `status`, `clb_id`) VALUES (:ten_buoi_sh, :noi_dung_sh, :thoi_gian, :sl_tham_gia, :tong_sl_thanh_vien_hien_tai, :status, :clb_id)";
        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(':ten_buoi_sh', $array["ten_buoi_sh"]);
        $stmt->bindParam(':noi_dung_sh', $array["noi_dung_sh"]);
        $stmt->bindParam(':thoi_gian', $array["thoi_gian"]);
        $stmt->bindParam(':sl_tham_gia', $array["sl_tham_gia"]);
        $stmt->bindParam(':tong_sl_thanh_vien_hien_tai', $array["tong_sl_thanh_vien_hien_tai"]);
        $stmt->bindParam(':status', $array["status"]);
        $stmt->bindParam(':clb_id', $array["clb_id"]);
        
        $stmt->execute();
        if ($stmt) {
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
     *  edit member score
     */
    public function edit_buoi_sinh_hoat($array)
    {
        $conn = $this->db->connectionDB();
        
        $query = "UPDATE `tbl_sinh_hoat_clb` SET `ten_buoi_sh`=:ten_buoi_sh,`noi_dung_sh`=:noi_dung_sh,`thoi_gian`=:thoi_gian,`sl_tham_gia`=:sl_tham_gia,`tong_sl_thanh_vien_hien_tai`=:tong_sl_thanh_vien_hien_tai,`status`=:status,`clb_id`=:clb_id WHERE `sinhhoat_id`=:sinhhoat_id";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':ten_buoi_sh', $array["ten_buoi_sh"]);
        $stmt->bindParam(':noi_dung_sh', $array["noi_dung_sh"]);
        $stmt->bindParam(':thoi_gian', $array["thoi_gian"]);
        $stmt->bindParam(':sl_tham_gia', $array["sl_tham_gia"]);
        $stmt->bindParam(':tong_sl_thanh_vien_hien_tai', $array["tong_sl_thanh_vien_hien_tai"]);
        $stmt->bindParam(':status', $array["status"]);
        $stmt->bindParam(':clb_id', $array["clb_id"]);
        $stmt->bindParam(':sinhhoat_id', $array["sinhhoat_id"]);
        
        $stmt->execute();
     


        if ($stmt) {
            $alert = '<div class="alert alert-success">
            <span><b> Chỉnh sửa thành công </b></span></div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger">
            <span><b> Chỉnh sửa thất bại </b></span></div>';
            return $alert;
        }
    }
    /**
     * [set_status_da_sinh_hoat description] 1 là chưa sinh hoạt, 0 là đã sinh hoạt, -1 là đã xóa   
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function set_status($id, $status)
    {
    	$conn = $this->db->connectionDB();

        $query = "UPDATE `tbl_sinh_hoat_clb` SET `status`= $status WHERE `sinhhoat_id`= $id";
        $stmt = $conn->prepare($query);
        
        $stmt->execute();

        if ($stmt) {
            $alert = '<div class="alert alert-success">
            <span><b>Đã xóa sinh hoạt thành công </b></span></div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger">
            <span><b> Đã xóa đã sinh hoạt thất bại </b></span></div>';
            return $alert;
        }
    }

    public function edit_numbers_of_mem_tham_gia($sinhhoat_id, $sl_tham_gia)
    {
        $conn = $this->db->connectionDB();

        $query = "UPDATE `tbl_sinh_hoat_clb` SET `sl_tham_gia`= $sl_tham_gia WHERE `sinhhoat_id`= $sinhhoat_id";
        $stmt = $conn->prepare($query);
        
        $stmt->execute();
    }
    
}
