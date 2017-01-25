<?php
$meta = get_post_meta( $post->ID);
$docrt_get_all_term = docrt_get_all_term();

echo '<table class="docrt_pemohon_box docrt_tbl docrt_tp_sku">';
    foreach ($docrt_get_all_term as $key => $t) {
        if (isset($meta['docrt_'.$t->slug.'_id'][0])) {
            $suratid = $meta['docrt_'.$t->slug.'_id'][0];
        } else {
            $suratid = get_option('docrt_'.$t->slug.'') + 1;
        }

        // form id & title
        echo '<tbody class="docrt_'.$t->slug.'_id_title docrt_form_title d-hide">';
            echo '<tr>
                <td colspan="3"><h4>'.ucwords($t->name).'</h4></td>
            </tr>
            <tr align="left">
                <th><label class="diy-label" for="docrt_'.$t->slug.'_id">No Surat</label></th>
                <td> : </td>
                <td><input name="docrt_'.$t->slug.'_id" type="text" class="docrt_inputs" id="docrt_'.$t->slug.'_id" value="'.$suratid.'" readonly/></td>
            </tr>';
        echo '</tbody>';
    }

    //all form start here



    // Data Diri=====================================================
    echo '<tbody>';
    echo '<tr><td colspan="3">&nbsp;</td></tr>
    <tr align="left">
        <th colspan="3"><label class="headform-label">Data Diri / Pelapor</label></th>
    </tr>
    <tr><td colspan="3"><hr/></td></tr>






    ';

     // alter kematian karena banyak jadi data diri/ pelapor yg di alter
    echo '<tbody class="docrt_form_nama_mati_tr docrt_form">
    <tr><td colspan="3">&nbsp;</td></tr>
    <tr align="left">
        <th colspan="3"><label class="headform-label">Data Kematian</label></th>
    </tr>
    <tr><td colspan="3"><hr/></td></tr></tbody>

    <tbody>
    ';

    // Data Diri Lanjutan..
    echo '









    ';
    echo '</tbody>';


    // Alamat=======================================================================
    echo '<tbody>';
    echo '





    ';
    echo '</tbody>';


     // alter Kelahiran
    echo '<tbody class="docrt_form_nama_bayi_tr docrt_form">
    <tr><td colspan="3">&nbsp;</td></tr>
    <tr align="left">
        <th colspan="3"><label class="headform-label">Data Kelahiran</label></th>
    </tr>
    <tr><td colspan="3"><hr/></td></tr></tbody>
    <tbody>';

    // Keterangan =======================================================================
    echo '<tbody>';
    echo '<tr><td colspan="3">&nbsp;</td></tr>
    <tr align="left">
        <th colspan="3"><label class="headform-label">Keterangasn</label></th>
    </tr>
    <tr><td colspan="3"><hr/></td></tr>


    ';
    echo form_berlaku_tanggal($meta);
    echo '



    ';
    echo form_menerangkan_bahwa($meta);
    // Saksi

    echo '
    ';
    echo '</tbody>';

    // alter Kelahiran ayah ibu
    echo '<tbody class="docrt_form_nama_bayi_tr docrt_form">
    <tr><td colspan="3">&nbsp;</td></tr>
    <tr align="left">
        <th colspan="3"><label class="headform-label">Data Ayah dan Ibu Bayi</label></th>
    </tr>
    <tr><td colspan="3"><hr/></td></tr></tbody>
    ';

    // Usaha Lembaga Acara ===================================================================
    echo '<tbody class="docrt_thead_org docrt_thead d-hide">';
    echo '<tr><td colspan="3">&nbsp;</td></tr>
    <tr align="left">
        <th colspan="3"><label class="headform-label">Keterangan Acara/Usaha/Lembaga/Organisasi</label></th>
    </tr>
    <tr><td colspan="3"><hr/></td></tr>';
    echo '</tbody>';

    // Pindah ===========================================================================
    echo '<tbody class="docrt_thead_pindah docrt_thead d-hide">';
    echo '<tr><td colspan="3">&nbsp;</td></tr>
    <tr align="left">
        <th colspan="3"><label class="headform-label"><strong>Pindah ke : </strong></label></th>
    </tr>';
    echo '</tbody>';
echo '</table>';


