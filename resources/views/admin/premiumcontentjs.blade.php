<script>
     const fetchPremiumContent=(movieId,type)=>{
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"{{route('fetchPremiumContent')}}",
                type:"post",
                data:{
                    movieId:movieId,
                    type:type
                },
                success:function(response){
                    $('#premiumContentForm').replaceWith(response);
                }
            });
        };
        var attributeType
        $(document).on('click','#setPremiumData',function(){
            let movieId=$(this).data('id');
            attributeType=$(this).attr('data-attributetype');
            $('.priceError').text('');
            $('.priceError').attr('hidden',true);
            $('.is_premiumError').text('');
            $('.is_premiumError').attr('hidden',true);
            $('.fromError').text('');
            $('.fromError').attr('hidden',true);
            $('.toError').text('');
            $('.toError').attr('hidden',true);
            $('#movieId').val(movieId);
            $('#is_premium').prop('checked', false);
            $('#from').val('');
            $('#to').val('');
            $('#setPremium').modal('show');
            fetchPremiumContent(movieId,attributeType);
        });
        $(document).on('click','.setPremiumContent',function(){
            let formData=document.getElementById('premiumForm');
            let is_premium = null;
            let duration = null;
            $('.priceError').text('');
            $('.priceError').attr('hidden',true);
            $('.is_premiumError').text('');
            $('.is_premiumError').attr('hidden',true);
            $('.fromError').text('');
            $('.fromError').attr('hidden',true);
            $('.toError').text('');
            $('.toError').attr('hidden',true);
            if ($('#is_premium').prop('checked')) {
                is_premium = $('#is_premium').val(); 
            }
            if ($('#duration').prop('checked')) {
                duration = $('#duration').val(); 
            }
            // if(!is_premium){
            //     $('.is_premiumError').removeAttr('hidden');
            //     $('.is_premiumError').text('Required...');
            //     return false;
            // }
            let movie_id=formData['movie_id'].value;
            if(!movie_id){
                swal({
                    title: 'Something Went Wrong !!',
                    html:true,
                    icon: "error",
                    customClass: {
                        content: 'error-text'
                    }
                });
                return false;
            }
            let from=formData['from'].value;
            let to=formData['to'].value;
            let price=formData['price'].value;
            if(price <=0){
                $('.priceError').removeAttr('hidden');
                $('.priceError').text('price must be greater than 1');
                return false;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"{{route('setMoviePremium')}}",
                type:"post",
                data:{
                    movie_id:movie_id,
                    is_premium:is_premium,
                    from:from,
                    to:to,
                    type:attributeType,
                    price:price,
                    duration:duration
                },
                success:function(response){
                    if(response.validate)
                    {
                        $.each(response.msg,function(index,value){
                            $(`.${index}Error`).removeAttr('hidden');
                            $(`.${index}Error`).text(value);
                        });
                       
                        return false;
                    }
                    if(response.error){
                        swal({
                            title: 'Something Went Wrong !!',
                            html:true,
                            icon: "error",
                            customClass: {
                                content: 'error-text'
                            }
                        });
                        return false;
                    }

                    swal({
                            title: response.msg,
                            html:true,
                            icon: "success",
                            customClass: {
                                content: 'error-text'
                            }
                        });
                    $('#setPremium').modal('hide');
                    $(`#setActive${movie_id}`).replaceWith(response.class);
                }
            });
        });
        $(document).on('change', '#duration', function() {
            if ($(this).is(':checked')) {
                $('#durationData').removeAttr('hidden');
            }else{
                $('#durationData').attr('hidden',true);
                $('#from').val('');
                $('#to').val('');
            }
        })
</script>