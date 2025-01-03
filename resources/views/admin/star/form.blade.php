@extends('admin.app')
@section('title', 'Add Star')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Star</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                Add Star
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @isset($star)
                {{ Form::open(['url' => route('star.update', $star->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                @method('patch')
                @else
                {{ Form::open(['url' => route('star.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                @method('post')
                @endisset
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Star Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{old('name',@$star->name)}}" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                   
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="star_type">Star Type</label>
                                        <select name="star_type" id="star_type" class="form-control">
                                            @foreach ($starTypes as $type)
                                                <option value="{{$type->value}}" {{ @$star->star_type->value==$type->value ? 'selected':''}}>{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('star_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                   
                                    @error('star_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    

                                    
                                    <div class="col-md-6 form-group mt-2" id="imageFile">
                                        <label for="image" class="form-label">Image:</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail11" data-preview="holder"
                                                    class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                </a>
                                            </span>
                                            <input id="thumbnail11" class="form-control" type="text" name="image"
                                                value="{{ old('image', @$star->image) }}">
                                        </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;" src="{{@$star->image}}">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="star_bio">Star Bio</label>
                                        <textarea name="star_bio" class="form-control" id="star_bio" cols="30" rows="3">
                                            {{old('star_bio',@$star->star_bio)}}
                                        </textarea>
                                        @error('star_bio')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                   
                                    
                                    <div class="card-footer">
                                        <button type="submit"
                                            class="btn btn-primary">
                                            @isset($star)
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
        $('#lfm').filemanager('image');
    });
</script>
    
@endpush
