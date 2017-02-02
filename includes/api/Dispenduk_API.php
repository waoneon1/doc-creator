<?php

/**
*
*/
class Dispenduk_API
{
  public $api_key ;
  public $ip;

  function __construct()
  {
      $this->api_key = '3a1445af14d6920df76b9001e75c95c47e1ecd0d';
      $this->ip = '192.10.10.70:8082';
  }

  function get_data_ktp($nik, $format = 'json') {

    $ktp = $this->call_ktp($nik, $format);
    $return = array(
      'docrt_form_nonik' => $ktp->KTP->NIK,
      'docrt_form_nokk' => $ktp->KTP->NO_KK,
      'docrt_form_nama' => $ktp->KTP->NAMA_LGKP,
      'docrt_form_alamat' => $ktp->KTP->ALAMAT,
      'docrt_form_rtrw' => $ktp->KTP->NO_RT.'  '.$ktp->KTP->NO_RW,
      'docrt_form_ttl' => $ktp->KTP->TMPT_LHR.', '.$ktp->KTP->TGL_LHR,
      'docrt_form_sperkawinan' => $this->filter($ktp->KTP->STAT_KWN,'sperkawinan'),
      'docrt_form_agama' => $this->filter($ktp->KTP->AGAMA,'agama'),
      'docrt_form_pekerjaan' => $ktp->KTP->JENIS_PKRJN,
      'docrt_form_provinsi' => $ktp->KTP->NO_PROP,
      'docrt_form_kota' => $ktp->KTP->NO_KAB,
      'docrt_form_kecamatan' => $ktp->KTP->NO_KEC,
      'docrt_form_kelurahan' => $ktp->KTP->NO_KEL,
    );
    return $return;
  }

  function call_ktp($nik, $format) {
    $url = 'http://'.$this->ip.'/ws/api/v2/ktp/nik/'.$nik.'/'.'key/'.$this->api_key.'/'.'format/'.$format;
    //$url = 'http://192.10.10.70:8082/ws/api/v2/ktp/nik/3573032709930004/key/3a1445af14d6920df76b9001e75c95c47e1ecd0d/format/json';

    $json = file_get_contents($url);
    $obj = json_decode($json);
    /*$obj = array(
        'KTP' => array(
            "NIK" => "0000000000000000",
            "NO_KK" => "0000000000000000",
            "NAMA_LGKP" => "xxx",
            "ALAMAT" => "xxx",
            "NO_RT" => "1",
            "NO_RW" => "7",
            "TMPT_LHR" => "BLITAR",
            "TGL_LHR" => "11-OCT85",
            "STAT_KWN" => "1",
            "AGAMA" => "1",
            "JENIS_PKRJN" => "15",
            "NO_PROP" => "35",
            "NO_KAB" => "73 ",
            "NO_KEC" => "3",
            "NO_KEL" => "1009"
        ),
    );*/
    return $obj;
  }

  function filter($data, $key) {
    switch ($key) {
        case 'sperkawinan':
            $param = array('', 'Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati');
            $return = $param[$data];
            break;

        case 'agama':
            $param = array('','Islam','Kristen','Katolik','Hindu','Budha','Lain-Lain','Lain-Lain','Lain-Lain');
            $return = $param[$data];
            break;

        case 'pekerjaan':
            $param = array('',
              'Belum/Tidak Bekerja',
              'Mengurus Rumah Tangga',
              'Pelajar/Mahasiswa',
              'Pensiunan',
              'Pegawai Negeri Sipil (PNS)',
              'Tentara Nasional Indonesia (TNI)',
              'Kepolisian RI (POLRI)',
              'Perdagangan',
              'Petani/Pekebun',
              'Peternak', //10
              'Nelayan/Perikanan',
              'Industri',
              'Konstruksi',
              'Transportasi',
              'Karyawan Swasta',
              'Karyawan BUMN',
              'Karyawan BUMD',
              'Karyawan Honorer',
              'Buruh Harian Lepas',
              'Buruh Tani/Perkebunan', //20
              'Buruh Nelayan/Perikanan',
              'Buruh Peternakan',
              'Pembantu Rumah Tangga',
              'Tukang Cukur',
              'Tukang Listrik',
              'Tukang Batu',
              'Tukang Kayu',
              'Tukang Sol Sepatu',
              'Tukang Las/Pandai Besi',
              'Tukang Jahit', //30
              'Lain - Lain'
              );
            if ($data > 30) {
              $data = 31;
            }
            $return = $param[$data];
            break;

        default:
            # code...
            break;
    }

    return $return;
  }
}

//http://192.10.10.70:8082/ws/api/v2/ktp/nik/3573032709930004/key/3a1445af14d6920df76b9001e75c95c47e1ecd0d/format/json

//{"KTP":{"NIK":"3573032709930004","NO_KK":"3573031508070011","NAMA_LGKP":"ANUGRAH SEPTIANTO","ALAMAT":"JL. RANUGRATI III \/ 17-A","NO_RT":"1","NO_RW":"1","TMPT_LHR":"MALANG","TGL_LHR":"27-SEP-93","STAT_KWN":"1","AGAMA":"1","JENIS_PKRJN":"15","NO_PROP":"35","NO_KAB":"73","NO_KEC":"3","NO_KEL":"1008"}}
?>

