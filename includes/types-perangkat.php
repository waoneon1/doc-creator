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

function hide_add_new_custom_type()
{
    global $submenu, $menu;

    $menu[22][0] = 'Admin Tools';
    unset($submenu['edit.php?post_type=docrt-perangkat'][10]);

}
add_action('admin_menu', 'hide_add_new_custom_type');

/**
 * Adds a submenu page under a custom post type parent.
 */
add_action('admin_menu', 'docrt_report_page');
function docrt_report_page() {
    add_submenu_page(
        'edit.php?post_type=docrt-perangkat',
        'Laporan',
        'Laporan',
        'read',
        'docrt-report',
        'docrt_report_page_callback'
    );
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
        <form name="post" action="edit.php?post_type=docrt-perangkat&page=docrt-report" method="post" id="post" autocomplete="off">
        <?php printf('<input type="hidden" name="docrt_nonce_report" value="%s" />', wp_create_nonce(plugin_basename(__FILE__))); ?>
        <?php echo date("Y-m-1", strtotime('NOW')); ?>
        <?php echo date("Y-m-d", time()); ?>
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
    printf( '<input type="hidden" name="docrt_nonce" value="%s" />', wp_create_nonce( plugin_basename(__FILE__) ) );
    echo '<table class="docrt_pemohon_box docrt_tbl docrt_tp_sku">';
        echo '<tbody class="">';
            echo '
            <tr align="left">
                <th><label class="diy-label" for="docrt_perangkat_nama">Nama</label></th>
                <td> : </td>
                <td><input name="docrt_perangkat[nama]" type="text" class="docrt_inputs" id="docrt_perangkat_nama" value="'.@$meta['nama'].'" /></td>
            </tr>
            <tr align="left">
                <th><label class="diy-label" for="docrt_perangkat_rt">RT</label></th>
                <td> : </td>
                <td><input name="docrt_perangkat[RT]" type="text" class="docrt_inputs" id="docrt_perangkat_rt" value="'.@$meta['RT'].'" /></td>
            </tr>
            <tr align="left">
                <th><label class="diy-label" for="docrt_perangkat_rw">RW</label></th>
                <td> : </td>
                <td><input name="docrt_perangkat[RW]" type="text" class="docrt_inputs" id="docrt_perangkat_rw" value="'.@$meta['RW'].'" /></td>
            </tr>';
        echo '</tbody>';
    echo '</table>';


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