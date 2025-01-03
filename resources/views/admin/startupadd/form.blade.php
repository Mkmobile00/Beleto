@extends('admin.app')
@section('title', 'Startup Add Management')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Startup Add Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                Startup Add Management
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @isset($startupadd)
                {{ Form::open(['url' => route('startupadd.update', $startupadd->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                @method('patch')
                @else
                {{ Form::open(['url' => route('startupadd.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                @method('post')
                @endisset
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Theme Options</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{old('title',@$startupadd->title)}}" required>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control" cols="30" rows="10" required>
                                            {{old('description',@$startupadd->description)}}
                                        </textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                   
                                    <div class="col-md-12" id="imageFile">
                                        <label for="image" class="form-label">Image:</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm1111" data-input="thumbnail11" data-preview="holder"
                                                    class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                </a>
                                            </span>
                                            <input id="thumbnail11" class="form-control" type="text" name="image" required
                                                value="{{ old('image', @$startupadd->image) }}">
                                        </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;" src="{{@$startupadd->image}}">
                                    </div>

                                    
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="from_date">From Date</label>
                                        <input type="date" name="from_date" id="from_date" class="form-control" value="{{old('from_date',@$startupadd->from_date)}}" required>
                                        @error('from_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="to_date">To Date</label>
                                        <input type="date" name="to_date" id="to_date" class="form-control" value="{{old('to_date',@$startupadd->to_date)}}" required>
                                        @error('to_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="status">Published</label>
                                        <select name="status" id="status" class="form-control" required>
                                            @foreach ($statuses as $status)
                                               <option value="{{$status->value}}" {{@$startupadd->status->vbalue==$status->value ? 'selected':''}}>{{$status->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit"
                                            class="btn btn-primary">
                                            @isset($startupadd)
                                                Update
                                            @else
                                                Add
                                            @endisset
                                        </button>
                                    </div>

                                </div>
                                {{Form::close()}}
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

const replaceImageData = () => {
    let html = '';
    html += '<div class="col-md-12" id="imageFile">';
    html += '<label for="image" class="form-label">Icon Image:</label>';
    html += '<div class="input-group">';
    html += '<span class="input-group-btn">';
    html += '<a id="lfm1111" data-input="thumbnail11" data-preview="holder" class="btn btn-primary"><i class="fa fa-picture-o"></i> Choose</a>';
    html += '</span>';
    html += '<input id="thumbnail11" required class="form-control" type="text" name="thumbnail" value="{{ old("thumbnail", @$data->thumbnail) }}">';
    html += '</div>';
    html += '</div>';
    return html;
};
const replaceFileData = () => {
    let file= '';
    file+= '<div class="col-md-12" id="imageFile">';
    file+= '<label for="image" class="form-label">Link:</label>';
    file+= '<div class="input-group">';
    file+= '<input id="thumbnail11" required class="form-control" type="url" name="thumbnail" value="{{ old("thumbnail", @$data->thumbnail) }}">';
    file+= '</div>';
    file+= '</div>';
    return file;
};

$(document).ready(function () {
    CKEDITOR.replace('description');
    CKEDITOR.replace('meta_description');
    $('#lfm1111').filemanager('image');

    $(document).on('click', '#thumb_link', function () {
        $('#imageFile').replaceWith(replaceFileData('link'));
        $('#file_type').val('0');
    });

    $(document).on('click', '#thumb_file', function () {
        $('#imageFile').replaceWith(replaceImageData('image'));
        $('#file_type').val('1');
        $('#lfm1111').filemanager('image');

    });
});


</script>
    
@endpush
