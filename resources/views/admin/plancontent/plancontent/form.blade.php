@extends('admin.app')
@section('title', 'Plan Content')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Plan Content</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                Plan Content
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @isset($planContent)
                    {{ Form::open(['url' => route('plan-content.update', $planContent->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                    @method('put')
                @else
                    {{ Form::open(['url' => route('plan-content.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Plan Content</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="content">Premium content</label>

                                        <select name="content[]" id="content" class="form-control select2" multiple>
                                            @foreach ($movieCategory as $category)
                                            <option value="{{$category->value}}" @isset($planContent){{in_array($category->value,json_decode($planContent->content)) ? 'selected':''}}@endisset>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2" id="categoryField" hidden>
                                        
                                    </div>
                                    {{-- <div class="col-md-6 form-group mt-2">
                                        <label for="content">Premium content</label>

                                        <select name="content[]" id="content" class="form-control select2" multiple>
                                            @foreach ($movieCategory as $category)
                                                <option value="{{$category->id}}" @isset($planContent){{in_array($category->id,json_decode($planContent->content)) ? 'selected':''}}@endisset>{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> --}}

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="device">Device</label>
                                        <select name="device[]" id="device" class="form-control select2" multiple>
                                            @foreach ($devices as $device)
                                                <option value="{{$device->id}}" @isset($planContent){{in_array($device->id,json_decode($planContent->device)) ? 'selected':''}}@endisset>{{$device->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('device')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="size">No. of screens(Max)</label>
                                        <input type="number" name="size" id="size" class="form-control "
                                            value="{{ old('size',@$planContent->size) }}">
                                        @error('size')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="video_quality">Max video quality</label>
                                        <select name="video_quality[]" id="video_quality" class="form-control select2" multiple>
                                            @foreach ($videoQualitys as $videoQuality)
                                                <option value="{{$videoQuality->id}}" @isset($planContent){{in_array($videoQuality->id,json_decode($planContent->video_quality)) ? 'selected':''}}@endisset>{{$videoQuality->quality}}</option>
                                            @endforeach
                                        </select>
                                        @error('video_quality')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="audio_quality">Max audio quality</label>
                                        <select name="audio_quality[]" id="audio_quality" class="form-control select2" multiple>
                                            @foreach ($audios as $audio)
                                                <option value="{{$audio->id}}" @isset($planContent){{in_array($audio->id,json_decode($planContent->audio_quality)) ? 'selected':''}}@endisset>{{$audio->quality}}</option>
                                            @endforeach
                                        </select>
                                        @error('audio_quality')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                       
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="livetv">Live TV:</label>
                                        <input type="radio" value="1" name="livetv" {{@$planContent->livetv=='1' ? 'checked':''}}> Show
                                        <input type="radio" value="0" name="livetv" {{@$planContent->livetv=='0' ? 'checked':''}}> Hide
                                    </div>
                                    @error('livetv')
                                            <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="col-md-6 form-group mt-2">
                                       
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="addfree">Ad-free:</label>
                                        <input type="radio" value="1" name="addfree" {{@$planContent->addfree=='1' ? 'checked':''}}> Show
                                        <input type="radio" value="0" name="addfree" {{@$planContent->addfree=='0' ? 'checked':''}}> Hide
                                    </div>
                                    @error('addfree')
                                            <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="col-md-6 form-group mt-2">
                                       
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="download">Download:</label>
                                        <input type="checkbox" name="download" value="1" {{@$planContent->download=='1' ? 'checked':''}}> Yes
                                    </div>
                                    @error('download')
                                            <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    
                                    
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
        const categoryItem = (catItem=null,data = null) => {
            let html = `<label for="categoryitem">Movie Category</label>
                        <select name="categoryitem[]" id="categoryitem" class="form-control select2" multiple required>`;
            if (Array.isArray(data)) {
                data.forEach(category => {
                    html += `<option value="${category.id}" ${catItem.includes(category.id) ? 'selected' : ''}>${category.title}</option>`;
                });
            }
            html += `</select>
                    @error('categoryitem')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror`;
                    console.log('ddd',html);
            return html;
        };
        
        $(document).ready(function(){
          $('#logo').filemanager('image');
        });

        $(document).on('change', '#content', function () {
            let categoryValue = $(this).val();
            let categorydata = @json(@$planContent->categoryitem) ?? [];
            let movieCat=@json($movieCat) ?? [];
            if (Array.isArray(categoryValue) && categoryValue.includes('1')) {
                $('#categoryField').removeAttr('hidden');
                $('#categoryField').html(categoryItem(categorydata,movieCat));
                reloadSelect2();
            } else {
                $('#categoryField').attr('hidden', true);
                $('#categoryField').html('');
            }
        });
        @isset($planContent)
            $('#content').change();
        @endisset
      </script>
@endpush
