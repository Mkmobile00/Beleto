<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
       
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Update You Password Here.</p>

                <form action="javascript:;" method="post" id="resetFinalData">
                    @csrf()
                    <input type="text" hidden name="email" value="{{ $email }}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="otp" required placeholder="Enter Otp">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger text-center otp"></span>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" required
                            placeholder=" New Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger text-center password"></span>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password_confirmation" required
                            placeholder="Retype Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger text-center password_confirmation"></span>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" id="updatePassword" class="btn btn-primary btn-block">Update
                                Password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-3 mb-1">
                    <a href="{{ route('login') }}">Login</a>
                </p>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).on('click', '#updatePassword', function() {
            $('.otp').text('');
            $('.password').text('');
            $('.password_confirmation').text('');
            let formData = document.getElementById('resetFinalData');
            let otp = formData['otp'].value;
            let password = formData['password'].value;
            let passwordConfirmation = formData['password_confirmation'].value;
            let email=formData['email'].value;
            if (!email) {
              Swal.fire({
                  title: 'Error',
                  text: 'Something Went Wrong !!',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Ok',
                  customClass: {
                      confirmButton: 'btn btn-primary',
                      cancelButton: 'btn btn-outline-danger ms-1'
                  },
                  buttonsStyling: false
              });
              return false;
            }
            if (!otp) {
                $('.otp').text('Required....');
                return false;
            }
            if (!password) {
                $('.password').text('Required....');
                return false;
            }
            if (!passwordConfirmation) {
                $('.password_confirmation').text('Required....');
                return false;
            }
            if (password != passwordConfirmation) {
                $('.password').text('Password confirmation doesnot match....');
                return false;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
              url:"{{route('updateForgetPassword')}}",
                type:'put',
                data:{
                    otp:formData['otp'].value,
                    email:formData['email'].value,
                    password:formData['password'].value,
                    password_confirmation:formData['password_confirmation'].value,
                },
                success: function(res) {
                    if (res.validation) {
                        $.each(res.msg, function(index, value) {
                            $('.' + index).text(value);
                        });
                        return false;
                    }
                    if (res.error) {
                        Swal.fire({
                            title: 'Error',
                            text: res.msg,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ok',
                            customClass: {
                                confirmButton: 'btn btn-primary',
                                cancelButton: 'btn btn-outline-danger ms-1'
                            },
                            buttonsStyling: false
                        })
                        return false;
                    }
                    

                    Swal.fire({
                            title: 'Success ',
                            text: res.msg,
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Ok',
                            customClass: {
                                confirmButton: 'btn btn-primary',
                                cancelButton: 'btn btn-outline-danger ms-1'
                            },
                            buttonsStyling: false
                        });
                        window.location.href=res.url;
                }
            });
        });
    </script>
</body>

</html>
