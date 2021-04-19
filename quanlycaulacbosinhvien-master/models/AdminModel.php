<?php
include_once '../lib/database.php';
include_once '../helper/format.php';

class AdminModel
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    /**
     * [get_all_admin description] lấy danh sách admin trừ thằng có id truyền vào
     * @param  [type] $id_login [description]
     * @return [type]           [description]
     */
    public function get_all_admin($id_login)
    {
        $query = "SELECT `adminId`, `adminName`, `adminEmail`, `adminUser`, `adminPass`, `level`, `clb_id` FROM `tbl_admin` WHERE `adminId` != $id_login AND `clb_id` != -1";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * [get_all_admin_by_id description] get admin by id
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function get_all_admin_by_id($id)
    {
        $query = "SELECT `adminId`, `adminName`, `adminEmail`, `adminUser`, `adminPass`, `level`, `clb_id` FROM `tbl_admin` WHERE `adminId` = $id AND `clb_id` != -1";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * [insert_new_admin description]
     * @param  [type] $array [description]
     * @return [type]        [description]
     */
    public function insert_new_admin($array)
    {
        $conn = $this->db->connectionDB();
        $query = "INSERT INTO `tbl_admin`(`adminName`, `adminEmail`, `adminUser`, `adminPass`, `level`, `clb_id`) VALUES (:adminName, :adminEmail, :adminUser,:adminPass, :level, :clb_id)";
        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(':adminName', $array["adminName"]);
        $stmt->bindParam(':adminEmail', $array["adminEmail"]);
        $stmt->bindParam(':adminUser', $array["adminUser"]);
        $stmt->bindParam(':adminPass', md5($array["adminPass"]));
        $stmt->bindParam(':level', $array["level"]);
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
     * [edit_admin description]
     * @param  [type] $array [description]
     * @return [type]        [description]
     */
    public function edit_admin($array)
    {
        $conn = $this->db->connectionDB();
        
        $query = "UPDATE `tbl_admin` SET `adminName`=:adminName,`adminEmail`=:adminEmail,`adminUser`=:adminUser,`level`=:level,`clb_id`=:clb_id WHERE `adminId`= :adminId";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':adminName', $array["adminName"]);
        $stmt->bindParam(':adminEmail', $array["adminEmail"]);
        $stmt->bindParam(':adminUser', $array["adminUser"]);
        $stmt->bindParam(':level', $array["level"]);
        $stmt->bindParam(':clb_id', $array["clb_id"]);
        $stmt->bindParam(':adminId', $array["adminId"]);
        
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
     * [delete_admin description] admin có clb id = -1 là đã xóa
     * @param  [type] $clb_id  [description]
     * @param  [type] $adminId [description]
     * @return [type]          [description]
     */
    public function delete_admin($adminId)
    {
        $conn = $this->db->connectionDB();

        $query = "UPDATE `tbl_admin` SET `clb_id`= -1 WHERE `adminId` = $adminId";
        $stmt = $conn->prepare($query);
        
        $stmt->execute();
    }
    public function changePassword($array,$admin_id)
    {
        $pas = md5($array['password']);
        $newPas = md5($array['new-password']);
        $query = "SELECT `adminId` FROM `tbl_admin` WHERE `adminPass` = '$pas' AND `adminId` = $admin_id";
        $result = $this->db->select($query);
        if($result != null){
            $query = "UPDATE `tbl_admin` SET `adminPass` = '$newPas' WHERE `adminId` = $admin_id";
            $result2 = $this->db->update($query);
            if($result2){
                $alert = '<div class="alert alert-success">
                <span><b> Thay đổi mật khẩu thành công </b></span></div>';
                return $alert;
            }else{
                $alert = '<div class="alert alert-danger">
                <span><b> Thay đổi mật khẩu thất bại </b></span></div>';
                return $alert;
            }
        }else{
            $alert = '<div class="alert alert-danger">
            <span><b> Mật khẩu không đúng ! </b></span></div>';
            return $alert;
        }

    }
    
}
