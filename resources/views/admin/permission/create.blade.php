@extends('admin.app')
@section('title', 'All Articles')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendors/css/forms/select/select2.min.css') }}">
@endpush

@section('main')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
    </div>
    <div class="content-body">


        <!-- Role cards -->
        <div class="row">

            <div class="card">
                <div class="card-body">
                    <form id="addRoleForm" class="row" method="POST"
                        action="{{ route('role.store') }}">
                        @csrf
                        <div class="col-12">
                            <label class="form-label" for="modalRoleName">Role Name</label>
                            <input type="text" id="modalRoleName" name="name" value="{{ @$role->name }}"
                                class="form-control" placeholder="Enter role name" tabindex="-1"
                                data-msg="Please enter role name" {{ @$role->id == 1 ? 'readonly' : '' }} />
                            @error('name')
                                <p class="form-text text-danger">

                                    {{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="col-12 text-center mt-2">
                            <button type="submit" class="btn btn-primary me-1">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/ Role cards -->

        <!-- Add Role Modal -->

        <!--/ Add Role Modal -->

    </div>
</div>
@endsection

@push('scripts')
    <script>
        $('#selectAll').on('change', function() {
            var value = $(this).is(':checked');
            $('input[name="permission[]"]').prop('checked', value);

        })
        $('.group-check').on('change', function() {
            var value = $(this).is(':checked');
            $(this).closest('tr').find('input[type="checkbox"]').prop('checked', value);
        })
    </script>
    <script>
        $(document).on('click', '.delete-event', function(e) {

            e.preventDefault();
            let clicked = confirm('Are You Sure Want To Delete Articles');

            if (clicked) {
                $(this).parent().find('form').submit();
            }
        });
    </script>
@endpush
