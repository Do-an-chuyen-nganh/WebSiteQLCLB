<?php
  include '../config/config.php';

  Class Database{
    public $host   = DB_HOST;
    public $user   = DB_USER;
    public $pass   = DB_PASS;
    public $dbname = DB_NAME;
    public $link;
    public $error;

  public function __construct(){
    $this->connectDB();
  }
  
  public function connectDB(){
    $this->link = new mysqli($this->host, $this->user, $this->pass, 
      $this->dbname);
    if(!$this->link){
      $this->error ="Kết nối thất bại".$this->link->connect_error;
      return false;
    }
  }

  public function connectionDB()
  {
    try {
      $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conn;
  } catch(PDOException $e) {
        echo "Kết nối thất bại" . $e->getMessage();
  }
  }
  
  public function selectdata($query){
    $result = $this->link->query($query) or 
    die($this->link->error.__LINE__);
    if($result->num_rows > 0){
      return $result;
    } else {
      return false;
    }
  }
  // Insert data
  public function insertdata($query){
    $insert_row = $this->link->query($query) or 
      die($this->link->error.__LINE__);
    if($insert_row){
      return $insert_row;
    } else {
      return false;
      }
  }
  
  // Insert data
  public function insert($array){
    $conn = $this->connectionDB();
    $query = "INSERT INTO `student`(`full_name`, `phone`, `studentCode`, `gmail`, `age`, `clb`, `reason`,  `status`)
    VALUES (:full_name, :phone, :studentCode, :gmail, :age, :clb, :reason,  :sta)";
      $stmt = $conn->prepare($query);
      $a = "hello";
      $b = 1;
      $stmt->bindParam(':full_name',$array["full_name"]);
      $stmt->bindParam(':phone', $array["phone"]);
      $stmt->bindParam(':studentCode',$array["studentCode"]);
      $stmt->bindParam(':gmail', $array["gmail"]);
      $stmt->bindParam(':age', $array["age"]);
      $stmt->bindParam(':clb',$array["clb"]);
      $stmt->bindParam(':reason', $array["reason"]);
      $stmt->bindParam(':sta', $array["sta"]);
      $stmt->execute();   
      return "true";
  }
  
  // Select or Read data
  public function select($query){
    $result = $this->link->query($query) or 
    die($this->link->error.__LINE__);
    if($result->num_rows > 0){
      return $result->fetch_all();
    }else{
      return false;
    }
  }
  // Update data
  public function update($query){
    $update_row = $this->link->query($query) or 
      die($this->link->error.__LINE__);
    if($update_row){
      return $update_row;
    } else {
      return false;
      }
  }
    
  // Delete data
  public function delete($query){
    $delete_row = $this->link->query($query) or 
      die($this->link->error.__LINE__);

    if($delete_row){
      return $delete_row;
    } else {
      return false;
      }
    }
  // Delete data
  public function deleteCount($query){
    $delete_row = $this->link->query($query) or 
      die($this->link->error.__LINE__);
      $this->link->affected_rows;
    if($delete_row){
      return $this->link->affected_rows;
       
    } else {
      return false;
      }
    }
    public function getNameCLB($id)
    {
        $result = $this->select("SELECT `catName` FROM `tbl_category` WHERE `catId` = $id");
    }              
      
    public function changeStatusStudent($id,$status)
    {
        return $this->update("UPDATE `student` SET `status`= $status WHERE `studentID` = $id");
    }
    public function export_excel()
    {
      $queryexport = ("");
      
      $row = mysql_fetch_assoc($queryexport);
      
      $result = mysql_query($queryexport);
      $header = '';
      
      for ($i = 0; $i < $count; $i++){
         $header .= mysql_field_name($result, $i)."\t";
         }
      
      while($row = mysql_fetch_row($result)){
         $line = '';
         foreach($row as $value){
                if(!isset($value) || $value == ""){
                       $value = "\t";
                }else{
                       $value = str_replace('"', '""', $value);
                       $value = '"' . $value . '"' . "\t";
                       }
                $line .= $value;
                }
         $data .= trim($line)."\n";
         $data = str_replace("\r", "", $data);
      
      if ($data == "") {
         $data = "\nno matching records found\n";
         }
      }
      header("Content-type: application/vnd.ms-excel; name='excel'");
      header("Content-Disposition: attachment; filename=exportfile.xls");
      header("Pragma: no-cache");
      header("Expires: 0");
      
      // output data
      echo $header."\n".$data;
      
      mysql_close($conn);
    }
  }

