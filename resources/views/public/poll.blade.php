@extends('layouts.app')

@section('content')
<div class="playlist-search text-center section">
  <div class="playlist-search-inner">
      <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
            <h1>{{ trans('form.poll_search_caption') }}</h1>
            {{ Form::open(['url'=>url('public_poll/search'), 'method'=>'get', 'class'=>'submit-ajax-getx']) }}
            <div class="input-group">
              {{ Form::text('q', old('q'), ['class'=>'form-control', 'placeholder'=> trans('form.eg_search_poll')]) }}
              <span class="input-group-btn">
                {{ Form::button(trans('form.btn_search'), ['type'=>'submit', 'class'=>'btn btn-primary form-control']) }}
              </span>
            </div>

            {{ Form::close() }}
        </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="section">
    <h5 class="section-title title">@lang('form.poll_latest')</h5>
    <div class="scroll">
    @foreach($latest->chunk(4) as $latest_set)
      <div class="row">
        @foreach($latest_set as $latest_item)
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="post poll-thumbnail medium-post">
						<div class="entry-header">
							<div class="notransition">
                <div class="image-cropper">
                  <img class="rounded" src="{{ !empty($latest_item->avatar) ? $latest_item->avatar : asset(config('playligo.avatar_default')) }}" >
                </div>
                <div class="avatar-text">
                  {{ $latest_item->name }}
                </div>
                <div class="date_time">{{ Carbon::parse($latest_item->created_at)->diffForHumans() }}</div>
							</div>
						</div>
						<div class="post-content">
							<div class="entry-meta">
								<ul class="list-inline">
									<li class="views"><i class="fa fa-eye"></i> {{ $latest_item->pol_view }} views</li>
                  <li class="loves"><i class="fa fa-thumbs-o-up"></i> {{ $latest_item->pol_votes }} votes</li>
								</ul>
							</div>
							<h2 class="entry-title">
								<a href="{{ url('public_poll/' . $latest_item->pol_id) }}">{{ str_limit($latest_item->pol_title, 100) }}</a>
							</h2>
						</div>
					</div>
        </div>
        @endforeach
      </div>
    @endforeach
    <div class="load_more"><a href="{{ url('public_poll/latest/more?page=2') }}">Load more</a></div>
    </div>
  </div>


  <div class="section">
    <h5 class="section-title title">@lang('form.poll_most_voted')</h5>
    <div class="scroll">
      @foreach($mostVoted->chunk(4) as $mv_set)
        <div class="row">
          @foreach($mv_set as $mv_item)
          <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="post poll-thumbnail medium-post">
  						<div class="entry-header">
                <div class="notransition">
                  <div class="image-cropper">
                    <img class="rounded" src="{{ !empty($mv_item->avatar) ? $mv_item->avatar : asset(config('playligo.avatar_default')) }}" >
                  </div>
                  <div class="avatar-text">
                    {{ $mv_item->name }}
                  </div>
  							</div>
  						</div>
  						<div class="post-content">
  							<div class="entry-meta">
  								<ul class="list-inline">
  									<li class="views"><a href="#"><i class="fa fa-eye"></i> {{ $mv_item->pol_view }}</a></li>
                    <li class="loves"><i class="fa fa-thumbs-o-up"></i> {{ $mv_item->pol_votes }}</li>
  								</ul>
  							</div>
  							<h2 class="entry-title">
  								<a href="{{ url('public_poll/' . $mv_item->pol_id) }}">{{ str_limit($mv_item->pol_title, 100) }}</a>
  							</h2>
  						</div>
  					</div>
          </div>
          @endforeach
        </div>
      @endforeach
      <div class="load_more"><a href="{{ url('public_poll/mostvoted/more?page=2') }}">Load more</a></div>
    </div>
  </div>

</div>
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/fontawesome-circle-o.css') }}">
<link rel="stylesheet" href="{{ asset('css/fontawesome-stars-o.css') }}">
@endsection

@section('script')
<script src="{{ asset('/js/jquery.jscroll.min.js') }}"></script>
<script src="{{ asset('js/jquery.barrating.min.js') }}"></script>
<script>
$('.scroll').jscroll({
    autoTrigger: false,
    loadingHtml: '<span class="label label-default">Loading...</span>',
});

$(document).ready(function() {

  ratingEnable();

  // $(".plRating").rateYo({
  //   starWidth: "18px",
  //   rating    : 0,
  //   readOnly: true
  // });

});

function ratingEnable() {
  $('.plRating').barrating('show', {
    theme: 'fontawesome-circle-o',
    showSelectedRating: true,
    readonly: true,
  });
}

</script>
@endsection

@section('meta')
 <meta property="fb:app_id" content="{{ env('FACEBOOK_CLIENT_ID') }}" />
  <meta property="og:url"           content="{{ Request::url() }}" />
	<meta property="og:type"          content="website" />
	<!-- <meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" /> -->
@endsection
