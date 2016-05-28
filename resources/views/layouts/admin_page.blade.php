@extends('layouts.admin')

@section('content_admin')
<div class="page-breadcrumbs">
	<h1 class="section-title">{{ $page_title or ''  }}</h1>
	<div class="world-nav cat-menu">
		<ul class="list-inline">
			@if(!empty($back_url))
			<li class="active"><a href="{{ $back_url }}" class=""><span class="fa fa-angle-double-left"></span> {{ $back_text or trans('form.back_to_list') }}</a></li>
			@endif
		</ul>
	</div>
</div>

@yield('content_page')
@endsection
