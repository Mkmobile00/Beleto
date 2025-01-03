<div class="modal-content" id="formHtmlAppend">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Theater Setup</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="javascript:;" method="post" id="timeSlotForm">
        @csrf
        <div class="modal-body">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item mr-4" role="presentation">
                    <button class="nav-link active link1" id="pills-home-tab" data-toggle="pill" data-target="#pills-home"
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true">Theater Date
                        SetUp</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link link2" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Theater Date
                        Edit</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active datesViewHide" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row">
                        {{-- <div class="col-md-12 mb-4">
                            <label for="shows_number">Select Movie</label>
                            <select name="movie_id" id="movie_id" class="form-control select2" required>
                                @foreach ($movies as $movie)
                                    <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" hidden id="movie_idError"></span>
                        </div> --}}

                        <div class="col-md-12 mb-4">
                            <label for="shows_number">Select Show Date</label>
                            <input name='date_range' class="form-control" id='cal' required readonly
                                data-toggle="tooltip" data-placement="top" title="Select a date range" />
                            <span class="text-danger" hidden id="date_rangeError"></span>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label for="shows_number">Total Shows</label>
                            <input name='shows_number' type="number" class="form-control" id='shows_number'
                                placeholder="Enter Total Shows For Per Day" oninput="setShowsCount(this)" required />
                            <span class="text-danger" hidden id="shows_numberError"></span>
                        </div>

                        <div class="col-md-12 mb-4">
                            <label for="shows_number">Set Time</label>
                            <div id="timeZoneHtml">

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="setShowsForm">Save changes</button>
                    </div>
    </form>
</div>

<div class="tab-pane fade datesViewShow" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    {{-- @isset($moviesData)
        @foreach ($moviesData as $mData)
            <span class="badge badge-success">{{ @$mData['movie'] }}</span>
            <br>
            @if (count($mData['dates']) > 0)
                @foreach ($mData['dates'] as $date)
                    <span class="badge badge-danger">{{ @$date['show_date'] }}</span>
                    <a href="javascript:;" data-dateId="{{ @$date['id'] }}" data-theaterid="{{ @$mData['movie_theater_id'] }}" style="border-radius:50%"
                        class="btn btn-sm btn-danger btn-style icon btn-rounded delete-date">
                        <i class="fas fa-trash"></i>
                    </a>
                    <br>
                    @foreach ($date['timeSlot'] as $timeSlot)
                        <span class="badge badge-info">{{ @$timeSlot['start_time'] }}</span>
                        <span class="badge badge-info">{{ @$timeSlot['end_time'] }}</span>
                        <input type="time" name="start_time_update" value="{{ @$timeSlot['start_value'] }}" class="start-time-update">
                        <input type="time" name="end_time_update" value="{{ @$timeSlot['end_value'] }}" class="end-time-update">
                        <a href="javascript:;" data-dateId="{{ @$date['id'] }}" data-theaterid="{{ @$mData['movie_theater_id'] }}" data-fieldId="{{ $date['id'] }}" style="border-radius:50%"
                            class="btn btn-sm btn-primary btn-style icon btn-rounded update-time">
                            <i class="fas fa-edit"></i>
                        </a>
                        <br>
                    @endforeach

                    <br>
                @endforeach
            @endif
            <hr>
        @endforeach
    @endisset --}}
</div>
</div>
</div>


</div>

