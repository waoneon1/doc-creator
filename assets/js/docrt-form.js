jQuery(document).ready(function($) {

    tes_docrt_form_selected();
    //docrt_form_selected();
    docrt_kusus_skp();
    //docrt_kusus_skel();

    $(".docrt_type_surat_box input:radio").click(function() {
        console.log('click');
        // docrt_form_selected();
        tes_docrt_form_selected();
    });

    // tambah form pengikut khusus skp
    $(document).on("change", "#docrt_form_pengikut", function (e) { //vpc-options
        docrt_kusus_skp();
    });

    //  form kembar khusus skel
    $(document).on("change", "#docrt_form_kelahiran", function (e) { //vpc-options
        docrt_kusus_skel();
    });

    function tes_docrt_form_selected() {
        var form_class = '';
        var tr_tag = $(".docrt_pemohon_box .docrt_form");
        var type_surat = $(".docrt_type_surat_box input[type='radio']:checked").data('typesurat');
        var param = docrt_form_data(type_surat);
        $('.docrt-master-form').html('');
        var data = {
            'data': param,
            'post_id': post_id,
            'type_surat': type_surat
        };
        //console.log(ajax_params);
        console.log(ajax_url);
        $.ajax({
            data: data,
            type: 'POST',
            url: ajax_url+'form_creator.php',
            success: function(data){
                $('.docrt-master-form').append(data);
                //console.log(data);
            }
        });
    }

    function docrt_form_selected() {
        var form_class = '';
        var tr_tag = $(".docrt_pemohon_box .docrt_form");
        var type_surat = $(".docrt_type_surat_box input[type='radio']:checked").data('typesurat');
        var data = docrt_form_data(type_surat);

        docrt_title_selected(type_surat);

        $("input[type='hidden']#docrt_tysrt_form ").val(type_surat);
        //$(tr_tag).addClass('d-hide');
        $(".docrt_pemohon_box .docrt_thead").addClass('d-hide');
        $(".docrt_pemohon_box .docrt_form .docrt_inputs").attr('disabled', 'disabled');

        // FORM utama
        var data_surat = data['surat'];
        if (data_surat) {
            for (var i = 0 ; i < data_surat.length; i++) {
                $(".docrt_pemohon_box ."+data_surat[i]+"_tr").removeClass('d-hide');
                $(".docrt_pemohon_box #"+data_surat[i]).removeAttr('disabled');
            }
        }
        //tHeader
        var data_theads = data['header'];
        var data_thead = '';
        if (data_theads) {
            for (var i = 0 ; i < data_theads.length; i++) {
                data_thead = data_theads[i].split("=>");
                if (data_thead[0] == 'thead') {

                    $(".docrt_pemohon_box .docrt_"+data_thead[0]+"_"+data_thead[1]).removeClass('d-hide');
                }
            }
        }

    }

    function docrt_title_selected(type_surat) {
        var title_tag = $(".docrt_pemohon_box .docrt_form_title");
        $(title_tag).addClass('d-hide');
        $(".docrt_pemohon_box .docrt_form_title .docrt_inputs").attr('disabled', 'disabled');


        $(".docrt_pemohon_box .docrt_"+type_surat+"_id_title").removeClass('d-hide');
        $(".docrt_pemohon_box #docrt_"+type_surat+"_id").removeAttr('disabled');
    }

    function docrt_kusus_skp() {
        var value = $("#docrt_form_pengikut").val();
        var current_val = $(".docrt_pengikut").length;

        $(".docrt_tbl_pindah").addClass('d-hide');
        $(".docrt_pengikut").addClass('d-hide');
        $(".docrt_pengikut input").attr('disabled', 'disabled');
        $(".docrt_pengikut select").attr('disabled', 'disabled');

        if (value == 0) {
            $(".docrt_tbl_pindah").addClass('d-hide');
        } else {
            $(".docrt_tbl_pindah").removeClass('d-hide');
            for (var i = 1; i <= value; i++) {
                $(".docrt_pengikut"+i).removeClass('d-hide');
                $(".docrt_pengikut"+i+" input").removeAttr('disabled', 'disabled');
                $(".docrt_pengikut"+i+" select").removeAttr('disabled', 'disabled');
            }
        }

    }

    function docrt_kusus_skel() {
        var kelahiran = $("#docrt_form_kelahiran");
        var kembar = $("#docrt_form_kembarke");

        if (kelahiran.val() == 'Tunggal') {
            kembar.attr('disabled', 'disabled');
            kembar.val('');
        } else {
            kembar.removeAttr('disabled', 'disabled');
        }
    }

    function docrt_form_data(type_surat = '') {
        var data = {};
        // 1. data surat keterangan usaha ===================================================================================================
        data.sku = {
            'surat' : [
                'title###docrt_get_group_title### Data Diri / Pelapor',
                'docrt_form_nama',
                'docrt_form_ttl',
                'docrt_form_jk',
                'docrt_form_agama',
                'docrt_form_sperkawinan',
                'docrt_form_nokk',
                'docrt_form_nonik',
                'docrt_form_pekerjaan',
                'docrt_form_alamat',
                'docrt_form_pendidikan',
                'docrt_form_keperluan',

                'title###docrt_get_group_title### Keterangan',
                'docrt_form_tujuan',
                'docrt_form_tgl_berlaku',
                'docrt_form_ketRT',

                'title###docrt_get_group_title### Keterangan Usaha',
                'docrt_form_nama_usaha',
                'docrt_form_alamat_usaha'
            ]
        };

        // 2. data surat keterangan domisili usaha ===================================================================================================
        data.skdu ={
            'surat' : [
                'title###docrt_get_group_title### Data Diri / Pelapor',
                'docrt_form_nama',
                'docrt_form_ttl',
                'docrt_form_agama',
                'docrt_form_pekerjaan',
                'docrt_form_alamat',
                'docrt_form_kelurahan',
                'docrt_form_kecamatan',
                'docrt_form_kota',

                'title###docrt_get_group_title### Keterangan',
                'docrt_form_ketRT',
                'docrt_form_tgl',
                'docrt_form_keperluan',

                'title###docrt_get_group_title### Keterangan Usaha',
                'docrt_form_nama_usaha',
                'docrt_form_alamat_usaha',
                'docrt_form_rtrw_usaha',
                'docrt_form_ket_usaha'
            ]
        };
        // 3. data surat keterangan domisili usaha ===================================================================================================
        data.skd ={
            'surat' : [
                'title###docrt_get_group_title### Data Diri / Pelapor',
                'docrt_form_nama',
                'docrt_form_alamat',
                'docrt_form_rtrw',
                'docrt_form_kelurahan',
                'docrt_form_kecamatan',
                'docrt_form_kota',

                'title###docrt_get_group_title###Keterangan Lembaga',
                'docrt_form_nama_usaha',
                'docrt_form_alamat_usaha',
                'docrt_form_nama_noinduk_lembaga',
                'docrt_form_noinduk_lembaga',
                'docrt_form_nama_lembaga',

                'title###docrt_get_group_title### Keterangan',
                'docrt_form_tujuan'
            ]
        };
        // 4. data surat keterangan ijin keramaian ===================================================================================================
        data.skik ={
            'surat' : [
                'title###docrt_get_group_title### Data Diri / Pelapor',
                'docrt_form_nama',
                'docrt_form_ttl',
                'docrt_form_jk',
                'docrt_form_agama',
                'docrt_form_sperkawinan',
                'docrt_form_nokk',
                'docrt_form_nonik',
                'docrt_form_pekerjaan',
                'docrt_form_alamat',
                'docrt_form_pendidikan',

                'title###docrt_get_group_title###Keterangan',
                'docrt_form_keperluan',
                'docrt_form_tujuan',
                'docrt_form_tgl_berlaku',
                'docrt_form_ketRT',

                'title###docrt_get_group_title###Keterangan Acara',
                'docrt_form_nama_acara',
                'docrt_form_tgl_acara'
            ]
        };
        // 5. data surat keterangan catatan kepolisian ===================================================================================================
        data.skck ={
            'surat' : [
                'title###docrt_get_group_title### Data Diri / Pelapor',
                'docrt_form_nama',
                'docrt_form_ttl',
                'docrt_form_jk',
                'docrt_form_agama',
                'docrt_form_sperkawinan',
                'docrt_form_nokk',
                'docrt_form_nonik',
                'docrt_form_pekerjaan',
                'docrt_form_alamat',
                'docrt_form_pendidikan',

                'title###docrt_get_group_title###Keterangan',
                'docrt_form_keperluan',
                'docrt_form_tujuan',
                'docrt_form_tgl_berlaku',
                'docrt_form_ketRT'
            ]
        };
        // 6. data surat keterangan pindah  ===================================================================================================
        data.skp ={
            'surat' : [
                'title###docrt_get_group_title### Data Diri / Pelapor',
                'docrt_form_nama',
                'docrt_form_ttl',
                'docrt_form_jk',
                'docrt_form_kebangsaan',
                'docrt_form_agama',
                'docrt_form_sperkawinan',
                 'docrt_form_nokk',
                'docrt_form_nonik',
                'docrt_form_pekerjaan',
                'docrt_form_pendidikan',
                'docrt_form_alamat',

                'title###docrt_get_group_title###Keterangan',
                'docrt_form_keperluan',
                'docrt_form_tujuan',
                'docrt_form_tgl', //perlu alter
                'docrt_form_tgl_berlaku',
                'docrt_form_ketRT',

                'title###docrt_get_group_title###Pindah Ke',
                'docrt_form_desa_pindah',
                'docrt_form_kecamatan_pindah',
                'docrt_form_kabkota_pindah',
                'docrt_form_provinsi_pindah',

                'title###docrt_get_group_title###Keterangan Pindah',
                'docrt_form_tgl_pindah',
                'docrt_form_alasan_pindah',
                'docrt_form_pengikut', //perlu alter (belum bisa otomatis we`ll take care of it)

                'table###docrt_tbl_pindah'
                // -no, nama, jk, tgl lahir, st perkawinan, pendidikan, noktp, keterangan(suami istri anak ortu keluarga lain)
            ]
        };
        // 7. data surat keterangan tidak mampu ===================================================================================================
        data.sktm = data['skck'];
        // 8. data surat keterangan balum pernah menikah ===================================================================================================
        data.skbpm = data['skck'];
        // 9. data surat kelahiran ===================================================================================================
        data.skel ={
            'surat' : [
                'title###docrt_get_group_title### Data Pelapor',
                'docrt_form_nama',
                'docrt_form_hubungan', //perlu alter
                'docrt_form_umur',
                'docrt_form_nonik',
                'docrt_form_pekerjaan',
                'docrt_form_alamat',
                'docrt_form_tlp',

                'title###docrt_get_group_title### Data Kelahiran',
                'docrt_form_nama_bayi',
                'docrt_form_nonik_bayi',
                'docrt_form_dilahirkan1',
                'docrt_form_anakke',
                'docrt_form_kelahiran',
                'docrt_form_kembarke',
                'docrt_form_jk_bayi',
                'docrt_form_kota_bayi',

                'title###docrt_get_group_title###Keterangan Tambahan',
                'docrt_form_tgl_jam',
                'docrt_form_tempat',
                'docrt_form_penolong_lahir',
                'docrt_form_saksi',

                'title###docrt_get_group_title###Data Ayah',
                'docrt_form_nama_ayah',
                'docrt_form_dilahirkan3',
                'docrt_form_alamat_ayah',
                'docrt_form_kebangsaan_ayah',
                'docrt_form_nokk_ayah',
                'docrt_form_nonik_ayah',
                'docrt_form_pekerjaan_ayah',
                'docrt_form_tlp_ayah',

                'title###docrt_get_group_title###Data Ibu',
                'docrt_form_nama_ibu',
                'docrt_form_dilahirkan2',
                'docrt_form_alamat_ibu',
                'docrt_form_kebangsaan_ibu',
                'docrt_form_nonik_ibu',
                'docrt_form_pekerjaan_ibu',
                'docrt_form_tlp_ibu',
            ]
        };
        // 10. data surat kematian ===================================================================================================
        data.skem ={
            'surat' : [
                'title###docrt_get_group_title### Data Pelapor',
                'docrt_form_nama',
                'docrt_form_hubungan',
                'docrt_form_dilahirkan_pelapor',
                'docrt_form_alamat_pelapor',
                'docrt_form_nonik_pelapor',
                'docrt_form_pekerjaan_pelapor',
                //'docrt_form_nama_pelapor',

                'title###docrt_get_group_title### Data Kematian',
                'docrt_form_nama_mati',//
                'docrt_form_ttl',
                'docrt_form_umur',//
                'docrt_form_jk',
                'docrt_form_anakke',
                'docrt_form_kebangsaan',
                'docrt_form_agama',
                'docrt_form_sperkawinan',
                'docrt_form_nokk',
                'docrt_form_nonik',
                'docrt_form_pekerjaan',
                'docrt_form_alamat',
                'docrt_form_kelurahan',
                'docrt_form_kota',

                'title###docrt_get_group_title### Keterangan',
                'docrt_form_tgl_jam',
                'docrt_form_tempat',//
                'docrt_form_sebab_kematian',
                'docrt_form_yang_menerangkan',
                'docrt_form_saksi',

                'title###docrt_get_group_title### Data Ayah',
                'docrt_form_nama_ayah',
                'docrt_form_dilahirkan3',
                'docrt_form_alamat_ayah',
                'docrt_form_nokk_ayah',
                'docrt_form_nonik_ayah',
                'docrt_form_pekerjaan_ayah',

                'title###docrt_get_group_title### Data Ibu',
                'docrt_form_nama_ibu',
                'docrt_form_dilahirkan2',
                'docrt_form_alamat_ibu',
                'docrt_form_nonik_ibu',
                'docrt_form_pekerjaan_ibu',
            ]
        };
        // 11. kk ===================================================================================================
        data.kk ={
            'surat' : [
                'title###docrt_get_group_title### Data Diri / Pelapor',
                'docrt_form_nokk',
                'docrt_form_nama',
                'docrt_form_alamat',
                'docrt_form_rtrw',
                'docrt_form_kelurahan',
                'docrt_form_kecamatan',
                'docrt_form_kota',
                'docrt_form_provinsi',
                'title###docrt_get_group_title### Ketarangan',
                'docrt_form_tgl'
            ]
        };
        // 12. ktp ===================================================================================================
        data.ktp ={
            'surat' : [
                'title###docrt_get_group_title### Data Diri / Pelapor',
                'docrt_form_nonik',
                'docrt_form_nama',
                'docrt_form_ttl',
                'docrt_form_jk',
                'docrt_form_goldarah',
                'docrt_form_alamat',
                'docrt_form_rtrw',
                'docrt_form_kelurahan',
                'docrt_form_kecamatan',
                'docrt_form_agama',
                'docrt_form_sperkawinan',
                'docrt_form_pekerjaan',
                'docrt_form_kebangsaan',
                'title###docrt_get_group_title###Keterangan',
                'docrt_form_tgl_berlaku',
            ]
        };
        // 13. data surat keterangan ===================================================================================================
        data.sk ={
            'surat' : [
                'title###docrt_get_group_title### Data Diri / Pelapor',
                'docrt_form_nama',
                'docrt_form_ttl',
                'docrt_form_jk',
                'docrt_form_agama',
                'docrt_form_sperkawinan',
                'docrt_form_nokk',
                'docrt_form_nonik',
                'docrt_form_pekerjaan',
                'docrt_form_alamat',
                'docrt_form_pendidikan',

                'title###docrt_get_group_title###Keterangan',
                'docrt_form_keperluan',
                'docrt_form_tujuan',
                'docrt_form_tgl_berlaku',
                'docrt_form_ketRT',
                'docrt_form_menerangkan_bahwa',
            ]
        };

        if (type_surat == '')
            return docrt_merge_options(data,docrt_header_data());
        else
            return docrt_merge_options(data[type_surat],docrt_header_data(type_surat));
    }

    function docrt_header_data(type_surat = '') {
        var data = {};
        data.sku = {'header' : ['thead=>org', 'torg=>org']};
        data.skdu = {'header' : ['thead=>org', 'torg=>org']};
        data.skd = {'header' : ['thead=>org', 'torg=>org']};
        data.skik = {'header' : ['thead=>org', 'torg=>org']};
        data.skck = {'header' : []};
        data.skp = {'header' : ['thead=>pindah']};
        data.sktm = {'header' : []};
        data.skbpm = {'header' : []};
        data.skel = {'header' : []};
        data.skem = {'header' : []};
        data.sk = {'header' : []};

        if (type_surat == '')
            return data;
        else
            return data[type_surat];
    }
    function docrt_merge_options(obj1,obj2){
        var obj3 = {};
        for (var attrname in obj1) { obj3[attrname] = obj1[attrname]; }
        for (var attrname in obj2) { obj3[attrname] = obj2[attrname]; }
        return obj3;
    }
});

