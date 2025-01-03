@extends('frontend.includes.main')
@push('styles')
    <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
    <style>
        .sample__text {
            background-color: #f6f6f6;
            border: none;
            color: #0d0d0d;
            padding: 15px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 5px 0 5px 5px;
            border: 2px solid #f6f6f6;
            transition: all 0.5s;
            border-radius: 5px;
        }
    </style>
@endpush
@section('contents')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="wrapper fadeInDown">
                    <div id="formContent">
                        <div class="fadeIn first mt-4">
                            @php
                                $logoSrc =
                                    isset($logo->website_logo) && !empty($logo->website_logo)
                                        ? $logo->website_logo
                                        : 'visitordummy.jpg';
                            @endphp

                            <img src="{{ asset($logoSrc) }}" id="icon" alt="User Icon" style="width: 100px" />
                        </div>
                        <!-- Tabs Titles -->
                        <div class="login_header mt-4 mb-4">
                            <h1>Reset Password</h1>
                            <p><strong>Welcome To Kantipur Cinemas</strong></p>
                        </div>
                        <!-- Icon -->
                        <div id="resetForm">
                            <form class="auth-login-form" action="javascript:;" method="POST" id="stickyResetpassword">
                                @csrf
                                <div class="wrapperall">
                                    <input type="text" hidden name="email" value="{{@$email}}">
                                    <div class="form-group login-page register-page">
                                        <input type="text" class="form-control reset_otp" id="reset_otp" name="reset_otp"
                                            value="{{ old('reset_otp') }}" placeholder="Enter Otp Here..." required>
                                        <span hidden class="text-danger reset_otpError"
                                            style="font-size: 12px;font-weight: 300;margin: 1px;"></span>
                                    </div>
                        
                                    <div class="form-group login-page register-page">
                                        <input type="password" class="form-control resetPassword" id="password" name="password"
                                            value="{{ old('password') }}" placeholder="New Password..." required>
                                        <span hidden class="text-danger passwordError"
                                            style="font-size: 12px;font-weight: 300;margin: 1px;"></span>
                                    </div>
                        
                                    <div class="form-group login-page register-page">
                                        <input type="password" class="form-control resetPasswordConfirmation" id="password_confirmation" name="password_confirmation"
                                            value="{{ old('password_confirmation') }}" placeholder="Retype Password..." required>
                                        <span hidden class="text-danger password_confirmationError"
                                            style="font-size: 12px;font-weight: 300;margin: 1px;"></span>
                                    </div>
                        
                                    <div class="form-btn register-btn login_register" style="text-align: right;">
                                        <button type="submit" class="btns stickyResetpasswordBtn">Reset Password
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Remind Passowrd -->
                        <div id="formFooter">
                            <a class="btn btn-sm btn-register me-4" href="{{ route('home') }}">Go to the Site</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).on('click', '.stickyResetpasswordLinkBtn', function() {

            const formId = document.getElementById('stickyResetpasswordLink');
            const form = new FormData(formId);
            $('.emailstickyResetpasswordLinkBtn').text('');
            $('.emailstickyResetpasswordLinkBtn').attr('hidden', true);
            $('.stickyResetpasswordLinkBtn').text('Please Wait Sending Otp....')
            $('#loader').show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: " {{ route('customer.password.email') }}",
                type: "post",
                data: form,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#loader').hide();
                    if (response.validate) {
                        $.each(response.errors, function(index, value) {
                            $('.' + index + 'stickyResetpasswordLinkBtn').text(value);
                            $('.' + index + 'stickyResetpasswordLinkBtn').removeAttr('hidden');
                        });
                        $('.stickyResetpasswordLinkBtn').text('Send Password Reset');
                        return false;
                    }
                    if (response.error) {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true
                        }
                        toastr.error(response.msg);
                        $('.stickyResetpasswordLinkBtn').text('Send Password Reset');
                        return false;
                    }
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.success('Otp Send To Your Mail...');
                    $('#resetForm').replaceWith(response);
                }
            });

        });

        $(document).on('click', '.stickyResetpasswordBtn', function() {
            const formId = document.getElementById('stickyResetpassword');
            const form = new FormData(formId);
            $('.reset_otpError').text('');
            $('.reset_otpError').attr('hidden', true);

            $('.passwordError').text('');
            $('.passwordError').attr('hidden', true);

            $('.password_confirmationError').text('');
            $('.password_confirmationError').attr('hidden', true);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: " {{ route('customer.password.update') }}",
                type: "post",
                data: form,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.validate) {
                        $.each(response.errors, function(index, value) {
                            $('.' + index + 'Error').text(value);
                            $('.' + index + 'Error').removeAttr('hidden');
                        });
                        return false;
                    }
                    if (response.error) {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true
                        }
                        toastr.error(response.msg);
                        return false;
                    }
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.success(response.msg);
                    window.location.href=response.url;
                }
            });

        });
    </script>
@endpush
