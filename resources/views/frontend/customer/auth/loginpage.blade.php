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
                            <h1>Login Here</h1>
                            <p><strong>Welcome To Kantipur Cinemas</strong></p>
                        </div>
                        <!-- Icon -->
                       
                        <form action="{{route('customer.loginnew')}}" id="registerForm" method="post">
                            @csrf
                            <input type="email" id="email" class="fadeIn third" name="email"
                                placeholder="Email..." required>
                                @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            <input type="text" name="ipaddress" value="" hidden id="ipaddress">
                            <input type="password" id="password" class="fadeIn third" name="password"
                                placeholder="Password...." required>
                                @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="g-recaptcha"  data-sitekey="6Le6LpApAAAAAKgazx_sXjVi5fPUyoMPMqyHwgZs"></div>
                                    @error('g-recaptcha-response')
                                        <span class="text-danger"> The reCAPTCHA was invalid. Go back and try it again.
                                        </span>
                                    @enderror
                            <div class="d-flex justify-content-center mt-3 login_register">
                                <div class="login_register" style="text-align: right;">
                                    <button type="submit" id="submitForm">Login</button>
                                </div>
                            </div>
                        </form>
                        <!-- Remind Passowrd -->
                        <div id="formFooter">
                            <a class="btn btn-sm btn-register me-4" href="{{ route('customer.frontresetPassword') }}">Forget Password</a>
                        </div>
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
//         function generateUniqueId() {
//     // Get user agent
//     var userAgent = navigator.userAgent;
    
//     // Get screen dimensions
//     var screenWidth = window.screen.width;
//     var screenHeight = window.screen.height;
    
//     // Generate a unique identifier based on user agent and screen dimensions
//     var uniqueId = hashCode(userAgent + screenWidth + screenHeight);
    
//     return uniqueId;
// }

// // Function to generate a hash code from a string
// function hashCode(str) {
//     var hash = 0, i, chr;
//     if (str.length === 0) return hash;
//     for (i = 0; i < str.length; i++) {
//         chr   = str.charCodeAt(i);
//         hash  = ((hash << 5) - hash) + chr;
//         hash |= 0; // Convert to 32bit integer
//     }
//     return hash;
// }

// // Usage example
// var userId = generateUniqueId();
// setUniqueKey();
// function setUniqueKey(){
//     $('#ipaddress').val(userId);
// }

function generateUserID() {
    // Check if the userID exists in local storage
    var userID = localStorage.getItem('userID');

    // If it doesn't exist, generate a new one and store it
    if (!userID) {
        userID = generateUUID();
        localStorage.setItem('userID', userID);
    }

    return userID;
}

function generateUUID() {
    // Generate a UUID (Universally Unique Identifier)
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = Math.random() * 16 | 0,
            v = c == 'x' ? r : (r & 0x3 | 0x8);
        return v.toString(16);
    });
}

// Usage
var userID = generateUserID();
// alert(userID);
setUniqueKey();
function setUniqueKey(){
    $('#ipaddress').val(userID);
}
    </script>
@endpush
