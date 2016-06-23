<?php require_once('../../../../wp-load.php');
$args = array(
    'post__id' => $_POST['data'],
    'post_type' => 'prgen-configuration'
);

$param = get_post($_POST['data']);
$param->prgen_part_id = get_post_meta( $param->ID, 'prgen_parts', true );
$param->prgen_product_id =get_post_meta( $param->ID, 'prgen_product_id', true );

echo json_encode($param);


/*foreach ($_POST['data'] as $value) {
    $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $value ), 'full' );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $value ), 'thumbnail' );
    $param = get_post($value);

    $param->prgen_img = $image[0];
    $param->prgen_img_full = $image_full[0];
    $param->prgen_disclaimer = get_post_meta( $value, 'prgen_disclaimer', true );

    $params[] = $param;
}*/
//echo json_encode($params);
