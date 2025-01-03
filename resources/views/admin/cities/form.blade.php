@extends('admin.app')
@section('title', 'Add City')
@section('main')
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Add City</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                                <li class="breadcrumb-item active">
                                    Add City
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @isset($city)
                        {{ Form::open(['url' => route('city.update', $city->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                        @method('patch')
                    @else
                        {{ Form::open(['url' => route('city.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                        @method('post')
                    @endisset

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">City Details</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                       
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                value="{{ old('title', @$city->title) }}" required>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                @foreach ($cities_status as $status)
                                                    <option value="{{ $status->value }}"
                                                        {{ @$city->status->value == $status->value ? 'selected' : '' }}>
                                                        {{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">
                                                @isset($city)
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
