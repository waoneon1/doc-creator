<?php require_once('../../../../wp-load.php');
require '../includes/api/Dispenduk_API.php';

$nik = $_POST['nik'];

$KTP = new Dispenduk_API();
//$param = $_POST;
//print_r($KTP->get_data_ktp('21321'));
//rint_r($KTP->get_data());
//print_r($_POST);
echo json_encode($KTP->get_data_ktp($nik));
