<?php require_once('../../../../wp-load.php');

print_r($_POST);
$form = $_POST['data']['surat'];
$post_id = $_POST['post_id'];
$post_term = get_the_terms ($post_id,'surat' );
$meta = get_post_meta($post_id);

$return .= '';
foreach ($form as $key => $value) {
  if (function_exists($value)) {
    $return .= call_user_func_array($value, array($meta));
  } else {
    $return .= '<tr><td colspan="3">Form <b>'.$value.'</b> Hilang</td></tr>';
  }
}



echo $return;


/*=================================================
  Form Function
=================================================*/

//data diri ======================================
function docrt_form_nama($meta) {

  $data = '<tr align="left" class="docrt_form_nama_tr docrt_form">
      <th><label class="diy-label" for="docrt_form_nama">Nama</label></th>
      <td> : </td>
      <td><input name="docrt_form_nama" type="text" class="docrt_inputs" id="docrt_form_nama" value="'.$meta['docrt_form_nama'][0].'" /></td>
  </tr>';
  return $data;
}

function docrt_form_hubungan($meta) {

  $data = '<tr align="left" class="docrt_form_hubungan_tr docrt_form">
        <th>
            <label class="diy-label docrt_form_nama_mati_tr docrt_form" for="docrt_form_hubungan">Hubungan Dng Yg Mati</label>
            <label class="diy-label docrt_form_nama_bayi_tr docrt_form" for="docrt_form_hubungan">Hubungan</label></th>
        <td> : </td>
        <td><input name="docrt_form_hubungan" type="text" class="docrt_inputs" id="docrt_form_hubungan" value="'.$meta['docrt_form_hubungan'][0].'" /></td>
    </tr>';
  return $data;
}

function docrt_form_dilahirkan_pelapor($meta) {

  $data = ' <tr align="left" class="docrt_form_dilahirkan_pelapor_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_dilahirkan_pelapor"> - Tanggal Dilahirkan</label></th>
        <td> : </td>
        <td><input name="docrt_form_dilahirkan_pelapor" type="date" class="docrt_inputs" id="docrt_form_dilahirkan_pelapor" value="'.$meta['docrt_form_dilahirkan_pelapor'][0].'" /></td>
    </tr>';
  return $data;
}

function docrt_form_alamat_pelapor($meta) {

  $data = '<tr align="left" class="docrt_form_alamat_pelapor_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_alamat_pelapor"> - Alamat</label></th>
        <td> : </td>
        <td><input name="docrt_form_alamat_pelapor" type="text" class="docrt_inputs" id="docrt_form_alamat_pelapor" value="'.$meta['docrt_form_alamat_pelapor'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_nonik_pelapor($meta) {

  $data = '<tr align="left" class="docrt_form_nonik_pelapor_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_nonik_pelapor"> - No NIK</label></th>
        <td> : </td>
        <td><input name="docrt_form_nonik_pelapor" type="text" class="docrt_inputs" id="docrt_form_nonik_pelapor" value="'.$meta['docrt_form_nonik_pelapor'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_pekerjaan_pelapor($meta) {

  $data = '<tr align="left" class="docrt_form_pekerjaan_pelapor_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_pekerjaan_pelapor"> - Pekarjaan</label></th>
        <td> : </td>
        <td><input name="docrt_form_pekerjaan_pelapor" type="text" class="docrt_inputs" id="docrt_form_pekerjaan_pelapor" value="'.$meta['docrt_form_pekerjaan_pelapor'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_ttl($meta) {

  $data = '<tr align="left" class="docrt_form_ttl_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_ttl">Tempat Tanggal Lahir</label></th>
        <td> : </td>
        <td><input name="docrt_form_ttl" type="text" class="docrt_inputs" id="docrt_form_ttl" value="'.$meta['docrt_form_ttl'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_umur($meta) {

  $data = '<tr align="left" class="docrt_form_umur_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_umur">Umur</label></th>
        <td> : </td>
        <td><input name="docrt_form_umur" type="text" class="docrt_inputs" id="docrt_form_umur" value="'.$meta['docrt_form_umur'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_jk($meta) {

  $data = '<tr align="left" class="docrt_form_jk_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_jk">Jenis Kelamin</label></th>
        <td> : </td>
        <td><select name="docrt_form_jk" class="docrt_inputs" id="docrt_form_jk" >
              <option value="Laki-Laki" >Laki - Laki</option>
              <option value="Perempuan" '.(($meta['docrt_form_jk'][0] == 'Perempuan') ? 'selected' : '').'>Perempuan</option>
            </select>
        </td>
    </tr>';
  return $data;
}

