jQuery(document).ready(function($) {
    console.log('edit.js');

    //docrt_kusus_skel();
    datepicker_init();
    // add pejabat
    $(document).on("click", ".button-pej-add", function(e) {
        e.preventDefault();
        docrt_add_pejabat_kel();
    });

    // remove pejabat
    $(document).on("click", ".button-pej-remove", function(e) {
        e.preventDefault();
        docrt_remove_pejabat_kel();
    });

    function datepicker_init() {
        jQuery( ".docrt_datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true
        });
    }

    function docrt_add_pejabat_kel() {
        var count_html  = $(".docrt_pej_count");
        var count       = parseInt($(".docrt_pej_count").val());
        var count_next  = count + 1;
        //console.log(".docrt_pej_jabatan"+count_next);
        $(".docrt_pej_jabatan_"+count_next).show();
        $(".docrt_pej_jabatan_"+count_next+" .docrt_inputs").removeAttr('disabled', 'disabled');

        if (count_next > 10) {
            count_html.val(10);
        } else {
            count_html.val(count_next);
        }
    }

    function docrt_remove_pejabat_kel() {
        var count_html  = $(".docrt_pej_count");
        var count       = parseInt($(".docrt_pej_count").val());
        var count_prev  = count - 1;

        $(".docrt_pej_jabatan_"+count).hide();
        $(".docrt_pej_jabatan_"+count+" .docrt_inputs").attr('disabled', 'disabled');

        if (count_prev < 1) {
            count_html.val(1);
        } else {
            count_html.val(count_prev);
        }
    }

});
