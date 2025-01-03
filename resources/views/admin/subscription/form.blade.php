@extends('admin.app')
@section('title', 'Add Subscription')
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Subscription</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                            <li class="breadcrumb-item active">
                                Subscription OPTIONS
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @isset($subscription)
                    {{ Form::open(['url' => route('subscription.update', $subscription->id), 'files' => true, 'class' => 'form form-horizontal']) }}
                    @method('put')
                @else
                    {{ Form::open(['url' => route('subscription.store'), 'files' => true, 'class' => 'form form-horizontal']) }}
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Subscription OPTIONS</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="title">Subscription Title</label>
                                        <input type="text" class="form-control" id="title1" name="title" value="{{old('title',@$subscription->title)}}" required>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="plan_id">Plan Type</label>
                                        <select name="plan_id" id="plan_id" class="plan_id form-control select2" required>
                                            @foreach ($plaTypes as $plan)
                                                <option value="{{$plan->id}}" {{@$subscription->plan_id==$plan->id ? 'selected':''}}>{{$plan->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('plan_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group mt-2">
                                        <label for="period_id">Period</label>
                                        <select name="period_id" id="period_id" class="period_id form-control select2" required>
                                            @foreach ($periods as $period)
                                                <option value="{{$period->id}}"  {{@$subscription->period_id==$period->id ? 'selected':''}}>{{$period->value}}({{$period->type->name}})</option>
                                            @endforeach
                                        </select>
                                        @error('period_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 form-group mt-2">
                                        <label for="price">Price</label>
                                        <input type="number" min="0.01" step="any" class="form-control" id="price" name="price" value="{{ old('price', @$subscription->price) }}" required>
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 form-group mt-2">
                                        <label for="currency_type">Currency Type</label>
                                        <select name="currency_type" id="currency_type" class="currency_type form-control" required>
                                            <option value="1">$</option>
                                            {{-- @foreach ($currencyTypes as $types)
                                                <option value="{{$types->id}}" {{@$subscription->currency_type==$types->id ? 'selected':''}}>{{$types->title}}</option>
                                            @endforeach --}}
                                        </select>
                                        @error('currency_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="status form-control select2" required>
                                            <option value="active" {{@$subscription->status=='active' ? 'selected':''}}>Active</option>
                                            <option value="inactive" {{@$subscription->status=='inactive' ? 'selected':''}}>In Active</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group mt-2">
                                        <label for="is_suggested">Is Suggessted</label>
                                        <input type="checkbox" id="is_suggested" value="1" {{@$subscription->is_suggested=='1' ? 'checked':''}} name="is_suggested" value="{{old('is_suggested',@$plan->is_suggested)}}">
                                        @error('is_suggested')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                   
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit"
                        class="btn btn-primary">Save Changes</button>
                </div>
                </form>

            </div>
        </section>
    </div>

</div>
@endsection

@push('scripts')

     <script>

        
        $(document).ready(function(){
          $('#logo').filemanager('image');
        });
      </script>
@endpush
