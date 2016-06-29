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
    <tr align="left" class="docrt_form_nama_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_nama">Nama</label></th>
        <td> : </td>
        <td><input name="docrt_form_nama" type="text" class="docrt_inputs" id="docrt_form_nama" value="'.$meta['docrt_form_nama'][0].'" /></td>
    </tr>
    <tr align="left" class="docrt_form_hubungan_tr docrt_form">
        <th>
            <label class="diy-label docrt_form_nama_mati_tr docrt_form" for="docrt_form_hubungan">Hubungan Dng Yg Mati</label>
            <label class="diy-label docrt_form_nama_bayi_tr docrt_form" for="docrt_form_hubungan">Hubungan</label></th>
        <td> : </td>
        <td><input name="docrt_form_hubungan" type="text" class="docrt_inputs" id="docrt_form_hubungan" value="'.$meta['docrt_form_hubungan'][0].'" /></td>
    </tr>';

    // alter kematian
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
    echo '<tr align="left" class="docrt_form_ttl_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_ttl">Tempat Tanggal Lahir</label></th>
        <td> : </td>
        <td><input name="docrt_form_ttl" type="text" class="docrt_inputs" id="docrt_form_ttl" value="'.$meta['docrt_form_ttl'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_umur_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_umur">Umur</label></th>
        <td> : </td>
        <td><input name="docrt_form_umur" type="text" class="docrt_inputs" id="docrt_form_umur" value="'.$meta['docrt_form_umur'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_jk_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_jk">Jenis Kelamin</label></th>
        <td> : </td>
        <td><select name="docrt_form_jk" class="docrt_inputs" id="docrt_form_jk" >
              <option value="Laki-Laki" >Laki - Laki</option>
              <option value="Perempuan" '.(($meta['docrt_form_jk'][0] == 'Perempuan') ? 'selected' : '').'>Perempuan</option>
            </select>
        </td>
    </tr>
    <tr align="left" class="docrt_form_kebangsaan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_kebangsaan">Kebangsaan</label></th>
        <td> : </td>
        <td><input name="docrt_form_kebangsaan" type="text" class="docrt_inputs" id="docrt_form_kebangsaan" value="'.$meta['docrt_form_kebangsaan'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_agama_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_agama">Agama</label></th>
        <td> : </td>
         <td><select name="docrt_form_agama" class="docrt_inputs" id="docrt_form_agama" >
              <option value="Islam" >Islam</option>
              <option value="Kristen" '.(($meta['docrt_form_agama'][0] == 'Kristen') ? 'selected' : '').'>Kristen</option>
              <option value="Katolik" '.(($meta['docrt_form_agama'][0] == 'Katolik') ? 'selected' : '').'>Katolik</option>
              <option value="Hindu" '.(($meta['docrt_form_agama'][0] == 'Hindu') ? 'selected' : '').'>Hindu</option>
              <option value="Budha" '.(($meta['docrt_form_agama'][0] == 'Budha') ? 'selected' : '').'>Budha</option>
              <option value="Lain-Lain" '.(($meta['docrt_form_agama'][0] == 'Lain-Lain') ? 'selected' : '').'>Lain-Lain</option>
            </select>
        </td>
    </tr>
    <tr align="left" class="docrt_form_sperkawinan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_sperkawinan">Status Perkawinan</label></th>
        <td> : </td>
        <td><select name="docrt_form_sperkawinan" class="docrt_inputs" id="docrt_form_sperkawinan" >
              <option value="Belum Kawin" >Belum Kawin</option>
              <option value="Kawin" '.(($meta['docrt_form_sperkawinan'][0] == 'Kawin') ? 'selected' : '').'>Kawin</option>
              <option value="Janda/Duda" '.(($meta['docrt_form_sperkawinan'][0] == 'Janda/Duda') ? 'selected' : '').'>Janda/Duda</option>
            </select>
        </td>
    </tr>
    <tr align="left" class="docrt_form_nokk_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_nokk">No KK</label></th>
        <td> : </td>
        <td><input name="docrt_form_nokk" type="text" class="docrt_inputs" id="docrt_form_nokk" value="'.$meta['docrt_form_nokk'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_nonik_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_nonik">No NIK</label></th>
        <td> : </td>
        <td><input name="docrt_form_nonik" type="text" class="docrt_inputs" id="docrt_form_nonik" value="'.$meta['docrt_form_nonik'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_pekerjaan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_pekerjaan">Pekerjaan</label></th>
        <td> : </td>
        <td><input name="docrt_form_pekerjaan" type="text" class="docrt_inputs" id="docrt_form_pekerjaan" value="'.$meta['docrt_form_pekerjaan'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_pendidikan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_pendidikan">Pendidikan</label></th>
        <td> : </td>
        <td><select name="docrt_form_pendidikan" class="docrt_inputs" id="docrt_form_pendidikan" >
              <option value="SD" >SD</option>
              <option value="SMP" '.(($meta['docrt_form_pendidikan'][0] == 'SMP') ? 'selected' : '').'>SMP</option>
              <option value="SMA" '.(($meta['docrt_form_pendidikan'][0] == 'SMA') ? 'selected' : '').'>SMA</option>
              <option value="Akademi/Universitas" '.(($meta['docrt_form_pendidikan'][0] == 'Akademi/Universitas') ? 'selected' : '').'>Akademi/Universitas</option>
              <option value="Tidak Sekolah" '.(($meta['docrt_form_pendidikan'][0] == 'Tidak Sekolah') ? 'selected' : '').'>Tidak Sekolah</option>
              <option value="Tidak Tamat SD" '.(($meta['docrt_form_pendidikan'][0] == 'Tidak Tamat SD') ? 'selected' : '').'>Tidak Tamat SD</option>
            </select>
        </td>
    </tr>
    <tr align="left" class="docrt_form_goldarah_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_goldarah">Golongan Darah</label></th>
        <td> : </td>
        <td><select name="docrt_form_goldarah" class="docrt_inputs" id="docrt_form_goldarah" >
              <option value="O" >O</option>
              <option value="A" '.(($meta['docrt_form_goldarah'][0] == 'A') ? 'selected' : '').'>A</option>
              <option value="B" '.(($meta['docrt_form_goldarah'][0] == 'B') ? 'selected' : '').'>B</option>
              <option value="AB" '.(($meta['docrt_form_goldarah'][0] == 'AB') ? 'selected' : '').'>AB</option>
            </select>
        </td>
    </tr>';
    echo '</tbody>';


    // Alamat=======================================================================
    echo '<tbody>';
    echo '<tr align="left" class="docrt_form_alamat_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_alamat">Alamat</label></th>
        <td> : </td>
        <td><textarea rows="3" name="docrt_form_alamat" class="docrt_inputs" id="docrt_form_alamat">'.$meta['docrt_form_alamat'][0].'</textarea>
        </td>
    </tr>
    <tr align="left" class="docrt_form_rtrw_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_rtrw">RT / RW</label></th>
        <td> : </td>
        <td><input name="docrt_form_rtrw" type="text" class="docrt_inputs" id="docrt_form_rtrw" value="'.$meta['docrt_form_rtrw'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_kelurahan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_kelurahan">Kelurahan</label></th>
        <td> : </td>
        <td><input name="docrt_form_kelurahan" type="text" class="docrt_inputs" id="docrt_form_kelurahan" value="'.$meta['docrt_form_kelurahan'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_kecamatan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_kecamatan">Kecamatan</label></th>
        <td> : </td>
        <td><input name="docrt_form_kecamatan" type="text" class="docrt_inputs" id="docrt_form_kecamatan" value="'.$meta['docrt_form_kecamatan'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_kota_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_kota">Kota/Kabupaten</label></th>
        <td> : </td>
        <td><input name="docrt_form_kota" type="text" class="docrt_inputs" id="docrt_form_kota" value="'.$meta['docrt_form_kota'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_provinsi_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_provinsi">Provinsi</label></th>
        <td> : </td>
        <td><input name="docrt_form_provinsi" type="text" class="docrt_inputs" id="docrt_form_provinsi" value="'.$meta['docrt_form_provinsi'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_tlp_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_tlp">Telepon</label></th>
        <td> : </td>
        <td><input name="docrt_form_tlp" type="text" class="docrt_inputs" id="docrt_form_tlp" value="'.$meta['docrt_form_tlp'][0].'"/></td>
    </tr>';
    echo '</tbody>';

     // alter Kelahiran
    echo '<tbody class="docrt_form_nama_bayi_tr docrt_form">
    <tr><td colspan="3">&nbsp;</td></tr>
    <tr align="left">
        <th colspan="3"><label class="headform-label">Data Kelahiran</label></th>
    </tr>
    <tr><td colspan="3"><hr/></td></tr></tbody>
    <tr align="left" class="docrt_form_nama_bayi_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_nama_bayi">Nama Bayi</label></th>
        <td> : </td>
        <td><input name="docrt_form_nama_bayi" type="text" class="docrt_inputs" id="docrt_form_nama_bayi" value="'.$meta['docrt_form_nama_bayi'][0].'" /></td>
    </tr>
    <tr align="left" class="docrt_form_dilahirkan1_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_dilahirkan1">Tanggal Dilahirkan</label></th>
        <td> : </td>
        <td><input name="docrt_form_dilahirkan1" type="date" class="docrt_inputs" id="docrt_form_dilahirkan1" value="'.$meta['docrt_form_dilahirkan1'][0].'" /></td>
    </tr>
    <tr align="left" class="docrt_form_nonik_bayi_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_nonik_bayi">No NIK</label></th>
        <td> : </td>
        <td><input name="docrt_form_nonik_bayi" type="text" class="docrt_inputs" id="docrt_form_nonik_bayi" value="'.$meta['docrt_form_nonik_bayi'][0].'" /></td>
    </tr>
    <tr align="left" class="docrt_form_anakke_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_anakke">Anak Ke</label></th>
        <td> : </td>
        <td><input name="docrt_form_anakke" type="number" class="docrt_inputs" id="docrt_form_anakke" value="'.$meta['docrt_form_anakke'][0].'" /></td>
    </tr>
    <tr align="left" class="docrt_form_kelahiran_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_kelahiran">Kelahiran</label></th>
        <td> : </td>
        <td><select name="docrt_form_kelahiran" class="docrt_inputs" id="docrt_form_kelahiran" >
              <option value="Tunggal" >Tunggal</option>
              <option value="Kembar" '.(($meta['docrt_form_kelahiran'][0] == 'Kembar') ? 'selected' : '').'>Kembar</option>
            </select>
        </td>
    </tr>
    <tr align="left" class="docrt_form_kembarke_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_kembarke">Kembar Ke</label></th>
        <td> : </td>
        <td><input name="docrt_form_kembarke" type="number" class="docrt_inputs" id="docrt_form_kembarke" value="'.$meta['docrt_form_kembarke'][0].'" /></td>
    </tr>
    <tr align="left" class="docrt_form_jk_bayi_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_jk_bayi">Jenis Kelamin</label></th>
        <td> : </td>
        <td><select name="docrt_form_jk_bayi" class="docrt_inputs" id="docrt_form_jk_bayi" >
              <option value="Laki-Laki" >Laki - Laki</option>
              <option value="Perempuan" '.(($meta['docrt_form_jk_bayi'][0] == 'Perempuan') ? 'selected' : '').'>Perempuan</option>
            </select>
        </td>
    </tr>
    <tr align="left" class="docrt_form_kota_bayi_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_kota_bayi">Kota/Kabupaten Kelahiran</label></th>
        <td> : </td>
        <td><input name="docrt_form_kota_bayi" type="text" class="docrt_inputs" id="docrt_form_kota_bayi" value="'.$meta['docrt_form_kota_bayi'][0].'"/></td>
    </tr>
    <tbody>';

    // Keterangan =======================================================================
    echo '<tbody>';
    echo '<tr><td colspan="3">&nbsp;</td></tr>
    <tr align="left">
        <th colspan="3"><label class="headform-label">Keterangan</label></th>
    </tr>
    <tr><td colspan="3"><hr/></td></tr>
    <tr align="left" class="docrt_form_keperluan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_keperluan">Keperluan</label></th>
        <td> : </td>
        <td><textarea rows="2" name="docrt_form_keperluan" class="docrt_inputs" id="docrt_form_keperluan">'.$meta['docrt_form_keperluan'][0].'</textarea>
        </td>
    </tr>
    <tr align="left" class="docrt_form_tujuan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_tujuan">Tujuan</label></th>
        <td> : </td>
        <td><textarea rows="2" name="docrt_form_tujuan" class="docrt_inputs" id="docrt_form_tujuan">'.$meta['docrt_form_tujuan'][0].'</textarea>
        </td>
    </tr>
    <tr align="left" class="docrt_form_tgl_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_tgl">Tanggal</label></th>
        <td> : </td>
        <td><input name="docrt_form_tgl" type="date" class="docrt_inputs" id="docrt_form_tgl" value="'.$meta['docrt_form_tgl'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_tgl_berlaku_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_tgl_berlaku">Berlaku Tanggal</label></th>
        <td> : </td>
        <td><input name="docrt_form_tgl_berlaku" type="date" class="docrt_inputs" id="docrt_form_tgl_berlaku" value="'.$meta['docrt_form_tgl_berlaku'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_ketRT_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_ketRT">Sesuai Keterangan RT</label></th>
        <td> : </td>
        <td><input name="docrt_form_ketRT" type="text" class="docrt_inputs" id="docrt_form_ketRT" value="'.$meta['docrt_form_ketRT'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_tempat_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_tempat">Tempat</label></th>
        <td> : </td>
        <td><input name="docrt_form_tempat" type="text" class="docrt_inputs" id="docrt_form_tempat" value="'.$meta['docrt_form_tempat'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_sebab_kematian_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_sebab_kematian">Sebab</label></th>
        <td> : </td>
        <td><input name="docrt_form_sebab_kematian" type="text" class="docrt_inputs" id="docrt_form_sebab_kematian" value="'.$meta['docrt_form_sebab_kematian'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_penolong_lahir_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_penolong_lahir">Penolong Kelahiran</label></th>
        <td> : </td>
        <td><input name="docrt_form_penolong_lahir" type="text" class="docrt_inputs" id="docrt_form_penolong_lahir" value="'.$meta['docrt_form_penolong_lahir'][0].'" /></td>
    </tr>';
    echo '</tbody>';

    // alter Kelahiran ayah ibu
    echo '<tbody class="docrt_form_nama_bayi_tr docrt_form">
    <tr><td colspan="3">&nbsp;</td></tr>
    <tr align="left">
        <th colspan="3"><label class="headform-label">Data Ayah dan Ibu Bayi</label></th>
    </tr>
    <tr><td colspan="3"><hr/></td></tr></tbody>


        <tr align="left" class="docrt_form_nama_ibu_tr docrt_form">
            <th><label class="diy-label" for="docrt_form_nama_ibu">Nama Ibu</label></th>
            <td> : </td>
            <td><input name="docrt_form_nama_ibu" type="text" class="docrt_inputs" id="docrt_form_nama_ibu" value="'.$meta['docrt_form_nama_ibu'][0].'" /></td>
        </tr>
        <tr align="left" class="docrt_form_dilahirkan2_tr docrt_form">
            <th><label class="diy-label" for="docrt_form_dilahirkan2"> - Tanggal Dilahirkan</label></th>
            <td> : </td>
            <td><input name="docrt_form_dilahirkan2" type="date" class="docrt_inputs" id="docrt_form_dilahirkan2" value="'.$meta['docrt_form_dilahirkan2'][0].'" /></td>
        </tr>
        <tr align="left" class="docrt_form_kebangsaan_ibu_tr docrt_form">
            <th><label class="diy-label" for="docrt_form_kebangsaan_ibu"> - Kewarganegaraan</label></th>
            <td> : </td>
            <td><input name="docrt_form_kebangsaan_ibu" type="text" class="docrt_inputs" id="docrt_form_kebangsaan_ibu" value="'.$meta['docrt_form_kebangsaan_ibu'][0].'"/></td>
        </tr>
        <tr align="left" class="docrt_form_alamat_ibu_tr docrt_form">
            <th><label class="diy-label" for="docrt_form_alamat_ibu"> - Alamat</label></th>
            <td> : </td>
            <td><input name="docrt_form_alamat_ibu" type="text" class="docrt_inputs" id="docrt_form_alamat_ibu" value="'.$meta['docrt_form_alamat_ibu'][0].'"/></td>
        </tr>
        <tr align="left" class="docrt_form_nonik_ibu_tr docrt_form">
            <th><label class="diy-label" for="docrt_form_nonik_ibu"> - No NIK</label></th>
            <td> : </td>
            <td><input name="docrt_form_nonik_ibu" type="text" class="docrt_inputs" id="docrt_form_nonik_ibu" value="'.$meta['docrt_form_nonik_ibu'][0].'"/></td>
        </tr>
        <tr align="left" class="docrt_form_pekerjaan_ibu_tr docrt_form">
            <th><label class="diy-label" for="docrt_form_pekerjaan_ibu"> - Pekarjaan</label></th>
            <td> : </td>
            <td><input name="docrt_form_pekerjaan_ibu" type="text" class="docrt_inputs" id="docrt_form_pekerjaan_ibu" value="'.$meta['docrt_form_pekerjaan_ibu'][0].'"/></td>
        </tr>
        <tr align="left" class="docrt_form_tlp_ibu_tr docrt_form">
            <th><label class="diy-label" for="docrt_form_tlp_ibu"> - Telepon</label></th>
            <td> : </td>
            <td><input name="docrt_form_tlp_ibu" type="text" class="docrt_inputs" id="docrt_form_tlp_ibu" value="'.$meta['docrt_form_tlp_ibu'][0].'"/></td>
        </tr>


        <tr align="left" class="docrt_form_nama_ayah_tr docrt_form">
            <th><label class="diy-label" for="docrt_form_nama_ayah">Nama Ayah</label></th>
            <td> : </td>
            <td><input name="docrt_form_nama_ayah" type="text" class="docrt_inputs" id="docrt_form_nama_ayah" value="'.$meta['docrt_form_nama_ayah'][0].'" /></td>
        </tr>
        <tr align="left" class="docrt_form_dilahirkan3_tr docrt_form">
            <th><label class="diy-label" for="docrt_form_dilahirkan3"> - Tanggal Dilahirkan</label></th>
            <td> : </td>
            <td><input name="docrt_form_dilahirkan3" type="date" class="docrt_inputs" id="docrt_form_dilahirkan3" value="'.$meta['docrt_form_dilahirkan3'][0].'" /></td>
        </tr>
        <tr align="left" class="docrt_form_kebangsaan_ayah_tr docrt_form">
            <th><label class="diy-label" for="docrt_form_kebangsaan_ayah"> - Kewarganegaraan</label></th>
            <td> : </td>
            <td><input name="docrt_form_kebangsaan_ayah" type="text" class="docrt_inputs" id="docrt_form_kebangsaan_ayah" value="'.$meta['docrt_form_kebangsaan_ayah'][0].'"/></td>
        </tr>
        <tr align="left" class="docrt_form_alamat_ayah_tr docrt_form">
            <th><label class="diy-label" for="docrt_form_alamat_ayah"> - Alamat</label></th>
            <td> : </td>
            <td><input name="docrt_form_alamat_ayah" type="text" class="docrt_inputs" id="docrt_form_alamat_ayah" value="'.$meta['docrt_form_alamat_ayah'][0].'"/></td>
        </tr>
        <tr align="left" class="docrt_form_nokk_ayah_tr docrt_form">
            <th><label class="diy-label" for="docrt_form_nokk_ayah"> - No KK</label></th>
            <td> : </td>
            <td><input name="docrt_form_nokk_ayah" type="text" class="docrt_inputs" id="docrt_form_nokk_ayah" value="'.$meta['docrt_form_nokk_ayah'][0].'"/></td>
        </tr>
        <tr align="left" class="docrt_form_nonik_ayah_tr docrt_form">
            <th><label class="diy-label" for="docrt_form_nonik_ayah"> - No NIK</label></th>
            <td> : </td>
            <td><input name="docrt_form_nonik_ayah" type="text" class="docrt_inputs" id="docrt_form_nonik_ayah" value="'.$meta['docrt_form_nonik_ayah'][0].'"/></td>
        </tr>
        <tr align="left" class="docrt_form_pekerjaan_ayah_tr docrt_form">
            <th><label class="diy-label" for="docrt_form_pekerjaan_ayah"> - Pekarjaan</label></th>
            <td> : </td>
            <td><input name="docrt_form_pekerjaan_ayah" type="text" class="docrt_inputs" id="docrt_form_pekerjaan_ayah" value="'.$meta['docrt_form_pekerjaan_ayah'][0].'"/></td>
        </tr>
        <tr align="left" class="docrt_form_tlp_ayah_tr docrt_form">
            <th><label class="diy-label" for="docrt_form_tlp_ayah"> - Telepon</label></th>
            <td> : </td>
            <td><input name="docrt_form_tlp_ayah" type="text" class="docrt_inputs" id="docrt_form_tlp_ayah" value="'.$meta['docrt_form_tlp_ayah'][0].'"/></td>
        </tr>
    <tbody>
    ';

    // Usaha Lembaga Acara ===================================================================
    echo '<tbody class="docrt_thead_org docrt_thead d-hide">';
    echo '<tr><td colspan="3">&nbsp;</td></tr>
    <tr align="left">
        <th colspan="3"><label class="headform-label">Keterangan Acara/Usaha/Lembaga/Organisasi</label></th>
    </tr>
    <tr><td colspan="3"><hr/></td></tr>
    <tr align="left" class="docrt_form_nama_usaha_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_nama_usaha">Nama Usaha</label></th>
        <td> : </td>
        <td><input name="docrt_form_nama_usaha" type="text" class="docrt_inputs" id="docrt_form_nama_usaha" value="'.$meta['docrt_form_nama_usaha'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_alamat_usaha_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_alamat_usaha">Alamat Usaha</label></th>
        <td> : </td>
        <td><input name="docrt_form_alamat_usaha" type="text" class="docrt_inputs" id="docrt_form_alamat_usaha" value="'.$meta['docrt_form_alamat_usaha'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_rtrw_usaha_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_rtrw_usaha">RT / RW</label></th>
        <td> : </td>
        <td><input name="docrt_form_rtrw_usaha" type="text" class="docrt_inputs" id="docrt_form_rtrw_usaha" value="'.$meta['docrt_form_rtrw_usaha'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_ket_usaha_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_ket_usaha">Keterangan Usaha</label></th>
        <td> : </td>
        <td><input name="docrt_form_ket_usaha" type="text" class="docrt_inputs" id="docrt_form_ket_usaha" value="'.$meta['docrt_form_ket_usaha'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_nama_lembaga_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_nama_lembaga">Nama Lembaga / Organisasi</label></th>
        <td> : </td>
        <td><input name="docrt_form_nama_lembaga" type="text" class="docrt_inputs" id="docrt_form_nama_lembaga" value="'.$meta['docrt_form_nama_lembaga'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_nama_noinduk_lembaga_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_nama_noinduk_lembaga">Nama "No Induk" Lembaga</label></th>
        <td> : </td>
        <td><input name="docrt_form_nama_noinduk_lembaga" type="text" class="docrt_inputs" id="docrt_form_nama_noinduk_lembaga" value="'.$meta['docrt_form_nama_noinduk_lembaga'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_noinduk_lembaga_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_noinduk_lembaga">No Induk Lembaga</label></th>
        <td> : </td>
        <td><input name="docrt_form_noinduk_lembaga" type="text" class="docrt_inputs" id="docrt_form_noinduk_lembaga" value="'.$meta['docrt_form_noinduk_lembaga'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_nama_acara_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_nama_acara">Nama Acara</label></th>
        <td> : </td>
        <td><input name="docrt_form_nama_acara" type="text" class="docrt_inputs" id="docrt_form_nama_acara" value="'.$meta['docrt_form_nama_acara'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_tgl_acara_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_tgl_acara">Tanggal Acara</label></th>
        <td> : </td>
        <td><input name="docrt_form_tgl_acara" type="date" class="docrt_inputs" id="docrt_form_tgl_acara" value="'.$meta['docrt_form_tgl_acara'][0].'"/></td>
    </tr>';
    echo '</tbody>';

    // Pindah ===========================================================================
    echo '<tbody class="docrt_thead_pindah docrt_thead d-hide">';
    echo '<tr><td colspan="3">&nbsp;</td></tr>
    <tr align="left">
        <th colspan="3"><label class="headform-label"><strong>Pindah ke : </strong></label></th>
    </tr>
    <tr><td colspan="3"><hr/></td></tr>
    <tr align="left" class="docrt_form_desa_pindah_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_desa_pindah">Desa</label></th>
        <td> : </td>
        <td><input name="docrt_form_desa_pindah" type="text" class="docrt_inputs" id="docrt_form_desa_pindah" value="'.$meta['docrt_form_desa_pindah'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_kecamatan_pindah_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_kecamatan_pindah">Kecamatan</label></th>
        <td> : </td>
        <td><input name="docrt_form_kecamatan_pindah" type="text" class="docrt_inputs" id="docrt_form_kecamatan_pindah" value="'.$meta['docrt_form_kecamatan_pindah'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_kabkota_pindah_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_kabkota_pindah">Kab/Kota</label></th>
        <td> : </td>
        <td><input name="docrt_form_kabkota_pindah" type="text" class="docrt_inputs" id="docrt_form_kabkota_pindah" value="'.$meta['docrt_form_kabkota_pindah'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_provinsi_pindah_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_provinsi_pindah">Provinsi</label></th>
        <td> : </td>
        <td><input name="docrt_form_provinsi_pindah" type="text" class="docrt_inputs" id="docrt_form_provinsi_pindah" value="'.$meta['docrt_form_provinsi_pindah'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_tgl_pindah_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_tgl_pindah">Tanggal Pindah</label></th>
        <td> : </td>
        <td><input name="docrt_form_tgl_pindah" type="date" class="docrt_inputs" id="docrt_form_tgl_pindah" value="'.$meta['docrt_form_tgl_pindah'][0].'"/></td>
    </tr>
    <tr align="left" class="docrt_form_alasan_pindah_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_alasan_pindah">Alasan Pindah</label></th>
        <td> : </td>
        <td><textarea rows="2" name="docrt_form_alasan_pindah" class="docrt_inputs" id="docrt_form_alasan_pindah">'.$meta['docrt_form_alasan_pindah'][0].'</textarea>
        </td>
    </tr>
    <tr align="left" class="docrt_form_pengikut_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_pengikut">Jml Pengikut</label></th>
        <td> : </td>
        <td><input name="docrt_form_pengikut" type="number" class="docrt_inputs" id="docrt_form_pengikut" value="'.$meta['docrt_form_pengikut'][0].'" max="20" min="0"/></td>
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

