@extends('admin.app')
@section('title', 'Category')
@push('styles')
<style>
    .sortable li {
        margin-left: 10px;
    }
    .sortable li div {
        background: #ed6627;
        margin: 10px 0px;
        color:white;
        padding: 5px 14px;
        box-shadow: 2px 2px 2px rgb(243, 242, 242);
        font-size: 14px;
        font-weight: bold;
        border-radius: 100px;
    }
    .sortable .nestedlist{
        background: #ed6627;
    }
    .sortable > li > ol > li .nestedlist{
        background: #00486a;
    }
    .sortable > li > ol > li > ol > li .nestedlist{
        background: #14974e;

    }
    .sortable > li > ol > li > ol > li > ol > li .nestedlist{
        background: #2a63b0;
    }
    .sortable li div::after {
        content: "\205C";
        float: right;
    }

    ol.sortable li {
        list-style:none;
        margin-left: 10px;

    }

</style>
@endpush
@section('main')
<div class="wrapper">
    <div class="content-wrapper">
    <section class="app-user-list">
        <form action="">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Category Sort</h4>
                    <hr />
                    <a href="{{route('category.index')}}" class="btn btn-sm btn-success">Back</a>
                </div>
                <div class="card-body border-bottom">
                    <ol class="sortable">
                        @include('admin.category._nestedCategory', ['categories' => $categories])
                    </ol>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="serialize">Submit</button>
                </div>
            </div>
        </form>
    </section>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/sortablejs/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/sortablejs/jquery.mjs.nestedSortable.js') }}"></script>
<script>
    $(document).ready(function() {

        $('.sortable').nestedSortable({
            handle: 'div',
            items: 'li',
            toleranceElement: '> div'
        });

        $('#serialize').on('click', function(e) {
                e.preventDefault();
                $(this).prop('disabled', true);
                var serialized = $('ol.sortable').nestedSortable('serialize');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:"{{ route('category.sortable') }}",
                    type:"post",
                    data:{
                        sort: serialized
                    },
                    success:function(response){
                        toastr.success(response.msg);
                        $('#serialize').prop('disabled', false);
                    }
                });
               
        });

    });
</script>
@endpush
