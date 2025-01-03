@extends('admin.app')
@section('title', 'Cinemas List')
@section('main')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Cinemas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin.home') }}</li>
                        </ol>
                    </div>
                    <a href="{{ route('cinemas.create') }}" class="btn btn-sm btn-success ml-auto">Create Cinemas</a>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Cinemas List
                                </h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Unique Id</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($notifications as $key => $data)
                                            <tr>
                                                <td>{{ $data->cinemas_unique_code }}</td>
                                                <td>{{ $data->title }}</td>

                                                <td>
                                                    <img src="{{ @$data->image }}" alt="" height="50px"
                                                        width="100px">
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $data->status->value == '1' ? 'info' : 'danger' }}">{{ $data->status->name }}</span>
                                                </td>

                                                <td>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('cinemas.edit', $data->id) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:;"
                                                        class="btn btn-sm  icon btn-rounded btn-danger btn-style delete-visitor"
                                                        data-id="{{ $data->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    {{ Form::open(['url' => route('cinemas.destroy', $data->id), 'class' => 'delete-form']) }}
                                                    @method('delete')
                                                    {{ Form::close() }}

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>




@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-visitor', function(e) {

            e.preventDefault();
            let clicked = confirm('Are You Sure Want To Delete Cinemas');

            if (clicked) {
                $(this).parent().find('form').submit();
            }
        });

        const setShowsCount = (input) => {
            $('#setShowsForm').removeAttr('disabled');
            let showsCount = input.value;

            if (showsCount > 7) {
                $('#setShowsForm').attr('disabled', true);
                $('#timeZoneHtml').html('');
                toastr.error("Shows Must Not Be Greater Than 7 Shows In A Day");
                return false;
            }

            let timeHtmlData = '<div id="timeZoneHtml">';
            for (let i = 1; i <= showsCount; i++) {
                timeHtmlData +=
                    `<div class="col-md-12 mb-3 time-slot" data-index="${i}" style="display:flex;align-items:center">`;
                timeHtmlData += `<input type="time" name="start_time[]" class="start-time" required>`;
                timeHtmlData += `<input type="time" name="end_time[]" class="end-time" required>`;
                timeHtmlData +=
                    `<button type="button" class="btn btn-danger delete-slot" data-index="${i}" style="margin-left:10px;">Delete</button>`;
                timeHtmlData += `</div>`;
            }
            timeHtmlData += '<span class="text-danger" hidden id="timeError"></span>';
            timeHtmlData += '</div>';
            timeHtmlData += '<span class="text-danger" hidden id="movie_idError"></span>';
            $('#timeZoneHtml').html(timeHtmlData);
            $('.start-time, .end-time').on('change', function() {
                validateTimes();
            });
            $('.delete-slot').on('click', function() {
                deleteTimeSlot($(this).data('index'));
            });
            $('#selected_time').on('change', function() {
                handleSelectedTimeChange();
            });
        };

        const validateTimes = () => {
            let selectedTimes = [];
            $('.start-time').each(function(index) {
                let startTime = $(this).val();
                let endTime = $('.end-time').eq(index).val();

                // Check if both start and end times are filled
                if (startTime && endTime) {
                    selectedTimes.push({
                        start: startTime,
                        end: endTime,
                        index: index
                    });
                }
            });
            updateSelectedTimeDropdown(selectedTimes);
        };

        const updateSelectedTimeDropdown = (times) => {
            $('#selected_time').empty();
            times.forEach((time) => {
                let optionText = `Show ${time.index + 1}: ${time.start} - ${time.end}`;
                $('#selected_time').append(`<option value="${time.index}" selected>${optionText}</option>`);
            });
        };

        const deleteTimeSlot = (index) => {
            $(`.time-slot[data-index=${index}]`).remove();
            validateTimes();
        };

        const handleSelectedTimeChange = () => {
            let selectedOptions = $('#selected_time').val();
            $('.time-slot').each(function() {
                let timeSlotIndex = $(this).data('index').toString();
                if (!selectedOptions.includes(timeSlotIndex)) {
                    $(this).remove();
                }
            });
            validateTimes();
        };




        $(document).on('click', '.setCinemasTime', function() {
            var cinemasId = $(this).attr('data-cinemasId');
            $('#datePickerModal').modal('show');
            // $.ajax({

            // });
        });
    </script>
@endpush
