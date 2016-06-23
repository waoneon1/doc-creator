var configurator_array = [];
var configurator_product = '';
var VPC_CONFIG = (function ($, vpc_config) {
    'use strict';
    $(document).ready(function () {
        var conf_id = ids.conf;
        var current_page = 1;
        var numPages = $('#prgen-page').data("numpages");

        console.log(conf_id);
        changePage(1);

        if (conf_id) {
             prgen_default_preview();
        }

        $(document).on("click", ".prgen-option a", function (e) { //vpc-options
            e.preventDefault();
            prgen_select_option(this);
            prgen_build_preview();

        });
        $(document).on("click", "li[class^=prgen-top-option-] a.prgen-toggle", function (e) {
            $('.prgen-opt-toggle').slideToggle('fast'); //vpc-options
        });

        $(document).on("click", "#pegen_admin_edit_product", function (e) {
            console.log('m150 bisa');
        });

        window.prgen_select_option = function(opt) {
            var parent_id = $(opt).data("parent");

            //console.log(parent_id);
            if (parent_id != '####') {
                $('.prgen-option a').removeClass('selected-'+parent_id);
                $(opt).addClass('selected-'+parent_id);
            }
        }


        window.prgen_build_preview = function()
        {
            $("#prgen-preview").html("");
            configurator_array = [];

            $('.prgen-option a[class^=selected-]').each(function ()
            {
                var src = $(this).data("img");
                var parent = $(this).data("parent");
                var optId = $(this).data("opt-id");
                configurator_product = $(this).data("product-id");

                if (src)
                {
                    $("#prgen-preview").prepend("<img src='" + src + "'>");
                    if (optId){
                        configurator_array.push(optId);
                    }
                    else {
                        configurator_array.push(parent);
                    }
                }

            });
        }

        function prgen_final_preview(obj)
        {
            obj.success(function (datas) {

                var data = JSON.parse(datas);
                var post_content = '-';
                var prgen_disclaimer = '-';
                prgen_clear_final_preview();

                var parts = configurator_array.join();
                $.each(data, function (cid, set) {

                    if (set.post_content)
                        post_content = set.post_content;
                    if (set.prgen_disclaimer)
                        prgen_disclaimer = set.prgen_disclaimer;

                    $('#prgen-final-result ul').append(
                    '<li><img src="'+set.prgen_img+'" alt=""><p><strong>Title : </strong> '+set.post_title+'</p><p><strong>Description : </strong> '+post_content+'</p><p><strong>Disclaimer : </strong> '+prgen_disclaimer+'</p></li>'
                    );
                });
                $('input#prgen_parts').val(parts);
                $('input#prgen_product_id').val(configurator_product);
                $('input#prgen_conf_id').val(conf_id);
            });


        }

        function prgen_ajax_option()
        {
            var data = {
                'data': configurator_array
            };
            var ajax_url = ajax_params.ajax_url + 'option.php';
            return $.post(ajax_url, data, function(response) {

            });
        }

        function prgen_ajax_configuration(param)
        {
            var data = {
                'data': param
            };
            var ajax_url = ajax_params.ajax_url + 'configuration.php';
            return $.post(ajax_url, data, function(response) {
            });
        }

        function prgen_default_preview()
        {

            var conf_data = prgen_ajax_configuration(conf_id);

            conf_data.success(function (conf_datas) {
                var cdata = JSON.parse(conf_datas);
                var part_id = cdata.prgen_part_id.split(",");

                configurator_array = part_id;

                current_page = numPages;
                current_page++;
                changePage(current_page);

                $('.prgen-final').removeClass('hide');
                document.getElementById("prgen-btn-finish").style.display = "none";
                $('li[class^=prgen-top-option-]').addClass('hide');

                var obj = prgen_ajax_option();

                prgen_final_preview(obj);

                obj.success(function (datas) {
                    var data = JSON.parse(datas);
                    console.log(data);
                    $("#prgen-preview").html("");

                    $.each(data, function (cid, set) {
                        $("#prgen-preview").append("<img src='" + set.prgen_img_full + "'>");

                        var a = $( ".prgen-option" ).find("ul li a[data-opt-id='" + set.ID + "']");

                        if ($(a).data('parent')) {
                            var data_parent = $(a).data('parent');
                            $( ".prgen-option" ).find("ul li a[data-opt-id='" + set.ID + "']").addClass('selected-'+data_parent);
                        } else {
                            a = $( ".prgen-option" ).find("ul li a[data-parent='" + set.ID + "']");
                            var data_parent = $(a).data('parent');
                            $( ".prgen-option" ).find("ul li a[data-parent='" + set.ID + "']").addClass('selected-'+data_parent);
                        }
                    });

                });
            });

        }

        function prgen_clear_final_preview() {
             $('#prgen-final-result ul').html("");
        }


         $(document).on("click", "#prgen-btn-finish", function (e) {
            e.preventDefault();


            $('.prgen-final').removeClass('hide');
            document.getElementById("prgen-btn-finish").style.display = "none";
            $('li[class^=prgen-top-option-]').addClass('hide');

            console.log(configurator_array);
            var obj = prgen_ajax_option();
            prgen_final_preview(obj);

        });

        /* * * * * * *
        *
        * ~ PAGING ~
        *
        */


        function showOption(page)
        {
            //$('li[class^=prgen-top-option-]').addClass('hide');
            $('li.prgen-top-option-'+page).removeClass('hide');
            //console.log('li.prgen-top-option-'+page);
        }

        function prevPage()
        {
            if (current_page > 1) {
                $('li.prgen-top-option-'+current_page).addClass('hide');
                current_page--;
                changePage(current_page);
            }
        }

        function nextPage()
        {
            if (current_page < numPages) {
                $('li.prgen-top-option-'+current_page).addClass('hide');
                current_page++;
                changePage(current_page);
            }
        }

        $(document).on("click", "#prgen-btn-next", function (e) {
            e.preventDefault();
            nextPage();
            showOption();
        });

        $(document).on("click", "#prgen-btn-prev", function (e) {
            e.preventDefault();
            prevPage();
            showOption();
        });

        function changePage(page)
        {
            var btn_next = document.getElementById("prgen-btn-next");
            var btn_prev = document.getElementById("prgen-btn-prev");
            var btn_finish = document.getElementById("prgen-btn-finish");
            btn_finish.style.display = "none";
            $('.prgen-final').addClass('hide');

            // Validate page
            if (page < 1) page = 1;
            if (page > numPages) page = numPages;

            showOption(page);
            console.log(page);

            if (page == 1) {
                btn_prev.style.display = "none";
            } else {
                btn_prev.style.display = "block";
            }

            if (page == numPages) {
                btn_finish.style.display = "block";
                btn_next.style.display = "none";
            } else {
                btn_next.style.display = "block";
            }
        }

        /* * * * * * *
        *
        * ~ Finish ~
        *
        */


    });

    return vpc_config;
}(jQuery, VPC_CONFIG));