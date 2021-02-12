@extends('layouts.adminAuth')
@section('title') Verify Email Address @endsection
@section('content')
    <div class="login-box">
        <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{route('website.home')}}" class="h1"><b>Finances<span class="text-primary">.</span></b></a>
        </div>
        <div class="card-body">
            @if(session('resent'))
                <div class="alert alert-default-success text-center">
                    <span class="login-box-msg"> A fresh verification link has been sent to your email address. </span>
                </div>
            @endif
            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <p>Before proceeding, please check your email for a verification link.</p>
                        <p>If you did not receive the email</p>
                        <button type="submit" class="btn btn-primary btn-block">click here to request another</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mt-3 mb-1">
                <a href="{{route('user.login')}}">Login</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
    </div>
@endsection

