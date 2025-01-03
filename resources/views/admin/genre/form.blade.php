@extends('admin.app')
@section('title', 'Add Genre')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Genre</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                Add Genre
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @isset($genre)
                {{ Form::open(['url' => route('genre.update', $genre->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                @method('patch')
                @else
                {{ Form::open(['url' => route('genre.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                @method('post')
                @endisset
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Genre Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{old('title',@$genre->title)}}" required>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                   
                                    @error('thumbnail')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="is_featured">Is Featured</label>
                                        <select name="is_featured" id="is_featured" class="form-control">
                                            <option value="1" {{ @$genre->is_featured=='1' ? 'selected':''}}>Yes</option>
                                            <option value="0" {{ @$genre->is_featured=='0' ? 'selected':''}}>No</option>
                                        </select>
                                        @error('is_featured')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" >
                                            <option value="1" {{ @$genre->status=='1' ? 'selected':''}}>Published</option>
                                            <option value="0" {{ @$genre->status=='0' ? 'selected':''}}>Un Published</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{-- @dd($genre->is_file) --}}
                                    @isset($genre)
                                        @if($genre->is_file=='1')
                                        <div class="col-md-12 form-group mt-2" id="imageFile">
                                            <label for="image" class="form-label">Icon Image:</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a id="lfm" data-input="thumbnail11" data-preview="holder"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                                <input id="thumbnail11" class="form-control" type="text" name="icon"
                                                    value="{{ old('icon', @$genre->icon) }}">
                                            </div>
                                            <img id="holder" style="margin-top:15px;max-height:100px;" src="{{@$genre->icon}}">
                                            @error('icon')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        @else
                                        <div class="col-md-12" id="imageFile">
                                            <label for="image" class="form-label">Link:</label>
                                            <div class="input-group">
                                                <input id="thumbnail11" class="form-control" type="url" name="icon"
                                                    value="{{ old('icon', @$genre->icon) }}">
                                            </div>
                                        </div>
                                        @endif
                                    @else
                                    <div class="col-md-12 form-group mt-2" id="imageFile">
                                        <label for="image" class="form-label">Icon Image:</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail11" data-preview="holder"
                                                    class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                </a>
                                            </span>
                                            <input id="thumbnail11" class="form-control" type="text" name="icon"
                                                value="{{ old('icon', @$genre->icon) }}">
                                        </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;">
                                        @error('icon')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @endisset
                                   
                                   
                                    <div class="col-md-12 form-group mt-2">
                                        <p class="btn btn-white" id="thumb_link" href="#"><span class="btn-label"><i class="fa fa-link"></i></span> Link</p>
                                        <p class="btn btn-white" id="thumb_file" href="#"><span class="btn-label"><i class="fa fa-file"></i></span> File</p>
                                    </div>
                                    
                                    

                                    <input type="text" name="is_file" value="1" hidden id="file_type">

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="description">Description</label>
                                        <textarea name="description" class="form-control" id="description" cols="30" rows="3">
                                            {{old('description',@$genre->description)}}
                                        </textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                   
                                    
                                    <div class="card-footer">
                                        <button type="submit"
                                            class="btn btn-primary">
                                            @isset($genre)
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
    html += '<a id="lfm" data-input="thumbnail11" data-preview="holder" class="btn btn-primary"><i class="fa fa-picture-o"></i> Choose</a>';
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
        $('#lfm').filemanager('image');

        $(document).on('click', '#thumb_link', function () {
            $('#imageFile').replaceWith(replaceFileData('link'));
            $('#file_type').val('0');
        });

        $(document).on('click', '#thumb_file', function () {
            $('#imageFile').replaceWith(replaceImageData('image'));
            $('#file_type').val('1');
            $('#lfm').filemanager('image');
        });
    });
</script>
    
@endpush
