@extends("layouts.admin")
@section("title") Admin @endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Admin</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Admin</li>
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
                    <div class="col-12">
                        <a class="btn btn-lg btn-success mb-3" href="{{route("admin.admin.create")}}"><i class="fa fa-plus"></i> Add admin </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="example" class="table table-striped table-bordered table-hover text-center" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Controllers</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($admins->count() > 0)
                                        @foreach($admins as $admin)
                                    <tr>
                                        <td class="align-middle">{{$admin->name}}</td>
                                        <td class="align-middle">{{$admin->username}}</td>
                                        <td class="align-middle">{{$admin->mobile}}</td>
                                        <td class="align-middle">{{$admin->email}}</td>
                                        <td class="align-middle"><img src="{{$admin->image}}" class="rounded mx-auto d-block" style="width: 70px;height: 70px;" alt="..."></td>
                                        <td class="align-middle @if($admin->status == 1) text-success @else text-danger @endif ">{{$admin->getstatus()}}</td>
                                        <td class="align-middle">
                                            @if($admin->id == auth('admin')->user()->id)
                                            <a href="{{route("admin.admin.edit",$admin->id)}}"><i class="fa fa-edit text-success"></i></a>
                                            @endif
                                            @if($admin->super_admin == 0)
                                            <a href="{{route("admin.admin.delete",$admin->id)}}" class="ml-2" onclick="if(!confirm('Warnning! are you sure to delete {{$admin->name}}')) return false;" ><i class="fa fa-trash text-danger"></i></a>
                                            <a href="{{route("admin.admin.status",$admin->id)}}" class="ml-2" >@if($admin->status == 1) deactivate @else activate @endif</a>
                                            @endif
                                        </td>
                                    </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $("#example").DataTable({
                scrollX:true,
            });
        } );
    </script>
@endsection
