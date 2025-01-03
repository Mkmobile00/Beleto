@extends('admin.app')
@section('title', 'Plan ')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Plan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                PLAN OPTIONS
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @isset($plan)
                    {{ Form::open(['url' => route('plan.update', $plan->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                    @method('put')
                @else
                    {{ Form::open(['url' => route('plan.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">PLAN OPTIONS</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="title">Package Title</label>
                                        <input type="text" class="form-control" id="title1" name="title" value="{{old('title',@$plan->title)}}" required>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="device">Device</label>
                                        <select name="device[]" id="device" class="form-control select2" multiple >
                                            @isset($plan)
                                                @if(json_decode($plan->device) !=null)
                                                @foreach ($devices as $device)
                                                    <option value="{{$device->id}}" @isset($plan) {{in_array($device->id,json_decode($plan->device)) ? 'selected':''}} @endisset>{{$device->title}}</option>
                                                @endforeach
                                                @else
                                                @foreach ($devices as $device)
                                                    <option value="{{$device->id}}" >{{$device->title}}</option>
                                                @endforeach
                                                @endif
                                            @else
                                            @foreach ($devices as $device)
                                            <option value="{{$device->id}}" >{{$device->title}}</option>
                                        @endforeach
                                            @endisset
                                            
                                        </select>
                                        @error('device')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="screensize">No. of screens(Max)</label>
                                        <input type="number" id="screensize1" class="form-control" name="screensize" value="{{old('screensize',@$plan->screensize)}}" min="1" max="{{@$maxScreenSize}}"> 
                                        @error('screensize')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="videoquality">Max video quality</label>
                                        <select name="video_quality[]" id="video_quality" class="form-control select2" multiple required>
                                            @foreach ($videoQualitys as $videoQuality)
                                                <option value="{{$videoQuality->id}}" @isset($plan) {{in_array($videoQuality->id,json_decode($plan->video_quality)) ? 'selected':''}} @endisset>{{$videoQuality->quality}}</option>
                                            @endforeach
                                        </select>
                                        @error('videoquality')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="audioquality">Max audio quality</label>
                                        <select name="audio_quality[]" id="audio_quality" class="form-control select2" multiple required>
                                            @foreach ($audios as $audio)
                                                <option value="{{$audio->id}}" @isset($plan) {{in_array($audio->id,json_decode($plan->audio_quality)) ? 'selected':''}} @endisset>{{$audio->quality}}</option>
                                            @endforeach
                                        </select>
                                        @error('audioquality')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="active" {{@$plan->status=='active' ? 'selected':''}}>Active</option>
                                            <option value="inactive" {{@$plan->status=='inactive' ? 'selected':''}}>In Active</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="premium_content">Premium content</label>
                                        <input type="radio" id="premium_content1" name="premium_content" value="1"  {{@$plan->premium_content=='1' ? 'checked':''}}> Yes
                                        <input type="radio" id="premium_content2" name="premium_content" value="0"  {{@$plan->premium_content=='0' ? 'checked':''}}> No
                                        @error('premium_content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    @if($liveTvStatus)
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="livetv">Live TV</label>
                                        <input type="radio" id="livetv1" name="livetv" value="1"  {{@$plan->livetv=='1' ? 'checked':''}}> Yes
                                        <input type="radio" id="livetv2" name="livetv" value="0"  {{@$plan->livetv=='0' ? 'checked':''}}> No
                                        @error('livetv')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> 
                                    @endif

                                    @if($addFreeStatus)
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="addfree">Ad-free</label>
                                        <input type="radio" id="addfree1" name="addfree" value="1" {{@$plan->addfree=='1' ? 'checked':''}}> Yes
                                        <input type="radio" id="addfree2" name="addfree" value="0" {{@$plan->addfree=='0' ? 'checked':''}}> No
                                        @error('addfree')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @endif

                                    @if($downloadStatus)
                                    <div class="col-md-12 form-group mt-2">
                                        <label for="download">Download</label>
                                        <input type="radio" id="download1" name="download" value="1" {{@$plan->download=='1' ? 'checked':''}}> Yes
                                        <input type="radio" id="download2" name="download" value="0" {{@$plan->download=='0' ? 'checked':''}}> No
                                        @error('download')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> 
                                    @endif

                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit"
                        class="btn btn-primary">Save Changes</button>
                </div>
                </form>

            </div>
        </section>
    </div>

</div>
@endsection

@push('scripts')

     <script>

        
        $(document).ready(function(){
          $('#logo').filemanager('image');
        });
      </script>
@endpush
