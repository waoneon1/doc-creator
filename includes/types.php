<?php

/* * * * * * * * * * * * * * * *
 *  Register custom post type  *
 * * * * * * * * * * * * * * * */

function docrt_register_custom_post_types() {
    // PRODUCT custom post type
    register_post_type('docrt-document', array(
        'labels' => array(
            'name' => __( 'Buat Document', 'docrt'),
            'singular_name' => __( 'Documents', 'docrt' ),
            'add_new' => __( 'Buat Surat' ),
            'add_new_item' => __( 'Add New Document', 'docrt' ),
            'edit' => __( 'Edit', 'docrt' ),
            'edit_item' => __( 'Edit Document', 'docrt' ),
            'new_item' => __( 'New Document', 'docrt' ),
            'view' => __( 'View Document', 'docrt' ),
            'view_item' => __( 'View Document', 'docrt' ),
            'search_items' => __( 'Search Documents', 'docrt' ),
            'not_found' => __( 'No Documents found', 'docrt' ),
            'not_found_in_trash' => __( 'No Documents found in Trash', 'docrt' )
        ),
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'public' => true,
        'query_var' => true,
        'menu_position' => 20,
        'capability_type' => 'page',
        'supports'            => array( 'title'/*, 'comments', 'custom-fields', , 'publicize', 'wpcom-markdown'*/ ),
        'register_meta_box_cb'  => 'docrt_register_metaboxes',
        'has_archive'       => 'docrt-document',
        'rewrite'          => array(
            'slug' => 'product-generator'
        ),
        'hierarchical' => true,
        'show_in_menu' => true,
        'capability_type' => 'docrt',
        'map_meta_cap' => true
    ));

}
add_action('init', 'docrt_register_custom_post_types');

// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'docrt_doc_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function docrt_doc_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Jenis Surat', 'taxonomy general name' ),
        'singular_name'     => _x( 'Surat', 'taxonomy singular name' ),
        'search_items'      => __( 'Cari Surat' ),
        'all_items'         => __( 'Semua Jenis Surat' ),
        'parent_item'       => __( 'Parent Surat' ),
        'parent_item_colon' => __( 'Parent Surat:' ),
        'edit_item'         => __( 'Edit Surat' ),
        'update_item'       => __( 'Update Surat' ),
        'add_new_item'      => __( 'Tambah Surat Baru' ),
        'new_item_name'     => __( 'Tambah Nama Surat Baru' ),
        'menu_name'         => __( 'Surat' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => false,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'surat' ),
    );

    register_taxonomy( 'surat', array( 'docrt-document' ), $args );
}
/*function register_post_type_with_rewrite_rules($post_type, $post_type_args = array(), $permalink_args = array()) {
  new Custom_Post_Type_With_Rewrite_Rules($post_type, $post_type_args, $permalink_args);
}*/

/* * * * * * * * * * * * * * * *
 *    META BOX docrt-document  *
 * * * * * * * * * * * * * * * */
function docrt_register_metaboxes() {
    add_meta_box( 'docrt_pemohon',__( 'Data Pemohon', 'docrt' ), 'docrt_pemohon_box', 'docrt-document', 'normal', 'default');
    add_meta_box( 'docrt_type_surat', __( 'Tipe Surat', 'docrt' ), 'docrt_type_surat_box', 'docrt-document', 'side', 'low' );
    add_meta_box( 'docrt_ttd', __( 'Tanda Tangan', 'docrt' ), 'docrt_ttd_box', 'docrt-document', 'side', 'low' );
    add_meta_box( 'docrt_buat_pdf', __( 'Buat PDF', 'docrt' ), 'docrt_buat_pdf_box', 'docrt-document', 'side', 'low' );
}

function docrt_get_all_term($tax = 'surat') {
    return $terms = get_terms( array(
        'taxonomy' => $tax,
        'hide_empty' => false,
    ) );
}

function docrt_pemohon_box() {
    global $post;
    $post_term = get_the_terms ($post->ID,'surat' );

    printf( '<input type="hidden" name="docrt_nonce" value="%s" />', wp_create_nonce( plugin_basename(__FILE__) ) );
    echo '<input type="hidden" id="docrt_tysrt_form" name="docrt_type_surat" value="" />' ;
    echo '<input type="hidden" id="docrt_tysrt_form" name="docrt_type_surat" value="" />' ;

    include "docrt_form.php";
}
function docrt_type_surat_box($post) {

    $checked1 = $checked2 = '';
    $taxonomy = 'surat';
    $term_args = array(
      'hide_empty' => false,
      'orderby' => 'name',
      'order' => 'ASC'
    );

    $tax_terms = get_terms($taxonomy,$term_args);
    $post_term = get_the_terms ($post->ID,$taxonomy );

    echo '<table class="docrt_type_surat_box">';
    if ($post_term) {
         echo '<tr align="left">
                <th><input type="radio" name="tax_input[surat][]" value="'.$post_term[0]->term_id.'" data-typesurat="'.$post_term[0]->slug.'" '.'checked'.'></th>
                <td>'.$post_term[0]->name.'</td>
            </tr>';
    } else {
        foreach ($tax_terms as $key => $v) {
            $checked = ($post_term[0]->term_id == $v->term_id) ? 'checked' : '';
            echo '<tr align="left" class="strip">
                <th><input type="radio" name="tax_input[surat][]" value="'.$v->term_id.'" data-typesurat="'.$v->slug.'" '.$checked.' required></th>
                <td>'.$v->name.'</td>
            </tr>';
        }
    }
    echo '</table>';

}

