<?php require_once('../../../../wp-load.php');
//print_r($_POST);
$form = $_POST['data']['surat'];
$post_id = $_POST['post_id'];
$type_surat = $_POST['type_surat'];
//$post_term = get_the_terms ($post_id,'surat' );
$meta = get_post_meta($post_id);

$return_tr = '';
$return_table = '';
if ($form) {
  foreach ($form as $key => $value) {
    if (strpos($value, '###') === false) {

      if (function_exists($value)) {
        $return_tr .= call_user_func_array($value, array($meta, $type_surat));
      } else {
        $return_tr .= '<tr><td colspan="3">Form <b>'.$value.'</b> Hilang</td></tr>';
      }

    } else {

      $value_table = explode('###', $value);
      if (function_exists($value_table[1])) {
        if ($value_table[0] == 'table') {
          $return_table .= call_user_func_array($value_table[1], array($meta, $type_surat));
        } else {
          $return_tr .= call_user_func_array($value_table[1], array($value_table[2]));
        }
      }
    }
  }
}

echo '<input type="hidden" id="docrt_tysrt_form" name="docrt_type_surat" value="'.$type_surat.'" />' ;
echo '<table class="docrt_tbl docrt_pemohon_box">';
  echo docrt_doc_title_nosurat($meta, $type_surat);
  echo '<tbody>';
      echo $return_tr;
  echo '</tbody>';
echo '</table>';
echo $return_table;

/*=================================================
  Form Function
=================================================*/

//data diri ======================================
function docrt_form_nama($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_nama_tr docrt_form">
      <th><label class="diy-label" for="docrt_form_nama">Nama</label></th>
      <td> : </td>
      <td><input name="docrt_form_nama" type="text" class="docrt_inputs" id="docrt_form_nama" value="'.$meta['docrt_form_nama'][0].'" /></td>
  </tr>';
  return $data;
}

function docrt_form_hubungan($meta, $type_surat) {
  $label_alter = '<label class="diy-label docrt_form_nama_mati_tr docrt_form" for="docrt_form_hubungan">Hubungan Dng Yg Mati</label>';
  if ($type_surat == 'skel') $label_alter = '<label class="diy-label docrt_form_nama_bayi_tr docrt_form" for="docrt_form_hubungan">Hubungan</label>';

  $data = '<tr align="left" class="docrt_form_hubungan_tr docrt_form">
        <th>'.$label_alter.'</th>
        <td> : </td>
        <td><input name="docrt_form_hubungan" type="text" class="docrt_inputs" id="docrt_form_hubungan" value="'.$meta['docrt_form_hubungan'][0].'" /></td>
    </tr>';
  return $data;
}

function docrt_form_dilahirkan_pelapor($meta, $type_surat) {

  $data = ' <tr align="left" class="docrt_form_dilahirkan_pelapor_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_dilahirkan_pelapor"> - Tanggal Dilahirkan</label></th>
        <td> : </td>
        <td><input name="docrt_form_dilahirkan_pelapor" type="text" class="docrt_inputs docrt_datepicker" id="docrt_form_dilahirkan_pelapor" value="'.$meta['docrt_form_dilahirkan_pelapor'][0].'" /></td>
    </tr>';
  return $data;
}

