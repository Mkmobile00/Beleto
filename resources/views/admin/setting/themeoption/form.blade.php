@extends('admin.app')
@section('title', 'Theme Option ')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Theme Options</h1>
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
                @isset($themeOption)
                    {{ Form::open(['url' => route('theme-option.update', $themeOption->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                    @method('put')
                @else
                    {{ Form::open(['url' => route('theme-option.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Theme Options</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="website_preloader">Website Preloader</label>
                                        <select name="website_preloader" id="website_preloader" class="form-control ">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}" {{ old('website_preloader') != null || @$themeOption->website_preloader != null ? (old('website_preloader', @$themeOption->website_preloader) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('website_preloader')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="dark_theme_enable">Dark Theme Enable</label>
                                        <select name="dark_theme_enable" id="dark_theme_enable" class="form-control ">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}" {{ old('dark_theme_enable') != null || @$themeOption->dark_theme_enable != null ? (old('dark_theme_enable', @$themeOption->dark_theme_enable) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('dark_theme_enable')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="website_background_enable">Website Background Image</label>
                                        <select name="website_background_enable" id="website_background_enable" class="form-control ">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}" {{ old('website_background_enable') != null || @$themeOption->website_background_enable != null ? (old('website_background_enable', @$themeOption->website_background_enable) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('website_background_enable')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                   

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="website_background_image">Website Background Image</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                              <a id="website_background_image" data-input="thumbnail1" data-preview="holder" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                              </a>
                                            </span>
                                            <input id="thumbnail1" class="form-control" type="text" name="website_background_image" value="{{old('website_background_image', @$themeOption->website_background_image)}}">
                                          </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;">

                                        @error('website_background_image')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                        @isset($themeOption)
                                           <div class="col-md-4">
                                                <img src="{{asset(@$themeOption->website_background_image)}}" alt="Img" class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                           </div>
                                        @endisset
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="landing_page_search">Landing Page With Search</label>
                                        <select name="landing_page_search" id="landing_page_search" class="form-control ">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}" {{ old('landing_page_search') != null || @$themeOption->landing_page_search != null ? (old('landing_page_search', @$themeOption->landing_page_search) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('landing_page_search')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="landing_page_image">Landing Page Image</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                              <a id="landing_page_image" data-input="thumbnail12" data-preview="holder" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                              </a>
                                            </span>
                                            <input id="thumbnail12" class="form-control" type="text" name="landing_page_image" value="{{old('landing_page_image', @$themeOption->landing_page_image)}}">
                                          </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;">

                                        @error('landing_page_image')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                        @isset($themeOption)
                                           <div class="col-md-4">
                                                <img src="{{asset(@$themeOption->landing_page_image)}}" alt="Img" class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                           </div>
                                        @endisset
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="frontend_theme_color">Front End Theme Color</label>
                                        <select name="frontend_theme_color" id="frontend_theme_color" class="form-control ">
                                            @foreach ($themeColors as $color)
                                                <option value="{{$color['value']}}" {{ old('frontend_theme_color') != null || @$themeOption->frontend_theme_color != null ? (old('frontend_theme_color', @$themeOption->frontend_theme_color) == $color['value'] ? 'selected' : '') : '' }}>{{$color['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('frontend_theme_color')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="header_template">Header Template</label>
                                        <select name="header_template" id="header_template" class="form-control ">
                                            @foreach ($headerTemplate as $template)
                                                <option value="{{$template['value']}}" {{ old('header_template') != null || @$themeOption->header_template != null ? (old('header_template', @$themeOption->header_template) == $template['value'] ? 'selected' : '') : '' }}>{{$template['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('header_template')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="footer_template">Footer Template</label>
                                        <select name="footer_template" id="footer_template" class="form-control ">
                                            @foreach ($footerTemplates as $ftemplate)
                                                <option value="{{$ftemplate['value']}}" {{ old('footer_template') != null || @$themeOption->footer_template != null ? (old('footer_template', @$themeOption->footer_template) == $ftemplate['value'] ? 'selected' : '') : '' }}>{{$ftemplate['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('footer_template')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="google_map_api">Google Map API</label>
                                        <input type="text" name="google_map_api" id="google_map_api" class="form-control" value="{{old('google_map_api',@$themeOption->google_map_api)}}">
                                        @error('google_map_api')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="google_map_lat">Google Map Lat</label>
                                        <input type="text" name="google_map_lat" id="google_map_lat" class="form-control" value="{{old('google_map_lat',@$themeOption->google_map_lat)}}">
                                        @error('google_map_lat')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="google_map_lang">Google Map Lang</label>
                                        <input type="text" name="google_map_lang" id="google_map_lang" class="form-control" value="{{old('google_map_lang',@$themeOption->google_map_lang)}}">
                                        @error('google_map_lang')
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
          $('#website_background_image').filemanager('image');
          $('#landing_page_image').filemanager('image');
          
        });
</script>
    
@endpush
