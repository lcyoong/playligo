@extends('layouts.admin')

@section('content_admin')
<div class="container">
	<div class="page-breadcrumbs">
		<h1 class="section-title">{{ $page_title or ''  }}</h1>
		<!-- <div class="world-nav cat-menu">
			<ul class="list-inline">
				<li class="active"><a href="{{ url('search') }}" class=""><span class="fa fa-plus"></span> @lang('playlist.new')</a></li>
			</ul>
		</div> -->
	</div>

	@if (isset($filter) && view()->exists($filter))
		@include($filter)
	@endif

	@yield('content_list')
	
	<div class="section">
		Total : {{ $total_record or 0 }} record(s)
	</div>
</div>
@endsection
