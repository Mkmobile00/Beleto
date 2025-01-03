@extends('admin.app')
@section('title', 'Update Setting')
@push('styles')
    <style>
        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-md-12 {
            width: 100%;
        }

        .card {
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #007BFF;
            color: #fff;
            padding: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        button {
            background-color: #28A745;
            color: #fff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        /* Optional: Add media queries for responsive design */
        @media (max-width: 768px) {
            .form-group {
                width: 100%;
            }
        }
    </style>
@endpush
@section('main')
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>{{ (@$setting ? __('admin.update') : __('admin.add')) . ' ' . __('admin.setting') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('admin.home') }}</a></li>
                                <li class="breadcrumb-item active">
                                    {{ (@$setting ? __('admin.update') : __('admin.add')) . ' ' . __('admin.setting') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                        </div>
                        <form method="post" action="{{ route('update.english_language') }}">
                            <br>
                            @csrf
                            @php
                                $coundData = 0;
                            @endphp
                            @foreach ($langContent as $key => $value)
                                <div class="row">
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="{{ $key }}">{{ $key }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group form-control-sm">
                                            <input type="text" name="langContent[{{ $key }}]"
                                                value="{{ old('langContent.' . $key, $value) }}"
                                                id="langNep{{ $coundData }}">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                </div>
                                @php
                                    $coundData = $coundData + 1;
                                @endphp
                            @endforeach
                            <button type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@push('scripts')
    <script>
        let options1 = {
            layout: "romanized",
            enable: true,
        };
        let sessionValue = "{{ @$lang }}";
        let langCount = Number("{{ count(@$langContent) }}");
        if (sessionValue === 'np') {
            for (let i = 0; i <= langCount; i++) {
                nepalify.interceptElementById('langNep' + i, options1);
            }
        }
    </script>
@endpush