jQuery(document).ready(function($) {

    var perangkat_jabatan = $('#docrt_perangkat_jabatan');
    var rw_option = $('#docrt_perangkat_jabatan_rw');
    var perangkat_no_jabatan_rw = $('#docrt_perangkat_jabatan_rw');
    perangkat_jabatan_change();
    rw_option_change();

    $(perangkat_jabatan).change(function(e) {
        perangkat_jabatan_change();
    });

    $(rw_option).change(function(e) {
        rw_option_change();
    });

    function perangkat_jabatan_change() {
        if (perangkat_jabatan.val() == 'RW') {
            $("#docrt_perangkat_jabatan_rw").addClass('d-hide');
        } else {
            $("#docrt_perangkat_jabatan_rw").removeClass('d-hide');
        }
    }

    function rw_option_change() {
        var rw_txt = $("#docrt_perangkat_jabatan_rw option:selected").text();
        $("#docrt_perangkat_no_jabatan_rw").val(rw_txt);
    }
});

/*jQuery(document).ready(function($) {
    var $sidebar   = $("#side-sortables"),
        $window    = $(window),
        offset     = $sidebar.offset(),
        topPadding = 50;

    $window.scroll(function() {
        if ($window.scrollTop() > offset.top) {
            $sidebar.stop().animate({
                marginTop: $window.scrollTop() - offset.top + topPadding
            });
        } else {
            $sidebar.stop().animate({
                marginTop: 0
            });
        }
    });

});*/