function docrt_form_kebangsaan($meta) {

  $data = '<tr align="left" class="docrt_form_kebangsaan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_kebangsaan">Kebangsaan</label></th>
        <td> : </td>
        <td><input name="docrt_form_kebangsaan" type="text" class="docrt_inputs" id="docrt_form_kebangsaan" value="'.$meta['docrt_form_kebangsaan'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_agama($meta) {

  $data = '<tr align="left" class="docrt_form_agama_tr docrt_form">
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
    </tr>';
  return $data;
}

function docrt_form_sperkawinan($meta) {

  $data = '<tr align="left" class="docrt_form_sperkawinan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_sperkawinan">Status Perkawinan</label></th>
        <td> : </td>
        <td><select name="docrt_form_sperkawinan" class="docrt_inputs" id="docrt_form_sperkawinan" >
              <option value="Belum Kawin" >Belum Kawin</option>
              <option value="Kawin" '.(($meta['docrt_form_sperkawinan'][0] == 'Kawin') ? 'selected' : '').'>Kawin</option>
              <option value="Janda/Duda" '.(($meta['docrt_form_sperkawinan'][0] == 'Janda/Duda') ? 'selected' : '').'>Janda/Duda</option>
            </select>
        </td>
    </tr>';
  return $data;
}

function docrt_form_nokk($meta) {

  $data = '<tr align="left" class="docrt_form_nokk_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_nokk">No KK</label></th>
        <td> : </td>
        <td><input name="docrt_form_nokk" type="text" class="docrt_inputs" id="docrt_form_nokk" value="'.$meta['docrt_form_nokk'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_nonik($meta) {

  $data = '<tr align="left" class="docrt_form_nonik_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_nonik">No NIK</label></th>
        <td> : </td>
        <td><input name="docrt_form_nonik" type="text" class="docrt_inputs" id="docrt_form_nonik" value="'.$meta['docrt_form_nonik'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_pekerjaan($meta) {

  $data = ' <tr align="left" class="docrt_form_pekerjaan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_pekerjaan">Pekerjaan</label></th>
        <td> : </td>
        <td><input name="docrt_form_pekerjaan" type="text" class="docrt_inputs" id="docrt_form_pekerjaan" value="'.$meta['docrt_form_pekerjaan'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_pendidikan($meta) {

  $data = '<tr align="left" class="docrt_form_pendidikan_tr docrt_form">
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
    </tr>';
  return $data;
}

function docrt_form_goldarah($meta) {

  $data = '<tr align="left" class="docrt_form_goldarah_tr docrt_form">
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
  return $data;
}

// Alamat ======================================

function docrt_form_alamat($meta) {

  $data = '<tr align="left" class="docrt_form_alamat_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_alamat">Alamat</label></th>
        <td> : </td>
        <td><textarea rows="3" name="docrt_form_alamat" class="docrt_inputs" id="docrt_form_alamat">'.$meta['docrt_form_alamat'][0].'</textarea>
        </td>
    </tr>';
  return $data;
}

function docrt_form_rtrw($meta) {

  $data = '<tr align="left" class="docrt_form_rtrw_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_rtrw">RT / RW</label></th>
        <td> : </td>
        <td><input name="docrt_form_rtrw" type="text" class="docrt_inputs" id="docrt_form_rtrw" value="'.$meta['docrt_form_rtrw'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_kelurahan($meta) {

  $data = '<tr align="left" class="docrt_form_kelurahan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_kelurahan">Kelurahan</label></th>
        <td> : </td>
        <td><input name="docrt_form_kelurahan" type="text" class="docrt_inputs" id="docrt_form_kelurahan" value="'.$meta['docrt_form_kelurahan'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_kecamatan($meta) {

  $data = '<tr align="left" class="docrt_form_kecamatan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_kecamatan">Kecamatan</label></th>
        <td> : </td>
        <td><input name="docrt_form_kecamatan" type="text" class="docrt_inputs" id="docrt_form_kecamatan" value="'.$meta['docrt_form_kecamatan'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_kota($meta) {

  $data = '<tr align="left" class="docrt_form_kota_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_kota">Kota/Kabupaten</label></th>
        <td> : </td>
        <td><input name="docrt_form_kota" type="text" class="docrt_inputs" id="docrt_form_kota" value="'.$meta['docrt_form_kota'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_provinsi($meta) {

  $data = '<tr align="left" class="docrt_form_provinsi_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_provinsi">Provinsi</label></th>
        <td> : </td>
        <td><input name="docrt_form_provinsi" type="text" class="docrt_inputs" id="docrt_form_provinsi" value="'.$meta['docrt_form_provinsi'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_tlp($meta) {

  $data = '<tr align="left" class="docrt_form_tlp_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_tlp">Telepon</label></th>
        <td> : </td>
        <td><input name="docrt_form_tlp" type="text" class="docrt_inputs" id="docrt_form_tlp" value="'.$meta['docrt_form_tlp'][0].'"/></td>
    </tr>';
  return $data;
}

