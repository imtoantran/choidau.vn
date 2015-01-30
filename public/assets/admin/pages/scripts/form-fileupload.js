var FormFileUpload = function () {


    return {
        //main function to initiate the module
        init: function () {

             // Initialize the jQuery File Upload widget:
            $('#fileupload').fileupload({
                disableImageResize: false,
                autoUpload: true,
                disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
                maxFileSize: 5000000,
                acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: {withCredentials: true},
            });

            // Enable iframe cross-domain access via redirect option:
            $('#fileupload').fileupload(
                'option',
                'redirect',
                window.location.href.replace(
                    /\/[^\/]*$/,
                    '/cors/result.html?%s'
                )
            );

            // Upload server status check for browsers with CORS support:
            if ($.support.cors) {
                $.ajax({
                    type: 'HEAD'
                }).fail(function () {
                    $('<div class="alert alert-danger"/>')
                        .text('Upload server currently unavailable - ' +
                                new Date())
                        .appendTo('#fileupload');
                });
            }
/*
            $('.media-tab-content ul li  ').click(function(){

                $(this).toggleClass('media-item-hover');


            });
*/
            $( ".media-tab-content ul li " ).toggle(
                function() {
                    $('.media-tab-content ul li').removeClass('media-item-hover');
                    $( this ).addClass( "media-item-hover" );
                }, function() {
                    $( this ).removeClass( "media-item-hover" );
                }
            );


            $('.media-tab-content >ul li.media-item ').hover(function(){
                $(this).find( "div" ).toggleClass('open');
            });

            $('.btn-check-img  i').toggle(
                function(){
                    $(this).addClass('open');
                    $(this).find( "input").attr('checked', 'checked');

                },function(){
                    $(this).removeClass('open');
                    $(this).find( "input").removeAttr('checked');
                }


            );

            $('.btn-delete-img').click(
                function(){
                    //$(this).addClass('open');
                }
            );

            $("ul.files.list-unstyled ").delegate(".media-item","click",function(){
                if($(this).hasClass('media-item-hover')){
                    $( this ).removeClass( "media-item-hover" )
                }else{
                    $('.list-unstyled li').removeClass('media-item-hover');
                    $( this ).addClass( "media-item-hover" );
                    $(".media-edit").attr('style','display:block');
                     var imgItem=  $(this).find( "img");
                     var urlImg = imgItem.attr('url_img');

                    var url_img_public= urlImg;
                     var postImgId = imgItem.attr('id_post');
                    $("#name_ihinh").html(imgItem.attr('name_image'));
                    $("#size_ihinh").html(imgItem.attr('size_img'));
                    $("#date_ihinh").html(imgItem.attr('date_post'));

                    $("#title-edit-media").val(imgItem.attr('title'));


                    $("#url-edit-media").val(URL+url_img_public).attr('data-img-url',url_img_public);
                    $("#alt-edit-media").val(imgItem.attr('alt'));
                    $("#content-edit-media").val(imgItem.attr('content_post'));
                    $("#id-edit-media").val(imgItem.attr('id_post'));
                    $("#media-thumbnail-img").attr('src',URL+url_img_public);

                    //luuhoabk
                    $("#url-edit-media").val(URL+urlImg).attr('data-img-url',urlImg).attr('data-post-img-id',postImgId);
                    $("#alt-edit-media").val(imgItem.attr('alt'));
                    $("#content-edit-media").val(imgItem.attr('content_post'));
                    $("#id-edit-media").val(imgItem.attr('id_post'));
                    $("#media-thumbnail-img").attr('src',URL+urlImg);

                }
            });

            $('.media-item').hover(
                function(){
                    alert('lll');
                }
            );

            /**
             *  them url img
             *
             * */
            $('.input-url-img').change(function(){
                var utt=$(this).val();
                $('.frame-media-internet').html('<img class="img-internet" src="'+utt+'" />');
                $('.img-internet')
                    .load(function(){
                        $('.input-url-video').attr('disabled','disabled');
                        $('#url-media').val(utt);
                        $('.infor-media').attr('style','display:block');
                    })
                    .error(function(){

                        $('.input-url-video').removeAttr('disabled');
                        $('.frame-media-internet').html('');
                        $('.input-url-img').val('');
                        $('.input-url-img').focus();
                        $('.infor-media').attr('style','display:none');
                    //    alert('ko load ?c hình ?nh');
                    });
            });

            /**
             * them url youtube
             * */
            $('.input-url-video').change(function(){
                var utt=$(this).val();
                var id_youtube=getIdYouTube(utt,'v');

              var title_youtube='';

                $.getJSON('http://gdata.youtube.com/feeds/api/videos/'+id_youtube+'?v=2&alt=jsonc',function(data,status,xhr){
                    title_youtube= data.data.title;
                  //  alert(title_youtube);

                    if(title_youtube==null||title_youtube==''){
                        //  $('.input-url-img').removeAttribute('disabled');
                        $('.frame-media-internet').html('');
                        $('.input-url-img').removeAttr('disabled');
                        $('.input-url-video').val('');
                        $('.input-url-video').focus();
                        $('.infor-media').attr('style','display:none');

                        //     alert('link youtube không ?úng !');

                    }else{
                        $('.frame-media-internet').html('<iframe width="560" height="315" src="//www.youtube.com/embed/'+id_youtube+'" frameborder="0" allowfullscreen></iframe>');
                        $('.input-url-img').attr('disabled','disabled');
                        $('.infor-media').attr('style','display:block');
                        $('#url-media').val(utt);
                    }


                });
            });



           $("#form-add-media").submit(function(e){

                e.preventDefault();
                var title = $("input#title").val();
                var url_video = $("input#input-url-video").val();
                var url_img = $("input#input-url-img").val();
                var url=$('#url-media').val();

                var description=$("textarea#content").val();
                var token =  $("input[name=_token]").val();
                var dataString = 'title='+title+'&description='+description+'&url='+url+'&_token='+token;
                alert(dataString);

               var base_url = 'http://choidau.net/'
            /*    $.ajax({
                    type: "POST",
                    url : base_url+"/post/image/create",
                    sync:true,
                    data : dataString,
                    success : function(data){
                      //  console.log(data);
                    },complete:function(){
                       // alert('khkhhkhk');
                    }
                },"json");
*/

               $.post(
                   $( this ).prop( 'action' ),
                   {
                       "_token":token,
                       "title": title,
                       "content": description,
                       "url":url
                   },
                   function( data ) {


                   },
                   'json'
               );
            //   $('#tab_insert_media').removeClass('active');
            //   $('#tab_thu_vien').addClass('active');

            });
         //   $.when().then();

            // Load & display existing files:
            $('#fileupload').addClass('fileupload-processing');
            $.ajax({
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: {withCredentials: true},
                url: $('#fileupload').attr("action"),
                dataType: 'json',
                context: $('#fileupload')[0]
            }).always(function () {
                $(this).removeClass('fileupload-processing');
            }).done(function (result) {
                $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
            });
        }

    };

}();

var getUrlMedia=function(url){
    var host=window.location.host;
    var index_pu= url.indexOf("public")+6;
    var length=url.length;
    url=url.substring(index_pu,length);
    return url;
}
var getIdYouTube = function(url, gkey){
    var returned = null;

    if (url.indexOf("?") != -1){

        var list = url.split("?")[1].split("&"),
            gets = [];

        for (var ind in list){
            var kv = list[ind].split("=");
            if (kv.length>0)
                gets[kv[0]] = kv[1];
        }

        returned = gets;

        if (typeof gkey != "undefined")
            if (typeof gets[gkey] != "undefined")
                returned = gets[gkey];

    }

    return returned;
}