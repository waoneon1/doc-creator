<?php

require_once('../../../../wp-load.php');
require_once(__DIR__.'/../assets/tcpdf/tcpdf.php');
global $wpdb, $post;
class pdf extends TCPDF {

    function letak($gambar){
        //memasukkan gambar untuk header
        $this->Image($gambar,18,10,25,25);
        //menggeser posisi sekarang
    }

    function border_gambar($gambar){
        //memasukkan gambar untuk header
        $this->Image($gambar,18,10,25,25);
        //menggeser posisi sekarang
    }

    function judul($teks1, $teks2, $teks3, $teks4, $teks5){
        $this->Cell(10);
        $this->SetFont('helvetica','B','10');
        $this->Cell(0,5,$teks1,0,1,'C');
        $this->Cell(10);
        $this->Cell(0,5,$teks2,0,1,'C');
        $this->Cell(10);
        $this->SetFont('timesB','B','18');
        $this->Cell(0,5,$teks3,0,1,'C');
        $this->Cell(10);
        $this->SetFont('timesI','I','11');
        $this->Cell(0,5,$teks4,0,1,'C');
        $this->Cell(10);
        $this->Cell(0,8,$teks5,0,1,'C');
    }

    function garis(){
        $this->SetLineWidth(1);
        $this->Line(20,40,190,40);
        $this->SetLineWidth(0);
        $this->Line(20,41,190,41);
    }
}

// Prosess =============================================================
// Prosess =============================================================
// Prosess =============================================================

include 'docrt_pdf_template.php';
$pdf = new pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$post_tr = get_the_terms ($_GET['pid'],'surat' );

// kondisi kusus saat skem dan skel
if ($post_tr[0]->slug == 'skem' || $post_tr[0]->slug == 'skel') {
    docrt_get_content_pdf_skem_skel($pdf, $_GET['pid'], $post_tr);
} else {
    docrt_get_header_pdf($pdf,$_GET['pid'], $post_tr);
    docrt_get_content_pdf($pdf, $_GET['pid'], $post_tr);

    // kondisi kusus saat skp
    if ($post_tr[0]->slug == 'skp') {
        $post_tr[0]->slug = 'skai';
        $post_tr[0]->name = 'surat keterangan adat istiadat';
        docrt_get_header_pdf($pdf,$_GET['pid'], $post_tr);
        docrt_get_content_pdf($pdf, $_GET['pid'], $post_tr, 'skp');
    }
}

$pdf->Output($post_tr[0]->name.time().'.pdf','I');

// Prosess =============================================================
// Prosess =============================================================
// Prosess =============================================================

function docrt_get_header_pdf($pdf,$postID, $post_term) {

    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
   // jika ada kontent surat yang perlu font size berbeda alter here
    if ($post_term[0]->slug == 'skp') {
        $pdf->setCellHeightRatio(1.2);
    } else {
        $pdf->setCellHeightRatio(1.5);
    }
    $pdf->SetMargins(20, 10, 20, true);

    //jika surat kematian dan surat kelahiran page landscape
     if ($post_term[0]->slug == 'skem' || $post_term[0]->slug == 'skel') {
        $pdf->AddPage('L', 'F4');
    } else {
        $pdf->AddPage('P', 'F4');
    }

    $pdf->letak('../assets/img/pemkot_mlg_logo.png');
    $pdf->judul('PEMERINTAH KOTA MALANG', 'KECAMATAN KEDUNGKANDANG','KELURAHAN SAWOJAJAR','Alamat: Jl. Raya Sawojajar No. 45 (0341) 715953 - Malang KODE POS 65139', '');
    $pdf->garis();
}

