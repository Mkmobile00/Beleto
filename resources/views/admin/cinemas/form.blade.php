@extends('admin.app')
@section('title', 'Add Cinemas')
@section('main')
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Add Cinemas</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                                <li class="breadcrumb-item active">
                                    Add Cinemas
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @isset($cinema)
                        {{ Form::open(['url' => route('cinemas.update', $cinema->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                        @method('patch')
                    @else
                        {{ Form::open(['url' => route('cinemas.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                        @method('post')
                    @endisset

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Cinemas Details</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="cinemas_unique_code">Cinemas Code:</label>
                                            <input type="text" name="cinemas_unique_code" id="cinemas_unique_code"
                                                class="form-control"
                                                value="{{ @$cinemas_unique_code ?? @$cinema->cinemas_unique_code }}"
                                                required readonly>
                                            @error('cinemas_unique_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                value="{{ old('title', @$cinema->title) }}" required>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>



                                        <div class="col-md-6 form-group mt-2">
                                            <label for="summary">Summary</label>
                                            <textarea name="summary" id="summary" class="form-control" cols="30" rows="10">{{ old('summary', @$cinema->summary) }}</textarea>
                                            @error('summary')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ old('description', @$cinema->description) }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="cities">City </label>
                                            <select name="cities[]" id="cities" class="form-control select2" required multiple>
                                                @foreach ($cities as $status)
                                                    <option value="{{ $status->id }}"  @isset($cinema) {{ (in_array($status->id,@$cinema->city->pluck('city_id')->toArray()) ? 'selected':'') }} @endisset>
                                                        {{ $status->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('cities')
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
                                                    value="{{ old('image', @$cinema->image) }}">
                                            </div>
                                            <img id="holder" style="margin-top:15px;max-height:100px;">

                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            @isset($cinema)
                                                <div class="col-md-4">
                                                    <img src="{{ asset(@$cinema->image) }}" alt="Img"
                                                        class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                                </div>
                                            @endisset
                                        </div>
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                @foreach ($cinemas_status as $status)
                                                    <option value="{{ $status->value }}"
                                                        {{ @$cinema->status->value == $status->value ? 'selected' : '' }}>
                                                        {{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">
                                                @isset($cinema)
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
