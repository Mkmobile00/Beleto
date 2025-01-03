@extends('admin.app')
@section('title', 'Android Setting')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Android Setting</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                Android Setting
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @isset($androidSetting)
                    {{ Form::open(['url' => route('android-setting.update', $androidSetting->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                    @method('put')
                @else
                    {{ Form::open(['url' => route('android-setting.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Android Setting</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="android_nav_menu">Website Preloader</label>
                                        <select name="android_nav_menu" id="android_nav_menu" class="form-control ">
                                            @foreach ($preLoaders as $loader)
                                                <option value="{{$loader['value']}}" {{ old('android_nav_menu') != null || @$androidSetting->android_nav_menu != null ? (old('android_nav_menu', @$androidSetting->android_nav_menu) == $loader['value'] ? 'selected' : '') : '' }}>{{$loader['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('android_nav_menu')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="android_mendatory_login">Android Mandatory Login</label>
                                        <select name="android_mendatory_login" id="android_mendatory_login" class="form-control ">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}" {{ old('android_mendatory_login') != null || @$androidSetting->android_mendatory_login != null ? (old('android_mendatory_login', @$androidSetting->android_mendatory_login) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('android_mendatory_login')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="android_genre_display">Android Display Genre On App Home</label>
                                        <select name="android_genre_display" id="android_genre_display" class="form-control ">
                                            @foreach ($confirmations as $confirmed)
                                                <option value="{{$confirmed['value']}}" {{ old('android_genre_display') != null || @$androidSetting->android_genre_display != null ? (old('android_genre_display', @$androidSetting->android_genre_display) == $confirmed['value'] ? 'selected' : '') : '' }}>{{$confirmed['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('android_genre_display')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="android_genre_country">Android Display Country On App Home</label>
                                        <select name="android_genre_country" id="android_genre_country" class="form-control ">
                                            @foreach ($confirmations as $confirmed)
                                                <option value="{{$confirmed['value']}}" {{ old('android_genre_country') != null || @$androidSetting->android_genre_country != null ? (old('android_genre_country', @$androidSetting->android_genre_country) == $confirmed['value'] ? 'selected' : '') : '' }}>{{$confirmed['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('android_genre_country')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="app_version">Latest Apk Version Name</label>
                                        <input type="text" name="app_version" id="app_version" class="form-control" value="{{old('app_version',@$androidSetting->app_version)}}">
                                        
                                        @error('app_version')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="app_version_code">Latest Apk Version Code</label>
                                        <input type="number" name="app_version_code" id="app_version_code" class="form-control" value="{{old('app_version_code',@$androidSetting->app_version_code)}}">
                                        @error('app_version_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="app_file_url">Apk File URL</label>
                                        <input type="url" name="app_file_url" id="app_file_url" class="form-control" value="{{old('app_file_url',@$androidSetting->app_file_url)}}">
                                        @error('app_file_url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="whats_on_apk">What's New On Latest Apk</label>
                                        <textarea  name="whats_on_apk" id="whats_on_apk" class="form-control" cols="30" rows="2">
                                            {{old('whats_on_apk',@$androidSetting->whats_on_apk)}}
                                        </textarea>
                                        @error('whats_on_apk')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{-- @dd(@$androidSetting->update_skipable) --}}
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="update_skipable">Update Skipable?</label>
                                        <select name="update_skipable" id="update_skipable" class="form-control ">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}" {{ old('update_skipable') != null || @$androidSetting->update_skipable != null ? (old('update_skipable', @$androidSetting->update_skipable) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('update_skipable')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    
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


    
@endpush
