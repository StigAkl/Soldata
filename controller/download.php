<?php


if(isset($_GET['download'])) {
    $download = htmlspecialchars($_GET['download']);
    switch ($download) {
        case "year":
            $year = htmlspecialchars($_GET['year']);
            download_energy(get_power_year($year));
            break;
        case "all":
            download_energy(get_all_power());
            break;
    }
}


function download_energy($power)
{

    if(count($power) <= 0) {
        header("Location: index.php?page=downloads&error=nodata");
        exit();
    } else {
        /** Error reporting */
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        date_default_timezone_set('Europe/Oslo');

        if (PHP_SAPI == 'cli')
            die('This example should only be run from a Web Browser');

        /** Include PHPExcel */
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

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B1', "W");

        $count = 2;
        foreach ($power as $item) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $count, $item['date']);
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B' . $count, $item['value']);
            $count = $count + 1;
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
    }
}
