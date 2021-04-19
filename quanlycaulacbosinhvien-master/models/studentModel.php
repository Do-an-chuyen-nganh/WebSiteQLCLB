<?php
include_once '../lib/database.php';
include_once '../helper/format.php';

class studentModel
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insertStudent($array)
    {
        $db = new Database();
        return $db->insert($array);
    }

    public function get_students_by_clb($clb_id)
    {
        $query = "SELECT * FROM `student` WHERE `clb_id` = $clb_id AND `status` = 1";
        $result = $this->db->select($query);

        return $result;
    }
    public function get_student_export($clb_id)
    {
        $query = "SELECT `full_name`,`studentCode`,`phone`,`gmail`,`age`,`create_at` FROM `student` WHERE `clb_id` = $clb_id AND `status` = 1";
        $result = $this->db->select($query);

        return $result;
    }
    public function getMemberClub($clb_id)
    {
        $query = "SELECT `studentID`, `full_name`, `phone`, `studentCode`, `gmail`, `age`, `reason`, `create_at`  FROM `student` WHERE `clb_id` = $clb_id and `status` = 1";
        $result = $this->db->select($query);

        return $result;
    }
    public function getStudentWaitingAccept($clb_id)
    {
        $query = "SELECT `studentID`, `full_name`, `phone`, `studentCode`, `gmail`, `age`, `reason`, `create_at` FROM `student` WHERE `clb_id` = $clb_id and `status` = 0";
        $result = $this->db->select($query);

        return $result;
    }
    public function deleteMemberClub($id)
    {
        $query = "UPDATE `student` SET `clb_id` = 0, `status` = -1 WHERE `studentID` = $id";
        $result = $this->db->select($query);
            $alert = '<div class="alert alert-success">
            <span><b> Xoá thành công </b></span></div>';
            return $alert;
    }
    public function registerClub($sid,$clb_id,$array)
    {
        $reason = $array['reason'];
        $query = "UPDATE `student` SET `clb_id` = $clb_id, `status` = 0,`reason`= '$reason' WHERE `studentID` = $sid";
        $result = $this->db->update($query);
            $alert = '<div class="alert alert-success">
            <span><b> Đăng ký thành công </b></span></div>';
            return $alert;
    }
    public function insertMemberEventClub($student_id,$array,$event_id)
    {
        $reason = $array['reason'];
        $query = "INSERT INTO `tbl_event_member_clb`(`student_id`, `reason`, `status`, `event_id`) VALUES (:student_id,:reason,0,:event_id)";
        $conn = $this->db->connectionDB();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':student_id', $student_id);
        $stmt->bindParam(':reason', $reason);
        $stmt->bindParam(':event_id', $event_id);
        $stmt->execute();
        if ($stmt) {
            $alert = '<div class="alert alert-success">
            <span><b> Đăng ký thành công </b></span></div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger">
            <span><b> Đăng ký thất bại </b></span></div>';
            return $alert;
        }
    }


    
}
