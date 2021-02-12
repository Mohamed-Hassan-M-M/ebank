@extends("layouts.front")
@section("title") Transaction @endsection
@section("css")
    <link rel="stylesheet" href="{{asset("assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
@endsection
@section("content")

        <!-- Main content -->
        <div class="site-section" style="padding-top: 10em;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="example" class="table table-striped table-bordered table-hover text-center" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Sender</th>
                                        <th>Receiver</th>
                                        <th>Amount</th>
                                        <th>Details</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($transactions->count() > 0)
                                        @foreach($transactions as $transaction)
                                    <tr>
                                        <td class="align-middle">{{$transaction->sender->username}}</td>
                                        <td class="align-middle">{{$transaction->receiver->username}}</td>
                                        <td class="align-middle">{{$transaction->amount}}</td>
                                        <td class="align-middle">{{$transaction->details}}</td>
                                        <td class="align-middle @if($transaction->status == 1) text-success @else text-danger @endif ">{{$transaction->getstatus()}}</td>
                                        <td class="align-middle">{{$transaction->created_at}}</td>
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
        </div>
        <!-- /.content -->
@endsection
@section('script')
    <!-- DataTables  & Plugins -->
    <script src="{{asset("assets/admin/plugins/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
    <script>
        $(document).ready(function() {
            $("#example").DataTable({
                scrollX:true,
            });
        } );
    </script>
@endsection
