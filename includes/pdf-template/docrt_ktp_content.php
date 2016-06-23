<?php
function docrt_ktp_content($param, $meta, $post_term) {

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
    return $tbl;
}