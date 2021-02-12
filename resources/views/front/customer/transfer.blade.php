@extends("layouts.front")
@section("title") Transaction @endsection
@section("css")
    <link rel="stylesheet" href="{{asset("assets/front/fonts/font-awesome/font-awesome.css")}}">
    <link rel="stylesheet" href="{{asset("assets/front/css/multiStepForm.css")}}">
@endsection
@section("content")

        <!-- Main content -->
        <div class="site-section">
            <!-- MultiStep Form -->
            <div class="container-fluid" id="grad1">
                @include('front.includes.alert.message')
                <div class="row justify-content-center mt-0">
                    <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
                        <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-12 mx-0">
                                    <form id="msform" action="{{route('account.doTransfer')}}" method="POST">
                                        @csrf
                                        <!-- progressbar -->
                                        <ul id="progressbar">
                                            <li class="active" id="account"><strong>Account</strong></li>
                                            <li id="personal"><strong>Personal</strong></li>
                                            <li id="payment"><strong>Transfer</strong></li>
                                            <li id="confirm"><strong>Finish</strong></li>
                                        </ul> <!-- fieldsets -->
                                        <fieldset>
                                            <div class="form-card">
                                                <h2 class="fs-title mb-5">Account Information</h2>
                                                <div class="row mr-2 ml-2 mb-3 mt-3">
                                                    <alert type="text" class="btn btn-lg btn-block btn-outline-danger mb-" style="display: none;" id="emailerror">
                                                    </alert>
                                                </div>
                                                <input type="email" name="email" placeholder="Receiver Email" />
                                            </div>
                                            <input type="button" name="checkemail" class="checkemail action-button" value="Next Step" />
                                            <input type="hidden"id="next" name="next" class="next action-button" value="Next Step" />
                                        </fieldset>
                                        <fieldset>
                                            <div class="form-card">
                                                <h2 class="fs-title">Receiver Conformation</h2>
                                                <div class="row mr-2 ml-2 mb-4 mt-2">
                                                    <alert type="text" class="btn btn-lg btn-block btn-danger mb-2" id="emailerror">
                                                    Be sure that the receiver data match the receiver that you want.
                                                    </alert>
                                                </div>
                                                <div class="row col-md-12 mb-3"><img class="img-thumbnail rounded" id="image" src="" width="200px" height="100px"></div>
                                                <div class="row">
                                                    <div class="col-md-4"><lable class="font-weight-bold">Username</lable></div>
                                                    <div class="col-md-8"><p id="username"></p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4"><lable class="font-weight-bold">Mobile</lable></div>
                                                    <div class="col-md-8"><p id="mobile"></p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4"><lable class="font-weight-bold">Email</lable></div>
                                                    <div class="col-md-8"><p id="email"></p></div>
                                                </div>
                                            </div>
                                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                            <input type="button" name="next" class="next action-button" value="Next Step" />
                                        </fieldset>
                                        <fieldset>
                                            <div class="form-card">
                                                <h2 class="fs-title mb-5">Transfer Information</h2>
                                                <div class="row mr-2 ml-2 mb-3 mt-3">
                                                    <alert type="text" class="btn btn-lg btn-block btn-outline-danger mb-2" style="display: none;" id="amounterror">
                                                    </alert>
                                                </div>
                                                <input type="text" name="amount" placeholder="Amount" />
                                                <input type="password" name="password" placeholder="Password" />
                                                <input type="text" name="details" placeholder="Detailes" />
                                            </div>
                                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                            <input type="button" id="done" class="action-button" value="Confirm" />
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
@endsection
@section('script')
    <!-- DataTables  & Plugins -->
    <script>
        window.onload=function (){
            $(document).on('click','.checkemail',function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{route('account.transferCheckEmail')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'email': $("input[name='email']").val(),
                    },
                    success:function(data){
                        if(data.emailstatus == 'error'){
                            $('#emailerror').text(data.message).show();
                        }
                        else if(data.emailstatus == 'success'){
                            $('#emailerror').text('').hide();
                            $('#image').attr('src',data.image);
                            $('#username').text(data.username);
                            $('#mobile').text(data.mobile);
                            $('#email').text(data.email);
                            $('#next').click();
                        }
                    },
                    error:function(reject){
                    }
                });
            });
            $(document).on('click','#done',function(e){
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: "{{route('account.transferCheckAmount')}}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'amount': $("input[name='amount']").val(),
                    },
                    success:function(data){
                        if(data.amountstatus == 'error'){
                            $('#amounterror').text(data.message).show();
                        }
                        else if(data.amountstatus == 'success'){
                            $('#amounterror').text('').hide();
                            $('#msform').submit();
                        }
                    },
                    error:function(reject){
                    }
                });
            });
        };
    </script>
    <script src="{{asset("assets/front/js/multiStepForm.js")}}"></script>
@endsection
