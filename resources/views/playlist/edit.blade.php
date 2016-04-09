@extends('layouts.app')

@section('content')
<div class="container">
		<div class="page-header page-heading">
				<h2><i class="fa fa-edit"></i> {{ trans('playlist.edit_title') }} - {{$playlist->pl_description}}
					<a href="{{ url('playlist') }}" class="btn btn-default  pull-right"><span class="fa fa-angle-double-left"></span></a></h2>
		</div>
		@foreach($playlist->videos as $video)
		<?php $video_snippet = unserialize($video->cache->vc_snippet) ?>
		<div class="row playlist_videos_row">
				<div class="col-md-1">
						<a href="{{ url('search/preview/' . $video->cache->vc_id) }}" class="btn-modal"><img src="{{ $video_snippet->thumbnails->medium->url }}" class="img-rounded" width="100%"></a>
				</div>
				<div class="col-md-10">
						{{ $video_snippet->title }}
				</div>
		</div>
		@endforeach
</div>
@endsection
