<?php
date_default_timezone_set("Asia/Jakarta");
include "config.php";
$lib = new config();
$data_report = $lib->showReport();

// Load plugin PHPExcel nya
require_once '../../PHPExcel/PHPExcel.php';

// Panggil class PHPExcel nya
$excel = new PHPExcel();

// Settingan awal fil excel
$excel->getProperties()->setCreator('KIM_PAKO')
	->setLastModifiedBy('KIM')
	->setTitle("CHECKSHEET QC TO EXECUTIVE PAKO")
	->setSubject("EMPLOYEE")
	->setDescription("Laporan Semua Data Velg")
	->setKeywords("Data Report");

// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
$style_col = array(
	'font' => array('bold' => true), // Set font nya jadi bold
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	),
	'borders' => array(
		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	)
);

// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
$style_row = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	),
	'borders' => array(
		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	)
);

$excel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->setActiveSheetIndex(0)->setCellValue('A1', "CHECKSHEET REPORTING QC TO EXECUTIVE PAKO"); // Set kolom A1 dengan tulisan "DATA SISWA"
$excel->getActiveSheet()->mergeCells('A1:Q1'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(22); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
$excel->getActiveSheet()->getStyle('A1:Q1')->applyFromArray($style_col);

// Buat header tabel nya pada baris ke 3
$excel->setActiveSheetIndex(0)->setCellValue('A2', "NO"); // Set kolom A3 dengan tulisan "NO"
$excel->getActiveSheet()->mergeCells('A2:A3'); // Set Merge Cell pada kolom A1 sampai F1

$excel->setActiveSheetIndex(0)->setCellValue('B2', "INPUT DATE"); // Set kolom B3 dengan tulisan "NIS"
$excel->getActiveSheet()->mergeCells('B2:B3'); // Set Merge Cell pada kolom A1 sampai F1

$excel->setActiveSheetIndex(0)->setCellValue('C2', "TIPE"); // Set kolom C3 dengan tulisan "NAMA"
$excel->getActiveSheet()->mergeCells('C2:C3'); // Set Merge Cell pada kolom A1 sampai F1

$excel->setActiveSheetIndex(0)->setCellValue('D2', "DEFECT"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
$excel->getActiveSheet()->mergeCells('D2:D3'); // Set Merge Cell pada kolom A1 sampai F1

$excel->setActiveSheetIndex(0)->setCellValue('E2', "PICTURE"); // Set kolom E3 dengan tulisan "TELEPON"
$excel->getActiveSheet()->mergeCells('E2:E3'); // Set Merge Cell pada kolom A1 sampai F1

$excel->setActiveSheetIndex(0)->setCellValue('F2', "SIZE"); // Set kolom F3 dengan tulisan "SIZE"
$excel->getActiveSheet()->mergeCells('F2:F3'); // Set Merge Cell pada kolom A1 sampai F1

$excel->setActiveSheetIndex(0)->setCellValue('G2', "AREA"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->getActiveSheet()->mergeCells('G2:G3'); // Set Merge Cell pada kolom A1 sampai F1

$excel->setActiveSheetIndex(0)->setCellValue('H2', "SUB AREA"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->getActiveSheet()->mergeCells('H2:H3'); // Set Merge Cell pada kolom A1 sampai F1

$excel->setActiveSheetIndex(0)->setCellValue('I2', "SQUARE MARK DATE"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->getActiveSheet()->mergeCells('I2:I3'); // Set Merge Cell pada kolom A1 sampai F1

$excel->setActiveSheetIndex(0)->setCellValue('J2', "INITIAL");
$excel->getActiveSheet()->mergeCells('J2:J3'); // Set Merge Cell pada kolom A1 sampai F1

$excel->setActiveSheetIndex(0)->setCellValue('K2', "ROUND MARK DATE");
$excel->getActiveSheet()->mergeCells('K2:K3'); // Set Merge Cell pada kolom A1 sampai F1

$excel->setActiveSheetIndex(0)->setCellValue('L2', "INITIAL");
$excel->getActiveSheet()->mergeCells('L2:L3'); // Set Merge Cell pada kolom A1 sampai F1

$excel->setActiveSheetIndex(0)->setCellValue('M2', "JUDGE");
$excel->getActiveSheet()->mergeCells('M2:P2'); // Set Merge Cell pada kolom A1 sampai F1

$excel->setActiveSheetIndex(0)->setCellValue('M3', "OK");
$excel->setActiveSheetIndex(0)->setCellValue('N3', "CAN BE REPAIR");
$excel->setActiveSheetIndex(0)->setCellValue('O3', "AFTER REPAIR");
$excel->setActiveSheetIndex(0)->setCellValue('P3', "REJECT");
$excel->setActiveSheetIndex(0)->setCellValue('Q2', "TC");
$excel->setActiveSheetIndex(0)->setCellValue('Q3', "INITIAL SMALL MARK");



// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A2:A3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('B2:B3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('C2:C3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('D2:D3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('E2:E3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('F2:F3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('G2:G3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('H2:H3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('I2:I3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('J2:J3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('K2:K3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('L2:L3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('M2')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('Q2')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);

$excel->getActiveSheet()->getStyle('N3:O3')->getFill()
	->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
	->getStartColor()->setARGB('FFFF00');

// Set height baris ke 1, 2 dan 3
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
// Buat query untuk menampilkan semua data report
foreach ($data_report as $row) {
	$excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
	$excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $row['input_date']);
	$get_data_tipe = $lib->get_by_id_tipe2($row['id_tipe']);
	foreach ($get_data_tipe as $tipe_name) {
		$excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $tipe_name['tipe_name']);
	}
	$excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $row['defect']);
	// if ($excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $row['picture'])) {
	$objDrawing = new PHPExcel_Worksheet_Drawing();
	$objDrawing->setName('Picture Reporting');
	$objDrawing->setDescription('Picture Reporting');
	//Path to signature .jpg file
	$signature = "../../img/picture_report/";
	$objDrawing->setPath($signature . $row['picture']);
	$objDrawing->setOffsetX(50);                     //setOffsetX works properly
	$objDrawing->setOffsetY(20);                     //setOffsetY works properly
	$objDrawing->setCoordinates('E' . $numrow);             //set image to cell 
	$objDrawing->setWidth(100);
	$objDrawing->setHeight(100);                     //signature height  
	$objDrawing->setWorksheet($excel->getActiveSheet());  //save 
	// } else {
	// 	$excel->getActiveSheet()->setCellValue('E' . $numrow, "Image not found");
	// }
	$excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $row['size']);
	$excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $row['area']);
	$excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $row['sub_area']);
	$excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $row['smd']);
	$excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $row['ism']);
	$excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $row['rmd']);
	$excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, $row['irm']);
	if ($row['judge'] == 'OK') {
		$excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, 'V');
		$excel->getActiveSheet()->getStyle('M' . $numrow)->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()->setARGB('4caf50');
	} else {
		$excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, ' ');
	}
	if ($row['judge'] == 'REPAIR') {
		$excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, 'V');
		$excel->getActiveSheet()->getStyle('N' . $numrow)->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF00');
	} else {
		$excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, ' ');
	}
	$excel->setActiveSheetIndex(0)->setCellValue('O' . $numrow, $row['after_repair']);
	if ($row['judge'] == 'REJECT') {
		$excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, 'V');
		$excel->getActiveSheet()->getStyle('P' . $numrow)->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()->setARGB('FFFF0000');
	} else {
		$excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, ' ');
	}
	$excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, $row['isk']);

	// Khusus untuk no telepon. kita set type kolom nya jadi STRING
	// $excel->setActiveSheetIndex(0)->setCellValueExplicit('E' . $numrow, $row['rmd'], PHPExcel_Cell_DataType::TYPE_STRING);


	// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
	$excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('O' . $numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('P' . $numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('Q' . $numrow)->applyFromArray($style_row);

	$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(100);

	$no++; // Tambah 1 setiap kali looping
	$numrow++; // Tambah 1 setiap kali looping

}

// Set width kolom
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(50); // Set width kolom E
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(10); // Set width kolom F
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom G
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom H
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(24); // Set width kolom I
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(10); // Set width kolom J
$excel->getActiveSheet()->getColumnDimension('K')->setWidth(24); // Set width kolom K
$excel->getActiveSheet()->getColumnDimension('L')->setWidth(10); // Set width kolom L
$excel->getActiveSheet()->getColumnDimension('M')->setWidth(10); // Set width kolom M
$excel->getActiveSheet()->getColumnDimension('N')->setWidth(20); // Set width kolom N
$excel->getActiveSheet()->getColumnDimension('O')->setWidth(20); // Set width kolom O
$excel->getActiveSheet()->getColumnDimension('P')->setWidth(10); // Set width kolom P
$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(20); // Set width kolom Q


// Set orientasi kertas jadi LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$excel->getActiveSheet(0)->setTitle("Reporting QC");
$excel->setActiveSheetIndex(0);

$tgl = date('(d-m-Y)');

// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Reporting QC Executive To Pako - ' . $tgl . '.xlsx"'); // Set nama file excel nya
header('Cache-Control: max-age=0');

$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
ob_end_clean();
$write->save('php://output');
