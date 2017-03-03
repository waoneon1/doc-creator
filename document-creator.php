<?php
/*
Plugin Name: Document Creator
Plugin URI: -
Description: Make Document From Template
Version: 0.0.1
Author: Dharmawan Sukma Hardi
Author URI: -
License: GPLv2 or laterss
Text Domain:
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function docrt_plugin_url() {
    return untrailingslashit( plugins_url( '/', __FILE__ ) );
}

function docrt_plugin_path() {
    return untrailingslashit( plugin_dir_path( __FILE__ ) );
}

function docrt_plugin_basename() {
    return plugin_basename(__FILE__);
}
/*****************************************************************************************
 * Define
 *****************************************************************************************/
define("DOCRT_TTD",serialize(array('Lurah','Seklur','Kasi')));
define("DOCRT_TYPE_SURAT_ALLOWED",serialize(array(
        'kk','ktp','skel','skem','skbpm','skck','skd','skdu','skik','skp','sktm','sku', 'sk'
    )));
// List yang menandatangani
function docrt_who_give_ttd($jenis_ttd) {
    if ($jenis_ttd == 'lurah') {
        $ttd['jabatan'] = 'LURAH SAWOJAJAR';
        $ttd['nama']    = 'J.A. BAYU WIDJAYA, S.Sos, M.Si';
        $ttd['kasi']    = '';
        $ttd['nip']     = 'NIP. 19710731 199203 1 003';
    } elseif ($jenis_ttd == 'seklur') {
        $ttd['jabatan'] = 'LURAH SAWOJAJAR<br/><span style="font-size:11px;">Sekretaris</span>';
        $ttd['nama']    = 'ADI ANDRIANTO. P, SH.M.Hum';
        $ttd['kasi']    = '';
        $ttd['nip']     = 'NIP. 19740730 200312 1 005';
    } elseif ($jenis_ttd == 'kasi') {
        $ttd['jabatan'] = 'an: LURAH SAWOJAJAR<br/><span style="font-size:11px;">Kasi Pemerintahan, Ketentraman dan Ketertiban Umum</span>';
        $ttd['nama']    = 'AMAN SANTOSO';
        $ttd['kasi']    = '<span style="font-size:11px;">Penata</span><br/>';
        $ttd['nip']     = 'NIP. 19610928 199111 1 001';
    } else {
        $ttd['jabatan'] = $jenis_ttd;
        $ttd['nama']    = '';
        $ttd['kasi']    = '';
        $ttd['nip']     = '';
    }
    return $ttd;
}



function docrt_include_admin() {
    if (is_admin()) {
        include_once __DIR__ . '/includes/admin/types-table-filter.php';
        include_once __DIR__ . '/includes/admin/settings.php';
    }
}
add_action('init', 'docrt_include_admin');

function docrt_load_scripts_admin() {
    global $pagenow;

    wp_enqueue_style( 'style-default', docrt_plugin_url() . '/assets/css/style_admin.css' );
    wp_enqueue_style( 'jqui-css', docrt_plugin_url() . '/assets/css/jquery-ui.css' );
    wp_enqueue_script( 'jqui-js', docrt_plugin_url() . '/assets/js/jquery-ui.js', array('jquery'), '' );

    if (in_array($pagenow,  array('post-new.php', 'post.php'))) {
        wp_enqueue_media();
        wp_enqueue_script( 'form-js', docrt_plugin_url() . '/assets/js/docrt-form.js' , array('jquery'), '' );
    }
}
add_action('admin_enqueue_scripts', 'docrt_load_scripts_admin');


function docrt_load_scripts(){
    wp_enqueue_media();
    wp_enqueue_style( 'style-default', docrt_plugin_url() . '/assets/css/style.css' );
    //wp_localize_script( 'main-js', 'ajax_params',   array( 'ajax_url' => docrt_plugin_url().'/ajax'.'/'));
    // send ajax url
    wp_localize_script('main-js', 'ajax_params', array(
        'empty_img_url' => docrt_plugin_url() . '/assets/img/rectangle.png',
        'ajax_url' => docrt_plugin_url() . '/ajax' . '/'
    ));
}
add_action( 'wp_enqueue_scripts', 'docrt_load_scripts' );

/*****************************************************************************************
 * Set Option on install Plugin
 * docrt-document
 *****************************************************************************************/

function docrt_tax_list() {

    wp_insert_term( 'surat keterangan usaha',               'surat', $args = array('slug'=>'sku') );
    wp_insert_term( 'surat keterangan domisili usaha ',     'surat', $args = array('slug'=>'skdu') );
    wp_insert_term( 'surat keterangan domisili',            'surat', $args = array('slug'=>'skd') );
    wp_insert_term( 'surat keterangan ijin keramaian',      'surat', $args = array('slug'=>'skik') );
    wp_insert_term( 'surat keterangan catatan kepolisian',  'surat', $args = array('slug'=>'skck') );
    wp_insert_term( 'surat keterangan pindah',              'surat', $args = array('slug'=>'skp') );
    wp_insert_term( 'surat keterangan tidak mampu',         'surat', $args = array('slug'=>'sktm') );
    wp_insert_term( 'surat keterangan balum pernah menikah','surat', $args = array('slug'=>'skbpm') );
    wp_insert_term( 'surat kelahiran',                      'surat', $args = array('slug'=>'skel') );
    wp_insert_term( 'surat kematian',                       'surat', $args = array('slug'=>'skem') );
    wp_insert_term( 'kartu tanda penduduk',                 'surat', $args = array('slug'=>'ktp') );
    wp_insert_term( 'kartu keluarga',                       'surat', $args = array('slug'=>'kk') );
    wp_insert_term( 'surat keterangan adat istiadat',       'surat', $args = array('slug'=>'skai') );
}



include_once __DIR__ . '/includes/types.php';
include_once __DIR__ . '/includes/types-perangkat.php';
