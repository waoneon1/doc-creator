<?php
/*
Plugin Name: Document Creator
Plugin URI: -
Description: Make Document From Template
Version: 1.1.0
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
function docrt_get_list_ttd() {
    $docrt_pej = get_option('docrt_pej');
    $pejabat = array();
    foreach ($docrt_pej as $key => $value) {
        $pejabat[] = $value['kode'];
    }
    return $pejabat;
}
function docrt_get_type_surat_allowed() {
    $docrt_surat_checkbox = get_option('docrt_surat_checkbox');
    $surat = array();

    if ($docrt_surat_checkbox) {
        foreach ($docrt_surat_checkbox as $key => $value) {
            if ($value == 1) {
                $surat[] = $key;
            }
        }
    }
    return $surat;
}
// data dasar
function docrt_dd($jenis = false){
    $dd = get_option('docrt_data_dasar');
    if($jenis) return $dd[$jenis];

    return $dd;
}
// no surat here
function docrt_no_surat($type,$meta,$postID) {

    $no = '35.73'.'.'.docrt_dd('kkec').'.'.docrt_dd('kkel');
    // Surat Utama 16

    $data['sku']    = '563/'.$meta['docrt_sku_id'][0].'/'.$no.'/'.get_the_date('Y',$postID) ;
    $data['skdu']   = '563/'.$meta['docrt_skdu_id'][0].'/'.$no.'/'.get_the_date('Y',$postID) ;
    $data['skd']    = '563/'.$meta['docrt_skd_id'][0].'/'.$no.'/'.get_the_date('Y',$postID) ;
    $data['skik']   = '435/'.$meta['docrt_skik_id'][0].'/'.$no.'/'.get_the_date('Y',$postID) ;
    $data['skck']   = '331/'.$meta['docrt_skck_id'][0].'/'.$no.'/'.get_the_date('Y',$postID) ;
    $data['skp']    = '475/'.$meta['docrt_skp_id'][0].'/'.$no.'/'.get_the_date('Y',$postID) ;
    $data['skp_m']  = '475/'.$meta['docrt_skp_m_id'][0].'/'.$no.'/'.get_the_date('Y',$postID) ;

    $data['sktm']   = '581/'.$meta['docrt_sktm_id'][0].'/'.$no.'/'.get_the_date('Y',$postID) ;
    $data['skbpm']  = '474/'.$meta['docrt_skbpm_id'][0].'/'.$no.'/'.get_the_date('Y',$postID) ;
    $data['skel']   = '474.1/'.$meta['docrt_skel_id'][0].'/'.$no.'/'.'V/'.get_the_date('Y',$postID) ;
    $data['skem']   = '474.3/'.$meta['docrt_skem_id'][0].'/'.$no.'/'.'V/'.get_the_date('Y',$postID) ;
    $data['kk']     = $meta['docrt_kk_id'][0].'/'.get_the_date('Y',$postID) ;
    $data['kk_p']   = $meta['docrt_kk_p_id'][0].'/'.get_the_date('Y',$postID) ;
    $data['kk_t']   = $meta['docrt_kk_t_id'][0].'/'.get_the_date('Y',$postID) ;
    $data['ktp']    = $meta['docrt_ktp_id'][0].'/'.get_the_date('Y',$postID) ;
    $data['sk']     = '474/'.$meta['docrt_sk_id'][0].'/'.$no.'/'.get_the_date('Y',$postID) ;
    $data['lg']     = $meta['docrt_lg_id'][0].'/'.get_the_date('Y',$postID) ;
    $data['r_u']    = $meta['docrt_r_u_id'][0].'/'.get_the_date('Y',$postID) ;
    $data['r_ho']   = $meta['docrt_r_ho_id'][0].'/'.get_the_date('Y',$postID) ;
    $data['r_imb']  = $meta['docrt_r_imb_id'][0].'/'.get_the_date('Y',$postID) ;


    // option: bukan merupakan surat utama
    $data['skai']   = '331/'.$meta['docrt_skp_id'][0].'/'.$no.'/'.'V/'.get_the_date('Y',$postID) ;
    $data['skkel']   = '???/'.$meta['docrt_skel_id'][0].'/'.$no.'/'.'V/'.get_the_date('Y',$postID) ;
    $data['skkem']   = '???/'.$meta['docrt_skem_id'][0].'/'.$no.'/'.'V/'.get_the_date('Y',$postID) ;

    return $data[$type];
}
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

        // lurah selalu ikut
        if ($v['kode'] == 'lurah') {
            $ttd['lurah'] = $v;
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

    wp_enqueue_style( 'style-admin-docrt', docrt_plugin_url() . '/assets/css/style-admin-docrt.css' );
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

    // send ajax url
    wp_localize_script('main-js', 'ajax_params', array(
        'front_end' => false
    ));
}
add_action('admin_enqueue_scripts', 'docrt_load_scripts_admin');


function docrt_load_scripts(){
    wp_enqueue_media();
    wp_enqueue_style( 'style-default', docrt_plugin_url() . '/assets/css/style.css' );
    wp_enqueue_style( 'jqui-css', docrt_plugin_url() . '/assets/css/jquery-ui.css' );
    wp_enqueue_script( 'jqui-js', docrt_plugin_url() . '/assets/js/jquery-ui.js', array('jquery'), '' );

    if (is_page_template('docrt-template-home.php')) {
        wp_enqueue_script( 'form-js', docrt_plugin_url() . '/assets/js/docrt-form.js' , array('jquery'), '' );
        wp_enqueue_script( 'frontend-form-js', docrt_plugin_url() . '/assets/js/docrt-frontend-user.js' , array('jquery'), '' );
    }

    // send ajax url
    wp_localize_script('main-js', 'ajax_params', array(
        'front_end' => true
    ));
}
add_action( 'wp_enqueue_scripts', 'docrt_load_scripts' );

/*****************************************************************************************
 * Set Option on install Plugin
 * docrt-document
 *****************************************************************************************/

