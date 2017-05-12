<?php require_once('../../../../wp-load.php');
//print_r($_POST);
$form = $_POST['data']['surat'];
$post_id = $_POST['post_id'];
$type_surat = $_POST['type_surat'];
$cpt_type = $_POST['cpt_type'];
//$post_term = get_the_terms ($post_id,'surat' );
$meta = get_post_meta($post_id);

$return_tr = '';
$return_table = '';
if ($form) {
  foreach ($form as $key => $value) {
    if (strpos($value, '###') === false) {

      if (function_exists($value)) {
        $return_tr .= call_user_func_array($value, array($meta, $type_surat, $cpt_type));
      } else {
        $return_tr .= '<tr><td colspan="3">Form <b>'.$value.'</b> Hilang</td></tr>';
      }

    } else {

      $value_table = explode('###', $value);
      if (function_exists($value_table[1])) {
        if ($value_table[0] == 'table') {
          $return_table .= call_user_func_array($value_table[1], array($meta, $type_surat, $cpt_type));
        } else {
          $return_tr .= call_user_func_array($value_table[1], array($value_table[2]));
        }
      }
    }
  }
}

echo '<input type="hidden" id="docrt_tysrt_form" name="docrt_type_surat" value="'.$type_surat.'" />' ;
echo '<table class="docrt_tbl docrt_pemohon_box table table-striped">';
  echo docrt_doc_title_nosurat($meta, $type_surat, $cpt_type);
  echo '<tbody>';
      echo $return_tr;
  echo '</tbody>';
echo '</table>';
echo $return_table;

/*=================================================
  Form Function
=================================================*/
