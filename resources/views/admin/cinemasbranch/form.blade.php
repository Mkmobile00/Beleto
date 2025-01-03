@extends('admin.app')
@section('title', 'Add Cinemas Branch')
@section('main')
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Add Cinemas Branch</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                                <li class="breadcrumb-item active">
                                    Add Cinemas Branch
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @isset($cinemasbranch)
                        {{ Form::open(['url' => route('cinemasbranch.update', $cinemasbranch->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                        @method('patch')
                    @else
                        {{ Form::open(['url' => route('cinemasbranch.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                        @method('post')
                    @endisset

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Cinemas Branch Details</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="branch_id">Cinemas Branch Code:</label>
                                            <input type="text" name="branch_id" id="branch_id"
                                                class="form-control"
                                                value="{{ @$branch_id ?? @$cinemasbranch->branch_id }}"
                                                required readonly>
                                            @error('branch_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                value="{{ old('title', @$cinemasbranch->title) }}" required>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>



                                        <div class="col-md-6 form-group mt-2">
                                            <label for="summary">Summary</label>
                                            <textarea name="summary" id="summary" class="form-control" cols="30" rows="10">{{ old('summary', @$cinemasbranch->summary) }}</textarea>
                                            @error('summary')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ old('description', @$cinemasbranch->description) }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="cinemas_id">Cinemas </label>
                                            <select name="cinemas_id" id="cinemas_id" class="form-control" required>
                                                <option value="">------Select Cinema------</option>
                                                @foreach ($cinemas as $cinema)
                                                    <option value="{{ $cinema->id }}" {{ @$cinemasbranch->cinemas_id == $cinema->id ? 'selected' : ''}}>
                                                        {{ $cinema->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('cinemas_id')
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
                                                    value="{{ old('image', @$cinemasbranch->image) }}">
                                            </div>
                                            <img id="holder" style="margin-top:15px;max-height:100px;">

                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            @isset($cinemasbranch)
                                                <div class="col-md-4">
                                                    <img src="{{ asset(@$cinemasbranch->image) }}" alt="Img"
                                                        class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                                </div>
                                            @endisset
                                        </div>

                                        <div class="col-md-6 form-group mt-2" hidden id="cinemasBranchCityHtml">

                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                @foreach ($cinemas_status as $status)
                                                    <option value="{{ $status->value }}"
                                                        {{ @$cinemasbranch->status->value == $status->value ? 'selected' : '' }}>
                                                        {{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" id="saveForm">
                                                @isset($cinemasbranch)
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
        var allCityData = @json($citiesData);
        var cinemasCityArray=@json($cinemasCityArray);

        $(document).on('change', '#cinemas_id', function() {
            let cinemaId = $(this).val();
            let checkArrayData=cinemasCityArray[cinemaId];
            let formSelectedData=[];
            @isset($cinemasbranch)
                 formSelectedData="{{ @$cinemasbranch->cities->pluck('city_id') ?? [] }}";
            @endisset
            console.log('Sumit Data',formSelectedData);
            if (!cinemaId || !checkArrayData) {
                $('#cinemasBranchCityHtml').html('');
                $('#cinemasBranchCityHtml').attr('hidden', true);
                toastr.error("SomeData Is Missing Plz Set All Data Before Create Cinemas Branch !!");
                $('#saveForm').attr('disabled',true);
                return false;
            }
            $('#saveForm').removeAttr('disabled');
            var cityHtml = '';
            cityHtml += '<label for="cities">City </label>';
            cityHtml += '<select name="cities[]" id="cities" class="form-control select2" required multiple>';
            $.each(allCityData, function(index, value) {
                if(checkArrayData.includes(value.id)){
                    cityHtml += `<option value="${value.id}" ${formSelectedData.includes(value.id) ? "selected":""}>${value.title}</option>`;
                }
            });
            cityHtml += '</select>';
            cityHtml += '@error('cities')';
            cityHtml += '<span class="text-danger">{{ $message }}</span>';
            cityHtml += '@enderror';
            $('#cinemasBranchCityHtml').html(cityHtml);
            $('#cinemasBranchCityHtml').removeAttr('hidden');
            reloadSelect2();
        });

        @isset($cinemasbranch)
            $('#cinemas_id').change();
        @endisset
    </script>
@endpush
