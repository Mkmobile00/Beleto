@extends('admin.app')
@section('title', 'Logo Setting')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Logo Setting</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                Logo Setting
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @isset($websiteLogo)
                    {{ Form::open(['url' => route('websitelogo-setting.update', $websiteLogo->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                    @method('put')
                @else
                    {{ Form::open(['url' => route('websitelogo-setting.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Logo Setting</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="website_logo">Website Logo</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                              <a id="website_logo" data-input="thumbnail1" data-preview="holder" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                              </a>
                                            </span>
                                            <input id="thumbnail1" class="form-control" type="text" name="website_logo" value="{{old('website_logo', @$websiteLogo->website_logo)}}">
                                          </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;">

                                        @error('website_logo')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                        @isset($websiteLogo)
                                           <div class="col-md-4">
                                                <img src="{{asset(@$websiteLogo->website_logo)}}" alt="Img" class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                           </div>
                                        @endisset
                                    </div>

                                  

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="website_favicon">Website Favicon</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                              <a id="website_favicon" data-input="thumbnail11" data-preview="holder" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                              </a>
                                            </span>
                                            <input id="thumbnail11" class="form-control" type="text" name="website_favicon" value="{{old('website_favicon', @$websiteLogo->website_favicon)}}">
                                          </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;">

                                        @error('website_favicon')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror

                                        @isset($websiteLogo)
                                           <div class="col-md-4">
                                                <img src="{{asset(@$websiteLogo->website_favicon)}}" alt="Img" class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                           </div>
                                        @endisset
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
      $('#website_logo').filemanager('image');
      $('#website_favicon').filemanager('image');
      
    });
  </script>
    
@endpush
