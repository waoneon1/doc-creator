<?php
/*****************************************************************************************
 * Row Action Download pdf dan remove view
 * docrt-document
 *****************************************************************************************/
function docrt_remove_view_link($actions, $page_object)
{
    global $current_user, $wpdb;
    $role = $wpdb->prefix . 'capabilities';
    $current_user->role = array_keys($current_user->$role);
    $role = $current_user->role[0];

    if ($role != 'top_editor' && $role != 'administrator') {
      unset($actions['delete']);
    }

    unset($actions['view']);
    unset($actions['inline hide-if-no-js']);
    return $actions;
}
add_filter('page_row_actions', 'docrt_remove_view_link', 10, 2);

function docrt_create_pdf($actions, $page_object)
{
   $actions['create_pdf'] = '<a href="'.docrt_plugin_url() .'/includes/docrt_pdf_create.php?pid='.$page_object->ID.'" class="create_pdf" target="_blank">' . __('Buat PDF') . '</a>';

   return $actions;
}
add_filter('page_row_actions', 'docrt_create_pdf', 10, 2);

/*****************************************************************************************
* Table header
* docrt-document
/*****************************************************************************************/
// author table header
add_filter('manage_docrt-document_posts_columns', 'docrt_table_head');
function docrt_table_head( $defaults ) {
    $defaults['author'] = 'Autor';
    return $defaults;
}

// ID SURAT
add_filter('manage_docrt-document_posts_columns', 'bbox_table_head');
function bbox_table_head( $defaults ) {
    $defaults['id_surat']  = 'ID Surat';
    return $defaults;
}

add_action( 'manage_docrt-document_posts_custom_column', 'bbox_event_table_content', 10, 2 );
function bbox_event_table_content( $column_name, $post_id ) {
    $post_term = get_the_terms ($post->ID,'surat' );
    $meta = get_post_meta( $post_id, 'docrt_'.$post_term[0]->slug.'_id', true );
    if ($column_name == 'id_surat') {
       echo $post_term[0]->slug.' - '.$meta;
    }
}

/*****************************************************************************************
* button Buat PDF di publish metabox
* docrt-document
*****************************************************************************************/
add_action( 'post_submitbox_misc_actions', 'article_or_box' );
add_action( 'save_post', 'save_article_or_box' );
function article_or_box() {
    global $post;
    if (get_post_type($post) == 'docrt-document') {
         echo '<a href="'.docrt_plugin_url() .'/includes/docrt_pdf_create.php?pid='.$post->ID.'" class="button button-primary button-large button-fullwidth" target="_blank">Buat PDF</a>';
    }
}
