@extends('admin.app')
@section('title', 'Post Category Management')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Post Category Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                Post Category Management
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @isset($post)
                {{ Form::open(['url' => route('post.update', $post->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                @method('patch')
                @else
                {{ Form::open(['url' => route('post.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
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
                                        <label for="title">Post Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{old('title',@$post->title)}}" required>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="content">Content</label>
                                        <textarea name="content" id="content" class="form-control" cols="30" rows="10" required>
                                            {{old('content',@$post->content)}}
                                        </textarea>
                                        @error('content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                   
                                    @isset($post)
                                        @if($post->is_file=='1')
                                            <div class="col-md-12" id="imageFile">
                                                <label for="image" class="form-label">Icon Image:</label>
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <a id="lfm1111" data-input="thumbnail11" data-preview="holder"
                                                            class="btn btn-primary">
                                                            <i class="fa fa-picture-o"></i> Choose
                                                        </a>
                                                    </span>
                                                    <input id="thumbnail11" class="form-control" type="text" name="thumbnail" required
                                                        value="{{ old('thumbnail', @$post->thumbnail) }}">
                                                </div>
                                                <img id="holder" style="margin-top:15px;max-height:100px;" src="{{@$post->thumbnail}}">
                                            </div>

                                        @else
                                            <div class="col-md-12" id="imageFile">
                                                <label for="image" class="form-label">Link:</label>
                                                <div class="input-group">
                                                    <input id="thumbnail11" class="form-control" type="text" name="thumbnail" required
                                                        value="{{ old('thumbnail', @$post->thumbnail) }}">
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                    <div class="col-md-12" id="imageFile">
                                        <label for="image" class="form-label">Icon Image:</label>
                                        <div class="input-group">


                                            <span class="input-group-btn">
                                                <a id="lfm1111" data-input="thumbnail11" data-preview="holder"
                                                    class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                </a>
                                            </span>
                                            <input id="thumbnail11" class="form-control" type="text" name="thumbnail" required
                                                value="{{ old('thumbnail', @$data->thumbnail) }}">
                                        </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;">
                                    </div>
                                   
                                    @endisset
                                    @error('thumbnail')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <p class="btn btn-white" id="thumb_link" href="#"><span class="btn-label"><i class="fa fa-link"></i></span> Link</p>
                                    <p class="btn btn-white" id="thumb_file" href="#"><span class="btn-label"><i class="fa fa-file"></i></span> File</p>

                                    <input type="text" name="is_file" value="1" hidden id="file_type">
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="title">Category</label>
                                        @foreach ($postCategories as $cat)
                                            <br>
                                            <input type="checkbox" name="post_cat[]" value="{{$cat->id}}" @isset($post)
                                            {{in_array($cat->id,$post->postCategory->pluck('id')->toArray()) ? 'checked':''}}
                                            @endisset> {{$cat->name}} 
                                        @endforeach
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="title">Published</label>
                                        <select name="status" id="status" class="form-control" required>
                                            @foreach ($postStatus as $status)
                                               <option value="{{$status->value}}">{{$status->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <h3 class="text-center">SEO Configuration Management</h3>
                                    <hr>
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="meta_title">SEO meta_title</label>
                                        <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{old('meta_title',@$post->meta_title)}}" required>
                                        @error('meta_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="meta_keyword">Focus Keyword</label>
                                        <input type="text" name="meta_keyword" id="meta_keyword" class="form-control" value="{{old('meta_keyword',@$post->meta_keyword)}}" required>
                                        @error('meta_keyword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" id="meta_description" class="form-control" cols="30" rows="10">
                                            {{old('meta_description',@$post->meta_description)}}
                                        </textarea>
                                        @error('meta_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit"
                                            class="btn btn-primary">
                                            @isset($post)
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
    CKEDITOR.replace('content');
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
