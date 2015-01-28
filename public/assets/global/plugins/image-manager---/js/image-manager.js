/*!
 * jQuery Image Manager Plugin 
 * Author: Homilor.
 * Author Website: http://www.dvlweb.net/
 * Version: 1.0.0
 **/
(function($) {
    // Register jQuery plugin.
    $.fn.radioImageSelect = function( options ) {
        // Default var for options.
        var defaults = {
                // Img class.
                imgItemClass: 'radio-select-img-item',
                // Img Checked class.
                imgItemCheckedClass: 'item-checked',
                // Is need hide label connected?
                hideLabel: true
            },

            /**
             * Method firing when need to update classes.
             */
                syncClassChecked = function( img ) {
                var radioName = img.prev('input[type="radio"]').attr('name');

                $('input[name="' + radioName + '"]').each(function() {
                    // Define img by radio name.
                    var myImg = $(this).next('img');

                    // Add / Remove Checked class.
                    if ( $(this).prop('checked') ) {
                        myImg.addClass(options.imgItemCheckedClass);
                    } else {
                        myImg.removeClass(options.imgItemCheckedClass);
                    }
                });
            };

        // Parse args.. 
        options = $.extend( defaults, options );

        // Start jQuery loop on elements..
        return this.each(function() {
            $(this)
                // First all we are need to hide the radio input.
                .hide()
                // And add new img element by data-image source.
                .after('<img src="' + $(this).data('image') + '" title="' + $(this).data('title') + '" image_name="' + $(this).data('image_name') + '" image_size="' + $(this).data('image_size') + '" thumbnail_name="' + $(this).data('thumbnail_name') + '" alt="radio image" />');

            // Define the new img element.
            var img = $(this).next('img');
            // Add item class.
            img.addClass(options.imgItemClass);

            // Check if need to hide label connected.
            if ( options.hideLabel ) {
                $('label[for=' + $(this).attr('id') + ']').hide();
            }

            // When we are created the img and radio get checked, we need add checked class.
            if ( $(this).prop('checked') ) {
                img.addClass(options.imgItemCheckedClass);
            }

            // Create click event on img element.
            img.on('click', function(e) {
                $(this)
                    // Prev to current radio input.
                    .prev('input[type="radio"]')
                    // Set checked attr.
                    .attr('checked', 'checked')
                    // Run change event for radio element.
                    .trigger('change');
                
                // Firing the sync classes.
                syncClassChecked($(this));
            } );
        });
    }
}) (jQuery);


$('#imageManager_allImage').scroll();

// <!-- Script hiển thị hình sau khi chọn hình -->
$("#imageManger_inputFile").on("change", function() {
    var files = !!this.files ? this.files : [];
    if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

    if (/^image/.test( files[0].type)){ // only image file
        var reader = new FileReader(); // instance of the FileReader
        reader.readAsDataURL(files[0]); // read the local file

        reader.onloadend = function(){ // set image data as background of div
            $("#upload_imagePreview img").attr("src", this.result);
        }
    }
});

// Ajax Upload.............
var fileInput = document.getElementById('imageManger_inputFile');
var form = document.getElementById('imageManager_uploadForm');

form.addEventListener('submit', function(evt) {
    // Chan khong cho form tao submit
    evt.preventDefault();
    // var url = $(this).attr('action');
    var url = URL_IMAGE_MANAGER_PLUGINS + 'upload.php';
    // Ajax upload
    var file = fileInput.files[0];

    // fd dung de luu gia tri goi len
    var fd = new FormData($(this)[0]); // both text and file
    fd.append('file', file);
    fd.append('user_id', user_id); // USER_ID
    //fd += '&'+ $(this).serialize();

    // xhr dung de goi data bang ajax
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);

    // Tính m?c ?? hoàn thành upload
    xhr.upload.onprogress = function(e) {
        // Disable button startupload
        $('#imageManager_startUpload').attr('disabled','disabled');
        if (e.lengthComputable) {
            var percentValue = (e.loaded / e.total) * 100 + '%';
            $('.sr-only').innerHTML = percentValue;
            $('.progress-bar').attr('style', 'width: ' + percentValue);
        }
    };

    xhr.onload = function() {
        if (this.status == 200) {
            alert(this.response);
            // Enable button start upload
            $('#imageManager_startUpload').removeAttr('disabled');
            // progress bar return 0%
            $('.progress-bar').attr('style', 'width: 0%');
            // Disable remove button
            $('#imageManager_removeImage').attr('disabled','disabled');
            // Load all cover thumbnail
            load_allImage();
        };
    };

    xhr.send(fd);
}, false);




