@if(Session::has('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <ul>
        <li class="success">
            {{ Session::get('success') }}
        </li>
    </ul>
</div>
@endif
@if(Session::has('info'))
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <ul>
        <li class="info">
            {{ Session::get('info') }}
        </li>
    </ul>
</div>
@endif
@if(Session::has('warning'))
<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <ul>
        <li class="warning">
            {{ Session::get('warning') }}
        </li>
    </ul>
</div>
@endif
@if(Session::has('danger'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <ul>
        <li class="danger">
            {{ Session::get('danger') }}
        </li>
    </ul>
</div>
@endif