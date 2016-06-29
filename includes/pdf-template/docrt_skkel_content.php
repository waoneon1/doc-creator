<?php
function docrt_skkel_content($pdf,$postID, $post_term) {
    //$term_child = get_term_by('slug','skkel','surat');
    $meta = get_post_meta($postID);
    $data = docrt_pdf_template_form('skkel',$meta,$postID);

    $pdf->SetMargins(15, 10, 20, true);
    $pdf->AddPage('P', 'F4');
    $pdf->setCellHeightRatio(1.3);
    $pdf->SetFont('helvetica','','10');
    $tbl = '';
    $tbl .= '
    <table cellspacing="0" cellpadding="1" border="0">
        <tr>
          <td colspan="3"><strong>PEMERINTAH KOTA MALANG</strong></td>
        </tr>
        <tr>
           <td width="34%">KECAMATAN</td>
           <td width="5%"> : </td>
           <td width="61%">...............................</td>
        </tr>
        <tr>
           <td width="34%">KELURAHAN</td>
           <td width="5%"> : </td>
           <td width="61%">...............................</td>
        </tr>
        <tr>
           <td width="34%">KODE WILAYAH</td>
           <td width="5%"> : </td>
           <td width="61%">...............................</td>
        </tr>
    </table>';
    $pdf->writeHTML($tbl, true, false, false, false, '');

    $pdf->garis2();
    $pdf->SetFont('helvetica','B','12');
    //$pdf->Cell(180,5,'',0,1);
    $pdf->Cell(180,5,'SURAT KETERANGAN KELAHIRAN',0,1,'C');
    $pdf->SetFont('helvetica','','10');
    $pdf->Cell(0,5,'Nomor : ..............................',0,1,'C');
    $tbl = '';

    $pdf->SetFont('helvetica','','10');
    $tbl .= '
    <table cellspacing="0" cellpadding="1" border="0">
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
           <td width="34%">KEWARGANEGARAAN</td>
           <td width="5%"> : </td>
           <td width="61%">...............................</td>
        </tr>
        <tr>
           <td width="34%">Nama Kepala Keluarga</td>
           <td width="5%"> : </td>
           <td width="61%">...............................</td>
        </tr>
        <tr>
           <td width="34%">Nomor Kartu Keluarga</td>
           <td width="5%"> : </td>
           <td width="61%">...............................</td>
        </tr>
    </table>';
    $pdf->writeHTML($tbl, true, false, false, false, '');

    $pdf->setCellHeightRatio(1.1);
    $tbl = '';
    // BAYI ==================================================================
    $tbl .= '
    <table cellspacing="0" cellpadding="1" border="0" style="border:1px solid black;">
        <tr>
           <td width="4%"></td>
           <td width="96%"><strong>DATA BAYI / ANAK</strong></td>
        </tr>';
        $i = 1;
        foreach ($data['bayi']  as $key => $value) {
            $tbl .= '<tr>
                <td width="5%">'.$i.'. </td>
                <td width="30%">'.$key.'</td>
                <td width="2%"> : </td>
                <td width="60%">'.$value.'</td>
            </tr>';
            $i++;
        }
    $tbl .= '
    </table>';
    // Ayah =================================================================
    $tbl .= '
    <table cellspacing="0" cellpadding="1" border="0" style="border:1px solid black;">
        <tr>
           <td width="4%"></td>
           <td width="96%"><strong>DATA AYAH</strong></td>
        </tr>';
        $i = 1;
        foreach ($data['ayah']  as $key => $value) {
            $tbl .= '<tr>
                <td width="5%">'.$i.'. </td>
                <td width="30%">'.$key.'</td>
                <td width="2%"> : </td>
                <td width="60%">'.$value.'</td>
            </tr>';
            $i++;
        }
    $tbl .= '
    </table>';
    // Ibu =================================================================
    $tbl .= '
    <table cellspacing="0" cellpadding="1" border="0" style="border:1px solid black;">
        <tr>
           <td width="4%"></td>
           <td width="96%"><strong>DATA IBU</strong></td>
        </tr>';
        $i = 1;
        foreach ($data['ibu']  as $key => $value) {
            $tbl .= '<tr>
                <td width="5%">'.$i.'. </td>
                <td width="30%">'.$key.'</td>
                <td width="2%"> : </td>
                <td width="60%">'.$value.'</td>
            </tr>';
            $i++;
        }
    $tbl .= '
    </table>';
    // Pelapor =================================================================
    $tbl .= '
    <table cellspacing="0" cellpadding="1" border="0" style="border:1px solid black;">
        <tr>
           <td width="4%"></td>
           <td width="96%"><strong>DATA PELAPOR</strong></td>
        </tr>';
        $i = 1;
        foreach ($data['pelapor']  as $key => $value) {
            $tbl .= '<tr>
                <td width="5%">'.$i.'. </td>
                <td width="30%">'.$key.'</td>
                <td width="2%"> : </td>
                <td width="60%">'.$value.'</td>
            </tr>';
            $i++;
        }
    $tbl .= '
    </table>';
    // Saksi 1 =================================================================
    $tbl .= '
    <table cellspacing="0" cellpadding="1" border="0" style="border:1px solid black;">
        <tr>
           <td width="4%"></td>
           <td width="96%"><strong>DATA SAKSI I</strong></td>
        </tr>';
        $i = 1;
        foreach ($data['pelapor']  as $key => $value) {
            $tbl .= '<tr>
                <td width="5%">'.$i.'. </td>
                <td width="30%">'.$key.'</td>
                <td width="2%"> : </td>
                <td width="60%">'.$value.'</td>
            </tr>';
            $i++;
        }
    $tbl .= '
    </table>';
    // SAKSI II =================================================================
    $tbl .= '
    <table cellspacing="0" cellpadding="1" border="0" style="border:1px solid black;">
        <tr>
           <td width="4%"></td>
           <td width="96%"><strong>DATA SAKSI II</strong></td>
        </tr>';
        $i = 1;
        foreach ($data['pelapor']  as $key => $value) {
            $tbl .= '<tr>
                <td width="5%">'.$i.'. </td>
                <td width="30%">'.$key.'</td>
                <td width="2%"> : </td>
                <td width="60%">'.$value.'</td>
            </tr>';
            $i++;
        }
    $tbl .= '
    </table>';

    $tbl .= '
    <table cellspacing="0" cellpadding="1" border="0" style="border:1px solid black;">
        <tr>
           <td width="4%"></td>
           <td width="96%"><strong>DATA SAKSI II</strong></td>
        </tr>';
        '<tr>
            <td width="5%">'.$i.'. </td>
            <td width="30%">'.$key.'</td>
            <td width="2%"> : </td>
            <td width="60%">'.$value.'</td>
        </tr>
    </table>';
    $pdf->writeHTML($tbl, true, false, false, false, '');
    //$pdf->writeHTML($tbl, true, false, false, false, '');
}
//====================================================================================================