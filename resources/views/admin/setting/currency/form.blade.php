@extends('admin.app')
@section('title', 'Currency')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Currency</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                Currency
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                {{ Form::open(['url' => route('currency.update', $currency->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                @method('patch')
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Currency</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{old('title',@$currency->title)}}" required>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="value">Value</label>
                                        <input type="text" min="1" name="value" id="value" class="form-control" value="{{old('value',@$currency->value)}}" required>
                                        @error('value')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            @foreach ($videoEnum as $enum)
                                                <option value="{{$enum->value}}" {{ old('status') != null || @$currency->status != null ? (old('status', @$currency->status) == $enum->value ? 'selected' : '') : '' }}>{{$enum->name}}</option>
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
