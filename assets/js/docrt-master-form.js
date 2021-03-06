jQuery(document).ready(function($) {

    tes_docrt_form_selected();
    docrt_kusus_skp();
    docrt_kusus_skel();

    $(".docrt_type_surat_box input:radio").click(function() {
        tes_docrt_form_selected();
    });

    // tambah form pengikut khusus skp
    $("#docrt_form_pengikut").change(function(e) {
        docrt_kusus_skp();
    });

    //  form kembar khusus skel
    $("#docrt_form_kelahiran").change(function(e) {
        docrt_kusus_skel();
    });

    function tes_docrt_form_selected() {
        var form_class = '';
        var tr_tag = $(".docrt_pemohon_box .docrt_form");
        var type_surat = $(".docrt_type_surat_box input[type='radio']:checked").data('typesurat');
        var param = docrt_form_data(type_surat);

        var data = {
            'data': param
        };
        var ajax_url = ajax_params.ajax_url + 'configuration.php';
        return $.post(ajax_url, data, function(response) {
        });
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
                'docrt_form_tujuan',
                'docrt_form_tgl_berlaku',
                'docrt_form_ketRT',
                'docrt_form_nama_usaha',
                'docrt_form_alamat_usaha'
            ]
        };

        // 2. data surat keterangan domisili usaha ===================================================================================================
        data.skdu ={
            'surat' : [
                'docrt_form_nama',
                'docrt_form_ttl',
                'docrt_form_agama',
                'docrt_form_pekerjaan',
                'docrt_form_alamat',
                'docrt_form_kelurahan',
                'docrt_form_kecamatan',
                'docrt_form_kota',
                'docrt_form_nama_usaha',
                'docrt_form_alamat_usaha',
                'docrt_form_ketRT',
                'docrt_form_rtrw_usaha',
                'docrt_form_tgl',
                'docrt_form_keperluan',
                'docrt_form_ket_usaha'
            ]
        };
        // 3. data surat keterangan domisili usaha ===================================================================================================
        data.skd ={
            'surat' : [
                'docrt_form_nama_usaha',
                'docrt_form_alamat_usaha',
                'docrt_form_rtrw',
                'docrt_form_kelurahan',
                'docrt_form_kecamatan',
                'docrt_form_kota',
                'docrt_form_nama_noinduk_lembaga',
                'docrt_form_noinduk_lembaga',
                'docrt_form_nama_lembaga',
                'docrt_form_nama',
                'docrt_form_alamat',
                'docrt_form_tujuan'
            ]
        };
        // 4. data surat keterangan ijin keramaian ===================================================================================================
        data.skik ={
            'surat' : [
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
                'docrt_form_tujuan',
                'docrt_form_tgl_berlaku',
                'docrt_form_ketRT',
                'docrt_form_nama_acara',
                'docrt_form_tgl_acara'
            ]
        };
        // 5. data surat keterangan catatan kepolisian ===================================================================================================
        data.skck ={
            'surat' : [
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
                'docrt_form_tujuan',
                'docrt_form_tgl_berlaku',
                'docrt_form_ketRT'
            ]
        };
        // 6. data surat keterangan pindah  ===================================================================================================
        data.skp ={
            'surat' : [
                'docrt_form_nama',
                'docrt_form_ttl',
                'docrt_form_jk',
                'docrt_form_kebangsaan',
                'docrt_form_agama',
                'docrt_form_sperkawinan',
                'docrt_form_pekerjaan',
                'docrt_form_pendidikan',
                'docrt_form_alamat',
                'docrt_form_nokk',
                //no rek (no surat)
                'docrt_form_nonik',
                'docrt_form_ketRT',
                'docrt_form_tgl',
                'docrt_form_keperluan',
                'docrt_form_tujuan',
                //{pindah ke}
                'docrt_form_desa_pindah',
                'docrt_form_kecamatan_pindah',
                'docrt_form_kabkota_pindah',
                'docrt_form_provinsi_pindah',
                'docrt_form_tgl_pindah',
                'docrt_form_tgl_berlaku',
                'docrt_form_alasan_pindah',
                'docrt_form_pengikut',
                //{yaitu}
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
                'docrt_form_nama_bayi',
                'docrt_form_nonik_bayi',
                'docrt_form_dilahirkan1',
                'docrt_form_dilahirkan2',
                'docrt_form_dilahirkan3',
                'docrt_form_kelahiran',
                'docrt_form_kembarke',
                'docrt_form_anakke',
                'docrt_form_nama_ibu',
                'docrt_form_nama_ayah',
                'docrt_form_penolong_lahir',
                'docrt_form_tgl',
                'docrt_form_jam',
                'docrt_form_jk_bayi',
                'docrt_form_tempat',
                'docrt_form_kota_bayi',
                'docrt_form_alamat_ibu',
                'docrt_form_kebangsaan_ibu',
                'docrt_form_kebangsaan_ayah',
                'docrt_form_nokk_ayah',
                'docrt_form_nonik_ayah',
                'docrt_form_nama',
                'docrt_form_hubungan',
                'docrt_form_nonik_ibu',
                'docrt_form_pekerjaan_ibu',
                'docrt_form_tlp_ibu',
                'docrt_form_alamat_ayah',
                'docrt_form_pekerjaan_ayah',
                'docrt_form_tlp_ayah',
                'docrt_form_umur',
                'docrt_form_nonik',
                'docrt_form_pekerjaan',
                'docrt_form_alamat',
                'docrt_form_tlp',
                'docrt_form_saksi'
            ]
        };
        // 10. data surat kematian ===================================================================================================
        data.skem ={
            'surat' : [
                'docrt_form_nama_mati',//
                'docrt_form_jk',
                'docrt_form_alamat',
                'docrt_form_ttl',
                'docrt_form_umur',//
                'docrt_form_tgl',
                'docrt_form_tempat',//
                'docrt_form_kelurahan',
                'docrt_form_kota',
                'docrt_form_kebangsaan',
                'docrt_form_agama',
                'docrt_form_sperkawinan',
                'docrt_form_pekerjaan',
                'docrt_form_sebab_kematian',
                'docrt_form_nokk',
                'docrt_form_nonik',
                'docrt_form_nama',
                'docrt_form_hubungan',//

                'docrt_form_dilahirkan_pelapor',
                'docrt_form_dilahirkan2',
                'docrt_form_dilahirkan3',
                'docrt_form_nokk_ayah',
                'docrt_form_nama_ayah',
                'docrt_form_nama_ibu',
                'docrt_form_nama_pelapor',
                'docrt_form_nonik_ayah',
                'docrt_form_nonik_ibu',
                'docrt_form_nonik_pelapor',
                'docrt_form_pekerjaan_ayah',
                'docrt_form_pekerjaan_ibu',
                'docrt_form_pekerjaan_pelapor',
                'docrt_form_alamat_ayah',
                'docrt_form_alamat_ibu',
                'docrt_form_alamat_pelapor',
                'docrt_form_anakke',
                'docrt_form_jam',
                'docrt_form_yang_menerangkan',
                'docrt_form_saksi'

            ]
        };
        // 11. kk ===================================================================================================
        data.kk ={
            'surat' : [
                'docrt_form_nokk',
                'docrt_form_nama',
                'docrt_form_alamat',
                'docrt_form_rtrw',
                'docrt_form_kelurahan',
                'docrt_form_kecamatan',
                'docrt_form_kota',
                'docrt_form_provinsi',
                'docrt_form_tgl'
            ]
        };
        // 12. ktp ===================================================================================================
        data.ktp ={
            'surat' : [
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
                'docrt_form_tgl_berlaku',
            ]
        };
        // 13. data surat keterangan ===================================================================================================
        data.sk ={
            'surat' : [
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
                'docrt_form_tujuan',
                'docrt_form_tgl_berlaku',
                'docrt_form_ketRT',
                'docrt_form_menerangkan_bahwa'
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
