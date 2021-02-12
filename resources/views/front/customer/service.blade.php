@extends('layouts.front')
@section('content')
<div class="site-section">
    <div class="container">
        @include('front.includes.alert.message')
        <div class="row mt-5 mb-5 border-bottom">
            @if(\Illuminate\Support\Facades\Auth::user()->status == 1)
            <a class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="100" data-toggle="modal" data-target="#withdrawal">
                <img src="{{asset('assets/front/images/flaticon-svg/svg/001-wallet.svg')}}" alt="Free Website Template by Free-Template.co" class="img-fluid w-25 mb-4">
                <h3 class="card-title">withdrawal</h3>
            </a>
            @endif
            <a class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="150" data-toggle="modal" data-target="#deposit">
                <img src="{{asset('assets/front/images/flaticon-svg/svg/003-notes.svg')}}" alt="Free Website Template by Free-Template.co" class="img-fluid w-25 mb-4">
                <h3 class="card-title">deposit</h3>
            </a>
            <a class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="200" data-toggle="modal" data-target="#link">
                <img src="{{asset('assets/front/images/flaticon-svg/svg/006-credit-card.svg')}}" alt="Free Website Template by Free-Template.co" class="img-fluid w-25 mb-4">
                <h3 class="card-title">link account</h3>
            </a>
        </div>
        <div class="row mb-2" style="margin-top: 10em !important;">
            @if($accountBanks)
                @foreach($accountBanks as $accountBank)
                    <div class="col-md-3" data-aos="fade-up" data-aos-delay="">
                        <a href="{{route('account.unlink',$accountBank->account_id)}}" class="close" style="font-size: 2em;" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                        <div class="d-flex align-items-start flex-column">
                            <img src="{{$accountBank->banks->image}}" alt="Free Website Template by Free-Template.co" class="img-fluid w-25 mb-4">
                            <h3 class="card-title">{{$accountBank->banks->name}}</h3>
                            <p>{{$accountBank->account_id}}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12 text-center" data-aos="fade-up" data-aos-delay="">
                   <h3 class="card-title">No account linked yet.</h3>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal link -->
<div class="modal fade" id="link" tabindex="-1" role="dialog" aria-labelledby="linkTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="linkTitle">Link Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('account.doLink')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="account_id" class="col-sm-4 col-form-label">Account ID</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="account_id" placeholder="Account ID" name="account_id">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary justify-content-start">Link</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal link -->

<!-- Modal withdrawal -->
<div class="modal fade" id="withdrawal" tabindex="-1" role="dialog" aria-labelledby="withdrawalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="withdrawalTitle">Withdrawal Money</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('account.doWithdrawal')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="account_id" class="col-sm-4 col-form-label">Account ID</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="account_id" name="account_id">
                                @if($accountBanks)
                                    @foreach($accountBanks as $accountBank)
                                        <option>Choose account</option>
                                        <option value="{{$accountBank->account_id}}">{{$accountBank->account_id}} - [ {{$accountBank->banks->name}} ]</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-4 col-form-label">Amount</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="amount" placeholder="Amount" name="amount">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary justify-content-start">Withdrawal</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal withdrawal -->

<!-- Modal deposit -->
<div class="modal fade" id="deposit" tabindex="-1" role="dialog" aria-labelledby="depositTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="depositTitle">Deposit Money</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('account.doDeposit')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="account_id" class="col-sm-4 col-form-label">Account ID</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="account_id" name="account_id">
                                @if($accountBanks)
                                    @foreach($accountBanks as $accountBank)
                                        <option>Choose account</option>
                                        <option value="{{$accountBank->account_id}}">{{$accountBank->account_id}} - [ {{$accountBank->banks->name}} ]</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-4 col-form-label">Amount</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="amount" placeholder="Amount" name="amount">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary justify-content-start">Deposit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal deposit -->
@endsection