function docrt_get_content_pdf($pdf, $postID, $post_term, $main_doc = '') {
    $meta = get_post_meta($postID);
    $pdf->SetFont('times','B','13');
    $pdf->writeHTML('<p>&nbsp;</p>', true, false, false, false, '');
    $pdf->writeHTML('<strong style="text-align: center; text-decoration: underline;">'.
        strtoupper($post_term[0]->name).'</strong>', true, false, false, false, '');

    // jika ada kontent surat yang perlu font size berbeda alter here
    if ($post_term[0]->slug == 'skp') {
        $pdf->SetFont('times','','11');
    } else {
        $pdf->SetFont('times','','12');
    }

    $pdf->writeHTML('<p style="text-align: center; margin-bottom:20px;">'.'Nomor: '.docrt_no_surat($post_term[0]->slug,$meta,$postID).'</p>', true, false, false, false, '');
    $pdf->writeHTML('<p>&nbsp;</p>', true, false, false, false, '');

    // <p> space margin ilangin
    $tagvs = array('p' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n'=> 0)));
    $pdf->setHtmlVSpace($tagvs);

    if ($main_doc === '') {
        $param = docrt_pdf_template_form($post_term[0]->slug,$meta,$postID);
    } else {
        $param = docrt_pdf_template_form($main_doc,$meta,$postID);
    }
    $tbl = docrt_content_by_type($param,$meta,$post_term);

    // footer
   // $pdf->SetFont('times','','9');
    $tbl .= docrt_pdf_footer($meta,$postID,$post_term[0]->slug);

    $pdf->SetCellPadding(0);
    $pdf->writeHTML($tbl, true, false, false, false, '');
}

function docrt_get_content_pdf_skem_skel($pdf, $postID, $post_term) {
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    if ($post_term[0]->slug == 'skel') {
        $pdf->setCellHeightRatio(1.0);
    } elseif ($post_term[0]->slug == 'skem') {
        $pdf->setCellHeightRatio(1.2);
    }


    $pdf->SetMargins(10, 10, 10, true);

    $pdf->AddPage('L', 'F4');

    $meta = get_post_meta($postID);


    // <p> space margin ilangin
    $tagvs = array('p' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n'=> 0)));
    $pdf->setHtmlVSpace($tagvs);


    if ($post_term[0]->slug == 'skel') {
        $pdf->SetFont('times','','10.5');
    } elseif ($post_term[0]->slug == 'skem') {
        $pdf->SetFont('times','','11');
    }
    $param = docrt_pdf_template_form($post_term[0]->slug,$meta,$postID);
    $tbl = docrt_content_by_type($param,$meta,$post_term,$pdf);

    $pdf->SetCellPadding(0);
    $pdf->writeHTML($tbl, true, false, false, false, '');
}

function docrt_content_by_type($param,$meta,$post_term,$pdf='') {
    $slug = $post_term[0]->slug;
    if ($slug == 'sku') {
        return docrt_sku_content($param,$meta,$post_term);

    } elseif ($slug == 'skdu') {
        return docrt_skdu_content($param,$meta,$post_term);

    } elseif ($slug == 'skd') {
        return docrt_skd_content($param,$meta,$post_term);

    } elseif ($slug == 'skik') {
        return docrt_skik_content($param,$meta,$post_term);

    } elseif ($slug == 'skck') {
        return docrt_skck_content($param,$meta,$post_term);

    } elseif ($slug == 'skp') {
        return docrt_skp_content($param,$meta,$post_term);;

    } elseif ($slug == 'sktm') {
        return docrt_sktm_content($param,$meta,$post_term);

    } elseif ($slug == 'skbpm') {
        return docrt_skbpm_content($param,$meta,$post_term);

    } elseif ($slug == 'skel') {
        return docrt_skel_content($param,$meta,$post_term);

    } elseif ($slug == 'skem') {
        return docrt_skem_content($param,$meta,$post_term);

    } elseif ($slug == 'kk') {
        return docrt_kk_content($param,$meta,$post_term);

    } elseif ($slug == 'ktp') {
        return docrt_ktp_content($param,$meta,$post_term);

    } elseif ($slug == 'skai') {
        return docrt_skai_content($param,$meta,$post_term);

    }
}

// footer tandatangan in general
function docrt_pdf_footer($meta,$postID,$type,$hspace='60',$nopelapor=true,$w1 = '30%',$w2 = '30%',$w3 = '43%') {
     // Yang menandatangani dokumen

    if ($meta['docrt_jenis_ttd'][0] == 'lurah') {
        $ttd_jabatan = 'LURAH SAWOJAJAR';
        $ttd_nama = 'J.A. BAYU WIDJAYA, S.Sos, M.Si';
        $ttd_nip = 'NIP. 19710731 199203 1 003';
    } elseif ($meta['docrt_jenis_ttd'][0] == 'seklur') {
        $ttd_jabatan = 'LURAH SAWOJAJAR<br/><span style="font-size:11px;">Sekretaris</span>';
        $ttd_nama = 'ADI ANDRIANTO. P, SH.M.Hum';
        $ttd_nip = 'NIP. 19740730 200312 1 005';
    } else {
        $ttd_jabatan = $meta['docrt_jenis_ttd'][0];
        $ttd_nama = '';
        $ttd_nip = '';
    }
    $mengetahui_camat = '';
    if ($type =='skai') {
        $mengetahui_camat =
        '<tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3"><span style="font-size:9px; text-align:center;">Mengetahui:<br/>CAMAT KEDUNGKANDANG</span></td>
        </tr>';
    }

    $align = ($nopelapor) ? 'center' : 'left';
    $tbl .= '
    <table cellspacing="0" cellpadding="1" border="0">
        <tr style="font-size:11px;">
            <td width="'.$w1.'"></td>
            <td width="'.$w2.'"></td>
            <td width="'.$w3.'" align="'.$align.'">Malang, '.get_the_date('',$postID).'</td>
        </tr>
        <tr>
            <td>'.(($nopelapor) ? 'Yang Bersangkutan' : '').'</td>
            <td></td>
            <td align="'.$align.'">'.$ttd_jabatan.'</td>
        </tr>
        <tr>
            <td height="'.$hspace.'"></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>'.(($nopelapor) ? ucwords($meta['docrt_form_nama'][0]) : '').'</td>
            <td> </td>
            <td align="'.$align.'"><strong style="text-align: '.$align.'; text-decoration: underline;">'.$ttd_nama.'</strong><br/>
            '.$ttd_nip.'
            </td>
        </tr>
        '.$mengetahui_camat.'
    </table>';

    return $tbl;
}

// no surat here
function docrt_no_surat($type,$meta,$postID) {

    $data['sku']    = '563/'.$meta['docrt_sku_id'][0].'/'.'35.73.03.1008/'.get_the_date('Y',$postID) ;
    $data['skdu']   = '563/'.$meta['docrt_skdu_id'][0].'/'.'35.73.03.1008/'.get_the_date('Y',$postID) ;
    $data['skd']    = '563/'.$meta['docrt_skd_id'][0].'/'.'35.73.03.1008/'.get_the_date('Y',$postID) ;
    $data['skik']   = '435/'.$meta['docrt_skik_id'][0].'/'.'35.73.03.1008/'.get_the_date('Y',$postID) ;
    $data['skck']   = '331/'.$meta['docrt_skck_id'][0].'/'.'35.73.03.1008/'.get_the_date('Y',$postID) ;
    $data['skp']    = '475/'.$meta['docrt_skp_id'][0].'/'.'35.73.03.1008/'.get_the_date('Y',$postID) ;
    $data['sktm']   = '581/'.$meta['docrt_sktm_id'][0].'/'.'35.73.03.1008/'.get_the_date('Y',$postID) ;
    $data['skbpm']  = '474/'.$meta['docrt_skbpm_id'][0].'/'.'35.73.03.1008/'.get_the_date('Y',$postID) ;
    $data['skel']   = '474.1/'.$meta['docrt_skel_id'][0].'/'.'35.73.03.1008/V/'.get_the_date('Y',$postID) ;
    $data['skem']   = '474.3/'.$meta['docrt_skem_id'][0].'/'.'35.73.03.1008/V/'.get_the_date('Y',$postID) ;
    $data['kk']     = $meta['docrt_kk_id'][0].'/'.get_the_date('Y',$postID) ;
    $data['ktp']    = $meta['docrt_ktp_id'][0].'/'.get_the_date('Y',$postID) ;
    $data['skai']   = '331/'.$meta['docrt_skp_id'][0].'/'.'35.73.03.1008/V/'.get_the_date('Y',$postID) ;

    return $data[$type];
}

