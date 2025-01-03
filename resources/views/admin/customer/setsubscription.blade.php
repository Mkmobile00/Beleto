@extends('admin.app')
@section('title', 'Add Customer Subscription')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Customer Subscription</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                Add Customer Subscription
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                
                {{ Form::open(['url' => route('customer.setSubscription'), 'files' => true, 'class' => 'form form-horizontal']) }}
                @method('post')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Customer({{@$customer->customerDetail->first_name}} {{@$customer->customerDetail->last_name}})</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="text" name="customer_id" value="{{$customer->id}}" hidden>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="subscription_id">Select Subscription</label>
                                        <select name="subscription_id" id="subscription_id" class="form-control" required>
                                            <option value="">-----Select Subscription-----</option>
                                            @foreach ($allSubscription as $subscription)
                                                <option value="{{$subscription->id}}" >{{$subscription->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('subscription_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="amt" id="amtlabel">Amount</label>
                                        <input type="text" name="amt" id="amt" class="form-control" value="{{old('amt',@$country->amt)}}" required>
                                        @error('amt')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="payment_type">Select Payment Type</label>
                                        <select name="payment_type" id="payment_type" class="form-control" required>
                                            <option value="">-----Select Payment Type-----</option>
                                            @foreach ($paymentType as $paymentTypeData)
                                                <option value="{{$paymentTypeData->value}}" >{{$paymentTypeData->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('payment_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="remarks" id="remarkslabel">Remarks</label>
                                        <input type="text" name="remarks" id="remarks" class="form-control" value="{{old('remarks',@$country->remarks)}}" >
                                        @error('remarks')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                    <div class="card-footer">
                                        <button type="submit"
                                            class="btn btn-primary">
                                            
                                                Add
                                        </button>
                                    </div>
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

</div>
@endsection

@push('scripts')

<script>
    const replaceImageData = () => {
    let html = '';
    html += '<div class="col-md-12" id="imageFile">';
    html += '<label for="image" class="form-label">Icon Image:</label>';
    html += '<div class="input-group">';
    html += '<span class="input-group-btn">';
    html += '<a id="lfm" data-input="thumbnail11" data-preview="holder" class="btn btn-primary"><i class="fa fa-picture-o"></i> Choose</a>';
    html += '</span>';
    html += '<input id="thumbnail11" required class="form-control" type="text" name="icon" value="{{ old("thumbnail", @$data->icon) }}">';
    html += '</div>';
    html += '</div>';
    return html;
};
const replaceFileData = () => {
    let file= '';
    file+= '<div class="col-md-12" id="imageFile">';
    file+= '<label for="image" class="form-label">Link:</label>';
    file+= '<div class="input-group">';
    file+= '<input id="thumbnail11" required class="form-control" type="url" name="icon" value="{{ old("icon", @$data->icon) }}">';
    file+= '</div>';
    file+= '</div>';
    return file;
};
    $(document).ready(function () {
        CKEDITOR.replace('description');
        $('#lfm').filemanager('image');

        $(document).on('click', '#thumb_link', function () {
            $('#imageFile').replaceWith(replaceFileData('link'));
            $('#file_type').val('0');
        });

        $(document).on('click', '#thumb_file', function () {
            $('#imageFile').replaceWith(replaceImageData('image'));
            $('#file_type').val('1');
            $('#lfm').filemanager('image');
        });
    });
    const susbcriptionPriceData=@json($susbcriptionPriceData);
    var originalPriceValue=0;
    $(document).on('change','#subscription_id',function(){
        const subscriptionId=$(this).val();
        const paymentType=$('#payment_type').val();
        let price='';
        $.each(susbcriptionPriceData,function(index,value){
            if(subscriptionId==value.id){
                price=value.price;
            }
        });
        if(paymentType){
            if(paymentType !='5'){
                $('#amtlabel').text(`Amount(NPR)`);
                $('#amt').val(price * 100);
            }else{
            $('#amtlabel').text(`Amount($)`);
            $('#amt').val(price);
            }
        }else{
            $('#amtlabel').text(`Amount($)`);
            $('#amt').val(price);
        }
       
        originalPriceValue=price;
    });

    $(document).on('change','#payment_type',function(){
        const paymentType=$(this).val();
        const priceValue=originalPriceValue;
        let convertedPrice=priceValue;
        $('#amtlabel').text(`Amount($)`);
        if(paymentType !='5'){
            convertedPrice=priceValue * 100;
            $('#amtlabel').text(`Amount(NPR)`);
        }
        $('#amt').val(convertedPrice);
    });
</script>
    
@endpush
