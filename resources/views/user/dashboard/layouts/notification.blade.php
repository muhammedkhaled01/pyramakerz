@if(session('success'))
    <div class="alert alert-success alert-dismisible fade show">

        {{session('success')}}
        <button class="close btn" style="  margin-top: -7px; float: right" data-dismiss="alert"
                aria-label="Close">×
        </button>
    </div>
@endif


@if(session('error'))
    <div class="alert alert-danger alert-dismisible fade show">
        <button class="close btn  " style="  margin-top: -7px;" data-dismiss="alert"
                aria-label="Close">×
        </button>
        {{session('error')}}
    </div>
@endif
