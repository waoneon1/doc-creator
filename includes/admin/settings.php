<?php
/*****************************************************************************************
 * REMOVE MENU
 * docrt-document
 *****************************************************************************************/
function docrt_remove_menus(){
    remove_menu_page( 'edit.php' );                   //Posts
    remove_menu_page( 'upload.php' );                 //Media
    if (!current_user_can('manage_options')) {
        remove_menu_page( 'edit.php?post_type=page' );    //Pages
    }
    remove_menu_page( 'edit-comments.php' );          //Comments
    remove_menu_page( 'tools.php' );                    //tools
}
add_action( 'admin_menu', 'docrt_remove_menus' );

/*****************************************************************************************
 * Dashboard widget
 * docrt-document
 *****************************************************************************************/
function docrt_list_surat_dashboard_widgets() {
    global $current_user, $wpdb;
    $role = $wpdb->prefix . 'capabilities';
    $current_user->role = array_keys($current_user->$role);
    $role = $current_user->role[0];

    if ($role == 'top_editor' || $role == 'administrator') {
       wp_add_dashboard_widget(
                 'surat_dashboard_widget',         // Widget slug.
                 'List Surat',         // Title.
                 'list_surat_dashboard_widget_function' // Display function.
        );

        wp_add_dashboard_widget(
                 'author_dashboard_widget',         // Widget slug.
                 'List Editor',         // Title.
                 'author_dashboard_widget_function' // Display function.
        );
    }
}
add_action( 'wp_dashboard_setup', 'docrt_list_surat_dashboard_widgets' );

// Dasboard surat
function list_surat_dashboard_widget_function() {
    $tax = 'surat';
    $typesurat = docrt_get_type_surat_allowed();
    $terms = get_terms( array(
        'taxonomy' => $tax,
        'hide_empty' => false,
    ) );
    if ( !empty( $terms ) && !is_wp_error( $terms ) ){
        echo '<ul>';

        foreach ( $terms as $term ) {
            if (in_array($term->slug, $typesurat)) {
                $term = sanitize_term( $term, $tax  );
                $term_link = get_site_url().'/wp-admin/edit.php?post_type=docrt-document&'.$tax.'='.$term->slug;

                echo '<li><a href="' . esc_url( $term_link ) . '"><strong>' . ucwords($term->name) . '</strong></a></li>';
                echo '<li><a href="' . esc_url( $term_link ) . '"><strong>' . strtoupper($term->slug) . '</strong> Jumlah Surat : ' . $term->count . '</a></li>';
                echo '<li><hr/></li>';
            }
        }
        echo '</ul>';
    }
}

// Dasboard Author
function author_dashboard_widget_function() {

    $blogusers = get_users('role=editor');

    echo '<ul>';
    foreach ( $blogusers as $user ) {
        $author_link = get_site_url().'/wp-admin/edit.php?post_type=docrt-document&author='.$user->ID;
        echo '<li><a href="'.esc_url($author_link).'"><strong>' . ucwords($user->user_nicename) . '</strong> publish : '.count_user_posts( $user->ID , "docrt-document"  ).' surat</a></li>';
    }
    echo '</ul>';
}

/**
 *
 * Show custom post types in dashboard activity widget
 *
 */

// unregister the default activity widget
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
function remove_dashboard_widgets() {

    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);

}

// register your custom activity widget
add_action('wp_dashboard_setup', 'add_custom_dashboard_activity' );
function add_custom_dashboard_activity() {
    wp_add_dashboard_widget('custom_dashboard_activity', 'Activities', 'custom_wp_dashboard_site_activity');
}

// the new function based on wp_dashboard_recent_posts (in wp-admin/includes/dashboard.php)
function wp_dashboard_recent_post_types( $args ) {

/* Chenged from here */

    if ( ! $args['post_type'] ) {
        $args['post_type'] = 'any';
    }

    $query_args = array(
        'post_type'      => $args['post_type'],

/* to here */

        'post_status'    => $args['status'],
        'orderby'        => 'date',
        'order'          => $args['order'],
        'posts_per_page' => intval( $args['max'] ),
        'no_found_rows'  => true,
        'cache_results'  => false
    );
    $posts = new WP_Query( $query_args );

    if ( $posts->have_posts() ) {

        echo '<div id="' . $args['id'] . '" class="activity-block">';

        if ( $posts->post_count > $args['display'] ) {
            echo '<small class="show-more hide-if-no-js"><a href="#">' . sprintf( __( 'See %s more…'), $posts->post_count - intval( $args['display'] ) ) . '</a></small>';
        }

        echo '<h4>' . $args['title'] . '</h4>';

        echo '<ul>';

        $i = 0;
        $today    = date( 'Y-m-d', current_time( 'timestamp' ) );
        $tomorrow = date( 'Y-m-d', strtotime( '+1 day', current_time( 'timestamp' ) ) );

        while ( $posts->have_posts() ) {
            $posts->the_post();

            $post_tr = get_the_terms ($posts->post->ID,'surat' );
            $post_term = strtoupper($post_tr[0]->slug);
            $author_obj = get_user_by('id', $posts->post->post_author);
            $author = ucwords($author_obj->data->user_login);

            $time = get_the_time( 'U' );
            if ( date( 'Y-m-d', $time ) == $today ) {
                $relative = __( 'Today' );
            } elseif ( date( 'Y-m-d', $time ) == $tomorrow ) {
                $relative = __( 'Tomorrow' );
            } else {
                /* translators: date and time format for recent posts on the dashboard, see http://php.net/date */
                $relative = date_i18n( __( 'M jS' ), $time );
            }

            $text = sprintf(
                /* translators: 1: relative date, 2: time, 4: post title */
                __( '<span>%1$s, %2$s</span> <a href="%3$s">%4$s <strong> | %5$s </strong>  oleh : <strong>%6$s</strong></a>' ),
                $relative,
                get_the_time(),
                get_edit_post_link(),
                _draft_or_post_title(),
                $post_term,
                $author
            );

            $hidden = $i >= $args['display'] ? ' class="hidden"' : '';
            echo "<li{$hidden}>$text</li>";
            $i++;
            echo "<hr/>";
        }

        echo '</ul>';
        echo '</div>';

    } else {
        return false;
    }

    wp_reset_postdata();

    return true;
}

// The replacement widget
function custom_wp_dashboard_site_activity() {

    echo '<div id="activity-widget">';

    $future_posts = wp_dashboard_recent_post_types( array(
        'post_type'  => 'docrt-document',
        'display' => 5,
        'max'     => 5,
        'status'  => 'future',
        'order'   => 'ASC',
        'title'   => __( 'Publishing Soon' ),
        'id'      => 'future-posts',
    ) );

    $recent_posts = wp_dashboard_recent_post_types( array(
        'post_type'  => 'docrt-document',
        'display' => 5,
        'max'     => 5,
        'status'  => 'publish',
        'order'   => 'DESC',
        'title'   => __( 'Recently Published' ),
        'id'      => 'published-posts',
    ) );

    //$recent_comments = wp_dashboard_recent_comments( 10 );

    if ( !$future_posts && !$recent_posts ) {
        echo '<div class="no-activity">';
        echo '<p class="smiley"></p>';
        echo '<p>' . __( 'No activity yet!' ) . '</p>';
        echo '</div>';
    }

    echo '</div>';
}
