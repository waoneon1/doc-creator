<?php

function docrt_frontend_rw_interface() {

    if (!is_user_logged_in()) return; ?>
    
    <script type="text/javascript">
        var cpt_type = <?php echo '"create_document_frontend"' ?>;
    </script><?php
    
    echo '<div class="container">';
    $terms = docrt_get_terms_active();

    if ($_GET['docrt_formrw']) {
        $id = $_GET['docrt_formrw'];
        $meta = get_post_meta($id , 'docrt_form', true);
        $meta_rw = get_post_meta($id , 'docrt_formrw_rw', true);
        $type_surat = get_post_meta($id , 'docrt_formrw_type', true);
        $meta_acc = get_post_meta($id , 'docrt_formrw_acc', true);
        $cpt_type = 'create_document_frontend'; ?>
        
        <!-- Tampilkan warning -->
        <?php if ($meta_acc == 'yes'): ?>
            <div class="alert alert-success">
               Permohonan ini telah di varifikasi.
            </div>
        <?php else : ?>
            <div class="alert alert-danger">
              <strong>Warning!</strong> Permohonan ini belum di varifikasi.
            </div>
        <?php endif ?>
        <p><?php echo ucwords($terms[$type_surat]) ?></p>
        <?php // Print Front End Here
        echo '<form action="" method="post">';
            // hidden value ?>
            <input type="hidden" name="docrt_formrw_submit" id="docrt_formrw_submit" value="true" />
            <input type="hidden" name="docrt_formrw_rw" id="docrt_formrw_rw" value="<?php echo $meta_rw ?>" />
            <input type="hidden" name="docrt_formrw_type" id="docrt_formrw_type" value="<?php echo $type_surat ?>" />
            <input type="hidden" name="docrt_formrw_id" id="docrt_formrw_id" value="<?php echo $id ?>" />
            <input type="hidden" name="docrt_formrw_acc" id="docrt_formrw_acc" value="<?php echo $meta_acc ?>" />
            <?php wp_nonce_field( 'post_nonce', 'post_nonce_field' );

            echo '<table class="table table-striped">';
            echo '<tbody>';
            foreach ($meta as $key => $value) {
                // $a = docrt_form_keperluan($meta_param, $type_surat);
                // echo trim(strip_tags($a));
                $meta_param[$key][0] = $value;
                if (function_exists($key)) {
                  $return_tr = call_user_func_array($key, array($meta_param, $type_surat, $cpt_type));
                } else {
                  $return_tr = 'Form <b>'.$key.'</b> Hilang';
                }
                echo $return_tr;
            }
            echo '</tbody>';
            echo '</table>';
            $btn_acc        = ($meta_acc == 'no') ? 'Verifikasi Surat Permohonan' : 'Batalkan Permohonan';
            $btn_acc_class  = ($meta_acc == 'no') ? 'btn-success' : 'btn-danger';
            echo '<button type="submit" class="btn '.$btn_acc_class.'" >'.$btn_acc.'<span class="glyphicon glyphicon-send"></span></button>';
        echo '</form>';
        // End Print Front End

    } else {
        ?>
        <div class="docrt-formrw">
            <ul class="list-group">
            <?php 
            $cuser = wp_get_current_user();
            $crw = esc_html( $cuser->user_firstname ).esc_html( $cuser->user_lastname  );
            $args = array(
                'post_type' => 'docrt-formrw',
                'posts_per_page' => -1,
                'meta_key'   => 'docrt_formrw_rw',
                'meta_value' =>  $crw
            );
            $the_query = new WP_Query( $args );

            if ( $the_query->have_posts() ) {
                echo '<ul>';
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    $acc_stat = docrt_acc_status($the_query->post->ID);
                    //print_r(get_post_meta($the_query->post->ID , 'docrt_formrw_rw', true));
                    echo '<li class="list-group-item">
                        <a href="?docrt_formrw='.$the_query->post->ID.'">'.get_the_title().'</a>
                        <span class="pandding pandding-'.$acc_stat[0].'">'.$acc_stat[1].'</span>
                    </li>';
                }
                echo '</ul>';

                /* Restore original Post Data */
                wp_reset_postdata();
            } else {
                // no posts found
            } ?>

            </ul>
        </div> <?php
    }
    echo '</div>';
}

function docrt_acc_status($id) {

    $acc = get_post_meta($id , 'docrt_formrw_acc', true);
    if ($acc == 'yes') {
        $return = array('yes', 'acc') ;
    } else {
        $return = array('no', 'belum acc');
    }

    return $return;
}

