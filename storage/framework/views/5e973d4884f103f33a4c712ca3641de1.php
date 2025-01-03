<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo e(asset('admin/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(asset('admin/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<!--------Sortable js---------------------->
<script src="<?php echo e(asset('admin/plugins/sortablejs/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/plugins/sortablejs/jquery.mjs.nestedSortable.js')); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo e(asset('admin/plugins/chart.js/Chart.min.js')); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo e(asset('admin/plugins/sparklines/sparkline.js')); ?>"></script>
<!-- JQVMap -->
<script src="<?php echo e(asset('admin/plugins/jqvmap/jquery.vmap.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js')); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo e(asset('admin/plugins/jquery-knob/jquery.knob.min.js')); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo e(asset('admin/plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo e(asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>
<!-- Summernote -->
<script src="<?php echo e(asset('admin/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo e(asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('admin/dist/js/adminlte.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('admin/dist/js/demo.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo e(asset('admin/dist/js/pages/dashboard.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="<?php echo e(asset('nepali-datepicker/js/nepali.datepicker.v4.0.1.min.js')); ?>"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://unpkg.com/nepalify@0.5.0/umd/nepalify.production.min.js"></script>
<script src="<?php echo e(asset('vendor/laravel-filemanager/js/stand-alone-button.js')); ?>"></script>

<script src="<?php echo e(asset('frontend/js/sweetalert.min.js')); ?>"></script>
<script type='text/javascript' src="<?php echo e(asset('vendor/laravel-filemanager/js/stand-alone-button.js')); ?>"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>


<script>

    <?php if(session()->get('success')): ?>
        toastr.success("<?php echo e(session()->get('success')); ?>");
    <?php endif; ?>
    <?php if(session()->get('error')): ?>
        toastr.error("<?php echo e(session()->get('error')); ?>");
    <?php endif; ?>
    const loadSelect=()=>{
        $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });
    }
    loadSelect();
    const reloadSelect2 = () => {
        $('.select2').select2();

        $('.select2-container').css('width', '100%');
    }


    reloadSelect2();
    const calculateAge=(selectedYear)=>{
      let selectedDate = new Date(selectedYear);
      let currentDate = new Date();
      let age = currentDate.getFullYear() - selectedDate.getFullYear();
      if (
        currentDate.getMonth() < selectedDate.getMonth() ||
        (currentDate.getMonth() === selectedDate.getMonth() &&
          currentDate.getDate() < selectedDate.getDate())
      ) {
        age--;
      }

      return age;
    }
    if ($('.nepali-datepicker').length) {
        datePickerInitialize();
    }

    function datePickerInitialize() {
        var mainInput = $(".nepali-datepicker");
        mainInput.nepaliDatePicker({
            ndpYear: true,
            ndpMonth: true,
            onChange: function() {
                var bsDate = $('.nepali-datepicker').val();
                var newBsDate = NepaliFunctions.ConvertToDateObject(bsDate, "YYYY-MM-DD")
                var newBsToAD = NepaliFunctions.BS2AD(newBsDate);

                var adDate = NepaliFunctions.ConvertDateFormat(newBsToAD, "YYYY-MM-DD")
                var calcultedAge=calculateAge(adDate);
                $('.eng-datepicker').val(adDate);
                $('.finalAge').val(calcultedAge);
            }
        });
    }

    $(document).on('change', '.eng-datepicker', function() {
        let enDate = $(this).val();
        var newEnDate = NepaliFunctions.ConvertToDateObject(enDate, "YYYY-MM-DD")
        var newEnToBS = NepaliFunctions.AD2BS(newEnDate);
        var bsDate = NepaliFunctions.ConvertDateFormat(newEnToBS, "YYYY-MM-DD")
        $(".nepali-datepicker").val(bsDate);
    });

    if ($('.issuedate-datepicker').length) {
        datePickerInitialize2();
    }

    function datePickerInitialize2() {
        var mainInput = $(".issuedate-datepicker");
        mainInput.nepaliDatePicker({
            ndpYear: true,
            ndpMonth: true,
            onChange: function() {
                var bsDate = $('.issuedate-datepicker').val();
                var newBsDate = NepaliFunctions.ConvertToDateObject(bsDate, "YYYY-MM-DD")
                var newBsToAD = NepaliFunctions.BS2AD(newBsDate);

                var adDate = NepaliFunctions.ConvertDateFormat(newBsToAD, "YYYY-MM-DD")
            }
        });
    }
</script>
<script>

    $(document).on('click','#resetPassword',function(){
        $('#current_password').val('');
        $('#password').val('');
        $('#password_confirmation').val('');
        $('#exampleModal').modal('show');
    });

      $('#updatePasswordBtn').on('click',function()
        {
            $('.current_password').text('');
            $('.password').text('');
            $('.password_confirmation').text('');
            var form=document.getElementById('update-adminPassword');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"<?php echo e(route('admin.updatePassword')); ?>",
                type:'put',
                data:{
                    current_password:form['current_password'].value,
                    password:form['password'].value,
                    password_confirmation:form['password_confirmation'].value,
                },
                success:function(res)
                {
                    if(res.validation)
                    {
                        $.each(res.msg,function(index,value)
                        {
                            $('.'+index).text(value);
                        });
                        return false;
                    }
                    if(res.error)
                    {
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
                    if(res.old_password)
                    {
                        $('.current_password').text(res.msg);
                        return false;
                    }

                   if(res.success)
                   {
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
                    $('#exampleModal').modal('hide');
                   }

                }
            });
        });
</script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\nextcinemas\nextcinemas\resources\views/admin/layouts/footer.blade.php ENDPATH**/ ?>