function docrt_form_alamat_pelapor($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_alamat_pelapor_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_alamat_pelapor"> - Alamat</label></th>
        <td> : </td>
        <td><input name="docrt_form_alamat_pelapor" type="text" class="docrt_inputs" id="docrt_form_alamat_pelapor" value="'.$meta['docrt_form_alamat_pelapor'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_nonik_pelapor($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_nonik_pelapor_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_nonik_pelapor"> - No NIK</label></th>
        <td> : </td>
        <td><input name="docrt_form_nonik_pelapor" type="text" class="docrt_inputs" id="docrt_form_nonik_pelapor" value="'.$meta['docrt_form_nonik_pelapor'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_pekerjaan_pelapor($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_pekerjaan_pelapor_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_pekerjaan_pelapor"> - Pekarjaan</label></th>
        <td> : </td>
        <td><input name="docrt_form_pekerjaan_pelapor" type="text" class="docrt_inputs" id="docrt_form_pekerjaan_pelapor" value="'.$meta['docrt_form_pekerjaan_pelapor'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_ttl($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_ttl_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_ttl">Tempat Tanggal Lahir</label></th>
        <td> : </td>
        <td><input name="docrt_form_ttl" type="text" class="docrt_inputs" id="docrt_form_ttl" value="'.$meta['docrt_form_ttl'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_umur($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_umur_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_umur">Umur</label></th>
        <td> : </td>
        <td><input name="docrt_form_umur" type="text" class="docrt_inputs" id="docrt_form_umur" value="'.$meta['docrt_form_umur'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_jk($meta, $type_surat) {

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

function docrt_form_kebangsaan($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_kebangsaan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_kebangsaan">Kebangsaan</label></th>
        <td> : </td>
        <td><input name="docrt_form_kebangsaan" type="text" class="docrt_inputs" id="docrt_form_kebangsaan" value="'.$meta['docrt_form_kebangsaan'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_agama($meta, $type_surat) {

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

function docrt_form_sperkawinan($meta, $type_surat) {
  $data = '<tr align="left" class="docrt_form_sperkawinan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_sperkawinan">Status Perkawinan</label></th>
        <td> : </td>
        <td><select name="docrt_form_sperkawinan" class="docrt_inputs" id="docrt_form_sperkawinan" >
              <option value="Belum Kawin" >Belum Kawin</option>
              <option value="Kawin" '.(($meta['docrt_form_sperkawinan'][0] == 'Kawin') ? 'selected' : '').'>Kawin</option>
              <option value="Cerai Hidup" '.(($meta['docrt_form_sperkawinan'][0] == 'Cerai Hidup') ? 'selected' : '').'>Cerai Hidup</option>
              <option value="Cerai Mati" '.(($meta['docrt_form_sperkawinan'][0] == 'Cerai Mati') ? 'selected' : '').'>Cerai Mati</option>
            </select>
        </td>
    </tr>';
  return $data;
}

function docrt_form_nokk($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_nokk_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_nokk">No KK</label></th>
        <td> : </td>
        <td><input name="docrt_form_nokk" type="text" class="docrt_inputs" id="docrt_form_nokk" value="'.$meta['docrt_form_nokk'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_nonik($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_nonik_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_nonik">No NIK</label></th>
        <td> : </td>
        <td>
        <span class="api_msg api_msg_nik"> - Mohon isi form No NIK - </span>
        <input name="docrt_form_nonik" type="text" class="docrt_inputs" id="docrt_form_nonik" value="'.$meta['docrt_form_nonik'][0].'"/>
        <button class="nik_api_button">Auto</button>
        </td>
    </tr>';
  return $data;
}

function docrt_form_pekerjaan($meta, $type_surat) {

  $data = ' <tr align="left" class="docrt_form_pekerjaan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_pekerjaan">Pekerjaan</label></th>
        <td> : </td>
        <td><input name="docrt_form_pekerjaan" type="text" class="docrt_inputs" id="docrt_form_pekerjaan" value="'.$meta['docrt_form_pekerjaan'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_pendidikan($meta, $type_surat) {

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

function docrt_form_goldarah($meta, $type_surat) {

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

function docrt_form_nama_mati($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_nama_mati_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_nama_mati">Namas</label></th>
        <td> : </td>
        <td><input name="docrt_form_nama_mati" type="text" class="docrt_inputs" id="docrt_form_nama_mati" value="'.$meta['docrt_form_nama_mati'][0].'" /></td>
    </tr>';
  return $data;
}


// Alamat ======================================

function docrt_form_alamat($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_alamat_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_alamat">Alamat</label></th>
        <td> : </td>
        <td><textarea rows="3" name="docrt_form_alamat" class="docrt_inputs" id="docrt_form_alamat">'.$meta['docrt_form_alamat'][0].'</textarea>
        </td>
    </tr>';
  return $data;
}

function docrt_form_rtrw($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_rtrw_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_rtrw">RT / RW</label></th>
        <td> : </td>
        <td><input name="docrt_form_rtrw" type="text" class="docrt_inputs" id="docrt_form_rtrw" value="'.$meta['docrt_form_rtrw'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_kelurahan($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_kelurahan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_kelurahan">Kelurahan</label></th>
        <td> : </td>
        <td><input name="docrt_form_kelurahan" type="text" class="docrt_inputs" id="docrt_form_kelurahan" value="'.$meta['docrt_form_kelurahan'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_kecamatan($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_kecamatan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_kecamatan">Kecamatan</label></th>
        <td> : </td>
        <td><input name="docrt_form_kecamatan" type="text" class="docrt_inputs" id="docrt_form_kecamatan" value="'.$meta['docrt_form_kecamatan'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_kota($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_kota_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_kota">Kota/Kabupaten</label></th>
        <td> : </td>
        <td><input name="docrt_form_kota" type="text" class="docrt_inputs" id="docrt_form_kota" value="'.$meta['docrt_form_kota'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_provinsi($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_provinsi_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_provinsi">Provinsi</label></th>
        <td> : </td>
        <td><input name="docrt_form_provinsi" type="text" class="docrt_inputs" id="docrt_form_provinsi" value="'.$meta['docrt_form_provinsi'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_tlp($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_tlp_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_tlp">Telepon</label></th>
        <td> : </td>
        <td><input name="docrt_form_tlp" type="text" class="docrt_inputs" id="docrt_form_tlp" value="'.$meta['docrt_form_tlp'][0].'"/></td>
    </tr>';
  return $data;
}

// Keterangan ======================================

function docrt_form_keperluan($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_keperluan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_keperluan">Keperluan</label></th>
        <td> : </td>
        <td><textarea rows="2" name="docrt_form_keperluan" class="docrt_inputs" id="docrt_form_keperluan">'.$meta['docrt_form_keperluan'][0].'</textarea>
        </td>
    </tr>';
  return $data;
}

function docrt_form_tujuan($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_tujuan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_tujuan">Tujuan</label></th>
        <td> : </td>
        <td><textarea rows="2" name="docrt_form_tujuan" class="docrt_inputs" id="docrt_form_tujuan">'.$meta['docrt_form_tujuan'][0].'</textarea>
        </td>
    </tr>';
  return $data;
}

function docrt_form_tgl_jam($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_tgl_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_tgl">Tanggal</label></th>
        <td> : </td>
        <td><input name="docrt_form_tgl" type="text" class="docrt_inputs half docrt_datepicker" id="docrt_form_tgl" value="'.$meta['docrt_form_tgl'][0].'"/>
        <input name="docrt_form_jam" type="text" class="docrt_inputs half" id="docrt_form_jam" value="'.$meta['docrt_form_jam'][0].'" placeholder="12:00"/></td>
    </tr>';
  return $data;
}

function docrt_form_tgl($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_tgl_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_tgl">Tanggal</label></th>
        <td> : </td>
        <td><input name="docrt_form_tgl" type="text" class="docrt_inputs half docrt_datepicker" id="docrt_form_tgl" value="'.$meta['docrt_form_tgl'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_tgl_berlaku($meta, $type_surat) {

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

function docrt_form_ketRT($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_ketRT_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_ketRT">Sesuai Keterangan RT</label></th>
        <td> : </td>
        <td><input name="docrt_form_ketRT" type="text" class="docrt_inputs" id="docrt_form_ketRT" value="'.$meta['docrt_form_ketRT'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_tempat($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_tempat_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_tempat">Tempat</label></th>
        <td> : </td>
        <td><input name="docrt_form_tempat" type="text" class="docrt_inputs" id="docrt_form_tempat" value="'.$meta['docrt_form_tempat'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_sebab_kematian($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_sebab_kematian_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_sebab_kematian">Sebab</label></th>
        <td> : </td>
        <td><input name="docrt_form_sebab_kematian" type="text" class="docrt_inputs" id="docrt_form_sebab_kematian" value="'.$meta['docrt_form_sebab_kematian'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_yang_menerangkan($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_yang_menerangkan_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_yang_menerangkan">Yang Menerangkan</label></th>
        <td> : </td>
        <td><input name="docrt_form_yang_menerangkan" type="text" class="docrt_inputs" id="docrt_form_yang_menerangkan" value="'.$meta['docrt_form_yang_menerangkan'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_penolong_lahir($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_penolong_lahir_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_penolong_lahir">Penolong Kelahiran</label></th>
        <td> : </td>
        <td><input name="docrt_form_penolong_lahir" type="text" class="docrt_inputs" id="docrt_form_penolong_lahir" value="'.$meta['docrt_form_penolong_lahir'][0].'" /></td>
    </tr>';
  return $data;
}

function docrt_form_menerangkan_bahwa($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_menerangkan_bahwa_tr docrt_form">
      <th><label class="diy-label" for="docrt_form_menerangkan_bahwa">Menerangkan Bahwa</label></th>
      <td> : </td>
      <td><textarea rows="3" name="docrt_form_menerangkan_bahwa" class="docrt_inputs" id="docrt_form_menerangkan_bahwa">'.$meta['docrt_form_menerangkan_bahwa'][0].'</textarea>
      </td>
  </tr>';
  return $data;
}

function docrt_form_saksi($meta, $type_surat) {

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

function docrt_form_nama_usaha($meta, $type_surat) {
  $label_alter = 'Nama Usaha';
  if ($type_surat == 'skd') $label_alter = 'Nama Lembaga';

  $data = '<tr align="left" class="docrt_form_nama_usaha_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_nama_usaha">'.$label_alter.'</label></th>
        <td> : </td>
        <td><input name="docrt_form_nama_usaha" type="text" class="docrt_inputs" id="docrt_form_nama_usaha" value="'.$meta['docrt_form_nama_usaha'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_alamat_usaha($meta, $type_surat) {
  $label_alter = 'Alamat Usaha';
  if ($type_surat == 'skd') $label_alter = 'Alamat Lembaga';

  $data = '<tr align="left" class="docrt_form_alamat_usaha_tr docrt_form">
        <th><label class="diy-label" for="docrt_form_alamat_usaha">'.$label_alter.'</label></th>
        <td> : </td>
        <td><input name="docrt_form_alamat_usaha" type="text" class="docrt_inputs" id="docrt_form_alamat_usaha" value="'.$meta['docrt_form_alamat_usaha'][0].'"/></td>
    </tr>';
  return $data;
}

function docrt_form_rtrw_usaha($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_rtrw_usaha_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_rtrw_usaha">RT / RW</label></th>
    <td> : </td>
    <td><input name="docrt_form_rtrw_usaha" type="text" class="docrt_inputs" id="docrt_form_rtrw_usaha" value="'.$meta['docrt_form_rtrw_usaha'][0].'"/></td>
  </tr>';
  return $data;
}
//ss
function docrt_form_ket_usaha($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_ket_usaha_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_ket_usaha">Keterangan Usaha</label></th>
    <td> : </td>
    <td><input name="docrt_form_ket_usaha" type="text" class="docrt_inputs" id="docrt_form_ket_usaha" value="'.$meta['docrt_form_ket_usaha'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_nama_lembaga($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_nama_lembaga_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_nama_lembaga">Nama Lembaga / Organisasi</label></th>
    <td> : </td>
    <td><input name="docrt_form_nama_lembaga" type="text" class="docrt_inputs" id="docrt_form_nama_lembaga" value="'.$meta['docrt_form_nama_lembaga'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_nama_noinduk_lembaga($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_nama_noinduk_lembaga_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_nama_noinduk_lembaga">Nama "No Induk" Lembaga</label></th>
    <td> : </td>
    <td><input name="docrt_form_nama_noinduk_lembaga" type="text" class="docrt_inputs" id="docrt_form_nama_noinduk_lembaga" value="'.$meta['docrt_form_nama_noinduk_lembaga'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_noinduk_lembaga($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_noinduk_lembaga_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_noinduk_lembaga">No Induk Lembaga</label></th>
    <td> : </td>
    <td><input name="docrt_form_noinduk_lembaga" type="text" class="docrt_inputs" id="docrt_form_noinduk_lembaga" value="'.$meta['docrt_form_noinduk_lembaga'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_nama_acara($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_nama_acara_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_nama_acara">Nama Acara</label></th>
    <td> : </td>
    <td><input name="docrt_form_nama_acara" type="text" class="docrt_inputs" id="docrt_form_nama_acara" value="'.$meta['docrt_form_nama_acara'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_tgl_acara($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_tgl_acara_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_tgl_acara">Tanggal Acara</label></th>
    <td> : </td>
    <td><input name="docrt_form_tgl_acara" type="text" class="docrt_inputs docrt_datepicker" id="docrt_form_tgl_acara" value="'.$meta['docrt_form_tgl_acara'][0].'"/></td>
    </tr>';
  return $data;
}

//Pindah=================================================================================
function docrt_form_desa_pindah($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_desa_pindah_tr docrt_form">
      <th><label class="diy-label" for="docrt_form_desa_pindah">Desa</label></th>
      <td> : </td>
      <td><input name="docrt_form_desa_pindah" type="text" class="docrt_inputs" id="docrt_form_desa_pindah" value="'.$meta['docrt_form_desa_pindah'][0].'"/></td>
  </tr>';
  return $data;
}
function docrt_form_kecamatan_pindah($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_kecamatan_pindah_tr docrt_form">
      <th><label class="diy-label" for="docrt_form_kecamatan_pindah">Kecamatan</label></th>
      <td> : </td>
      <td><input name="docrt_form_kecamatan_pindah" type="text" class="docrt_inputs" id="docrt_form_kecamatan_pindah" value="'.$meta['docrt_form_kecamatan_pindah'][0].'"/></td>
  </tr>';
  return $data;
}
function docrt_form_kabkota_pindah($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_kabkota_pindah_tr docrt_form">
      <th><label class="diy-label" for="docrt_form_kabkota_pindah">Kab/Kota</label></th>
      <td> : </td>
      <td><input name="docrt_form_kabkota_pindah" type="text" class="docrt_inputs" id="docrt_form_kabkota_pindah" value="'.$meta['docrt_form_kabkota_pindah'][0].'"/></td>
  </tr>';
  return $data;
}
function docrt_form_provinsi_pindah($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_provinsi_pindah_tr docrt_form">
      <th><label class="diy-label" for="docrt_form_provinsi_pindah">Provinsi</label></th>
      <td> : </td>
      <td><input name="docrt_form_provinsi_pindah" type="text" class="docrt_inputs" id="docrt_form_provinsi_pindah" value="'.$meta['docrt_form_provinsi_pindah'][0].'"/></td>
  </tr>';
  return $data;
}
function docrt_form_tgl_pindah($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_tgl_pindah_tr docrt_form">
      <th><label class="diy-label" for="docrt_form_tgl_pindah">Tanggal Pindah</label></th>
      <td> : </td>
      <td><input name="docrt_form_tgl_pindah" type="text" class="docrt_inputs docrt_datepicker" id="docrt_form_tgl_pindah" value="'.$meta['docrt_form_tgl_pindah'][0].'"/></td>
  </tr>';
  return $data;
}
function docrt_form_alasan_pindah($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_alasan_pindah_tr docrt_form">
      <th><label class="diy-label" for="docrt_form_alasan_pindah">Alasan Pindah</label></th>
      <td> : </td>
      <td><textarea rows="2" name="docrt_form_alasan_pindah" class="docrt_inputs" id="docrt_form_alasan_pindah">'.$meta['docrt_form_alasan_pindah'][0].'</textarea>
  </tr>';
  return $data;
}
function docrt_form_pengikut($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_pengikut_tr docrt_form">
      <th><label class="diy-label" for="docrt_form_pengikut">Jml Pengikut</label></th>
      <td> : </td>
      <td><input name="docrt_form_pengikut" type="number" class="docrt_inputs" id="docrt_form_pengikut" value="'.$meta['docrt_form_pengikut'][0].'" max="20" min="0"/></td>
  </tr>';
  return $data;
}

// Alter kelahiran ==============================================================================================
function docrt_form_nama_bayi($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_nama_bayi_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_nama_bayi">Nama Bayi</label></th>
    <td> : </td>
    <td><input name="docrt_form_nama_bayi" type="text" class="docrt_inputs" id="docrt_form_nama_bayi" value="'.$meta['docrt_form_nama_bayi'][0].'" /></td>
  </tr>';
  return $data;
}

function docrt_form_dilahirkan1($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_dilahirkan1_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_dilahirkan1">Tanggal Dilahirkan</label></th>
    <td> : </td>
    <td><input name="docrt_form_dilahirkan1" type="text" class="docrt_inputs docrt_datepicker" id="docrt_form_dilahirkan1" value="'.$meta['docrt_form_dilahirkan1'][0].'" /></td>
  </tr>';
  return $data;
}

function docrt_form_nonik_bayi($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_nonik_bayi_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_nonik_bayi">No NIK</label></th>
    <td> : </td>
    <td><input name="docrt_form_nonik_bayi" type="text" class="docrt_inputs" id="docrt_form_nonik_bayi" value="'.$meta['docrt_form_nonik_bayi'][0].'" /></td>
  </tr>';
  return $data;
}

function docrt_form_anakke($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_anakke_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_anakke">Anak Ke</label></th>
    <td> : </td>
    <td><input name="docrt_form_anakke" type="number" class="docrt_inputs" id="docrt_form_anakke" value="'.$meta['docrt_form_anakke'][0].'" /></td>
  </tr>';
  return $data;
}

function docrt_form_kelahiran($meta, $type_surat) {

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

function docrt_form_kembarke($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_kembarke_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_kembarke">Kembar Ke</label></th>
    <td> : </td>
    <td><input name="docrt_form_kembarke" type="number" class="docrt_inputs" id="docrt_form_kembarke" value="'.$meta['docrt_form_kembarke'][0].'" disabled/></td>
  </tr>';
  return $data;
}

function docrt_form_jk_bayi($meta, $type_surat) {

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

function docrt_form_kota_bayi($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_kota_bayi_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_kota_bayi">Kota/Kabupaten Kelahiran</label></th>
    <td> : </td>
    <td><input name="docrt_form_kota_bayi" type="text" class="docrt_inputs" id="docrt_form_kota_bayi" value="'.$meta['docrt_form_kota_bayi'][0].'"/></td>
  </tr>';
  return $data;
}


// Alter Kelahiran ayah ibu ==========================================================================================
function docrt_form_nama_ibu($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_nama_ibu_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_nama_ibu">Nama Ibu</label></th>
    <td> : </td>
    <td><input name="docrt_form_nama_ibu" type="text" class="docrt_inputs" id="docrt_form_nama_ibu" value="'.$meta['docrt_form_nama_ibu'][0].'" /></td>
  </tr>';
  return $data;
}

function docrt_form_dilahirkan2($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_dilahirkan2_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_dilahirkan2"> - Tanggal Dilahirkan</label></th>
    <td> : </td>
    <td><input name="docrt_form_dilahirkan2" type="text" class="docrt_inputs docrt_datepicker" id="docrt_form_dilahirkan2" value="'.$meta['docrt_form_dilahirkan2'][0].'" /></td>
  </tr>';
  return $data;
}

function docrt_form_kebangsaan_ibu($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_kebangsaan_ibu_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_kebangsaan_ibu"> - Kewarganegaraan</label></th>
    <td> : </td>
    <td><input name="docrt_form_kebangsaan_ibu" type="text" class="docrt_inputs" id="docrt_form_kebangsaan_ibu" value="'.$meta['docrt_form_kebangsaan_ibu'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_alamat_ibu($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_alamat_ibu_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_alamat_ibu"> - Alamat</label></th>
    <td> : </td>
    <td><input name="docrt_form_alamat_ibu" type="text" class="docrt_inputs" id="docrt_form_alamat_ibu" value="'.$meta['docrt_form_alamat_ibu'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_nonik_ibu($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_nonik_ibu_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_nonik_ibu"> - No NIK</label></th>
    <td> : </td>
    <td><input name="docrt_form_nonik_ibu" type="text" class="docrt_inputs" id="docrt_form_nonik_ibu" value="'.$meta['docrt_form_nonik_ibu'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_pekerjaan_ibu($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_pekerjaan_ibu_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_pekerjaan_ibu"> - Pekarjaan</label></th>
    <td> : </td>
    <td><input name="docrt_form_pekerjaan_ibu" type="text" class="docrt_inputs" id="docrt_form_pekerjaan_ibu" value="'.$meta['docrt_form_pekerjaan_ibu'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_tlp_ibu($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_tlp_ibu_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_tlp_ibu"> - Telepon</label></th>
    <td> : </td>
    <td><input name="docrt_form_tlp_ibu" type="text" class="docrt_inputs" id="docrt_form_tlp_ibu" value="'.$meta['docrt_form_tlp_ibu'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_nama_ayah($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_nama_ayah_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_nama_ayah">Nama Ayah</label></th>
    <td> : </td>
    <td><input name="docrt_form_nama_ayah" type="text" class="docrt_inputs" id="docrt_form_nama_ayah" value="'.$meta['docrt_form_nama_ayah'][0].'" /></td>
  </tr>';
  return $data;
}

function docrt_form_dilahirkan3($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_dilahirkan3_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_dilahirkan3"> - Tanggal Dilahirkan</label></th>
    <td> : </td>
    <td><input name="docrt_form_dilahirkan3" type="text" class="docrt_inputs docrt_datepicker" id="docrt_form_dilahirkan3" value="'.$meta['docrt_form_dilahirkan3'][0].'" /></td>
  </tr>';
  return $data;
}

function docrt_form_kebangsaan_ayah($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_kebangsaan_ayah_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_kebangsaan_ayah"> - Kewarganegaraan</label></th>
    <td> : </td>
    <td><input name="docrt_form_kebangsaan_ayah" type="text" class="docrt_inputs" id="docrt_form_kebangsaan_ayah" value="'.$meta['docrt_form_kebangsaan_ayah'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_alamat_ayah($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_alamat_ayah_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_alamat_ayah"> - Alamat</label></th>
    <td> : </td>
    <td><input name="docrt_form_alamat_ayah" type="text" class="docrt_inputs" id="docrt_form_alamat_ayah" value="'.$meta['docrt_form_alamat_ayah'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_nokk_ayah($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_nokk_ayah_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_nokk_ayah"> - No KK</label></th>
    <td> : </td>
    <td><input name="docrt_form_nokk_ayah" type="text" class="docrt_inputs" id="docrt_form_nokk_ayah" value="'.$meta['docrt_form_nokk_ayah'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_nonik_ayah($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_nonik_ayah_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_nonik_ayah"> - No NIK</label></th>
    <td> : </td>
    <td><input name="docrt_form_nonik_ayah" type="text" class="docrt_inputs" id="docrt_form_nonik_ayah" value="'.$meta['docrt_form_nonik_ayah'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_pekerjaan_ayah($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_pekerjaan_ayah_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_pekerjaan_ayah"> - Pekarjaan</label></th>
    <td> : </td>
    <td><input name="docrt_form_pekerjaan_ayah" type="text" class="docrt_inputs" id="docrt_form_pekerjaan_ayah" value="'.$meta['docrt_form_pekerjaan_ayah'][0].'"/></td>
  </tr>';
  return $data;
}

function docrt_form_tlp_ayah($meta, $type_surat) {

  $data = '<tr align="left" class="docrt_form_tlp_ayah_tr docrt_form">
    <th><label class="diy-label" for="docrt_form_tlp_ayah"> - Telepon</label></th>
    <td> : </td>
    <td><input name="docrt_form_tlp_ayah" type="text" class="docrt_inputs" id="docrt_form_tlp_ayah" value="'.$meta['docrt_form_tlp_ayah'][0].'"/></td>
  </tr>';
  return $data;
}


// Pindah Pengikut

function docrt_tbl_pindah($meta, $type_surat) {

  $data = '<table class="docrt_pemohon_box docrt_tbl_pindah d-hide">';
      $data .= '<tbody>';
      $data .= '
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

          $data .= '<tr align="center" class="docrt_pengikut docrt_pengikut'.$i.' ">
              <td></td>
              <td><input name="docrt_pengikut_nama'.$i.'" type="text" id="docrt_pengikut_nama'.$i.'" value="'.$meta['docrt_pengikut_nama'.$i][0].'" class="pengikut_nama"/></td>
              <td><select class="pengikut_jk" name="docrt_pengikut_jk'.$i.'" id="docrt_pengikut_jk'.$i.'" >
                    <option value="Laki-Laki" >L</option>
                    <option value="Perempuan" '.(($meta['docrt_pengikut_jk'.$i][0] == 'Perempuan') ? 'selected' : '').'>P</option>
                  </select>
              </td>
              <td><input name="docrt_pengikut_lahir'.$i.'" type="text" id="docrt_pengikut_lahir'.$i.'" value="'.$meta['docrt_pengikut_lahir'.$i][0].'" class="pengikut_tgl docrt_datepicker"/></td>
              <td><select class="pengikut_status" name="docrt_pengikut_status'.$i.'" type="text" id="docrt_pengikut_status'.$i.'" >
                    <option value="Blm Kawin">Blm Kawin</option>
                    <option value="Kawin" '.(($meta['docrt_pengikut_status'.$i][0] == 'Kawin') ? 'selected' : '').'>Kawin</option>
                    <option value="Cerai Hidup" '.(($meta['docrt_pengikut_status'.$i][0] == 'Cerai Hidup') ? 'selected' : '').'>Cerai Hidup</option>
                    <option value="Cerai Mati" '.(($meta['docrt_pengikut_status'.$i][0] == 'Cerai Mati') ? 'selected' : '').'>Cerai Mati</option>
                  </select>
              </td>
              <td><input name="docrt_pengikut_pendidikan'.$i.'" type="text" id="docrt_pengikut_pendidikan'.$i.'" value="'.$meta['docrt_pengikut_pendidikan'.$i][0].'" class="pengikut_pend"/></td>
              <td><input name="docrt_pengikut_nik'.$i.'" type="text" id="docrt_pengikut_nik'.$i.'" value="'.$meta['docrt_pengikut_nik'.$i][0].'" class="pengikut_nik"/></td>
              <td><input name="docrt_pengikut_keterangan'.$i.'" type="text" id="docrt_pengikut_keterangan'.$i.'" value="'.$meta['docrt_pengikut_keterangan'.$i][0].'" class="pengikut_ket"/></td>
          </tr>';
      }
      $data .= '</tbody>';
  $data .= '</table>';

  return $data;
}











//  Aint no form ================================================================================================

function docrt_doc_title_nosurat($meta, $type_surat) {
  //$post_term = get_the_terms ($post_id,'surat' );
  $tag = get_term_by('slug', $type_surat, 'surat');

  if (isset($meta['docrt_'.$type_surat.'_id'][0])) {
      $suratid = $meta['docrt_'.$type_surat.'_id'][0];
  } else {
      $suratid = get_option('docrt_'.$type_surat.'') + 1;
  }

  // form id & title
  $readonly = 'readonly';
  if ($type_surat == 'sk'
    || $type_surat == 'sktm'
    || $type_surat == 'skbpm') {
    $readonly = '';
  }
  $data .=  '<tbody><tr>
      <td colspan="3"><h4>'.ucwords($tag->name).'</h4></td>
  </tr>
  <tr align="left">
      <th><label class="diy-label" for="docrt_'.$type_surat.'_id">No Surat</label></th>
      <td> : </td>
      <td><input name="docrt_'.$type_surat.'_id" type="number" class="docrt_inputs" id="docrt_'.$type_surat.'_id" value="'.$suratid.'" '.$readonly.'/></td>
  </tr></tbody>';

  return $data;
}

function docrt_get_group_title($string) {
  return '<tr><td colspan="3">&nbsp;</td></tr>
    <tr align="left">
        <th colspan="3"><label class="headform-label">'.$string.'</label></th>
    </tr>
    <tr><td colspan="3"><hr/></td></tr>';
}











