@extends('admin.app')
@section('title', 'Add Movie')
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
    @include('admin.css.movie')
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
                                        <button id="browseFile" class="btn btn-primary uploadBtn">Browse File</button>
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

            <section class="content" id="movieUploadForm" style="display: none">
                {{-- <div class="container pt-4"> --}}
                {{-- <div class="mx-auto container"> --}}
                    <span class="badge badge-danger" id="fileUploadNewStatus">File Is Uploading...</span>
                <div class="progress mt-3" style="height: 25px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">
                        75%</div>
                </div>
                <!-- Progress Form -->
                <form id="progress-form" class="p-4 progress-form" action="javascript:;" lang="en" novalidate>

                    <!-- Step Navigation -->
                    <div class="d-flex align-items-start mb-3 sm:mb-5 progress-form__tabs" role="tablist">
                        <button id="progress-form__tab-1" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button"
                            role="tab" aria-controls="progress-form__panel-1" aria-selected="true">
                            <span class="d-block step" aria-hidden="true">Movie Details
                        </button>
                        <button id="progress-form__tab-2" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button"
                            role="tab" aria-controls="progress-form__panel-2" aria-selected="false" tabindex="-1"
                            aria-disabled="true">
                            <span class="d-block step" aria-hidden="true">Movie Category
                        </button>
                        <button id="progress-form__tab-3" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button"
                            role="tab" aria-controls="progress-form__panel-3" aria-selected="false" tabindex="-1"
                            aria-disabled="true">
                            <span class="d-block step" aria-hidden="true">Movie Elements
                        </button>
                        <button id="progress-form__tab-3" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button"
                            role="tab" aria-controls="progress-form__panel-3" aria-selected="false" tabindex="-1"
                            aria-disabled="true">
                            <span class="d-block step" aria-hidden="true">Extra
                        </button>
                        <button id="progress-form__tab-4" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button"
                            role="tab" aria-controls="progress-form__panel-4" aria-selected="false" tabindex="-1"
                            aria-disabled="true">
                            <span class="d-block step" aria-hidden="true">Poster,Thumbnail & SEO
                        </button>
                    </div>
                    <!-- / End Step Navigation -->

                    <!-- Step 1 -->
                    <section id="progress-form__panel-1" role="tabpanel" aria-labelledby="progress-form__tab-1"
                        tabindex="0">
                        <div class="sm:d-grid sm:grid-col-12 sm:mt-3">
                            <div class="mt-3 sm:mt-0 form__field">
                                <label for="title">Title<span data-required="true" aria-hidden="true"></span>
                                </label>
                                <input id="title" type="text" name="title" autocomplete="given-name" required>
                            </div>
                        </div>

                        <div class="sm:d-grid sm:grid-col-12 sm:mt-3">
                            <div class="mt-3 sm:mt-0 form__field">
                                <label for="summary">Logline<span data-required="true" aria-hidden="true"></span>
                                </label>
                                <textarea name="summary" id="summary" cols="30" rows="3" autocomplete required></textarea>
                            </div>
                        </div>

                        <div class="sm:d-grid sm:grid-col-12 sm:mt-3">
                            <div class="mt-3 sm:mt-0 form__field">
                                <label for="description">Description<span data-required="true" aria-hidden="true"></span>
                                </label>
                                <textarea name="description" id="description" cols="30" rows="3" autocomplete required></textarea>
                            </div>
                        </div>
                        <input type="text" hidden name="imagePath" id="imagePath" class="imagePath" value="">
                        <input type="text" hidden name="rowId" id="rowId" class="rowId" value="">

                        <input type="text" hidden name="transcode" id="transcodePath" class="transcodePath" value="">
                        <input type="text" hidden name="transcodeStatus" id="transcodeStatus" class="transcodeStatus" value="false">


                        <div class="mt-3 form__field">
                            <label for="youtube_trailer">Youtube Trailer<span data-required="true"
                                    aria-hidden="true"></span>
                            </label>
                            <input id="youtube_trailer" type="url" name="youtube_trailer"
                                autocomplete="youtube_trailer" required>
                        </div>
                        
                        <div class="mt-3 form__field">
                            <label for="video_quality">Video Quality<span data-required="true" aria-hidden="true"></span>
                            </label>
                            <select name="video_quality[]" id="video_quality" class="select2" multiple
                                autocomplete="video_quality" required>
                                @foreach ($videoQuality as $quality)
                                    <option value="{{ $quality->id }}">{{ $quality->quality }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
                            <button type="button" data-action="next">
                                Continue
                            </button>
                        </div>
                    </section>
                    <!-- / End Step 1 -->

                    <!-- Step  -->
                    <section id="progress-form__panel-2" role="tabpanel" aria-labelledby="progress-form__tab-2"
                        tabindex="0" hidden>
                        <div class="mt-3 form__field">
                            <label for="actor">Category<span data-required="true" aria-hidden="true"></span>
                            </label>
                            <div class="card-body scrollable-card">
                                <div
                                    class="form-group row {{ $errors->has('category') ? 'has-error' : '' }}">
                                    @include('admin.movie.category-checkbox', [
                                        'moviesCategory' => $categories,
                                    ])
                                    @error('category')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                    <span class="text-danger" hidden id="catError">Required....</span>
                                </div>
                            </div>
                        </div>

                        <div
                            class="d-flex flex-column-reverse sm:flex-row align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
                            <button type="button" class="mt-1 sm:mt-0 button--simple" data-action="prev">
                                Back
                            </button>
                            <button type="button" data-action="" id="editCategory">
                                Continue
                            </button>
                        </div>
                    </section>
                    <!-- / End Step 2 -->
                    <!-- Step  -->
                    <section id="progress-form__panel-3" role="tabpanel" aria-labelledby="progress-form__tab-3"
                        tabindex="0" hidden>
                        <div class="mt-3 form__field">
                            <label for="actor">Actor<span data-required="true" aria-hidden="true"></span>
                            </label>
                            <select name="actor[]" id="actor" class="select2" multiple autocomplete="actor"
                                required>
                                @foreach ($actors as $actor)
                                    <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="mt-3 form__field">
                            <label for="director">Director
                            </label>
                            <select name="director[]" id="director" class="select2" multiple autocomplete="director"
                                required>
                                @foreach ($directors as $director)
                                    <option value="{{ $director->id }}">{{ $director->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-3 form__field">
                            <label for="writer">
                                Writer
                            </label>
                            <select name="writer[]" id="writer" class="select2" multiple autocomplete="writer"
                                required>
                                @foreach ($writers as $writer)
                                    <option value="{{ $writer->id }}">{{ $writer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-3 form__field">
                            <label for="producer">
                                Producer
                            </label>
                            <select name="producer[]" id="producer" class="select2" multiple autocomplete="producer"
                                required>
                                @foreach ($producers as $producers)
                                    <option value="{{ $producers->id }}">{{ $producers->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-3 form__field">
                            <label for="cinematographer">
                                Cinematographer
                            </label>
                            <select name="cinematographer[]" id="cinematographer" class="select2" multiple autocomplete="cinematographer"
                                required>
                                @foreach ($cinematographers as $cinematographer)
                                    <option value="{{ $cinematographer->id }}">{{ $cinematographer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-3 form__field">
                            <label for="editor">
                                Editor
                            </label>
                            <select name="editor[]" id="editor" class="select2" multiple autocomplete="editor"
                                required>
                                @foreach ($editors as $editor)
                                    <option value="{{ $editor->id }}">{{ $editor->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-3 form__field">
                            <label for="music">
                                Music
                            </label>
                            <select name="music[]" id="music" class="select2" multiple autocomplete="music"
                                required>
                                @foreach ($musics as $music)
                                    <option value="{{ $music->id }}">{{ $music->name }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="mt-3 form__field">
                            <label for="genre">
                                Genre
                            </label>
                            <select name="genre[]" id="genre" class="select2" multiple autocomplete="genre"
                                required>
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}">{{ $genre->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-3 form__field">
                            <label for="rating">
                                Rating
                            </label>
                            <input id="rating" type="number" max="5" value="1" name="rating" required>
                        </div>

                        <div class="mt-3 form__field">
                            <label for="rating">
                                Run Time
                            </label>
                            <input id="run_time" type="text" value="" name="run_time">
                        </div>

                        <div class="mt-3 form__field">
                            <label for="release_date">
                                Release Date
                            </label>
                            <input id="release_date" type="date" name="release_date" required>
                        </div>
                        <div
                            class="d-flex flex-column-reverse sm:flex-row align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
                            <button type="button" class="mt-1 sm:mt-0 button--simple" data-action="prev">
                                Back
                            </button>
                            <button type="button" data-action="next">
                                Continue
                            </button>
                        </div>
                    </section>
                    <!-- / End Step 2 -->
                    <!-- Step 3 -->
                    <section id="progress-form__panel-3" role="tabpanel" aria-labelledby="progress-form__tab-3"
                        tabindex="0" hidden>
                        <div class="mt-3 form__field">
                            <label for="country">
                                Country
                            </label>
                            <select name="country[]" id="country" class="select2" multiple required>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-3 form__field">
                            <label for="language">
                                Language
                            </label>
                            <select name="language[]" id="language" class="select2" multiple required>
                                @foreach ($languages as $language)
                                    <option value="{{ $language->id }}">{{ $language->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-3 form__field">
                            <label for="video_type">
                                Video Type
                            </label>
                            <select name="video_type[]" id="video_type" class="select2" multiple required>
                                @foreach ($videoTypes as $videoType)
                                    <option value="{{ $videoType->id }}">{{ $videoType->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3 form__field">
                            <label class="form__choice-wrapper">
                                <input type="checkbox" name="publication" value="1" id="publication">
                                <span>Publication</span>
                            </label>
                        </div>


                        <div class="mt-3 form__field">
                            <label class="form__choice-wrapper">
                                <input type="checkbox" name="download" value="1" id="download">
                                <span>Enable Download</span>
                            </label>
                        </div>


                        <div class="mt-3 form__field">
                            <label for="free_paid">
                                Free/Paid
                            </label>
                            <select name="free_paid" id="free_paid" class="select2" required>
                                <option value="free">Free</option>
                                <option value="paid">Paid</option>
                            </select>
                        </div>
                        <div
                            class="d-flex flex-column-reverse sm:flex-row align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
                            <button type="button" class="mt-1 sm:mt-0 button--simple" data-action="prev">
                                Back
                            </button>
                            <button type="button" data-action="next">
                                Continue
                            </button>
                        </div>

                    </section>
                    <!-- / End Step 3 -->

                    <!-- Step 4 -->
                    <section id="progress-form__panel-4" role="tabpanel" aria-labelledby="progress-form__tab-4"
                        tabindex="0" hidden>

                        <div class="mt-3 form__field" id="imageFile">
                            <label for="thumbnail">Poster Lanscape(407 × 229 px)</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="thumbnail" data-input="thumbnail1" data-preview="holder"
                                        class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="thumbnail1" class="form-control" type="text" name="thumbnail"
                                    value="{{ old('thumbnail', @$themeOption->thumbnail) }}">
                            </div>
                            <img id="holder" style="margin-top:15px;max-height:100px;">

                            @error('thumbnail')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            @isset($themeOption)
                                <div class="col-md-4">
                                    <img src="{{ asset(@$themeOption->website_background_image) }}" alt="Img"
                                        class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                </div>
                            @endisset
                        </div>

                        <div class="col-md-12 form-group mt-2">
                            <p class="btn btn-white" id="thumb_link" href="#"><span class="btn-label"><i
                                        class="fa fa-link"></i></span> Link</p>
                            <p class="btn btn-white" id="thumb_file" href="#"><span class="btn-label"><i
                                        class="fa fa-file"></i></span> File</p>
                        </div>

                        <div class="mt-3 form__field" id="imageFile1">
                            <label for="poster">Poster Potrait(321 × 482 px)</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="poster" data-input="thumbnail11" data-preview="holder"
                                        class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="thumbnail11" class="form-control" type="text" name="poster"
                                    value="{{ old('poster', @$themeOption->poster) }}">
                            </div>
                            <img id="holder" style="margin-top:15px;max-height:100px;">

                            @error('poster')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            @isset($themeOption)
                                <div class="col-md-4">
                                    <img src="{{ asset(@$themeOption->website_background_image) }}" alt="Img"
                                        class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                </div>
                            @endisset
                        </div>
                        <input type="text" name="is_file" value="1" hidden id="file_type">
                        <input type="text" name="is_file1" value="1" hidden id="file_type1">

                        <div class="col-md-12 form-group mt-2">
                            <p class="btn btn-white" id="thumb_link1" href="#"><span class="btn-label"><i
                                        class="fa fa-link"></i></span> Link</p>
                            <p class="btn btn-white" id="thumb_file1" href="#"><span class="btn-label"><i
                                        class="fa fa-file"></i></span> File</p>
                        </div>

                        <br>
                        <h3>SEO & Marketing</h3>
                        <div class="mt-3 form__field">
                            <label for="meta_title">
                                SEO Title
                            </label>
                            <input id="meta_title" type="text" name="meta_title">
                        </div>

                        <div class="mt-3 form__field">
                            <label for="meta_keyword">
                                Meta Keyword
                            </label>
                            <input id="meta_keyword" type="text" name="meta_keyword">
                        </div>

                        <div class="mt-3 form__field">
                            <label for="meta_description">
                                Meta Description
                            </label>
                            <input id="meta_description" type="text" name="meta_description">
                        </div>


                        <div
                            class="d-flex flex-column-reverse sm:flex-row align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
                            <button type="button" class="mt-1 sm:mt-0 button--simple" data-action="prev">
                                Back
                            </button>
                            <button type="submit" id="finalSubmittion" disabled>
                                Plz Wait Video Is Uploading
                            </button>
                        </div>
                    </section>
                    <!-- / End Step 4 -->

                    <!-- Thank You -->
                    <section id="progress-form__thank-you" hidden>
                        <p>Thank you for your submission!</p>
                        <p>We appreciate you contacting us. One of our team members will get back to you
                            very&nbsp;soon.</p>
                    </section>
                    <!-- / End Thank You -->

                </form>
                <!-- / End Progress Form -->

                {{-- </div> --}}
                {{-- </div> --}}
            </section>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- Resumable JS -->
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

            target: '{{ route('files.upload.large') }}',
            query: {
                _token: '{{ csrf_token() }}'
            }, // CSRF token
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
        ) { // trigger when file pistorage/app/videos/pexels-ahmed-ツ-19970610 (Original)_9d5591632bc38c22131af656f13a54f7.mp4cked
            showProgress();
            resumable.upload(); // to actually start uploading.
            $('#movieUploadForm').css('display', 'block');
            $('#video_page').css('display', 'none');
            fileUploadAction=false;
        });

        resumable.on('fileProgress', function(file) {
            $('.uploadBtn').attr('hidden', true);
            updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', function(file, response) {
            response = JSON.parse(response)
            $('#imagePath').val(response.path);
            $('#transcodePath').val(response.transcode);
            $('#transcodeStatus').val('true');
            $('#videoPreview').attr('src', response.path);
            $('.card-footer').show();
            $('#fileUploadNewStatus').text('File Is Uploaded');
            $('#fileUploadNewStatus').removeClass('badge-danger');
            $('#fileUploadNewStatus').addClass('badge-success');
            $('#finalSubmittion').removeAttr('disabled');
            $('#finalSubmittion').text('Submit');
            fileUploadAction=true;
            if(formProcessDone){
                let rowId=$('#rowId').val();
                updateImagePath(rowId,response.path);
                // window.location.href=response.url;
            }
        });

        function updateImagePath(rowId,imagePath){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"{{route('updateimagepath')}}",
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
        const replaceImageData = () => {
            let html = '';
            html += '<div class="col-md-12" id="imageFile">';
            html += '<label for="image" class="form-label">Icon Image:</label>';
            html += '<div class="input-group">';
            html += '<span class="input-group-btn">';
            html +=
                '<a id="thumbnail" data-input="thumbnail1" data-preview="holder" class="btn btn-primary"><i class="fa fa-picture-o"></i> Choose</a>';
            html += '</span>';
            html +=
                '<input id="thumbnail1" required class="form-control" type="text" name="thumbnail" value="{{ old('thumbnail', @$data->thumbnail) }}">';
            html += '</div>';
            html += '</div>';
            return html;
        };
        const replaceFileData = () => {
            let file = '';
            file += '<div class="col-md-12" id="imageFile">';
            file += '<label for="image" class="form-label">Link:</label>';
            file += '<div class="input-group">';
            file +=
                '<input id="thumbnail1" required class="form-control" type="url" name="thumbnail" value="{{ old('thumbnail', @$data->thumbnail) }}">';
            file += '</div>';
            file += '</div>';
            return file;
        };

        const replaceImageData1 = () => {
            let html = '';
            html += '<div class="col-md-12" id="imageFile1">';
            html += '<label for="image" class="form-label">Icon Image:</label>';
            html += '<div class="input-group">';
            html += '<span class="input-group-btn">';
            html +=
                '<a id="poster" data-input="thumbnail11" data-preview="holder" class="btn btn-primary"><i class="fa fa-picture-o"></i> Choose</a>';
            html += '</span>';
            html +=
                '<input id="thumbnail11" required class="form-control" type="text" name="poster" value="{{ old('poster', @$data->poster) }}">';
            html += '</div>';
            html += '</div>';
            return html;
        };
        const replaceFileData1 = () => {
            let file = '';
            file += '<div class="col-md-12" id="imageFile1">';
            file += '<label for="image" class="form-label">Link:</label>';
            file += '<div class="input-group">';
            file +=
                '<input id="thumbnail11" required class="form-control" type="url" name="poster" value="{{ old('poster', @$data->poster) }}">';
            file += '</div>';
            file += '</div>';
            return file;
        };
        CKEDITOR.replace('description');
        $(document).ready(function() {
            $('#thumbnail').filemanager('image');
            $('#poster').filemanager('image');

        });
        $(document).on('click', '#thumb_link', function() {
            $('#imageFile').replaceWith(replaceFileData());
            $('#file_type').val('0');
        });

        $(document).on('click', '#thumb_file', function() {
            $('#imageFile').replaceWith(replaceImageData());
            $('#file_type').val('1');
            $('#thumbnail').filemanager('image');
        });
        $(document).on('click', '#thumb_link1', function() {
            $('#imageFile1').replaceWith(replaceFileData1());
            $('#file_type1').val('0');
        });

        $(document).on('click', '#thumb_file1', function() {
            $('#imageFile1').replaceWith(replaceImageData1());
            $('#file_type1').val('1');
            $('#poster').filemanager('image');
        });
    </script>
    @include('admin.css.moviejs')
    {{-- @include('admin.movie.customertrailer') --}}
@endpush
