<?php
include_once '../lib/database.php';
include_once '../helper/format.php';

class EventModel
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    /**
     * show all event
     */
    public function show_event($type_id,$clb_id)
    {
        $query = "SELECT `event_id`, `nameEvent`, `title`, `startDay`, `endDay`, `place`, `request`,`img` FROM `tbl_event` WHERE `type_event`= $type_id and `clb_id` = $clb_id";
        $result = $this->db->select($query);
        return $result;
    }
    /**
     * [count_event_by_type_month_year description]
     * @param  [type] $type_event [description]
     * @param  [type] $month      [description]
     * @param  [type] $year       [description]
     * @return [type]             [description]
     */
    public function count_event_by_type_month_year($type_event, $month, $year){
        $query = "SELECT COUNT(*) AS number_event FROM `tbl_event` WHERE `type_event` = $type_event AND MONTH(`startDay`) = $month AND YEAR(`startDay`) = $year";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * [count_all_event_by_type description]
     * @param  [type] $type_event [description]
     * @return [type]             [description]
     */
    public function count_all_event_by_type($type_event)
    {
        $query = "SELECT COUNT(*) AS number_event FROM `tbl_event` WHERE `type_event` = $type_event";
        $result = $this->db->select($query);
        return $result;
    }
        /**
     * show all event of clb 
     */
    public function show_event_by_clb($clb_id)
    {
        $query = "SELECT * FROM `tbl_event` WHERE `clb_id` = $clb_id AND `type_event` = 2";
        $result = $this->db->select($query);
        return $result;
    }
        /**
     * show list member event
     */
    public function show_list_member($event_id)
    {
        $query = "SELECT student.* FROM `tbl_event_member`
        INNER JOIN student 
        ON tbl_event_member.student_id = student.studentID
        WHERE `event_id` = $event_id";
        $result = $this->db->select($query);
        return $result;
    }
    /**
     * show all event
     */
    public function show_event_byId($id)
    {
        $query = "SELECT  `event_id`, `nameEvent`, `title`, `short_content`, `content`, `startDay`, `endDay`, `place`, `request`, `create_at`, `update_at`, `img`, `type_event`
        FROM `tbl_event` WHERE event_id = $id";
        $result = $this->db->select($query);
        return $result;
    }
    /**
     *  event insert
     */
    public function insert_event($array, $type_id,$clb_id)
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
        $query = "INSERT INTO `tbl_event`( `nameEvent`,`title`,`short_content`, `content`, `startDay`, `endDay`, `place`, `request`,`img`,`type_event`,`clb_id`)
    VALUES (:nameEvent,:title,:short_content,:content,:startDay,:endDay,:place,:request,:img,:type_event,:clb_id)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nameEvent', $array["nameEvent"]);
        $stmt->bindParam(':title', $array["title"]);
        $stmt->bindParam(':short_content', $array["short_content"]);
        $stmt->bindParam(':content', $array["content"]);
        $stmt->bindParam(':startDay', $array["startDay"]);
        $stmt->bindParam(':endDay', $array["endDay"]);
        $stmt->bindParam(':place', $array["place"]);
        $stmt->bindParam(':request', $array["request"]);
        $stmt->bindParam(':img', $unique_image);
        $stmt->bindParam(':type_event', $type_id);
        $stmt->bindParam(':clb_id', $clb_id);
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
     *  event insert
     */
    public function edit_event($array)
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
        if ($file_ext != "") {
            $query = "UPDATE `tbl_event` SET `nameEvent`= :nameEvent,`title`=:title,`short_content`=:short_content,`content`=:content,`startDay`=:startDay,`endDay`=:endDay,`place`=:place,
            `request`=:request, `img`=:img WHERE `event_id`= :event_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':nameEvent', $array["nameEvent"]);
            $stmt->bindParam(':title', $array["title"]);
            $stmt->bindParam(':short_content', $array["short_content"]);
            $stmt->bindParam(':content', $array["content"]);
            $stmt->bindParam(':startDay', $array["startDay"]);
            $stmt->bindParam(':endDay', $array["endDay"]);
            $stmt->bindParam(':place', $array["place"]);
            $stmt->bindParam(':request', $array["request"]);
            $stmt->bindParam(':event_id', $array["event_id"]);
            $stmt->bindParam(':img', $unique_image);
            $stmt->execute();
        } else {
            $query = "UPDATE `tbl_event` SET `nameEvent`= :nameEvent,`title`=:title,`short_content`=:short_content,`content`=:content,`startDay`=:startDay,`endDay`=:endDay,`place`=:place,
            `request`=:request WHERE `event_id`= :event_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':nameEvent', $array["nameEvent"]);
            $stmt->bindParam(':title', $array["title"]);
            $stmt->bindParam(':short_content', $array["short_content"]);
            $stmt->bindParam(':content', $array["content"]);
            $stmt->bindParam(':startDay', $array["startDay"]);
            $stmt->bindParam(':endDay', $array["endDay"]);
            $stmt->bindParam(':place', $array["place"]);
            $stmt->bindParam(':request', $array["request"]);
            $stmt->bindParam(':event_id', $array["event_id"]);
            $stmt->execute();
        }


        if ($stmt) {
            if ($file_ext != "") {
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
    /**
     * delete event
     */
    public function del_event($id)
    {
        $query = "DELETE FROM `tbl_event` WHERE `event_id` = '$id'";
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
    /**
     * check exist event
     */
    public function check_exist_event($event_id)
    {
        $query = "SELECT COUNT(*) FROM tbl_event_detail WHERE `event_id` = $event_id";
        $result = $this->db->select($query);
        return $result;
    }
    /**
     *  clb will register event of school
     */
    public function register_event($array)
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
        //add form event register
        $conn = $this->db->connectionDB();
        $query = "INSERT INTO `tbl_event_detail`( `clb_id`, `quantity`, `event_id`, `description`, `content`, `img`, `status`) VALUES
        (:clb_id,:quantity,:event_id,:descr,:content,:img,0)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':clb_id', $array["clb_id"]);
        $stmt->bindParam(':quantity', $array["quantity"]);
        $stmt->bindParam(':event_id', $array["event_id"]);
        $stmt->bindParam(':descr', $array["description"]);
        $stmt->bindParam(':content', $array["content"]);
        $stmt->bindParam(':img', $unique_image);
        $stmt->execute();

        if ($stmt) {
            $qty = $array['student_id'];
            $event_id = $array["event_id"];
            try {
                if (is_array($qty))
                {
                  for ($i=0;$i<sizeof($qty);$i++)
                  {
                    $this->db->insertdata("INSERT INTO `tbl_event_member`(`student_id`, `event_id`) VALUES ($qty[$i],$event_id)");
                  }
                }
            } catch (Exception $th) {
                //throw $th;
            }
            move_uploaded_file($file_temp, $uploaded_image);
            $alert = '<div class="alert alert-success">
                    <span><b> Đăng ký thành công </b></span></div>';
            return $alert;
        } else {
            $alert = '<div class="alert alert-danger">
                    <span><b> Đăng ký thất bại </b></span></div>';
            return $alert;
        }
    }
    /**
     * show all request event register 
     */
    public function show_request_register($event_id)
    {
        $query = "SELECT tbl_event_detail.quantity,tbl_event_detail.content,tbl_event_detail.description,tbl_event_detail.img,
        tbl_caulacbo.clbName,tbl_event_detail.event_detail_id
        FROM `tbl_event_detail`
        INNER JOIN tbl_caulacbo ON tbl_event_detail.clb_id = tbl_caulacbo.clb_id WHERE (event_id = $event_id AND status = 0) ";
        $result = $this->db->select($query);
        return $result;
    }
    /**
     * accept register
     */
    public function accept_event_register($id)
    {
        $query = "UPDATE `tbl_event_detail` SET `status`= 1 WHERE `event_detail_id`= $id";
        $result = $this->db->select($query);
        return $result;
    }
    /**
     * delete event register
     */
    public function delete_register($id)
    {
        $query = "DELETE FROM `tbl_event_detail` WHERE `event_detail_id` = $id";
        $result = $this->db->select($query);
        return $result;
    }
    /**
     * event show by CLB id
     */
    public function show_event_byCLB($id)
    {
        $query = "SELECT COUNT(*) FROM `tbl_event` WHERE `clb_id` =  $id";
        $result = $this->db->select($query);
        return $result;
    }
    public function checkRegisterEvent($stu,$event_id)
    {
        $query = "SELECT * FROM `tbl_event_member_clb` WHERE `event_id` = $event_id AND `student_id` = $stu";
        $result = $this->db->select($query);
        if($result != null){
            return false;
        }
        return true;
    }

    public function select_member_register_clb($event_id)
    {
        $query = "SELECT e.id,s.full_name,s.studentCode, e.reason,e.`status` 
        FROM `tbl_event_member_clb` as e
        INNER JOIN student as s
        ON s.studentID = e.student_id
        WHERE e.event_id = ".$event_id;
        $result = $this->db->select($query);
        return $result;
    }

    public function accept_register($id)
    {
        $query = "UPDATE `tbl_event_member_clb` SET `status`= 1  WHERE `id` = $id";
        $result = $this->db->update($query);
            $alert = '<div class="alert alert-success">
            <span><b> Chấp nhận thành công </b></span></div>';
            return $alert;
    }
    public function delete_member_register($id)
    {
        $query = "DELETE FROM `tbl_event_member_clb` WHERE `id` = '$id'";
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
    public function checkDate($curdate, $mydate)
    {
        if($curdate > $mydate){
            return false;
            //echo '<span class="status expired">sai</span>';
          }else{
            return true;
            //echo '<span class="status expired">dung</span>';
          }
    }
}
