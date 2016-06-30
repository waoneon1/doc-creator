<?php

/* * * * * * * * * * * * * * * *
 *  Register custom post type RT/RW  *
 * * * * * * * * * * * * * * * */

function docrt_cpt_perangkat() {
    // RT/RW custom post type
    register_post_type('docrt-perangkat', array(
        'labels' => array(
            'name' => __( 'List RT', 'docrt'),
            'singular_name' => __( 'Perangkat Desa', 'docrt' ),
            'add_new' => __( 'Tambah Baru' ),
            'add_new_item' => __( 'Tambah Perangkat Desa', 'docrt' ),
            'edit' => __( 'Edit', 'docrt' ),
            'edit_item' => __( 'Edit Perangkat Desa', 'docrt' ),
            'new_item' => __( 'Perangkat Desa Baru', 'docrt' ),
            'view' => __( 'View Perangkat Desa', 'docrt' ),
            'view_item' => __( 'View Perangkat Desa', 'docrt' ),
            'search_items' => __( 'Cari Perangkat Desa', 'docrt' ),
            'not_found' => __( 'Perangkat Desa Tidak ditemukan', 'docrt' ),
            'not_found_in_trash' => __( 'No Documents found in Trash', 'docrt' )
        ),
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'public' => true,
        'query_var' => true,
        'menu_position' => 20,
        'capability_type' => 'page',
        'supports'            => array( 'title','thumbnail'/*, 'comments', 'custom-fields', , 'publicize', 'wpcom-markdown'*/ ),
        'register_meta_box_cb'  => 'docrt_register_metaboxes_perangkat',
        'has_archive'       => 'docrt-perangkat',
        'hierarchical' => true,
        'show_in_menu' => true,
        'capability_type' => 'perangkat',
        'map_meta_cap' => true
    ));

}
add_action('init', 'docrt_cpt_perangkat');

/**
 * Adds a submenu page under a custom post type parent.
 */
add_action('admin_menu', 'docrt_report_page');
function docrt_report_page() {
    if (current_user_can('manage_options')) {
         add_submenu_page(
            'edit.php?post_type=docrt-perangkat',
            'Laporan',
            'Laporan',
            'read',
            'docrt-report',
            'docrt_report_page_callback'
        );
    }
}

/**
 * Display callback for the submenu page.
 */
function docrt_report_page_callback() {
    global $post;
    //docrt_report_page_func();
    ?>
    <div class="wrap">
        <h1>Laporan</h1>
        <form name="post" action="edit.php?post_type=docrt-perangkat&page=docrt-report" method="post" id="post" autocomplete="off" target="_blank">
        <?php printf('<input type="hidden" name="docrt_nonce_report" value="%s" />', wp_create_nonce(plugin_basename(__FILE__))); ?>

        <table class="wp-list-table widefat fixed striped pages laporan-tbl">
            <tbody>
                <tr>
                    <td width="150"><strong>Jenis Surat</strong></td>
                    <td width="20"> : </td>
                    <td>
                    <select name="docrt_report[jenis_surat]">
                        <?php foreach (docrt_get_all_term() as $key => $v) {
                            echo '<option value="'.$v->slug.'" >'.$v->name.'</option>';
                        } ?>

                    </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>Sesudah Tanggal : </strong></td>
                    <td> : </td>
                    <td><input name="docrt_report[date_after]" type="date" class="docrt_inputs" id="docrt_perangkat_nama" value="<?php echo date("Y-m-d", strtotime('first day of this month')) ?>" /></td>
                </tr>
                <tr>
                    <td><strong>Sebelum Tanggal</strong></td>
                    <td> : </td>
                    <td><input name="docrt_report[date_before]" type="date" class="docrt_inputs" id="docrt_perangkat_nama" value="<?php echo date("Y-m-d", time()) ?>" /></td>
                </tr>
                <tr>
                    <td><input name="docrt_submit_report" type="submit" class="button button-primary button-large" id="make_report" value="Buat Laporan"></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        </form>
    </div>
    <?php
}

