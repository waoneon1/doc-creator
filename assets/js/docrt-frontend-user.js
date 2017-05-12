jQuery(document).ready(function($) {

    docrt_kirim_rw();
    $("#docrt_user_frontend .docrt_type_surat_box input:radio").click(function() {
       $('#docrt_user_frontend .docrt_type_surat_box li').removeClass('active');
       console.log('tes');
       $(this).parent().addClass('active');
    });
    //console.log(cpt_type);
    $( "#docrt_user_frontend .docrt_type_surat_box li" ).hover(
      function() {
         $(this).addClass('docrt-hover');
      }, function() {
         $(this).removeClass('docrt-hover');
      }
    );

    //front end =========================================
    $("#docrt_formrw_rw").change(function() {
        docrt_kirim_rw();
    });
    function docrt_kirim_rw() {
        var rw = $( "#docrt_formrw_rw option:selected" ).text();
        $(".docrt-kirim-rw-btn").text('Kirim Permohonan Ke '+rw);
    }
    $(".docrt_type_surat_box_select").change(function() {
        var selected = $( ".docrt_type_surat_box_select option:selected" ).val();
        $( ".docrt_type_surat_box #f-"+selected ).prop('checked', 'checked');
        $( ".docrt_type_surat_box #f-"+selected ).trigger( "click" );
    });
    //front end =========================================

    function frontend_docrt_formrw() {

        var form_class = '';
        var tr_tag = $(".docrt_pemohon_box .docrt_form");
        var type_surat = $(".docrt_type_surat_box input[type='radio']:checked").data('typesurat');
        var param = docrt_form_data(type_surat);

        $('.docrt-master-form').html('');
        var data = {
            'data': param,
            'post_id': post_id,
            'type_surat': type_surat,
            'cpt_type': cpt_type
        };
        //console.log(ajax_params);
        console.log(data);
        $.ajax({
            data: data,
            type: 'POST',
            url: ajax_url+'form_creator.php',
            success: function(data){
                $('.docrt-master-form').append(data);
                datepicker_init();
                docrt_kusus_skp();
                //console.log(data);

            }
        });

    }
});
