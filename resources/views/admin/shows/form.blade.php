@extends('admin.app')
@section('title', 'Add Shows')
@section('main')
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Add Shows</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                                <li class="breadcrumb-item active">
                                    Add Shows
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @isset($show)
                        {{ Form::open(['url' => route('shows.update', $show->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                        @method('patch')
                    @else
                        {{ Form::open(['url' => route('shows.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                        @method('post')
                    @endisset

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Shows Details</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                value="{{ old('title', @$show->title) }}" required>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="movies_id">Movie</label>
                                            <select name="movies_id" id="movies_id" class="form-control select2" required>
                                                @foreach ($movies as $key=>$movie)
                                                    @if($key==0)
                                                        <option value="">-----Select Movie-----</option>
                                                    @endif
                                                    <option value="{{ $movie->id }}" {{ @$show->movies_id==$movie->id ? 'selected' :'' }}>
                                                        {{ $movie->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('movies_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="theater_id">Theater</label>
                                            <select name="theater_id" id="theater_id" class="form-control select2" required>
                                                @foreach ($theaters as $key=>$theater)
                                                    @if($key==0)
                                                        <option value="">-----Select Theater-----</option>
                                                    @endif
                                                    <option value="{{ $theater->id }}" {{ @$show->theater_id==$theater->id ? 'selected' :'' }}>
                                                        {{ $theater->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('theater_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="image">Image</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm" data-input="thumbnail1" data-preview="holder"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                                <input id="thumbnail1" class="form-control" type="text" name="image"
                                                    value="{{ old('image', @$show->image) }}">
                                            </div>
                                            <img id="holder" style="margin-top:15px;max-height:100px;">

                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            @isset($show)
                                                <div class="col-md-4">
                                                    <img src="{{ asset(@$show->image) }}" alt="Img"
                                                        class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                                </div>
                                            @endisset
                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="summary">Summary</label>
                                            <textarea name="summary" id="summary" class="form-control" cols="30" rows="10">{{ old('summary', @$show->summary) }}</textarea>
                                            @error('summary')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ old('description', @$show->description) }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>




                                        <div class="col-md-6 form-group mt-2" hidden id="showCityHtml">

                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                @foreach ($shows_status as $status)
                                                    <option value="{{ $status->value }}"
                                                        {{ @$show->status->value == $status->value ? 'selected' : '' }}>
                                                        {{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" id="saveForm">
                                                @isset($show)
                                                    Update
                                                @else
                                                    Add
                                                @endisset
                                            </button>
                                        </div>

                                    </div>
                                </div>
                                {{ Form::close() }}
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
        $(document).ready(function() {
            // CKEDITOR.replace('summary');
            // CKEDITOR.replace('description');
            $('#lfm').filemanager('image');
        });
    </script>
@endpush
