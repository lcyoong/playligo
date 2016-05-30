@extends('layouts.app')
@section('content')
<div class="text-center search-keywords">
  <div class="search-keywords-inner">
    <div class="section">
      <h1><span class="label label-success">{{ $location }}</span></h1>
      <div class="row">
          <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
              <h2>Have some attractions in mind? <br/>Interested in a peculiar local food or particular fun things to do? <br/>How will you describe this trip?</h2>
              {{ Form::open(['url'=>'autogen', 'method'=>'get', 'class'=>'submit-ajax-get']) }}
              {{ Form::hidden('location', $location) }}
              <div class="row">
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
              </div>
              {{ Form::button(trans('form.btn_back'), ['type'=>'submit', 'class'=>'btn cancel-button btn-primary', 'goto'=>url('/search')]) }}
              {{ Form::button(trans('form.btn_search'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
              {{ Form::button(trans('form.btn_skip'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
              {{ Form::close() }}
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
