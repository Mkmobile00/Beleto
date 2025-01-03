@extends('admin.app')
@section('title', 'Movie Theater Timing')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endpush
@section('main')
    <div class="wrapper">
        <div class="content-wrapper">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">{{ @$theater->title }} /</span> Set Time Slot
            </h4>
            <!-- FormValidation -->
            <form id="form" class="row g-3" method="POST" action="{{ route('addTheaterTime',@$theater->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-md-6 mb-3" hidden>
                                <label class="form-label" for="interval">Interval (in minutes)</label>
                                <input type="number" id="interval" class="form-control" name="interval"
                                    value="{{ old('interval', 60) }}" pattern="^\d+$
                            " />
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="10%">Days</th>
                                                <th width="90%">Slots (Start and end time)</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0" id="sortable">
                                            <tr>
                                                <td>
                                                    <div class="form-check form-switch mb-2">
                                                        <input type="checkbox" name="sunday" class="form-check-input day"
                                                            id="sunday" value="sunday"
                                                            {{ old('sunday') == 'sunday' ? 'checked' : 'checked' }}>
                                                        <label class="form-check-label" for="sunday">Sunday</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-md-12 row day-sunday">
                                                        <div class="col-md-4 mb-1">
                                                            <input type="text" name="start_time[sunday][]"
                                                                class="form-control timepicker day-sunday" value="10:00" />
                                                        </div>
                                                        <div class="col-md-4 mb-1">
                                                            <input type="text" name="end_time[sunday][]"
                                                                class="form-control timepicker day-sunday" value="11:00" />
                                                        </div>
                                                        <div class="col-md-3 mb-1">
                                                            <a class="btn btn-icon btn-primary add-time day-sunday"
                                                                href="#!" data-day="sunday" data-endtime="11:00"><i
                                                                    class="fas fa-plus"></i></a>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-switch mb-2">
                                                        <input type="checkbox" name="monday" class="form-check-input day"
                                                            id="monday" value="monday"
                                                            {{ old('monday') == 'monday' ? 'checked' : 'checked' }}>
                                                        <label class="form-check-label" for="monday">Monday</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-md-12 row day-monday">

                                                        <div class="col-md-4 mb-1">
                                                            <input type="text" name="start_time[monday][]"
                                                                class="form-control timepicker day-monday" value="10:00" />
                                                        </div>
                                                        <div class="col-md-4 mb-1">
                                                            <input type="text" name="end_time[monday][]"
                                                                class="form-control timepicker day-monday" value="11:00" />
                                                        </div>
                                                        <div class="col-md-3 mb-1">
                                                            <a class="btn btn-icon btn-primary add-time day-monday"
                                                                href="#!" data-day="monday" data-endtime="11:00"><i
                                                                    class="fas fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-switch mb-2">
                                                        <input type="checkbox" name="tuesday" class="form-check-input day"
                                                            id="tuesday" value="tuesday"
                                                            {{ old('tuesday') == 'tuesday' ? 'checked' : 'checked' }}>
                                                        <label class="form-check-label" for="tuesday">Tuesday</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-md-12 row day-tuesday">

                                                        <div class="col-md-4 mb-1">
                                                            <input type="text" name="start_time[tuesday][]"
                                                                class="form-control timepicker day-tuesday"
                                                                value="10:00" />
                                                        </div>
                                                        <div class="col-md-4 mb-1">
                                                            <input type="text" name="end_time[tuesday][]"
                                                                class="form-control timepicker day-tuesday"
                                                                value="11:00" />
                                                        </div>
                                                        <div class="col-md-3 mb-1">
                                                            <a class="btn btn-icon btn-primary add-time day-tuesday"
                                                                href="#!" data-day="tuesday" data-endtime="11:00"><i
                                                                    class="fas fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-switch mb-2">
                                                        <input type="checkbox" name="wednesday"
                                                            class="form-check-input day" id="wednesday" value="wednesday"
                                                            {{ old('wednesday') == 'wednesday' ? 'checked' : 'checked' }}>
                                                        <label class="form-check-label" for="wednesday">Wednesday</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-md-12 row day-wednesday">

                                                        <div class="col-md-4 mb-1">
                                                            <input type="text" name="start_time[wednesday][]"
                                                                class="form-control timepicker day-wednesday"
                                                                value="10:00" />
                                                        </div>
                                                        <div class="col-md-4 mb-1">
                                                            <input type="text" name="end_time[wednesday][]"
                                                                class="form-control timepicker day-wednesday"
                                                                value="11:00" />
                                                        </div>
                                                        <div class="col-md-3 mb-1">
                                                            <a class="btn btn-icon btn-primary add-time day-wednesday"
                                                                href="#!" data-day="wednesday"
                                                                data-endtime="11:00"><i class="fas fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-switch mb-2">
                                                        <input type="checkbox" name="thursday"
                                                            class="form-check-input day" id="thursday" value="thursday"
                                                            {{ old('thursday') == 'thursday' ? 'checked' : 'checked' }}>
                                                        <label class="form-check-label" for="thursday">Thursday</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-md-12 row day-thursday">

                                                        <div class="col-md-4 mb-1">
                                                            <input type="text" name="start_time[thursday][]"
                                                                class="form-control timepicker day-thursday"
                                                                value="10:00" />
                                                        </div>
                                                        <div class="col-md-4 mb-1">
                                                            <input type="text" name="end_time[thursday][]"
                                                                class="form-control timepicker day-thursday"
                                                                value="11:00" />
                                                        </div>
                                                        <div class="col-md-3 mb-1">
                                                            <a class="btn btn-icon btn-primary add-time day-thursday"
                                                                href="#!" data-day="thursday"
                                                                data-endtime="11:00"><i class="fas fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-switch mb-2">
                                                        <input type="checkbox" name="friday"
                                                            class="form-check-input day" id="friday" value="friday"
                                                            {{ old('friday') == 'friday' ? 'checked' : 'checked' }}>
                                                        <label class="form-check-label" for="friday">Friday</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-md-12 row day-friday">

                                                        <div class="col-md-4 mb-1">
                                                            <input type="text" name="start_time[friday][]"
                                                                class="form-control timepicker day-friday"
                                                                value="10:00" />
                                                        </div>
                                                        <div class="col-md-4 mb-1">
                                                            <input type="text" name="end_time[friday][]"
                                                                class="form-control timepicker day-friday"
                                                                value="11:00" />
                                                        </div>
                                                        <div class="col-md-3 mb-1">
                                                            <a class="btn btn-icon btn-primary add-time day-friday"
                                                                href="#!" data-day="friday" data-endtime="11:00"><i
                                                                    class="fas fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-switch mb-2">
                                                        <input type="checkbox" name="saturday"
                                                            class="form-check-input day" id="saturday" value="saturday"
                                                            {{ old('saturday') == 'saturday' ? 'checked' : 'checked' }}>
                                                        <label class="form-check-label" for="saturday">Saturday</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-md-12 row day-saturday">

                                                        <div class="col-md-4 mb-1">
                                                            <input type="text" name="start_time[saturday][]"
                                                                class="form-control timepicker day-saturday"
                                                                value="10:00" />
                                                        </div>
                                                        <div class="col-md-4 mb-1">
                                                            <input type="text" name="end_time[saturday][]"
                                                                class="form-control timepicker day-saturday"
                                                                value="11:00" />
                                                        </div>
                                                        <div class="col-md-3 mb-1">
                                                            <a class="btn btn-icon btn-primary add-time day-saturday"
                                                                href="#!" data-day="saturday"
                                                                data-endtime="11:00"><i class="fas fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="col-md-12 mb-3">

                                <button type="submit" name="submitButton"
                                    class="btn btn-primary btn-page-block-custom">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /FormValidation -->
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/block-ui/block-ui.js') }}"></script>
    <script src="{{ asset('assets/js/extended-ui-blockui.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>

    <script>
        const form = document.getElementById('form');

        const fv = FormValidation.formValidation(form, {
            fields: {
                title: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter title'
                        }
                    }
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    // Use this for enabling/changing valid/invalid class
                    // eleInvalidClass: '',
                    eleValidClass: '',
                    rowSelector: function(field, ele) {
                        // field is the field name & ele is the field element
                        switch (field) {
                            case 'end_time':
                                return '.col-md-4';
                            default:
                                return '.row';
                        }
                    }
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                // Submit the form when all fields are valid
                defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            },
            init: instance => {
                instance.on('plugins.message.placed', function(e) {
                    //* Move the error message out of the `input-group` element
                    if (e.element.parentElement.classList.contains('input-group')) {
                        // `e.field`: The field name
                        // `e.messageElement`: The message element
                        // `e.element`: The field element
                        e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                    }
                    //* Move the error message out of the `row` element for custom-options
                    if (e.element.parentElement.parentElement.classList.contains('custom-option')) {
                        e.element.closest('.row').insertAdjacentElement('afterend', e.messageElement);
                    }
                });
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            const addTimeButtons = document.querySelectorAll('.add-time');

            addTimeButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const endtime = button.dataset.endtime;
                    const date1 = new Date();
                    date1.setHours(parseInt(endtime.split(":")[0], 10));
                    date1.setMinutes(parseInt(endtime.split(":")[1], 10));
                    // date1.setHours(date1.getHours() + 1);
                    date1.setMinutes(date1.getMinutes() + $('#interval').val() ?? 60);
                    const hours = date1.getHours().toString().padStart(2, '0');
                    const minutes = date1.getMinutes().toString().padStart(2, '0');

                    const formattedTime = `${hours}:${minutes}`;
                    const html = `
                <div class="col-md-12 row">
                    <div class="col-md-4 mb-1">
                        <input type="text" name="start_time[${button.dataset.day}][]" class="form-control timepicker day-${button.dataset.day}" value="${endtime}"/>
                    </div>
                    <div class="col-md-4 mb-1">
                        <input type="text" name="end_time[${button.dataset.day}][]" class="form-control timepicker day-${button.dataset.day}" value="${formattedTime}"/>
                    </div>
                <div class="col-md-3 mb-1">
                    <a class="btn btn-icon btn-danger delete-time day-${button.dataset.day}" href="#!"><i class="fas fa-trash"></i></a>
                </div>
            </div>

            `;
                    button.parentElement.parentElement.parentElement.insertAdjacentHTML('beforeend',
                        html);
                    button.dataset.endtime = formattedTime;
                    initializeFlatpickr();
                });
            });

            $(document).on('click', '.delete-time', function(e) {
                $(this).parent().parent().remove();
            });
            $(document).on("change", ".day", function() {
                var value = $(this).val();

                var checked = this.checked;
                if (this.checked) {
                    $('.day-' + value).prop('disabled', false);
                    $('.day-' + value).removeClass('disabled');
                    $('.day-' + value).removeClass('d-none');
                } else {
                    $('.day-' + value).prop('disabled', true);
                    $('.day-' + value).addClass('disabled');
                    $('.day-' + value).addClass('d-none');
                }
            });
            $(document).ready(function() {
                $('.day').trigger('change');
                initializeFlatpickr();

            });
        });

        $(document).on('change', 'input[name^="start_time"]', function() {
            const startTime = this.value;
            const endTimeInput = this.parentElement.nextElementSibling.querySelector('input[name^="end_time"]');
            const endTime = endTimeInput.value;

            const date1 = new Date();
            date1.setHours(parseInt(startTime.split(":")[0], 10));
            date1.setMinutes(parseInt(startTime.split(":")[1], 10));

            const date2 = new Date();
            date2.setHours(parseInt(endTime.split(":")[0], 10));
            date2.setMinutes(parseInt(endTime.split(":")[1], 10));

            if (date1 > date2) {
                $(this).addClass('invalid');
                toastr.error(`${startTime} is after ${endTime}`);

            } else {
                $(this).removeClass('invalid');
            }
        });
        $(document).on('change', 'input[name^="end_time"]', function() {
            const endTime = this.value;
            const startTimeInput = this.parentElement.previousElementSibling.querySelector(
                'input[name^="start_time"]');
            const startTime = startTimeInput.value;

            const date1 = new Date();
            date1.setHours(parseInt(endTime.split(":")[0], 10));
            date1.setMinutes(parseInt(endTime.split(":")[1], 10));

            const date2 = new Date();
            date2.setHours(parseInt(startTime.split(":")[0], 10));
            date2.setMinutes(parseInt(startTime.split(":")[1], 10));

            if (date1 < date2) {
                $(this).addClass('invalid');
                toastr.error(`${endTime} is after ${startTime}`);
            } else {
                $(this).removeClass('invalid');
            }
            const classesList = $(this).attr('class').split(' ');
            const dayClasses = classesList.filter(className => className.startsWith('day-'));

            if (dayClasses.length > 0) {
                const addButton = $(this).closest('body').find('a.' + dayClasses[0]);
                addButton.attr("data-endtime", endTime);
            }

        });

        function initializeFlatpickr() {
            $('.timepicker').flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                maxTime: "23:59",
                altInput: true,
            });
        }
    </script>
@endpush
