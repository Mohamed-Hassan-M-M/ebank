@extends("layouts.admin")
@section("title") Bank @endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Bank</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Bank</li>
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
                        <a class="btn btn-lg btn-success mb-3" href="{{route("admin.bank.create")}}"><i class="fa fa-plus"></i> Add bank </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="example" class="table table-striped table-bordered table-hover text-center" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Website</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Controllers</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($banks->count() > 0)
                                        @foreach($banks as $bank)
                                    <tr>
                                        <td class="align-middle">{{$bank->id}}</td>
                                        <td class="align-middle">{{$bank->name}}</td>
                                        <td class="align-middle">{{$bank->mobile}}</td>
                                        <td class="align-middle">{{$bank->website}}</td>
                                        <td class="align-middle"><img src="{{$bank->image}}" class="rounded mx-auto d-block" style="width: 70px;height: 70px;" alt="..."></td>
                                        <td class="align-middle @if($bank->status == 1) text-success @else text-danger @endif ">{{$bank->getstatus()}}</td>
                                        <td class="align-middle">
                                            <a href="{{route("admin.bank.edit",$bank->id)}}" class="mr-2"><i class="fa fa-edit text-success"></i></a>
                                            <a href="{{route("admin.bank.delete",$bank->id)}}" class="mr-2" onclick="if(!confirm('Warnning! are you sure to delete {{$bank->name}}')) return false;" ><i class="fa fa-trash text-danger"></i></a>
                                            <a href="{{route("admin.bank.status",$bank->id)}}">@if($bank->status == 1) deactivate @else activate @endif</a>
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