function docrt_tax_list() {
    $terms_surat = get_terms( array(
        'taxonomy' => 'surat',
        'hide_empty' => false,
    ) );
    $all_terms_empty = false;
    if (!$terms_surat) $all_terms_empty = true;

    foreach ($terms_surat as $key => $v) {
        $terms_surat_array[$v->slug] = $v->name;
    }

    $terms = docrt_get_terms_active();
    foreach ($terms as $key => $value) {
        if ( !array_key_exists($key, $terms_surat_array) || $all_terms_empty) {
            wp_insert_term( $value, 'surat', $args = array('slug' => $key) );
        }
    }
}

function docrt_get_terms_active() {
    $terms = array(
        'sku'   => 'surat keterangan usaha',
        'skdu'  => 'surat keterangan domisili usaha ',
        'skd'   => 'surat keterangan domisili',
        'skik'  => 'surat keterangan ijin keramaian',
        'skck'  => 'surat keterangan catatan kepolisian',

        'sktm'  => 'surat keterangan tidak mampu',
        'skbpm' => 'surat keterangan balum pernah menikah',
        'skel'  => 'surat kelahiran',
        'skem'  => 'surat kematian',
        'skp'   => 'surat keterangan pindah',
        'skp_m' => 'surat keterangan pindah masuk',

        'sk'    => 'surat keterangan',
        'ktp'   => 'kartu tanda penduduk',

        // KK
        'kk'    => 'kartu keluarga',
        'kk_p'  => 'KK perubahan',
        'kk_t'  => 'KK tambah anggota keluarga',

        // Rekomendasi
        'r_u'   => 'recom umum',
        'r_ho'  => 'recom HO',
        'r_imb' => 'recom IMB',

        // Legalisir
        'lg'    => 'legalisir',
    );
    return $terms;
}

include_once __DIR__ . '/includes/form.php';
include_once __DIR__ . '/includes/types.php';
include_once __DIR__ . '/includes/types-perangkat.php';

// ===========================================================
// FRONT END =================================================
// ===========================================================
// Admin style
include_once __DIR__ . '/frontend/function-style-login.php';

//Front End Function, User Front End
include_once __DIR__ . '/frontend/function-frontend-user.php';

//Front End Function, User Front End
include_once __DIR__ . '/frontend/function-frontend-rw.php';

//Form RW POST TYPE
include_once __DIR__ . '/frontend/function-type-formrw.php';

// ===========================================================
// ===========================================================

add_filter( 'login_redirect', 'docrt_redirect_to_home', 10, 3 );
function docrt_redirect_to_home( $redirect_to, $request, $user ) {

    if( $user->roles[0] == 'author' ) {
        //If user author, redirect to home
        return get_home_url();
    } else {
        //If user ID is not 6, leave WordPress handle the redirection as usual
        return $redirect_to;
    }

}
