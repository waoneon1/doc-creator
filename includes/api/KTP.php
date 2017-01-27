<?php

/**
*
*/
class KTP
{
  public $ktp;
  function __construct($argument)
  {
      $this->ktp = $argument;
  }

  function get_data($ktp = false) {

    if ($ktp === false) $ktp = $this->ktp;
    $return = array(
      'docrt_form_nonik' => $ktp['NIK'],
      'docrt_form_nokk' => $ktp['NO_KK'],
      'docrt_form_nama' => $ktp['NAMA_LGKP'],
      'docrt_form_alamat' => $ktp['ALAMAT'],
      'docrt_form_rtrw' => $ktp['NO_RT'].'  '.$ktp['NO_RW'],
      'docrt_form_ttl' => $ktp['TMPT_LHR'].', '.$ktp['TGL_LHR'],
      'docrt_form_sperkawinan' => $ktp['STAT_KWN'],
      'docrt_form_agama' => $ktp['AGAMA'],
      'docrt_form_pekerjaan' => $ktp['JENIS_PKRJN'],
      'docrt_form_provinsi' => $ktp['NO_PROP'],
      'docrt_form_kota' => $ktp['NO_KAB'],
      'docrt_form_kecamatan' => $ktp['NO_KEC'],
      'docrt_form_kelurahan' => $ktp['NO_KEL'],
    );
    return $return;

  }
}

?>

