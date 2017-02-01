<?php
function docrt_get_saksi_form($meta_value1 = '',$meta_value2 = '') {
    $query_args = array(
        'post_type'      => 'docrt-perangkat',
        'post_status'    => 'publish',
        'orderby'        => 'date',
    );
    $posts = new WP_Query( $query_args );
    $data['RT'] = '';
    $data['RW'] = '';
    foreach ($posts->posts as $key => $post) {
        $meta = get_post_meta($post->ID, 'docrt_perangkat', true);
        $param[ $meta['jabatan'] ][] = array(
            'id' => $post->ID,
            'jabatan' => $meta['jabatan'].' '.$meta['no_jabatan'],
            'no_jabatan_rw' => $meta['no_jabatan_rw']
        );
    }

    foreach ($param as $key => $value) {
        foreach ($value as $k => $v) {
            if ($v['id'] == $meta_value1) {
                $selected = 'selected';
            } elseif ($v['id'] == $meta_value2) {
                $selected = 'selected';
            } else {
                 $selected = '';
            }

            if ($key == 'RT') {
                $data[$key] .= '<option value="'.$v['id'].'" '.$selected.'>'.$v['jabatan'].' / '.$v['no_jabatan_rw'].'</option>';
            } else {
                $data[$key] .= '<option value="'.$v['id'].'" '.$selected.'>'.$v['jabatan'].'</option>';
            }

        }
    }

    return $data;
}
