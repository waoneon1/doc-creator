<?php
/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
# LIST RT
# LAPORAN
# TTD SETTING
# DATA DASAR

--------------------------------------------------------------*/


/*****************************************************************************************
 * Register custom post type Form RW
 * MENU : # LIST RT
 *****************************************************************************************/
add_action('init', 'docrt_cpt_formrw');
function docrt_cpt_formrw() {
    // RT/RW custom post type
    register_post_type('docrt-formrw', array(
        'labels' => array(
            'name' => __( 'Form RW', 'docrt'),
            'singular_name' => __( 'Form RW', 'docrt' ),
            'add_new' => __( 'Tambah Baru' ),
            'add_new_item' => __( 'Tambah Form RW', 'docrt' ),
            'edit' => __( 'Edit', 'docrt' ),
            'edit_item' => __( 'Edit Form RW', 'docrt' ),
            'new_item' => __( 'Form RW Baru', 'docrt' ),
            'view' => __( 'View Form RW', 'docrt' ),
            'view_item' => __( 'View Form RW', 'docrt' ),
            'search_items' => __( 'Cari Form RW', 'docrt' ),
            'not_found' => __( 'Form RW Tidak ditemukan', 'docrt' ),
            'not_found_in_trash' => __( 'No Documents found in Trash', 'docrt' )
        ),
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'public' => true,
        'query_var' => true,
        'menu_position' => 20,
        'capability_type' => 'page',
        'supports' => array( 'title'/*, 'comments', 'custom-fields', , 'publicize', 'wpcom-markdown'*/ ),
        'register_meta_box_cb'  => 'docrt_register_metaboxes_formrw',
        'has_archive' => 'docrt-formrw',
        'hierarchical' => true,
        'show_in_menu' => true,
        'capability_type' => 'formrw',
        'map_meta_cap' => true
    ));
}
function docrt_register_metaboxes_formrw() {
    add_meta_box( 'docrt_formrw',__( 'Data Form RW', 'docrt' ), 'docrt_formrw_box', 'docrt-formrw', 'normal', 'default');
}
function docrt_formrw_box() {
    global $post;

    ?><script type="text/javascript">
        var ajax_url = <?php echo '"'.docrt_plugin_url() . '/ajax' . '/"' ?>;
        var post_id  = <?php echo $post->ID ?>;
        var cpt_type = <?php echo '"formrw"' ?>;
    </script><?php
    printf( '<input type="hidden" name="docrt_nonce" value="%s" />', wp_create_nonce( plugin_basename(__FILE__) ) );
    $terms = docrt_get_terms_active();
    $meta = get_post_meta($post->ID , 'docrt_form', true);
    $meta_rw = get_post_meta($post->ID , 'docrt_formrw_rw', true);
    $type_surat = get_post_meta($post->ID , 'docrt_formrw_type', true); ?>

    <div class="updated notice notice-success" style="
    background-color: #dcffdc;
    padding: 10px;
    color: green;">
        Permohonan <b><?php echo $terms[$type_surat] ?></b> telah di verifikasi oleh <b><?php echo strtoupper($meta_rw) ?></b>
    </div>

    <?php // tabel permohonan
    echo "<pre>";
    print_r( get_role( 'author' ));
    //print_r(get_user_meta(4));
    echo '<form action="" method="post" id="docrt_formrw_to_doc">'; ?>

        <input type="hidden" name="docrt_formrw_submit_to_doc" id="docrt_formrw_submit_to_doc" value="true" />
        <?php wp_nonce_field( 'post_nonce', 'post_nonce_field' );

        echo '<input type="submit" class="button button-primary button-large" value="Verifikasi dan masukkan ke Buat Document">';
        echo '<table class="docrt_tbl docrt_pemohon_box table table-striped">';
        echo '<tbody>';
        foreach ($meta as $key => $value) {

            $meta_param[$key][0] = $value;
            if (function_exists($key)) {
              $return_tr = call_user_func_array($key, array($meta_param, $type_surat, $cpt_type));
            } else {
              $return_tr = 'Form <b>'.$key.'</b> Hilang';
            }

            $lab = explode('<td> : </td>', $return_tr);
            $label = trim(strip_tags($lab[0]));

            echo '<tr>';
                echo '<td>'.$label.'</td>';
                echo '<td> : </td>';
                echo '<td>'.$value.'</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    echo '</form>';

}
add_action('save_post', 'docrt_save_meta_formrw', 1, 2);
function docrt_save_meta_formrw($post_id, $post) {

/*   //   verify the nonce
    if ( !isset($_POST['docrt_nonce']) || !wp_verify_nonce( $_POST['docrt_nonce'], plugin_basename(__FILE__) ) ) return;

    //  don't try to save the data under autosave, ajax, or future post.
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( defined('DOING_AJAX') && DOING_AJAX ) return;
    if ( defined('DOING_CRON') && DOING_CRON ) return;

    //  is the user allowed to edit the URL?
    if ( ! current_user_can( 'edit_posts' ) || $post->post_type != 'docrt-formrw' )
        return;

    $docrt_formrw = $_POST['docrt_formrw'];
    update_post_meta($post->ID, 'docrt_formrw', $docrt_formrw);*/
}

function docrt_save_formrw_to_document()
{
    if (isset($_POST['docrt_formrw_submit_to_doc']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {

        //  don't try to save the data under autosave, ajax, or future post.
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
        if ( defined('DOING_AJAX') && DOING_AJAX ) return;
        if ( defined('DOING_CRON') && DOING_CRON ) return;

        //  is the user allowed to edit the URL?
        if ( ! current_user_can( 'edit_posts' ) || $_POST['post_type']  != 'docrt-formrw' )
            return;

        $ID = $_POST['post_ID'];
        $meta = get_post_meta($ID , 'docrt_form', true);
        $meta_rw = get_post_meta($ID , 'docrt_formrw_rw', true);
        $type_surat = get_post_meta($ID , 'docrt_formrw_type', true);
        $meta_acc = get_post_meta($ID , 'docrt_formrw_acc', true);

       /* echo "<pre>";
        print_r($meta);
        print_r($_POST); exit();*/

        // update no surat
        $option_name = 'docrt_'.$type_surat;
        $current_surat_id = get_option($option_name);
        $current_surat_id = $current_surat_id + 1;
        update_option( $option_name, $current_surat_id);

        // save permohonan
        $post_information = array(
            'post_title' => $meta['docrt_form_nama'],
            'post_type' => 'docrt-document',
            'post_status' => 'publish'
        );
        $conf_id = wp_insert_post($post_information);

        // save term
        wp_set_object_terms( $conf_id, $type_surat, 'surat' );

        // save form meta
        foreach ($meta as $key => $value) {
            if ( $value ) {
                update_post_meta($conf_id, $key, $value);
            } elseif ($value === null) {
            } else  {
                delete_post_meta($conf_id, $key);
            }
        }

        // save other meta
        update_post_meta($conf_id, 'docrt_jenis_ttd', 'lurah');
        update_post_meta($conf_id, 'docrt_type_surat', $type_surat);
        update_post_meta($conf_id, 'docrt_'.$type_surat.'_id', $current_surat_id);

        update_post_meta($conf_id, 'docrt_formrw_rw', $meta_rw);
        update_post_meta($conf_id, 'docrt_formrw_type', $type_surat);
        update_post_meta($conf_id, 'docrt_formrw_acc', $meta_acc);

        // delete permohonan
        wp_delete_post( $ID , true);


        wp_redirect(admin_url( 'post.php?post='.$conf_id.'&action=edit'));
        exit;
    }
}
add_action('wp_loaded', 'docrt_save_formrw_to_document', 40);


// SETTING =======================================================
function docrt_show_only_verify_document( $query ) {

    if ( is_post_type_archive( 'docrt-formrw' ) && is_admin()) {
        // Display 50 posts for a custom post type called 'movie'
        $query->set('meta_key', 'docrt_formrw_acc');
        $query->set('meta_value', 'yes');
        return;
    }
}
add_action( 'pre_get_posts', 'docrt_show_only_verify_document', 1 );

/*function docrt_show_author($columns) {
    if ( is_post_type_archive( 'docrt-formrw' ) && is_admin()) {
        return array_merge( $columns, array('author' => __('Author')) );
    }
}
add_filter('manage_posts_columns' , 'docrt_show_author');*/

