var Auth = function () {
    return {
        check: function (url) {
            var result = 0;
            $.ajax({
                type: "POST",
                url: URL + "/thanh-vien/check-login",
                data: {
                    'url': url
                },
                async: false,
                success: function (data) {
                    if (data == 1){
                        result = 1;
                    }
                }
            });
            return result;
        },
        check_2: function () {
            //  alert('chào nha 2');
        }
    };

}();

//luuhoabk
var iconload = function() {
    return {
        load: function(tag, iclass){
            tag.removeClass(iclass);
            tag.addClass('animate-spin icon-spin3');
        },
        unload: function(tag, iclass){
            tag.addClass(iclass);
            tag.removeClass('animate-spin icon-spin3');
        }
    }
}();
var Layout = function () {
    // IE mode
    var isRTL = false;
    var isIE8 = false;
    var isIE9 = false;
    var isIE10 = false;
    var isIE11 = false;

    var responsive = true;

    var responsiveHandlers = [];

    var handleInit = function () {
        if ($('body').css('direction') === 'rtl') {
            isRTL = true;
        }

        isIE8 = !!navigator.userAgent.match(/MSIE 8.0/);
        isIE9 = !!navigator.userAgent.match(/MSIE 9.0/);
        isIE10 = !!navigator.userAgent.match(/MSIE 10.0/);
        isIE11 = !!navigator.userAgent.match(/MSIE 11.0/);

        if (isIE10) {
            jQuery('html').addClass('ie10'); // detect IE10 version
        }
        if (isIE11) {
            jQuery('html').addClass('ie11'); // detect IE11 version
        }
    }

// Handles portlet tools & actions 
    var handlePortletTools = function () {
        jQuery('body').on('click', '.portlet > .portlet-title > .tools > a.remove', function (e) {
            e.preventDefault();
            jQuery(this).closest(".portlet").remove();
        });

        jQuery('body').on('click', '.portlet > .portlet-title > .tools > a.reload', function (e) {
            e.preventDefault();
            var el = jQuery(this).closest(".portlet").children(".portlet-body");
            var url = jQuery(this).attr("data-url");
            var error = $(this).attr("data-error-display");
            if (url) {
                Metronic.blockUI({target: el, iconOnly: true});
                $.ajax({
                    type: "GET",
                    cache: false,
                    url: url,
                    dataType: "html",
                    success: function (res) {
                        Metronic.unblockUI(el);
                        el.html(res);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        Metronic.unblockUI(el);
                        var msg = 'Error on reloading the content. Please check your connection and try again.';
                        if (error == "toastr" && toastr) {
                            toastr.error(msg);
                        } else if (error == "notific8" && $.notific8) {
                            $.notific8('zindex', 11500);
                            $.notific8(msg, {theme: 'ruby', life: 3000});
                        } else {
                            alert(msg);
                        }
                    }
                });
            } else {
                // for demo purpose
                Metronic.blockUI({target: el, iconOnly: true});
                window.setTimeout(function () {
                    Metronic.unblockUI(el);
                }, 1000);
            }
        });

        // load ajax data on page init
        $('.portlet .portlet-title a.reload[data-load="true"]').click();

        jQuery('body').on('click', '.portlet > .portlet-title > .tools > .collapse, .portlet .portlet-title > .tools > .expand', function (e) {
            e.preventDefault();
            var el = jQuery(this).closest(".portlet").children(".portlet-body");
            if (jQuery(this).hasClass("collapse")) {
                jQuery(this).removeClass("collapse").addClass("expand");
                el.slideUp(200);
            } else {
                jQuery(this).removeClass("expand").addClass("collapse");
                el.slideDown(200);
            }
        });
    }

    var loadDialogMapVinh = function () {

        var html = '<div class="input-group loacation-search-wrapper">';
        html += '<span class="input-group-btn bg-grey"><i class="icon-search"></i></span>';
        html += '<input id="location-search" type="text" placeholder=" Tìm địa điểm..." class="form-control">';
        html += '</div>';
        html += '<div id="location-gmap"></div>';

        var content_browser = $("#content-browser").html();
        var ss = $(content_browser).prop('outerHTML');


        console.log(ss);

        bootbox.dialog({
            message: ss,
            title: "Vị trí địa điểm2",
            buttons: {
                default: {
                    label: "Đóng",
                    className: "btn-default"
                },
                main: {
                    label: "Hoàn tất",
                    className: "btn-primary",
                    callback: function () {
                        //   createLocation_frm.find('#location-position').val(markerLocation.getPosition());
                    }
                }
            }
        });


    }

    // runs callback functions set by App.addResponsiveHandler().
    var runResponsiveHandlers = function () {
        // reinitialize other subscribed elements
        for (var i in responsiveHandlers) {
            var each = responsiveHandlers[i];
            each.call();
        }
    }

    // handle the layout reinitialization on window resize
    var handleResponsiveOnResize = function () {
        var resize;
        if (isIE8) {
            var currheight;
            $(window).resize(function () {
                if (currheight == document.documentElement.clientHeight) {
                    return; //quite event since only body resized not window.
                }
                if (resize) {
                    clearTimeout(resize);
                }
                resize = setTimeout(function () {
                    runResponsiveHandlers();
                }, 50); // wait 50ms until window resize finishes.                
                currheight = document.documentElement.clientHeight; // store last body client height
            });
        } else {
            $(window).resize(function () {
                if (resize) {
                    clearTimeout(resize);
                }
                resize = setTimeout(function () {
                    runResponsiveHandlers();
                }, 50); // wait 50ms until window resize finishes.
            });
        }
    }

    var handleIEFixes = function () {
        //fix html5 placeholder attribute for ie7 & ie8
        if (isIE8 || isIE9) { // ie8 & ie9
            // this is html5 placeholder fix for inputs, inputs with placeholder-no-fix class will be skipped(e.g: we need this for password fields)
            jQuery('input[placeholder]:not(.placeholder-no-fix), textarea[placeholder]:not(.placeholder-no-fix)').each(function () {

                var input = jQuery(this);

                if (input.val() == '' && input.attr("placeholder") != '') {
                    input.addClass("placeholder").val(input.attr('placeholder'));
                }

                input.focus(function () {
                    if (input.val() == input.attr('placeholder')) {
                        input.val('');
                    }
                });

                input.blur(function () {
                    if (input.val() == '' || input.val() == input.attr('placeholder')) {
                        input.val(input.attr('placeholder'));
                    }
                });
            });
        }
    }

    // Handles scrollable contents using jQuery SlimScroll plugin.
    var handleScrollers = function () {
        $('.scroller').each(function () {
            var height;
            if ($(this).attr("data-height")) {
                height = $(this).attr("data-height");
            } else {
                height = $(this).css('height');
            }
            $(this).slimScroll({
                allowPageScroll: true, // allow page scroll when the element scroll is ended
                size: '7px',
                color: ($(this).attr("data-handle-color") ? $(this).attr("data-handle-color") : '#bbb'),
                railColor: ($(this).attr("data-rail-color") ? $(this).attr("data-rail-color") : '#eaeaea'),
                position: isRTL ? 'left' : 'right',
                height: height,
                alwaysVisible: ($(this).attr("data-always-visible") == "1" ? true : false),
                railVisible: ($(this).attr("data-rail-visible") == "1" ? true : false),
                disableFadeOut: true
            });
        });
    }

    var handleSearch = function () {
        $('.search-btn').click(function () {
            if ($('.search-btn').hasClass('show-search-icon')) {
                if ($(window).width() > 767) {
                    $('.search-box').fadeOut(300);
                } else {
                    $('.search-box').fadeOut(0);
                }
                $('.search-btn').removeClass('show-search-icon');
            } else {
                if ($(window).width() > 767) {
                    $('.search-box').fadeIn(300);
                } else {
                    $('.search-box').fadeIn(0);
                }
                $('.search-btn').addClass('show-search-icon');
            }
        });

        // close search box on body click
        if ($('.search-btn').size() != 0) {
            $('.search-box, .search-btn').on('click', function (e) {
                e.stopPropagation();
            });

            $('body').on('click', function () {
                if ($('.search-btn').hasClass('show-search-icon')) {
                    $('.search-btn').removeClass("show-search-icon");
                    $('.search-box').fadeOut(300);
                }
            });
        }
    }

    var handleMenu = function () {
        $(".header .navbar-toggle").click(function () {
            if ($(".header .navbar-collapse").hasClass("open")) {
                $(".header .navbar-collapse").slideDown(300)
                    .removeClass("open");
            } else {
                $(".header .navbar-collapse").slideDown(300)
                    .addClass("open");
            }
        });
    }

    var handleSubMenuExt = function () {
        $(".header-navigation .dropdown").on("hover", function () {
            if ($(this).children(".header-navigation-content-ext").show()) {
                if ($(".header-navigation-content-ext").height() >= $(".header-navigation-description").height()) {
                    $(".header-navigation-description").css("height", $(".header-navigation-content-ext").height() + 22);
                }
            }
        });
    }

    var handleSidebarMenu = function () {
        $(".sidebar .dropdown a i").click(function (event) {
            event.preventDefault();
            if ($(this).parent("a").hasClass("collapsed") == false) {
                $(this).parent("a").addClass("collapsed");
                $(this).parent("a").siblings(".dropdown-menu").slideDown(300);
            } else {
                $(this).parent("a").removeClass("collapsed");
                $(this).parent("a").siblings(".dropdown-menu").slideUp(300);
            }
        });
    }

    function handleDifInits() {
        $(".header .navbar-toggle span:nth-child(2)").addClass("short-icon-bar");
        $(".header .navbar-toggle span:nth-child(4)").addClass("short-icon-bar");
    }

    function handleUniform() {
        if (!jQuery().uniform) {
            return;
        }
        var test = $("input[type=checkbox]:not(.toggle), input[type=radio]:not(.toggle, .star)");
        if (test.size() > 0) {
            test.each(function () {
                if ($(this).parents(".checker").size() == 0) {
                    $(this).show();
                    $(this).uniform();
                }
            });
        }
    }

    var handleFancyboxA = function () {
        /*  if (!jQuery.fancybox) {
         return;
         }


         if (jQuery(".fancybox-button").size() > 0) {
         jQuery(".fancybox-button").fancybox({
         groupAttr: 'data-rel',
         prevEffect: 'none',
         nextEffect: 'none',
         closeBtn: true,
         helpers: {
         title: {
         type: 'inside'
         }
         }
         });

         $('.fancybox-video').fancybox({
         type: 'iframe'
         });
         }
         */

    }

    // Handles Bootstrap Accordions.
    var handleAccordions = function () {

        jQuery('body').on('shown.bs.collapse', '.accordion.scrollable', function (e) {
            Layout.scrollTo($(e.target), -100);
        });

    }

    // Handles Bootstrap Tabs.
    var handleTabs = function () {
        // fix content height on tab click
        $('body').on('shown.bs.tab', '.nav.nav-tabs', function () {
            handleSidebarAndContentHeight();
        });

        //activate tab if tab id provided in the URL
        if (location.hash) {
            var tabid = location.hash.substr(1);
            $('a[href="#' + tabid + '"]').click();
        }
    }

    var handleMobiToggler = function () {
        $(".mobi-toggler").on("click", function (event) {
            event.preventDefault();//the default action of the event will not be triggered

            $(".header").toggleClass("menuOpened");
            $(".header").find(".header-navigation").toggle(300);
        });
    }

    var handleMobiMenu = function () {
        $(".mobi_menubar").on("click", function (event) {
            event.preventDefault();//the default action of the event will not be triggered

            $('.header-navigation').toggle(300);
        });
    }
    var handleMobiSearch = function () {
        $(".mobi_search").on("click", function (event) {
            event.preventDefault();//the default action of the event will not be triggered

            $('.box-search').toggle(300);
        });
    }

    var handleTheme = function () {

        var panel = $('.color-panel');

        // handle theme colors
        var setColor = function (color) {
            $('#style-color').attr("href", "../../assets/frontend/layout/css/themes/" + color + ".css");
            $('.corporate .site-logo img').attr("src", "../../assets/frontend/layout/img/logos/logo-corp-" + color + ".png");
            $('.ecommerce .site-logo img').attr("src", "../../assets/frontend/layout/img/logos/logo-shop-" + color + ".png");
        }

        $('.icon-color', panel).click(function () {
            $('.color-mode').show();
            $('.icon-color-close').show();
        });

        $('.icon-color-close', panel).click(function () {
            $('.color-mode').hide();
            $('.icon-color-close').hide();
        });

        $('li', panel).click(function () {
            var color = $(this).attr("data-style");
            setColor(color);
            $('.inline li', panel).removeClass("current");
            $(this).addClass("current");
        });
    }
    var handleMediaBrowser = function () {


        var type_insert = "";

        $(".insertMedia").click(function () {
            type_insert = $(this).attr('type_insert');
        });

        $("#insert-media-browser").click(function () {

            var url = $('#url-edit-media').attr('data-img-url');
            var result = true;
            if (url != '') {

                var img = '<img src="' + URL + url + '" />';

                switch (type_insert) {
                    case "location_load_avatar": //luuhoabk (location/location.js)
                        Location.loadAvatar();
                        break;
                    case "location_load_album": //luuhoabk (location/location.js)
                        result = Location.loadAlbum();
                        break;

                    case "location_insert_album": //luuhoabk (location/location.js)
                        result = Location.insertAlbum();
                        break;

                    case "insert_one_img":
                        $(".abc").html(img);

                        break;

                    case "insert_multi_img":
                        $(".abc").append(img);
                        break;

                    case "insert_one_url":
                        break;
                    case "insert_one_url_location":

                        //   Location::abc(url);
                        //  $(".abc").html(url);
                        break;

                    case "insert_one_img_anh_bia":
                        $(".person-header-bg").attr('style', 'background-image: url(' + url + ')');
                        $(".person-header-bg").attr('url_img', url);
                        $(".btn-save-anh-bia").show();
                        break;

                    case "insert_one_img_avatar":
                        $(".avatar-pad2").attr('src', url);
                        //   $(".person-header-bg").attr('url_img',url);
                        $(".btn-save-avatar").show();
                        break;

                    default:
                        break;
                }
            } else {
                bootbox.alert('bạn chưa chọn hình ảnh !');
                result = false;
            }
            return result;

        });


        $(".btn-save-anh-bia").click(function () {
            var url_img = $(".person-header-bg").attr('url_img');
            //  alert(url);

            $.ajax({
                type: "POST",
                url: URL + "/trang-ca-nhan/chinh-sua-thong-tin.html",
                data: {
                    'background': url_img,
                    'type_edit': 'change_anh_bia'
                },
                cache: false,
                success: function (data) {
                    $(".btn-save-anh-bia").hide();
                }
            });
        });


        $(".btn-save-avatar").click(function () {
            var url_img = $(".avatar-pad2").attr('src');
            //  alert(url);

            $.ajax({
                type: "POST",
                url: URL + "/trang-ca-nhan/chinh-sua-thong-tin.html",
                data: {
                    'avatar': url_img,
                    'type_edit': 'change_avatar'
                },
                cache: false,
                success: function (data) {
                    $(".btn-save-avatar").hide();
                }
            });
        });
    }


    var handleComponentLayout = function () {

        /**btb select*/
        $("section.person-content .person-content-item .person-type-scopy ul li").click(function () {
            // alert('ád');
            var value = $(this).html();
            var id = $(this).attr('value_id');
            var item_parend = $(this).parents("section.person-content .person-content-item .person-type-scopy");
            var item = item_parend.find("button").first();
            item.html(value);
            item.attr('value_id', id);
            //   alert(item.html());
        });
        /***/
    }

    var handleBlog = function () {
        var id_user_blog = $('.person-header-username').attr('id_u_blo');
        var id_user_auth = $(".item-status-value").attr('user_auth_id');


        /**
         * Đăng status
         */

        $(document).on("click", ".btn-add-status", function () {
            var content_status = $("#content-status").val();
            var privacy_status = $("#privacy-status").attr("value_id");

            $.ajax({
                type: "POST",
                url: URL + "/trang-ca-nhan/trang-thai.html",
                data: {
                    'content': content_status,
                    'privacy': privacy_status,
                    'type_edit': 'add_status',
                    'id_user_blog': id_user_blog

                },
                sync: true,
                success: function (data) {
                    $.ajax({
                        type: "POST",
                        url: URL + "/trang-ca-nhan/load-item-status-" + data,
                        data: {},
                        sync: true,
                        success: function (data_1) {
                            // $( data_1 ).insertAfter( ".form-add-status");
                            $(data_1).prependTo("#feed-blog-post-top");

                        }
                    });
                }
            });
            $("#content-status").val('');

        });


        /*-------------end đang status*/

        $(document).on("click", "a.btn-blog-post-like", function () {
            var parent_item_element = $(this).parents('div.person-content-item');
            var input_element = parent_item_element.find('input.item-status-value');
            var lab_like_element = parent_item_element.find('span.lab-blog-post-like');
            var btn_like_element = parent_item_element.find('a.btn-blog-post-like');
            var post_id = input_element.attr('post_id');
            var user_auth_id = input_element.attr('user_auth_id');
            var user_author_id = input_element.attr('user_author_id');
            var type_action_like = $(this).attr('type_action_like');


            $.ajax({
                type: "POST",
                url: URL + "/trang-ca-nhan/trang-thai.html",
                dataType: 'JSON',

                data: {
                    'post_id': post_id,
                    'user_auth_id': user_auth_id,
                    'user_author_id': user_author_id,
                    'type_edit': 'like_status',
                    'type_action_like': type_action_like,
                    'id_user_blog': id_user_blog

                },
                sync: false,
                success: function (data_1) {
                    if (data_1.type_action_like === 'type_action_like') {
                        lab_like_element.html(data_1.number_like);
                        btn_like_element.attr('type_action_like', 'type_action_dislike');
                        btn_like_element.html('Đã thích');
                    } else {
                        lab_like_element.html(data_1.number_like);
                        btn_like_element.attr('type_action_like', 'type_action_like');
                        btn_like_element.html('Thích');
                    }
                }
            });
        });


        /***
         * like status
         *
         * */


        $(document).on("click", "a.btn-blog-post-like", function () {
            var parent_item_element = $(this).parents('div.person-content-item');
            var input_element = parent_item_element.find('input.item-status-value');
            var lab_like_element = parent_item_element.find('span.lab-blog-post-like');
            var btn_like_element = parent_item_element.find('a.btn-blog-post-like');
            var post_id = input_element.attr('post_id');
            var user_auth_id = input_element.attr('user_auth_id');
            var user_author_id = input_element.attr('user_author_id');
            var type_action_like = $(this).attr('type_action_like');


            $.ajax({
                type: "POST",
                url: URL + "/trang-ca-nhan/trang-thai.html",
                dataType: 'JSON',

                data: {
                    'post_id': post_id,
                    'user_auth_id': user_auth_id,
                    'user_author_id': user_author_id,
                    'type_edit': 'like_status',
                    'type_action_like': type_action_like,
                    'id_user_blog': id_user_blog

                },
                sync: false,
                success: function (data_1) {
                    if (data_1.type_action_like == 'type_action_like') {
                        lab_like_element.html(data_1.number_like);
                        btn_like_element.attr('type_action_like', 'type_action_dislike');
                        btn_like_element.html('Đã thích');
                    } else {
                        lab_like_element.html(data_1.number_like);
                        btn_like_element.attr('type_action_like', 'type_action_like');
                        btn_like_element.html('Thích');
                    }
                }
            });
        });


        $(".btn-blog-post-like1").click(function () {
            var parent_item_element = $(this).parents('div.person-content-item');
            var input_element = parent_item_element.find('input.item-status-value');
            var lab_like_element = parent_item_element.find('span.lab-blog-post-like');
            var btn_like_element = parent_item_element.find('a.btn-blog-post-like');
            var post_id = input_element.attr('post_id');
            var user_auth_id = input_element.attr('user_auth_id');
            var user_author_id = input_element.attr('user_author_id');
            var type_action_like = $(this).attr('type_action_like');


            $.ajax({
                type: "POST",
                url: URL + "/trang-ca-nhan/trang-thai.html",
                dataType: 'JSON',

                data: {
                    'post_id': post_id,
                    'user_auth_id': user_auth_id,
                    'user_author_id': user_author_id,
                    'type_edit': 'like_status',
                    'type_action_like': type_action_like,
                    'id_user_blog': id_user_blog

                },
                sync: false,
                success: function (data_1) {

                    // alert(data_1.number_like);

                    if (data_1.type_action_like == 'type_action_like') {
                        lab_like_element.html(data_1.number_like);
                        btn_like_element.attr('type_action_like', 'type_action_dislike');
                        btn_like_element.html('Đã thích');
                    } else {
                        lab_like_element.html(data_1.number_like);
                        btn_like_element.attr('type_action_like', 'type_action_like');
                        btn_like_element.html('Thích');
                    }

                    //   alert()
                    // lab_like_element.html(data_1);
                }
            });

        });
        /**------------end dislike*/


        /**
         * comment blog
         * */


        $(document).on("click", "a.btn-blog-post-comment", function () {
            var parent_item_element = $(this).parents('div.person-content-item');
            var input_comment_element = parent_item_element.find('input.txt-blog-post-comment');
            input_comment_element.focus();
        });

        $(document).on("keyup", "input.txt-blog-post-comment", function (e) {

            if (e.keyCode == 13) {
                var parent_item_element = $(this).parents('div.person-content-item');
                var input_element = parent_item_element.find('input.item-status-value');
                var parent_vt_element = parent_item_element.find("div.list-blog-post-comment");

                var post_id = input_element.attr('post_id');
                var content_comment = $(this).val();
                //    alert(parent_vt_element.html());
                $.ajax({
                    type: "POST",
                    url: URL + "/trang-ca-nhan/trang-thai.html",
                    data: {
                        'post_id': post_id,
                        'type_edit': 'comment_post',
                        'content_comment': content_comment,
                        'id_user_blog': id_user_blog

                    },
                    dataType: 'JSON',
                    success: function (data_1) {
                        //    alert(data_1.date_at);
                        var html_item_comment = '   <div  class="col-md-12 article-img-text lab-blog-post-item-comment col-none-padding" i_user="' + data_1.id_user + '" i_comment="' + data_1.id_comment + '">';
                        html_item_comment += '     <div class="row margin-none">';
                        html_item_comment += '       <img class="col-md-1 col-ms-1 avatar-pad2" src="' + data_1.avatar_user + '" alt="">';
                        html_item_comment += '           <a style="font-size: 16px" class="lab-blog-post-content-comment" >' + data_1.username + '</a>' + data_1.date_at;
                        html_item_comment += '             <span class="col-md-11 col-ms-11 col-xs-11 txt-blog-post-comment" value="" >' + data_1.content + '</span>';
                        html_item_comment += '       </div><div class="btn-blog-post-comment-delete"><i class="icon-pencil-3"></i></div> </div>';
                        //  alert(data_1);

                        parent_item_element.find("span.lab-blog-post-number-comment").html(data_1.number_comment);

                        parent_vt_element.append(html_item_comment);
                    }
                });
                $(this).val('');
            }

        });


        $(document).on("click", "div.btn-blog-post-comment-delete", function () {
            var parent_post_element = $(this).parents("div.person-content-item");
            var parent_item_element = $(this).parents("div.lab-blog-post-item-comment");
            var id_comment = parent_item_element.attr('i_comment');
            var id_user = parent_item_element.attr('i_user');
            var id_parent_comment = parent_post_element.find("input.item-status-value").attr('post_id');

            $.ajax({
                type: "POST",
                url: URL + "/trang-ca-nhan/trang-thai.html",
                data: {
                    'id_comment': id_comment,
                    'id_user': id_user,
                    'id_parent_comment': id_parent_comment,
                    'type_edit': 'comment_delete',
                    'id_user_blog': id_user_blog

                },
                sync: true,
                success: function (data_1) {
                    //   $( data_1 ).insertAfter( ".form-add-status");
                    parent_post_element.find("span.lab-blog-post-number-comment").html(data_1);
                    parent_item_element.hide();
                }
            });

        });
        $(document).on("click", "li.btn-blog-post-status-delete", function () {
            var parent_item_element = $(this).parents('div.person-content-item');
            var input_element = parent_item_element.find('input.item-status-value');
            var id_status = input_element.attr('post_id');


            bootbox.confirm("Bạn chắc chắn muốn xoá trạng thái này ?", function (result) {
                if (result) {
                    $.ajax({
                        type: "POST",
                        url: URL + "/trang-ca-nhan/trang-thai.html",
                        data: {
                            'id_status': id_status,
                            'type_edit': 'status_delete',
                            'id_user_blog': id_user_blog
                        },
                        sync: true,
                        success: function (data_1) {
                            // $( data_1 ).insertAfter( ".form-add-status");
                            //  $("#feed-blog-post-top").append(data_1);

                            parent_item_element.hide();
                        }
                    });
                }
            });
            /*  */

        });

        /**
         * Gửi lời mới kết bạn
         * */
        $(document).on("click", "button.btn-aside-add-friend", function () {
            var id_friend = $(this).attr('i_u');
            var parent_item_element = $(this).parents("li.lab-btn-item-blog-friend");
            //alert(id_friend);

            $.ajax({
                type: "POST",
                url: URL + "/trang-ca-nhan/ban-be.html",
                data: {
                    'id_friend': id_friend,
                    'type_edit': 'request_add_friend',
                    'id_user_blog': id_user_blog
                },
                sync: false,
                success: function (data_1) {
                    parent_item_element.hide(200);
                }
            });


        });


        /****
         *
         *TagMenu Bạn Bè Blog
         *
         *
         * ------------------------------------------------------------------*/

        $("#btn-tag-blog-friend").click(function () {
            var element_list_friend = $(".person-friends-list").html();
            var id_user_blog = $(".person-header-username").attr("id_u_blo");

            var is_val = $(".person-friends-list").attr('is_val');
            //  alert('asdsad'+element_list_friend);

            if (is_val != '1') {
                $('.person-friends-list').html('<i class="icon-spin4 animate-spin"></i> loading...');
                $.ajax({
                    type: "POST",
                    url: URL + "/trang-ca-nhan/list-ban-be.html",
                    data: {
                        'id_user_blog': id_user_blog
                    },
                    sync: false,
                    success: function (data_1) {

                        //  parent_item_element.hide(200);
                        $(".person-friends-list").html(data_1.html);
                        $(".person-friends-list").attr('is_val', '1');
                        $("span.person-friends-list-total").html(data_1.total);
                    },
                    dataType: 'JSON'
                });
            }
        });

        $("#btn-tag-blog-photo").click(function () {
            var element_list_friend = $(".blog-photo-list-content").html();
            var id_user_blog = $(".person-header-username").attr("id_u_blo");

            var is_val = $(".blog-photo-list-content").attr('is_val');
            if (is_val != '1') {
                $('.blog-photo-list-content').html('<i class="icon-spin4 animate-spin"></i> loading...');
                $.ajax({
                    type: "POST",
                    url: URL + "/trang-ca-nhan/list-hinh-anh.html",
                    data: {
                        'id_user_blog': id_user_blog
                    },
                    sync: false,
                    success: function (data_1) {
                        $(".blog-photo-list-content").html(data_1.html);
                        $(".blog-photo-list-content").attr('is_val', '1');
                        //   $("span.person-friends-list-total").html(data_1.total);
                    },
                    dataType: 'JSON'
                });

            }


        });

        /**Tag check in*/

        $("#btn-tag-blog-checkin").click(function () {

            var element_list_friend = $(".blog-checkin-list-content").html();
            var id_user_blog = $(".person-header-username").attr("id_u_blo");

            var is_val = $(".blog-checkin-list-content").attr('is_val');

            if (is_val != '1') {
                $('.blog-checkin-list-content').html('<i class="icon-spin4 animate-spin"></i> loading...');
                $.ajax({
                    type: "POST",
                    url: URL + "/trang-ca-nhan/list-check-in.html",
                    data: {
                        'id_user_blog': id_user_blog
                    },
                    sync: false,
                    success: function (data_1) {
                        $(".blog-checkin-list-content").html(data_1.html);
                        $(".blog-checkin-list-content").attr('is_val', '1');

                    },
                    dataType: 'JSON'
                });

            }


        });

        /**end Tab check in*/


        /**Tab location like*/
        $("#btn-tag-blog-location-like").click(function () {

            var element_list_friend = $(".blog-photo-list-content").html();
            var id_user_blog = $(".person-header-username").attr("id_u_blo");

            var is_val = $(".blog-location-like-list-content").attr('is_val');

            if (is_val != '1') {
                $('.blog-location-like-list-content').html('<i class="icon-spin4 animate-spin"></i> loading...');
                $.ajax({
                    type: "POST",
                    url: URL + "/trang-ca-nhan/list-location-like.html",
                    data: {
                        'id_user_blog': id_user_blog
                    },
                    sync: false,
                    success: function (data_1) {
                        $(".blog-location-like-list-content").html(data_1.html);
                        $(".blog-location-like-list-content").attr('is_val', '1');

                    },
                    dataType: 'JSON'
                });

            }


        });

        /**end Tab location like*/


        /****
         *
         *End Tag Bạn Bè Blog
         *
         *--------------------------------------------------------------------*/

        /*
         $(".btn-blog-post-comment").click(function(){
         var parent_item_element=$(this).parents('div.person-content-item');
         var input_comment_element=parent_item_element.find('input.txt-blog-post-comment');
         input_comment_element.focus();


         });



         $('.txt-blog-post-comment').keyup(function(e) {
         if (e.keyCode == 13) {
         var parent_item_element=$(this).parents('div.person-content-item');
         var input_element=parent_item_element.find('input.item-status-value');
         var parent_vt_element=parent_item_element.find("div.list-blog-post-comment");

         var post_id=input_element.attr('post_id');
         var content_comment=$(this).val();
         //    alert(parent_vt_element.html());
         $.ajax({
         type: "POST",
         url: URL+"/trang-ca-nhan/trang-thai.html",
         data: {
         'post_id':post_id,
         'type_edit':'comment_post',
         'content_comment':content_comment

         },
         dataType:'JSON',
         success: function(data_1){
         //    alert(data_1.date_at);
         var html_item_comment='   <div class="col-md-12 article-img-text col-none-padding">';
         html_item_comment+='     <div class="row margin-none">';
         html_item_comment+='       <img class="col-md-1 col-ms-1 avatar-pad2" src="'+data_1.avatar_user+'" alt="">';
         html_item_comment+='           <a style="font-size: 16px" class="lab-blog-post-content-comment" >'+data_1.username+'</a>'+data_1.date_at;
         html_item_comment+='             <span class="col-md-11 col-ms-11 col-xs-11 txt-blog-post-comment" value="" >'+data_1.content+'</span>';
         html_item_comment+='       </div> </div>';
         //  alert(data_1);
         parent_vt_element.append(html_item_comment);
         }
         });



         }
         });*/


        /*-------------end comment*/


    };
    //luuhoabk
    var handleUser = function () {
        $(".btn-login-popup-choidau").click(function () {
            var btnlogin = $(this);
            var alert = '';
            var email = $("#username_popup_login").val();
            var password = $("#password_popup_login").val();
            var remember = $("input#remember_popup_login").attr('checked');
                remember = (remember == 'checked')? 1 : 0;
            var _token = $("#_token").val();

            var alert_login = $('.alert-popup-login');

            if(email.length <= 0){
                alert_login.html('<div class="alert alert-danger margin-none padding-5 "><div class="text-center">Vui lòng nhập email hoặc username.</div></div>').fadeIn();
                return false;
            }
            if(password.length <= 0){
                alert_login.html('<div class=" alert alert-danger margin-none padding-5 "><div class="text-center">Vui lòng nhập mật khẩu.</div></div>').fadeIn();
                return false;
            }

            var tag_icon =  $('.btn-login-popup-choidau i');
            iconload.load(tag_icon, 'icon-login-2');
            btnlogin.attr('disabled','disabled');
            $.ajax({
                type: "POST",
                url: URL + "/thanh-vien/dang-nhap.html",
                data: {
                    'email': email,
                    'password': password,
                    'remember': remember,
                    '_token': _token
                },
                dataType: 'JSON',
                //async: false,
                success: function (data) {
                    if(data.url != ""){
                        window.alert("Đăng nhập thành công.");
                        $('.modal').modal("hide");
                        window.location.replace(data.url);
                    }else{
                        alert_login.fadeOut().fadeIn();

                        switch(data.err_msg){
                            case 0:
                                alert_login.html('<div class="alert alert-danger margin-none padding-5 "><div class="text-center">Bạn đăng nhập sai quá nhiều lần. Vui lòng kiểm tra lại.</div></div>').fadeIn();
                                break;
                            case 1:
                                alert_login.html('<div class="alert alert-danger margin-none padding-5 "><div class="text-center">Tài khoản chưa được xác thực.</div></div>').fadeIn();
                                break;
                            case 2:
                                alert_login.html('<div class="alert alert-danger margin-none padding-5 "><div class="text-center">Đăng nhập thất bại, tên đăng nhập hoặc mật khẩu không đúng.</div></div>').fadeIn();
                                break;
                            default:
                                alert_login.html('<div class="alert alert-success margin-none padding-5 "><div class="text-center">Đăng nhập thành công.</div></div>').fadeIn();
                                break;
                        }
                    }
                },
                complete: function () {
                    btnlogin.removeAttr('disabled');
                    iconload.unload(tag_icon, 'icon-login-2');
                }
            });

        });

        //login facebook
        $('.login-face-btn').click(function(){
            var btnlogin_fb = $(this);
            var current_url = $(this).attr('data-url');
            var tag_icon =  $('.login-face-btn i');
            iconload.load(tag_icon, 'icon-facebook');
            btnlogin_fb.attr('disabled','disabled')
            $.ajax({
                url: URL + "/thanh-vien/login-facebook",
                type : 'post',
                data : {'current_url': current_url},

                success : function(response) {
                    window.location.assign(response);
                },
                complete : function(r) {
                    btnlogin_fb.removeAttr('disabled');
                    iconload.unload(tag_icon, 'icon-facebook');
                }
            });
        })

        $('.login-google-btn').click(function(){
            var btnlogin_gg = $(this);
            var current_url = $(this).attr('data-url');
            var tag_icon =  $('.login-google-btn i');
            iconload.load(tag_icon, 'icon-googleplus-rect-1');
            btnlogin_gg.attr('disabled','disabled')
            $.ajax({
                url: URL + "/thanh-vien/login-google",
                type : 'post',
                data : {'current_url': current_url},

                success : function(response) {

                    window.location.assign(response);
                },
                complete : function(r) {
                    btnlogin_gg.removeAttr('disabled');
                    //iconload.unload(tag_icon, 'icon-facebook');
                }
            });
        })
    }


    var handleCalendar = function () {
//
//        var afp_current_date = new Date();
//
//        var AfpCurrentMonth = afp_current_date.getMonth();
//        var AfpCurrentDate  = afp_current_date.getDate();
//        var AfpCurrentYear  = afp_current_date.getFullYear();
//
//        $.datepicker.regional['vi'] = {
//            minDate: new Date(AfpCurrentYear, AfpCurrentMonth, AfpCurrentDate),
//            closeText: 'Cerrar',
//            prevText: '<Ant',
//            nextText: 'Sig>',
//            currentText: 'Hoy',
//            monthNames: ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6',
//                'Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],
//            monthNamesShort: ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6',
//                'Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],
//            dayNames: ['Thứ 2','Thứ 3','Thứ 4','Thứ 5','Thứ 6','Thứ 7','Chủ Nhật'],
//            dayNamesShort: ['Thu2','Thu3','Thu4','Thu5','Thu6','Thu7','ChuN'],
//            dayNamesMin: ['T2','T3','T4','T5','T6','T7','CN'],
//            weekHeader: 'Tuần',
//            dateFormat: 'dd/mm/yy',
//            firstDay: 1,
//            isRTL: false,
//            showMonthAfterYear: false,
//            yearSuffix: ''};
//     //   $.datepicker.setDefaults($.datepicker.regional['vi']);


    }

    var handlePostAction = function () {
        /*----like post-----------*/
        $(".btn-post-like").click(function () {

            var element_parent = $(this).parents('.item-post-element-parent');
            var element_data = element_parent.find('.input-data-value-post');
            var id_post = element_data.attr('i_p');
            var id_user = element_data.attr('i_u');
            var type_action = $(this).attr('type_action');

            $.ajax({
                type: "POST",
                url: URL + "/post/action-click-post",
                data: {
                    'id_user_like': id_user,
                    'id_post': id_post,
                    'type_action': type_action
                },
                sync: false,
                success: function (data_1) {

                    //    console.log(data_1);

                    element_parent.find(".lab_num_like").html(data_1.number_like);
                    if (data_1.is_like == '0') {
                        element_parent.find(".lab_text_like").html('Thích ');
                    } else {
                        element_parent.find(".lab_text_like").html('Đã thích ');

                    }
                }, dataType: 'JSON'
            });
        });

        /*----end like post-----------*/


        /*----dislike post-----------*/
        $(".btn-post-dislike").click(function () {

            var element_parent = $(this).parents('.item-post-element-parent');
            var element_data = element_parent.find('.input-data-value-post');
            var id_post = element_data.attr('i_p');
            var id_user = element_data.attr('i_u');
            var type_action = $(this).attr('type_action');

            $.ajax({
                type: "POST",
                url: URL + "/post/action-click-post",
                data: {
                    'id_user_like': id_user,
                    'id_post': id_post,
                    'type_action': type_action
                },
                sync: false,
                success: function (data_1) {

                    element_parent.find(".lab_num_dislike").html(data_1.number_like);
                    if (data_1.is_like == '0') {
                        element_parent.find(".lab_text_dislike").html('Không Thích ');
                    } else {
                        element_parent.find(".lab_text_dislike").html('Đã không thích ');

                    }
                }, dataType: 'JSON'
            });
        });

        /*----end dislike post-----------*/


        /*----spam post-----------*/
        $(".btn-post-spam").click(function () {

            var element_parent = $(this).parents('.item-post-element-parent');
            var element_data = element_parent.find('.input-data-value-post');
            var id_post = element_data.attr('i_p');
            var id_user = element_data.attr('i_u');
            var type_action = $(this).attr('type_action');

            $.ajax({
                type: "POST",
                url: URL + "/post/action-click-post",
                data: {
                    'id_user_like': id_user,
                    'id_post': id_post,
                    'type_action': type_action
                },
                sync: false,
                success: function (data_1) {

                    element_parent.find(".lab_num_spam").html(data_1.number_like);
                    if (data_1.is_like == '0') {
                        element_parent.find(".lab_text_spam").html('Báo cáo xấu ');
                    } else {
                        element_parent.find(".lab_text_spam").html('Đã Báo cáo xấu ');

                    }
                }, dataType: 'JSON'
            });
        });

        /*----end spam post-----------*/


    }
    return {
        init: function () {
            // init core variables
            /*   handleTheme();
             handleInit();
             handleResponsiveOnResize();
             handleIEFixes();
             handleSearch();
             handleFancybox();
             handleDifInits();
             handleSidebarMenu();
             handleAccordions();
             handleMenu();
             handleScrollers();
             handleSubMenuExt();
             handleMobiToggler();
             handlePortletTools();
             */
            $(".tooltips").tooltip({
                disabled: true
            });


            //luuhoabk - kiem tra login
            $(".require-login").click(function (e) {
                e.preventDefault();

                var url_after_login = $(this).attr('data-url');
                    url_after_login = (url_after_login != '')? url_after_login : "";

                var islog = Auth.check(url_after_login);
                if (islog == 1 && url_after_login != "") {
                    window.location.replace(url_after_login);
                }else{
                    $('#popup-login').modal('show');
                }
            });


            handleCalendar();
            handleMobiMenu();
            handleMobiSearch();
            handleMediaBrowser();
            handleComponentLayout();
            handleBlog();
            handlePostAction();
            handleUser();
        },
        btnSelection: function () {
            $(".select-button ul.dropdown-menu li ").click(function () {
                var item = $(this).parents("div.select-button");
                var item_this = $(this).find("a");
                var item_button = item.find('.item-btn');
                item_button.html(item_this.html());
            });
        },

        initUniform: function (els) {
            if (els) {
                jQuery(els).each(function () {
                    if ($(this).parents(".checker").size() == 0) {
                        $(this).show();
                        $(this).uniform();
                    }
                });
            } else {
                handleUniform();
            }
        },

        initTwitter: function () {
            !function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                if (!d.getElementById(id)) {
                    js = d.createElement(s);
                    js.id = id;
                    js.src = p + "://platform.twitter.com/widgets.js";
                    fjs.parentNode.insertBefore(js, fjs);
                }
            }(document, "script", "twitter-wjs");
        },

        initTouchspin: function () {
            $(".product-quantity .form-control").TouchSpin({
                buttondown_class: "btn quantity-down",
                buttonup_class: "btn quantity-up"
            });
            $(".quantity-down").html("<i class='fa fa-angle-down'></i>");
            $(".quantity-up").html("<i class='fa fa-angle-up'></i>");
        },

        initFixHeaderWithPreHeader: function () {
            jQuery(window).scroll(function () {
                if (jQuery(window).scrollTop() > 37) {
                    jQuery("body").addClass("page-header-fixed");
                }
                else {
                    jQuery("body").removeClass("page-header-fixed");
                }
            });
        },

        initNavScrolling: function () {
            function NavScrolling() {
                if (jQuery(window).scrollTop() > 60) {
                    jQuery(".header").addClass("reduce-header");
                }
                else {
                    jQuery(".header").removeClass("reduce-header");
                }
            }

            NavScrolling();

            jQuery(window).scroll(function () {
                NavScrolling();
            });
        },

        initOWL: function () {
            $(".owl-carousel6-brands").owlCarousel({
                pagination: false,
                navigation: true,
                items: 6,
                addClassActive: true,
                itemsCustom: [
                    [0, 1],
                    [320, 1],
                    [480, 2],
                    [700, 3],
                    [975, 5],
                    [1200, 6],
                    [1400, 6],
                    [1600, 6]
                ]
            });

            $(".owl-carousel5").owlCarousel({
                pagination: false,
                navigation: true,
                items: 5,
                addClassActive: true,
                itemsCustom: [
                    [0, 1],
                    [320, 1],
                    [480, 2],
                    [660, 2],
                    [700, 3],
                    [768, 3],
                    [992, 4],
                    [1024, 4],
                    [1200, 5],
                    [1400, 5],
                    [1600, 5]
                ]
            });

            $(".owl-carousel4").owlCarousel({
                pagination: false,
                navigation: true,
                items: 4,
                addClassActive: true,
            });

            $(".owl-carousel3").owlCarousel({
                pagination: false,
                navigation: true,
                items: 3,
                addClassActive: true,
                itemsCustom: [
                    [0, 1],
                    [320, 1],
                    [480, 2],
                    [700, 3],
                    [768, 2],
                    [1024, 3],
                    [1200, 3],
                    [1400, 3],
                    [1600, 3]
                ]
            });

            $(".owl-carousel2").owlCarousel({
                pagination: false,
                navigation: true,
                items: 2,
                addClassActive: true,
                itemsCustom: [
                    [0, 1],
                    [320, 1],
                    [480, 2],
                    [700, 3],
                    [975, 2],
                    [1200, 2],
                    [1400, 2],
                    [1600, 2]
                ]
            });
        },

        initImageZoom: function () {
            $('.product-main-image').zoom({url: $('.product-main-image img').attr('data-BigImgSrc')});
        },

        initSliderRange: function () {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 500,
                values: [50, 250],
                slide: function (event, ui) {
                    $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                }
            });
            $("#amount").val("$" + $("#slider-range").slider("values", 0) +
            " - $" + $("#slider-range").slider("values", 1));
        },

        // wrapper function to scroll(focus) to an element
        scrollTo: function (el, offeset) {
            var pos = (el && el.size() > 0) ? el.offset().top : 0;
            if (el) {
                if ($('body').hasClass('page-header-fixed')) {
                    pos = pos - $('.header').height();
                }
                pos = pos + (offeset ? offeset : -1 * el.height());
            }

            jQuery('html,body').animate({
                scrollTop: pos
            }, 'slow');
        },

        //public function to add callback a function which will be called on window resize
        addResponsiveHandler: function (func) {
            responsiveHandlers.push(func);
        },

        scrollTop: function () {
            App.scrollTo();
        },


        gridOption1: function () {
            $(function () {
                $('.grid-v1').mixitup();
            });
        },
        initSliderLocation: function (containerId) {

            var _SlideshowTransitions = [
                //Fade in L
                {$Duration: 1200, x: 0.3, $During: { $Left: [0.3, 0.7] }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                //Fade out R
                , { $Duration: 1200, x: -0.3, $SlideOut: true, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                //Fade in R
                , { $Duration: 1200, x: -0.3, $During: { $Left: [0.3, 0.7] }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                //Fade out L
                , { $Duration: 1200, x: 0.3, $SlideOut: true, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }

                //Fade in T
                , { $Duration: 1200, y: 0.3, $During: { $Top: [0.3, 0.7] }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
                //Fade out B
                , { $Duration: 1200, y: -0.3, $SlideOut: true, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
                //Fade in B
                , { $Duration: 1200, y: -0.3, $During: { $Top: [0.3, 0.7] }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                //Fade out T
                , { $Duration: 1200, y: 0.3, $SlideOut: true, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }

                //Fade in LR
                , { $Duration: 1200, x: 0.3, $Cols: 2, $During: { $Left: [0.3, 0.7] }, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
                //Fade out LR
                , { $Duration: 1200, x: 0.3, $Cols: 2, $SlideOut: true, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
                //Fade in TB
                , { $Duration: 1200, y: 0.3, $Rows: 2, $During: { $Top: [0.3, 0.7] }, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                //Fade out TB
                , { $Duration: 1200, y: 0.3, $Rows: 2, $SlideOut: true, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }

                //Fade in LR Chess
                , { $Duration: 1200, y: 0.3, $Cols: 2, $During: { $Top: [0.3, 0.7] }, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
                //Fade out LR Chess
                , { $Duration: 1200, y: -0.3, $Cols: 2, $SlideOut: true, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                //Fade in TB Chess
                , { $Duration: 1200, x: 0.3, $Rows: 2, $During: { $Left: [0.3, 0.7] }, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
                //Fade out TB Chess
                , { $Duration: 1200, x: -0.3, $Rows: 2, $SlideOut: true, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }

                //Fade in Corners
                , { $Duration: 1200, x: 0.3, y: 0.3, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
                //Fade out Corners
                , { $Duration: 1200, x: 0.3, y: 0.3, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $SlideOut: true, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }

                //Fade Clip in H
                , { $Duration: 1200, $Delay: 20, $Clip: 3, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                //Fade Clip out H
                , { $Duration: 1200, $Delay: 20, $Clip: 3, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                //Fade Clip in V
                , { $Duration: 1200, $Delay: 20, $Clip: 12, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                //Fade Clip out V
                , { $Duration: 1200, $Delay: 20, $Clip: 12, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            ];

            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlayInterval: 1500,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                                   //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1
                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 800,                                //Specifies default duration (swipe) for slide in milliseconds

                $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                    $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
                    $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
                    $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                    $ShowLink: true                                 //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                },

                $ArrowNavigatorOptions: {                           //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,                  //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 1                                //[Required] 0 Never, 1 Mouse Over, 2 Always
                },

                $ThumbnailNavigatorOptions: {                       //[Optional] Options to specify and enable thumbnail navigator or not
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $SpacingX: 8,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 10,                             //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 360                           //[Optional] The offset position to park thumbnail
                }
            };

            var jssor_slider1 = new $JssorSlider$(containerId, options);
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider1.$ScaleWidth(Math.max(Math.min(parentWidth, 800), 300));
                else
                    $Jssor$.$Delay(ScaleSlider, 30);
            }

            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);

            $Jssor$.$AddEvent(window, "resize", $Jssor$.$WindowResizeFilter(window, ScaleSlider));
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            //responsive code end
        }
    };
}();
