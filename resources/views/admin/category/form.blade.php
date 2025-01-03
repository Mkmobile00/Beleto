@extends('admin.app')
@section('title', 'Add Category')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                Add Category
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @isset($category)
                {{ Form::open(['url' => route('category.update', $category->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                @method('patch')
                @else
                {{ Form::open(['url' => route('category.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                @method('post')
                @endisset
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Category Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{old('title',@$category->title)}}" required>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="parent_id">Parent Category</label>
                                        <select name="parent_id" id="parent_id" class="form-control">
                                            <option value="">---------Select Parent Category-----------</option>
                                            @foreach ($categories as $cat)
                                            <option value="{{$cat->id}}" {{ @$category->parent_id==$cat->id ? 'selected':''}}>{{$cat->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('parent_id')
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
                                                value="{{ old('image', @$category->image) }}">
                                        </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;">

                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                        @isset($slider)
                                            <div class="col-md-4">
                                                <img src="{{ asset(@$slider->image) }}" alt="Img"
                                                    class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                            </div>
                                        @endisset
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="is_featured">Is Featured</label>
                                        <select name="is_featured" id="is_featured" class="form-control">
                                            <option value="1" {{ @$category->is_featured=='1' ? 'selected':''}}>Yes</option>
                                            <option value="0" {{ @$category->is_featured=='0' ? 'selected':''}}>No</option>
                                        </select>
                                        @error('is_featured')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" >
                                            <option value="1" {{ @$category->status=='1' ? 'selected':''}}>Published</option>
                                            <option value="0" {{ @$category->status=='0' ? 'selected':''}}>Un Published</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="status">Mobile View</label>
                                        <br>
                                        @foreach ($view_types as $key=>$types)
                                            {{$types->name}}:
                                            <input type="radio" name="view_type" @isset($category) {{ $types->value==$category->view_type->value ? 'checked':''}} @else {{ $key==0 ? 'checked':''}} @endisset value="{{$types->value}}">
                                            <br>
                                        @endforeach
                                        
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                    <h1>Seo Management</h1>
                                    <div class="row">
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="meta_title">Meta Title</label>
                                            <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{old('meta_title',@$category->meta_title)}}">
                                            @error('meta_title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
    
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="meta_keyword">Meta Keyword</label>
                                            <input type="text" name="meta_keyword" id="meta_keyword" class="form-control" value="{{old('meta_keyword',@$category->meta_keyword)}}">
                                            @error('meta_keyword')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
    
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="meta_description">Meta Description</label>
                                            <textarea name="meta_description" class="form-control" id="meta_description" cols="30" rows="3">
                                                {{old('meta_description',@$category->meta_description)}}
                                            </textarea>
                                            @error('meta_description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="card-footer">
                                        <button type="submit"
                                            class="btn btn-primary">
                                            @isset($category)
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
    $(document).ready(function () {
        CKEDITOR.replace('meta_description');
        $('#lfm').filemanager('image');
    });
</script>
    
@endpush
