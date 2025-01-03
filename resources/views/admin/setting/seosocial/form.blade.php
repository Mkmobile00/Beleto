@extends('admin.app')
@section('title', 'SEO Configuration Management')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>SEO Configuration Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                SEO Configuration Management
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @isset($seoSocial)
                    {{ Form::open(['url' => route('seosocial-setting.update', $seoSocial->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                    @method('put')
                @else
                    {{ Form::open(['url' => route('seosocial-setting.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                @endisset
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">BASIC SEO</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="site_map">XML Sitemap URL(Sitemap.Xml):</label>
                                        <input type="url" name="site_map" id="site_map" class="form-control" value="{{old('site_map',@$seoSocial->site_map)}}">
                                        @error('site_map')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="author_name">Author Name</label>
                                        <input type="text" name="author_name" id="author_name" class="form-control" value="{{old('author_name',@$seoSocial->author_name)}}">
                                        @error('author_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="google_analytics_id">Google Analytics ID</label>
                                        <input type="text" name="google_analytics_id" id="google_analytics_id" class="form-control" value="{{old('google_analytics_id',@$seoSocial->google_analytics_id)}}">
                                        @error('google_analytics_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">HOME PAGE SEO</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="home_page_seo_title">SEO Title</label>
                                        <input type="text" name="home_page_seo_title" id="home_page_seo_title" class="form-control" value="{{old('home_page_seo_title',@$seoSocial->home_page_seo_title)}}">
                                        @error('home_page_seo_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="home_page_seo_keyword">SEO Keyword</label>
                                        <input type="text" name="home_page_seo_keyword" id="home_page_seo_keyword" class="form-control" value="{{old('home_page_seo_keyword',@$seoSocial->home_page_seo_keyword)}}">
                                        @error('home_page_seo_keyword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="home_page_seo_metadescription">SEO Meta Description</label>
                                        <textarea name="home_page_seo_metadescription" id="home_page_seo_metadescription" cols="30" rows="3" class="form-control">
                                            {{old('home_page_seo_metadescription',@$seoSocial->home_page_seo_metadescription)}}
                                        </textarea>
                                        @error('home_page_seo_metadescription')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">MOVIE PAGE SEO</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="movie_page_seo_title">SEO Title</label>
                                        <input type="text" name="movie_page_seo_title" id="movie_page_seo_title" class="form-control" value="{{old('movie_page_seo_title',@$seoSocial->movie_page_seo_title)}}">
                                        @error('movie_page_seo_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="movie_page_seo_keyword">SEO Keyword</label>
                                        <input type="text" name="movie_page_seo_keyword" id="movie_page_seo_keyword" class="form-control" value="{{old('movie_page_seo_keyword',@$seoSocial->movie_page_seo_keyword)}}">
                                        @error('movie_page_seo_keyword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="movie_page_seo_metadescription">SEO Meta Description</label>
                                        <textarea name="movie_page_seo_metadescription" id="movie_page_seo_metadescription" cols="30" rows="3" class="form-control">
                                            {{old('movie_page_seo_metadescription',@$seoSocial->movie_page_seo_metadescription)}}
                                        </textarea>
                                        @error('movie_page_seo_metadescription')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">TV SERIES PAGE SEO</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="tv_series_page_seo_title">SEO Title</label>
                                        <input type="text" name="tv_series_page_seo_title" id="tv_series_page_seo_title" class="form-control" value="{{old('tv_series_page_seo_title',@$seoSocial->tv_series_page_seo_title)}}">
                                        @error('tv_series_page_seo_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="tv_series_page_seo_keyword">SEO Keyword</label>
                                        <input type="text" name="tv_series_page_seo_keyword" id="tv_series_page_seo_keyword" class="form-control" value="{{old('tv_series_page_seo_keyword',@$seoSocial->tv_series_page_seo_keyword)}}">
                                        @error('tv_series_page_seo_keyword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="tv_series_page_seo_metadescription">SEO Meta Description</label>
                                        <textarea name="tv_series_page_seo_metadescription" id="tv_series_page_seo_metadescription" cols="30" rows="3" class="form-control">
                                            {{old('tv_series_page_seo_metadescription',@$seoSocial->tv_series_page_seo_metadescription)}}
                                        </textarea>
                                        @error('tv_series_page_seo_metadescription')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">LIVE TV PAGE SEO</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="live_tv_page_seo_title">SEO Title</label>
                                        <input type="text" name="live_tv_page_seo_title" id="live_tv_page_seo_title" class="form-control" value="{{old('live_tv_page_seo_title',@$seoSocial->live_tv_page_seo_title)}}">
                                        @error('live_tv_page_seo_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="live_tv_page_seo_keyword">SEO Keyword</label>
                                        <input type="text" name="live_tv_page_seo_keyword" id="live_tv_page_seo_keyword" class="form-control" value="{{old('live_tv_page_seo_keyword',@$seoSocial->live_tv_page_seo_keyword)}}">
                                        @error('live_tv_page_seo_keyword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="live_tv_page_seo_metadescription">SEO Meta Description</label>
                                        <textarea name="live_tv_page_seo_metadescription" id="live_tv_page_seo_metadescription" cols="30" rows="3" class="form-control">
                                            {{old('live_tv_page_seo_metadescription',@$seoSocial->live_tv_page_seo_metadescription)}}
                                        </textarea>
                                        @error('live_tv_page_seo_metadescription')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">BLOG PAGE SEO</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="blog_page_seo_title">SEO Title</label>
                                        <input type="text" name="blog_page_seo_title" id="blog_page_seo_title" class="form-control" value="{{old('blog_page_seo_title',@$seoSocial->blog_page_seo_title)}}">
                                        @error('blog_page_seo_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="blog_page_seo_keyword">SEO Keyword</label>
                                        <input type="text" name="blog_page_seo_keyword" id="blog_page_seo_keyword" class="form-control" value="{{old('blog_page_seo_keyword',@$seoSocial->blog_page_seo_keyword)}}">
                                        @error('blog_page_seo_keyword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="blog_page_seo_metadescription">SEO Meta Description</label>
                                        <textarea name="blog_page_seo_metadescription" id="blog_page_seo_metadescription" cols="30" rows="3" class="form-control">
                                            {{old('blog_page_seo_metadescription',@$seoSocial->blog_page_seo_metadescription)}}
                                        </textarea>
                                        @error('blog_page_seo_metadescription')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">SOCIAL SETTING</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="social_share_ad">Social Share(Add This)</label>
                                        <select name="social_share_ad" id="social_share_ad" class="form-control">
                                            @foreach (formStatus() as $status)
                                                <option value="{{$status['value']}}" {{ old('social_share_ad') != null || @$seoSocial->social_share_ad != null ? (old('social_share_ad', @$seoSocial->social_share_ad) == $status['value'] ? 'selected' : '') : '' }}>{{$status['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('social_share_ad')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="fb_url">Facebook URL</label>
                                        <input type="url" name="fb_url" id="fb_url" class="form-control" value="{{old('fb_url',@$seoSocial->fb_url)}}">
                                        @error('fb_url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="twitter_url">Twitter URL</label>
                                        <input type="url" name="twitter_url" id="twitter_url" class="form-control" value="{{old('twitter_url',@$seoSocial->twitter_url)}}">
                                        @error('twitter_url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="linkedin_url">Linkedin URL</label>
                                        <input type="url" name="linkedin_url" id="linkedin_url" class="form-control" value="{{old('linkedin_url',@$seoSocial->linkedin_url)}}">
                                        @error('linkedin_url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="vimeo_url">Vimeo URL</label>
                                        <input type="url" name="vimeo_url" id="vimeo_url" class="form-control" value="{{old('vimeo_url',@$seoSocial->vimeo_url)}}">
                                        @error('vimeo_url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="youtube_url">Youtube URL</label>
                                        <input type="url" name="youtube_url" id="youtube_url" class="form-control" value="{{old('youtube_url',@$seoSocial->youtube_url)}}">
                                        @error('youtube_url')
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