// Keterangan ======================================

function docrt_form_keperluan($meta) {

  $data = '<tr align="left" class="docrt_form_keperluan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_keperluan">Keperluan</label></th>
        <td> : </td>
        <td><textarea rows="2" name="docrt_form_keperluan" class="docrt_inputs" id="docrt_form_keperluan">'.$meta['docrt_form_keperluan'][0].'</textarea>
        </td>
    </tr>';
  return $data;
}

function docrt_form_tujuan($meta) {

  $data = '<tr align="left" class="docrt_form_tujuan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_tujuan">Tujuan</label></th>
        <td> : </td>
        <td><textarea rows="2" name="docrt_form_tujuan" class="docrt_inputs" id="docrt_form_tujuan">'.$meta['docrt_form_tujuan'][0].'</textarea>
        </td>
    </tr>';
  return $data;
}

function docrt_form_tgl($meta) {

  $data = '<tr align="left" class="docrt_form_tgl_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_tgl">Tanggal</label></th>
        <td> : </td>
        <td><input name="docrt_form_tgl" type="date" class="docrt_inputs half" id="docrt_form_tgl" value="'.$meta['docrt_form_tgl'][0].'"/>
        <input name="docrt_form_jam" type="text" class="docrt_inputs half" id="docrt_form_jam" value="'.$meta['docrt_form_jam'][0].'" placeholder="12:00"/></td>
    </tr>';
  return $data;
}

