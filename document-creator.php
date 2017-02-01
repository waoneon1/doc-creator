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

include_once __DIR__ . '/includes/types.php';
include_once __DIR__ . '/includes/types-perangkat.php';

function docrt_include_admin() {
    global $pagenow;

    if (is_admin()) {
        include_once __DIR__ . '/includes/admin/types-table-filter.php';
        include_once __DIR__ . '/includes/admin/settings.php';
        wp_enqueue_style( 'style-default', docrt_plugin_url() . '/assets/css/style_admin.css' );
        if ($pagenow != 'admin.php') {
            wp_enqueue_script( 'form-js', docrt_plugin_url() . '/assets/js/docrt-form.js' , array('jquery'), '' );
            wp_enqueue_style( 'jqui-css', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );
            wp_enqueue_script( 'jqui-js', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery'), '' );
        }

        ?>
        <script type="text/javascript">
            var ajax_url = '';
            var post_id  = '';
        </script>
        <?php
    }
}

add_action('init', 'docrt_include_admin');

add_action( 'wp_enqueue_scripts', 'docrt_load_scripts' );
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


/*****************************************************************************************
 * Set Option on install Plugin
 * docrt-document
 *****************************************************************************************/
register_activation_hook(__FILE__,'docrt_install');
// register_deactivation_hook( __FILE__, 'docrt_remove' );

function docrt_install() {
    /* Creates new database field */
    add_option("docrt_skd", 0, '', 'yes');
    add_option("docrt_skdu", 0, '', 'yes');
    add_option("docrt_sku", 0, '', 'yes');
}
/*function docrt_remove() {

    delete_option('docrt_skd');
    delete_option('docrt_skdu');
    delete_option('docrt_sku');
}
*/

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


function docrt_local_timezone() {
    define( 'MY_TIMEZONE', (get_option( 'timezone_string' ) ? get_option( 'timezone_string' ) : date_default_timezone_get() ) );
    date_default_timezone_set( MY_TIMEZONE );
    echo date_i18n('F d, Y H:i', 1365194723);
}