add_action('wp_loaded', 'docrt_report_page_func', 40);
function docrt_report_page_func() {

    //   verify the nonce
    if ( !isset($_POST['docrt_nonce_report']) || !wp_verify_nonce( $_POST['docrt_nonce_report'], plugin_basename(__FILE__) ) ) return;
    //  don't try to save the data under autosave, ajax, or future post.
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( defined('DOING_AJAX') && DOING_AJAX ) return;
    if ( defined('DOING_CRON') && DOING_CRON ) return;

    //  is the user allowed to edit the URL?
    if ( ! current_user_can( 'edit_posts' ) || $_GET['post_type'] != 'docrt-perangkat' || $_GET['page'] != 'docrt-report' )
        return;

    $jenis_surat = $_POST['docrt_report']['jenis_surat'];
    $date_after = $_POST['docrt_report']['date_after'];
    $date_before = $_POST['docrt_report']['date_before'];

    if ($date_after > $date_before) {
       return;
    } else {
        wp_redirect(docrt_plugin_url() . '/includes/docrt_report_pdf_create.php?jenis_surat='.$jenis_surat.'&date_after='.$date_after.'&date_before='.$date_before);
    }

    exit;
}

/* * * * * * * * * * * * * * * *
 *    META BOX docrt-perangkat  *
 * * * * * * * * * * * * * * * */
function docrt_register_metaboxes_perangkat() {
    add_meta_box( 'docrt_perangkat_desa',__( 'Data Perangkat Desa', 'docrt' ), 'docrt_perangkat_desa_box', 'docrt-perangkat', 'normal', 'default');
}

