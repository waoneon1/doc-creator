<?php

require_once('../../../../wp-load.php');
require_once(__DIR__.'/../assets/tcpdf/tcpdf.php');
global $wpdb, $post;

class MYPDF extends TCPDF {

    // Load table data from file
    public function LoadData($data, $mode = '',  $td = 'td') {
        // Read data lines
        if ($mode == 'number') {
            foreach ($data as $key => $value) {
                $key_val = $key + 1;
                $return .= '<'.$td .'>'.$key_val.'</'.$td .'>';
            }
            return $return;
        }

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $attr = ' ';
                foreach ($value as $key => $attrb) {
                    if ($key != 'title') {
                        $attr .= $key.' = "'.$attrb.'" ';
                    }
                }
                $return .= '<'.$td .$attr.'>'.$value['title'].'</'.$td .'>';
            } else {
                $return .= '<'.$td .'>'.$value.'</'.$td .'>';
            }
        }
        return $return;
    }

    public function prepareData($post_data) {
        $jenis_surat = $_GET['jenis_surat'];

        foreach ($post_data as $key => $postval) {
            $post_term = get_the_terms ($postval->ID,'surat');
            $meta = get_post_meta( $postval->ID);
            //print_r($meta); exit();
            $prepare_data[$key][0] = array(
                'title' => $key + 1,
                'align' => 'center',
            );

            $prepare_data[$key][1] = date_i18n( 'j F Y', strtotime($postval->post_date));
            $prepare_data[$key][2] = docrt_no_surat($post_term[0]->slug,$meta,$postval->ID);
            $prepare_data[$key][3] = $meta['docrt_form_nama'][0];
            $prepare_data[$key][4] = $meta['docrt_form_umur'][0];
            $prepare_data[$key][5] = $meta['docrt_form_agama'][0];
            $prepare_data[$key][6] = $meta['docrt_form_pekerjaan'][0];
            $prepare_data[$key][7] = $meta['docrt_form_sperkawinan'][0];
            $prepare_data[$key][8] = $meta['docrt_form_alamat'][0];
            $prepare_data[$key][9] = $meta['docrt_form_keperluan'][0];
            $prepare_data[$key][10] = $meta['docrt_form_tujuan'][0];
        }
        return $prepare_data;
    }

    public function judul($teks1/*, $teks2, $teks3, $teks4, $teks5*/){
        $this->Cell(10);
        $this->SetFont('helvetica','B','10');
        $this->Cell(0,5,$teks1,0,1,'C');
/*        $this->Cell(10);
        $this->Cell(0,5,$teks2,0,1,'C');
        $this->Cell(10);
        $this->SetFont('timesB','B','18');
        $this->Cell(0,5,$teks3,0,1,'C');
        $this->Cell(10);
        $this->SetFont('timesI','I','11');
        $this->Cell(0,5,$teks4,0,1,'C');
        $this->Cell(10);
        $this->Cell(0,8,$teks5,0,1,'C');*/
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


// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
// ---------------------------------------------------------
// add a page
$pdf->AddPage('L', 'F4');

$pdf->judul('Laporan "'.strtoupper($_GET['jenis_surat']).'" Periode '.date_i18n( 'j F Y', strtotime($_GET['date_after'])).' s/d '.date_i18n( 'j F Y', strtotime($_GET['date_before'])));
$pdf->SetFont('helvetica', '', 10);
// column titles

$header = array(
    array(
        'title' => 'No',
        'width' => '25',
    ),
    'Tanggal','Nomor Register',
    array(
        'title' => 'Nama',
        'width' => '120',
    ),
    array(
        'title' => 'Umur',
        'width' => '35',
    ),
    'Agama','Pekerjaan',
    array(
        'title' => 'Status',
        'width' => '50',
    ),
    array(
        'title' => 'Alamat',
        'width' => '130',
    ),
    array(
        'title' => 'Keperluan',
        'width' => '122',
    ),
    'Keterangan'
);


$tbl = '
<table border="1" cellpadding="2" cellspacing="0" align="center">
    <tr nobr="true">';
        $tbl .= $pdf->LoadData($header, '', 'th');
        $tbl .= '
    </tr>
    <tr>';
        $tbl .= $pdf->LoadData($header,'number');
        $tbl .= '
    </tr>';
    if ($pdf->prepareData($post_data)) {
       foreach ($pdf->prepareData($post_data) as $key => $value) {
            $tbl .= '<tr align="left">';
                $tbl .= $pdf->LoadData($value);
            $tbl .= '</tr>';
        }
    } else {
        $tbl .= '<tr align="center">';
            $tbl .= $pdf->LoadData(
                array(
                    array(
                        'colspan' => sizeof($header),
                        'title' => 'Tidak ditemukan pembuatan document pada periode ini.',
                    )
                )
            );
        $tbl .= '</tr>';
    }
$tbl .= '</table>';
// ---------------------------------------------------------

// close and output PDF document
$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->Output('example_048.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+
