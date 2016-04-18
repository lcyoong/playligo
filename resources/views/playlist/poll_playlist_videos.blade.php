<h4>{{ $playlist->pl_title }}</h4>
@foreach ($playlist->videos as $video)
<?php $video_snippet = unserialize($video->vc_snippet) ?>
<div class="row selected_video">
  <div class="col-md-4 col-sm-2 col-xs-4">
      <a href="{{ url('search/preview/' . $video->vc_id) }}" class="btn-modal"><img src="{{ $video_snippet->thumbnails->medium->url }}" class="img-rounded" width="100%"></a>
  </div>
  <div class="col-md-6 col-sm-8 col-xs-6">
      <div class="selected_video_title">{{ $video_snippet->title }}</div>
      <div class="selected_video_published"><i class="fa fa-clock-o"></i> {{ $video_snippet->publishedAt }}</div>
  </div>
</div>
@endforeach
