<?php
include_once '../lib/database.php';
include_once '../helper/format.php';

class FinanceModel
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    /**
     * [show_finance_receive_by_month_year description] tong thu cua 1 thang trong nam
     * @param  [type] $month [description]
     * @param  [type] $year  [description]
     * @return [type]        [description]
     */
    public function show_finance_receive_by_month_year($clb_id, $month, $year)
    {
        $query = "SELECT SUM(`sotienthu`), MONTH(`ngayThu`) FROM `tblquy_thu` WHERE clb_id = $clb_id AND MONTH(`ngayThu`) = $month AND YEAR(`ngayThu`) = $year";
        $result = $this->db->select($query);
        return $result;
    }
    /**
     * [show_finance__by_month_year description]
     * @param  [type] $month [description]
     * @param  [type] $year  [description]
     * @return [type]        [description]
     */
    public function show_finance_expense_by_month_year($clb_id, $month, $year)
    {
        $query = "SELECT SUM(`sotienchi`), MONTH(`ngayChi`) FROM `tblquy_chi` WHERE clb_id = $clb_id AND MONTH(`ngayChi`) = $month AND YEAR(`ngayChi`) = $year";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * show all finance receiver
     */
    public function show_finance_receive($clb_id)
    {
        $query = "SELECT `khoanThu_id`, `tenKhoanthu`, `sotienthu`, `ngayThu`, `clb_id`, `noidung`, `imgHoaDonThu` FROM `tblquy_thu` Where clb_id = $clb_id ORDER BY ngayThu ASC";
        $result = $this->db->select($query);
        return $result;
    }
    /**
     * show all finance expense
     */
    public function show_finance_expense($clb_id)
    {
        $query = "SELECT `khoanChi_id`, `tenKhoanChi`, `sotienchi`, `ngayChi`, `clb_id`, `lydo`, `ten_nguoi_chi`, `imgHoaDon` FROM `tblquy_chi` Where clb_id = $clb_id  ORDER BY ngayChi ASC";
        $result = $this->db->select($query);
        return $result;
    }
    /**
     * show finance receiver by id
     */
    public function show_finance_receive_byId($id)
    {
        $query = "SELECT `khoanThu_id`, `tenKhoanthu`, `sotienthu`, `ngayThu`, `clb_id`, `noidung`, `imgHoaDonThu` FROM `tblquy_thu` WHERE `khoanThu_id` = $id";
        $result = $this->db->select($query);
        return $result;
    }
    /**
     * show finance expense by id
     */
    public function show_finance_expense_byId($id)
    {
        $query = "SELECT `tenKhoanChi`, `sotienchi`, `ngayChi`, `clb_id`, `lydo`, `ten_nguoi_chi`, `imgHoaDon` FROM `tblquy_chi` WHERE `khoanChi_id` = $id";
        $result = $this->db->select($query);
        return $result;
    }
    /**
     *  event insert
     */
    public function insert_finance_receive($array)
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
            $query = "INSERT INTO `tblquy_thu`(`tenKhoanthu`, `sotienthu`, `ngayThu`, `clb_id`, `noidung`, `imgHoaDonThu`)
            VALUES (:tenKhoanthu,:sotienthu,:ngayThu,:clb_id,:noidung,:imgHoaDonThu)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':tenKhoanthu', $array["tenKhoanthu"]);
            $stmt->bindParam(':sotienthu', $array["sotienthu"]);
            $stmt->bindParam(':ngayThu', $array["ngayThu"]);
            $stmt->bindParam(':clb_id', $array["clb_id"]);
            $stmt->bindParam(':noidung', $array["noidung"]);
            $stmt->bindParam(':imgHoaDonThu', $unique_image);
            $stmt->execute();
        }else{
            $query = "INSERT INTO `tblquy_thu`(`tenKhoanthu`, `sotienthu`, `ngayThu`, `clb_id`, `noidung`)
            VALUES (:tenKhoanthu,:sotienthu,:ngayThu,:clb_id,:noidung)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':tenKhoanthu', $array["tenKhoanthu"]);
            $stmt->bindParam(':sotienthu', $array["sotienthu"]);
            $stmt->bindParam(':ngayThu', $array["ngayThu"]);
            $stmt->bindParam(':clb_id', $array["clb_id"]);
            $stmt->bindParam(':noidung', $array["noidung"]);
            $stmt->execute();
        }

        if ($stmt) {
            if($file_ext!=""){
                move_uploaded_file($file_temp, $uploaded_image);
            }
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
     *  finance expense insert
     */
    public function insert_finance_expense($array)
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
        $query = "INSERT INTO `tblquy_chi`(`tenKhoanChi`, `sotienchi`, `ngayChi`, `clb_id`, `lydo`, `ten_nguoi_chi`, `imgHoaDon`)
         VALUES (:tenKhoanChi,:sotienchi,:ngayChi,:clb_id,:lydo,:ten_nguoi_chi,:imgHoaDon)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':tenKhoanChi', $array["tenKhoanChi"]);
        $stmt->bindParam(':sotienchi', $array["sotienchi"]);
        $stmt->bindParam(':ngayChi', $array["ngayChi"]);
        $stmt->bindParam(':clb_id', $array["clb_id"]);
        $stmt->bindParam(':lydo', $array["lydo"]);
        $stmt->bindParam(':ten_nguoi_chi', $array["ten_nguoi_chi"]);
        $stmt->bindParam(':imgHoaDon', $unique_image);
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
     *  edit finance expense
     */
    public function edit_finance_reivece($array)
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
            $query = "UPDATE `tblquy_thu` SET `tenKhoanthu`=:tenKhoanthu,`sotienthu`=:sotienthu,`ngayThu`=:ngayThu,`clb_id`=:clb_id,
            `noidung`=:noidung,`imgHoaDonThu`=:imgHoaDonThu WHERE `khoanThu_id`= :f_receive_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':tenKhoanthu', $array["tenKhoanthu"]);
            $stmt->bindParam(':sotienthu', $array["sotienthu"]);
            $stmt->bindParam(':ngayThu', $array["ngayThu"]);
            $stmt->bindParam(':clb_id', $array["clb_id"]);
            $stmt->bindParam(':noidung', $array["noidung"]);
            $stmt->bindParam(':f_receive_id', $array["f_receive_id"]);
            $stmt->bindParam(':imgHoaDonThu', $unique_image);
            $stmt->execute();
        }else{
            $query = "UPDATE `tblquy_thu` SET `tenKhoanthu`=:tenKhoanthu,`sotienthu`=:sotienthu,`ngayThu`=:ngayThu,`clb_id`=:clb_id,
            `noidung`=:noidung WHERE `khoanThu_id`= :f_receive_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':tenKhoanthu', $array["tenKhoanthu"]);
            $stmt->bindParam(':sotienthu', $array["sotienthu"]);
            $stmt->bindParam(':ngayThu', $array["ngayThu"]);
            $stmt->bindParam(':clb_id', $array["clb_id"]);
            $stmt->bindParam(':noidung', $array["noidung"]);
            $stmt->bindParam(':f_receive_id', $array["f_receive_id"]);
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
            /**
     *  finance expense insert
     */
    public function edit_finance_expense($array)
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
            $query = "UPDATE `tblquy_chi` SET `tenKhoanChi`=:tenKhoanChi,`sotienchi`=:sotienchi,`ngayChi`=:ngayChi,`clb_id`=:clb_id,
            `lydo`=:lydo,`ten_nguoi_chi`=:ten_nguoi_chi,`imgHoaDon`= :imgHoaDon WHERE `khoanChi_id`= :khoanChi_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':tenKhoanChi', $array["tenKhoanChi"]);
            $stmt->bindParam(':sotienchi', $array["sotienchi"]);
            $stmt->bindParam(':ngayChi', $array["ngayChi"]);
            $stmt->bindParam(':clb_id', $array["clb_id"]);
            $stmt->bindParam(':lydo', $array["lydo"]);
            $stmt->bindParam(':ten_nguoi_chi', $array["ten_nguoi_chi"]);
            $stmt->bindParam(':khoanChi_id', $array["khoanChi_id"]);
            $stmt->bindParam(':imgHoaDon', $unique_image);
            $stmt->execute();
        }else{
            $query = "UPDATE `tblquy_chi` SET `tenKhoanChi`=:tenKhoanChi,`sotienchi`=:sotienchi,`ngayChi`=:ngayChi,`clb_id`=:clb_id,
            `lydo`=:lydo,`ten_nguoi_chi`=:ten_nguoi_chi WHERE `khoanChi_id`= :khoanChi_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':tenKhoanChi', $array["tenKhoanChi"]);
            $stmt->bindParam(':sotienchi', $array["sotienchi"]);
            $stmt->bindParam(':ngayChi', $array["ngayChi"]);
            $stmt->bindParam(':clb_id', $array["clb_id"]);
            $stmt->bindParam(':lydo', $array["lydo"]);
            $stmt->bindParam(':ten_nguoi_chi', $array["ten_nguoi_chi"]);
            $stmt->bindParam(':khoanChi_id', $array["khoanChi_id"]);
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
    /**
     * delete finance ex
     */
    public function delete_finance_receive($id)
    {
        $query = "DELETE FROM `tblquy_thu` WHERE `khoanThu_id` = '$id'";
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
     * delete event
     */
    public function delete_finance_expense($id)
    {
        $query = "DELETE FROM `tblquy_chi` WHERE `khoanChi_id` = '$id'";
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
        /**
     * calculate total finance 
     */
    public function total_finance($clb_id)
    {
        $query = "SELECT SUM(`sotienthu`) FROM `tblquy_thu` WHERE `clb_id` = $clb_id";
        $result = $this->db->select($query);
        $query = "SELECT SUM(tblquy_chi.sotienchi) FROM tblquy_chi WHERE `clb_id` = $clb_id";
        $result2 = $this->db->select($query);
        return $result[0][0] - $result2[0][0];
    }
}
