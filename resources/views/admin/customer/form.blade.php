@extends('admin.app')
@section('title', isset($customer) ? 'Update Customer' : 'Add Customer')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{@$customer ? 'Update' : 'Add'}} Customer</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                {{@$customer ? 'Update' : 'Add'}} Customer
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        {{-- @dd($customer->customerDetail) --}}
        <section class="content">
            <div class="container-fluid">
                @isset($customer)
                {{ Form::open(['url' => route('customer.update', $customer->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                @method('patch')
                @else
                {{ Form::open(['url' => route('customer.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                @method('post')
                @endisset
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Customer Details</h3>
                            </div>
                            <div class="card-body">
                                {{-- @dd($customer->customerDetail) --}}
                                <div class="row">
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="first_name">First Name</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control" value="{{old('first_name',@$customer->customerDetail->first_name)}}" required>
                                        @error('first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" value="{{old('last_name',@$customer->customerDetail->last_name)}}" required>
                                        @error('last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                   

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" >
                                            @foreach ($stataus as $statusData)
                                                <option value="{{$statusData->value}}" {{ @$customer->status->value==$statusData->value ? 'selected':''}}>{{$statusData->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control" >
                                            @foreach ($gender as $genderData)
                                                <option value="{{$genderData->value}}" {{ @$customer->customerDetail->gender->value==$genderData->value ? 'selected':''}}>{{$genderData->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="date_of_birth">DOB</label>
                                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{old('date_of_birth',@$date)}}">
                                        @error('date_of_birth')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2" id="imageFile">
                                        <label for="image" class="form-label">Icon Image:</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail11" data-preview="holder"
                                                    class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                </a>
                                            </span>
                                            <input id="thumbnail11" class="form-control" type="text" name="photo"
                                                value="{{ old('photo', @$customer->customerDetail->photo) }}">
                                        </div>
                                        <img id="holder" style="margin-top:15px;max-height:100px;" src="{{@$customer->customerDetail->photo_from =='mobile' ? asset('Uploads/customer/' . @$customer->customerDetail->photo) : @$customer->customerDetail->photo}}">
                                        @error('photo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{old('email',@$customer->email)}}" required {{@$customer ? 'disabled':''}}>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="phone">Phone</label>
                                        <input type="phone" name="phone" id="phone" class="form-control" value="{{old('phone',@$customer->phone)}}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    @isset($customer)
                                    @else
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" value="{{old('password',@$customer->password)}}" required>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="password_confirmation">Password Confirmation</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="{{old('password_confirmation',@$customer->password_confirmation)}}" required>
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @endisset
                                    
                                </div>
                                   
                                    
                                    <div class="card-footer">
                                        <button type="submit"
                                            class="btn btn-primary">
                                            @isset($customer)
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
    const replaceImageData = () => {
    let html = '';
    html += '<div class="col-md-12" id="imageFile">';
    html += '<label for="image" class="form-label">Icon Image:</label>';
    html += '<div class="input-group">';
    html += '<span class="input-group-btn">';
    html += '<a id="lfm" data-input="thumbnail11" data-preview="holder" class="btn btn-primary"><i class="fa fa-picture-o"></i> Choose</a>';
    html += '</span>';
    html += '<input id="thumbnail11" required class="form-control" type="text" name="icon" value="{{ old("thumbnail", @$data->icon) }}">';
    html += '</div>';
    html += '</div>';
    return html;
};
const replaceFileData = () => {
    let file= '';
    file+= '<div class="col-md-12" id="imageFile">';
    file+= '<label for="image" class="form-label">Link:</label>';
    file+= '<div class="input-group">';
    file+= '<input id="thumbnail11" required class="form-control" type="url" name="icon" value="{{ old("icon", @$data->icon) }}">';
    file+= '</div>';
    file+= '</div>';
    return file;
};
    $(document).ready(function () {
        CKEDITOR.replace('description');
        $('#lfm').filemanager('image');

        $(document).on('click', '#thumb_link', function () {
            $('#imageFile').replaceWith(replaceFileData('link'));
            $('#file_type').val('0');
        });

        $(document).on('click', '#thumb_file', function () {
            $('#imageFile').replaceWith(replaceImageData('image'));
            $('#file_type').val('1');
            $('#lfm').filemanager('image');
        });
    });
</script>
    
@endpush
