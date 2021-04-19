<?php
include_once '../lib/database.php';
include_once '../helper/format.php';

class DiemDanhModel
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    
    /**
     * [get_danh_sach_by_sh_id description]
     * @param  [type] $sh_id [description]
     * @return [type]        [description]
     */
    public function get_danh_sach_by_sh_id($sh_id)
    {
        $query = "SELECT `diem_danh_id`, `co_mat`, `id_student`, `sinhhoat_id` FROM `tbl_diemdanh` WHERE `sinhhoat_id` = $sh_id";
        $result = $this->db->select($query);

        return $result;
    }

    public function count_student_absent($month)
    {
        $query = "SELECT id_student,student.full_name,student.studentCode,COUNT(*) as vang 
                FROM (tbl_diemdanh
                INNER JOIN tbl_sinh_hoat_clb 
                ON tbl_sinh_hoat_clb.sinhhoat_id = tbl_diemdanh.sinhhoat_id)
                INNER JOIN student 
                ON student.studentID = tbl_diemdanh.id_student
                WHERE (MONTH(tbl_sinh_hoat_clb.thoi_gian)) = $month AND tbl_diemdanh.co_mat = 0
                GROUP BY  id_student";
        $result = $this->db->select($query);

        return $result;
    }

    /**
     * [insert_diem_danh description]
     * @param  [type] $array [description]
     * @return [type]        [description]
     */
    public function insert_diem_danh($array)
    {
        $conn = $this->db->connectionDB();
        $query = "INSERT INTO `tbl_diemdanh`(`co_mat`, `id_student`, `sinhhoat_id`) VALUES (:co_mat, :id_student, :sinhhoat_id)";
        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(':co_mat', $array["co_mat"]);
        $stmt->bindParam(':id_student', $array["id_student"]);
        $stmt->bindParam(':sinhhoat_id', $array["sinhhoat_id"]);
        
        $stmt->execute();
        
    }

    public function edit_diem_danh($id_student, $sinhhoat_id, $co_mat)
    {
        $conn = $this->db->connectionDB();
        
        $query = "UPDATE `tbl_diemdanh` SET `co_mat`=:co_mat WHERE `id_student` =:id_student AND `sinhhoat_id`=:sinhhoat_id ";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':co_mat', $co_mat);
        $stmt->bindParam(':sinhhoat_id', $sinhhoat_id);
        $stmt->bindParam(':id_student', $id_student);
        
        $stmt->execute();
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

    public function get_number_members_present($sinhhoat_id)
    {
        $query = "SELECT COUNT(*) as present FROM `tbl_diemdanh` WHERE `sinhhoat_id` = $sinhhoat_id AND `co_mat` = 1";
        $result = $this->db->select($query);

        return $result;
    }
    
}
