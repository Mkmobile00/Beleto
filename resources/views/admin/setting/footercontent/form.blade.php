@extends('admin.app')
@section('title', 'Footer Content Management')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Footer Content Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                Footer Content Management
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @isset($footerContent)
                    {{ Form::open(['url' => route('footer-setting.update', $footerContent->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                    @method('put')
                @else
                    {{ Form::open(['url' => route('footer-setting.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Footer Content Management</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="footer_title1">Footer-1 Title</label>
                                        <input type="text" name="footer_title1" id="footer_title1" class="form-control" value="{{old('footer_title1',@$footerContent->footer_title1)}}">
                                        @error('footer_title1')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="footer_content1">Footer-1 Content</label>
                                        <textarea name="footer_content1" id="footer_content1" class="form-control" cols="30" rows="10">
                                            {{old('footer_content1',@$footerContent->footer_content1)}}
                                        </textarea>
                                        @error('footer_content1')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="footer_title2">Footer-2 Title</label>
                                        <input type="text" name="footer_title2" id="footer_title2" class="form-control" value="{{old('footer_title2',@$footerContent->footer_title2)}}">
                                        @error('footer_title2')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="footer_content2">Footer-2 Content</label>
                                        <textarea name="footer_content2" id="footer_content2" class="form-control" cols="30" rows="10">
                                            {{old('footer_content2',@$footerContent->footer_content2)}}
                                        </textarea>
                                        @error('footer_content2')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="footer_title3">Footer-3 Title</label>
                                        <input type="text" name="footer_title3" id="footer_title3" class="form-control" value="{{old('footer_title3',@$footerContent->footer_title3)}}">
                                        @error('footer_title3')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="footer_content3">Footer-3 Content</label>
                                        <textarea name="footer_content3" id="footer_content3" class="form-control" cols="30" rows="10">
                                            {{old('footer_content3',@$footerContent->footer_content3)}}
                                        </textarea>
                                        @error('footer_content3')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 form-group mt-2">
                                        <label for="copyright">Copyright</label>
                                        <textarea name="copyright" id="copyright" class="form-control" cols="30" rows="10">
                                            {{old('copyright',@$footerContent->copyright)}}
                                        </textarea>
                                        @error('copyright')
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
    CKEDITOR.replace('footer_content1');
    CKEDITOR.replace('footer_content2');
    CKEDITOR.replace('footer_content3');
    CKEDITOR.replace('copyright');
   
</script>

    
@endpush
