@extends('layouts.app')

@section('content')
{{ Form::open(['url'=> url(''), 'method'=>'post']) }}
<div class="container">
  <div class="page-breadcrumbs">
    <h1 class="section-title">{{ $poll->pol_title }}</h1>
  </div>

  <div class="section">
    <div class="entry-meta">
			<ul class="list-inline">
				<li class="posted-by"><i class="fa fa-user"></i> by <a href="#">{{ $owner->name }}</a></li>
				<li class="publish-date"><a href="#"><i class="fa fa-clock-o"></i> {{ $poll->created_at }} </a></li>
				<li class="views"><a href="#"><i class="fa fa-eye"></i> {{ $poll->pol_view }} views</a></li>
        <li class="views"><a href="#"><i class="fa fa-thumbs-o-up"></i> {{ $poll->pol_votes }} votes</a></li>
			</ul>
		</div>
  </div>

  <div class="section">
    <div class="page_announcement">This Poll Is Under Construction...</div>
  </div>
</div>
{{ Form::close() }}
@endsection

@section('script')
@endsection

@section('meta')
@endsection
