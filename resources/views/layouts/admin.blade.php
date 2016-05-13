@extends('layouts.app')

@section('content')
<div id="admin_panel">
@include('admin.menu')
<div class="container">
	@yield('content_admin')
</div>
</div>
@endsection
