<?php
include '../lib/database.php';
include '../helper/format.php';
Session::checkLoginHome();
class HomeModel
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function home_login($gmail, $password)
    {
        $gmail = $this->fm->validation($gmail);
        $password = $this->fm->validation($password);

        $gmail = mysqli_real_escape_string($this->db->link, $gmail);
        $password = mysqli_real_escape_string($this->db->link, $password);

        if (empty($gmail) || empty($password)) {
            $alert = "Tài khoản và mật khẩu không được bỏ trống ";
            return $alert;
        } else {
            $query = "SELECT * FROM `student` WHERE `gmail` = '$gmail' AND `password`= '$password'";
            $result = $this->db->select($query);

            if ($result != false) {
                $value = $result;

                Session::set('homeLogin', true); //Kiểm tra đã tồn tại trong hàm set session.php
                Session::set('student', $value);

                header('location:index.php');
            } else {
                $alert = "Tài khoản hoặc mật khẩu không trùng khớp";
                return $alert;
            }
        }
    }
    public function register_student($array)
    {
        if ($this->checkExistGmail($array["gmail"]) == true) {
            $conn = $this->db->connectionDB();
            $pw = md5($array["password"]);
            $query = "INSERT INTO `student`(`full_name`, `phone`, `studentCode`, `gmail`, `password`, `age`, `clb_id`, `status`)
                VALUES (:full_name,:phone,:studentCode,:gmail,:pw,:age,-1,-1)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':full_name', $array["fullName"]);
            $stmt->bindParam(':phone', $array["phone"]);
            $stmt->bindParam(':studentCode', $array["studentCode"]);
            $stmt->bindParam(':gmail', $array["gmail"]);
            $stmt->bindParam(':pw', $pw);
            $stmt->bindParam(':age', $array["age"]);
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
        } else {
            $alert = '<div class="alert alert-danger">
                <span><b> Gmail đã tồn tại </b></span></div>';
            return $alert;
        }

    }
    public function checkExistGmail($gmail)
    {
        $query = "SELECT `gmail` FROM `student` WHERE `gmail` = '$gmail'";
        $result = $this->db->select($query);
        if ($result != null) {
            return false;
        }
        return true;
    }
    public function randomPassword($length,$count, $characters,$gmail)
    {
        // define variables used within the function
        $symbols = array();
        $passwords = array();
        $used_symbols = '';
        $pass = '';
        // an array of different character types
        $symbols["lower_case"] = 'abcdefghijklmnopqrstuvwxyz';
        $symbols["upper_case"] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $symbols["numbers"] = '1234567890';
        $symbols["special_symbols"] = '!?~@#-_+<>[]{}';
        $characters = mb_split(",", $characters); // get characters types to be used for the passsword
        foreach ($characters as $key => $value) {
            $used_symbols .= $symbols[$value]; // build a string with all characters
        }
        $symbols_length = strlen($used_symbols) - 1; //strlen starts from 0 so to get number of characters deduct 1

        for ($p = 0; $p < $count; $p++) {
            $pass = '';
            for ($i = 0; $i < $length; $i++) {
                $n = rand(0, $symbols_length); // get a random character from the string with all characters
                $pass .= $used_symbols[$n]; // add the character to the password string
            }
            $passwords[] = $pass;

        }
        $result2 = md5(implode("",$passwords));
        $query = "UPDATE `student` SET `password` = '$result2' WHERE `gmail` = '$gmail' ";
        $result = $this->db->update($query);
        if ($result) {
            return  $passwords;
        }
        return false;
        
    }
}
