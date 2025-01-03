@extends('admin.app')
@section('title', 'Email Setting')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Email Setting</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                Email Setting
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @isset($emailSetting)
                    {{ Form::open(['url' => route('email-setting.update', $emailSetting->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                    @method('put')
                @else
                    {{ Form::open(['url' => route('email-setting.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Email Setting</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="contact_email">Contact Email</label>
                                        <input type="email" name="contact_email" id="contact_email" class="form-control" value="{{old('contact_email',@$emailSetting->contact_email)}}">
                                        <p>All Contact Mail Will Send To This Email...</p>
                                        @error('contact_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="mail_type">Mail Type</label>
                                        <select name="mail_type" id="mail_type" class="form-control ">
                                            @foreach ($mailType as $type)
                                                <option value="{{$type['value']}}" {{ old('mail_type') != null || @$emailSetting->mail_type != null ? (old('mail_type', @$emailSetting->mail_type) == $type['value'] ? 'selected' : '') : '' }}>{{$type['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('mail_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="smtp_server_address">SMTP Server Address</label>
                                        <input type="text" name="smtp_server_address" id="smtp_server_address" class="form-control" value="{{old('smtp_server_address',@$emailSetting->smtp_server_address)}}">
                                        @error('smtp_server_address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="smtp_username">SMTP Username</label>
                                        <input type="text" name="smtp_username" id="smtp_username" class="form-control" value="{{old('smtp_username',@$emailSetting->smtp_username)}}">
                                        @error('smtp_username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="smtp_password">SMTP Password</label>
                                        <input type="text" name="smtp_password" id="smtp_password" class="form-control" value="{{old('smtp_password',@$emailSetting->smtp_password)}}">
                                        @error('smtp_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="smtp_port">SMTP Port</label>
                                        <input type="text" name="smtp_port" id="smtp_port" class="form-control" value="{{old('smtp_port',@$emailSetting->smtp_port)}}">
                                        @error('smtp_port')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="smtp_crypto">SMTP Crypto</label>
                                        <select name="smtp_crypto" id="smtp_crypto" class="form-control ">
                                            @foreach ($smtpCrypto as $type)
                                                <option value="{{$type['value']}}" {{ old('smtp_crypto') != null || @$emailSetting->smtp_crypto != null ? (old('smtp_crypto', @$emailSetting->smtp_crypto) == $type['value'] ? 'selected' : '') : '' }}>{{$type['title']}}</option>
                                            @endforeach
                                        </select>
                                        @error('smtp_crypto')
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