function docrt_perangkat_desa_box() {
    global $post;
    $meta = get_post_meta($post->ID, 'docrt_perangkat', true);
    $docrt_saksi = docrt_get_saksi_form('',@$meta['jabatan_rw']);

    printf( '<input type="hidden" name="docrt_nonce" value="%s" />', wp_create_nonce( plugin_basename(__FILE__) ) );
    echo '<table class="docrt_pemohon_box docrt_tbl docrt_tp_sku">';
        echo '<tbody class="">';
            echo '
            <tr align="left">
                <th><label class="diy-label" for="docrt_perangkat_nama">Nama Lengkap</label></th>
                <td> : </td>
                <td><input name="docrt_perangkat[nama]" type="text" class="docrt_inputs" id="docrt_perangkat_nama" value="'.@$meta['nama'].'" /></td>
            </tr>
            <tr align="left">
                <th><label class="diy-label" for="docrt_perangkat_nik">NIK</label></th>
                <td> : </td>
                <td><input name="docrt_perangkat[nik]" type="text" class="docrt_inputs" id="docrt_perangkat_nik" value="'.@$meta['nik'].'" /></td>
            </tr>
            <tr align="left">
                <th><label class="diy-label" for="docrt_perangkat_tl">Tanggal Lahir</label></th>
                <td> : </td>
                <td><input name="docrt_perangkat[tl]" type="date" class="docrt_inputs" id="docrt_perangkat_tl" value="'.@$meta['tl'].'" /></td>
            </tr>
            <tr align="left">
                <th><label class="diy-label" for="docrt_perangkat_pekerjaan">Pekerjaan</label></th>
                <td> : </td>
                <td><input name="docrt_perangkat[pekerjaan]" type="text" class="docrt_inputs" id="docrt_perangkat_pekerjaan" value="'.@$meta['pekerjaan'].'" /></td>
            </tr>
            <tr align="left">
                <th><label class="diy-label" for="docrt_perangkat_telepon">Telepon</label></th>
                <td> : </td>
                <td><input name="docrt_perangkat[telepon]" type="text" class="docrt_inputs" id="docrt_perangkat_telepon" value="'.@$meta['telepon'].'" /></td>
            </tr>
            <tr align="left">
                <th><label class="diy-label" for="docrt_perangkat_alamat">Alamat</label></th>
                <td> : </td>
                <td>
                    <textarea rows="3" name="docrt_perangkat[alamat]" class="docrt_inputs" id="docrt_perangkat_alamat">'.@$meta['alamat'].'</textarea>.
                </td>
            </tr>
            <tr align="left">
                <th><label class="diy-label" for="docrt_perangkat_jabatan">Jabatan</label></th>
                <td> : </td>
                <td>
                <select class="docrt_inputs" name="docrt_perangkat[jabatan]" id="docrt_perangkat_jabatan" >
                  <option value="RT" >RT</option>
                  <option value="RW" '.((@$meta['jabatan'] == 'RW') ? 'selected' : '').'>RW</option>
                </select>
                <input name="docrt_perangkat[no_jabatan]" type="text" class="docrt_inputs half" id="docrt_perangkat_no_jabatan" value="'.@$meta['no_jabatan'].'" />

                <select class="docrt_inputs" name="docrt_perangkat[jabatan_rw]" id="docrt_perangkat_jabatan_rw" >
                  '.$docrt_saksi['RW'].'
                </select>
                <input name="docrt_perangkat[no_jabatan_rw]" type="hidden" id="docrt_perangkat_no_jabatan_rw" value="" />
                </td>
            </tr>';
        echo '</tbody>';
    echo '</table>';
    /*<tr align="left">
        <th><label class="diy-label" for="docrt_perangkat_kelurahan"> - Desa/Kelurahan</label></th>
        <td> : </td>
        <td><input name="docrt_perangkat[kelurahan]" type="text" class="docrt_inputs" id="docrt_perangkat_kelurahan" value="'.@$meta['kelurahan'].'" /></td>
    </tr>
    <tr align="left">
        <th><label class="diy-label" for="docrt_perangkat_kecamatan"> - Kecamatan</label></th>
        <td> : </td>
        <td><input name="docrt_perangkat[kecamatan]" type="text" class="docrt_inputs" id="docrt_perangkat_kecamatan" value="'.@$meta['kecamatan'].'" /></td>
    </tr>
    <tr align="left">
        <th><label class="diy-label" for="docrt_perangkat_kota"> - Kab/Kota</label></th>
        <td> : </td>
        <td><input name="docrt_perangkat[kota]" type="text" class="docrt_inputs" id="docrt_perangkat_kota" value="'.@$meta['kota'].'" /></td>
    </tr>
    <tr align="left">
        <th><label class="diy-label" for="docrt_perangkat_provinsi"> - Provinsi</label></th>
        <td> : </td>
        <td><input name="docrt_perangkat[provinsi]" type="text" class="docrt_inputs" id="docrt_perangkat_provinsi" value="'.@$meta['provinsi'].'" /></td>
    </tr>*/

}
// END METABOX +++++++++++++++++++++++++++++++++++++++++++++++++++++

// SAVE METABOX
function docrt_save_meta_perangkat($post_id, $post) {

   //   verify the nonce
    if ( !isset($_POST['docrt_nonce']) || !wp_verify_nonce( $_POST['docrt_nonce'], plugin_basename(__FILE__) ) ) return;

    //  don't try to save the data under autosave, ajax, or future post.
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( defined('DOING_AJAX') && DOING_AJAX ) return;
    if ( defined('DOING_CRON') && DOING_CRON ) return;

    //  is the user allowed to edit the URL?
    if ( ! current_user_can( 'edit_posts' ) || $post->post_type != 'docrt-perangkat' )
        return;

    $docrt_perangkat = $_POST['docrt_perangkat'];
    update_post_meta($post->ID, 'docrt_perangkat', $docrt_perangkat);

}
add_action('save_post', 'docrt_save_meta_perangkat', 1, 2);