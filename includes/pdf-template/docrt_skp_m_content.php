<?php
function docrt_skp_m_content($param, $meta, $post_term) {

    foreach ( $param['a'] as $key => $value) {
        $tbl .= '
        <table cellspacing="0" cellpadding="1" border="0">
            <tr>
               <td width="30%">'. $key.'</td>
               <td width="5%"> : </td>
               <td width="65%">'. $value.'</td>
            </tr>
        </table>';
    }

    foreach ( $param['b'] as $key => $value) {
        $tbl .= '
        <table cellspacing="0" cellpadding="1" border="0">
            <tr>
               <td width="30%">'.($key == 'Desa' ? 'Pindah Dari' : "").'</td>
               <td width="5%">'.($key == 'Desa' ? ' : ' : "").'</td>
               <td width="20%">'. $key.'</td>
               <td width="5%"> : </td>
               <td width="40%">'.$value.' '.($key == 'Pada Tanggal' ? " berlaku s/d ".$param['c']['docrt_form_tgl_berlaku'] : "").'</td>
            </tr>
        </table>';
    }
    $tbl .= '
    <table cellspacing="0" cellpadding="1" border="0">
        <tr>
           <td width="30%">Alasan Pindah</td>
           <td width="5%"> : </td>
           <td width="65%">'. $param['c']['docrt_form_alasan_pindah'].'</td>
        </tr>
        <tr>
           <td width="30%">Pengikut</td>
           <td width="5%"> : </td>
           <td width="65%">'. $param['c']['docrt_form_pengikut'].' orang yaitu:</td>
        </tr>
    </table>';

    $tbl .= '
    <table border="1" cellpadding="2" border="0.5">
        <tr align="center" style="background-color:#e3e3e3;">
            <th width="5%">No</th>
            <th width="14%">Nama</th>
            <th width="14%">Jenis</th>
            <th width="14%">Tgl. Lahir</th>
            <th width="14%">Status Perkawinan</th>
            <th width="13%">Pendidikan</th>
            <th width="13%">Nomor KTP</th>
            <th width="13%">Keterangan</th>
        </tr>';
        for ($i=1; $i <= $param['c']['docrt_form_pengikut']; $i++) {
            $tbl .= '
            <tr align="center">
                <td>'.$i.'</td>
                <td>'.$meta['docrt_pengikut_nama'.$i][0].'</td>
                <td>'.$meta['docrt_pengikut_jk'.$i][0].'</td>
                <td>'.date_i18n( 'j F Y', strtotime($meta['docrt_pengikut_lahir'.$i][0])).'</td>
                <td>'.$meta['docrt_pengikut_status'.$i][0].'</td>
                <td>'.$meta['docrt_pengikut_pendidikan'.$i][0].'</td>
                <td>'.$meta['docrt_pengikut_nik'.$i][0].'</td>
                <td>'.$meta['docrt_pengikut_keterangan'.$i][0].'</td>
            </tr>';
        }
    $tbl .= '</table>';

    $tbl .= '
    <table cellspacing="0" cellpadding="1" border="0">
        <tr><td colspan="3">&nbsp;</td></tr>
    </table>';

    return $tbl;
}

