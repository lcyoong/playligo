@extends('layouts.app')

@section('content')
<div class="container">
  <div class="page-breadcrumbs">
    <h1 class="section-title">{{ $playlist->pl_title }}</h1>
  </div>
  <div class="section">
    <!-- <div class="fb-like" data-href="{{ Request::url() }}" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
    <div class="pull-right">
      <a class="btn btn-sm btn-default btn-transparent--border btn-hoverWhite ct-u-text--white" href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}" target=_blank><i class="fa fa-facebook"></i></a>
      <a class="btn btn-sm btn-default btn-transparent--border btn-hoverWhite ct-u-text--white" href="http://twitter.com/home?status={{ Request::url() }}" target=_blank><i class="fa fa-twitter"></i></a>
    </div> -->
  </div>

    <div class="row">
      <div class="col-md-8">
        <ul class="list-group">
          @foreach ($playlist->videos as $video)
            <?php $video_snippet = unserialize($video->vc_snippet) ?>
            <li class="list-group-item">
              <div class="row">
              <div class="col-md-2 col-sm-2 col-xs-4">
                  <a href="{{ url('search/preview/' . $video->vc_id) }}" class="btn-modal"><img src="{{ $video_snippet->thumbnails->medium->url }}" class="img-rounded" width="100%"></a>
              </div>
              <div class="col-md-10 col-sm-10 col-xs-6">
                  <div class="selected_video_title">{{ $video_snippet->title }}</div>
                  <div class="selected_video_published"><i class="fa fa-clock-o"></i> {{ $video_snippet->publishedAt }}</div>
              </div>
            </div>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
</div>
@endsection

@section('script')
@endsection

@section('meta')
  <meta property="og:url"           content="{{ Request::url() }}" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="{{ $playlist->pl_title }}" />
	<meta property="og:description"   content="{{ $playlist->pl_description }}" />
	<!-- <meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" /> -->
@endsection
