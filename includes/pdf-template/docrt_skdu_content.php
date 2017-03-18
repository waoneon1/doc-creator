<?php
function docrt_skdu_content($param, $meta, $post_term) {

    $space = '<span style="color:white;">--------------</span>';

    $tbl = '
    <table cellspacing="0" cellpadding="1" border="0">
        <tr>
            <td width="100%" colspan="3"><p align="justify">'.$space.'Yang bertanda tangan dibawah ini kami, Lurah '.docrt_dd('kel').' Kecamatan '.docrt_dd('kec').' Kota Malang, menerangkan dengan Sebenarnya bahwa:</p></td>
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
            <td width="100%" colspan="3">
            <p align="justify">'. $space.'Bahwa berdasarkan Keterangan '.$param['b']['docrt_form_rtrw_usaha'].', '.$param['b']['docrt_form_ketRT'].', Tgl. '.$param['b']['docrt_form_tgl'].' Kelurahan '.docrt_dd('kel').' Kecamatan '.docrt_dd('kec').' Kota Malang, orang tersebut diatas benar-benar mempunyai Usaha '.$param['b']['docrt_form_nama_usaha'].' yang bergerak di Bidang '.$param['b']['docrt_form_ket_usaha'].', yang saat ini berdomisili di '.$param['b']['docrt_form_alamat_usaha'].', '.$param['b']['docrt_form_rtrw_usaha'].' Kelurahan '.docrt_dd('kel').' Kecamatan '.docrt_dd('kec').' Kota Malang.
            </p></td>
        </tr>
        <tr>
            <td width="100%" colspan="3"><p align="justify">'.$space.'Surat keterangan tersebut akan diperguanakan untuk <strong>'.$param['b']['docrt_form_keperluan'].'.</strong> Surat keterangan ini berlaku 6(Enam) bulan terhitung sejak surat dikeluarkan.
            </p></td>
        </tr>
        <tr>
            <td width="100%" colspan="3"><p align="justify">'.$space.'Demikian surat keterangan ini kami buat untuk dapatnya dipergunakan sebagaimana mestinya.
            </p></td>
        </tr>
    </table>';

    return $tbl;
}
//====================================================================================================