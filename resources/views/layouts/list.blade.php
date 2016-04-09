@extends('layouts.app')

@section('content')
<div class="container">

@if (isset($filter) && view()->exists($filter))
	@include($filter)
@endif

@yield('content_list')
</div>
@endsection
