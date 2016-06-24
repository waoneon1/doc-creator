<?php

require_once('../../../../wp-load.php');
require_once(__DIR__.'/../assets/tcpdf/tcpdf.php');
global $wpdb, $post;

class MYPDF extends TCPDF {

    // Load table data from file
    public function LoadData($file) {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line) {
            $data[] = explode(';', chop($line));
        }
        return $data;
    }

    // Colored table
    public function ColoredTable($header,$data) {
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(10, 10, 10, 10, 10, 10, 10, 10, 10, 10);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        foreach($data as $row) {
            $this->Cell(30 , 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell(30 , 6, $row[1], 'LR', 0, 'L', $fill);
            $this->Cell(30 , 6, $row[2], 'LR', 0, 'R', $fill);
            $this->Cell(30 , 6, $row[3], 'LR', 0, 'R', $fill);
            $this->Cell(30 , 6, $row[4], 'LR', 0, 'R', $fill);
            $this->Cell(30 , 6, $row[5], 'LR', 0, 'R', $fill);
            $this->Cell(30 , 6, $row[6], 'LR', 0, 'R', $fill);
            $this->Cell(30 , 6, $row[7], 'LR', 0, 'R', $fill);
            $this->Cell(30 , 6, $row[8], 'LR', 0, 'R', $fill);
            $this->Cell(30 , 6, $row[9], 'LR', 0, 'R', $fill);
            $this->Cell(30 , 6, $row[10], 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

//get post from db
$args = array(
    'post_type' => array( 'docrt-document'),
    'tax_query' => array(
        array(
            'taxonomy' => 'surat',
            'field'    => 'slug',
            'terms'    => $_GET['jenis_surat'],
        ),
    ),
    'date_query' => array(
        array(
            'after'     => $_GET['date_after'],
            'before'    => $_GET['date_before'],
            'inclusive' => true,
        ),
    ),
);
$query = new WP_Query( $args );

// post data
$post_data = $query->posts;
//print_r($post_data); exit;

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage('L', 'F4');

// column titles

$header = array('No','Tanggal','Nomor Register','Nama','Umur','Agama','Pekerjaan','Status','Alamat','Keperluan','Keterangan');

// data loading
$data = array('No','Tanggal','Nomor Register','Nama','Umur','Agama','Pekerjaan','Status','Alamat','Keperluan','Keterangan');

// print colored table
$pdf->ColoredTable($header, $data);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('example_011.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+