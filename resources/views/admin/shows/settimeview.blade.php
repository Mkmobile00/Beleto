@extends('admin.app')
@section('title', 'Set Shows Time')
@section('main')
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Set Shows Time</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                                <li class="breadcrumb-item active">
                                    Set Shows Time
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid" id="updateForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                {{ Form::open(['url' => route('shows.setDatesData', $show->id), 'files' => true, 'class' => 'form form-horizontal', 'id' => 'timeSlotForm']) }}
                                @method('post')
                                <div class="card-header">
                                    <h3 class="card-title">Set Shows Time</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 form-group mt-2">
                                            <label for="shows_number">Select Show Date</label>
                                            <input name='date_range' class="form-control" id='cal' required readonly
                                                data-toggle="tooltip" data-placement="top" title="Select a date range" />
                                            <span class="text-danger" hidden id="date_rangeError"></span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-4">
                                            <label for="shows_number">Total Shows</label>
                                            <input name='shows_number' type="number" class="form-control" id='shows_number'
                                                placeholder="Enter Total Shows For Per Day" oninput="setShowsCount(this)"
                                                required />
                                            <span class="text-danger" hidden id="shows_numberError"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-4">
                                            <label for="shows_number">Set Time</label>
                                            <div id="timeZoneHtml">

                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" id="setShowsForm">
                                            Set
                                        </button>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                        @if ($presentTheaterDates && count($presentTheaterDates) > 0)
                            <div class="col-md-6">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Update Shows Time</h3>
                                    </div>
                                    <div class="card-body">
                                        <h3>Dates/Time</h3>
                                        <br>
                                        @foreach ($presentTheaterDates as $date)
                                            <span class="badge badge-danger">{{ @$date['date'] }}</span>
                                            <a href="javascript:;" style="border-radius:50%"
                                                data-showDatesId="{{ @$date['id'] }}"
                                                class="btn btn-sm btn-danger btn-style icon btn-rounded delete-show-date">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <br>
                                            @foreach (@$date['timeSlot'] as $time)
                                                <span class="badge badge-dark">{{ @$time['start_time'] }}</span>
                                                <span class="badge badge-dark">{{ @$time['end_time'] }}</span>
                                                <a href="javascript:;" style="border-radius:50%"
                                                    class="btn btn-sm btn-danger btn-style icon btn-rounded ">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <br>
                                            @endforeach

                                            <br>
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
        </div>
        </section>
    </div>

    </div>
@endsection

