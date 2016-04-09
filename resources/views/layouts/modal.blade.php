<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">@if(isset($title)){{$title}}@endif</h4>
</div>
<div class="modal-body">
	<div @if(isset($height)) class="scrollable-y" style="height: {{$height}}px" @endif>
    @yield('content')
    </div>
</div>
