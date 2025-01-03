@extends('admin.app')
@section('title', 'Add Push Notitfication')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Push Notitfication</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                Add Push Notitfication
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @isset($pushnotification)
                {{ Form::open(['url' => route('pushnotification.update', $pushnotification->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                @method('patch')
                @else
                {{ Form::open(['url' => route('pushnotification.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                @method('post')
                @endisset
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Notification Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{old('title',@$pushnotification->title)}}" required>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="url">Url</label>
                                        <input type="url" name="url" id="url" class="form-control" value="{{old('url',@$pushnotification->url)}}">
                                        @error('url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="summary">Summary</label>
                                        <textarea name="summary" id="summary" class="form-control" cols="30" rows="10">{{old('summary',@$pushnotification->summary)}}</textarea>
                                        @error('summary')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{old('description',@$pushnotification->description)}}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="image">Image</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail1" data-preview="holder"
                                                    class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                </a>
                                            </span>
                                            <input id="thumbnail1" class="form-control" type="text" name="image"
                                                value="{{ old('image', @$pushnotification->image) }}">
                                        </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;">

                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                        @isset($slider)
                                            <div class="col-md-4">
                                                <img src="{{ asset(@$slider->image) }}" alt="Img"
                                                    class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
                                            </div>
                                        @endisset
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" >
                                            @foreach ($notification_status as $status)
                                            <option value="{{$status->value}}" {{ @$pushnotification->status=='1' ? 'selected':''}}>{{$status->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2 customerList">
                                        <label for="for">User</label>
                                        <select name="for" id="for" class="form-control" value="{{old('for',@$pushnotification->for)}}" required>
                                            @foreach ($userTypes as $type)
                                            <option value="{{$type->value}}" {{ @$pushnotification->for->value==$type->value ? 'selected':''}}>{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('for')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2 customerListData" @isset($pushnotification) {{@$pushnotification->for->value=='2' ? '':'hidden'}} @else hidden @endisset>
                                        <label for="selected_id">Customer</label>
                                        <select name="selected_id[]" id="selected_id" class="form-control select2" multiple value="{{old('selected_id',@$pushnotification->selected_id)}}">
                                            @foreach ($customers as $customer)
                                            <option value="{{$customer['id']}}"  @isset($pushnotification) {{in_array($customer['id'],$pushnotification->customer->pluck('customer_id')->toArray()) ? 'selected':''}}  @endisset>{{$customer['name']}}</option>
                                            @endforeach
                                        </select>
                                        @error('selected_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                   
                                    <div class="card-footer">
                                        <button type="submit"
                                            class="btn btn-primary">
                                            @isset($pushnotification)
                                                Update
                                            @else
                                                Add
                                            @endisset
                                        </button>
                                    </div>

                                </div>
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        // CKEDITOR.replace('summary');
        // CKEDITOR.replace('description');
        $('#lfm').filemanager('image');
    });

    $(document).on('change','#for',function(){
        let type=$(this).val();
        if(type==2){
            $('.customerListData').removeAttr('hidden');
            $('#selected_id').attr('required',true);
        }else{
            $('.customerListData').attr('hidden',true);
            $('#selected_id').removeAttr('required');
        }
    });
</script>
    
@endpush
