<?php
function docrt_skai_content($param, $meta, $post_term) {

    $tbl = '
    <table cellspacing="0" cellpadding="1" border="0">
        <tr>
            <td width="10%"></td>
            <td colspan="2">Surat ini diberikan kepada orang yang tersebut dibawah ini:</td>
        </tr>
    </table>';

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

    $tbl .= '
    <table cellspacing="0" cellpadding="1" border="0">
        <tr>
           <td width="30%">Menerangkan Bahwa</td>
           <td width="5%"> </td>
           <td width="5%">1.</td>
           <td width="60%"><p align="justify">Orang tersebut benar-benar penduduk Kelurahan '.docrt_dd('kel').' Kecamatan '.docrt_dd('kec').' Kota Malang.</p></td>
        </tr>
        <tr>
           <td width="30%"> </td>
           <td width="5%"> </td>
           <td width="5%">2.</td>
           <td width="60%"><p align="justify">Selama ini dikenal berkelakuan baik dan tidak pernah terlibat kriminal.</p>
           </td>
        </tr>
    </table>';

    $tbl .= '
    <table cellspacing="0" cellpadding="1" border="0">
        <tr><td colspan="2"></td></tr>
        <tr>
            <td width="10%"></td>
            <td width="90%">Demikian untuk menjadikan periksa dan dipergunakan seperlunya.</td>
        </tr>
    </table>';

    return $tbl;
}
