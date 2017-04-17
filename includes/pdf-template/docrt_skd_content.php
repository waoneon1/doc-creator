<?php
function docrt_skd_content($param, $meta, $post_term) {
    $space = '<span style="color:white;">------------</span>';

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
               <td width="65%">'. $value .'</td>
            </tr>
        </table>';
    }

    $tbl .= '
     <table cellspacing="0" cellpadding="1" border="0">
        <tr>
            <td width="100%" colspan="3"><p align="justify">'.$space.'Berdasarkan Keterangan '.$meta['docrt_form_rtrw'][0].' Kelurahan '.$meta['docrt_form_kelurahan'][0].' Kecamatan '.$meta['docrt_form_kecamatan'][0].' Kota '.$meta['docrt_form_kota'][0].', '.$meta['docrt_form_nama_usaha'][0].' tersebut benar-benar berdomisili di '.$meta['docrt_form_alamat_usaha'][0].' Kelurahan '.$meta['docrt_form_kelurahan'][0].' Kecamatan '.$meta['docrt_form_kecamatan'][0].' Kota '.$meta['docrt_form_kota'][0].',
           </p></td>
        </tr>
    </table>';

    $tbl .= '
     <table cellspacing="0" cellpadding="1" border="0">
        <tr>
            <td>'.$space.'Sebagai penanggung jawab adalah: </td></tr>
        <tr>
            <td width="10%"></td>
            <td width="30%">Nama</td>
            <td width="5%"> : </td>
            <td width="55%">'. $meta['docrt_form_nama'][0] .'</td>
        </tr>
        <tr>
            <td width="10%"></td>
            <td width="30%">Alamat</td>
            <td width="5%"> : </td>
            <td width="55%">'. $meta['docrt_form_alamat'][0] .'</td>
        </tr>
        <tr>
            <td width="100%" colspan="4"><p align="justify">'.$space.'Surat tersebut akan dipergunakan untuk '.$meta['docrt_form_tujuan'][0].'</p>
            </td>
        </tr>
        <tr>
            <td width="100%" colspan="4"><p align="justify">'.$space.'Demikian surat keterangan ini kami buat untuk dapatnya dipergunakan sebagaimana mestinya.</p>
            </td>
        </tr>
        <tr>
            <td width="100%" colspan="4">
            </td>
        </tr>
    </table>';


    return $tbl;
}
//====================================================================================================
