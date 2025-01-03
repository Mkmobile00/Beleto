<div class="card-body table-responsive p-0" id="nav-tabContent">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>SN</th>
                <th>Title</th>
                <th>Poster</th>
                <th>Video</th>
                <th>Watch Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($viewData as $key=>$data)

                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{ @$data['title']}}</td>
                    <td>
                        <img src="{{ @$data['poster'] }}" alt="" height="100px">
                    </td>
                    <td>
                        @if(@$data['video_path'])
                        <a href="{{ @$data['video_path'] }}" target="_blank">View</a>
                        @endif
                    </td>
                    <td>{{ @$data['date'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$viewData->links()}}
</div>