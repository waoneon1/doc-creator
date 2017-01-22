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
    <tr align="left" class="docrt_form_nama_mati_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_nama_mati">Nama</label></th>
        <td> : </td>
        <td><input name="docrt_form_nama_mati" type="text" class="docrt_inputs" id="docrt_form_nama_mati" value="'.$meta['docrt_form_nama_mati'][0].'" /></td>
    </tr>
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

echo '<table class="docrt_pemohon_box docrt_tbl_pindah">';
    echo '<tbody>';
    echo '
    <tr align="center">
        <th></th>
        <th>Nama</th>
        <th>JK</th>
        <th>Tgl. Lahir</th>
        <th>Status</th>
        <th>Pendkn</th>
        <th>No KTP</th>
        <th>Keterangan</th>
    </tr>';

    for ($i=1; $i <= 20; $i++) {

        echo '<tr align="center" class="docrt_pengikut docrt_pengikut'.$i.'">
            <td></td>
            <td><input name="docrt_pengikut_nama'.$i.'" type="text" id="docrt_pengikut_nama'.$i.'" value="'.$meta['docrt_pengikut_nama'.$i][0].'" class="pengikut_nama"/></td>
            <td><select class="pengikut_jk" name="docrt_pengikut_jk'.$i.'" id="docrt_pengikut_jk'.$i.'" >
                  <option value="Laki-Laki" >L</option>
                  <option value="Perempuan" '.(($meta['docrt_pengikut_jk'.$i][0] == 'Perempuan') ? 'selected' : '').'>P</option>
                </select>
            </td>
            <td><input name="docrt_pengikut_lahir'.$i.'" type="date" id="docrt_pengikut_lahir'.$i.'" value="'.$meta['docrt_pengikut_lahir'.$i][0].'" class="pengikut_tgl"/></td>
            <td><select class="pengikut_status" name="docrt_pengikut_status'.$i.'" type="text" id="docrt_pengikut_status'.$i.'" >
                  <option value="Blm Kawin">Blm Kawin</option>
                  <option value="Kawin" '.(($meta['docrt_pengikut_status'.$i][0] == 'Kawin') ? 'selected' : '').'>Kawin</option>
                  <option value="Janda/Duda" '.(($meta['docrt_pengikut_status'.$i][0] == 'Janda/Duda') ? 'selected' : '').'>Janda/Duda</option>
                </select>
            </td>
            <td><input name="docrt_pengikut_pendidikan'.$i.'" type="text" id="docrt_pengikut_pendidikan'.$i.'" value="'.$meta['docrt_pengikut_pendidikan'.$i][0].'" class="pengikut_pend"/></td>
            <td><input name="docrt_pengikut_nik'.$i.'" type="text" id="docrt_pengikut_nik'.$i.'" value="'.$meta['docrt_pengikut_nik'.$i][0].'" class="pengikut_nik"/></td>
            <td><input name="docrt_pengikut_keterangan'.$i.'" type="text" id="docrt_pengikut_keterangan'.$i.'" value="'.$meta['docrt_pengikut_keterangan'.$i][0].'" class="pengikut_ket"/></td>
        </tr>';
    }
    echo '</tbody>';
echo '</table>';


function form_berlaku_tanggal($meta) {

    $date = date_i18n( 'j F', strtotime('now')).' s/d '.date_i18n( 'j F Y', strtotime('next month'));
    if (date('m') == '12') {
        $date = date_i18n( 'j F Y', strtotime('now')).' s/d '.date_i18n( 'j F Y', strtotime('next month'));
    }
    $data = '<tr align="left" class="docrt_form_tgl_berlaku_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_tgl_berlaku">Berlaku Tanggal</label></th>
        <td> : </td>
        <td><input name="docrt_form_tgl_berlaku" type="text"
        class="docrt_inputs" id="docrt_form_tgl_berlaku"
        value="'.($meta['docrt_form_tgl_berlaku'][0] ? $meta['docrt_form_tgl_berlaku'][0] :
            $date).'"/></td>
    </tr>';
    return $data;
}

function form_menerangkan_bahwa($meta) {

    $data = '<tr align="left" class="docrt_form_menerangkan_bahwa_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_menerangkan_bahwa">Menerangkan Bahwa</label></th>
        <td> : </td>
        <td><textarea rows="3" name="docrt_form_menerangkan_bahwa" class="docrt_inputs" id="docrt_form_menerangkan_bahwa">'.$meta['docrt_form_menerangkan_bahwa'][0].'</textarea>
        </td>
    </tr>';
    return $data;
}
