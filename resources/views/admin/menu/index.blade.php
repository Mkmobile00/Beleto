@extends('admin.app')
@section('title', 'Menu')
@push('styles')
    <style>
  .menu-handle {
            display: block;
            margin-bottom: 5px;
            padding: 6px 4px 6px 12px;
            color: #333;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            cursor: move;
        }

        .menu-handle:hover {
            background: #fff;
        }

        .placeholder {
            margin-bottom: 10px;
            background: #D7F8FD
        }
    </style>
@endpush
@section('main')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Menu List <a href="{{ route('menu.create') }}" class="btn btn-primary">Add New Menu</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Menu List</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">Manage Menu</h2>
                                    <div class="card-tools">
                                        <a href="{{ route('menu.index') }}" type="button" class="btn btn-tool"></a>
                                    </div>
                                </div>
                                <div class="card-body card-format">
                                    <h3>Header Menu</h3>
                                    @if ($menu_items->count() > 0)
                                        <ol class="sortable">
                                            @foreach ($menu_items as $item)
                                                @if ($item->parent_id == null)
                                                    <li id="menuItem_{{ $item->id }}">
                                                        <div class="menu-handle d-flex justify-content-between">
                                                            <span>
                                                                {{ $item->name }}
                                                            </span>
                                                            @php
                                                                $child_menus = \App\Models\Menu::orderBy('position', 'asc')->where('parent_id', $item->id)->get();
                                                            @endphp

                                                            <div class="menu-options btn-group">
                                                                <a href="{{ route('menu.edit', $item->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletionservice{{ $item->id }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                                <!-- Modal -->
                                                                    <div class="modal fade text-left" id="deletionservice{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                                </div>
                                                                                <div class="modal-body text-center">
                                                                                    <form action="{{ route('menu.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                                                                        @csrf
                                                                                        @method("POST")
                                                                                        <label for="reason">Are you sure you want to delete??</label><br>
                                                                                        <input type="hidden" name="_method" value="DELETE" />
                                                                                        <button type="submit" class="btn btn-danger" title="Delete">Confirm Delete</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    ";
                                                                    </div>
                                                            </div>
                                                        </div>

                                                        <ol class="sortable">
                                                            @foreach ($child_menus as $menu)
                                                                    <li id="menuItem_{{ $menu->id }}">
                                                                        <div class="menu-handle d-flex justify-content-between">
                                                                            <span>
                                                                                {{ $menu->name }}
                                                                            </span>

                                                                            <div class="menu-options btn-group">
                                                                                <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletionservice{{ $menu->id }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                                                <!-- Modal -->
                                                                                    <div class="modal fade text-left" id="deletionservice{{ $menu->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                        <div class="modal-dialog" role="document">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                    <span aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                                </div>
                                                                                                <div class="modal-body text-center">
                                                                                                    <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" style="display:inline-block;">
                                                                                                        @csrf
                                                                                                        @method("POST")
                                                                                                        <label for="reason">Are you sure you want to delete??</label><br>
                                                                                                        <input type="hidden" name="_method" value="DELETE" />
                                                                                                        <button type="submit" class="btn btn-danger" title="Delete">Confirm Delete</button>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    ";
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                        @php
                                                                        $sub_child_menus = \App\Models\Menu::orderBy('position', 'asc')->where('parent_id', $menu->id)->get();
                                                                        @endphp

                                                                    <ol class="sortable">
                                                                        @foreach ($sub_child_menus as $menu1)
                                                                            <li id="menuItem_{{ $menu1->id }}">
                                                                                <div class="menu-handle d-flex justify-content-between">
                                                                                    <span>
                                                                                        {{ $menu1->name }}
                                                                                    </span>

                                                                                    <div class="menu-options btn-group">
                                                                                        <a href="{{ route('menu.edit', $menu1->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                                                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletionservice{{ $menu->id }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                                                        <!-- Modal -->
                                                                                            <div class="modal fade text-left" id="deletionservice{{ $menu1->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                <div class="modal-dialog" role="document">
                                                                                                    <div class="modal-content">
                                                                                                        <div class="modal-header">
                                                                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                        </div>
                                                                                                        <div class="modal-body text-center">
                                                                                                            <form action="{{ route('menu.destroy', $menu1->id) }}" method="POST" style="display:inline-block;">
                                                                                                                @csrf
                                                                                                                @method("POST")
                                                                                                                <label for="reason">Are you sure you want to delete??</label><br>
                                                                                                                <input type="hidden" name="_method" value="DELETE" />
                                                                                                                <button type="submit" class="btn btn-danger" title="Delete">Confirm Delete</button>
                                                                                                            </form>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            ";
                                                                                            </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        @endforeach
                                                                    </ol>
                                                                    </li>
                                                            @endforeach
                                                        </ol>
                                                        {{-- {{ get_nested_menu($item->id) }} --}}
                                                        {{-- @include('admin.menu.nested',['data'=>$item->child_menu]) --}}
                                                    </li>
                                                @endif
                                            @endforeach
                                            <div class="form-group mt-4">
                                                <button type="button" class="btn btn-success btn-sm btn-flat" id="serialize"><i
                                                        class="fa fa-save"></i>
                                                    Update Menu
                                                </button>
                                            </div>
                                        </ol>
                                    @else
                                        <p class="text-center">Menu Not Found in Database</p>
                                    @endif
                                </div>
                                <div class="card-body card-format">
                                    <h3>Footer Menu</h3>
                                    @if ($menu_footer->count() > 0)
                                        <ol class="sortable">
                                            @foreach ($menu_footer as $item)
                                                @if ($item->parent_id == null)
                                                    <li id="menuItem_{{ $item->id }}">
                                                        <div class="menu-handle d-flex justify-content-between">
                                                            <span>
                                                                {{ $item->name }}
                                                            </span>
                                                            @php
                                                                $child_menus = \App\Models\Menu::orderBy('position', 'asc')->where('parent_id', $item->id)->get();
                                                            @endphp

                                                            <div class="menu-options btn-group">
                                                                <a href="{{ route('menu.edit', $item->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletionservice{{ $item->id }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                                <!-- Modal -->
                                                                    <div class="modal fade text-left" id="deletionservice{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                                </div>
                                                                                <div class="modal-body text-center">
                                                                                    <form action="{{ route('menu.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                                                                        @csrf
                                                                                        @method("POST")
                                                                                        <label for="reason">Are you sure you want to delete??</label><br>
                                                                                        <input type="hidden" name="_method" value="DELETE" />
                                                                                        <button type="submit" class="btn btn-danger" title="Delete">Confirm Delete</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    ";
                                                                    </div>
                                                            </div>
                                                        </div>

                                                        <ol class="sortable">
                                                            @foreach ($child_menus as $menu)
                                                                    <li id="menuItem_{{ $menu->id }}">
                                                                        <div class="menu-handle d-flex justify-content-between">
                                                                            <span>
                                                                                {{ $menu->name }}
                                                                            </span>

                                                                            <div class="menu-options btn-group">
                                                                                <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletionservice{{ $menu->id }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                                                                <!-- Modal -->
                                                                                    <div class="modal fade text-left" id="deletionservice{{ $menu->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                        <div class="modal-dialog" role="document">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                    <span aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                                </div>
                                                                                                <div class="modal-body text-center">
                                                                                                    <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" style="display:inline-block;">
                                                                                                        @csrf
                                                                                                        @method("POST")
                                                                                                        <label for="reason">Are you sure you want to delete??</label><br>
                                                                                                        <input type="hidden" name="_method" value="DELETE" />
                                                                                                        <button type="submit" class="btn btn-danger" title="Delete">Confirm Delete</button>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    ";
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                            @endforeach
                                                        </ol>
                                                        {{-- {{ get_nested_menu($item->id) }} --}}
                                                        {{-- @include('admin.menu.nested',['data'=>$item->child_menu]) --}}
                                                    </li>
                                                @endif
                                            @endforeach
                                            <div class="form-group mt-4">
                                                <button type="button" class="btn btn-success btn-sm btn-flat" id="serializeone"><i
                                                        class="fa fa-save"></i>
                                                    Update Menu
                                                </button>
                                            </div>
                                        </ol>
                                    @else
                                        <p class="text-center">Menu Not Found in Database</p>
                                    @endif
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    <!-- /.content-wrapper -->
@endsection
@push('scripts')

    <script>

        $('ol.sortable').nestedSortable({
            forcePlaceholderSize: true,
            placeholder: 'placeholder',
            handle: 'div.menu-handle',
            helper: 'clone',
            items: 'li',
            opacity: .6,
            maxLevels: 1,
            revert: 250,
            tabSize: 25,
            tolerance: 'pointer',
            toleranceElement: '> div',
        });

        $("#serialize").click(function(e) {
            e.preventDefault();
            $(this).prop("disabled", true);
            $(this).html(
                    `<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Updating...`
                );
            var serialized = $('ol.sortable').nestedSortable('serialize');
            // console.log(serialized);
            $.ajax({
                url: "{{ route('updateMenuOrder') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    sort: serialized
                },
                success: function(res) {
                    toastr.options.closeButton = true
                    toastr.success('Menu Order Successfuly', "Success !");
                    $('#serialize').prop("disabled", false);
                    $('#serialize').html(`<i class="fa fa-save"></i> Update Menu`);
                }
            });
        });

        $("#serializeone").click(function(e) {
            e.preventDefault();
            $(this).prop("disabled", true);
            $(this).html(
                    `<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Updating...`
                );
            var serializeoned = $('ol.sortable').nestedSortable('serializeone');
            // console.log(serializeoned);
            $.ajax({
                url: "{{ route('updateMenuOrder') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    sort: serializeoned
                },
                success: function(res) {
                    toastr.options.closeButton = true
                    toastr.success('Menu Order Successfuly', "Success !");
                    $('#serializeone').prop("disabled", false);
                    $('#serializeone').html(`<i class="fa fa-save"></i> Update Menu`);
                }
            });
        });

        function show_alert() {
            if (!confirm("Do you really want to do this?")) {
                return false;
            }
            this.form.submit();
        }
    </script>
@endpush
