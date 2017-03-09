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
//define("DOCRT_TTD",serialize(array('Lurah','Seklur','Kasi')));
function docrt_get_list_ttd() {
    $docrt_pej = get_option('docrt_pej');
    $pejabat = array();
    foreach ($docrt_pej as $key => $value) {
        $pejabat[] = $value['kode'];
    }

    return $pejabat;
}
define("DOCRT_TYPE_SURAT_ALLOWED",serialize(array(
        'kk','ktp','skel','skem','skbpm','skck','skd','skdu','skik','skp','sktm','sku', 'sk'
    )));
// List yang menandatangani
function docrt_who_give_ttd($jenis_ttd) {

    $pejabat    = get_option('docrt_pej');
    $data_dasar = get_option('docrt_data_dasar');
    //unset($pejabat['count']);
    $status = false;
    foreach ($pejabat as $k => $v) {
        // Kondisi kusus
        $lurah = strtoupper('Lurah '.$data_dasar['kel']);
        switch ($v['kode']) {
        case 'lurah':
            $option_jabatan = $lurah;
            $option_kasi = '';
            break;
        case 'seklur':
            $option_jabatan = $lurah.'<br /><span style="font-size:11px;">'.$v['jabatan'].'</span>';
            $option_kasi = '';
            break;
        default:
            $option_jabatan = 'an: '.$lurah.'<br /><span style="font-size:11px;">'.$v['jabatan'].'</span>';
            $option_kasi = '<span style="font-size:11px;">Penata</span><br/>';
            break;
        }

        if ($v['kode'] == $jenis_ttd) {
            $ttd['jabatan'] = $option_jabatan;
            $ttd['nama']    = $v['nama'];
            $ttd['kasi']    = $option_kasi;
            $ttd['nip']     = 'NIP. '.$v['nip'];
            $status = true;
        }
    }

    if (!$status)  {
        $ttd['jabatan'] = 'error';
        $ttd['nama']    = 'error';
        $ttd['kasi']    = 'error';
        $ttd['nip']     = 'error';
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

    if (in_array($pagenow,  array('edit.php'))) {
        wp_enqueue_media();
        wp_enqueue_script( 'edit-js', docrt_plugin_url() . '/assets/js/docrt-edit.js' , array('jquery'), '' );
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
}



include_once __DIR__ . '/includes/types.php';
include_once __DIR__ . '/includes/types-perangkat.php';
