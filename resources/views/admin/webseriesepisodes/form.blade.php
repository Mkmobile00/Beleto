@extends('admin.app')
@section('title', 'Episodes Details')
@push('styles')
    <style>
        .card-footer,
        .progress {
            display: none;
        }

        .error-text {
            color: red;
        }

        .map-search-modal-all {
            height: 40px;
            position: absolute;
            left: 12px !important;
            top: 0;
            box-sizing: border-box;
            border: 1px solid transparent;
            width: 98%;
            margin-top: 10px;
            padding: 10px 12px;
            box-shadow: rgba(0, 0, 0, .3) 0 2px 6px;
            font-size: 16px;
            outline: none;
            text-overflow: ellipsis;
            border-radius: 3px;
            z-index: 12;
            background-color: rgb(255, 255, 255)
        }

        .search-suggestions {
            position: absolute;
            width: 95.5%;
            max-height: 150px;
            overflow-y: auto;
            background-color: #ffffffba;
            border: 1px solid #ccc;
            z-index: 1000;
            left: 26px;
            margin-top: 49px;
        }

        .suggestion {
            padding: 8px;
            cursor: pointer
        }

        .suggestion:hover {
            background-color: #f5f5f5
        }

        .locate-me-btn {
            color: #000000cf;
            font-weight: 700;
            border-color: #555;
            position: absolute;
            bottom: 17%;
            right: 6%;
            font-size: 21px;
            background: #e9ecef96;
            border-radius: 27px;
        }
        
    </style>
@endpush
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content" id="video_page" style="display: block">
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
                            <div class="card-footer p-4">
                                <video id="videoPreview" src="" controls
                                    style="width: 100%; height: auto"></video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="progress mt-3" style="height: 25px">
            <span class="badge badge-danger" id="fileUploadNewStatus">File Is Uploading...</span>
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">
                75%</div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="javascript:;" id="episodesData" method="post">
                @method('post')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Episodes Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{old('title',@$languageSelection->title)}}" required>
                                        <span class="text-danger" hidden id="titleError"></span>
                                    </div>
                                    <div class="col-md-6 form-group mt-2" id="imageFile">
                                        <label for="image" class="form-label">Poster(407 × 229 px):</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail11" data-preview="holder"
                                                    class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                </a>
                                            </span>
                                            <input id="thumbnail11" class="form-control" type="text" name="poster"
                                                value="{{ old('image', @$star->poster) }}">
                                        </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;" src="{{@$star->poster}}">
                                        <span class="text-danger" hidden id="posterError"></span>
                                    </div>
                                    <input type="number" hidden name="tvseries_id" value="{{$tvseries->id}}">
                                    <input type="text" hidden name="imagePath" id="imagePath" class="imagePath" value="">
                                    <input type="text" hidden name="rowId" id="rowId" class="rowId" value="">
                                    
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="releasedate">Release Date</label>
                                        <input type="date" name="releasedate" id="releasedate" class="form-control" value="{{old('releasedate',@$languageSelection->releasedate)}}" required>
                                        <span class="text-danger" hidden id="releasedateError"></span>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" >
                                            <option value="1" {{ @$languageSelection->status=='1' ? 'selected':''}}>Published</option>
                                            <option value="0" {{ @$languageSelection->status=='0' ? 'selected':''}}>Un Published</option>
                                        </select>
                                        <span class="text-danger" hidden id="statusError"></span>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="summary">Summary</label>
                                        <textarea name="summary" class="form-control" id="summary" cols="30" rows="3">
                                            {{old('summary',@$languageSelection->summary)}}
                                        </textarea>
                                        <span class="text-danger" hidden id="summaryError"></span>
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="description">Description</label>
                                        <textarea name="description" class="form-control" id="description" cols="30" rows="3">
                                            {{old('description',@$languageSelection->description)}}
                                        </textarea>
                                        <span class="text-danger" hidden id="descriptionError"></span>
                                    </div>
                                </div>
                                <div class="">
                                    <button type="button" 
                                        class="btn btn-primary" id="submitForm" disabled>
                                        Upload Video First
                                    </button>
                                </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</div>
@endsection

