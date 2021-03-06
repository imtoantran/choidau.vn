@extends('site.layouts.default')

{{-- Content --}}
@section('content')
 <button>Media</button>
<ul class="menu-item-pictures">
    <div class="list_user_slide">

    </div>


    <li class="single-picture empty">
        <div id="iM_user_slide" class="single-picture-wrapper imageManager_openModal" style="position: relative;" data-toggle="modal" data-target="#imageManager_modal">
            <div class="add-picture vertically-centered" style="position: absolute; height: 34px; top: 50%; margin-top: -17px;">
                <div class="icon icons-plus3"></div>
                Thêm ảnh
            </div>
        </div>
    </li>
</ul>



<!-- Image Manager Modal -->
<div class=" modal" id="imageManager_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="col-md-11 col-md-offset-1 container modal-dialog">
        <div class="col-md-12 col-none-padding  modal-content">
            <div class=" col-md-12 col-none-padding modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="imageManager_modalLabel">Manager Media</h4>
            </div>
            <div class="col-md-12 col-none-padding modal-body">
                <div class="row margin-none">
                    <div class="col-md-2 col-sm-2 col-xs-2 col-none-padding">
                        <ul class="nav nav-tabs tabs-left">
                            <li class="active">
                                <a href="#tab_6_1" data-toggle="tab">
                                    Thư Viện </a>
                            </li>
                            <li class="">
                                <a href="#tab_6_2" data-toggle="tab">
                                    Thêm  </a>
                            </li>
                            <li class="">
                                <a href="#tab_6_3" data-toggle="tab">
                                    Thêm Url </a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-10 col-none-padding">
                        <div class="tab-content" style="padding: 0px;background-color: white;">
                            <div class="tab-pane active" id="tab_6_1">
                               <div class="row">
                                   <div class="col-md-10 col-none-padding">
                                       <div id="imageManager_allImage">


                                       </div>

                                   </div>
                                   <div class="col-md-2 col-none-padding">


                                       <div id="imageManager_descriptionImage">
                                           <div id="imageManager_descriptionImage-content">
                                               <strong>Image title:</strong> </br>
                                               <span class="cover_title"></span>
                                               <div>
                                                   <h6>Image name: </h6><h6 class="cover_image_name"> </h6>
                                                   <h6>Image size: </h6><h6 class="cover_image_size"> </h6>
                                                   <h6>Thumbnail: </h6><h6 class="cover_thumbnail_name"> </h6>
                                               </div>
                                           </div>
                                           <button type="button" id="imageManager_removeImage" class="btn btn-sm btn-danger pull-left" disabled="disabled"><i class="fa fa-trash-o"></i> Remove</button>
                                       </div>
                                   </div>
                               </div>


                            </div>
                            <div class="tab-pane" id="tab_6_2">
                               <div class="col-md-12">

                                   <form id="fileupload" action="/media-data" method="POST" enctype="multipart/form-data">
                                       <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                       <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
                                       <div class="row fileupload-buttonbar">
                                           <div class="col-lg-7">
                                               <!-- The fileinput-button span is used to style the file input field as button -->
                                            <span class="btn green fileinput-button">
                                            <i class="fa fa-plus"></i>
                                            <span>
                                            Thêm files... </span>
                                            <input type="file" name="files[]" multiple="">
                                            </span>
                                                           <button type="submit" class="btn blue start">
                                                               <i class="fa fa-upload"></i>
                                            <span>
                                            Upload Tất cả </span>
                                                           </button>
                                                           <button type="reset" class="btn warning cancel">
                                                               <i class="fa fa-ban-circle"></i>
                                            <span>
                                            Huỷ upload </span>
                                                           </button>
                                                           <button type="button" class="btn red delete">
                                                               <i class="fa fa-trash"></i>
                                            <span>
                                            Xoá </span>
                                                           </button>
                                                           <input type="checkbox" class="toggle">
                                                           <!-- The global file processing state -->
                                            <span class="fileupload-process">
                                            </span>
                                           </div>
                                           <!-- The global progress information -->
                                           <div class="col-lg-5 fileupload-progress fade">
                                               <!-- The global progress bar -->
                                               <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                   <div class="progress-bar progress-bar-success" style="width:0%;">
                                                   </div>
                                               </div>
                                               <!-- The extended global progress information -->
                                               <div class="progress-extended">
                                                   &nbsp;
                                               </div>
                                           </div>
                                       </div>
                                       <!-- The table listing the files available for upload/download -->
									   
									   
                                       <table role="presentation" class="table table-striped clearfix">
                                           <tbody class="files">
                                           </tbody>
                                       </table>
                                   </form>


                                   <!-- The blueimp Gallery widget -->
                                   <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
                                       <div class="slides"></div>
                                       <h3 class="title"></h3>
                                       <a class="prev">‹</a>
                                       <a class="next">›</a>
                                       <a class="close">×</a>
                                       <a class="play-pause"></a>
                                       <ol class="indicator"></ol>
                                   </div>
                                   <!-- The template to display files available for upload -->
                                   <script id="template-upload" type="text/x-tmpl">
                                            {% for (var i=0, file; file=o.files[i]; i++) { %}
                                                <tr class="template-upload fade">
                                                    <td>
                                                        <span class="preview"></span>
                                                    </td>
                                                    <td>
                                                        <p class="name">{%=file.name%}</p>
                                                        <strong class="error text-danger"></strong>
                                                    </td>
                                                    <td>
                                                        <p class="size">Đang xử lý...</p>
                                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                                                    </td>
                                                    <td>
                                                        {% if (!i && !o.options.autoUpload) { %}
                                                            <button class="btn btn-primary start" disabled>
                                                                <i class="glyphicon glyphicon-upload"></i>
                                                                <span>Upload</span>
                                                            </button>
                                                        {% } %}
                                                        {% if (!i) { %}
                                                            <button class="btn btn-warning cancel">
                                                                <i class="glyphicon glyphicon-ban-circle"></i>
                                                                <span>Huỷ</span>
                                                            </button>
                                                        {% } %}
                                                    </td>
                                                </tr>
                                            {% } %}
                                            </script>
                        <!-- The template to display files available for download -->
                <script id="template-download" type="text/x-tmpl">
                                      {% for (var i=0, file; file=o.files[i]; i++) { %}
                                                <tr class="template-download fade">
                                                    <td>
                                                        <span class="preview">
                                                            {% if (file.thumbnailUrl) { %}
                                                                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery>
																<img src="{%=file.thumbnailUrl%}"></a>
                                                            {% } %}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <p class="name">
                                                            {% if (file.url) { %}
                                                                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                                                            {% } else { %}
                                                                <span>{%=file.name%}</span>
                                                            {% } %}
                                                        </p>
                                                        {% if (file.error) { %}
                                                            <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                                                        {% } %}
                                                    </td>
                                                    <td>
                                                        <span class="size">{%=o.formatFileSize(file.size)%}</span>
                                                    </td>
                                                    <td>
                                                        {% if (file.deleteUrl) { %}
                                                            <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                                                                <i class="glyphicon glyphicon-trash"></i>
                                                                <span>Xoá</span>
                                                            </button>
                                                            <input type="checkbox" name="delete" value="1" class="toggle">
                                                        {% } else { %}
                                                            <button class="btn btn-warning cancel">
                                                                <i class="glyphicon glyphicon-ban-circle"></i>
                                                                <span>Huỷ</span>
                                                            </button>
                                                        {% } %}
                                                    </td>
                                                </tr>
                                            {% } %}-->
                                            </script>

                               </div>

                            </div>
                            
                            <div class="tab-pane fade " id="tab_6_3">
							
							   <div class="col-md-10">
							
								<div class="col-md-12">
								  <form id="fileupload" action="/media-data" method="POST" enctype="multipart/form-data">
                                       <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                       <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
                                       <div class="row fileupload-buttonbar">
                                           <div class="col-lg-7">
                                               <!-- The fileinput-button span is used to style the file input field as button -->
                                            <span class="btn green fileinput-button">
                                            <i class="fa fa-plus"></i>
                                            <span>
                                            Thêm files... </span>
                                            <input type="file" name="files[]" multiple="">
                                            </span>
                                                           <button type="submit" class="btn blue start">
                                                               <i class="fa fa-upload"></i>
                                            <span>
                                            Upload Tất cả </span>
                                                           </button>
                                                           <button type="reset" class="btn warning cancel">
                                                               <i class="fa fa-ban-circle"></i>
                                            <span>
                                            Huỷ upload </span>
                                                           </button>
                                                           <button type="button" class="btn red delete">
                                                               <i class="fa fa-trash"></i>
                                            <span>
                                            Xoá </span>
                                                           </button>
                                                           <input type="checkbox" class="toggle">
                                                           <!-- The global file processing state -->
                                            <span class="fileupload-process">
                                            </span>
                                           </div>
                                           <!-- The global progress information -->
                                           <div class="col-lg-5 fileupload-progress fade">
                                               <!-- The global progress bar -->
                                               <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                   <div class="progress-bar progress-bar-success" style="width:0%;">
                                                   </div>
                                               </div>
                                               <!-- The extended global progress information -->
                                               <div class="progress-extended">
                                                   &nbsp;
                                               </div>
                                           </div>
                                       </div>
                                       <!-- The table listing the files available for upload/download -->
									   
									   
                                   <!--    <table role="presentation" class="table table-striped clearfix">
                                           <tbody class="files">
                                           </tbody>
                                       </table>-->
								<div class="media-tab-content col-md-12">	   
								<ul class=" list-unstyled">
                                    
									
									
                                  <!-- 
									<li class="col-md-2" >
                                        <img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
                                        <span><i class="icon-ok-circled2"></i></span>
                                        <div class="media-tool">
                                            <a href="#" class="icon-btn-cd btn-delete-img">


                                                <button class="icon-cancel-circle-2 delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>

                                                </button>



                                            </a>
                                            <a href="#" class="icon-btn-cd btn-check-img">
                                                <i class="icon-ok-circle-1">
                                                    <input type="checkbox" name="delete" value="1" class="toggle">
                                                </i>

                                            </a>
                                        </div>
                                    </li>

								  <li class="col-md-2" >
                                        <img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
                                        <span><i class="icon-ok-circled2"></i></span>
                                        <div class="media-tool">
                                            <a href="#" class="icon-btn-cd btn-delete-img">
                                                <i class="icon-cancel-circle-2"></i>

                                            </a>
                                            <a href="#" class="icon-btn-cd btn-check-img">
                                                <i class="icon-ok-circle-1">
                                                    <input type="checkbox" name="delete" value="1" class="toggle">
                                                </i>

                                            </a>
                                        </div>
                                    </li>
                                    <li class="col-md-2" >
                                        <img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
                                        <span><i class="icon-ok-circled2"></i></span>
                                        <div class="media-tool">
                                            <a href="#" class="icon-btn-cd btn-delete-img">
                                                <i class="icon-cancel-circle-2"></i>

                                            </a>
                                            <a href="#" class="icon-btn-cd btn-check-img">
                                                <i class="icon-ok-circle-1">
                                                    <input type="checkbox" name="delete" value="1" class="toggle">
                                                </i>

                                            </a>
                                        </div>
                                    </li>
                                    <li class="col-md-2" >
                                        <img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
                                        <span><i class="icon-ok-circled2"></i></span>
                                        <div class="media-tool">
                                            <a href="#" class="icon-btn-cd btn-delete-img">
                                                <i class="icon-cancel-circle-2"></i>

                                            </a>
                                            <a href="#" class="icon-btn-cd btn-check-img">
                                                <i class="icon-ok-circle-1">
                                                    <input type="checkbox" name="delete" value="1" class="toggle">
                                                </i>

                                            </a>
                                        </div>
                                    </li>
                                    <li class="col-md-2" >
                                        <img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
                                        <span><i class="icon-ok-circled2"></i></span>
                                        <div class="media-tool">
                                            <a href="#" class="icon-btn-cd btn-delete-img">
                                                <i class="icon-cancel-circle-2"></i>

                                            </a>
                                            <a href="#" class="icon-btn-cd btn-check-img">
                                                <i class="icon-ok-circle-1">
                                                    <input type="checkbox" name="delete" value="1" class="toggle">
                                                </i>

                                            </a>
                                        </div>
                                    </li>
                                    <li class="col-md-2" >
                                        <img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
                                        <span><i class="icon-ok-circled2"></i></span>
                                        <div class="media-tool">
                                            <a href="#" class="icon-btn-cd btn-delete-img">
                                                <i class="icon-cancel-circle-2"></i>

                                            </a>
                                            <a href="#" class="icon-btn-cd btn-check-img">
                                                <i class="icon-ok-circle-1">
                                                    <input type="checkbox" name="delete" value="1" class="toggle">
                                                </i>

                                            </a>
                                        </div>
                                    </li>
                                    <li class="col-md-2" >
                                        <img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
                                        <span><i class="icon-ok-circled2"></i></span>
                                        <div class="media-tool">
                                            <a href="#" class="icon-btn-cd btn-delete-img">
                                                <i class="icon-cancel-circle-2"></i>

                                            </a>
                                            <a href="#" class="icon-btn-cd btn-check-img">
                                                <i class="icon-ok-circle-1">
                                                    <input type="checkbox" name="delete" value="1" class="toggle">
                                                </i>

                                            </a>
                                        </div>
                                    </li>
                                    <li class="col-md-2" >
                                        <img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
                                        <span><i class="icon-ok-circled2"></i></span>
                                        <div class="media-tool">
                                            <a href="#" class="icon-btn-cd btn-delete-img">
                                                <i class="icon-cancel-circle-2"></i>

                                            </a>
                                            <a href="#" class="icon-btn-cd btn-check-img">
                                                <i class="icon-ok-circle-1">
                                                    <input type="checkbox" name="delete" value="1" class="toggle">
                                                </i>

                                            </a>
                                        </div>
                                    </li>
                                    <li class="col-md-2" >
                                        <img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
                                        <span><i class="icon-ok-circled2"></i></span>
                                        <div class="media-tool">
                                            <a href="#" class="icon-btn-cd btn-delete-img">
                                                <i class="icon-cancel-circle-2"></i>

                                            </a>
                                            <a href="#" class="icon-btn-cd btn-check-img">
                                                <i class="icon-ok-circle-1">
                                                    <input type="checkbox" name="delete" value="1" class="toggle">
                                                </i>

                                            </a>
                                        </div>
                                    </li>
                                    <li class="col-md-2" >
                                        <img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
                                        <span><i class="icon-ok-circled2"></i></span>
                                        <div class="media-tool">
                                            <a href="#" class="icon-btn-cd btn-delete-img">
                                                <i class="icon-cancel-circle-2"></i>

                                            </a>
                                            <a href="#" class="icon-btn-cd btn-check-img">
                                                <i class="icon-ok-circle-1">
                                                    <input type="checkbox" name="delete" value="1" class="toggle">
                                                </i>

                                            </a>
                                        </div>
                                    </li>
                                    <li class="col-md-2" >
                                        <img class="img-responsive" src="/upload/2/thumbnails/2/j-4_165x95.jpg" />
                                        <span><i class="icon-ok-circled2"></i></span>
                                        <div class="media-tool">

                                            <a href="#" class="icon-btn-cd btn-delete-img">
                                                <i class="icon-cancel-circle-2"></i>

                                            </a>
                                            <a href="#" class="icon-btn-cd btn-check-img">
                                                <i class="icon-ok-circle-1">
                                                    <input type="checkbox" name="delete" value="1" class="toggle">
                                                </i>

                                            </a>
                                        </div>
                                    </li>-->


                                </ul>
									  </div> 
                                   </form>
									
                                   <!-- The blueimp Gallery widget -->
                                   <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
                                       <div class="slides"></div>
                                       <h3 class="title"></h3>
                                       <a class="prev">‹</a>
                                       <a class="next">›</a>
                                       <a class="close">×</a>
                                       <a class="play-pause"></a>
                                       <ol class="indicator"></ol>
                                   </div>
								   
								
								</div>
								
								         <script id="template-upload" type="text/x-tmpl">
                                            {% for (var i=0, file; file=o.files[i]; i++) { %}
                                                <tr class="template-upload fade">
                                                    <td>
                                                        <span class="preview"></span>
                                                    </td>
                                                    <td>
                                                        <p class="name">{%=file.name%}</p>
                                                        <strong class="error text-danger"></strong>
                                                    </td>
                                                    <td>
                                                        <p class="size">Đang xử lý...</p>
                                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                                                    </td>
                                                    <td>
                                                        {% if (!i && !o.options.autoUpload) { %}
                                                            <button class="btn btn-primary start" disabled>
                                                                <i class="glyphicon glyphicon-upload"></i>
                                                                <span>Upload</span>
                                                            </button>
                                                        {% } %}
                                                        {% if (!i) { %}
                                                            <button class="btn btn-warning cancel">
                                                                <i class="glyphicon glyphicon-ban-circle"></i>
                                                                <span>Huỷ</span>
                                                            </button>
                                                        {% } %}
                                                    </td>
                                                </tr>
                                            {% } %}
                                            </script>
                        <!-- The template to display files available for download -->
                <script id="template-download" type="text/x-tmpl">
                                      {% for (var i=0, file; file=o.files[i]; i++) { %}
                                                <tr class="template-download fade">
                                                    <td>
                                                        <span class="preview">
                                                            {% if (file.thumbnailUrl) { %}
                                                                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery>
																<img src="{%=file.thumbnailUrl%}"></a>
                                                            {% } %}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <p class="name">
                                                            {% if (file.url) { %}
                                                                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                                                            {% } else { %}
                                                                <span>{%=file.name%}</span>
                                                            {% } %}
                                                        </p>
                                                        {% if (file.error) { %}
                                                            <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                                                        {% } %}
                                                    </td>
                                                    <td>
                                                        <span class="size">{%=o.formatFileSize(file.size)%}</span>
                                                    </td>
                                                    <td>
                                                        {% if (file.deleteUrl) { %}
                                                            <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                                                                <i class="glyphicon glyphicon-trash"></i>
                                                                <span>Xoá</span>
                                                            </button>
                                                            <input type="checkbox" name="delete" value="1" class="toggle">
                                                        {% } else { %}
                                                            <button class="btn btn-warning cancel">
                                                                <i class="glyphicon glyphicon-ban-circle"></i>
                                                                <span>Huỷ</span>
                                                            </button>
                                                        {% } %}
                                                    </td>
                                                </tr>
                                            {% } %}-->
                                            </script>
                                </div>
                                <div class="col-md-2">

                                    chào các bạn
                                </div>


                            </div>
                            <div class="tab-pane fade" id="tab_6_4">
                                <p>
                                    Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="clearfix"></div>
            </div>
            <div class=" col-md-12 col-none-padding modal-footer" style="margin-top: 0px;padding-top: 10px">
                <div class="col-md-9" style="border-right: 1px solid #CCC; margin-bottom: 10px;">
                    <form id="imageManager_uploadForm" method="post" action="upload.php" enctype="multipart/form-data">

                        <div id="upload_imagePreview" class="pull-left" >
                            <img src="" style="width: 127px; height: 70px;"/>
                        </div>
                        <div class="pull-left" align="left" style="margin-left: 10px; width: 120px;">
                    <span class="btn btn-sm btn-success fileinput-button" style="margin-bottom: 11px;">
                        <i class="fa fa-plus"></i>
                        <span>Add file ...</span>
                        <input type="file" name="file" id="imageManger_inputFile" >
                    </span>
                            </br>
                            <button type="submit" class="btn btn-sm btn-primary" value="Upload" id="imageManager_startUpload" >
                                <i class="fa fa-upload"></i>
                                <span>Start upload</span>
                            </button>
                        </div>
                        <div class="pull-left" style="width: 315px">
                            <input id="cover_title" name="cover_title" type="text" class="form-control" pattern=".{3,}" required title="3 characters minimum" placeHolder="Nhập tiêu đề cho cover" >
                            </br>
                            <div class="progress progress-striped active" style="margin-bottom: 0px;">
                                <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">
                                    <span class="sr-only">45% Complete</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <button type="submit" id="imageManager_saveChange" class="btn btn-sm btn-primary" >Save changes</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div><!--// END Image Manager Modal -->

<?php echo $_SERVER['SCRIPT_FILENAME']; ?>
@stop