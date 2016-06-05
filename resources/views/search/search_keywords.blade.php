@extends('layouts.app')
@section('content')
<div class="text-center search-keywords">
  <div class="search-keywords-inner">
    <div class="section">
      <h1><span class="label label-success">{{ $location }}</span></h1>
      <div class="row">
          <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2">
              <h2>Got a travel itinerary? Start visualizing your trip now!</h2>
              <h4>Enter specific attractions, places, things to do, accommodations and food in the box below.</h4>
              {{ Form::open(['url'=>url('autogen'), 'method'=>'get', 'class'=>'submit-ajax-get']) }}
              {{ Form::hidden('location', $location) }}
              <div class="form-group">
                <input name="search_keys" id="tags" value="{{ $default }}" class="form-control"/>
                Note: Use 'comma' to separate your keyword tags. Click to edit a keyword and drag to rearrange the order.
              </div>
              <!-- <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      {{ Form::text('search_key[1]', old('search_key[1]'), ['class'=>'form-control', 'placeholder'=> 'e.g. Adventure' ]) }}
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      {{ Form::text('search_key[2]', old('search_key[2]'), ['class'=>'form-control', 'placeholder'=> 'e.g. Exotic food' ]) }}
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      {{ Form::text('search_key[3]', old('search_key[3]'), ['class'=>'form-control', 'placeholder'=> 'e.g. Off beaten track' ]) }}
                    </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      {{ Form::text('search_key[4]', old('search_key[4]'), ['class'=>'form-control', 'placeholder'=> 'e.g. Beautiful scenery' ]) }}
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      {{ Form::text('search_key[5]', old('search_key[5]'), ['class'=>'form-control', 'placeholder'=> '' ]) }}
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      {{ Form::text('search_key[6]', old('search_key[6]'), ['class'=>'form-control', 'placeholder'=> '' ]) }}
                    </div>
                  </div>
              </div> -->
              {{ Form::button(trans('form.btn_back'), ['type'=>'submit', 'class'=>'btn cancel-button btn-primary', 'goto'=>url('/search')]) }}
              {{ Form::button(trans('form.btn_search'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
              <!-- {{ Form::button(trans('form.btn_skip'), ['type'=>'submit', 'class'=>'btn btn-primary']) }} -->
              {{ Form::close() }}
          </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('style')
<link href="{{ asset('css/jquery.tag-editor.css') }}" rel="stylesheet">
<style>
.tag-editor{padding: 10px 10px;}
</style>
@endsection

@section('script')
<script src="{{ asset('/js/jquery.caret.min.js') }}"></script>
<script src="{{ asset('js/jquery.tag-editor.min.js') }}"></script>
<script>
$(document).ready(function() {
  $('#tags').tagEditor({
    maxTags: {{ config('playligo.max_keyword_tags') }},
  });
});
</script>
@endsection
