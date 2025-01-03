@extends('admin.app')
@section('title', 'Video Quality')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Video Quality</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                Video Quality
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                {{ Form::open(['url' => route('video-quality.update', $videoQuality->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                @method('patch')
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Theme Options</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="quality">Video Quality</label>
                                        <input type="text" name="quality" id="quality" class="form-control" value="{{old('quality',@$videoQuality->quality)}}" required>
                                        @error('quality')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="description">Description</label>
                                        <input type="text" name="description" id="description" class="form-control" value="{{old('description',@$videoQuality->description)}}">
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            @foreach ($videoEnum as $enum)
                                                <option value="{{$enum->value}}" {{ old('status') != null || @$videoQuality->status->value != null ? (old('status', @$videoQuality->status->value) == $enum->value ? 'selected' : '') : '' }}>{{$enum->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
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
