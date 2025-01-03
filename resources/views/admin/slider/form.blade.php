@extends('admin.app')
@section('title', 'Add Slider')
@push('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css"
        rel="stylesheet">
        @include('admin.css.movie')
@endpush
@section('main')
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>{{ @$slider ? 'Update' : 'Add' }} Slider</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">
                                    Slider Details
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <form action="javascript:;" id="sliderForm">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Slider Details</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control "
                                                value="{{ old('title', @$slider->title) }}" >
                                            <span class="text-danger" id="titleError" hidden></span>
                                        </div>
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="sub_title"> Sub Heading</label>
                                            <input type="text" name="sub_title" id="sub_title" class="form-control "
                                                value="{{ old('sub_title', @$slider->sub_title) }}">
                                            <span class="text-danger" id="sub_titleError" hidden></span>
                                        </div>


                                        <input type="text" name="is_video" id="video_type" value="0" hidden>
                                        <input type="text" name="videoPath" id="imagePath" value="" hidden>

                                        <input type="text" hidden name="rowId" id="rowId" class="rowId" value="">
                                        <div class="col-6 mb-2">
                                            {{ Form::label('status', 'Status:', ['class' => 'form-label']) }}
                                            {{ Form::select('status', ['active' => 'Active', 'inactive' => 'In-Active'], @$data->status, ['class' => 'form-control  ' . ($errors->has('status') ? 'is-invalid' : ''), 'placeholder' => '------------Select If Any---------------', 'required' => true]) }}
                                            <span class="text-danger" id="statusError" hidden></span>
                                        </div>

                                        <div class="col-6 mb-2">
                                            <label for="type" class="form-label">Slider Type</label>
                                            <select name="type" id="type" class="form-control" required>
                                                <option value="">Select Type</option>
                                                <option value="file">Image</option>
                                                <option value="video">Video</option>
                                            </select>
                                            <span class="text-danger" id="typeError" hidden></span>
                                        </div>

                                        <div class="col-6 mb-2" id="itemDiv" hidden>
                                            
                                        </div>

                                        <div class="col-6 mb-2" id="movieId" hidden>
                                            
                                        </div>

                                        <div class="col-md-6 form-group mt-2" id="typeForm" hidden>

                                        </div>

                                        

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" id="submitForm"
                                class="btn btn-primary">{{ @$event ? __('admin.update') : __('admin.submit') }}</button>
                        </div>
                    </form>

                    </div>
            </section>
            <div class="progress mt-3" style="height: 25px" id="uploadPercentage" hidden>
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">
                    75%</div>
            </div>
            <div class="col-md-6 form-group mt-2" id="typeVideo" hidden>

            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>

    <script type="text/javascript">
        const uploadVideo = () => {
            var fileUploadAction = true;
            var formProcessDone = false;
            window.addEventListener('beforeunload', function(event) {
                if (!fileUploadAction) {
                    var confirmationMessage = 'You have unsaved changes. Are you sure you want to leave?';
                    (event || window.event).returnValue = confirmationMessage;
                    return confirmationMessage;
                }
                return true;
            });
            let browseFile = $('#browseFile');

            let resumable = new Resumable({
                target: '{{ route('files.upload.large') }}',
                query: {
                    _token: '{{ csrf_token() }}'
                },
                fileType: ['mp4'],
                headers: {
                    'Accept': 'application/json'
                },
                testChunks: false,
                throttleProgressCallbacks: 1,
            });
            resumable.assignBrowse(browseFile[0]);

            resumable.on('fileAdded', function(
                file
            ) {
                showProgress();
                resumable.upload();
                $('#movieUploadForm').css('display', 'block');
                $('#video_page').css('display', 'none');
                $('#uploadPercentage').removeAttr('hidden');
                fileUploadAction = false;
            });
            resumable.on('fileProgress', function(file) {
                $('.uploadBtn').attr('hidden', true);
                updateProgress(Math.floor(file.progress() * 100));
            });
            resumable.on('fileSuccess', function(file, response) {
                response = JSON.parse(response)
                $('#imagePath').val(response.path);
                $('#videoPreview').attr('src', response.path);
                $('.card-footer').show();
                fileUploadAction = true;
                let rowId=$('#rowId').val();
                let sendRequest=false;
                if(rowId){
                    sendRequest=true;
                }
                if (sendRequest) {
                    let rowId = $('#rowId').val();
                    updateImagePath(rowId, response.path);
                }
            });

            function updateImagePath(rowId, imagePath) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('updateimagepathSlider') }}",
                    type: "post",
                    data: {
                        rowId: rowId,
                        imagePath: imagePath
                    },
                    success: function(response) {
                        swal({
                            title: response.msg,
                            html: true,
                            icon: "success",
                            customClass: {
                                content: 'error-text'
                            }
                        });
                        window.location.href = response.redirectPath;
                    }
                });
            }

            resumable.on('fileError', function(file, response) {
                $('.uploadBtn').removeAttr('hidden'); // trigger when there is any error
                alert('file uploading error.')
            });


            let progress = $('.progress');

            function showProgress() {
                progress.find('.progress-bar').css('width', '0%');
                progress.find('.progress-bar').html('0%');
                progress.find('.progress-bar').removeClass('bg-success');
                progress.show();
            }

            function updateProgress(value) {

                progress.find('.progress-bar').css('width', `${value}%`)
                progress.find('.progress-bar').html(`${value}%`)
            }

            function hideProgress() {
                progress.hide();
            }
        };
    </script>
    <script>
        $(document).ready(function() {
            $('#lfm').filemanager('image');
        });
    </script>
    <script>
        const imageHtml = () => {
            let html =
                `<label for="image">Logo</label><div class="input-group"><span class="input-group-btn"><a id="lfm" data-input="thumbnail1" data-preview="holder" class="btn btn-primary"><i class="fa fa-picture-o"></i> Choose </a></span><input id="thumbnail1" class="form-control" type="text" name="path" value="{{ old('path', @$slider->path) }}" required></div><img id="holder" style="margin-top:15px;max-height:100px;">@error('image')<span class="text-danger">{{ $message }}</span>@enderror @isset($slider)<div class="col-md-4"><img src="{{ asset(@$slider->image) }}" alt="Img" class="img img-fluid img-thumbnail" style="width:100px; height:auto;"></div>@endisset`;
            return html;
        };
        const videoHtml = () => {
            let html = `<section class="content" id="video_page" style="display: block">
                        
                        <div class="container pt-4">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header text-center">
                                            <h5>Upload File</h5>
                                        </div>

                                        <div class="card-body">
                                            <div id="upload-container" class="text-center">
                                                <button id="browseFile" class="btn btn-primary uploadBtn">Brows File</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>`;
            return html;
        };
        const itemData=()=>{
            let itemHtml=`<label for="item_type" class="form-label">Types</label><select required name="item_type" id="item_type" class="form-control" required><option value="">-----Select Any One------</option>@foreach ($itemTypes as $type)<option value="{{$type->value}}">{{$type->name}}</option>@endforeach</select><span class="text-danger" id="item_typeError" hidden></span>`;
            return itemHtml;
        };

        $(document).on('change', '#type', function() {
            let type = $(this).val();
            if (type == 'file') {
                $('#typeForm').removeAttr('hidden');
                $('#typeForm').html(imageHtml());
                $('#typeVideo').attr('hidden', true);
                $('#typeVideo').html('');
                $('#lfm').filemanager('image');
                $('#itemDiv').html('');
                $('#itemDiv').attr('hidden',true);
                $('#video_type').val('0');
                $('#movieId').html('');
                $('#movieId').attr('hidden',true);
                $('#itemDiv').removeAttr('hidden');
                $('#itemDiv').html(itemData());
            } else {
                $('#typeForm').attr('hidden', true);
                $('#typeForm').html('');
                $('#typeVideo').removeAttr('hidden');
                $('#typeVideo').html(videoHtml());
                $('#video_type').val('1');
                $('#itemDiv').removeAttr('hidden');
                $('#itemDiv').html(itemData());
                uploadVideo();
            }
        });

        $(document).on('change','#item_type',function(){
            let itemTypeId=$(this).val();
            if(!itemTypeId){
                $('#movieId').html('');
                $('#movieId').attr('hidden',true);
                return false;
            }
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
            $.ajax({
                url:"{{route('slideritemtype')}}",
                type:"post",
                data:{
                    itemTypeId:itemTypeId
                },
                success:function(response){
                    $('#movieId').html(response);
                    $('#movieId').removeAttr('hidden');
                }
            });
        });

        $(document).on('click','#submitForm',function(){
            let formData=document.getElementById('sliderForm');
            $('#titleError').attr('hidden',true);
            $('#sub_titleError').attr('hidden',true);
            $('#statusError').attr('hidden',true);
            $('#typeError').attr('hidden',true);
            $('#pathError').attr('hidden',true);
            let item_type=$('#item_type').val() ?? null;
            let movie_id=$('#movie_id').val() ?? null;
            if(item_type){
                if(movie_id){

                }else{
                    $('.movie_idError').text('Required....')
                    return false;
                }
            }
            if(formData['path']){
                path=formData['path'].value;
            }else{
                path=null;
            }
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
            $.ajax({
                url:"{{route('slider.store')}}",
                type:"post",
                data:{
                    title:formData['title'].value,
                    sub_title:formData['sub_title'].value,
                    status:formData['status'].value,
                    type:formData['type'].value,
                    path:path,
                    imagePath:formData['imagePath'].value,
                    item_type:item_type,
                    movie_id:movie_id
                },
                success:function(response){
                    if(response.validate)
                    {
                        $.each(response.msg,function(index,value){
                            $(`#${index}Error`).removeAttr('hidden');
                            $(`#${index}Error`).text(value);
                        });
                        
                        return false;
                    }
                    if(response.error)
                    {
                        toastr.error(response.msg);
                        return false;
                    }
                    $('#rowId').val(response.tableId);
                    $('#submitForm').attr('disabled',true);
                    $('#submitForm').text('Form Submitted');
                    if(response.reloadStatus){
                        window.location.href=response.url;
                    }else{
                    formProcessDone=true;
                        swal({
                            title: "Video Is Uploading Dont Close/Reload Page !!",
                            html:true,
                            icon: "success",
                            customClass: {
                                content: 'error-text'
                            }
                        });
                    }

                }
            });
        });
    </script>
@endpush
