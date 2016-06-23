<?php

/* * * * * * * * * * * * * * * *
 *  Register custom post type RT/RW  *
 * * * * * * * * * * * * * * * */

function docrt_cpt_perangkat() {
    // RT/RW custom post type
    register_post_type('docrt-perangkat', array(
        'labels' => array(
            'name' => __( 'Perangkat Desa', 'docrt'),
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
                <td><input name="docrt_perangkat[nama]" type="text" class="docrt_inputs" id="docrt_perangkat_nama" value="'.$meta['nama'].'" /></td>
            </tr>
            <tr align="left">
                <th><label class="diy-label" for="docrt_perangkat_rt">RT</label></th>
                <td> : </td>
                <td><input name="docrt_perangkat[RT]" type="text" class="docrt_inputs" id="docrt_perangkat_rt" value="'.$meta['RT'].'" /></td>
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