@extends('frontend.includes.main')
@push('styles')
    <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
@endpush

@section('contents')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class="wrapper fadeInDown">
                    <div id="formContent">
                        <!-- Tabs Titles -->

                        <!-- Icon -->
                        <div class="fadeIn first">
                            <img src="{{@$logo->website_logo}}" id="icon" alt="User Icon" />
                        </div>
                        <!-- Login Form -->
                        <form action="{{route('customer.registernew')}}" id="registerForm" method="post">
                            @csrf
                            <input type="email" id="email" class="fadeIn third" name="email"
                                placeholder="Email..." required>
                                @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            <input type="text" id="first_name" class="fadeIn second" name="first_name"
                                placeholder="First Name...." required>
                                @error('first_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            <input type="text" id="last_name" class="fadeIn second" name="last_name"
                                placeholder="Last Name...." required>
                                @error('last_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            <input type="password" id="password" class="fadeIn third" name="password"
                                placeholder="Password...." required>
                                @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            <input type="password" id="confirmpassword" class="fadeIn third" name="password_confirmation"
                                placeholder="Confirm Password...." required>
                                @error('password_confirmation')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            <div class="g-recaptcha"  data-sitekey="6Le6LpApAAAAAKgazx_sXjVi5fPUyoMPMqyHwgZs"></div>
                                @error('g-recaptcha-response')
                                    <span class="text-danger"> The reCAPTCHA was invalid. Go back and try it again.
                                    </span>
                                @enderror
                            <div class="d-flex justify-content-center mt-3 login_register">
                                <button type="submit" id="submitForm">Create an Account</button>
                            </div>
                            <span>Already Register ??? <a class="btn btn-sm btn-register me-4" href="{{route('customer.login')}}">Login</a></span>
                        </form>

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
        $(document).on('click','#submitForm',function(){
            let registerFormData=document.getElementById('registerForm');
        });
    </script>
@endpush
