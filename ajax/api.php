<?php require_once('../../../../wp-load.php');
require '../includes/api/KTP.php';
$data = array(
    'KTP' => array(
        "NIK"   => "0000000000000000",
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
);


$KTP = new KTP($data['KTP']);
//$param = $_POST;
//print_r($data);
//rint_r($KTP->get_data());
echo json_encode($KTP->get_data());
