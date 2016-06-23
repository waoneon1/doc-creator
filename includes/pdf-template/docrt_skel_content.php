<?php
// 10. skel
function docrt_skel_content($param, $meta, $post_term) {

    $underline = 'style="text-decoration: underline;"';
    $tbl .= '
    <table cellspacing="0" cellpadding="1" border="0">
    <tr>
    <td width="33%">';  // MAIN TD ===================================================

        // kontent 1
        $tbl .=
        '<table cellspacing="0" cellpadding="1" border="0" align="center">
            <tr><td>UNTUK ARSIP KELURAHAN</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>SURAT KELAHIRAN</td></tr>
            <tr>
                <td>Nomor : '.$param['b']['noreg'].'</td>
            </tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Yang bertandatangan di bawah ini, menerangkan bahwa : </td></tr>
            <tr><td>&nbsp;</td></tr>
        </table>';

        $tbl .='<table cellspacing="0" cellpadding="1">';
        foreach ( $param['c'] as $key => $value) {
            if ($value[0] == '-') {
                $tbl .= '
                    <tr align="left">
                       <td colspan="3">'. $value[1].'</td>
                    </tr>';
            } else {
                $tbl .= '
                    <tr align="left">
                       <td width="30%">'. $key.'</td>
                       <td width="5%"> : </td>
                       <td width="58%">'. $value.'</td>
                    </tr>';
            }
        }
        $tbl .='<tr><td>&nbsp;</td></tr>
        </table>';

        $tbl .=
        '<table cellspacing="0" cellpadding="1" border="0" align="center">
            <tr><td>&nbsp;</td></tr>
            <tr><td>Surat Keterangan ini dibuat atas dasar yang sebenarnya</td></tr>
            <tr><td>&nbsp;</td></tr>
        </table>';

        $tbl .=
        '<table cellspacing="0" cellpadding="1" border="0" align="center">
            <tr align="left">
               <td width="38%">Nama yang melaporkan</td>
               <td width="5%"> : </td>
               <td width="57%">'.$param['b']['docrt_form_nama'].'</td>
            </tr>
            <tr align="left">
               <td width="38%">Hubungan dengan bayi</td>
               <td width="5%"> : </td>
               <td width="57%">'.$param['b']['docrt_form_hubungan'].'</td>
            </tr>
            <tr><td>&nbsp;</td></tr>
        </table>';

        $tbl .= $param['b']['Footer2'];
        // end kontent 1
    $tbl .= '</td>';
    $tbl .= '<td width="34%">'; // MAIN TD ===================================================
        // kontent 2
        $tbl .=
        '<table cellspacing="0" cellpadding="1" border="0" align="center">
            <tr><td>UNTUK KECAMATAN</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>SURAT KEMATIAN</td></tr>
            <tr>
                <td>Nomor : '.$param['b']['noreg'].'</td>
            </tr>
            <tr><td>&nbsp;</td></tr>
        </table>';

        $i = 1;
        $tbl .='<table cellspacing="0" cellpadding="1" style="border:1px solid black;" width="94%" align="center">
        <tr align="center"><td colspan="4"><strong '.$underline.'>B A Y I</strong></td></tr>';
        foreach ( $param['a'] as $key => $value) {
        $tbl .= '
            <tr align="left">
               <td width="7%">'. $i .'.</td>
               <td width="33%">'. $key.'</td>
               <td width="5%"> : </td>
               <td width="55%">'. $value.'</td>
            </tr>';
        $i++;
        }
        $tbl .='<tr><td>&nbsp;</td></tr>
        </table>';

        $i = 9;
        $tbl .='<table cellspacing="0" cellpadding="1" style="border:1px solid black;" width="94%" align="center">
        <tr align="center"><td colspan="4">I B U</td></tr>';
        foreach ( $param['a1'] as $key => $value) {
        $tbl .= '
            <tr align="left">
               <td width="7%">'. $i .'.</td>
               <td width="33%">'. $key.'</td>
               <td width="5%"> : </td>
               <td width="55%">'. $value.'</td>
            </tr>';
        $i++;
        }
        $tbl .='<tr><td>&nbsp;</td></tr>
        </table>';

        $i = 13;
        $tbl .='<table cellspacing="0" cellpadding="1" style="border:1px solid black;" width="94%" align="center">
        <tr align="center"><td colspan="4">A Y A H</td></tr>';
        foreach ( $param['a2'] as $key => $value) {
        $tbl .= '
            <tr align="left">
               <td width="7%">'. $i .'.</td>
               <td width="33%">'. $key.'</td>
               <td width="5%"> : </td>
               <td width="55%">'. $value.'</td>
            </tr>';
        $i++;
        }
        $tbl .='<tr><td>&nbsp;</td></tr>
        </table>';

        $tbl .='<table><tr><td>&nbsp;</td></tr></table>';
        $tbl .= $param['b']['Footer1'];
        // end kontent 2
    $tbl .= '</td>';
    $tbl .= ' <td width="33%" style="border: 10px solid transparent;">';  // MAIN TD ===================================================
        // kontent 3
        $tbl .=
         '<table cellspacing="0" cellpadding="0" border="0" align="center" width="90%">
            <tr><td>&nbsp;</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><strong>UNTUK YANG BERSANGKUTAN</strong></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td><strong '.$underline.'>SURAT KELAHIRAN</strong></td></tr>
            <tr>
                <td>Nomor : '.$param['b']['noreg'].'</td>
            </tr>
            <tr><td>&nbsp;</td></tr>
        </table>';
        $tbl .=
        '<table cellspacing="0" cellpadding="0" border="0" width="90%">
            <tr align="left">
                <td width="5%"></td>
                <td width="95%">Yang bertandatangan di bawah ini, menerangkan bahwa : </td>
            </tr>
            <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
        </table>';
        $tbl .='<table cellspacing="0" cellpadding="1">';
        foreach ( $param['c'] as $key => $value) {
            if ($value[0] == '-') {
                $tbl .= '
                    <tr align="left">
                        <td width="5%"></td>
                       <td colspan="3">'. $value[1].'</td>
                    </tr>';
            } else {
                $tbl .= '
                    <tr align="left">
                        <td width="5%"></td>
                       <td width="30%">'. $key.'</td>
                       <td width="5%"> : </td>
                       <td width="58%">'. $value.'</td>
                    </tr>';
            }
        }
        $tbl .='<tr><td>&nbsp;</td></tr>
        </table>';

        $tbl .=
        '<table cellspacing="0" cellpadding="1" border="0" align="center">
            <tr><td>&nbsp;</td></tr>
            <tr>
                <td width="5%"></td>
                <td width="95%">Surat Keterangan ini dibuat atas dasar yang sebenarnya</td></tr>
            <tr><td>&nbsp;</td></tr>
        </table>';

        $tbl .=
        '<table cellspacing="0" cellpadding="1" border="0" align="center">
            <tr align="left">
                <td width="5%"></td>
               <td width="38%">Nama yang melaporkan</td>
               <td width="5%"> : </td>
               <td width="57%">'.$param['b']['docrt_form_nama'].'</td>
            </tr>
            <tr align="left">
                <td width="5%"></td>
               <td width="38%">Hubungan dengan bayi</td>
               <td width="5%"> : </td>
               <td width="57%">'.$param['b']['docrt_form_hubungan'].'</td>
            </tr>
            <tr><td>&nbsp;</td></tr>
        </table>';

        $tbl .= $param['b']['Footer2'];
        // end kontent 3
    $tbl .= '</td>';

    $tbl .= '
    </tr>
    </table>';

    //print_r($tbl); exit;
    return $tbl;
}
