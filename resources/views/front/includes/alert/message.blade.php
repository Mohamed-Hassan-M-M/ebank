@if(Session::has('message'))
    <div class="row mr-2 ml-2 mt-5">
        <alert type="text" class="btn btn-lg btn-block @if(Session::get('status') == 'success') btn-outline-success @else btn-outline-danger @endif mb-2"
               id="type-error">{{Session::get('message')}}
        </alert>
    </div>
@endif
