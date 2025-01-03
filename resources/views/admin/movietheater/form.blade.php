@extends('admin.app')
@section('title', 'Add Movie Theater')
@section('main')
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Add Movie Theater</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                                <li class="breadcrumb-item active">
                                    Add Movie Theater
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @isset($movietheater)
                        {{ Form::open(['url' => route('movietheater.update', $movietheater->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                        @method('patch')
                    @else
                        {{ Form::open(['url' => route('movietheater.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                        @method('post')
                    @endisset

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Movie Theater Details</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="theater_unique_id">Movie Theater Code:</label>
                                            <input type="text" name="theater_unique_id" id="theater_unique_id"
                                                class="form-control"
                                                value="{{ @$theater_unique_id ?? @$movietheater->theater_unique_id }}"
                                                required readonly>
                                            @error('theater_unique_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                value="{{ old('title', @$movietheater->title) }}" required>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="screen_id">Screen Id</label>
                                            <input type="text" name="screen_id" id="screen_id" class="form-control"
                                                value="{{ old('screen_id', @$movietheater->screen_id) }}">
                                            @error('screen_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="seat_capacity">Seat Capacity</label>
                                            <input type="text" name="seat_capacity" id="seat_capacity"
                                                class="form-control"
                                                value="{{ old('seat_capacity', @$movietheater->seat_capacity) }}">
                                            @error('seat_capacity')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>



                                        <div class="col-md-6 form-group mt-2">
                                            <label for="summary">Summary</label>
                                            <textarea name="summary" id="summary" class="form-control" cols="30" rows="10">{{ old('summary', @$movietheater->summary) }}</textarea>
                                            @error('summary')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ old('description', @$movietheater->description) }}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="cinemas_id">Cinemas </label>
                                            <select name="cinemas_id" id="cinemas_id" class="form-control" required>
                                                <option value="">------Select Cinema------</option>
                                                @foreach ($cinemas as $cinema)
                                                    <option value="{{ $cinema->id }}"
                                                        {{ @$movietheater->cinemas_id == $cinema->id ? 'selected' : '' }}>
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
                                                    value="{{ old('image', @$movietheater->image) }}">
                                            </div>
                                            <img id="holder" style="margin-top:15px;max-height:100px;">

                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            @isset($movietheater)
                                                <div class="col-md-4">
                                                    <img src="{{ asset(@$movietheater->image) }}" alt="Img"
                                                        class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                                </div>
                                            @endisset
                                        </div>

                                        <div class="col-md-6 form-group mt-2" hidden id="cinemasBranchHtml">

                                        </div>



                                        <div class="col-md-6 form-group mt-2">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                @foreach ($cinemas_status as $status)
                                                    <option value="{{ $status->value }}"
                                                        {{ @$movietheater->status->value == $status->value ? 'selected' : '' }}>
                                                        {{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group mt-2" hidden id="cinemasBranchCitiesHtml">

                                        </div>


                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" id="saveForm">
                                                @isset($movietheater)
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
        let cinemasBranchArrayData = @json($cinemasBranchArrayData);
        let cinemasBranchData = @json($cinemasBranches);
        let citiesData = @json($cities);
        let citiesArrayData = @json($cinemasBranchCityArrayData);
        $(document).on('change', '#cinemas_id', function() {
            $('#cinemasBranchCitiesHtml').html('');
            $('#cinemasBranchCitiesHtml').attr('hidden', true);
            let selectedCinemasId = $(this).val();
            let filterCinemasData = cinemasBranchArrayData[selectedCinemasId];
            let formCinemasBranchId = "{{ @$movietheater->cinemas_branch_id ?? null }}"
            if (!selectedCinemasId || !filterCinemasData) {
                $('#cinemasBranchHtml').html('');
                $('#cinemasBranchHtml').attr('hidden', true);
                toastr.error("SomeData Is Missing Plz Set All Data Before Create Movie Theater !!");
                $('#saveForm').attr('disabled', true);
                return false;
            }
            $('#saveForm').removeAttr('disabled');
            var cinemasBranchHtml = '';
            cinemasBranchHtml += '<label for="cinemas_branch_id">Cinemas Branch </label>';
            cinemasBranchHtml +=
                '<select name="cinemas_branch_id" id="cinemas_branch_id" class="form-control" required>';
            cinemasBranchHtml += '<option value="">-----Select Cinemas Branch-----</option>';
            $.each(cinemasBranchData, function(index, value) {
                if (filterCinemasData.includes(value.id)) {
                    cinemasBranchHtml +=
                        `<option value="${value.id}" ${formCinemasBranchId==(value.id) ? "selected":""}>${value.title}</option>`;
                }
            });
            cinemasBranchHtml += '</select>';
            cinemasBranchHtml += '@error('cinemas_branch_id')';
            cinemasBranchHtml += '<span class="text-danger">{{ $message }}</span>';
            cinemasBranchHtml += '@enderror';
            $('#cinemasBranchHtml').html(cinemasBranchHtml);
            $('#cinemasBranchHtml').removeAttr('hidden');
        });

        $(document).on('change', '#cinemas_branch_id', function() {
            let selectedCinemasBranchId = $(this).val();
            let filterCinemasBranchCitiesData = citiesArrayData[selectedCinemasBranchId];
            let formCityId = "{{ @$movietheater->city_id ?? null }}"
            if (!selectedCinemasBranchId || !filterCinemasBranchCitiesData) {
                $('#cinemasBranchCitiesHtml').html('');
                $('#cinemasBranchCitiesHtml').attr('hidden', true);
                toastr.error("SomeData Is Missing Plz Set All Data Before Create Movie Theater !!");
                const saveFormButton = document.getElementById('saveForm');
                $('#saveForm').attr('disabled', true);
                return false;
            }
            $('#saveForm').removeAttr('disabled');
            var cinemasBranchCitiesHtml = '';
            cinemasBranchCitiesHtml += '<label for="city_id">City </label>';
            cinemasBranchCitiesHtml +=
                '<select name="city_id" id="city_id" class="form-control" required>';
            cinemasBranchCitiesHtml += '<option value="">-----Select City-----</option>';
            $.each(citiesData, function(index, value) {
                if (filterCinemasBranchCitiesData.includes(value.id)) {
                    cinemasBranchCitiesHtml +=
                        `<option value="${value.id}" ${formCityId==(value.id) ? "selected":""}>${value.title}</option>`;
                }
            });
            cinemasBranchCitiesHtml += '</select>';
            cinemasBranchCitiesHtml += '@error('city_id')';
            cinemasBranchCitiesHtml += '<span class="text-danger">{{ $message }}</span>';
            cinemasBranchCitiesHtml += '@enderror';
            $('#cinemasBranchCitiesHtml').html(cinemasBranchCitiesHtml);
            $('#cinemasBranchCitiesHtml').removeAttr('hidden');
        });

        @isset($movietheater)
            $('#cinemas_id').change();
            $('#cinemas_branch_id').change();
        @endisset
    </script>
@endpush
