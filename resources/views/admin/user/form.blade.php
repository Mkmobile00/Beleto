@extends('admin.app')
@section('title', 'Add User')
@push('styles')
    <style>
        .map-search-modal-all {
            height: 40px;
            position: absolute;
            left: 12px !important;
            top: 0;
            box-sizing: border-box;
            border: 1px solid transparent;
            width: 98%;
            margin-top: 10px;
            padding: 10px 12px;
            box-shadow: rgba(0, 0, 0, .3) 0 2px 6px;
            font-size: 16px;
            outline: none;
            text-overflow: ellipsis;
            border-radius: 3px;
            z-index: 12;
            background-color: rgb(255, 255, 255)
        }

        .search-suggestions {
            position: absolute;
            width: 95.5%;
            max-height: 150px;
            overflow-y: auto;
            background-color: #ffffffba;
            border: 1px solid #ccc;
            z-index: 1000;
            left: 26px;
            margin-top: 49px;
        }

        .suggestion {
            padding: 8px;
            cursor: pointer
        }

        .suggestion:hover {
            background-color: #f5f5f5
        }

        .locate-me-btn {
            color: #000000cf;
            font-weight: 700;
            border-color: #555;
            position: absolute;
            bottom: 17%;
            right: 6%;
            font-size: 21px;
            background: #e9ecef96;
            border-radius: 27px;
        }
    </style>
@endpush
@section('main')
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>{{ (@$user ? __('admin.update') : __('admin.add')) . ' ' . __('admin.visitor') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                                <li class="breadcrumb-item active">
                                    {{ (@$user ? __('admin.update') : __('admin.add')) . ' ' . __('admin.visitor') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            {{-- @dd($visitor->getTemporaryAddress->temporary_province) --}}
            <section class="content">
                <div class="container-fluid">
                    @isset($user)
                        {{ Form::open(['url' => route('user.update', $user->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => route('user.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                    @endisset
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('admin.user') . ' ' . __('admin.details') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label for="name">{{ __('admin.user') . ' ' . __('admin.name') }}<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" required class="form-control" id="name"
                                                placeholder="Enter User Name Here...." name="name"
                                                value="{{ old('name', @$user->name) }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="email">{{ __('admin.user') . ' ' . __('admin.email') }}<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" required class="form-control" id="email"
                                                placeholder="Enter User Email Here...." name="email" {{@$user ? 'disabled':''}}
                                                value="{{ old('email', @$user->email) }}">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                       
                                        @isset($user)
                                        <input type="email" name="email" value="{{@$user->email}}" hidden>
                                        @else
                                        <div class="form-group col-md-6">
                                            <label for="password">{{  __('admin.password') }}</label>
                                            <input type="password"  class="form-control" id="password"
                                                placeholder="Enter User Password Here...." name="password"
                                                value="{{ old('password', @json_decode($user->password)->$sessionData) }}">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="password_confirmation">{{ __('admin.password_confirmation') }}</label>
                                            <input type="password"  class="form-control" id="password_confirmation"
                                                placeholder="Enter User password_confirmation Here...." name="password_confirmation"
                                                value="{{ old('password_confirmation', @json_decode($user->password_confirmation)->$sessionData) }}">
                                            @error('password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        @endisset

                                        

                                        <div class="form-group col-md-6">
                                            <label for="status">{{ __('admin.user') . ' ' . __('admin.status') }}<span
                                                    class="text-danger">*</span></label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="1" {{@$user->status=='1' ? 'selected':''}}>Active</option>
                                                <option value="0" {{@$user->status=='0' ? 'selected':''}}>In-Active</option>
                                            </select>
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="role">{{ __('admin.user') . ' ' . __('admin.role') }}<span
                                                    class="text-danger">*</span></label>
                                            <select name="role" id="role" class="form-control select2" required>
                                                @foreach ($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="image">{{__('admin.image')}}</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                  <a id="image" data-input="thumbnail1" data-preview="holder" class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                  </a>
                                                </span>
                                                <input id="thumbnail1" class="form-control" type="text" name="photo" value="{{old('photo', @$user->photo)}}">
                                              </div>
                                            <img id="holder" style="margin-top:15px;max-height:100px;">

                                            @error('photo')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror

                                            @isset($user)
                                               <div class="col-md-4">
                                                    <img src="{{asset(@$user->photo)}}" alt="Img" class="img img-fluid img-thumbnail" style="width:100px; height:auto;">
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
                            class="btn btn-primary">{{ @$user ? __('admin.update') : __('admin.submit') }}</button>
                    </div>
                    </form>
                </div>
            </section>
        </div>

    </div>

  
@endsection

@push('scripts')
<script>
         $('#image').filemanager('image');
</script>
    
@endpush
