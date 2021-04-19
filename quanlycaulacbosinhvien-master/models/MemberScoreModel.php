<?php
include_once '../lib/database.php';
include_once '../helper/format.php';

class MemberScoreModel
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function count_mem_by_month_year_clbId($clb_id, $year, $month)
    {
        $query = "SELECT COUNT(*) AS member FROM `student` WHERE status = 1 AND clb_id = $clb_id AND YEAR(`create_at`) = $year AND  (MONTH(`create_at`)) = $month";
        $result = $this->db->select($query);
        
        return $result;
    }

    public function count_mem_by_clbId($clb_id)
    {
        $query = "SELECT COUNT(*) AS member FROM `student` WHERE status = 1 AND clb_id = $clb_id";
        $result = $this->db->select($query);
        
        return $result;
    }


    /**
     * [get_students_by_status description]
     * @param  [type] $status [description]
     * @return [type]         [description]
     */
    public function get_students_by_status($status)
    {
        $query = "SELECT `studentID`, `full_name`, `phone`, `studentCode`, `gmail`, `age`, `clb_id`, `reason`, `status`, `create_at`, `update_at` FROM `student` WHERE `status` = $status";
        $result = $this->db->select($query);
        
        return $result;
    }


    public function get_students_by_status_and_club($status, $club_id)
    {
        $query = "SELECT `studentID`, `full_name`, `phone`, `studentCode`, `gmail`, `age`, `clb_id`, `reason`, `status`, `create_at`, `update_at` FROM `student` WHERE `status` = $status AND `clb_id` = $club_id";
        $result = $this->db->select($query);
        
        return $result;
    }

    public function count_students_by_status_and_club($status, $club_id)
    {
        $query = "SELECT COUNT(`studentID`) AS `total` FROM `student` WHERE `status` = $status AND `clb_id` = $club_id";
        $result = $this->db->select($query);
        
        return $result;
    }

    /**
     * [get_students_by_status description]
     * @param  [type] $status [description]
     * @return [type]         [description]
     */
    public function get_students_by_id($id)
    {
        $query = "SELECT `studentID`, `full_name`, `phone`, `studentCode`, `gmail`, `age`, `clb_id`, `reason`, `status`, `create_at`, `update_at` FROM `student` WHERE `studentID` = $id";
        $result = $this->db->select($query);
        
        return $result;
    }

    /**
     * show member score by Id
     */
    public function show_memberscore_byId($id)
    {
        $query = "SELECT `id_score`, `totalScore`, `create_at`, `update_at`, `clb_id`, `feedback`, `id_student` FROM `tbl_memberscore` WHERE `id_score` = $id";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * [show_memberscore_by_student_id description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show_memberscore_by_student_id($id)
    {
        $query = "SELECT `id_score`, `totalScore`, `create_at`, `update_at`, `clb_id`, `feedback`, `id_student` FROM `tbl_memberscore` WHERE `id_student` = $id AND `status` != 0";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * show member score by Id
     */
    public function show_memberscore($clb_id)
    {
        $query = "SELECT `id_score`, `totalScore`, `create_at`, `update_at`, `feedback`, `clb_id`, `id_student`, `status` 
        FROM `tbl_memberscore` 
        WHERE  `status` != 0
        AND `clb_id` = $clb_id";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     *  event insert
     */
    public function insert_memberscore($array)
    {
        $conn = $this->db->connectionDB();
        $query = "INSERT INTO `tbl_memberscore`(`totalScore`, `clb_id`, `id_student`) VALUES (:totalScore,:clb_id,:id_student)";
        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(':totalScore', $array["totalScore"]);
        $stmt->bindParam(':clb_id', $array["clb_id"]);
        $stmt->bindParam(':id_student', $array["id_student"]);
        
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
    public function edit_memberScore($array)
    {
        $conn = $this->db->connectionDB();
        
        $query = "UPDATE `tbl_memberscore` SET `totalScore`=:totalScore, `create_at`=:create_at, `update_at` =:update_at,`clb_id`=:clb_id,`id_student`=:id_student WHERE `id_score`= :id_score";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':totalScore', $array["totalScore"]);
        $stmt->bindParam(':update_at', date("Y-m-d H:i:s"));
        $stmt->bindParam(':create_at', $array["create_at"]);
        $stmt->bindParam(':clb_id', $array["clb_id"]);
        $stmt->bindParam(':id_student', $array["id_student"]);
        $stmt->bindParam(':id_score', $array["memberScore_id"]);
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
     * [del_member_score description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function del_member_score($id)
    {
    	$conn = $this->db->connectionDB();

        $query = "UPDATE `tbl_memberscore` SET `status`=0 WHERE `id_score`=:id_score";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_score', $id);
        $stmt->execute();

        if ($stmt) {
            $alert = '<div class="alert alert-success">
            <span><b> Xoá thành công </b></span></div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger">
            <span><b> Xoá thất bại </b></span></div>';
            return $alert;
        }
    }
    
    /**
     * [feedback description]
     * @param  [type] $feedback [description]
     * @return [type]           [description]
     */
    public function feedback($feedback, $id_score)
    {
        $conn = $this->db->connectionDB();
        
        $query = "UPDATE `tbl_memberscore` SET `feedback`=:feedback WHERE `id_score`= :id_score";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':feedback', $feedback);
        $stmt->bindParam(':id_score', $id_score);
        $stmt->execute();
     


        if ($stmt) {
            $alert = '<div class="alert alert-success">
            <span><b> Feedback thành công </b></span></div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger">
            <span><b> Feedback thất bại </b></span></div>';
            return $alert;
        }
    }
}