function docrt_ttd_box($post) {
    $ttd = array(
        'Lurah' => 'lurah', 'Seklur' => 'seklur'
    );
    $meta = get_post_meta($post->ID, 'docrt_jenis_ttd', true);
    echo '<table class="docrt_ttd_box">';
    foreach ($ttd as $key => $value) {
        $checked = ($meta == $value) ? 'checked' : '';
        echo '<tr align="left">
            <th><input type="radio" name="docrt_jenis_ttd" value="'.$value.'" data-ttd="'.$value.'" '.$checked.' required></th>
            <td>'.$key.'</td>
        </tr>';
    }
    echo '</table>';
}
function docrt_buat_pdf_box($post) {
    echo '<a href="'.docrt_plugin_url() .'/includes/docrt_pdf_create.php?pid='.$post->ID.'" class="button button-primary button-large" target="_blank">Buat PDF</a>';
}
// END METABOX +++++++++++++++++++++++++++++++++++++++++++++++++++++

// SAVE METABOX
function docrt_save_meta($post_id, $post) {

   //   verify the nonce
    if ( !isset($_POST['docrt_nonce']) || !wp_verify_nonce( $_POST['docrt_nonce'], plugin_basename(__FILE__) ) ) return;

    //  don't try to save the data under autosave, ajax, or future post.
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( defined('DOING_AJAX') && DOING_AJAX ) return;
    if ( defined('DOING_CRON') && DOING_CRON ) return;

    //  is the user allowed to edit the URL?
    if ( ! current_user_can( 'edit_posts' ) || $post->post_type != 'docrt-document' )
        return;
    $option_name = 'docrt_'.$_POST['docrt_type_surat'];

    if( ( $_POST['post_status'] == 'publish' ) && ( $_POST['original_post_status'] != 'publish' ) ) {
        $current_surat_id = get_option($option_name);
        $current_surat_id = $current_surat_id + 1;
        update_option( $option_name, $current_surat_id);
        $_POST['docrt_'.$_POST['docrt_type_surat'].'_id'] = $current_surat_id;
    }
    $fields = docrt_get_form_surat();
    //pretty_print($_POST); exit;
    //pretty_print($fields); exit;
    foreach ($fields as $field) {

        if ( $_POST[$field] ) {
            //  save/update
            update_post_meta($post->ID, $field, $_POST[$field]);
        } elseif ($_POST[$field] === null) {
            //  dont have this field
        } else  {
            //  delete if blank
            delete_post_meta($post->ID, $field);
        }
    }

}
add_action('save_post', 'docrt_save_meta', 1, 2);

function pretty_print($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function docrt_get_form_surat($type_surat = 'sku') {
    $fields = array(
    'docrt_jenis_ttd',
    'docrt_form_nama',
    'docrt_form_ttl',
    'docrt_form_jk',
    'docrt_form_kebangsaan',
    'docrt_form_agama',
    'docrt_form_sperkawinan',
    'docrt_form_nokk',
    'docrt_form_nonik',
    'docrt_form_pekerjaan',
    'docrt_form_pendidikan',
    'docrt_form_goldarah',
    'docrt_form_umur',
            'docrt_form_keperluan',
            'docrt_form_tujuan',
            'docrt_form_tgl_berlaku',
            'docrt_form_ketRT',
            'docrt_form_ket_usaha',
            'docrt_form_tempat',
            'docrt_form_sebab_kematian',
    'docrt_form_alamat',
    'docrt_form_rtrw',
    'docrt_form_kelurahan',
    'docrt_form_kecamatan',
    'docrt_form_kota',
    'docrt_form_provinsi',
    'docrt_form_tgl',
            'docrt_form_nama_mati',
            'docrt_form_hubungan',
            'docrt_form_nama_usaha',
            'docrt_form_alamat_usaha',
            'docrt_form_nama_noinduk_lembaga',
            'docrt_form_noinduk_lembaga',
            'docrt_form_nama_lembaga',
            'docrt_form_nama_acara',
            'docrt_form_tgl_acara',
    'docrt_form_desa_pindah',
    'docrt_form_kecamatan_pindah',
    'docrt_form_kabkota_pindah',
    'docrt_form_provinsi_pindah',
    'docrt_form_tgl_pindah',
    'docrt_form_alasan_pindah',
    'docrt_form_pengikut',
        'docrt_form_nama_bayi',
        'docrt_form_dilahirkan1',
        'docrt_form_dilahirkan2',
        'docrt_form_dilahirkan3',
        'docrt_form_kelahiran',
        'docrt_form_kembarke',
        'docrt_form_nama_ibu',
        'docrt_form_nama_ayah',
        'docrt_form_penolong_lahir',
        'docrt_form_alamat_ibu',
        'docrt_form_kebangsaan_ibu',
        'docrt_form_kebangsaan_ayah',
        'docrt_form_nokk_ayah',
        'docrt_form_nonik_ayah',

    );

    $docrt_get_all_term = docrt_get_all_term();
    foreach ($docrt_get_all_term as $key => $t) {
        $fields[] = 'docrt_'.$t->slug.'_id';
    }

    // data pengikut pindahan
    for ($i=1; $i <= 20; $i++) {
        $fields[] = 'docrt_pengikut_nama'.$i;
        $fields[] = 'docrt_pengikut_jk'.$i;
        $fields[] = 'docrt_pengikut_lahir'.$i;
        $fields[] = 'docrt_pengikut_status'.$i;
        $fields[] = 'docrt_pengikut_pendidikan'.$i;
        $fields[] = 'docrt_pengikut_nik'.$i;
        $fields[] = 'docrt_pengikut_keterangan'.$i;
    }
    return $fields;
}