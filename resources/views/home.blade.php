@extends('layouts.app_home')

@section('content')
<div class="text-center home-content">
  <div class="home-content-inner">
    <h1>Be inspired. Decide with confidence.</h1>
    <h2 style="margin-bottom: 40px">Watch short curated destination video playlists before you go.</h2>
    <div class="section">
      <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <a href="{{ url('search') }}#discover">{{ Form::button(trans('form.btn_discover'), ['class'=>'btn btn-primary input-lg']) }}</a>&nbsp;&nbsp;&nbsp;
            <a href="{{ url('search') }}">{{ Form::button(trans('form.btn_search'), ['class'=>'btn btn-primary input-lg']) }}</a>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
