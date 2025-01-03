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
                                placeholder="Enter Total Shows For Per Day" oninput="setShowsCount(this)" required />
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
                            <a href="javascript:;" style="border-radius:50%" data-showDatesId="{{ @$date['id'] }}"
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
