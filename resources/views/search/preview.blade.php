@extends('layouts.modal')
@section('content')
<div class="row">
		<div class="col-md-12">
		<h4>{{ $snippet->title }}</h4>
		<div><i class="fa fa-clock-o"></i> {{ $snippet->publishedAt }}</div>
		<div class="video_wrapper">
				<iframe src="https://www.youtube.com/embed/{{ $video->vc_id }}" frameborder="0" allowfullscreen></iframe>
		</div>
		</div>
</div>
@endsection
