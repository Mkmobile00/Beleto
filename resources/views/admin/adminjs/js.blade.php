<script>
    const filledPermanentProvince="{{(old('permanent_province') !=null) ? old('permanent_province') : @$visitor->getPermanentAddress->permanent_province}}" ?? null;
    const filledPermanentDistrict="{{(old('permanent_district') !=null) ? (old('permanent_district') !=null) : @$visitor->getPermanentAddress->permanent_district }}" ?? null;
    const filledPermanentlocal="{{(old('permanent_muncipality') !=null) ? (old('permanent_muncipality') !=null) : @$visitor->getPermanentAddress->permanent_muncipality }}" ?? null;

    const filledTemporaryProvince="{{(old('temporary_province') !=null) ? old('temporary_province') : @$visitor->getTemporaryAddress->temporary_province}}" ?? null;
    const filledTemporaryDistrict="{{(old('temporary_province') !=null) ? old('temporary_province') : @$visitor->getTemporaryAddress->temporary_district}}" ?? null;
    const filledTemporarylocal="{{(old('temporary_muncipality') !=null) ? old('temporary_muncipality') : @$visitor->getTemporaryAddress->temporary_muncipality}}" ?? null;

    $(document).on('change', '#permanent_provincedata', function() {
        const provinceId = $(this).val() ?? filledPermanentProvince;
        const districtValue=filledPermanentDistrict ?? null;
        // alert(districtValue);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('getDistrict') }}",
            type: "post",
            data: {
                provinceId: provinceId
            },
            success: function(response) {
                if (response.error) {
                    $('#permanent_district').attr('disabled',true);
                    return false;
                }

                let districtHtml = '';
                if(response.data.length > 0)
                {
                    districtHtml+= '<option>-----Select District-----</option>';
                    $.each(response.data, function(index, value) {
                    districtHtml +=
                        `<option value="${value.id}" ${districtValue==value.id ? 'selected':''}>${value.np_name}</option>`;
                    });
                    $('#permanent_district').removeAttr('disabled');
                }
                else
                {
                    districtHtml+='<option value="">-----District Not Found-----</option>';
                    $('#permanent_district').attr('disabled',true);
                }
               
                $('#permanent_district').html(districtHtml);
            }
        });
    });
    $('#permanent_provincedata').change();

    $(document).on('change', '#permanent_district', function() {
        const districtId = $(this).val() ?? filledPermanentDistrict;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('getLocal') }}",
            type: "post",
            data: {
                districtId: districtId
            },
            success: function(response) {
                if (response.error) {
                    $('#permanent_muncipality').attr('disabled',true);
                    return false;
                }

                let localHtml = '';
                if(response.data.length > 0)
                {
                    $.each(response.data, function(index, value) {
                    localHtml +=
                        `<option value="${value.id}" ${filledPermanentlocal==value.id ? 'selected':''}>${value.local_name}</option>`;
                    });
                    $('#permanent_muncipality').removeAttr('disabled');
                }
                else
                {
                    localHtml+='<option value="">-----Local Not Found-----</option>';
                    $('#permanent_muncipality').attr('disabled',true);
                }
               
                $('#permanent_muncipality').html(localHtml);
            }
        });
    });
    $('#permanent_district').change();

    $(document).on('change', '#temporary_province', function() {
        const provinceId = $(this).val() ?? filledTemporaryProvince;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('getDistrict') }}",
            type: "post",
            data: {
                provinceId: provinceId
            },
            success: function(response) {
                if (response.error) {
                    $('#temporary_district').attr('disabled',true);
                    return false;
                }

                let districtHtml = '';
                if(response.data.length > 0)
                {
                    districtHtml+= '<option>-----Select District-----</option>';
                    $.each(response.data, function(index, value) {
                    districtHtml +=
                        `<option value="${value.id}" ${filledTemporaryDistrict==value.id ? 'selected':''}>${value.np_name}</option>`;
                    });
                    $('#temporary_district').removeAttr('disabled');
                }
                else
                {
                    districtHtml+='<option value="">-----District Not Found-----</option>';
                    $('#temporary_district').attr('disabled',true);
                }
               
                $('#temporary_district').html(districtHtml);
            }
        });
    });
    $('#temporary_province').change();

    $(document).on('change', '#temporary_district', function() {
        const districtId = $(this).val() ?? filledTemporaryDistrict;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('getLocal') }}",
            type: "post",
            data: {
                districtId: districtId
            },
            success: function(response) {
                if (response.error) {
                    $('#temporary_muncipality').attr('disabled',true);
                    return false;
                }

                let localHtml = '';
                if(response.data.length > 0)
                {
                    $.each(response.data, function(index, value) {
                    localHtml +=
                        `<option value="${value.id}" ${filledTemporarylocal==value.id ? 'selected':''}>${value.local_name}</option>`;
                    });
                    $('#temporary_muncipality').removeAttr('disabled');
                }
                else
                {
                    localHtml+='<option value="">-----Local Not Found-----</option>';
                    $('#temporary_muncipality').attr('disabled',true);
                }
               
                $('#temporary_muncipality').html(localHtml);
            }
        });
    });
    $('#temporary_district').change();



</script>