// <!-- Script hiển thị tất cả hình như là radio trong folder Upload với Modal Bootstrap-->
function load_allImage(){
    //var url = URL_IMAGE_MANAGER_PLUGINS + "all_images.php";
   var url='../media-getall/';
    $.ajax({
        url: url,
        data: {'user_id':user_id}, // USER_ID
        dataType: "json",
        success: function (data) {
            var modal_body = $('#imageManager_allImage');
            modal_body.text(''); // Làm trống nội dụng trước khi load hình vào để tránh trùng lặp
            for(var i=0; i<data.length; i++){
                modal_body.prepend('<input id="'+ data[i].pid[0] +'" type="radio" name="iM-radio" value="'+ URL_IMAGE_MANAGER + data[i].image_source[0] +'" class="radioImageSelect" data-image="'+ URL_IMAGE_MANAGER + data[i].thumbnail_source[0] +'" data-title="'+ data[i].title[0] +'" data-image_name="'+ data[i].image_name[0] +'" data-image_size="'+ data[i].image_size[0] +'" data-thumbnail_name="'+ data[i].thumbnail_name[0] +'" />');
            }
            $('input.radioImageSelect').radioImageSelect();

            // Khi click vào một tấm hình
            $('img.radio-select-img-item').on('click', function(){
                // show description of image
                $('.cover_title').html($(this).attr('title'));
                $('.cover_image_name').html($(this).attr('image_name'));
                $('.cover_image_size').html($(this).attr('image_size'));
                $('.cover_thumbnail_name').html($(this).attr('thumbnail_name'));

                // Enable remove button
                $('#imageManager_removeImage').removeAttr('disabled');
            });
        }
    });
}



// <!-- Click xoa hinh -->
$('#imageManager_removeImage').on('click', function(){
    var radio_checked = $("input:radio[name='iM-radio']:checked"); // Radio checked
    // USER_ID
    $.get(URL_IMAGE_MANAGER_PLUGINS + 'del_node.php', {'user_id':user_id, 'cover_id':radio_checked.attr('id')}, function(rs){
        // $('img.radio-select-img-item').find('.item-checked').css('display','none');
        $('img.item-checked').fadeOut();
        // Clear image description
        $('.cover_title, .cover_image_name, .cover_image_size, .cover_thumbnail_name').html('');
        // Clear input value for not save change it
        radio_checked.val('');
        radio_checked.attr('data-title','');
        // Clear imagePriview if is has
        $('.imagePreview').attr('src', ''); 
        $('.imagePreview').attr('title', '');
        // Disable remove button
        $('#imageManager_removeImage').attr('disabled','disabled');
    });
    
});

// Đặt 2 function dưới đây ở nơi chứa HTML của image_manager modal
$('.imageManager_openModal').click(function(){
    // Clear description of image
    $('.cover_title, .cover_image_name, .cover_image_size, .cover_thumbnail_name').html('');
    // Disable remove button
    $('#imageManager_removeImage').attr('disabled','disabled');
    // Load all cover thumbnail
    load_allImage();

    // Dùng chung 1 modal để chọn hình ở nhiều nơi
    // $('#imageManager_saveChange').attr('cover_id','1');
});


function get_thumbnail(url_image, user_id) {
    var res = url_image.split('/'); // chặt url ra
    var image_name = res[res.length - 1]; // lấy tên image
    res[res.length - 1] = "thumbnails/" + user_id; // thay thế phần tên image = "/thumbnails/{user_id}"
    var thumbnail_name = image_name.split('.'); // tách phần extension
    thumbnail_name = thumbnail_name[0] + '_165x95.jpg'; // đổi tên => tên file thumbnail
    res[res.length] = thumbnail_name;// chèn tên hình thumbnail vào cuối
    var url_thumbnail = res.join('/');// ghép lại thành => url thumbnail
    return url_thumbnail;
}

// // <!-- Save Change -->
// $('#imageManager_saveChange').on('click', function(evt){
//     // Chan khong cho form tao submit
//     evt.preventDefault();
//     // // Dùng chung 1 modal để chọn hình ở nhiều nơi
//     var cover_id = $(this).attr('cover_id');
//     //
//     var radio_checked = $("input:radio[name='iM-radio']:checked"); // Radio checked
//     $('img#' + cover_id + '.imagePreview').attr('src', radio_checked.val()); // set attribute src to imagePreview 
//     $('img#' + cover_id + '.imagePreview').attr('title', radio_checked.attr('data-title')); // set attribute title to imagePreview 
//     $("#cover_title").val(radio_checked.attr('data-title'));
//     $("#imageManager_modal").modal('hiden'); // Hide Modal
// });
