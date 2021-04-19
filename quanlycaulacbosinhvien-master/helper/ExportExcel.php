<?php
// namespace Phppot;

class ExportExcel
{
    
    
    public function __construct()
    {
       
    }
    
   
    
    public function export($result) {
        $timestamp = time();
        $filename = 'List' . '.xls';
        $filename=iconv("utf-8", "gb2312", $filename);
        
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8"); 
header("Pragma: public"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download"); 
header("Content-Type: application/octet-stream"); 
header("Content-Type: application/download"); 
header("Content-Disposition: attachment;filename=11.xls "); 
header("Content-Transfer-Encoding: binary ");

        // header("Content-Type: application/vnd.ms-excel");
        // header("Content-Disposition: attachment; filename=\"$filename\"");
        
         echo "\t" . 'MSSV';
         echo "\t" . 'Họ và tên';
         echo "\t" . 'Điện thoại';
         echo "\t" . 'Gmail';
         echo "\t" . 'Age';
         echo "\t" . 'Lý do tham gia';
         echo "\t" . 'Ngày tham gia' . "\n";
         $i = 1;
        foreach ($result as $row) {
            echo $i++ . "\t"; 
            echo  mb_convert_encoding(implode("\t", array_values($row)), "UTF-16LE","UTF-8"). "\n";
            
        }
        exit();
    }
}
