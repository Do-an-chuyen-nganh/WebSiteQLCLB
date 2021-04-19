<?php
    include '../lib/session.php';
    Session::checkLogin();
    include '../lib/database.php';
    include '../helper/format.php';

    class adminlogin
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function login_admin($adminUser, $adminPass)
        {
            $adminUser = $this->fm->validation($adminUser);
            $adminPass = $this->fm->validation($adminPass);

            $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
            $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

            if(empty($adminUser) || empty($adminPass)){
                $alert = "Tài khoản và mật khẩu không được bỏ trống ";
                return $alert;
            }else{
                $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1";
                $result = $this->db->select($query);
                
                if($result != false){
                    $value = $result;
                    Session::set('adminlogin', true); //Kiểm tra đã tồn tại trong hàm set session.php
                    Session::set('adminId', $value[0][0]);
                    Session::set('adminUser', $value[0][3]);
                    Session::set('adminName', $value[0][1]);
                    Session::set('clb_id', $value[0][6]);
                    if($value[0][6]!=0){
                        header('Location:index.php');
                    }else{
                        header('Location:Newslist.php');
                    }
                    
                }else{
                    $alert = "Tài khoản hoặc mật khẩu không trùng khớp";
                    return $alert;
                }
            }
        }

    }
?>
