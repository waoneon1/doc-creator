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
    $return = false;

    if ($ktp) {

      if ($ktp->status === false) {
        $return = $ktp;
      } else {
        $return = array(
          'docrt_form_nonik' => $ktp->KTP->NIK,
          'docrt_form_nokk' => $ktp->KTP->NO_KK,
          'docrt_form_nama' => $ktp->KTP->NAMA_LGKP,
          'docrt_form_alamat' => $ktp->KTP->ALAMAT,
          'docrt_form_rtrw' => 'RT '.$ktp->KTP->NO_RT.' / RW '.$ktp->KTP->NO_RW,
          'docrt_form_ttl' => $ktp->KTP->TMPT_LHR.', '. $this->filter($ktp->KTP->TGL_LHR,'tgl_lahir'),
          'docrt_form_umur' => $this->filter($ktp->KTP->TGL_LHR,'umur'),
          'docrt_form_sperkawinan' => $this->filter($ktp->KTP->STAT_KWN,'sperkawinan'),
          'docrt_form_agama' => $this->filter($ktp->KTP->AGAMA,'agama'),
          'docrt_form_pekerjaan' => $this->filter($ktp->KTP->JENIS_PKRJN,'pekerjaan'),
          'docrt_form_provinsi' => $this->filter($ktp->KTP->NO_PROP, 'prop'),
          'docrt_form_kota' => $this->filter($ktp->KTP->NO_KAB, 'kab'),
          'docrt_form_kecamatan' => $this->filter($ktp->KTP->NO_KEC, 'kecamatan'),
          'docrt_form_kelurahan' => $this->filter($ktp->KTP->NO_KEL, 'kelurahan'),
        );
      }
    } else {
      $return = array("status"=>false,"message"=>"koneksi gagal");
    }

    return $return;
  }

  function get_data_ktp_pengikut($nik, $i, $format = 'json') {

    $ktp = $this->call_ktp($nik, $format);
    $return = false;
    if ($ktp) {

      if ($ktp->status === false) {
        $return = $ktp;
      } else {
        $return = array(
           'docrt_pengikut_nik'.$i => $ktp->KTP->NIK,
           'docrt_pengikut_nama'.$i => $ktp->KTP->NAMA_LGKP,
           'docrt_pengikut_lahir'.$i => $this->filter($ktp->KTP->TGL_LHR,'tgl_lahir','slash'),
           'docrt_pengikut_status'.$i => $this->filter($ktp->KTP->STAT_KWN,'sperkawinan'),
         );
      }
    } else {
      $return = array("status"=>false,"message"=>"koneksi gagal");
    }

    return $return;
  }

  function call_ktp($nik, $format) {
    $url = 'http://'.$this->ip.'/ws/api/v3/ktp/nik/'.$nik.'/'.'key/'.$this->api_key.'/'.'format/'.$format;
    //$url = 'http://192.10.10.70:8082/ws/api/v2/ktp/nik/3573032709930004/key/3a1445af14d6920df76b9001e75c95c47e1ecd0d/format/json';
    //$json = file_get_contents($url);

    //  Initiate curl
    $ch = curl_init();
    // Disable SSL verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Time out
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    // Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Set the url
    curl_setopt($ch, CURLOPT_URL,$url);
    // Execute
    $json=curl_exec($ch);
    // Closing
    curl_close($ch);

    $obj = json_decode($json);

    //Tes Manual Aktifkan ini
    //$obj = json_decode('{"KTP":{"NIK":"3573032709930004","NO_KK":"3573031508070011","NAMA_LGKP":"ANUGRAH SEPTIANTO","ALAMAT":"JL. RANUGRATI III \/ 17-A","NO_RT":"1","NO_RW":"1","TMPT_LHR":"MALANG","TGL_LHR":"27-JAN-08","STAT_KWN":"1","AGAMA":"1","JENIS_PKRJN":"15","NO_PROP":"35","NO_KAB":"73","NO_KEC":"3","NO_KEL":"1008"}}');

    return $this->validate_nik($obj);
  }

  function validate_nik($obj) {

    if ($obj) {

      $kkec = docrt_dd('kkec');
      $kkel = docrt_dd('kkel');
      $kec  = docrt_dd('kec');
      $kel  = docrt_dd('kel');

      if ($kkel != $obj->KTP->NO_KEL) {
        return json_decode('{"status":false,"message":"NIK tidak terdaftar di kelurahan '.$kel.'"}');
      }

      if ($kkec != $obj->KTP->NO_KEC) {
        return json_decode('{"status":false,"message":"NIK tidak terdaftar di kecamatan '.$kec.'"}');
      }
    }

    return $obj;
  }

  function filter($data, $key, $format = '') {
    switch ($key) {
        case 'sperkawinan':
            $param = array('', 'Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati');
            $return = $param[$data];
            break;

        case 'agama':
            $param = array('','Islam','Kristen','Katolik','Hindu','Budha','Lain-Lain','Lain-Lain','Lain-Lain');
            $return = $param[$data];
            break;

        case 'tgl_lahir':
            //27-SEP-93
            $return = $this->modif_date($data,$format);
            break;

        case 'umur':
            $dob = $this->modif_date($data,'slash');
            $return = $this->age_calculator($dob);
            break;

        case 'kecamatan':
           $param = array(
              '3' => 'Kedungkandang',
            );
            if ( array_key_exists($data, $param)) {
              $return = $param[$data];
            } else {
              $return = $data;
            }
            break;

        case 'kelurahan':
           $param = array(
              '1008' => 'Sawojajar',
            );
            if ( array_key_exists($data, $param)) {
              $return = $param[$data];
            } else {
              $return = $data;
            }
            break;

        case 'prop':
            $param = array(
              '35' => 'Jawa Timur',
            );
            if ( array_key_exists($data, $param)) {
              $return = $param[$data];
            } else {
              $return = $data;
            }
            break;

        case 'kab':
            $param = array(
              '73' => 'Kota Malang',
            );
            if ( array_key_exists($data, $param)) {
              $return = $param[$data];
            } else {
              $return = $data;
            }
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
              'Tukang Gigi',
              'Penata Rias',
              'Penata Busana',
              'Penata Rambut',
              'Mekanik',
              'Seniman',
              'Tabib',
              'Paraji',
              'Perancang Busana',
              'Penterjemah', //40
              'Imam masjid',
              'Pendeta',
              'Pastor',
              'Wartawan',
              'Ustadz/Mubaligh',
              'Juru Masak',
              'Promotor Acara',
              'Anggota DPR-RI',
              'Anggota DPD',
              'Anggota BPK', //50
              'Presiden',
              'Wakil Presiden',
              'Anggota Mahkamah Konstitusi',
              'Anggota Kabinet Kementerian',
              'Duta Besar',
              'Gubernur',
              'Wakil Gubernur',
              'Bupati',
              'Wakil Bupati',
              'Walikota', //60
              'Wakil Walikota',
              'Anggota DPRD Prop',
              'Anggota DPRD Kab/Kota',
              'Dosen',
              'Guru',
              'Pilot',
              'Pengacara',
              'Notaris',
              'Arsitek',
              'Akuntan', //70
              'Konsultan',
              'Dokter',
              'Bidan',
              'Perawat',
              'Apoteker',
              'Psikiater/Psikolog',
              'Penyiar Televisi',
              'Penyiar Radio',
              'Pelaut',
              'Peneliti', //80
              'Sopir',
              'Pialang',
              'Paranormal',
              'Pedagang',
              'Perangkat Desa',
              'Kepala Desa',
              'Biarawati',
              'Wiraswasta',
              'Lain-Lain',
            );
            if ($data > 89) {
              $data = 89;
            }
            $return = $param[$data];
            break;

        default:
            # code...
            break;
    }

    return $return;
  }

  function modif_date($data, $format) {
    $return = $data;
    $m = array(
      'JAN' => array('Januari', 1, 'january'),
      'FEB' => array('Februari', 2, 'february'),
      'MAR' => array('Maret', 3, 'march'),
      'APR' => array('April', 4, 'april'),
      'MEI' => array('Mei', 5, 'may'),
      'JUN' => array('Juni', 6, 'june'),
      'JUL' => array('Juli', 7, 'july'),
      'AGU' => array('Agustus', 8, 'august'),
      'SEP' => array('September', 9, 'september'),
      'OKT' => array('Oktober', 10, 'october'),
      'NOV' => array('November', 11, 'november'),
      'DES' => array('Desember', 12, 'december'),
    );
    $y = date("y"); //2017 -> 17
    $param = explode('-', $data);

    if (count($param) == 3) {
      if ( array_key_exists($param[1], $m)) {
        $p1 = $param[0]; //hari
        $p2 = $m[$param[1]][0]; //bulan

        //modif taun jiga 1 digit angka
        $param_y = $param[2];
        if (strlen($param_y) == 1) $param_y = '0'.$param_y;
        $p3 = ($param_y >= 0 && $param_y <= $y) ? '20'.$param_y : '19'.$param_y;

        $return = $p1.' '.$p2.' '.$p3;

        if ($format == 'slash') {
          $p2 = $m[$param[1]][2]; //bulan
          $return =   date("m/d/Y", strtotime($p1.' '.$p2.' '.$p3));
        }
      }
    }
    return $return;
  }

  function age_calculator($dob){
      if(!empty($dob)){
          $birthdate = new DateTime($dob);
          $today   = new DateTime('today');
          $age = $birthdate->diff($today)->y;
          return $age;
      }else{
          return 0;
      }
  }
}

//http://192.10.10.70:8082/ws/api/v2/ktp/nik/3573032709930004/key/3a1445af14d6920df76b9001e75c95c47e1ecd0d/format/json

//{"KTP":{"NIK":"3573032709930004","NO_KK":"3573031508070011","NAMA_LGKP":"ANUGRAH SEPTIANTO","ALAMAT":"JL. RANUGRATI III \/ 17-A","NO_RT":"1","NO_RW":"1","TMPT_LHR":"MALANG","TGL_LHR":"27-SEP-93","STAT_KWN":"1","AGAMA":"1","JENIS_PKRJN":"15","NO_PROP":"35","NO_KAB":"73","NO_KEC":"3","NO_KEL":"1008"}}
?>

