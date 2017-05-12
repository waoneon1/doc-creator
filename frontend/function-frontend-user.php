<?php

function docrt_frontend_user_interface() {
    if (is_user_logged_in()) return;
    ?>
    <div class="container">
        <div class="col-md-12">
           <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12">
                 <?php docrt_type_surat_box_frontend_select() ?>
                 <?php docrt_type_surat_box_frontend() ?>
               </div>

               <div class="col-lg-12 col-md-12 col-sm-12">
                 <form class="form-horizontal" action="" method="post"  id="docrt_formrw">
                   <!-- Text input-->

                   <?php docrt_pemohon_box_frontend(); ?>
                   <input type="hidden" name="docrt_formrw_submit" id="docrt_formrw_submit" value="true" />
                   <input type="hidden" name="docrt_formrw_type" id="docrt_formrw_type" value="" />
                   <?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>

                   <!-- Success message -->
                   <hr>
                   <select class="pengikut_status form-control" name="docrt_formrw_rw" type="text" id="docrt_formrw_rw" >
                        <?php $docrt_get_rw = docrt_get_rw() ?>
                        <?php //print_r(docrt_get_rw()) ?>
                        <?php foreach ($docrt_get_rw as $key => $value): ?>
                            <option value="<?php echo $value['user_nicename'] ?>"><?php echo strtoupper($value['display_name']) ?></option>
                        <?php endforeach ?>
                   </select>
                   <!-- Button -->
                   <div class="form-group">
                     <label class="col-md-4 control-label"></label>
                     <div class="row">
                         <div class="col-md-4">
                           <button type="submit" class="btn btn-warning docrt-kirim-rw-btn" > <span class="glyphicon glyphicon-send"></span></button>
                         </div>
                     </div>
                   </div>
                 </form>
               </div>
           </div>
        </div>
    </div>

    <?php
}

function docrt_get_rw() {
    $user = get_users( 'role=author' );

    foreach ($user as $key => $value) {
        $return[] = array(
            'ID' => $value->data->ID,
            'user_login' => $value->data->user_login,
            'user_nicename' => $value->data->user_nicename,
            'display_name' => $value->data->display_name,
        );
    }

    return $return;
}
function docrt_type_surat_box_frontend_select() {

    $type_surat_allow = docrt_get_type_surat_allowed();
    $tax_terms = docrt_get_terms_active();

    //$post_term = get_the_terms ($post->ID,$taxonomy );
    echo '<div class="row">';
        echo '<select class="form-control docrt_type_surat_box_select">';
        if ($tax_terms) {
            foreach ($tax_terms as $key => $name) {
                if (in_array($key, $type_surat_allow)) {
                    echo '<option value="'.$key.'">'.$name.'</option>';
                }
            }
        }
        echo '</select>';
    echo '</div>';
}

function docrt_type_surat_box_frontend($post = '') {

    $type_surat_allow = docrt_get_type_surat_allowed();
    $tax_terms = docrt_get_terms_active();

    //$post_term = get_the_terms ($post->ID,$taxonomy );
    echo '<div class="row" style="display:none">';
        echo '<ul class="list-group docrt_type_surat_box">';
        if ($tax_terms) {
            foreach ($tax_terms as $key => $name) {
                if (in_array($key, $type_surat_allow)) {
                    echo '<li class="list-group-item">
                    <input type="radio" name="tax_input[surat][]" id="f-'.$key.'" value="'.$key.'" data-typesurat="'.$key.'" style="">
                    <label for="f-'.$key.'">'.$name.'</label>
                    </li>';
                }
            }
        }
        echo '</ul>';
    echo '</div>';
}

function docrt_pemohon_box_frontend() {

    $post_term = get_the_terms ($post->ID,'surat' );

    printf( '<input type="hidden" name="docrt_nonce" value="%s" />', wp_create_nonce( plugin_basename(__FILE__) ) );   ?>
    <script type="text/javascript">
        var ajax_url = <?php echo '"'.docrt_plugin_url() . '/ajax' . '/"' ?>;
        var post_id  = <?php echo 1 ?>;
        var cpt_type = <?php echo '"create_document_frontend"' ?>;
    </script><?php

    // all form goes here
    echo '<div class="row">';
        echo '<div class="docrt-master-form"></div>';
    echo '</div>';
    //include "docrt_form.php";
}

function docrt_save_formrw()
{
    if (isset($_POST['docrt_formrw_submit']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {
     

        foreach ($_POST as $key => $value) {

            if (strpos($key, 'docrt_form_') !== false) {
                $docrt_form['form'][$key] = $value;
            } else {
                $docrt_form['data'][$key] = $value;
            }
        }
        /*echo "<pre>"; 
        print_r($docrt_form); exit(); */
        if ($docrt_form['data']['docrt_formrw_id']) {
            $acc = ($docrt_form['data']['docrt_formrw_acc'] == 'no') ? 'yes' : 'no';
            $conf_id = $docrt_form['data']['docrt_formrw_id'];

            update_post_meta($conf_id, 'docrt_formrw_acc', $acc);
            update_post_meta($conf_id, 'docrt_form', $docrt_form['form']);
            update_post_meta($conf_id, 'docrt_formrw_rw', $docrt_form['data']['docrt_formrw_rw']);
            update_post_meta($conf_id, 'docrt_formrw_type', $docrt_form['data']['docrt_formrw_type']);
            wp_update_post(array(
                'ID' => $conf_id,
                'post_author' => get_current_user_id(),
            ));

            $args = [
                'post_type' => 'page',
                'nopaging' => true,
                'meta_key' => '_wp_page_template',
                'meta_value' => 'docrt-template-home.php'
            ];
            $pages = get_posts( $args );

            wp_redirect($pages[0]->guid.'&docrt_formrw='.$conf_id);
            exit;

        } else {

            $post_information = array(
                'post_title' => $docrt_form['form']['docrt_form_nama'].' - '.$docrt_form['form']['docrt_form_nonik'],
                'post_type' => 'docrt-formrw',
                'post_status' => 'publish'
            );
            $conf_id = wp_insert_post($post_information);

            add_post_meta($conf_id, 'docrt_form', $docrt_form['form'], true);
            add_post_meta($conf_id, 'docrt_formrw_rw', $docrt_form['data']['docrt_formrw_rw'], true);
            add_post_meta($conf_id, 'docrt_formrw_type', $docrt_form['data']['docrt_formrw_type'], true);
            
            add_post_meta($conf_id, 'docrt_formrw_acc', 'no', true);

            $args = [
                'post_type' => 'page',
                'nopaging' => true,
                'meta_key' => '_wp_page_template',
                'meta_value' => 'docrt-template-home.php'
            ];
            $pages = get_posts( $args );

            wp_redirect($pages[0]->guid);
            exit;

        }
    }
}
add_action('wp_loaded', 'docrt_save_formrw', 40);

