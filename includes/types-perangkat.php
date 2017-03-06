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
 * Register custom post type RT/RW
 * MENU : # LIST RT
 *****************************************************************************************/
add_action('init', 'docrt_cpt_perangkat');
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
function docrt_register_metaboxes_perangkat() {
    add_meta_box( 'docrt_perangkat_desa',__( 'Data Perangkat Desa', 'docrt' ), 'docrt_perangkat_desa_box', 'docrt-perangkat', 'normal', 'default');
}
function docrt_perangkat_desa_box() {
    global $post;
    $meta = get_post_meta($post->ID, 'docrt_perangkat', true);
    $docrt_saksi = docrt_get_saksi_form('',@$meta['jabatan_rw']);
    ?><script type="text/javascript">
        var ajax_url = <?php echo '"'.docrt_plugin_url() . '/ajax' . '/"' ?>;
        var post_id  = <?php echo $post->ID ?>;
        var cpt_type = <?php echo '"perangkat"' ?>;
    </script><?php
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
                <td><input name="docrt_perangkat[tl]" type="text" class="docrt_inputs docrt_datepicker" id="docrt_perangkat_tl" value="'.@$meta['tl'].'" /></td>
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
}
add_action('save_post', 'docrt_save_meta_perangkat', 1, 2);
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

/*****************************************************************************************
 * Submenu Laporan
 * MENU : # LAPORAN
 *****************************************************************************************/
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
    if ( ! current_user_can( 'edit_posts' )
        || $_GET['post_type'] != 'docrt-perangkat'
        || $_GET['page'] != 'docrt-report' )
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

/*****************************************************************************************
 * Setting ttd yang muncul di Buat Surat
 * MENU : # TTD SETTING
 *****************************************************************************************/
add_action('admin_menu', 'docrt_ttd_setting');
function docrt_ttd_setting() {
    if (current_user_can('manage_options')) {
         add_submenu_page(
            'edit.php?post_type=docrt-perangkat',
            'TTD Setting',
            'TTD Setting',
            'read',
            'docrt-ttd',
            'docrt_ttd_setting_callback'
        );
    }
}
function docrt_ttd_setting_callback() {
    global $post;
    $options = get_option('docrt_list_ttd_perangkat');
    $ttd = unserialize(DOCRT_TTD);
    ?>
    <div class="wrap">
        <h1>TTD Setting</h1>
        <p>List Dengan tanda check akan muncul di "Buat Document"</p>
        <form name="post" action="edit.php?post_type=docrt-perangkat&page=docrt-ttd" method="post" id="post" autocomplete="off">
        <?php printf('<input type="hidden" name="docrt_nonce_ttd_perangkat" value="%s" />', wp_create_nonce(plugin_basename(__FILE__))); ?>
        <input type="submit" name="ttd_submit" value="submit" class="button-primary button-large button-fullwidth button-ttd-submit" />
        <?php foreach ($ttd as $key => $value) { $ttd_slug = strtolower($value); ?>
            <div class="ttd_box">
                <input class="ttd_box_checkbox" type="checkbox"  name="ttd_checkbox[<?php echo $ttd_slug ?>]" value="<?php echo $value ?>" <?php checked( @$options[$ttd_slug], $value ); ?>/>
                <div class="ttd_box_desc"><?php echo $value ?></div>
            </div>
        <?php } ?>

        <style type="text/css">
            .ttd_box {
                position: relative;
                font-weight: 800;
                width: 100%;
                padding: 10px;
                background-color: #fff;
                display: inline-block;
                box-shadow: 1px 0px 12px 2px #e3e3e3;
                box-sizing: border-box;
            }
            .ttd_box .ttd_box_desc {
                float: left;
                background-color: #e3e3e3;
                width: 90%;
                padding: 10px;
                cursor: pointer;
            }
            .ttd_box .ttd_box_checkbox {
                float: left;
                margin: 10px 20px 10px 10px;
            }
            input.button-primary.button-large.button-fullwidth.button-ttd-submit {
                margin-bottom: 7px;
            }
        </style>
        <strong></strong>
        </form>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                $(document).on("click", ".ttd_box .ttd_box_desc", function(e){
                    $(this).parent().find("input.ttd_box_checkbox").trigger("click");
                });
            });
        </script>
    </div>
    <?php
}
add_action('wp_loaded', 'docrt_ttd_save', 40);
function docrt_ttd_save() {
    //   verify the nonce
    if ( !isset($_POST['docrt_nonce_ttd_perangkat']) || !wp_verify_nonce( $_POST['docrt_nonce_ttd_perangkat'], plugin_basename(__FILE__) ) ) return;
    //  don't try to save the data under autosave, ajax, or future post.
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( defined('DOING_AJAX') && DOING_AJAX ) return;
    if ( defined('DOING_CRON') && DOING_CRON ) return;

    //  is the user allowed to edit the URL?
    if ( ! current_user_can( 'edit_posts' )
        || $_GET['post_type'] != 'docrt-perangkat'
        || $_GET['page'] != 'docrt-ttd' )
    return;

    update_option( 'docrt_list_ttd_perangkat', $_POST['ttd_checkbox']);
}
/*****************************************************************************************
 * Option awal
 * MENU : # DATA DASAR
 *****************************************************************************************/
add_action('admin_menu', 'docrt_data_dasar');
function docrt_data_dasar() {
    if (current_user_can('manage_options')) {
         add_submenu_page(
            'edit.php?post_type=docrt-perangkat',
            'Data Dasar',
            'Data Dasar',
            'read',
            'docrt-data-dasar',
            'docrt_data_dasar_callback'
        );
    }
}
function docrt_data_dasar_callback() { ?>

<div id="data_dasar_tabs" style="display: none;">
  <ul>
    <li><a href="#data_dasar_tabs-1">Data Dasar</a></li>
    <li><a href="#data_dasar_tabs-2">List Surat</a></li>
    <li><a href="#data_dasar_tabs-3">TTD Setting</a></li>
  </ul>
  <div id="data_dasar_tabs-1">
    <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
  </div>
  <div id="data_dasar_tabs-2">
    <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
  </div>
  <div id="data_dasar_tabs-3">
    <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
    <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
  </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $( function() {
            $( "#data_dasar_tabs" ).show().tabs();
        } );
    });
</script>
<?php
}
add_action('wp_loaded', 'docrt_data_dasar_save', 40);
function docrt_data_dasar_save() {
    //   verify the nonce
    if ( !isset($_POST['docrt_nonce_ttd_perangkat']) || !wp_verify_nonce( $_POST['docrt_nonce_ttd_perangkat'], plugin_basename(__FILE__) ) ) return;
    //  don't try to save the data under autosave, ajax, or future post.
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( defined('DOING_AJAX') && DOING_AJAX ) return;
    if ( defined('DOING_CRON') && DOING_CRON ) return;

    //  is the user allowed to edit the URL?
    if ( ! current_user_can( 'edit_posts' )
        || $_GET['post_type'] != 'docrt-perangkat'
        || $_GET['page'] != 'docrt-ttd' )
    return;

    update_option( 'docrt_list_ttd_perangkat', $_POST['ttd_checkbox']);
}

