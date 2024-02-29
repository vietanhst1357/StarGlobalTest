<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Export excel</title>
</head>
<body>
	<form method="post">
		<input type="submit" name="export" value="Export" />
	</form>
</body>
</html>

<?php
require '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

include_once('../../config/db.php');
include_once('../../model/group.php');

if(isset($_POST['export'])) {
  $db = new DB();
  $connect = $db->connect();
  
  $group = new Group($connect);
  
  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  // Add headers 
  $sheet->setCellValue('A1', 'STT'); 
  $sheet->setCellValue('B1', 'id'); 
  $sheet->setCellValue('C1', 'group_name'); 
  $sheet->setCellValue('D1', 'title'); 
  $sheet->setCellValue('E1', 'content'); 
  // Add data from the database 
  $read = $group->read();

  $data = $read->fetchAll(PDO::FETCH_OBJ);
  $rowCount = 2;
  foreach ($data as $key => $value) 
  {
    $sheet->setCellValue('A'.$rowCount, $rowCount-1); 
    $sheet->setCellValue('B'.$rowCount, $value->id);
    $sheet->setCellValue('C'.$rowCount, $value->group_name);
    $sheet->setCellValue('D'.$rowCount, $value->title);
    $sheet->setCellValue('E'.$rowCount, $value->content);
    $rowCount++;
  }
  
  $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
  $writer->setOffice2003Compatibility(true);
  $filename=time().".xlsx";
  $writer->save($filename);
  header("location:".$filename);
  
}

?>