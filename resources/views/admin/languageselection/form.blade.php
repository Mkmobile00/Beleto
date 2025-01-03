@extends('admin.app')
@section('title', 'Add Language')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Language</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                Add Language
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @isset($languageSelection)
                {{ Form::open(['url' => route('language-selection.update', $languageSelection->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                @method('patch')
                @else
                {{ Form::open(['url' => route('language-selection.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                @method('post')
                @endisset
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Language Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{old('title',@$languageSelection->title)}}" required>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                   
                                    

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" >
                                            <option value="1" {{ @$languageSelection->status=='1' ? 'selected':''}}>Published</option>
                                            <option value="0" {{ @$languageSelection->status=='0' ? 'selected':''}}>Un Published</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="description">Description</label>
                                        <textarea name="description" class="form-control" id="description" cols="30" rows="3">
                                            {{old('description',@$languageSelection->description)}}
                                        </textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                   
                                    
                                    <div class="card-footer">
                                        <button type="submit"
                                            class="btn btn-primary">
                                            @isset($languageSelection)
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
        CKEDITOR.replace('description');
        $('#lfm').filemanager('image');

       
    });
</script>
    
@endpush