@push('scripts')
    <script>
        var bookedData = @json(@$bookedDateArray) ?? [];

        function datePickerAction() {
            const today = moment();
            var dates = [];
            var restrictedDates = bookedData ?? [];
            var highlightedDates = [];
            $("#cal").daterangepicker({
                locale: {
                    format: 'YYYY/MM/DD'
                },
                minDate: today,
                autoApply: false,
                autoUpdateInput: false,
                isInvalidDate: function(date) {
                    return restrictedDates.includes(date.format('YYYY/MM/DD'));
                },
                isCustomDate: function(date) {
                    if (highlightedDates.includes(date.format('YYYY/MM/DD'))) {
                        return 'highlighted-date';
                    }
                    return '';
                }
            }).on('apply.daterangepicker', function(e, picker) {
                e.preventDefault();
                let startDate = picker.startDate;
                const endDate = picker.endDate;
                const dateArray = [];

                while (startDate <= endDate) {
                    const formattedDate = startDate.format('YYYY/MM/DD');
                    if (!restrictedDates.includes(formattedDate)) {
                        dateArray.push(startDate.format('YYYY/MM/DD'));
                        highlightedDates.push(formattedDate);
                    }
                    startDate = startDate.add(1, 'days');
                }
                highlightedDates = dateArray;
                $(this).val(dateArray.join('-'));
                $(this).attr('title', 'Selected Dates: ' + dateArray.join(', ')).tooltip('update');
                $("#cal").data('daterangepicker').updateView();
            });
            $("#cal").val('');
            $("<style>")
                .prop("type", "text/css")
                .html("\
                                                    .highlighted-date {\
                                                        background-color: #f39c12 !important; /* Custom highlight color */\
                                                        color: white !important;\
                                                    }")
                .appendTo("head");

            $('[data-toggle="tooltip"]').tooltip();
        }
        datePickerAction();
        $(document).ready(function() {
            // CKEDITOR.replace('summary');
            // CKEDITOR.replace('description');
            $('#lfm').filemanager('image');
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
                timeHtmlData += '<div class="col-md-12 mb-3" style="display:flex;align-items:center">';
                timeHtmlData += `<input type="time" name="start_time[]" class="start-time" required>`;
                timeHtmlData += `<input type="time" name="end_time[]" class="end-time" required>`;
                timeHtmlData += `<div style="margin-left:10px;margin-bottom:33px">`;
                // timeHtmlData += generateMovieHtml();
                timeHtmlData += '</div>';
                timeHtmlData += '</div>';
            }
            timeHtmlData += '<span class="text-danger" hidden id="timeError"></span>';
            timeHtmlData += '</div>';
            timeHtmlData += '<span class="text-danger" hidden id="movie_idError"></span>';
            $('#timeZoneHtml').html(timeHtmlData);

            $('.start-time, .end-time').on('change', function() {
                validateTimes();
            });
        };
        const validateTimes = () => {
            let startTimes = [];
            let endTimes = [];
            let isValid = true;

            $('.start-time').each(function() {
                const startTime = $(this).val();
                if (startTime) {
                    if (startTimes.includes(startTime)) {
                        isValid = false;
                        toastr.error("Start times must be unique.");
                    }
                    startTimes.push(startTime);
                }
            });

            $('.end-time').each(function() {
                const endTime = $(this).val();
                if (endTime) {
                    if (endTimes.includes(endTime)) {
                        isValid = false;
                        toastr.error("End times must be unique.");
                    }
                    endTimes.push(endTime);
                }
            });

            $('.start-time').each(function(index) {
                const startTime = $(this).val();
                const endTime = $('.end-time').eq(index).val();
                if (startTime && endTime && startTime >= endTime) {
                    isValid = false;
                    toastr.error("Start time must be less than end time for each show.");
                }
            });

            for (let i = 0; i < startTimes.length; i++) {
                const start1 = startTimes[i];
                const end1 = endTimes[i];

                for (let j = 0; j < startTimes.length; j++) {
                    if (i !== j) {
                        const start2 = startTimes[j];
                        const end2 = endTimes[j];
                        if (start2 > start1 && start2 < end1) {
                            isValid = false;
                            toastr.error(`Start time ${start2} is within the range of another time slot.`);
                            break;
                        }
                        if (end2 > start1 && end2 < end1) {
                            isValid = false;
                            toastr.error(`End time ${end2} is within the range of another time slot.`);
                            break;
                        }
                        if (start2 < end1 && end2 > start1) {
                            isValid = false;
                            toastr.error("Time slots must not overlap.");
                            break;
                        }
                    }
                }
            }

            if (isValid) {
                $('#setShowsForm').removeAttr('disabled');
            } else {
                $('#setShowsForm').attr('disabled', true);
            }
        };
        $(document).on('click', '#setShowsForm', function() {
            let formData = document.getElementById('timeSlotForm');
            $('#date_rangeError').attr('hidden', true);
            $('#shows_numberError').attr('hidden', true);
            $('#timeError').attr('hidden', true);
            let dateRange = formData['date_range'].value;
            let showsNumber = formData['shows_number'].value;

            let startTimeElements = formData.querySelectorAll('input[name="start_time[]"]');
            let startTime = Array.from(startTimeElements).map(el => el.value);

            let endTimeElements = formData.querySelectorAll('input[name="end_time[]"]');
            let endTime = Array.from(endTimeElements).map(el => el.value);

            let movieItemElements = formData.querySelectorAll('select[name="movie_id[]"]');
            let movieId = Array.from(movieItemElements).map(el => el.value);
            if (!dateRange) {
                $('#date_rangeError').removeAttr('hidden');
                $('#date_rangeError').text('Required...');
                return false;
            }
            if (!showsNumber) {
                $('#shows_numberError').removeAttr('hidden');
                $('#shows_numberError').text('Required...');
                return false;
            }
            if (startTime.some(time => time === null || time.trim() === "")) {
                $('#timeError').removeAttr('hidden');
                $('#timeError').text('Start time section can not be empty...');
                return false;
            }
            if (endTime.some(time => time === null || time.trim() === "")) {
                $('#timeError').removeAttr('hidden');
                $('#timeError').text('End time section can not be empty...');
                return false;
            }
            if (movieId.some(time => time === null || time.trim() === "")) {
                $('#movie_idError').removeAttr('hidden');
                $('#movie_idError').text('Movie section can not be empty...');
                return false;
            }
            $('#setShowsForm').submit();
        });
        $(document).on('click', '.delete-show-date', function() {
            let showDateId = $(this).attr('data-showDatesId');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('shows.deleteDates') }}",
                type: "post",
                data: {
                    showDateId: showDateId
                },
                success: function(response) {
                    if (response.error) {
                        toastr.error(response.msg);
                    }
                    $('#updateForm').replaceWith(response.view);
                    toastr.success(response.msg);
                    bookedData = response.bookedDateArray;
                    datePickerAction();
                }
            });
        });
    </script>
@endpush
