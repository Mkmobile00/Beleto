@extends('admin.app')
@section('title', 'Video Type')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Video Type</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                Video Type
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                {{ Form::open(['url' => route('video-type.update', $videoType->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                @method('patch')
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Video Type</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{old('title',@$videoType->title)}}" required>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="description">Description</label>
                                        <input type="text" name="description" id="description" class="form-control" value="{{old('description',@$videoType->description)}}">
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            @foreach ($videoEnum as $enum)
                                                <option value="{{$enum->value}}" {{ old('status') != null || @$videoType->status->value != null ? (old('status', @$videoType->status->value) == $enum->value ? 'selected' : '') : '' }}>{{$enum->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="primary_menu">Primary Menu</label>
                                        <br>
                                        <input type="checkbox" name="primary_menu" id="primary_menu" value="1" {{@$videoType->primary_menu=='1' ? 'checked':''}}>
                                        @error('primary_menu')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="footer_menu">Footer Menu</label>
                                        <br>
                                        <input type="checkbox" name="footer_menu" id="footer_menu" value="1" {{@$videoType->footer_menu=='1' ? 'checked':''}}>
                                        @error('footer_menu')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit"
                                            class="btn btn-primary">Update</button>
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


    
@endpush
