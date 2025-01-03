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

            {{-- <div class="form-group login-page register-page">
                <div class="g-recaptcha"  data-sitekey="6Le6LpApAAAAAKgazx_sXjVi5fPUyoMPMqyHwgZs" required></div>
                <span class="text-danger" hidden id="captchaError"> The reCAPTCHA was invalid. Go back and try it again.
                </span>
            </div> --}}

            

            <div class="form-btn register-btn login_register" style="text-align: right;">
                <button type="submit" class="btns stickyResetpasswordBtn">Reset Password
                </button>
            </div>
        </div>
    </form>
</div>
