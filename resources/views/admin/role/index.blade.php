@extends('admin.app')
@section('title', 'All Articles')
@push('styles')
    <style>

    </style>
@endpush
@section('main')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
    </div>
    <div class="content-body">
        <h3>Roles List</h3>
        <p class="mb-2">
            A role provided access to predefined menus and features so that depending <br />
            on assigned role an administrator can have access to what he need
        </p>

        <a href="{{route('role.create')}}" class="btn btn-sm btn-danger">Add Role</a>
        <!-- Role cards -->
        <div class="row">

            @foreach ($roles as $key => $role)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <span>Total {{ $role->users_count }} users</span>
                                <span>Total {{ $role->permissions_count }} Permissions</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                                <div class="role-heading">
                                    <h4 class="fw-bolder text-capitalize">{{ $role->name }}</h4>
                                    <a href="{{ route('role.edit',$role->id) }}" class="role-edit-modal">
                                        <small class="fw-bolder">Edit Role</small>
                                    </a>
                                </div>
                                <a href="javascript:;" class="btn btn-sm  icon btn-rounded btn-danger btn-style delete-banner" data-id="{{ $role->id}}">
                                    <i data-feather="trash"></i>Delete
                                </a>
                                {{-- <a href="javascript:void(0);" class="text-body"><i data-feather="copy"
                                        class="font-medium-5"></i></a> --}}
                                {{ Form::open(['url'=>route('role.destroy',$role->id),'class'=>'delete-form'])}}
                                    @method('delete')
                                {{ Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
  
@endsection

@push('scripts')
    <script>
        $(document).on('click','.delete-banner',function(e){
            e.preventDefault();
            let clicked=confirm('Are You Sure Want To Delete Role');

            if(clicked)
            {
                $(this).parent().find('form').submit();
            }
        });
    </script>
@endpush
