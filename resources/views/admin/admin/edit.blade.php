@extends("layouts.admin")
@section("title") Admin || edit @endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Admin edit</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.admin.index')}}">Admin</a></li>
                            <li class="breadcrumb-item active">Edit</li>
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
                    <div class="col-md-6 m-auto">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="m-0 text-center">{{$admin->name}} Information</h3>
                            </div>
                            <img width="200" height="200" class="img-thumbnail mt-4 mb-2 mr-auto ml-auto" src="{{$admin->image}}">
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form" action="{{route('admin.admin.doEdit',$admin->id)}}" method="POST"
                            enctype="multipart/form-data">
                                @csrf
                                <div class="row hidden">
                                    <input type="hidden" value="1" name="edit">
                                    <input type="hidden" value="{{$admin->id}}" name="old_id">
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror " value="{{old($admin->name,$admin->name)}}" id="name" placeholder="Enter name" name="name">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Username</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror " value="{{old($admin->username,$admin->username)}}" id="username" placeholder="Enter username" name="username">
                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="website">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror " id="password" placeholder="Enter password" name="password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="website">Password Confirmation</label>
                                        <input type="password" class="form-control" id="password_confirmation" placeholder="Retype password" name="password_confirmation">
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" class="form-control @error('mobile') is-invalid @enderror " value="{{old($admin->mobile,$admin->mobile)}}" id="mobile" placeholder="Enter mobile" name="mobile">
                                        @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror " value="{{old($admin->email,$admin->email)}}" id="email" placeholder="Enter email" name="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror " id="exampleInputFile" name="image">
                                                <label class="custom-file-label" for="exampleInputFile">Upload Bank image</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload Image</span>
                                            </div>
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn b btn-primary" style="width: 100%">Edit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