function docrt_form_tgl_berlaku($meta) {

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

function docrt_form_ketRT($meta) {

  $data = '<tr align="left" class="docrt_form_ketRT_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_ketRT">Sesuai Keterangan RT</label></th>
        <td> : </td>
        <td><input name="docrt_form_ketRT" type="text" class="docrt_inputs" id="docrt_form_ketRT" value="'.$meta['docrt_form_ketRT'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_tempat($meta) {

  $data = '<tr align="left" class="docrt_form_tempat_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_tempat">Tempat</label></th>
        <td> : </td>
        <td><input name="docrt_form_tempat" type="text" class="docrt_inputs" id="docrt_form_tempat" value="'.$meta['docrt_form_tempat'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_sebab_kematian($meta) {

  $data = '<tr align="left" class="docrt_form_sebab_kematian_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_sebab_kematian">Sebab</label></th>
        <td> : </td>
        <td><input name="docrt_form_sebab_kematian" type="text" class="docrt_inputs" id="docrt_form_sebab_kematian" value="'.$meta['docrt_form_sebab_kematian'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_yang_menerangkan($meta) {

  $data = '<tr align="left" class="docrt_form_yang_menerangkan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_yang_menerangkan">Yang Menerangkan</label></th>
        <td> : </td>
        <td><input name="docrt_form_yang_menerangkan" type="text" class="docrt_inputs" id="docrt_form_yang_menerangkan" value="'.$meta['docrt_form_yang_menerangkan'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_penolong_lahir($meta) {

  $data = '<tr align="left" class="docrt_form_penolong_lahir_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_penolong_lahir">Penolong Kelahiran</label></th>
        <td> : </td>
        <td><input name="docrt_form_penolong_lahir" type="text" class="docrt_inputs" id="docrt_form_penolong_lahir" value="'.$meta['docrt_form_penolong_lahir'][0].'" /></td>
    </tr>';
  return $data;
}

function docrt_form_menerangkan_bahwa($meta) {

  $data = '<tr align="left" class="docrt_form_menerangkan_bahwa_tr docrt_form">
      <th><label class="diy-label" for="docrt_form_menerangkan_bahwa">Menerangkan Bahwa</label></th>
      <td> : </td>
      <td><textarea rows="3" name="docrt_form_menerangkan_bahwa" class="docrt_inputs" id="docrt_form_menerangkan_bahwa">'.$meta['docrt_form_menerangkan_bahwa'][0].'</textarea>
      </td>
  </tr>';
  return $data;
}
   
function docrt_form_saksi($meta) {

  $docrt_saksi = docrt_get_saksi_form($meta['docrt_form_saksi'][0]);
  $data = '<tr align="left" class="docrt_form_saksi_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_saksi">Saksi</label></th>
        <td> : </td>
        <td><select name="docrt_form_saksi" class="docrt_inputs" id="docrt_form_saksi" >
            <option value="0">-</option>
            '.$docrt_saksi['RT'].'
        </select></td>
    </tr>';
  return $data;
}

// Usaha Lembaga Acara ===================================================================

function docrt_form_nama_usaha($meta) {

  $data = '<tr align="left" class="docrt_form_nama_usaha_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_nama_usaha">Nama Usaha</label></th>
        <td> : </td>
        <td><input name="docrt_form_nama_usaha" type="text" class="docrt_inputs" id="docrt_form_nama_usaha" value="'.$meta['docrt_form_nama_usaha'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_alamat_usaha($meta) {

  $data = '<tr align="left" class="docrt_form_alamat_usaha_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_alamat_usaha">Alamat Usaha</label></th>
        <td> : </td>
        <td><input name="docrt_form_alamat_usaha" type="text" class="docrt_inputs" id="docrt_form_alamat_usaha" value="'.$meta['docrt_form_alamat_usaha'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_rtrw_usaha($meta) {

  $data = '<tr align="left" class="docrt_form_rtrw_usaha_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_rtrw_usaha">RT / RW</label></th>
    <td> : </td>
    <td><input name="docrt_form_rtrw_usaha" type="text" class="docrt_inputs" id="docrt_form_rtrw_usaha" value="'.$meta['docrt_form_rtrw_usaha'][0].'"/></td>
  </tr>';
  return $data;
}
//ss
function docrt_form_ket_usaha($meta) {

  $data = '<tr align="left" class="docrt_form_ket_usaha_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_ket_usaha">Keterangan Usaha</label></th>
    <td> : </td>
    <td><input name="docrt_form_ket_usaha" type="text" class="docrt_inputs" id="docrt_form_ket_usaha" value="'.$meta['docrt_form_ket_usaha'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_nama_lembaga($meta) {

  $data = '<tr align="left" class="docrt_form_nama_lembaga_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_nama_lembaga">Nama Lembaga / Organisasi</label></th>
    <td> : </td>
    <td><input name="docrt_form_nama_lembaga" type="text" class="docrt_inputs" id="docrt_form_nama_lembaga" value="'.$meta['docrt_form_nama_lembaga'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_nama_noinduk_lembaga($meta) {

  $data = '<tr align="left" class="docrt_form_nama_noinduk_lembaga_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_nama_noinduk_lembaga">Nama "No Induk" Lembaga</label></th>
    <td> : </td>
    <td><input name="docrt_form_nama_noinduk_lembaga" type="text" class="docrt_inputs" id="docrt_form_nama_noinduk_lembaga" value="'.$meta['docrt_form_nama_noinduk_lembaga'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_noinduk_lembaga($meta) {

  $data = '<tr align="left" class="docrt_form_noinduk_lembaga_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_noinduk_lembaga">No Induk Lembaga</label></th>
    <td> : </td>
    <td><input name="docrt_form_noinduk_lembaga" type="text" class="docrt_inputs" id="docrt_form_noinduk_lembaga" value="'.$meta['docrt_form_noinduk_lembaga'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_nama_acara($meta) {

  $data = '<tr align="left" class="docrt_form_nama_acara_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_nama_acara">Nama Acara</label></th>
    <td> : </td>
    <td><input name="docrt_form_nama_acara" type="text" class="docrt_inputs" id="docrt_form_nama_acara" value="'.$meta['docrt_form_nama_acara'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_tgl_acara($meta) {

  $data = '<tr align="left" class="docrt_form_tgl_acara_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_tgl_acara">Tanggal Acara</label></th>
    <td> : </td>
    <td><input name="docrt_form_tgl_acara" type="date" class="docrt_inputs" id="docrt_form_tgl_acara" value="'.$meta['docrt_form_tgl_acara'][0].'"/></td>
    </tr>';
  return $data;
}

//Pindah=================================================================================
function docrt_form_desa_pindah($meta) {

  $data = '<tr align="left" class="docrt_form_desa_pindah_tr docrt_form">
      <th><label class="diy-label" for="docrt_form_desa_pindah">Desa</label></th>
      <td> : </td>
      <td><input name="docrt_form_desa_pindah" type="text" class="docrt_inputs" id="docrt_form_desa_pindah" value="'.$meta['docrt_form_desa_pindah'][0].'"/></td>
  </tr>';
  return $data;
}
function docrt_form_kecamatan_pindah($meta) {

  $data = '<tr align="left" class="docrt_form_kecamatan_pindah_tr docrt_form">
      <th><label class="diy-label" for="docrt_form_kecamatan_pindah">Kecamatan</label></th>
      <td> : </td>
      <td><input name="docrt_form_kecamatan_pindah" type="text" class="docrt_inputs" id="docrt_form_kecamatan_pindah" value="'.$meta['docrt_form_kecamatan_pindah'][0].'"/></td>
  </tr>';
  return $data;
}
function docrt_form_kabkota_pindah($meta) {

  $data = '<tr align="left" class="docrt_form_kabkota_pindah_tr docrt_form">
      <th><label class="diy-label" for="docrt_form_kabkota_pindah">Kab/Kota</label></th>
      <td> : </td>
      <td><input name="docrt_form_kabkota_pindah" type="text" class="docrt_inputs" id="docrt_form_kabkota_pindah" value="'.$meta['docrt_form_kabkota_pindah'][0].'"/></td>
  </tr>';
  return $data;
}
function docrt_form_provinsi_pindah($meta) {

  $data = '<tr align="left" class="docrt_form_provinsi_pindah_tr docrt_form">
      <th><label class="diy-label" for="docrt_form_provinsi_pindah">Provinsi</label></th>
      <td> : </td>
      <td><input name="docrt_form_provinsi_pindah" type="text" class="docrt_inputs" id="docrt_form_provinsi_pindah" value="'.$meta['docrt_form_provinsi_pindah'][0].'"/></td>
  </tr>';
  return $data;
}
function docrt_form_tgl_pindah($meta) {

  $data = '<tr align="left" class="docrt_form_tgl_pindah_tr docrt_form">
      <th><label class="diy-label" for="docrt_form_tgl_pindah">Tanggal Pindah</label></th>
      <td> : </td>
      <td><input name="docrt_form_tgl_pindah" type="date" class="docrt_inputs" id="docrt_form_tgl_pindah" value="'.$meta['docrt_form_tgl_pindah'][0].'"/></td>
  </tr>';
  return $data;
}
function docrt_form_alasan_pindah($meta) {

  $data = '<tr align="left" class="docrt_form_alasan_pindah_tr docrt_form">
      <th><label class="diy-label" for="docrt_form_alasan_pindah">Alasan Pindah</label></th>
      <td> : </td>
      <td><textarea rows="2" name="docrt_form_alasan_pindah" class="docrt_inputs" id="docrt_form_alasan_pindah">'.$meta['docrt_form_alasan_pindah'][0].'</textarea>
  </tr>';
  return $data;
}
function docrt_form_pengikut($meta) {

  $data = '<tr align="left" class="docrt_form_pengikut_tr docrt_form">
      <th><label class="diy-label" for="docrt_form_pengikut">Jml Pengikut</label></th>
      <td> : </td>
      <td><input name="docrt_form_pengikut" type="number" class="docrt_inputs" id="docrt_form_pengikut" value="'.$meta['docrt_form_pengikut'][0].'" max="20" min="0"/></td>
  </tr>';
  return $data;
}

// Alter kelahiran ==============================================================================================
function docrt_form_nama_bayi($meta) {

  $data = '<tr align="left" class="docrt_form_nama_bayi_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_nama_bayi">Nama Bayi</label></th>
    <td> : </td>
    <td><input name="docrt_form_nama_bayi" type="text" class="docrt_inputs" id="docrt_form_nama_bayi" value="'.$meta['docrt_form_nama_bayi'][0].'" /></td>
  </tr>';
  return $data;
}

function docrt_form_dilahirkan1($meta) {

  $data = '<tr align="left" class="docrt_form_dilahirkan1_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_dilahirkan1">Tanggal Dilahirkan</label></th>
    <td> : </td>
    <td><input name="docrt_form_dilahirkan1" type="date" class="docrt_inputs" id="docrt_form_dilahirkan1" value="'.$meta['docrt_form_dilahirkan1'][0].'" /></td>
  </tr>';
  return $data;
}

function docrt_form_nonik_bayi($meta) {

  $data = '<tr align="left" class="docrt_form_nonik_bayi_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_nonik_bayi">No NIK</label></th>
    <td> : </td>
    <td><input name="docrt_form_nonik_bayi" type="text" class="docrt_inputs" id="docrt_form_nonik_bayi" value="'.$meta['docrt_form_nonik_bayi'][0].'" /></td>
  </tr>';
  return $data;
}

function docrt_form_anakke($meta) {

  $data = '<tr align="left" class="docrt_form_anakke_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_anakke">Anak Ke</label></th>
    <td> : </td>
    <td><input name="docrt_form_anakke" type="number" class="docrt_inputs" id="docrt_form_anakke" value="'.$meta['docrt_form_anakke'][0].'" /></td>
  </tr>';
  return $data;
}

function docrt_form_kelahiran($meta) {

  $data = '<tr align="left" class="docrt_form_kelahiran_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_kelahiran">Kelahiran</label></th>
    <td> : </td>
    <td><select name="docrt_form_kelahiran" class="docrt_inputs" id="docrt_form_kelahiran" >
          <option value="Tunggal" >Tunggal</option>
          <option value="Kembar" '.(($meta['docrt_form_kelahiran'][0] == 'Kembar') ? 'selected' : '').'>Kembar</option>
        </select>
    </td>
  </tr>';
  return $data;
}

function docrt_form_kembarke($meta) {

  $data = '<tr align="left" class="docrt_form_kembarke_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_kembarke">Kembar Ke</label></th>
    <td> : </td>
    <td><input name="docrt_form_kembarke" type="number" class="docrt_inputs" id="docrt_form_kembarke" value="'.$meta['docrt_form_kembarke'][0].'" /></td>
  </tr>';
  return $data;
}

function docrt_form_jk_bayi($meta) {

  $data = '<tr align="left" class="docrt_form_jk_bayi_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_jk_bayi">Jenis Kelamin</label></th>
    <td> : </td>
    <td><select name="docrt_form_jk_bayi" class="docrt_inputs" id="docrt_form_jk_bayi" >
          <option value="Laki-Laki" >Laki - Laki</option>
          <option value="Perempuan" '.(($meta['docrt_form_jk_bayi'][0] == 'Perempuan') ? 'selected' : '').'>Perempuan</option>
        </select>
    </td>
  </tr>';
  return $data;
}

function docrt_form_kota_bayi($meta) {

  $data = '<tr align="left" class="docrt_form_kota_bayi_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_kota_bayi">Kota/Kabupaten Kelahiran</label></th>
    <td> : </td>
    <td><input name="docrt_form_kota_bayi" type="text" class="docrt_inputs" id="docrt_form_kota_bayi" value="'.$meta['docrt_form_kota_bayi'][0].'"/></td>
  </tr>';
  return $data;
}


// Alter Kelahiran ayah ibu ==========================================================================================
function docrt_form_nama_ibu($meta) {

  $data = '<tr align="left" class="docrt_form_nama_ibu_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_nama_ibu">Nama Ibu</label></th>
    <td> : </td>
    <td><input name="docrt_form_nama_ibu" type="text" class="docrt_inputs" id="docrt_form_nama_ibu" value="'.$meta['docrt_form_nama_ibu'][0].'" /></td>
  </tr>';
  return $data;
}

function docrt_form_dilahirkan2($meta) {

  $data = '<tr align="left" class="docrt_form_dilahirkan2_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_dilahirkan2"> - Tanggal Dilahirkan</label></th>
    <td> : </td>
    <td><input name="docrt_form_dilahirkan2" type="date" class="docrt_inputs" id="docrt_form_dilahirkan2" value="'.$meta['docrt_form_dilahirkan2'][0].'" /></td>
  </tr>';
  return $data;
}

function docrt_form_kebangsaan_ibu($meta) {

  $data = '<tr align="left" class="docrt_form_kebangsaan_ibu_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_kebangsaan_ibu"> - Kewarganegaraan</label></th>
    <td> : </td>
    <td><input name="docrt_form_kebangsaan_ibu" type="text" class="docrt_inputs" id="docrt_form_kebangsaan_ibu" value="'.$meta['docrt_form_kebangsaan_ibu'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_alamat_ibu($meta) {

  $data = '<tr align="left" class="docrt_form_alamat_ibu_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_alamat_ibu"> - Alamat</label></th>
    <td> : </td>
    <td><input name="docrt_form_alamat_ibu" type="text" class="docrt_inputs" id="docrt_form_alamat_ibu" value="'.$meta['docrt_form_alamat_ibu'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_nonik_ibu($meta) {

  $data = '<tr align="left" class="docrt_form_nonik_ibu_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_nonik_ibu"> - No NIK</label></th>
    <td> : </td>
    <td><input name="docrt_form_nonik_ibu" type="text" class="docrt_inputs" id="docrt_form_nonik_ibu" value="'.$meta['docrt_form_nonik_ibu'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_pekerjaan_ibu($meta) {

  $data = '<tr align="left" class="docrt_form_pekerjaan_ibu_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_pekerjaan_ibu"> - Pekarjaan</label></th>
    <td> : </td>
    <td><input name="docrt_form_pekerjaan_ibu" type="text" class="docrt_inputs" id="docrt_form_pekerjaan_ibu" value="'.$meta['docrt_form_pekerjaan_ibu'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_tlp_ibu($meta) {

  $data = '<tr align="left" class="docrt_form_tlp_ibu_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_tlp_ibu"> - Telepon</label></th>
    <td> : </td>
    <td><input name="docrt_form_tlp_ibu" type="text" class="docrt_inputs" id="docrt_form_tlp_ibu" value="'.$meta['docrt_form_tlp_ibu'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_nama_ayah($meta) {

  $data = '<tr align="left" class="docrt_form_nama_ayah_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_nama_ayah">Nama Ayah</label></th>
    <td> : </td>
    <td><input name="docrt_form_nama_ayah" type="text" class="docrt_inputs" id="docrt_form_nama_ayah" value="'.$meta['docrt_form_nama_ayah'][0].'" /></td>
  </tr>';
  return $data;
}

function docrt_form_dilahirkan3($meta) {

  $data = '<tr align="left" class="docrt_form_dilahirkan3_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_dilahirkan3"> - Tanggal Dilahirkan</label></th>
    <td> : </td>
    <td><input name="docrt_form_dilahirkan3" type="date" class="docrt_inputs" id="docrt_form_dilahirkan3" value="'.$meta['docrt_form_dilahirkan3'][0].'" /></td>
  </tr>';
  return $data;
}

function docrt_form_kebangsaan_ayah($meta) {

  $data = '<tr align="left" class="docrt_form_kebangsaan_ayah_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_kebangsaan_ayah"> - Kewarganegaraan</label></th>
    <td> : </td>
    <td><input name="docrt_form_kebangsaan_ayah" type="text" class="docrt_inputs" id="docrt_form_kebangsaan_ayah" value="'.$meta['docrt_form_kebangsaan_ayah'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_alamat_ayah($meta) {

  $data = '<tr align="left" class="docrt_form_alamat_ayah_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_alamat_ayah"> - Alamat</label></th>
    <td> : </td>
    <td><input name="docrt_form_alamat_ayah" type="text" class="docrt_inputs" id="docrt_form_alamat_ayah" value="'.$meta['docrt_form_alamat_ayah'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_nokk_ayah($meta) {

  $data = '<tr align="left" class="docrt_form_nokk_ayah_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_nokk_ayah"> - No KK</label></th>
    <td> : </td>
    <td><input name="docrt_form_nokk_ayah" type="text" class="docrt_inputs" id="docrt_form_nokk_ayah" value="'.$meta['docrt_form_nokk_ayah'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_nonik_ayah($meta) {

  $data = '<tr align="left" class="docrt_form_nonik_ayah_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_nonik_ayah"> - No NIK</label></th>
    <td> : </td>
    <td><input name="docrt_form_nonik_ayah" type="text" class="docrt_inputs" id="docrt_form_nonik_ayah" value="'.$meta['docrt_form_nonik_ayah'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_pekerjaan_ayah($meta) {

  $data = '<tr align="left" class="docrt_form_pekerjaan_ayah_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_pekerjaan_ayah"> - Pekarjaan</label></th>
    <td> : </td>
    <td><input name="docrt_form_pekerjaan_ayah" type="text" class="docrt_inputs" id="docrt_form_pekerjaan_ayah" value="'.$meta['docrt_form_pekerjaan_ayah'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_tlp_ayah($meta) {

  $data = '<tr align="left" class="docrt_form_tlp_ayah_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_tlp_ayah"> - Telepon</label></th>
    <td> : </td>
    <td><input name="docrt_form_tlp_ayah" type="text" class="docrt_inputs" id="docrt_form_tlp_ayah" value="'.$meta['docrt_form_tlp_ayah'][0].'"/></td>
  </tr>';
  return $data;
}

// Pindah ===========================================================================
function docrt_form_desa_pindah($meta) {

  $data = '<tr align="left" class="docrt_form_desa_pindah_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_desa_pindah">Desa</label></th>
    <td> : </td>
    <td><input name="docrt_form_desa_pindah" type="text" class="docrt_inputs" id="docrt_form_desa_pindah" value="'.$meta['docrt_form_desa_pindah'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_kecamatan_pindah($meta) {

  $data = '<tr align="left" class="docrt_form_kecamatan_pindah_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_kecamatan_pindah">Kecamatan</label></th>
    <td> : </td>
    <td><input name="docrt_form_kecamatan_pindah" type="text" class="docrt_inputs" id="docrt_form_kecamatan_pindah" value="'.$meta['docrt_form_kecamatan_pindah'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_kabkota_pindah($meta) {

  $data = '<tr align="left" class="docrt_form_kabkota_pindah_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_kabkota_pindah">Kab/Kota</label></th>
    <td> : </td>
    <td><input name="docrt_form_kabkota_pindah" type="text" class="docrt_inputs" id="docrt_form_kabkota_pindah" value="'.$meta['docrt_form_kabkota_pindah'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_provinsi_pindah($meta) {

  $data = '<tr align="left" class="docrt_form_provinsi_pindah_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_provinsi_pindah">Provinsi</label></th>
    <td> : </td>
    <td><input name="docrt_form_provinsi_pindah" type="text" class="docrt_inputs" id="docrt_form_provinsi_pindah" value="'.$meta['docrt_form_provinsi_pindah'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_tgl_pindah($meta) {

  $data = '<tr align="left" class="docrt_form_tgl_pindah_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_tgl_pindah">Tanggal Pindah</label></th>
    <td> : </td>
    <td><input name="docrt_form_tgl_pindah" type="date" class="docrt_inputs" id="docrt_form_tgl_pindah" value="'.$meta['docrt_form_tgl_pindah'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_alasan_pindah($meta) {

  $data = '<tr align="left" class="docrt_form_alasan_pindah_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_alasan_pindah">Alasan Pindah</label></th>
    <td> : </td>
    <td><textarea rows="2" name="docrt_form_alasan_pindah" class="docrt_inputs" id="docrt_form_alasan_pindah">'.$meta['docrt_form_alasan_pindah'][0].'</textarea></td>
  </tr>';
  return $data;
}

function docrt_form_pengikut($meta) {

  $data = '<tr align="left" class="docrt_form_pengikut_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_pengikut">Jml Pengikut</label></th>
    <td> : </td>
    <td><input name="docrt_form_pengikut" type="number" class="docrt_inputs" id="docrt_form_pengikut" value="'.$meta['docrt_form_pengikut'][0].'" max="20" min="0"/></td>
  </tr>';
  return $data;
}













//  not the form ================================================================================================
function docrt_get_saksi_form($meta_value1 = '',$meta_value2 = '') {
    $query_args = array(
        'post_type'      => 'docrt-perangkat',
        'post_status'    => 'publish',
        'orderby'        => 'date',
    );
    $posts = new WP_Query( $query_args );
    $data['RT'] = '';
    $data['RW'] = '';
    foreach ($posts->posts as $key => $post) {
        $meta = get_post_meta($post->ID, 'docrt_perangkat', true);
        $param[ $meta['jabatan'] ][] = array(
            'id' => $post->ID,
            'jabatan' => $meta['jabatan'].' '.$meta['no_jabatan'],
            'no_jabatan_rw' => $meta['no_jabatan_rw']
        );
    }

    foreach ($param as $key => $value) {
        foreach ($value as $k => $v) {
            if ($v['id'] == $meta_value1) {
                $selected = 'selected';
            } elseif ($v['id'] == $meta_value2) {
                $selected = 'selected';
            } else {
                 $selected = '';
            }

            if ($key == 'RT') {
                $data[$key] .= '<option value="'.$v['id'].'" '.$selected.'>'.$v['jabatan'].' / '.$v['no_jabatan_rw'].'</option>';
            } else {
                $data[$key] .= '<option value="'.$v['id'].'" '.$selected.'>'.$v['jabatan'].'</option>';
            }

        }
    }

    return $data;
}









