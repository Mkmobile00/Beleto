@extends('admin.app')
@section('title', 'System Setting ')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>System Setting</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                THEME OPTIONS
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @isset($systemSetting)
                    {{ Form::open(['url' => route('system-setting.update', $systemSetting->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                    @method('put')
                @else
                    {{ Form::open(['url' => route('system-setting.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">THEME OPTIONS</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="theme">Theme</label>
                                        <select name="theme" id="theme" class="form-control ">
                                            <option value="default" {{ old('theme',@$systemSetting->theme)=='default' ? 'selected':'' }}>default</option>
                                        </select>
                                        @error('theme')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- <div class="col-md-6 form-group mt-2">
                                        <label for="logo">Logo</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                              <a id="logo" data-input="thumbnail1" data-preview="holder" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                              </a>
                                            </span>
                                            <input id="thumbnail1" class="form-control" type="text" name="logo" value="{{old('logo', @$systemSetting->logo)}}">
                                          </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;">

                                        @error('logo')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                        @isset($systemSetting)
                                           <div class="col-md-4">
                                                <img src="{{asset(@$systemSetting->logo)}}" alt="Img" class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                           </div>
                                        @endisset
                                    </div> --}}


                                    <div class="col-md-6 form-group mt-2">
                                        <label for="purchase_code">Purchase Code</label>
                                        <input type="text" name="purchase_code" id="purchase_code" class="form-control "
                                            value="{{ old('purchase_code',@$systemSetting->purchase_code) }}">
                                        @error('purchase_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="time_zone">TimeZone</label>
                                        <select name="time_zone" id="time_zone" class="form-control select2">
                                            @foreach ($timeZone as $key=>$zone)
                                                <option value="{{$zone}}" {{(old('time_zone', @$systemSetting->time_zone) == @$zone ? 'selected' : '')}}>{{$key}}</option>
                                            @endforeach
                                        </select>
                                        Server Time: {{@$serverTime}}
                                        @error('time_zone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="site_name">Site Name</label>
                                        <input type="text" name="site_name" id="site_name" class="form-control "
                                            value="{{ old('site_name',@$systemSetting->site_name) }}">
                                        @error('site_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="site_url">Site URL</label>
                                        <input type="url" name="site_url" id="site_url" class="form-control "
                                            value="{{ old('site_url',@$systemSetting->site_url) }}">
                                        @error('site_url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="system_email">System Email</label>
                                        <input type="email" name="system_email" id="system_email" class="form-control "
                                            value="{{ old('system_email',@$systemSetting->system_email) }}">
                                        @error('system_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="bussiness_address">Business Address</label>
                                        <input type="text" name="bussiness_address" id="bussiness_address" class="form-control "
                                            value="{{ old('bussiness_address',@$systemSetting->bussiness_address) }}">
                                        @error('bussiness_address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="bussiness_phone">Business Phone</label>
                                        <input type="number" name="bussiness_phone" id="bussiness_phone" class="form-control " data-parsley-length="[10, 14]"
                                            value="{{ old('bussiness_phone',@$systemSetting->bussiness_phone) }}">
                                        @error('bussiness_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="contact_email">Contact Email</label>
                                        <input type="email" name="contact_email" id="contact_email" class="form-control "
                                            value="{{ old('contact_email',@$systemSetting->contact_email) }}">
                                        @error('contact_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <div class="col-md-6 form-group mt-2">
                                        <label for="fb_link">Fb Link</label>
                                        <input type="url" name="fb_link" id="fb_link" class="form-control "
                                            value="{{ old('fb_link',@$systemSetting->fb_link) }}">
                                        @error('fb_link')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="insta_link">Insta Link</label>
                                        <input type="url" name="insta_link" id="insta_link" class="form-control "
                                            value="{{ old('insta_link',@$systemSetting->insta_link) }}">
                                        @error('insta_link')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="twitter_link">Twitter Link</label>
                                        <input type="url" name="twitter_link" id="twitter_link" class="form-control "
                                            value="{{ old('twitter_link',@$systemSetting->twitter_link) }}">
                                        @error('twitter_link')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="youtube_link">Youtube Link</label>
                                        <input type="url" name="youtube_link" id="youtube_link" class="form-control "
                                            value="{{ old('youtube_link',@$systemSetting->youtube_link) }}">
                                        @error('youtube_link')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="android_link">Android Link</label>
                                        <input type="url" name="android_link" id="android_link" class="form-control "
                                            value="{{ old('android_link',@$systemSetting->android_link) }}">
                                        @error('android_link')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="apple_link">Apple Link</label>
                                        <input type="url" name="apple_link" id="apple_link" class="form-control "
                                            value="{{ old('apple_link',@$systemSetting->apple_link) }}">
                                        @error('apple_link')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="registration_enable">Registration Enable</label>
                                        <select name="registration_enable" id="registration_enable" class="form-control ">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}" {{ old('registration_enable') != null || @$systemSetting->registration_enable != null ? (old('registration_enable', @$systemSetting->registration_enable) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('registration_enable')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="frontend_login">Front-End Login</label>
                                        <select name="frontend_login" id="frontend_login" class="form-control ">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}"{{ old('frontend_login') != null || @$systemSetting->frontend_login != null ? (old('frontend_login', @$systemSetting->frontend_login) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('frontend_login')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="blog_enable">Blog Enable</label>
                                        <select name="blog_enable" id="blog_enable" class="form-control ">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}"{{ old('blog_enable') != null || @$systemSetting->blog_enable != null ? (old('blog_enable', @$systemSetting->blog_enable) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('blog_enable')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="show_country_to_main">Show Country To Main Menu</label>
                                        <select name="show_country_to_main" id="show_country_to_main" class="form-control ">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}" {{ old('show_country_to_main') != null || @$systemSetting->show_country_to_main != null ? (old('show_country_to_main', @$systemSetting->show_country_to_main) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('show_country_to_main')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="show_genre_to_main">Show Genre To Main Menu</label>
                                        <select name="show_genre_to_main" id="show_genre_to_main" class="form-control ">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}" {{ old('show_genre_to_main') != null || @$systemSetting->show_genre_to_main != null ? (old('show_genre_to_main', @$systemSetting->show_genre_to_main) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('show_genre_to_main')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="show_release_to_main">Show Release To Main Menu</label>
                                        <select name="show_release_to_main" id="show_release_to_main" class="form-control ">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}" {{ old('show_release_to_main') != null || @$systemSetting->show_release_to_main != null ? (old('show_release_to_main', @$systemSetting->show_release_to_main) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('show_release_to_main')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="show_contact_to_main">Show Contact To Main Menu</label>
                                        <select name="show_contact_to_main" id="show_contact_to_main" class="form-control ">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}" {{ old('show_contact_to_main') != null || @$systemSetting->show_contact_to_main != null ? (old('show_contact_to_main', @$systemSetting->show_contact_to_main) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('show_contact_to_main')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="show_contact_to_footer">Show Contact To Footer Menu</label>
                                        <select name="show_contact_to_footer" id="show_contact_to_footer" class="form-control ">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}" {{ old('show_contact_to_footer') != null || @$systemSetting->show_contact_to_footer != null ? (old('show_contact_to_footer', @$systemSetting->show_contact_to_footer) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('show_contact_to_footer')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="show_actordirwr_image_to_main">Show Actor,Director & Writer Image To Movie Page</label>
                                        <select name="show_actordirwr_image_to_main" id="show_actordirwr_image_to_main" class="form-control ">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}" {{ old('show_actordirwr_image_to_main') != null || @$systemSetting->show_actordirwr_image_to_main != null ? (old('show_actordirwr_image_to_main', @$systemSetting->show_actordirwr_image_to_main) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('show_actordirwr_image_to_main')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="show_azlist_to_main">Show AZ List To Main Menu</label>
                                        <select name="show_azlist_to_main" id="show_azlist_to_main" class="form-control ">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}" {{ old('show_azlist_to_main') != null || @$systemSetting->show_azlist_to_main != null ? (old('show_azlist_to_main', @$systemSetting->show_azlist_to_main) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('show_azlist_to_main')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="show_azlist_to_footer">Show AZ List To Footer Menu</label>
                                        <select name="show_azlist_to_footer" id="show_azlist_to_footer" class="form-control ">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}" {{ old('show_azlist_to_footer') != null || @$systemSetting->show_azlist_to_footer != null ? (old('show_azlist_to_footer', @$systemSetting->show_azlist_to_footer) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('show_azlist_to_footer')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="enable_movie_report">Enable Movie Report</label>
                                        <select name="enable_movie_report" id="enable_movie_report" class="form-control ">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}" {{ old('enable_movie_report') != null || @$systemSetting->enable_movie_report != null ? (old('enable_movie_report', @$systemSetting->enable_movie_report) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('enable_movie_report')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="movie_report_send_to">Movie Report Send To(Email)</label>
                                        <input type="email" name="movie_report_send_to" id="movie_report_send_to" class="form-control "
                                            value="{{ old('movie_report_send_to',@$systemSetting->movie_report_send_to) }}">
                                        @error('movie_report_send_to')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="movie_report_attention_text">Movie Report Attention Text</label>
                                        <textarea name="movie_report_attention_text" id="movie_report_attention_text" class="form-control " cols="30" rows="3">
                                            {{ old('movie_report_attention_text',@$systemSetting->movie_report_attention_text) }}
                                        </textarea>
                                        
                                        @error('movie_report_attention_text')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="enable_movie_request">Enable Movie Request</label>
                                        <select name="enable_movie_request" id="enable_movie_request" class="form-control ">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}" {{ old('enable_movie_request') != null || @$systemSetting->enable_movie_request != null ? (old('enable_movie_request', @$systemSetting->enable_movie_request) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('enable_movie_request')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="movie_request_send_to">Movie Request Send To(Email)</label>
                                        <input type="email" name="movie_request_send_to" id="movie_request_send_to" class="form-control "
                                            value="{{ old('movie_request_send_to',@$systemSetting->movie_request_send_to) }}">
                                        @error('movie_request_send_to')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="enable_google_captcha">Enable Google Recaptcha</label>
                                        <select name="enable_google_captcha" id="enable_google_captcha" class="form-control ">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}" {{ old('enable_google_captcha') != null || @$systemSetting->enable_google_captcha != null ? (old('enable_google_captcha', @$systemSetting->enable_google_captcha) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('enable_google_captcha')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="google_captcha_sitekey">Recaptcha Site Key</label>
                                        <input type="text" name="google_captcha_sitekey" id="google_captcha_sitekey" class="form-control "
                                            value="{{ old('google_captcha_sitekey',@$systemSetting->google_captcha_sitekey) }}">
                                        @error('google_captcha_sitekey')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="google_captcha_secretkey">Recaptcha Secret Key</label>
                                        <input type="text" name="google_captcha_secretkey" id="google_captcha_secretkey" class="form-control "
                                            value="{{ old('google_captcha_secretkey',@$systemSetting->google_captcha_secretkey) }}">
                                        @error('google_captcha_secretkey')
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

     <script>

        
        $(document).ready(function(){
          $('#logo').filemanager('image');
        });
      </script>
@endpush
