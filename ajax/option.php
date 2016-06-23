<?php require_once('../../../../wp-load.php');
/*$args = array(
    'post__in' => $_POST['data'],
    'post_type' => 'prgen-products-conf'
);

$posts = get_posts($args);
echo json_encode($posts);
*/

foreach ($_POST['data'] as $value) {
    $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $value ), 'full' );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $value ), 'thumbnail' );
    $param = get_post($value);

    $param->prgen_img = $image[0];
    $param->prgen_img_full = $image_full[0];
    $param->prgen_disclaimer = get_post_meta( $value, 'prgen_disclaimer', true );

    $params[] = $param;
}
echo json_encode($params);

