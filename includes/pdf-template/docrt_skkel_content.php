<?php
function docrt_skkel_content($pdf,$postID, $post_term) {
    //$term_child = get_term_by('slug','skkel','surat');
    $meta = get_post_meta($postID);
    $data = docrt_pdf_template_form('skkel',$meta,$postID);
    $saksi_data = $pdf->get_saksi($meta['docrt_form_saksi'][0]);
    foreach ($saksi_data as $key => $value) {
        $param[$key] = array(
            'Nama Lengkap' => $value['nama'],
            'Umur' => date_diff(date_create($value['tl']), date_create($meta['date'][0]))->y,
            'NIK' => $value['nik'],
            'Pekerjaan' => $value['pekerjaan'],
            'Alamat' => $value['alamat'],
            'Telepon' => $value['telepon'],
        );
    }

    $pdf->SetMargins(15, 10, 15, true);
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
           <td width="30%">KEDUNGKANDANG</td>
           <td width="31%" align="right">Kode : F-2.01</td>
        </tr>
        <tr>
           <td width="34%">KELURAHAN</td>
           <td width="5%"> : </td>
           <td width="61%">SAWOJAJAR</td>
        </tr>
        <tr>
           <td width="34%">KODE WILAYAH</td>
           <td width="5%"> : </td>
           <td width="61%">35730 10</td>
        </tr>
    </table>';
    $pdf->writeHTML($tbl, true, false, false, false, '');

    $pdf->garis2();
    $pdf->SetFont('helvetica','B','12');
    //$pdf->Cell(180,5,'',0,1);
    $pdf->Cell(180,5,'SURAT KETERANGAN KELAHIRAN',0,1,'C');
    $pdf->SetFont('helvetica','','10');
    $pdf->Cell(0,5,'Nomor : '.$data['other']['noreg'],0,1,'C');
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
           <td width="61%">'.strtoupper($data['other']['kewarganegaraan']).'</td>
        </tr>
        <tr>
           <td width="34%">Nama Kepala Keluarga</td>
           <td width="5%"> : </td>
           <td width="61%">'.$data['other']['kepalakeluarga'].'</td>
        </tr>
        <tr>
           <td width="34%">Nomor Kartu Keluarga</td>
           <td width="5%"> : </td>
           <td width="61%">'.$data['other']['nokk'].'</td>
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
                <td width="63%">'.$value.'</td>
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
                <td width="63%">'.$value.'</td>
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
                <td width="63%">'.$value.'</td>
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
                <td width="63%">'.$value.'</td>
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
        foreach ($param['saksi1']  as $key => $value) {
            $tbl .= '<tr>
                <td width="5%">'.$i.'. </td>
                <td width="30%">'.$key.'</td>
                <td width="2%"> : </td>
                <td width="63%">'.$value.'</td>
            </tr>';
            $i++;
        }
    $tbl .= '
    </table>';
    // Saksi II =================================================================
    $tbl .= '
    <table cellspacing="0" cellpadding="1" border="0" style="border:1px solid black;">
        <tr>
           <td width="4%"></td>
           <td width="96%"><strong>DATA SAKSI II</strong></td>
        </tr>';
        $i = 1;
        foreach ($param['saksi2']  as $key => $value) {
            $tbl .= '<tr>
                <td width="5%">'.$i.'. </td>
                <td width="30%">'.$key.'</td>
                <td width="2%"> : </td>
                <td width="63%">'.$value.'</td>
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
            <td width="63%">'.$value.'</td>
        </tr>
    </table>';
    $pdf->writeHTML($tbl, true, false, false, false, '');
    //$pdf->writeHTML($tbl, true, false, false, false, '');
}
//====================================================================================================