@push('scripts')
<script>
    var fileUploadAction = true;
    var formProcessDone = false;
    window.addEventListener('beforeunload', function (event) {
            if (!fileUploadAction) {
                var confirmationMessage = 'You have unsaved changes. Are you sure you want to leave?';
                (event || window.event).returnValue = confirmationMessage;
                return confirmationMessage;
            }
            return true;
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>

<script type="text/javascript">
    let browseFile = $('#browseFile');
    let resumable = new Resumable({
        target: '{{ route('files.upload.webseriesepisodes') }}',
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
        resumable.upload(); // to actually start uploading.
        $('#movieUploadForm').css('display', 'block');
        $('#video_page').css('display', 'none');
        fileUploadAction=false;
    });

    resumable.on('fileProgress', function(file) {
        $('.uploadBtn').attr('hidden', true);
        $('#submitForm').attr('disabled',true);
        $('#submitForm').text('Plz Wait Video Is Uploading');
        updateProgress(Math.floor(file.progress() * 100));
    });

    resumable.on('fileSuccess', function(file, response) {
        response = JSON.parse(response)
        $('#imagePath').val(response.path);
        $('#videoPreview').attr('src', response.path);
        $('.card-footer').show();
        $('#fileUploadNewStatus').text('File Is Uploaded');
        $('#fileUploadNewStatus').removeClass('badge-danger');
        $('#fileUploadNewStatus').addClass('badge-success');
        $('#submitForm').removeAttr('disabled');
        $('#submitForm').text('Add');
        fileUploadAction=true;
        if(formProcessDone){
            let rowId=$('#rowId').val();
            updateImagePath(rowId,response.path);
        }
    });

    function updateImagePath(rowId,imagePath){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:"{{route('updatewebseriesEpisodes')}}",
            type:"post",
            data:{
                rowId:rowId,
                imagePath:imagePath
            },
            success:function(response){
                swal({
                        title: response.msg,
                        html:true,
                        icon: "success",
                        customClass: {
                            content: 'error-text'
                        }
                });
                window.location.href=response.redirectPath;
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
</script>

<script>
    $(document).on('click','#submitForm',function(){
        $('#titleError').text('');
        $('#posterError').text('');
        $('#statusError').text('');
        $('#summaryError').text('');
        $('#descriptionError').text('');
        $('#titleError').attr('hidden',true);
        $('#posterError').attr('hidden',true);
        $('#statusError').attr('hidden',true);
        $('#summaryError').attr('hidden',true);
        $('#descriptionError').attr('hidden',true);
        let formData=document.getElementById('episodesData');
        let title=formData['title'].value;
        let poster=formData['poster'].value;
        let descriptionEditor = CKEDITOR.instances['description'].getData();
        let releasedate=formData['releasedate'].value;
        let summary=CKEDITOR.instances['summary'].getData();
        let status=formData['status'].value;
        let tvseries_id=formData['tvseries_id'].value;
        let imagePath=formData['imagePath'].value;
        let rowId=formData['rowId'].value;
    
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:"{{route('save.episodes')}}",
            type:"post",
            data:{
                title:title,
                poster:poster,
                description:descriptionEditor,
                summary:summary,
                status:status,
                tvseries_id:tvseries_id,
                imagePath:imagePath,
                rowId:rowId,
                releasedate:releasedate
            },
            success:function(response){
                if(response.validate)
                {
                    $.each(response.msg,function(index,value){
                        $(`#${index}Error`).removeAttr('hidden',true);
                        $(`#${index}Error`).text(value);
                    });
                    
                    return false;
                }
                if(response.error)
                {
                    toastr.error(response.msg);
                    return false;
                }
                toastr.success(response.msg);
                $('#rowId').val(response.tableId);
                $('#submitForm').attr('disabled',true);
                $('#submitForm').text('Form Submitted');
                
                if(response.reloadStatus){
                    window.location.href=response.url;
                }else{
                    formProcessDone=true;
                    swal({
                            title: "Episodes Is Uploading Don't Close/Reload Page !!",
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

<script>
    $(document).ready(function () {
        CKEDITOR.replace('description');
        CKEDITOR.replace('summary');
        $('#lfm').filemanager('image');
    });
    
</script>
    
@endpush
