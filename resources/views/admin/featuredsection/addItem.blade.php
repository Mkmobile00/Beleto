@extends('admin.app')
@section('title', 'Add Featured Section')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Featured Section</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                Add Featured Section
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
              
                {{ Form::open(['url' => route('featuredsection.addItemStore'), 'files' => true, 'class' => 'form form-horizontal']) }}
                @method('post')
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Featured Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 form-group mt-2">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{old('title',@$featuredsection->title)}}" required readonly>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <input type="number" hidden value="{{$featuredsection->id}}" name="featured_id">
                                    <div class="col-md-4 form-group mt-2">
                                        <label for="title">Items</label>
                                        <select name="item_id[]" id="item_id" class="form-control select2" multiple required>
                                            @foreach ($items as $item)
                                                <option value="{{$item->id}}" {{ in_array($item->id,$featuredsection->items->pluck('item_id')->toArray()) ? 'selected':''}}>{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    

                                    
                                </div>
                                   
                                    
                                    <div class="card-footer">
                                        <button type="submit"
                                            class="btn btn-primary">
                                            @isset($featuredsection)
                                                Update
                                            @else
                                                Add
                                            @endisset
                                        </button>
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
        CKEDITOR.replace('meta_description');
        $('#lfm').filemanager('image');
    });
</script>
    
@endpush
