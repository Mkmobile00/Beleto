{{-- <div class="card-body" >
    <div class="row">
        <div class="col-md-3">
            <select name="days" id="days" class="form-control movietype">
                <option value="">Select Type</option>
                @foreach ($videoType as $dataValue)
                    <option value="{{ $dataValue->value }}" {{@$type==$dataValue->value ? 'selected':''}}>{{ $dataValue->name }}</option>
                @endforeach
            </select>
        </div>
    </div> --}}
    <div id="movieTypeData">
        <table class="table table-striped table-valign-middle table-sm captionShow">
            <caption>{{ @$title }}</caption>
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Title</th>
                    <th>Poster</th>
                    <th>Type</th>
                    <th>View</th>
                </tr>
            </thead>
            <div>
                <tbody>
                    @foreach ($allMoviesData as $key => $data)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <a href="{{$data['path'] }}"
                                    target="_blank">{{ @$data['title'] }}</a>
                            </td>
                            <td>
                                <img src=" {{ @$data['poster'] }}" height="100px" alt="">
                            </td>
                            <td>
                                <span class="badge badge-success"> {{$data['type']}}</span>
                            </td>
                            <td>
                                <a href="{{route('getVideoPerformance',[$data['id'],$data['type']])}}" target="_blank">View</a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </div>
        </table>
        <tfoot class="text-right mt-2">
            <tr>
                <td colspan="9">
                    <ul class="pagination">
                        @foreach ($allMoviesData->links('pagination::bootstrap-4')->elements as $element)
                            @if (is_string($element))
                                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    <li
                                        class="page-item {{ $page == $allMoviesData->currentPage() ? 'active' : '' }}">
                                        <a class="page-link movie-type"
                                            href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                            @endif
                        @endforeach
                    </ul>
                </td>
            </tr>
        </tfoot>
    </div>
{{-- </div> --}}