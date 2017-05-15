<?php
$from_date = null;
$to_date = null;
$energy = null;
$power =  null;
$energy_result = null;
$power_result = null;

if(isset($_POST['from_date'])){
	$from_date = $_POST['from_date'];
}

if(isset($_POST['to_date'])){
	$to_date = $_POST['to_date'];
}

if(isset($_POST['energy'])){
	$energy = $_POST['energy'];
	if($energy == "on"){
		$energy = true;
	}
}

if(isset($_POST['power'])){
	$power = $_POST['power'];
	if($power == "on"){
		$power = true;
	}
}

if($power == true){
	$power_result = get_power_from_to($from_date, $to_date);
}

if($energy == true){
	$energy_result = get_energy_from_to($from_date, $to_date);
}



         //Include PHPExcel 
        require_once("Classes/PHPExcel.php");


// Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

// Set document properties
        $objPHPExcel->getProperties()->setCreator("Soldata.no")
            ->setLastModifiedBy("Soldata.no")
            ->setTitle("Soldata")
            ->setSubject("Soldata")
            ->setDescription("Excel document containing solar data for processing purposes.")
            ->setKeywords("soldata soldata.no solar data office 2007 openxml php")
            ->setCategory("Solar energy");


// Add some data

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', "Time");
        if($power == true){
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B1', "W");
            if($energy == true){
            	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C1', "J");
            }
        }else{
             $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B1', "J");
        }

        $count = 2;

        if($power == true){
        	foreach ($power_result as $item) {
            	$objPHPExcel->setActiveSheetIndex(0)
                	->setCellValue('A' . $count, $item['date']);
            	$objPHPExcel->setActiveSheetIndex(0)
                	->setCellValue('B' . $count, $item['value']);
            	$count = $count + 1;
        	}
        	if($energy == true){
        		$count = 2;

        		foreach ($energy_result as $item) {
            		$objPHPExcel->setActiveSheetIndex(0)
                		->setCellValue('C' . $count, $item['value']);
            		$count = $count + 1;
        		}



        	}


    	}else{
    		foreach ($energy_result as $item) {
            	$objPHPExcel->setActiveSheetIndex(0)
                	->setCellValue('A' . $count, $item['date']);
            	$objPHPExcel->setActiveSheetIndex(0)
                	->setCellValue('B' . $count, $item['value']);
            	$count = $count + 1;
        	}
    	}

// Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Soldata');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Soldata.xls"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;

?>