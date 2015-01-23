var FormFileUpload = function () {


    return {
        //main function to initiate the module
        init: function () {

             // Initialize the jQuery File Upload widget:
            $('#fileupload').fileupload({
                disableImageResize: false,
                autoUpload: false,
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
                }


                //$( this ).toggleClass( "media-item-hover" );
            /*    $( this ).toggle(
                    function() {
                        $('.list-unstyled li').removeClass('media-item-hover');
                        $( this ).addClass( "media-item-hover" );
                    }, function() {
                        $( this ).removeClass( "media-item-hover" );
                    }
                );
*/
              //  return false;
            })

            $('.media-item').hover(
                function(){

                        alert('lll');



                }
            );
            $('.input-url-img').change(function(){
                var utt=$(this).val();
                $('.frame-media-internet').html('<img class="img-internet" src="'+utt+'" />');
                $('.img-internet')
                    .load(function(){
                        $('.input-url-video').attr('disabled','disabled');
                        $('.infor-media').attr('style','display:block');
                    })
                    .error(function(){

                        $('.input-url-video').removeAttr('disabled');
                        $('.frame-media-internet').html('');
                        $('.input-url-img').val('');
                        $('.input-url-img').focus();
                        $('.infor-media').attr('style','display:none');
                    //    alert('ko load đc hình ảnh');
                    });
            });

            $('.input-url-video').change(function(){
                var utt=$(this).val();
                var id_youtube=getIdYouTube(utt,'v');
                if(id_youtube==null||id_youtube==''){
                  //  $('.input-url-img').removeAttribute('disabled');
                    $('.frame-media-internet').html('');
                    $('.input-url-img').removeAttr('disabled');
                    $('.input-url-video').val('');
                    $('.input-url-video').focus();
                    $('.infor-media').attr('style','display:none');

                    //     alert('link youtube không đúng !');

                }else{
                    $('.frame-media-internet').html('<iframe width="560" height="315" src="//www.youtube.com/embed/'+id_youtube+'" frameborder="0" allowfullscreen></iframe>');
                    $('.input-url-img').attr('disabled','disabled');
                    $('.infor-media').attr('style','display:block');
                }
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