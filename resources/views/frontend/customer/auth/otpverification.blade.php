@extends('frontend.includes.main')

@section('contents')
    <div id="content" class="site-content">
        <!-- Modal -->
        <div class="common-popup small-popup modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Resend OTP Verification Code</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="form-group">
                                <label for="emailphone">Enter Email/Phone</label>
                                <input type="text" class="form-control email_or_phone" name="emailphone" required>
                            </div>
                            
                            <input type="button" class="btn btn-primary" id="resend" value="Submit"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="otp-page mt-5 mb-5">
            <div class="container">
                <div class="otp-wrapper" style="background: white; padding: 20px; border-radius: 6px !important; ">
                    <div class="otp-alert">
                        @if (session('success'))
                            <p id="success">
                                {{ request()->session()->get('success') }}
                            </p>
                        @endif

                        @if (session('error'))
                            <p class="text-danger">
                                {{ request()->session()->get('error') }}
                            </p>
                        @endif
                    </div>
                    <div class="otp-details">
                        <h3>OTP Verification</h3>
                        <p>
                            Please insert the OTP that you received in the mail.
                        </p>
                        <form method="post" action="javascript:;" id="verifyOtpData">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="input-text form-control" name="otp" value=""
                                    maxlength="6" required autofocus
                                    style="box-shadow: none;
                                border: none;
                                background: transparent !important;
                                border: 1px solid #2c2136;"
                                    placeholder="Enter Your OTP Code...">
                                <div class="dots">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <span hidden class="otperror text-danger">Required....</span>
                                <div class="g-recaptcha"  data-sitekey="6Le6LpApAAAAAKgazx_sXjVi5fPUyoMPMqyHwgZs" required></div>
                                <span class="text-danger" hidden id="captchaError"> The reCAPTCHA was invalid. Go back and try it again.
                                </span>
                                <div class="login_register">
                                    <button type="submit" id="submitTokenForm" class="btn">Verify</button>
                                </div>

                                <label for="rememberme"></label>
                            </div>
                            <div class="resend">
                                <p>
                                    Didn't get OTP? &nbsp;
                                    <input type="button" value="Resend Code" class="main-resend"
                                        style="display:none;padding: 7px 18px;background: #0f0617;color: #fff;border-radius: 6px; outline: none;border: none;"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal" id="resendSellerCode">
                                <div class="countdown" id="resendTimer11"></div>

                                </p>



                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>

    <script>
        const startCountdown = (seconds) => {
            var resendCodeLink = document.getElementById("resendTimer11");
            var sendButton = document.getElementById("resendSellerCode");
            console.log(resendCodeLink);
            if (resendCodeLink) {
                var countdown = seconds;
                var countdownInterval = setInterval(function() {
                    if (countdown <= 0) {
                        clearInterval(countdownInterval);
                        resendCodeLink.innerText = "";
                        sendButton.style.display = "block";
                    } else {
                        console.log(countdown);
                        resendCodeLink.innerText = "Resend Code in " + countdown + " seconds";
                        countdown--;
                    }
                }, 1000);
            }
        }
        $(document).ready(function() {

            startCountdown(60);
        });
    </script>

    <script>
        $(document).on('click', '#submitTokenForm', function(e) {
            const otpFormData = document.getElementById('verifyOtpData');
            const otpValue = otpFormData['otp'].value;
            const recaptcha=otpFormData['g-recaptcha-response'].value;
            $('.otperror').attr('hidden', true);
            $('#captchaError').attr('hidden',true);
            if (!otpValue) {
                $('.otperror').removeAttr('hidden');
                return false;
            }
            if (!recaptcha) {
                $('#captchaError').removeAttr('hidden');
                return false;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('customer.verificationNew') }}",
                type: "post",
                data: {
                    otp: otpValue
                },
                success: function(response) {
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
                    window.location.href = response.url;

                }
            });
        });
    </script>

    <script>
        $(document).on('click', '#resend', function() {

            var url = "{{ route('customers.otp') }}";
            var email_or_phone = $('.email_or_phone').val();
            var $this = $(this);

            $.ajax({
                type: "GET",
                url: url,
                data: {
                    email_or_phone: email_or_phone,
                },
                cache: false,
                success: function(response) {
                    if (response.error) {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true
                        }
                        toastr.error(response.msg);
                        return false;
                    } else {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true
                        }
                        toastr.success(response.msg);
                        document.getElementById('resendSellerCode').style.display = 'none';
                        startCountdown(60);
                    }

                }
            });

        });
    </script>
@endpush
