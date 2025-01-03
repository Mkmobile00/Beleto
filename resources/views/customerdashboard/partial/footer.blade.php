 <!-- Bootstrap core JavaScript-->
 <script src="{{asset('customer/vendor/jquery/jquery.min.js')}}"></script>
 <script src="{{asset('customer/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

 <!-- Core plugin JavaScript-->
 <script src="{{asset('customer/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

 <!-- Custom scripts for all pages-->
 <script src="{{asset('customer/js/sb-admin-2.min.js')}}"></script>

 <!-- Page level plugins -->
 <script src="{{asset('customer/vendor/chart.js/Chart.min.js')}}"></script>

 <!-- Page level custom scripts -->
 <script src="{{asset('customer/js/demo/chart-area-demo.js')}}"></script>
 <script src="{{asset('customer/js/demo/chart-pie-demo.js')}}"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 @stack('scripts')
 <script>
    @if(session()->get('success'))
        toastr.success("{{ session()->get('success') }}");
    @endif
    @if(session()->get('error'))
        toastr.error("{{session()->get('error')}}");
    @endif

    $(document).on('click','.updatePassword',function(){
        let formData=document.getElementById('updatePasswordForm');
        old_password=formData['old_password'].value;
        password=formData['password'].value;
        password_confirmation=formData['password_confirmation'].value;
        $('#old_passwordError').attr('hidden',true);
        $('#old_passwordError').text('');
        $('#passwordError').attr('hidden',true);
        $('#passwordError').text('');
        $('#password_confirmationError').attr('hidden',true);
        $('#password_confirmationError').text('');
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $.ajax({
            url:"{{route('user.update-password')}}",
            type:"put",
            data:{
                old_password:old_password,
                password:password,
                password_confirmation:password_confirmation
            },
            success:function(response){
                if(response.validate)
                {
                    $.each(response.msg,function(index,value){
                        $(`#${index}Error`).removeAttr('hidden');
                        $(`#${index}Error`).text(value);
                    });
                    return false;
                }
                if(response.error)
                {
                    toastr.error(response.msg);
                    return false;
                }
                toastr.success(response.msg);
                window.location.reload();
            }
        });
    });
</script>
</body>

</html>