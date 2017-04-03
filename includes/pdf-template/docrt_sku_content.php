<?php
function docrt_sku_content($param, $meta, $post_term) {

    $tbl = '
    <table cellspacing="0" cellpadding="1" border="0">
        <tr>
            <td width="10%"></td>
            <td colspan="2">Surat ini diberikan kepada orang yang tersebut dibawah ini:</td>
        </tr>
    </table>';

    foreach ( $param as $key => $value) {
        $tbl .= '
        <table cellspacing="0" cellpadding="1" border="0">
            <tr>
               <td width="30%">'. $key.'</td>
               <td width="5%"> : </td>
               <td width="65%">'. $meta[$value][0].'</td>
            </tr>
        </table>';
    }

    $tbl .= '
    <table cellspacing="0" cellpadding="1" border="0">
        <tr>
           <td width="30%">Menerangkan Bahwa</td>
           <td width="5%"> </td>
           <td width="5%">1.</td>
           <td width="60%">Yang bersangkutan benar-benar penduduk Kelurahan '.docrt_dd('kel').' Kec.'.docrt_dd('kec').' Kota Malang</td>
        </tr>
        <tr>
           <td width="30%"> </td>
           <td width="5%"> </td>
           <td width="5%">2.</td>
           <td width="60%">Berdasarkan Keterangan RT/ RW setempat Orang tersebut diatas mempunyai Usaha '
               .$meta['docrt_form_nama_usaha'][0].' di '
               .$meta['docrt_form_alamat_usaha'][0].'
           </td>
        </tr>
        <tr>
           <td width="30%"> </td>
           <td width="5%"> </td>
           <td width="5%">3.</td>
           <td width="60%">Berdasarkan catatan register kami, orang tersebut belum memiliki Ijin Usaha Mikro dan Kecil (IUMK)
           </td>
        </tr>
    </table>';

    $tbl .= '
    <table cellspacing="0" cellpadding="1" border="0">
        <tr>
            <td width="10%"></td>
            <td width="90%">Demikian untuk menjadikan periksa dan dipergunakan seperlunya.</td>
        </tr>
    </table>';

    return $tbl;
}
//====================================================================================================