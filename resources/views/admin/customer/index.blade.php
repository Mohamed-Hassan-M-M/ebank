@extends("layouts.admin")
@section("title") Customer @endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Customer</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Customer</li>
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
                        <div class="card">
                            <div class="card-body">
                                <table id="example" class="table table-striped table-bordered table-hover text-center" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Age</th>
                                        <th>Balance</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Controllers</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($customers->count() > 0)
                                        @foreach($customers as $customer)
                                    <tr>
                                        <td class="align-middle">{{$customer->name}}</td>
                                        <td class="align-middle">{{$customer->username}}</td>
                                        <td class="align-middle">{{$customer->mobile}}</td>
                                        <td class="align-middle">{{$customer->email}}</td>
                                        <td class="align-middle">{{$customer->age}}</td>
                                        <td class="align-middle">{{$customer->balance}}</td>
                                        <td class="align-middle"><img src="{{$customer->image}}" class="rounded mx-auto d-block" style="width: 70px;height: 70px;" alt="..."></td>
                                        <td class="align-middle @if($customer->status == 1) text-success @else text-danger @endif ">{{$customer->getstatus()}}</td>
                                        <td class="align-middle">
                                            <a href="{{route("admin.customer.status",$customer->id)}}">@if($customer->status == 1) block @else activate @endif</a>
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
